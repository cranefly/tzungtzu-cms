<?php
/**
 * 创建生成海报图片
 * 如果是图片海报 设置imageconfig 然后调用create_image 即可
 * 如果是文字海报 设置textconfig 然后调用create_text 即可
 * 图片和文字可以任意使用次数以及重复使用
 * 
 * @author Hayden
 * 
 */
class Playbill
{
    private $_image_url      = ''; // 最终的海报地址
    private $_resource_image = ''; // 原图海报地址

    private $type            = '';
    /**
     * 处理图片配置
     * @var type 
     */
    private $image_config   = array(
        'resource'         => '',
        'image_name'       => '',
        'thumb_name'       => '',
        'thumb_size'       => array('width' => 0, 'height' => 0),
        'wm_vrt_alignment' => '',
        'wm_hor_alignment' => '',
        'wm_vrt_offset'    => '',
        'wm_hor_offset'    => '',
    );
    /**
     * 处理文字配置
     * @var type 
     */
    private $text_config    = array(
        'text'             => '',
        'font_path'        => '',
        'font_color'       => '',
        'font_size'        => '',
        'wm_vrt_alignment' => '',
        'wm_hor_alignment' => '',
        'wm_vrt_offset'    => '',
        'wm_hor_offset'    => '',
    );
    private $_ci = NULL;
    
    public function __construct($option = array())
    {
        $this->_ci = &get_instance();
        $this->_ci->load->library('image_lib');
        $this->_ci->load->helper('file');
         
        if (!empty($option)){
            
            $this->_resource_image     = $option['resource_image'];

            $this->_image_url    = $option['image_url'];

            //目录不存在，创建目录
            $_dir1_path = pathinfo($this->_resource_image);
            $_dir1 = $_dir1_path['dirname'] . DIRECTORY_SEPARATOR;
            $_dir2_path = pathinfo($this->_image_url);
            $_dir2 = $_dir2_path['dirname'] . DIRECTORY_SEPARATOR;
            //die($_dir1);
            if (!is_dir($_dir1))
            {
                mkdirs($_dir1);
            }
            if (!is_dir($_dir2))
            {
                mkdirs($_dir2);
            }
            $this->type = $_dir1_path['extension'];
        }
    }
    
    /**
     * 创建头像水印图片
     * 
     * @access public
     * @return void 
     */
    public function create_image()
    {
        if (!empty($this->image_config['thumb_name']) && !file_exists($this->image_config['thumb_name']))
        { 
            $this->create_thumb($this->image_config['image_name'], $this->image_config['thumb_size']['width'], $this->image_config['thumb_size']['height']);
            $thumb_image = $this->image_config['thumb_name'];

        }else{
            $thumb_image = $this->image_config['image_name'];
        }

        //把头像水印到底片
        if (file_exists($this->_image_url))
        {
            $config['source_image']       = $this->_image_url;
        }else
        {
            $config['source_image']       = $this->_resource_image;
            $config['new_image']          = $this->_image_url;
        }
        $config['wm_overlay_path']    = $thumb_image;
        $config['wm_type']            = 'overlay';
        $config['wm_vrt_alignment']   = $this->image_config['wm_vrt_alignment'];
        $config['wm_hor_alignment']   = $this->image_config['wm_hor_alignment'];
        $config['wm_vrt_offset']      = $this->image_config['wm_vrt_offset'];
        $config['wm_hor_offset']      = $this->image_config['wm_hor_offset'];
        $config['wm_opacity']         = '100';
        
        $this->_ci->image_lib->initialize($config);
        $this->_ci->image_lib->watermark();
        $this->_ci->image_lib->clear();
        unset($config);
    }
    
    /**
     * 创建文本缩略图
     * $access public
     * @return void 
     */
    public function create_text()
    {
        if (empty($this->text_config['text'])){return FALSE;}
        //打水印到底片
        if (file_exists($this->_image_url))
        {
            $config['source_image']       = $this->_image_url;
        }else
        {
            $config['source_image']       = $this->_resource_image;
            $config['new_image']          = $this->_image_url;
        }
        $config['wm_text']            = $this->text_config['text'];
        $config['wm_type']            = 'text';
        $config['wm_font_path']       = $this->text_config['font_path'];
        $config['wm_font_size']       = $this->text_config['font_size'];
        $config['wm_font_color']      = $this->text_config['font_color'];
        $config['wm_vrt_alignment']   = $this->text_config['wm_vrt_alignment'];
        $config['wm_hor_alignment']   = $this->text_config['wm_hor_alignment'];
        $config['wm_hor_offset']      = $this->text_config['wm_hor_offset'];
        $config['wm_vrt_offset']      = $this->text_config['wm_vrt_offset'];

        $config['wm_opacity']         = '100';
        $this->_ci->image_lib->initialize($config);
        $this->_ci->image_lib->watermark();
        $this->_ci->image_lib->clear();
        unset($config);
    }

    /**
     * 设置图片配置参数
     */
    public function set_image_config($config)
    {
        $this->image_config = array(
            'image_name'       => isset($config['image_name']) ? $config['image_name'] : '',
            'thumb_name'       => isset($config['thumb_name']) ? $config['thumb_name'] : '',
            'thumb_size'       => array('width' => isset($config['thumb_size']['width']) ? $config['thumb_size']['width'] : '200', 'height' => isset($config['thumb_size']['height']) ? $config['thumb_size']['height'] : '200'),
            'wm_vrt_alignment' => isset($config['wm_vrt_alignment']) ? $config['wm_vrt_alignment'] : 'middle',
            'wm_hor_alignment' => isset($config['wm_hor_alignment']) ? $config['wm_hor_alignment'] : 'center',
            'wm_vrt_offset'    => isset($config['wm_vrt_offset']) ? $config['wm_vrt_offset'] : 0,
            'wm_hor_offset'    => isset($config['wm_hor_offset']) ? $config['wm_hor_offset'] : 0,
        );
    }
    
    public function set_text_config($config)
    {
        $this->text_config = array(
            'text'             => isset($config['text']) ? $config['text'] : '',
            'font_path'        => isset($config['font_path']) ? $config['font_path'] : './system/fonts/simkai.ttf',
            'font_color'       => isset($config['font_color']) ? $config['font_color'] : '#ffffff',
            'font_size'        => isset($config['font_size']) ? $config['font_size'] : '14',
            'wm_vrt_alignment' => isset($config['wm_vrt_alignment']) ? $config['wm_vrt_alignment'] : 'top',
            'wm_hor_alignment' => isset($config['wm_hor_alignment']) ? $config['wm_hor_alignment'] : 'left',
            'wm_vrt_offset'    => isset($config['wm_vrt_offset']) ? $config['wm_vrt_offset'] : '0',
            'wm_hor_offset'    => isset($config['wm_hor_offset']) ? $config['wm_hor_offset'] : '0',
        );
    }

    /**
     * 获取地址
     * @return type
     */
    public function get_image_url()
    {
        return $this->_image_url;
    }

    /**
     * 创建缩略图
     * @access public
     * @param type $codeimgurl
     * @return void
     */
    public function create_thumb($imgurl, $width = 477, $height = 477, $thumb_marker = '_thumb')
    {
        $code_config['image_library']   = 'gd2';
        $code_config['source_image']    = $imgurl;
        $code_config['create_thumb']    = TRUE;
        $code_config['maintain_ratio']  = TRUE;
        $code_config['width']           = $width;
        $code_config['height']          = $height;
        $code_config['thumb_marker']    = $thumb_marker;
        //创建本地缩略图
        $this->_ci->image_lib->initialize($code_config);
        unset($code_config);
        $this->_ci->image_lib->resize();
        $this->_ci->image_lib->clear();
    }
    
    public function initi_img(){//初始化图象
        if($this->type=='jpg' || $this->type=='jpeg'){
            $this->im=imagecreatefromjpeg($this->srcimg);
        }
        if($this->type=='gif'){
            $this->im=imagecreatefromgif($this->srcimg);
        }
        if($this->type=='png'){
            $this->im=imagecreatefrompng($this->srcimg);
        }
        if($this->type=='wbm'){
            @$this->im=imagecreatefromwbmp($this->srcimg);
        }
        if($this->type=='bmp'){
            $this->im=$this->ImageCreateFromBMP($this->srcimg);
        }
    }
    
    public function imagecreatefrom($image, $type){
        if($type=='jpg' || $type=='jpeg'){
            $im=imagecreatefromjpeg($image);
        }
        if($type=='gif'){
            $im=imagecreatefromgif($image);
        }
        if($type=='png'){
            $im=imagecreatefrompng($image);
        }
        if($type=='wbm'){
            @$im=imagecreatefromwbmp($image);
        }
        if($type=='bmp'){
            //$im=$this->ImageCreateFromBMP($image);
        }
        
        return $im;
    }

        /**
	 * 获取图片信息
	 *
	 * @access private
	 * @param string $image
	 * @return array
	 */
	public function get_image_info($image)
	{
		$width_height  = getimagesize($image);
		$size		   = ceil(filesize($image)/1024);
		$nameinfo	   = pathinfo($image);

		return array(
			'type'	 => $nameinfo['extension'],
			'width'	 => $width_height[0],
			'height' => $width_height[1],
			'size'	 => $size,
			'name'	 => $nameinfo['filename'],
			'oname'	 => $nameinfo['basename'],
            'dirname'=> $nameinfo['dirname'],
		);
	}
    
    /**
     * 下载远程图片
     * @access public
     * @param type $url
     * @param type $filename
     * @return string
     */
    public function down_image($url, $filename)
    {
        $ch = curl_init ();  
        curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );  
        curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );  
        curl_setopt ( $ch, CURLOPT_URL, $url );  
        ob_start ();  
        curl_exec ( $ch );  
        $return_content = ob_get_contents ();  
        ob_end_clean ();  
        
        $return_code = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );  
        
        $fp= @fopen($filename,"a"); //将文件绑定到流
        
        fwrite($fp,$return_content); //写入文件  
        fclose($fp);
        return $filename;
    }   
}

/* End of file Playbill.php */
/* Location: ./application/libraries/Playbill.php */