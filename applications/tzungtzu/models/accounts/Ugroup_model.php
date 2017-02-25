<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * 用户组模型
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
 * UGroup Model Class
 *
 * @package		TzungTzu
 * @subpackage	Models
 * @category	Models
 * @author		TZ Dev Team
 */
class UGroup_Model extends TZ_Model
{
	protected $TableName 		= 'user_group';
	
	public $SortField 		= 'id';
	
	protected $StateField		= 'g_state';
	
	public $SortMode			= 'DESC';
	//primary key
	protected $PKey 	 		= 'id';

	protected $rules	 		= array(
		array('g_name',  'required'),
		array('g_name',  'minlen', 2),
		array('g_name',  'maxlen', 16),
	);	

	// array('字段名' => '语言包名称')
	protected $field_titles 	= array(
		'g_name' 	=> 'form_g_name'
	);	

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 删除用户组
	 *
	 * @access public
	 * @param type $group_ids
	 * @param type $field
	 * @return boolean
	 */
	public function deletes($group_ids, $field = 'id')
	{
		$this->db->where_in($field, explode(',', $group_ids));
		$this->db->where('id !=', $this->tz_user->GroupId);
		$this->db->where('g_urank !=', 'SUPER');
	    $this->db->delete($this->TableName);

	    unset($group_ids, $field);
	    return $this->db->affected_rows() > 0;
	}
	
	/**
	 * 获取权限
	 * @access public 
	 * @param type $group_id
	 * @return array
	 */
	public function get_authority($group_id)
	{
		$authority = $this->find_field($group_id, 'id', 'g_urank');
		
		return explode(',', $authority);
	}
}

/* End of file UGroup_Model.php */
/* Location: ./application/models/accounts/UGroup_Model.php */