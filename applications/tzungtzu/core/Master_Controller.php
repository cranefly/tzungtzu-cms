<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * 管理后台控制器，会验证登录状态，如果没有登录就不能访问
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
 * Master Class
 *
 * @package		TzungTzu
 * @subpackage	Core
 * @category	Core
 * @author		TZ Dev Team
 */
class Master_Controller extends Base_Controller
{
	// is have search
	protected $is_search 	= FALSE;
		
	public $menu_id 		= 'B';
	
	public $nav_item 		= 'B01';
	
	// action model
	public $action_model 	= NULL;
	
	public $vars 			= array();

	private $_lang_web 		= NULL;
    private $WebLang        = 'system/webmaster';
    
    protected $webmaster = 'webmaster';
    
    public function __construct()
	{
		parent::__construct();

		$is_login = $this->tz_user->check_login();
        $is_admin = $this->tz_user->IsAdmin;
		if (!$is_login && !$is_admin)
		{
			redirect(base_url("login"));
			exit;
		}
       
        $this->load->library('TZ_NavPanel');
	}

	/**
	 * 加载页面
	 * @access public
	 * @param string $view
	 * @param array $data
	 * @return void 
	 */
	public function render_admin($view, $data = array())
	{
		//导航菜单
		$menus = TZ_NavPanel::getInstance()->get_menus($this->menu_id, $this->nav_item);
		
		//页面基础数据
		$base_data = array(
			'langco' 	=> $this->lang_common,
			'langcu' 	=> $this->lang_current,
			'page_path' => $this->PagePath,
			'tz' 		=> $this,
		);
		
		// view data
		$view_data  = array_merge($data, $this->render_data, $base_data);
		unset($base_data, $this->render_data, $data);
		
		//view html
		$view_html 	= $this->load->view("{$this->webmaster}/{$view}", $view_data, true);
		unset($view_data);
		
        $this->lang->load($this->WebLang, 'chinese');
        $this->_lang_web = $this->lang->language;
		//frame data
		$frame_data = array(
			'controller_title' 	=> $this->ControllerTitle,
            'main_content' 		=> $view_html,
            'items' 			=> $menus,
            'tz' 				=> $this,
			'is_search' 		=> $this->is_search,
			'langweb' 			=> $this->_lang_web,
            'js'				=> implode("\r\n", $this->css_js['js']),
            'css'				=> implode("\r\n", $this->css_js['css']),
            //'header' => implode("\r\n", $this->frontFile['header']),
        );
		 
		// load frame
        $this->load->view("{$this->webmaster}/frame", $frame_data);

		unset($menus, $frame_data, $this, $view_html);
	}
}

/* End of file Master_Controller.php */
/* Location: ./application/core/Master_Controller.php */