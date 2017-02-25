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
 * 微信自动回复
 * 
 * @package		TzungTzu
 * @subpackage	Models
 * @category	Models
 * @author		TZ Dev Team
 */
class Reply_Model extends TZ_Model
{
	protected $TableName 		= 'wechat_reply';
	
	public $SortField			= 'id';

	//primary key
	protected $PKey 	 		= 'id';

	protected $rules	 		= array(
		array('keyword',  	'required'),
		array('reply',  	'required')
	);	

	// array('字段名' => '语言包名称')
	protected $field_titles 	= array(
		'keyword' 	=> 'form_keyword',
		'reply'		=> 'form_reply'
	);	

	public function __construct()
	{
		parent::__construct();
	}
}

/* End of file Reply_model.php */
/* Location: ./application/models/wechat/Reply_model.php */