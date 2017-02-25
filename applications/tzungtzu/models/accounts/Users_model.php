<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * 用户模型
 *
 * @package	TzungTzu
 * @author	 TZ Dev Team
 * @copyright   Copyright (c) 2012-2024, TzungTzu.com.
 * @license	http://tzungtzu.com/doucmentss/license.html
 * @link	   http://tzungtzu.com/
 * @since	  Version 1.0.0
 */
// ------------------------------------------------------------------------

/**
 * Users Model Class
 *
 * @package		TzungTzu
 * @subpackage	Models
 * @category	Models
 * @author		TZ Dev Team
 */
class Users_Model extends TZ_Model
{
	protected $TableName 		= 'user';
	protected $GroupTableName 	= 'user_group';
	
	public $SortField 		= 'id';

	protected $StateField		= 'ustate';
	//primary key
	protected $PKey 	 		= 'id';

	protected $rules	 		= array(
		array('uname',  	'required'),
		array('uname',  	'minlen', 2),
		array('uname',  	'maxlen', 16),
		array('group_id', 	'required'),
		array('group_id', 	'int'),
		array('uphone', 	'phone'),
		array('uqq',		'qq'),
		array('uemail',		'email'),
		array('upass',  	'minlen', 6),
		array('upass',  	'maxlen', 32)
	);	

	// array('字段名' => '语言包名称')
	protected $field_titles 	= array(
		'uname' 	=> 'form_uname',
		'uphone' 	=> 'form_uphone',
		'uemail' 	=> 'form_uemail',
		'uqq' 		=> 'form_uqq',
		'upass'		=> 'form_upass',
		'group_id'	=> 'form_group'
	);	

	protected $unique 			= array('uname');
	
	public function __construct()
	{
		parent::__construct();
		
	}

    /**
     * 检测用户是否有访问权限
     * @param type $level
     * @param type $auth
     * @return boolean
     */
    public function check_authority($level, $auth)
    {
        //超级管理员权限
        if (in_array('SUPER', $auth)){
			
            return TRUE;
        }
        
        if (in_array($level, $auth)) {
            return TRUE;
        }
        
        return FALSE;//无效的访问
    }
	/**
	 * 获取列表
	 * 
	 * @access public
	 * @param type $params
	 * @return array
	 */
	public function lists($params = array())
	{
		$this->db->select('a.id, a.uname, a.uavatar, a.uemail, a.uphone, a.uqq, a.unick, a.ustate,a.birth_day, a.motto, a.last_login_date, a.is_admin, a.rank, g.g_name');
		
		$this->db->from("{$this->TableName} AS a");
		
		$this->db->join("{$this->GroupTableName} AS g", 'g.id = a.group_id', 'LEFT');
		$this->_where($params);
		unset($params);
		
		$this->db->order_by($this->SortField, $this->SortMode);

		return $this->db->get()->result_array();
	}

	/**
	 * find user
	 *
	 * @access	public
	 * @param string/int
	 * @param string
	 * @return	array
	 */
	public function find($uname, $field = 'a.id', $fields = '')
	{
		$this->db->select('a.*, g.id as g_id, g.g_name ,g.is_admin_g');
		
		$this->db->from("{$this->TableName} AS a");

		$this->db->join("{$this->GroupTableName} AS g", 'g.id = a.group_id', 'LEFT');
		if ($field == NULL)
		{
			$this->db->where($this->PKey, intval($uname));
		} else
		{
			$this->db->where($field, $uname);
		}

		$this->db->limit(1);

		return $this->db->get()->row_array();
	}

	/**
	 * 删除用户
	 *
	 * @access public
	 * @param type $where
	 * @param type $field
	 * @return boolean
	 */
	public function deletes($where, $field = 'id')
	{
		$this->db->where_in($field, explode(',', $where));
		$this->db->where('id !=', $this->tz_user->UId);
		$this->db->where('rank !=', 'SUPER');
	    $this->db->delete($this->TableName);

	    unset($where, $field);
	    return $this->db->affected_rows() > 0;
	}
	
	/**
	 * 只取管理用户
	 * @access public
	 * $return void;
	 */
	public function get_admins()
	{
		$this->db->from($this->TableName);
		$this->db->select('id, uname, unick');
		$this->db->where('is_admin',1);
		$this->db->order_by($this->SortField, $this->SortMode);

		return $this->db->get()->result_array();
	}
	
	/**
	 * 获取权限
	 * @access public 
	 * @param type $user_id
	 * @return array
	 */
	public function get_authority($user_id)
	{
		$authority = $this->find_field($user_id, 'a.id', 'rank');
		unset($user_id);
		return explode(',', $authority);
	}
}

/* End of file Users_Model.php */
/* Location: ./application/models/accounts/Users_Model.php */
