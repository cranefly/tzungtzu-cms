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
 * Resource Model Class
 * 资源
 * @package		TzungTzu
 * @subpackage	Models
 * @category	Resource
 * @author		TZ Dev Team
 */
class Resource_Model extends TZ_Model
{
	protected $TableName	= 'sys_resources';
	
    //primary key
	protected $PKey			= 'id';

	protected $rules	 	= array(
        array('url',  'required'),
	);	

	// array('字段名' => '语言包名称')
	protected $field_titles = array(
        'url'     => 'form_url',
	);	

	public function __construct()
	{
		parent::__construct();
	}
}

/* End of file Resource_Model.php */
/* Location: ./application/models/extends/Resource_Model.php */