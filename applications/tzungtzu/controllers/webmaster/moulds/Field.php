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
 * Field Controller
 * 字段管理
 * @package     TzungTzu
 * @subpackage  Controller
 * @category    Field
 * @author      Tz Dev Team
 */
class Field extends Master_Controller
{
	public $LangPath 		= 'moulds/field';
	
	public $ViewPath 		= 'moulds/field';
	
	public $PagePath 		= 'webmaster/moulds/field';

	public $ActionModelKey 		= 'field';
	
	public $ActionModelName		= 'field';
	
	public $menu_id 		= 'D';
	
	public $nav_item 		= 'D02';
	
	public $is_search		= TRUE;
	// tz vars 类生成的自定义字段使用
	public $vars = array(
        'search' => array(
			array('txt'=>'form_title',      'value'=>'title',       'color'=>''),
			array('txt'=>'form_field',      'value'=>'field',       'color'=>''),
			array('txt'=>'form_antistop',   'value'=>'antistop',    'color'=>''),
			array('txt'=>'form_field_tag',  'value'=>'field_tag',   'color'=>'')
        ),
        
		'form_type' => array(
			array('txt'=>'view_input',    'value'=>'input',      'color'=>''),
			array('txt'=>'view_textarea', 'value'=>'textarea',   'color'=>''),
			array('txt'=>'view_radio',    'value'=>'radio',       'color'=>''),
			array('txt'=>'view_checkbox', 'value'=>'checkbox',       'color'=>''),
			array('txt'=>'view_select',   'value'=>'select',       'color'=>''),
			array('txt'=>'view_upload',   'value'=>'upload',     'color'=>''),
			array('txt'=>'view_edit',     'value'=>'editor',       'color'=>''),
			array('txt'=>'view_datepick',  'value'=>'datepick',       'color'=>'')
        ),
        'is_system' => array(
            array('txt'=>'view_system_0',     'value'=>'0',       'color'=>''),
            array('txt'=>'view_system_1',     'value'=>'1',       'color'=>'')
        ),
        'display' => array(
            array('txt'=>'view_display_0',     'value'=>'0',       'color'=>''),
            array('txt'=>'view_display_1',     'value'=>'1',       'color'=>'')
        ),
        'field_remark' => array(
            array('txt'=>'view_none',       'value'=>'0',       'color'=>''),
            array('txt'=>'view_not_empty',  'value'=>'1',       'color'=>''),
            array('txt'=>'view_numeric',    'value'=>'2',       'color'=>''),
            array('txt'=>'view_phone',      'value'=>'3',       'color'=>''),
            array('txt'=>'view_email',      'value'=>'4',       'color'=>''),
            array('txt'=>'view_identity',   'value'=>'5',       'color'=>''),
            array('txt'=>'view_qq',         'value'=>'6',       'color'=>''),
            array('txt'=>'view_bank',       'value'=>'7',       'color'=>'')
        ),
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
			'svalue' 	=> $this->get_data('svalue'),
		);

		$this->field->set_order_mode($sort_field, $sort_mode);
		$this->field->page($p);

		$lists 		= $this->field->lists($params);
		
		$total 		= $this->field->total($params);
		
		$params['sort_field'] = $sort_field;
		$params['sort_mode']  = $sort_mode;
		$pagecode 	= $this->get_page_link($this->PagePath, $total, $params);

		$data = array(
			'lists' 	=> $lists,
			'pagecode' 	=> $pagecode
		);
		unset($lists, $pagecode, $total, $params);
		
		$this->render_admin("{$this->ViewPath}/list",$data);
		unset($data);
	}
 
    public function save()
	{
		$this->load->helper('cookie');
		$data = $this->get_data('data');
		
		if (isset($data['field_tag'])){
			set_cookie('field_tag',$data['field_tag'],100);
		}
		
		parent::save();
	}
	
	public function add()
	{
		$this->load->helper('cookie');
		
		$field_tag = get_cookie('field_tag');
		
		$this->render_data(array('field_tag'=>$field_tag));
		parent::add();
	}
}

/* End of file Field.php */
/* Location: ./application/webmaster/moulds/Field.php */