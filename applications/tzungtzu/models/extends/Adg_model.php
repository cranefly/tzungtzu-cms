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
 * Adg Model Class
 * 广告位组的模型
 * @package		TzungTzu
 * @subpackage	Models
 * @category	Field
 * @author		TZ Dev Team
 */
class Adg_Model extends TZ_Model
{
	protected $TableName	= 'ad_group';
	
    //primary key
	protected $PKey			= 'id';

	protected $rules	 	= array(
        array('title',  'required'),
	);	

	// array('字段名' => '语言包名称')
	protected $field_titles = array(
        'title'     => 'form_title',
	);	

	public function __construct()
	{
		parent::__construct();
	}
}

/* End of file Adg_Model.php */
/* Location: ./application/models/extends/Adg_Model.php */