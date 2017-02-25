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
 * Comment Model Class
 * 评论
 * @package		TzungTzu
 * @subpackage	Models
 * @category	Field
 * @author		TZ Dev Team
 */
class Comment_Model extends TZ_Model
{
	protected $TableName	= 'cms_comment';
	
	//primary key
	protected $PKey			= 'id';
    
    protected $StateField   = 'is_check';
    
    protected $rules	 	= array(
        array('content',  'required')
	);	

	// array('字段名' => '语言包名称')
	protected $field_titles = array(
        'content'     => 'form_content' 	
    );	

	public function __construct()
	{
		parent::__construct();
	}
}

/* End of file Comment_Model.php */
/* Location: ./application/models/extends/Comment_Model.php */