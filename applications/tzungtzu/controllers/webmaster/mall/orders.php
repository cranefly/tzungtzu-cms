<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * @package     TzungTzu
 * @author      TZ Dev Team
 * @copyright   Copyright (c) 2012-2024, TzungTzu.com.
 * @license     http://tzungtzu.com/doucmentss/license.html
 * @link        http://tzungtzu.com/
 * @since       Version 1.0.0
 */

/**
 * Flinks Controller
 * 订单管理
 * @package     TzungTzu
 * @subpackage  Controller
 * @category    Controller
 * @author      Tz Dev Team
 */
class Orders extends Master_Controller
{
	public $LangPath 		= 'mall/order';
	
	public $ViewPath 		= 'mall/orders';
	
	public $PagePath 		= 'webmaster/mall/orders';

	public $ModelPath 		= 'mall/order';
	
	public $ModelName		= 'order';
	
	public $menu_id 		= 'F';
	
	public $nav_item 		= 'F01';
	
	public $is_search 		= TRUE;
	
	// tz vars 类生成的自定义字段使用
	public $vars = array(
		'search'=>array(
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

		$this->order->set_order_mode($sort_field, $sort_mode);
		$this->order->page($p);

		unset($sort_field, $sort_mode);

		$lists 		= $this->order->lists($params);
		
		$total 		= $this->order->total($params);
		
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
	 * detail page 
	 *
	 * @access public
	 * @return void
	 */
	public function detail()
	{
	}
}

/* End of file Orders.php */
/* Location: ./application/webmaster/mall/Orders.php */