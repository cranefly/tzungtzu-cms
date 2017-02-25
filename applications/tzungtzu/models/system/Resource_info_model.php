<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * 资源文档关系模型
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
 * Resource Model Class
 *
 * @package		TzungTzu
 * @subpackage	Models
 * @category	Resource_info_Model
 * @author		TZ Dev Team
 */
class Resource_info_Model extends TZ_Model
{
	protected $TableName 	= 'sys_resource_info';
	
	public $SortField 		= 'id';

	//primary key
	protected $PKey 	 	= 'id';

	protected $rules	 	= array(
	);	

	// array('字段名' => '语言包名称')
	protected $field_titles = array(
	);	
	
	public function __construct()
	{
		parent::__construct();
		
	}

}

/* End of file Resource_info_Model.php */
/* Location: ./application/models/system/Resource_info_Model.php */