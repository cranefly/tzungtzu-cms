<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * 友链
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
 *
 * @package     TzungTzu
 * @subpackage  Controller
 * @category    Controller
 * @author      Tz Dev Team
 */
class Flinks extends Master_Controller
{
	public $LangPath 		= 'extends/flinks';
	
	public $ViewPath 		= 'extends/flinks';
	
	public $PagePath 		= 'webmaster/extends/flinks';
	public $GroupPagePath	= 'webmaster/extends/flinkg';

	public $ActionModelKey 		= 'flink';
	
	public $ActionModelName		= 'flink';
	
	public $menu_id 		= 'E';
	
	public $nav_item 		= 'E02';
	
	public $is_search 		= TRUE;
	
	// tz vars 类生成的自定义字段使用
	public $vars = array(
		'search'=>array(
			array('txt'=>'form_flink_name',  'value'=>'flink_name',  	'color'=>''),
			array('txt'=>'form_flink_url', 	 'value'=>'flink_url', 		'color'=>''),
			array('txt'=>'form_owner', 		 'value'=>'owner', 			'color'=>'')
        )
	);

    private $upload_js  = array('tzwechat/libs/dropzone/dropzone.js');
    private $upload_css  = array('tzwechat/libs/dropzone/dropzone.css');
    
	public function __construct()
	{
		parent::__construct();
		
		$this->ControllerTitle = $this->lang_current['controller_title'];
        $this->add_js($this->upload_js);
        $this->add_css($this->upload_css);
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

        if(empty($sort_field)){$sort_field  = $this->flink->SortField;}
        if(empty($sort_mode)){ $sort_mode   = $this->flink->SortMode;}
        
		$this->flink->set_order_mode($sort_field, $sort_mode);
		$this->flink->page($p);

		unset($sort_field, $sort_mode);

		$lists 		= $this->flink->lists($params);
		
		$total 		= $this->flink->total($params);
		
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
        $group_id = $this->get_data('group_id');
		$data['groups'] = $this->_get_group();
		$data['group_id'] = $group_id;
		$this->render_data($data);
        
		unset($data, $group_id);
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
		$this->load_model('flinkg');

		return $this->flinkg->get_all('id, gname');
	}
	
	/**
	 * detail page 
	 *
	 * @access public
	 * @return void
	 */
	public function detail()
	{
		$data = $this->flinks->find(intval($this->get_data('id')));

		$this->render_admin("{$this->ViewPath}/detail", $data);
		unset($data);
	}
}

/* End of file Flinks.php */
/* Location: ./application/webmaster/extends/Flinks.php */