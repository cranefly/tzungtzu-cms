<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * @package     TzungTzu
 * @author      TZ Dev Team
 * @copyright   Copyright (c) 2012-2024, TzungTzu.com.
 * @license     http://tzungtzu.com/doucmentss/license.html
 * @link        http://tzungtzu.com/
 * @since       Version 1.0.0
 */
// ------------------------------------------------------------------------

/**
 * Setted Model Class
 *
 * 网站配置
 * @package		TzungTzu
 * @subpackage	Models
 * @category	Models
 * @author		TZ Dev Team
 */
class Web_Model extends TZ_Model
{
	protected $TableName 		= 'tool_webs';
	
	public $SortField			= 'id';

	//primary key
	protected $PKey 	 		= 'id';

	protected $rules	 		= array(
		array('title',  	'required'),
		array('url',  	'required')
	);	

	// array('字段名' => '语言包名称')
	protected $field_titles 	= array(
		'title' 	=> 'form_title',
		'url'		=> 'form_url'
	);	

	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * 获取到一条数据
	 * @return type
	 */
	public function get_one()
	{
		$this->db->limit(1);
		$params['status'] = 1;
		$return = $this->lists($params);
		
		if (count($return) == 1){
			return $return[0];
		}
		return array();
	}
	protected function _where($params = array())
	{
		if (isset($params['status']) && !empty($params['status']))
		{
			$this->db->where('status', $params['status']);
		}
		parent::_where($params);
	}
}

/* End of file Web_model.php */
/* Location: ./application/models/tools/web_model.php */