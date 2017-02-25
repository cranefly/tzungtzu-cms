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
 * Tagg Model Class
 * 标签组
 * @package		TzungTzu
 * @subpackage	Models
 * @category	Field
 * @author		TZ Dev Team
 */
class Tagg_Model extends TZ_Model
{
	protected $TableName	= 'cms_tag_group';
	
    //primary key
	protected $PKey			= 'id';

	protected $rules	 	= array(
        array('gname',  'required'),
	);	

	// array('字段名' => '语言包名称')
	protected $field_titles = array(
        'gname'     => 'form_gname',
	);	

	public function __construct()
	{
		parent::__construct();
	}
}

/* End of file Tagg_Model.php */
/* Location: ./application/models/extends/Tagg_Model.php */