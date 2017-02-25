<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * 友链组管理
 *
 * @package     TzungTzu
 * @author      TZ Dev Team
 * @copyright   Copyright (c) 2012-2024, TzungTzu.com.
 * @license     http://tzungtzu.com/doucmentss/license.html
 * @link        http://tzungtzu.com/
 * @since       Version 1.0.0
 */

/**
 * Flinkg Controller
 *
 * @package     TzungTzu
 * @subpackage  Controller
 * @category    Flinkg
 * @author      Tz Dev Team
 */
class Flinkg extends Master_Controller
{
	public $LangPath 		= 'extends/flinkg';
	
	public $ViewPath 		= 'extends/flinkg';
	
	public $PagePath 		= 'webmaster/extends/flinkg';
    public $FlinkPagePath   = 'webmaster/extends/flinks';
    
    public $ActionModelKey 		= 'flinkg';
	
	public $ActionModelName		= 'flinkg';

	public $menu_id 		= 'E';
	
	public $nav_item 		= 'E01';
	
	public $is_search 		= TRUE;

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

		$this->flinkg->set_order_mode($sort_field, $sort_mode);
		$this->flinkg->page($p);

		unset($sort_field, $sort_mode);

		$lists 		= $this->flinkg->lists($params);
		
		$total 		= $this->flinkg->total($params);
		
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

/* End of file Flinkg.php */
/* Location: ./application/webmaster/extends/Flinkg.php */