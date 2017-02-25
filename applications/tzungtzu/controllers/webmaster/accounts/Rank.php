<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * 权限管理
 *
 * @package     TzungTzu
 * @author      TZ Dev Team
 * @copyright   Copyright (c) 2012-2024, TzungTzu.com.
 * @license     http://tzungtzu.com/doucmentss/license.html
 * @link        http://tzungtzu.com/
 * @since       Version 1.0.0
 */

/**
 * Rank Controller
 *
 * @package     TzungTzu
 * @subpackage  Controller
 * @category    Controller
 * @author      Tz Dev Team
 */
class Rank extends Master_Controller
{
	public $LangPath 		= 'accounts/rank';
	
	public $ViewPath 		= 'accounts/rank';
	
	public $PagePath 		= 'webmaster/accounts/rank';

	public $ActionModelKey 		= 'rank';
	
	public $ActionModelName		= 'rank';
	
	public $menu_id 		= 'B';
	
	public $nav_item 		= 'B03';

	public function __construct()
	{
		parent::__construct();
		$this->add_js('webmaster/js/accounts.rank.js');
		$this->ControllerTitle = $this->lang_current['controller_title'];
		
		$this->load_model('users');
		$this->load_model('ugroup');
	}

	/**
	 * 首页
	 * @access public
	 * @return  void
	 */
	public function index()
	{ 
		$user_id	= $this->get_data('user_id');
		$group_id	= $this->get_data('group_id');
		
		$users		= $group = array(); 
		
		$authority	= '';
		//如果有id，获取到对应的权限
		if (is_numeric($group_id) && $group_id > 0)
		{
			$group		= $this->ugroup->get_all();
			$authority	= $this->ugroup->get_authority($group_id);
		}else
		{
			$users		= $this->users->get_admins();
			$authority	= $this->users->get_authority($user_id);
		}
		
		
		$data['menus']		= TZ_NavPanel::getInstance()->set_menus();
		$data['user_id']	= $user_id;
		$data['group_id']	= $group_id;
		$data['users']		= $users;
		$data['group']		= $group;
		$data['authority']	= $authority;
		
		unset($users, $group, $authority );
		
		$this->render_admin("{$this->ViewPath}/list",$data);
		unset($data);
	}
	
	
	/**
	 * 保存权限
	 * @access public 
	 * @return void
	 */
	public function save()
	{
		$rank		= $this->get_data('level');
		$user_id	= $this->get_data('user_id');
		$group_id	= $this->get_data('group_id');
		
		$res		= FALSE;
		$rank_str	= !empty($rank) ? implode(',', $rank) : '';
		
		if (is_numeric($user_id) && $user_id > 0)
		{
			$res = $this->users->update(array('rank' => $rank_str), $user_id);
		}
		
		if (is_numeric($group_id) && $group_id > 0)
		{
			$res = $this->ugroup->update(array('g_urank' => $rank_str), $group_id);
		}
		
		unset($rank, $user_id, $group_id, $rank_str);
		
		if ($res)
		{
			$this->print_state(0, $this->lang_common['oper_prompt'], $this->lang_current['view_update_success_message']);
		}  else
		{
			$this->print_state(1, $this->lang_common['oper_prompt'], $this->lang_current['view_update_fail_message']);
		}
	}
}

/* End of file Rank.php */
/* Location: ./application/webmaster/accounts/Rank.php */