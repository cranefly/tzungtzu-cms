<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * 用户组管理
 *
 * @package     TzungTzu
 * @author      TZ Dev Team
 * @copyright   Copyright (c) 2012-2024, TzungTzu.com.
 * @license     http://tzungtzu.com/doucmentss/license.html
 * @link        http://tzungtzu.com/
 * @since       Version 1.0.0
 */

/**
 * UGroup Controller
 *
 * @package     TzungTzu
 * @subpackage  Controller
 * @category    Controller
 * @author      Tz Dev Team
 */
class UGroup extends Master_Controller
{
	public $LangPath 		= 'accounts/user_group';
	
	public $ViewPath 		= 'accounts/ugroup';
	
	public $PagePath 		= 'webmaster/accounts/ugroup';
	public $PagePathUser	= 'webmaster/accounts/users';
	public $RankPath		= 'webmaster/accounts/rank';
	
	public $ActionModelKey 		= 'ugroup';
	
	public $ActionModelName		= 'ugroup';

	public $menu_id 		= 'B';
	
	public $nav_item 		= 'B01';
	
	public $is_search 		= TRUE;

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

		$this->ugroup->set_order_mode($sort_field, $sort_mode);
		$this->ugroup->page($p);

		unset($sort_field, $sort_mode);

		$lists 		= $this->ugroup->lists($params);
		
		$total 		= $this->ugroup->total($params);
		
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
	public function edit()
	{
	}
	
	public function get_detail_ajax()
	{
		$id = $this->get_data('id');
		
		$res = $this->action_model->find($id);
		
		if (!empty($res))
		{
			$data = array(
				'state'		=> 0,
				'message'	=>'', 
				'data'		=> $res
			);
			$this->print_json($data);
		}else{
			$data = array(
				'state'		=> 1,
				'message'	=>'', 
			);
			$this->print_json($data);
		}
	}
}

/* End of file UGroup.php */
/* Location: ./application/webmaster/accounts/UGroup.php */