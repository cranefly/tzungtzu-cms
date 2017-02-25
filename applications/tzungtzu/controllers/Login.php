<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * FengXiang
 *
 * @package     FengXiang
 * @author      HuiWeiShang Dev Team
 * @copyright   Copyright (c) 2012-2024, www.huiweishang.com.
 * @license     http://huiweishang.com/doucmentss/license.html
 * @link        http://huiweishang.com/
 * @since       Version 1.0.0
 */
// ------------------------------------------------------------------------

/**
 * Login Class
 * 登录控制器
 * @package	FengXiang	
 * @subpackage	Library
 * @category	Login
 * @author		Hayden
 */
class Login extends Base_Controller{

    public $ViewPath = 'login';
    
    public $LangPath = 'login';
    public $HomePagePath = 'webmaster/home';
    public $PagePath = 'login';
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * 登录页面
     */
    public function index()
    {
        // 如果登录。直接跳转到首页
        if ($this->tz_user->check_login()){
            redirect(base_url('manage/home'));
        }
        $this->ControllerTitle = '用户登录';
        $this->render_view($this->ViewPath . '/login');
    }

    /**
     * 执行登录操作
     */
    public function do_login()
    {
        $name 		= $this->get_data('uname');
		$pwd 		= $this->get_data('upass');
		$remember 	= intval($this->get_data('remember'));
        
        $field = $this->_mobile_email($name);
        $field_str = 'a.uname';
        if ($field == 1){$field_str = 'a.uphone';}
        if ($field == 2){$field_str = 'a.uemail';}
		$rs 		= $this->tz_user->login($name, $pwd, FALSE, $field_str);
		//var_dump($rs);
		if ($rs > 0)
		{
            $time = 3600;
			//记住密码一个月
			if ($remember == 1)
			{
				$time = 2592000;
			}

			$this->tz_user->update($rs, $time);
			unset($rs);
			$this->print_json(array('state'=>0, 'title'=>'' ,'message'=>'', 'url'=> base_url($this->HomePagePath)));
		}
		
		$info = array(
			-1 => 'login_user_notfound',
			-2 => 'login_pwd_error',
			-3 => 'login_role_deny',
			-4 => 'login_user_deny',
			-5 => 'is_not_admin',
			0  => 'login_error_detail',
		);
		// print_r($this->lang_current);
		$this->print_state(100, $this->lang_current['login_error'], $this->lang_current[$info[$rs]]);
    }

    /**
     * 微信登录入口
     * 通过code来获取到access_token 进行登录
     * @access public
     * @return void
     */
    public function wechat()
    {
        $redirect_uri = base_url('login/access_token');
        redirect($this->wechat_obj->getOauthRedirect($redirect_uri));
        exit();
    }
    
    /**
     * 获取openid等信息，并且刷新票据
     * @access public 
     * @return void
     */
    public function access_token()
    {    
        $access = $this->wechat_obj->getOauthAccessToken();
        $_refer =  ''; //$this->get_data('refer');
        if($access){
            $refresh    = $this->wechat_obj->getOauthRefreshToken($access['refresh_token']);
            
            //获取用户信息
            $user_info  = $this->wechat_obj->getOauthUserinfo($access['access_token'], $access['openid']);
            
            $time       = 0;
            if ($refresh)
            {
                $time = 2592000;
            }
            
            $user_id = $this->user->update_userinfo($user_info);
            
            unset($user_info);
            
            if ($user_id > 0){
                $this->user->update($user_id, $time);
            }
            //跳转到来源地址
            if (empty($_refer))
            {
                $_refer = $this->session->userdata('referer');
            }
            $referer = !empty($_refer) ? $_refer : base_url('mall/goods/lists');  
            redirect($referer);
        }
        
        unset($access);
    }
    
    /**
     * 接口代用微信的登录获取到用户的openid和unionid
     * 主要用户网页端使用
     */
    public function api_auth()
    {
        $redirect_uri = HOST_NAME . '/login/api_accesstoken';
        redirect($this->_wechat->getOauthRedirect($redirect_uri, '', 'snsapi_userinfo'));
        exit();
        
    }
    
    /**
     * 微信回调地址，直接输出响应的openid和unionid给请求接口使用
     */
    public function api_accesstoken()
    {
        $access = $this->_wechat->getOauthAccessToken();
        if ($access)
        {
            $this->print_json(array('status'=> '0', 'data' => $access));
        }
        
        $this->print_json(array('status' => 1, 'data' => array()));
    }

    /**
     * 退出
     */
    public function logout()
    {
        if ($this->tz_user->logout())
        {
            redirect(base_url('login'));
        }
        
    }
    
    public function makepwd()
    {
        $pwd = $this->get_data('password');
        
        echo($this->user->make_pwd($pwd));
        die();
    }
    
    
    /**
     * 判断字符串是邮箱还是手机号或者都不是
     * @param type $str
     */
    private function _mobile_email($str)
    {
        $this->load->library('TZ_Validation');
        
        
        if ($this->tz_validation->check_phone($str))
        {
            return 1;
        }
        
        if ($this->tz_validation->check_email($str))
        {
            return 2;
        }
        
        return FALSE;
    }
}

/* End of file Login.php */
/* Location: ./applications/controllers/Login.php */
