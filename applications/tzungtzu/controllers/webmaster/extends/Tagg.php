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
 * Tagg Controller
 *
 * 标签组
 * 
 * @package     TzungTzu
 * @subpackage  Controller
 * @category    Flinkg
 * @author      Tz Dev Team
 */
class Tagg extends Master_Controller
{
	public $LangPath 		= 'extends/tagg';
	
	public $ViewPath 		= 'extends/tagg';
	
	public $PagePath 		= 'webmaster/extends/tagg';
    
	public $ActionModelKey 		= 'tagg';
	public $ActionModelName		= 'tagg';

	public $menu_id 		= 'E';
	
	public $nav_item 		= 'E05';
	
	public $is_search 		= TRUE;

    // tz vars 类生成的自定义字段使用
	public $vars = array(
		'search'=>array(
			array('txt'=>'form_gname',     'value'=>'gname',  	'color'=>''),
			array('txt'=>'form_remark',    'value'=>'remark', 	'color'=>'')
        )
	);
    
	public function __construct()
	{
		parent::__construct();
		$this->ControllerTitle = $this->lang_current['controller_title'];
        
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

		$this->tagg->set_order_mode($sort_field, $sort_mode);
		$this->tagg->page($p);

		unset($sort_field, $sort_mode);

		$lists 		= $this->tagg->lists($params);
		
		$total 		= $this->tagg->total($params);
		
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

/* End of file tagg.php */
/* Location: ./application/webmaster/extends/tagg.php */