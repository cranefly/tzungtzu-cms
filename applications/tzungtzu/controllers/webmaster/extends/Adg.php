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
 * Adg Controller
 *
 * @package     TzungTzu
 * @subpackage  Controller
 * @category    Flinkg
 * @author      Tz Dev Team
 */
class Adg extends Master_Controller
{
	public $LangPath 		= 'extends/adg';
	
	public $ViewPath 		= 'extends/adg';
	
	public $PagePath 		= 'webmaster/extends/adg';
    
	public $ActionModelKey 		= 'adg';
	
	public $ActionModelName		= 'adg';

	public $menu_id 		= 'E';
	
	public $nav_item 		= 'E03';
	
	public $is_search 		= TRUE;

    // tz vars 类生成的自定义字段使用
	public $vars = array(
		'search'=>array(
			array('txt'=>'form_title',     'value'=>'ad_title',  	'color'=>''),
			array('txt'=>'form_identification',  'value'=>'identification', 	'color'=>'')
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

		$this->adg->set_order_mode($sort_field, $sort_mode);
		$this->adg->page($p);

		unset($sort_field, $sort_mode);

		$lists 		= $this->adg->lists($params);
		
		$total 		= $this->adg->total($params);
		
		$pagecode 	= $this->get_page_link($this->PagePath, $total, $params);

		$data = array(
			'lists' 	=> $lists,
			'pagecode' 	=> $pagecode
		);
		unset($lists, $pagecode, $total, $params);
		
		$this->render_admin("{$this->ViewPath}/list",$data);
		unset($data);
	}
}

/* End of file Adg.php */
/* Location: ./application/webmaster/extends/Adg.php */