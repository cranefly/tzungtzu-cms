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
 * Resources Controller
 *
 * @package     TzungTzu
 * @subpackage  Controller
 * @category    Controller
 * @author      Tz Dev Team
 */
class Resources extends Master_Controller
{
	public $LangPath 		= 'extends/resources';
	
	public $ViewPath 		= 'extends/resources';
	
	public $PagePath 		= 'webmaster/extends/resources';

	public $ActionModelKey 		= 'resource';
	
	public $ActionModelName		= 'resource';
	
	public $menu_id 		= 'E';
	
	public $nav_item 		= 'E09';
	
	public $is_search 		= TRUE;
	
	// tz vars 类生成的自定义字段使用
	public $vars = array(
		'search'=>array(
			array('txt'=>'form_oname',  'value'=>'oname',  	'color'=>''),
			array('txt'=>'form_url', 	'value'=>'url', 	'color'=>'')
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

		$this->resource->set_order_mode($sort_field, $sort_mode);
		$this->resource->page($p);

		unset($sort_field, $sort_mode);

		$lists 		= $this->resource->lists($params);
		
		$total 		= $this->resource->total($params);
		
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

/* End of file Resources.php */
/* Location: ./application/webmaster/extends/Resources.php */