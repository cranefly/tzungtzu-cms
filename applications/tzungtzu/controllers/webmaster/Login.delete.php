<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  TzungTzu CMS
 *
 *  后台登录
 *
 * @package     TzungTzu
 * @author      TZ Dev Team
 * @copyright   Copyright (c) 2012-2024, TzungTzu.com.
 * @license     http://tzungtzu.com/doucmentss/license.html
 * @link        http://tzungtzu.com/
 * @since       Version 1.0.0
 */

/**
 * Login Controller
 *
 * @package     TzungTzu
 * @subpackage  Controller
 * @category    Controller
 * @author      Tz Dev Team
 */
class Login extends TZ_Controller
{

	public $LangPath 		= 'login';
	
	public $ViewPath 		= 'webmaster/login';
	
	public $PagePath 		= 'webmaster/login';
	public $HomePagePath 	= 'webmaster/Home';


	public function __construct()
	{

		parent::__construct();
		$this->load->library('TZ_User');
	}

	/**
	 *  如果没有登录就到登录页面，如果登录了就到管理首页
	 *  默认登录账号和密码：webmaster webmaster 56263ab2ca50c045a1b6c8ec81306d05  超级权限标识：SUPER
	 * @access public
	 * @return  void
	 */
	public function index()
	{
		//die($this->tz_user->make_pwd('webmaster'));
		$is_login = $this->tz_user->check_login();
		if ($is_login)
		{
			redirect(base_url("{$this->webmaster}/home"));
			exit;
		}
		
		$data = array(
            'tz'        => $this,
			'langco' 	=> $this->lang_common,
			'langcu' 	=> $this->lang_current,
		);
		$this->load->view($this->ViewPath,$data);
		unset($data);
	}

	/**
	 * 执行登录
	 *
	 * @access public
	 * @return  void
	 */
	public function do_login()
	{
		$name 		= $this->get_data('uname');
		$pwd 		= $this->get_data('upass');
		$remember 	= intval($this->get_data('remember'));
        
        $field = $this->mobile_email($name);
        $field_str = 'a.uname';
        if ($field == 1){$field_str = 'a.uphone';}
        if ($field == 2){$field_str = 'a.uemail';}
        
		$rs 		= $this->tz_user->login($name, $pwd, TRUE, $field_str);
		//var_dump($rs);
		if ($rs > 0)
		{
 			//记住密码一个月
			if ($remember == 1)
			{
				$time = 2592000;
			}

			$this->tz_user->update($rs, $time);
			unset($rs);
			$this->print_json(array('state'=>0, 'title'=>'' ,'message'=>'', 'url'=>  site_url($this->HomePagePath)));
		}
		
		$info = array(
			-1 => 'login_user_notfound',
			-2 => 'login_pwd_error',
			-3 => 'login_role_deny',
			-4 => 'login_user_deny',
			-5 => 'is_not_admin',
			0  => 'login_error_detail',
		);
		
		$this->print_state(100, $this->lang_current['login_error'], $this->lang_current[$info[$rs]]);
	}

	/**
	 * 退出登录
	 *
	 * @access public
	 * @return  void
	 */
	public function login_out()
	{

		$this->tz_user->logout();

		redirect(site_url("{$this->webmaster}/login"));
		exit();
	}

}

/* End of file Login.php */
/* Location: ./application/webmaster/Login.php */