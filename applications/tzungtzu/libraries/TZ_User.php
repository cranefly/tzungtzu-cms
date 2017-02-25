<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * 用户类
 *
 * @package     TzungTzu
 * @author      TZ Dev Team
 * @copyright   Copyright (c) 2012-2024, TzungTzu.com.
 * @license     http://tzungtzu.com/doucments/license.html
 * @link        http://tzungtzu.com/
 * @since       Version 1.0.0
 */
// ------------------------------------------------------------------------

/**
 * User Class
 *
 * @package	TzungTzu
 * @subpackage	Libraries
 * @category	TZ_User
 * @author		TZ Dev Team - hayden
 */
class TZ_User
{
	const PWD_PREFIX           = 'Md(009Mkdaaq';//密码混淆前缀
    
    const USR_COOKIE_KEY       = '*&Mdd28H0M<=//-+@sdsGGk';

	private $_ci               = NULL;

    public $cache_type       = '1'; // 1=session 2=redis 
    
    private $user_table_name   = 'tz_user';
    private $group_table_name  = 'tz_user_group';

    private $token			= '';

	private $UId			= 0;
	private $UName			= '';
	private $GroupId		= 0;
	private $GroupName		= '';
	private $UAvatar		= '';
	private $UEmail			= '';
	private $UPhone			= '';
	private $UQQ			= '';
	private $UNick			= '';
	private $UState			= 0;
	private $Gender			= '';
	private $Birthday		= 0;
	private $City			= '';
	private $Motto			= 0;
	private $Rank			= '';
	private $IsAdmin		= FALSE;
	private $UPoint         = '';
	private $Article        = 0;

    private $user_access	= '';

	public function __construct()
	{
		$this->_ci = &get_instance();
		$this->init_userdata();

	}

	/**
	 * Init user data
	 *
	 * @access	public
	 *
	 * @return	void
	 */
	public function init_userdata()
	{
		$user_data = $this->get_access();
		if (isset($user_data) && isset($user_data['id']))
		{
			$this->UId			= $user_data['id'];
			$this->UName		= $user_data['uname'];
			$this->UAvatar		= $user_data['uavatar'];
			$this->GroupId		= $user_data['g_id'];
			$this->GroupName	= $user_data['g_name'];
			$this->UNick		= !empty($user_data['unick']) ? $user_data['unick'] : $user_data['uname'];
			$this->Motto		= $user_data['motto'];
		    $this->user_access	= isset($user_data['user_access']) ? $user_data['user_access'] : '';
            $this->IsAdmin      = $user_data['is_admin'] == 1 ? TRUE : FALSE; 
            $this->UPoint       = $user_data['upoint']; 
            $this->Article      = $user_data['article']; 
		}
        // token
        if (isset($_COOKIE['token'])) 
        {
            $this->token = $_COOKIE['token'];
    	}
    }
    /**
     * 生成密码
     * @access	public
     * @param string $username  真实姓名，可作为登录的凭证
     * @param string $password
     * @return string
     */
    public static function make_pwd($password) {
        
        return md5(self::PWD_PREFIX . $password);
    }
    
    /**
     * 生成会话
     * @access	public
     * @param mixed $uid
     * @return string
     */
    public static function make_token($uid) {
        
        return strtoupper(md5(self::USR_COOKIE_KEY . $uid) . md5(time())) . '==/';
    }

    /**
     * 登录检测
     * @access	public
     * @param string $name  真实姓名或员工号
     * @param string $password
     * @return int  小于0表示有异常，
     */
    public function login($name, $password, $is_admin = FALSE, $field = 'a.uname') {
        
        $where = " {$field} = '{$name}'";
        $sql = "SELECT a.*, b.g_name, b.g_urank, b.g_state, b.is_admin_g, b.id AS g_id FROM {$this->user_table_name} AS a LEFT JOIN {$this->group_table_name} AS b ON b.id = a.group_id WHERE {$where} LIMIT 1";

        $query = $this->_ci->db->query($sql);
        
        if ($query->num_rows() == 0) {
            return -1;//无此用户
        }
		
        if ($query->row()->upass != self::make_pwd($password)) {
            return -2;//密码错误
        }
        
        if ($query->row()->g_state == 1) {
            return -3;//所在组被禁用
        }
        
        if ($query->row()->ustate == 1) {
            return -4;//用户被禁用
        }
        
        if($is_admin){
            if($query->row()->is_admin != 1){
                return -5;
            }
        }
        
        return $query->row()->id;
    }
    
    /**
     * 更新认证
     * @access  public
     * @param int $uid
     * @param int $time 认证有效期，单位：秒
     * @return mixed 成功返回token，失败返回false
     * 
     */
    public function update($uid, $time = 0) 
    {
        if ($time <= 0) {
            $time = 3600;//30分钟内不用登录
        }
        
        if (headers_sent()) {
            throw new Exception('your page has output, do not set cookie for auth.');
        }
        
        $sql = "SELECT a.*, b.g_name, b.g_urank, b.g_state, b.is_admin_g, b.id AS g_id FROM {$this->user_table_name} AS a LEFT JOIN {$this->group_table_name} AS b ON b.id = a.group_id WHERE a.id = {$uid} LIMIT 1";

        $query = $this->_ci->db->query($sql);

        if ($query->num_rows() == 0) {
            return false;
        }
        
        $data = $query->row_array();
        
        $data['loginTime']      = time();
        $data['loginIp']        = $this->_ci->input->ip_address();
        $data['user_access'] = array_unique(explode(',', $data['rank'].",".$data['g_urank']));
    
        $token = self::make_token($data['uname']);
        
        $this->_ci->db->query("UPDATE {$this->user_table_name} SET `login_num` = `login_num` + 1 , last_login_ip='" . $data['loginIp'] . "', last_login_date=" . time() . ' WHERE id =' . $uid);
        
        setcookie('token', $token, time() + $time, '/');
        
        $this->token = $token;

        $this->set_access($data, $time);
        
        unset($data, $query);
        return TRUE;
    }
    
    public function wechat($data, $time = 0, $wechat_access = NULL)
    {
        if (!isset($data['openid'])) {return -1;}
        
        $openid = $data['openid'];
        $sql = "SELECT a.*, b.g_name, b.g_urank, b.g_state, b.is_admin_g, b.id AS g_id FROM {$this->user_table_name} AS a LEFT JOIN {$this->group_table_name} AS b ON b.id = a.group_id WHERE a.openid = '{$openid}' LIMIT 1";

        $query  = $this->_ci->db->query($sql);
        
        unset($sql);
        if ($this->_ci->db->affected_rows() > 0 )
        {
            //更新用户
            $session_data = $query->row_array();
            $user_info = array(
                //'openid'        => $data['openid'],
                'unionid'         => isset($data['unionid']) ? $data['unionid'] : '',
                'uname'           => isset($data['nickname']) ? $data['nickname'] : '',
                'province'        => isset($data['province']) ? $data['province'] : '',
                'city'            => isset($data['city']) ? $data['city'] : '',
                'area'            => isset($data['country']) ? $data['country'] : '',
                'uavatar'         => isset($data['headimgurl']) ? $data['headimgurl'] : '',
                'last_login_date' => time(),
                'last_login_ip'   => $this->_ci->input->ip_address(),
                // 'login_num'       => `login_num` + 1,
            );
            $this->_ci->db->update($this->user_table_name, $user_info, array('id' => $session_data['id']));
        }else
        {
            //添加用户
            $user_info = array(
                'openid'     => $data['openid'],
                'unionid'    => isset($data['unionid']) ? $data['unionid'] : '',
                'uname'      => isset($data['nickname']) ? $data['nickname'] : '',
                'province'   => isset($data['province']) ? $data['province'] : '',
                'city'       => isset($data['city']) ? $data['city'] : '',
                'area'       => isset($data['country']) ? $data['country'] : '',
                'uavatar'    => isset($data['headimgurl']) ? $data['headimgurl'] : '',
                'reg_date'   => time(),
                'reg_ip'     => $this->_ci->input->ip_address(),
                'group_id'   => 5 // 5 = 微信用户
                //'expire_time'   => time()
            );
            $this->_ci->db->insert($this->user_table_name, $user_info);
            
            $insert_id  = $this->_ci->db->insert_id();
            
            $session_data                   = $user_info;
            $session_data['id']             = $insert_id;
            $session_data['access_token']   = isset($wechat_access['access_token']) ? $wechat_access['access_token'] : '';
            
            unset($user_info, $wechat_access);
        }
        
        $token = self::make_token($session_data['uname']);
        
        setcookie('token', $token, time() + $time, '/');
        
        $this->token = $token;
        
        $this->set_access($session_data, $time);
        
        unset($data, $query, $user_info);
        return TRUE;
    }
    
    /**
     * 设置登录信息
     * 
     * @param type $data
     * @param type $time
     */
    public function set_access($data, $time)
    {
        switch ($this->cache_type){
            case 1:
                $this->set_session($data);
                break;
            case 2:
                $this->set_redis($data, $time);
                break;
        }
    }
    
    /**
     * 获取登录信息
     */
    public function get_access()
    {
        $data = array();
        switch ($this->cache_type){
            case 1:
                $data = $this->get_session();
                break;
            case 2:
                $data = $this->get_redis();
                break;
        }
        return $data;
    }

    /**
     *  设置redis信息
     * @param type $data
     */
    public function get_redis()
    {
        return $this->_ci->tz_redis->get($this->token);
    }
    
    /**
     * 设置session信息
     * 
     * @param type $data
     * @return boolean
     */
    public function get_session()
    {
        return $this->_ci->session->userdata('userinfo');
    }
    
    /**
     *  设置redis信息
     * @param type $data
     */
    public function set_redis($data, $time)
    {
        $this->_ci->tz_redis->set($this->token, $data, $time);
        
        return TRUE;
    }
    
    /**
     * 设置session信息
     * 
     * @param type $data
     * @return boolean
     */
    public function set_session($data)
    {
        $this->_ci->session->set_userdata(array('userinfo' => $data));
        unset($data);
        return TRUE;
    }

    /**
     * 检测是否有效访问指定的模块
     *
     * @access  public
     * @param string $module_identity
     * @return mixed 成功返回true，失败返回负数
     */
    public function check_authority($module_identity = '')
    {
        if ($this->token == NULL) {
            return FALSE; //没有指定token
        }
        
        if (!$this->user_access) {
            return FALSE;//不存在用户
        }
        
        //超级管理员权限
        if (in_array('SUPER', $this->user_access)){
			
            return TRUE;
        }
        
        if (in_array($module_identity, $this->user_access)) {
            return TRUE;
        }
        
        return FALSE;//无效的访问
    }

	/**
     * 取得当前的token
     *
     * @access  public
     * @return string
     */
    public function get_token() {
        
        return $this->token;
    }
    
    /**
     * 检查用户登录状态是否有效
     * @access public
     * @return boolean
     */
    public function check_login()
    {
        $user_info = $this->get_access();
        if (empty($user_info)){return FALSE;}
       
        return TRUE;
    }
    
    /**
     * 退出登录
     * 
     * @return type
     */
    public function logout()
    {
        $status = FALSE;
        switch ($this->cache_type){
            case 1:
                session_destroy();
                $status = TRUE;
                break;
            case 2:
                $this->_ci->tz_redis->del($this->token);
                $status = TRUE;
                break;
        }
        
        return $status;
    }

	/**
	 * __get()
	 */
	public function __get($property_name)
	{
		if (isset($this->$property_name))
		{
			return $this->$property_name;
		}
		else
		{
			return NULL;
		}
	}
}

/* End of file TZ_User.php */
/* Location: ./application/libraries/TZ_User.php */

