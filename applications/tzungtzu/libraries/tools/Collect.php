<?php
/**
 * 采集网站数据类
 * @author Hayden
 * 
 */
class Collect
{
	public $_chage_coding = array('from'=> 'gb2312', 'to' => 'utf-8');
	
	private $_ci = NULL;
    
    public function __construct()
    {
        $this->_ci = &get_instance();
        $this->_ci->load->library('image_lib');
        $this->_ci->load->helper('file');
    }
     
	/**
	 * 匹配地址的内容, 不反悔第一个字段
	 * @param type $url 获取文档的地址
	 * @param type $preg 匹配规则
	 * @return array 返回数据 数组
	 */
	public function get_preg_content($url, $preg)
	{
		$_content = $this->get_content($url);
		$data = '';
		//echo($_content);
		preg_match_all($preg, $_content, $data);
		unset($_content);
		if(isset($data[0])){unset($data[0]);}
		return $data;
	}
	
	/**
	 * 匹配一个数据
	 * @param type $content
	 * @param type $preg
	 * @return string
	 */
	public function preg_match_content($content, $preg)
	{
		$data = '';
		preg_match($preg, $content, $data);
        return isset($data[1]) ? $data[1] : '';
	}

	public function preg_all_content($content, $preg){
		$data = '';
		//echo($_content);
		preg_match_all($preg, $content, $data);
		unset($_content);
		if(isset($data[0])){unset($data[0]);}
		return $data;
	}
		/**
	 * 把内容序列化后写入文档
	 * @param type $content
	 * @param type $file_name
	 * @return type
	 */
	public function write_file_content($content, $file_name)
	{
		return file_put_contents($file_name, serialize(json_encode($content)));
	}
	
	

	/**
	 * 把内容从文档中读取出来
	 * @param type $file_name
	 * @return type
	 */
	public function get_file_content($file_name)
	{
		$_str = file_get_contents($file_name);
        return json_decode(unserialize($_str),true);
	}

	/**
	 * 获取地址的内容
	 * @param type $url
	 * @return type
	 */
	public function get_content($url)
	{
		$_content = file_get_contents($url);
		if (!empty($this->_chage_coding['from']) && !empty($this->_chage_coding['to'])){
			return mb_convert_encoding($_content, $this->_chage_coding['to'], $this->_chage_coding['from']);
		}else{
			return $_content;
		}
	}
}

/* End of file Collect.php */
/* Location: ./application/libraries/tools/Collect.php */