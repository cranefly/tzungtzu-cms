<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  TzungTzu CMS
 *
 *  后台首页
 *
 * @package     TzungTzu
 * @author      TZ Dev Team
 * @copyright   Copyright (c) 2012-2024, TzungTzu.com.
 * @license     http://tzungtzu.com/doucmentss/license.html
 * @link        http://tzungtzu.com/
 * @since       Version 1.0.0
 */

/**
 * Home Controller
 *
 * @package     TzungTzu
 * @subpackage  Controller
 * @category    Controller
 * @author      Tz Dev Team
 */
class Home extends Master_Controller
{
	public $LangPath 			= 'home';
	
	public $ViewPath 			= 'home';
	public $phpinfo_view_path 	= 'setting/phpinfo';
	
	public $PagePath 			= 'webmaster/home';

	public $menu_id 			= 'A';
	
	public $nav_item 			= 'A01';
	
	public function __construct()
	{
		parent::__construct();

		$this->ControllerTitle = $this->lang_current['controller_title'];
	}

	/**
	 * 管理首页
	 * @access public
	 * @return  void
	 */
	public function index()
	{
		$data = array(
			'upload_size' 		=>  ini_get('upload_max_filesize'),
			'operating_system' 	=> PHP_OS,
			'browser' 			=> get_browser_name() . ' ' . get_browser_version(),
			'php_work' 			=> php_sapi_name(),
			'php_version' 		=> PHP_VERSION,
			'ci_version' 		=> CI_VERSION,
			'server_translate' 	=> $_SERVER['SERVER_SOFTWARE'],
			'server_language' 	=> $_SERVER['HTTP_ACCEPT_LANGUAGE'],
			'server_host' 		=>  $_SERVER['HTTP_HOST'],
			'server_time' 		=> date('Y-m-d H:i:s',time()),
			'database_platform' => $this->db->platform(),
			'database_version' 	=> $this->db->version(),
		);
		
		$this->render_admin($this->ViewPath,$data);
		unset($data);
	}

	/**
	 * phpinfo view
	 * 
	 * @access public
	 * @return  void
	 */
	public function phpinfo()
	{
		$this->render_admin($this->phpinfo_view_path);
	}
}

/* End of file Home.php */
/* Location: ./application/webmaster/Home.php */