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
 * Ads Controller
 *
 * 标签
 * 
 * @package     TzungTzu
 * @subpackage  Controller
 * @category    Ads
 * @author      Tz Dev Team
 */
class Tags extends Master_Controller
{
	public $LangPath 		= 'extends/tags';
	
	public $ViewPath 		= 'extends/tags';
	
	public $PagePath 		= 'webmaster/extends/tags';
	public $GroupPagePath	= 'webmaster/extends/tagg';

	public $ActionModelKey 		= 'tag';
	
	public $ActionModelName		= 'tag';
	
	public $menu_id 		= 'E';
	
	public $nav_item 		= 'E06';
	
	public $is_search 		= TRUE;
	
	// tz vars 类生成的自定义字段使用
	public $vars = array(
		'search'=>array(
			array('txt'=>'form_tag',     'value'=>'tag',  	'color'=>''),
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

		$this->tag->set_order_mode($sort_field, $sort_mode);
		$this->tag->page($p);

		unset($sort_field, $sort_mode);

		$lists 		= $this->tag->lists($params);
		
		$total 		= $this->tag->total($params);
		
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
		$data['groups'] = $this->_get_group();
		
		$this->render_data($data);
		unset($data);
		parent::edit();
	}

	/**
	 * 获取组
	 * 
	 * @access public
	 * @return array
	 *
	 */
	private function _get_group()
	{
		$this->load_model('tagg');

		return $this->tagg->get_all('id, gname');
	}
}

/* End of file Tags.php */
/* Location: ./application/webmaster/extends/Tags.php */