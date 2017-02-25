<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  TzungTzu CMS
 *
 *  文件上传
 *
 * @package     TzungTzu
 * @author      TZ Dev Team
 * @copyright   Copyright (c) 2012-2024, TzungTzu.com.
 * @license     http://tzungtzu.com/doucmentss/license.html
 * @link        http://tzungtzu.com/
 * @since       Version 1.0.0
 */

/**
 * Upload Controller
 *
 * @package     TzungTzu
 * @subpackage  Controller
 * @category    Controller
 * @author      Tz Dev Team
 */
class Upload extends Master_Controller
{

	private $_is_water 					= FALSE;
	private $_watermarkwidth			= 0;				//打水印图片的最小宽度
	private $_watermarkheight 			= 0; 				//打水印图片的最小高度
	private $_watermarkpct 				= 60;				//0 - 100 水印透明度
	private $_watermarkquality			= 80;				//0 - 100 水印质量
	private $_watermarkpos				= 3; 				//水印位置 0 - 5
	private $_watermarktype 			= 0; 				//水印类型 0=文字，1=图片
	private $_watermarkimg				=''; 				// 水印图片位置
	private $_watermarktext 			= ''; 				// 水印文字
	private $_watermarkfontsize 		= 12; 				// 文字大小
	private $_watermarkfontcolor 		= '#FFFF'; 			// 文字颜色
	private $_water_mark_font_family 	= 'elephant.ttf'; 	// 字体

	private $_is_thumb 					= FALSE;
	private $_thumbmaxwidth 			= ''; 				// 缩略图最大宽度
	private $_thumbmaxheight 			= ''; 				// 缩略图最大高度
	private $_thumbprefix 				= ''; 				//图片名称修饰符
	private $_thumbpath 				= ''; 

	public $ModelPath 					= 'system/resource_model';

	public $image_types					= array('gif', 'jpeg', 'png', 'bmp', 'jpg'); // '.gif|.jpeg|.png|.bmp';

	public $img_host					= '';
    
    private $md5content                 = ''; //图片内容
	public function __construct()
	{

		parent::__construct();
        //ini_set('memory_limit','12M');
		$this->load->helper('file');
		$this->load->model($this->ModelPath, 'resource');
		
		$this->img_host = IMG_HOST;

		if (empty($this->img_host)){
			$this->img_host = base_url();
		}
	}

	/**
	 * 头像上传
	 * @access public
	 * @return vodi
	 */
	public function avatar()
	{
		$upload_path				= './files/uploads/avatars/'.  date('Y/m/',time());
		$file_name					= $this->_get_image_name();
		
		$config['upload_path']      = $upload_path;
        $config['allowed_types']    = '*';
        $config['max_size']			= 2048;
        $config['max_width']        = 800;
        $config['max_height']       = 800;
		$config['file_name']		= $file_name;
		
		if (!is_dir($config['upload_path']))
		{
			mkdirs($config['upload_path']);
		}
		
        $this->load->library('upload', $config);
		unset($config);
		
        if (!$this->upload->do_upload('Filedata'))
        {
            $error = array('error' => $this->upload->display_errors());
			
			unset($error);
        }
        else
        {
            $data		= $this->upload->data();
			
			$file_url	= $upload_path . $file_name . $data['file_ext']; 
			//$fileUrl = str_replace("\\", "/", $fileUrl);
			
			//创建两个缩略图，分别为40*40 和200*200
			$this->_create_thumb($file_url, 40, 40);
			$this->_create_thumb($file_url, 200, 200);
			
			$resource = $this->_get_image_info($file_url);
			
			$resource['oname']	= $data['client_name']; 
			$resource['url']	= ltrim($file_url,'.');
			
			unset($data, $file_name, $file_url, $upload_path);
			
			$this->resource->insert($resource);
			
			$this->print_json($resource);
        }
	}

	/**
	 * 系统文档上传，一般都要根据系统图片文档配置重新处理文件
	 *
	 *
	 *
	 * 
	 */
	public function do_upload()
	{
        // 先判断文件是否已经有提交过,根据内容的md5进行判断
        $md5content = $this->_check_md5();
        if (empty($md5content)){
            $this->print_json(array('state' => 'FAIL', 'file_path' => 'NO FOUND FILE'));
        }
        
        $file_path = $this->_action();
        if (empty($file_path))
        {
            $error = array('error' => $this->upload->display_errors());
			$return_data = array(
                'success'   => 'FAIL',
                'file_path' => $error
            );
            unset($error);
			$this->print_json($return_data);
        }
        else
        {
            $return_data = array(
                'success'     => 'SUCCESS',
                'file_path' => $file_path
            );
			$this->print_json($return_data);
        }
	}

    
	/**
	 * 系统普通文件上传，一般都没有缩略图等处理
	 *
	 */
	public function file_upload()
	{
        // 先判断文件是否已经有提交过,根据内容的md5进行判断
        $md5content = $this->_check_md5();
        if (empty($md5content)){
            $this->print_json(array('state' => 'FAIL', 'file_path' => 'NO FOUND FILE'));
        }
        
        $file_path = $this->_action();
        if (empty($file_path))
        {
            $error = array('error' => $this->upload->display_errors());
			$return_data = array(
                'success'   => 'FAIL',
                'file_path' => $error
            );
            unset($error);
			$this->print_json($return_data);
        }
        else
        {
            $return_data = array(
                'success'   => 'SUCCESS',
                'file_path' => $file_path
            );
			$this->print_json($return_data);
        }
        
	}

    /**
     * 执行上传操作，返回文件地址
     */
    private function _action()
    {
        $upload_path				= './files/uploads/'.  date('Y/m/',time());
		$file_name					= $this->_get_image_name();
		
		$config['upload_path']      = $upload_path;
        $config['allowed_types']    = '*';
		$config['file_name']		= $file_name;
		
		if (!is_dir($config['upload_path']))
		{
			mkdirs($config['upload_path']);
		}
		
        $this->load->library('upload', $config);
		unset($config);
		
        if (!$this->upload->do_upload('Filedata'))
        {
            $error = array('error' => $this->upload->display_errors());
            
			$return_data = array(
                'success'   => FALSE,
                'file_path' => $error
            );
            unset($error);
			$this->print_json($return_data);
			
        }
        else
        {
            $data		= $this->upload->data();
			
			$file_url	= $upload_path . $file_name . $data['file_ext']; 
			$file_path	= rtrim($this->img_host, '/') . ltrim($file_url,'.');
			unset($file_name, $upload_path);
			
            $new_id = $this->_insert($file_url, $data['client_name']);
            unset($new_id, $data);
            return $file_path;
        }
    }
    
    /**
     * 上传微信素材
     */
    public function upload_material()
    {
        
    }
    
    /**
     * 按文件夹目录批量添加资源
     * 每次读取整个文件夹的里面的资源列表，MD5后判定是否唯一，然后添加到数据库中
     *
     * @param type $dir  相对目录地址
     */
    public function batch_resource($dir = NULL, $tag = NULL)
    {
        set_time_limit(0);
        if ($dir === NULL){$dir = $this->get_data('dir');}
        if ($tag === NULL){$tag = $this->get_data('tag');}
        
        $this->load->helper('directory', 1);
        
        $map = directory_map($dir);

        $success    = 0;
        $msg        = '';
        if (is_array($map)){
            foreach($map as $val){
                // if ($val == '.' || $val == '..'){continue;}
                $file_url           = $dir . $val; 
                $pathinfo = pathinfo($file_url);
                // 如果不是图片忽略
                if (!in_array(strtolower($pathinfo['extension']), $this->image_types)){
                    $msg .= $file_url . ',';
                    continue;
                }
                
                $resource_md5       = md5(file_get_contents($file_url));
                $resource           = $this->_get_image_info($file_url);
                $resource['oname']	= $val; 
                $resource['url']	= $this->img_host . ltrim($file_url,'.');
                $resource['content'] = $resource_md5;
               
                // 根据文件内容md5，保证图片不在系统中重复
                $is_exit = $this->resource->find($resource_md5, 'content');
                if ($is_exit){
                    $msg .= $file_url . ',';
                    continue;
                }else{
                   $new_id = $this->resource->insert($resource);
                   $success += 1;
                }
                unset($resource, $resource_md5, $file_url, $is_exit);
            }
        }
        echo('成功创建资源' . $success . '条记录，忽略的资源为：'. $msg);
    }
    
    /**
     * 
     * 根据文件md5后判定是否存在
     */
    private function _check_md5()
    {
        // 先判断文件是否已经有提交过,根据内容的md5进行判断
        $md5content = '';
        
        if (isset($_FILES['Filedata']['tmp_name'])){
            $md5content   = md5(file_get_contents($_FILES['Filedata']['tmp_name']));
            $old_resource = $this->resource->find($md5content, 'content');
            if (!empty($old_resource)){
                $this->print_json(array('success' => 'SUCCESS', 'file_path' => $old_resource['url']));
            }
            unset($old_resource);
        }
        
        $this->md5content = $md5content;
        return $md5content;
    }

    /**
     * 文件信息加入数据库，已方便管理
     * 
     * @param type $file_url
     * @param type $oname
     * @return type
     */
    private function _insert($file_url, $oname = '')
    {
        $resource = $this->_get_image_info($file_url);
			
        $resource['content'] = $this->md5content;
        $resource['oname']	 = $oname; 
        $resource['url']	 = rtrim($this->img_host, '/') . ltrim($file_url,'.');

        unset($oname, $file_url);

        $new_id = $this->resource->insert($resource);
        unset($resource);
        return $new_id;
    }
    
    /**
	 * 获取图片信息
	 *
	 * @access private
	 * @param string $image
	 * @return array
	 */
	private function _get_image_info($image)
	{
		$width_height  = getimagesize($image);
		$size		   = ceil(filesize($image)/1024);
		$nameinfo	   = pathinfo($image);

		return array(
			'type'	 => $nameinfo['extension'],
			'width'	 => $width_height[0],
			'height' => $width_height[1],
			'size'	 => $size,
			//'name'	 => $nameinfo['filename'],
			'oname'	 => $nameinfo['basename'],
			'cdate'	 => time(),
		);
	}
	
	/**
	 * 创建缩略图
	 * @access private
	 * @param type $image_url
	 * @param type $width
	 * @param type $height
	 * @return boolean
	 */
	private function _create_thumb($image_url, $width = 40, $height = 40)
	{
		if (!empty($image_url) && $width > 0 && $height > 0 )
		{
			$config['thumb_marker']		= '_' . $width;
			$config['image_library']	= 'gd2';
			$config['source_image']		= $image_url;
			$config['create_thumb']		= TRUE;
			$config['maintain_ratio']	= TRUE;
			$config['width']			= $width;
			$config['height']			= $height;
			$config['master_dim']		= 'height';
			
			$this->load->library('image_lib', $config);
			unset($config);
			
			if (!$this->image_lib->resize())
			{
				echo $this->image_lib->display_errors();
				exit();
			}
			return TRUE;
		}
		
		return FALSE;
	}

	/**
	 * 判断是否为图片
	 *
	 * @access private
	 * @param $image 
	 * @return Boolean
	 */
	private function _is_image($image)
	{

		return TRUE;
	}
	
	/**
	 * 生成一个文件名
	 * @access private
	 * @param string $image_type 图片类型,默认没有
	 * @return string 唯一文件名
	 */
	private function _get_image_name($image_type = '')
	{
		return md5(microtime() . rand(1000, 9999)) . $image_type;
	}
}

/* End of file Upload.php */
/* Location: ./application/webmaster/Upload.php */