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
 * Comments Controller
 * 评论管理
 * @package     TzungTzu
 * @subpackage  Controller
 * @category    Controller
 * @author      Tz Dev Team
 */
class Comments extends Master_Controller
{
	public $LangPath 		= 'extends/comments';
	
	public $ViewPath 		= 'extends/comments';
	
	public $PagePath 		= 'webmaster/extends/comments';

	public $ActionModelKey 		= 'comment';
	
	public$ActionModelName		= 'comment';
		
	public $menu_id 		= 'E';
	
	public $nav_item 		= 'E08';
	
	public $is_search 		= TRUE;
	
	// tz vars 类生成的自定义字段使用
	public $vars = array(
		'search'=>array(
			array('txt'=>'form_content',  'value'=>'content',  	'color'=>''),
			array('txt'=>'form_uname', 	 'value'=>'uname', 		'color'=>''),
			array('txt'=>'form_ip', 		 'value'=>'ip', 			'color'=>'')
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

		$this->comment->set_order_mode($sort_field, $sort_mode);
		$this->comment->page($p);

		unset($sort_field, $sort_mode);

		$lists 		= $this->comment->lists($params);
		
		$total 		= $this->comment->total($params);
		
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
		$data = $this->flinks->find(intval($this->get_data('id')));

		$this->render_admin("{$this->ViewPath}/detail", $data);
		unset($data);
	}
}

/* End of file Comments.php */
/* Location: ./application/webmaster/extends/Comments.php */