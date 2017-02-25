<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
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
 * Address Model Class
 *
 * @package		TzungTzu
 * @subpackage	Models
 * @category	Address
 * @author		TZ Dev Team
 */
class Address_Model extends TZ_Model
{
	protected $TableName 		= 'user_address';
	
	public $SortField           = 'id';
	
	public $SortMode			= 'DESC';
	//primary key
	protected $PKey 	 		= 'id';

	protected $rules	 		= array(
		array('province',  'required'),
		array('city',      'required'),
		array('address',   'required'),
		array('contact',   'required'),
		array('postcode',  'required'),
		array('contact',   'maxlen', 26),
	);	

	// array('字段名' => '语言包名称')
	protected $field_titles 	= array(
		'province' 	=> 'form_province',
		'city'  	=> 'form_city',
		'address' 	=> 'form_address',
		'contact' 	=> 'form_contact',
		'postcode' 	=> 'form_postcode'
	);	

	public function __construct()
	{
		parent::__construct();
	}

}

/* End of file Address_Model.php */
/* Location: ./application/models/accounts/Address_Model.php */