<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * 用户管理
 *
 * @package     TzungTzu
 * @author      TZ Dev Team
 * @copyright   Copyright (c) 2012-2024, TzungTzu.com.
 * @license     http://tzungtzu.com/doucmentss/license.html
 * @link        http://tzungtzu.com/
 * @since       Version 1.0.0
 */

/**
 * Users Controller
 *
 * @package     TzungTzu
 * @subpackage  Controller
 * @category    Controller
 * @author      Tz Dev Team
 */
class Users extends Master_Controller
{
	public $LangPath 		= 'accounts/users';
	
	public $ViewPath 		= 'accounts/users';
	
	public $PagePath 		= 'webmaster/accounts/users';
	public $GroupPagePath	= 'webmaster/accounts/ugroup';
	public $UploadPath		= 'webmaster/upload/avatar';
	public $RankPath		= 'webmaster/accounts/rank';
	
	public $ActionModelKey 		= 'users';
	
	public $ActionModelName		= 'users';
	
	public $GroupModelPath 	= 'ugroup';
	
	public $menu_id 		= 'B';
	
	public $nav_item 		= 'B02';
	
	public $is_search 		= TRUE;
	
	// tz vars 类生成的自定义字段使用
	public $vars = array(
		'search'=>array(
			array('txt'=>'form_uname',  'value'=>'uname',  'color'=>''),
			array('txt'=>'form_uemail', 'value'=>'uemail', 'color'=>''),
			array('txt'=>'form_uphone', 'value'=>'uphone', 'color'=>''),
			array('txt'=>'form_uqq',    'value'=>'uqq',    'color'=>''),
        )
	);

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
		$p 			= $this->get_data('p');
		$sort_field = $this->get_data('sort_field');
		$sort_mode 	= $this->get_data('sort_mode');
		
		$params = array(
			'stype' 	=> $this->get_data('stype'),
			'svalue' 	=> $this->get_data('svalue')
		);

		$this->users->set_order_mode($sort_field, $sort_mode);
		$this->users->page($p);

		unset($sort_field, $sort_mode);

		$lists 		= $this->users->lists($params);
		
		$total 		= $this->users->total($params);
		
		$pagecode 	= $this->get_page_link($this->PagePath, $total, $params);

		$data = array(
			'lists' 	=> $lists,
			'pagecode' 	=> $pagecode
		);
		unset($lists, $pagecode, $total, $params);
		
		$this->render_admin("{$this->ViewPath}/list",$data);
		unset($data);
	}

	/**
	 * add page 
	 *
	 * @access public
	 * @return void
	 */
	public function add()
	{
		$this->upload_css_js();
		$data['groups'] = $this->_get_group();
		
		$this->render_data($data);
		unset($data);
		parent::add();
	}

	/**
	 * edit page 
	 *
	 * @access public
	 * @return void
	 */
	public function edit()
	{
		$this->upload_css_js();
		
		$data['data'] = $this->users->find($this->get_data('id'), 'a.id');
		$data['groups'] = $this->_get_group();
		
		$this->render_admin($this->ViewPath . '/edit', $data);
        unset($data);
	}

	/**
	 * 保存用户信息 编辑和添加共用一个入口
	 *
	 * @access public
	 * @return void
	 */
	public function  save()
	{
		$this->load_model($this->GroupModelPath);
		
		$id				= $this->get_data('id');
		$data			= $this->get_data('data');
		
		$data['upass']	= trim($data['upass']);
		
		//处理密码
		if (isset($data['upass']) && !empty($data['upass']))
		{
			$data['upass'] = $this->tz_user->make_pwd($data['upass']);
		}  else
		{
			unset($data['upass']);
		}
		
		//处理系统管理标识，集成组的is_admin_g
		$group = $this->ugroup->find($data['group_id'], 'id', 'is_admin_g');
		$data['is_admin'] = $group['is_admin_g'];
		
		$this->save_data($data, $id);
	}

	/**
	 * 获取用户组
	 * 
	 * @access public
	 * @return array
	 *
	 */
	private function _get_group()
	{
		$this->load_model($this->GroupModelPath);

		return $this->ugroup->get_all('id, g_name');
	}
	
	/**
	 * detail page 
	 *
	 * @access public
	 * @return void
	 */
	public function detail()
	{
		$data = $this->users->find(intval($this->get_data('id')));

		$this->render_admin("{$this->ViewPath}/detail", $data);
		unset($data);
	}
}

/* End of file Users.php */
/* Location: ./application/webmaster/accounts/Users.php */