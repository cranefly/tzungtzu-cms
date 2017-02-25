<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 *
 * @package     TzungTzu
 * @author      TZ Dev Team
 * @copyright   Copyright (c) 2012-2024, TzungTzu.com.
 * @license     http://tzungtzu.com/doucmentss/license.html
 * @link        http://tzungtzu.com/
 * @since       Version 1.0.0
 */

/**
 * Setted Controller
 *
 * @package     TzungTzu
 * @subpackage  Controller
 * @category    Controller
 * @author      Tz Dev Team
 */
class Setted extends Master_Controller
{
	public $LangPath 		= 'system/setted';
	
	public $ViewPath 		= 'system/setted';
	
	public $PagePath 		= 'webmaster/system/setted';
	
    public $ActionModelKey 		= 'setted';
	
	public $ActionModelName		= 'setted';
	
	public $menu_id 		= 'A';
	
	public $nav_item 		= 'A02';
	
	public $is_search 		= TRUE;
	
	// tz vars 类生成的自定义字段使用
	public $vars = array(
		'search'=>array(
			array('txt'=>'form_title',  'value'=>'title',  'color'=>''),
			array('txt'=>'form_ckey',   'value'=>'ckey',   'color'=>''),
			array('txt'=>'form_cvalue', 'value'=>'cvalue', 'color'=>''),
			array('txt'=>'form_tag',    'value'=>'tag',    'color'=>''),
        ),
		'form_type' => array(
			array('txt'=>'view_input',    'value'=>'input',      'color'=>''),
			array('txt'=>'view_textarea', 'value'=>'textarea',   'color'=>''),
			array('txt'=>'view_upload',   'value'=>'upload',     'color'=>''),
			array('txt'=>'view_edit',     'value'=>'editor',       'color'=>'')
        )
	);

	public function __construct()
	{
		parent::__construct();
		
		$this->ControllerTitle = $this->lang_current['controller_title'];
		$this->load->library('tz_fields');
        
        $this->upload_css_js();
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

		$this->setted->set_order_mode($sort_field, $sort_mode);
		$this->setted->page($p);

		unset($sort_field, $sort_mode);

		$lists 		= $this->setted->lists($params);
		
		$total 		= $this->setted->total($params);
		
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
		$data = $this->action_model->find(intval($this->get_data('id')));

		$this->render_admin("{$this->ViewPath}/detail", $data);
		unset($data);
	}
}

/* End of file Users.php */
/* Location: ./application/webmaster/accounts/Users.php */