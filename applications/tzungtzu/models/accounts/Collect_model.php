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
 * Collect Model Class
 *
 * @package		TzungTzu
 * @subpackage	Models
 * @category	Collect
 * @author		TZ Dev Team
 */
class Collect_Model extends TZ_Model
{
	protected $TableName 		= 'user_collect';
	
	public $SortField           = 'id';
	
	public $SortMode			= 'DESC';
	//primary key
	protected $PKey 	 		= 'id';

	protected $rules	 		= array(
		array('uid',        'required'),
		array('model_id',   'required'),
		array('info_id',    'required'),
		array('cdate',      'required')
	);	

	// array('字段名' => '语言包名称')
	protected $field_titles 	= array(
		'uid'       => 'form_uid',
		'model_id'  => 'form_model_id',
		'info_id' 	=> 'form_info_id',
		'cdate' 	=> 'form_cdate',
	);	

	public function __construct()
	{
		parent::__construct();
	}
}

/* End of file Collect_Model.php */
/* Location: ./application/models/accounts/Collect_Model.php */