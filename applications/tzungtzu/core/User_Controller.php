<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * 用户中心控制器，会验证登录状态，如果没有登录就不能访问
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
 * Userbase Class
 *
 * @package		TzungTzu
 * @subpackage	Core
 * @category	Userbase
 * @author		TZ Dev Team
 */
class User_Controller extends Base_Controller
{	
    public $web_dir = 'manage';
    
    private $_lang_web = NULL;
    
    public function __construct()
	{
        parent::__construct();
        // 检测登录
        $is_login = $this->tz_user->check_login();
		if (!$is_login)
		{
			redirect(base_url("login"));
			exit;
		}
        
        $this->load_model('mywechat');

        $uuid = $this->get_data('uuid');
        if (!empty($uuid)){
            $this->mywechat->create($uuid, 'uuid', 'id, uuid');
            unset($uuid);
        }
	}
    
    /**
     * 加载frame模板
     * 
     * @param type $view
     * @param type $data
     */
    public function render_frame($view, $data = array())
    {
		//页面基础数据
		$base_data = array(
			'langco' 	=> $this->lang_common,
			'langcu' 	=> $this->lang_current,
			'page_path' => $this->PagePath,
			'tz' 		=> $this,
		);
		//print_r($menus);
		// view data
		$view_data  = array_merge($data, $this->render_data, $base_data);
		unset($base_data, $this->render_data, $data);
		
		$view_html 	= $this->load->view($this->get_tpl_name($view), $view_data, true);
		unset($view_data);
		
		//frame data
		$frame_data = array(
            'main_content' 		=> $view_html,
            'tz' 				=> $this,
			'controller_title' 	=> $this->ControllerTitle,
			'langweb' 			=> $this->_lang_web,
            'js'				=> implode("\r\n", $this->css_js['js']),
            'css'				=> implode("\r\n", $this->css_js['css']),
        );
		 
		// load frame
        $this->load->view($this->get_tpl_name('frame'), $frame_data);

		unset($frame_data, $this, $view_html);
    }
    
}

/* End of file User_Controller.php */
/* Location: ./application/core/User_Controller.php */