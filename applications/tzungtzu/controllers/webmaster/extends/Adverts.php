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
 * Adverts Controller
 *
 * 广告
 * 
 * @package     TzungTzu
 * @subpackage  Controller
 * @category    Ads
 * @author      Tz Dev Team
 */
class Adverts extends Master_Controller
{
	public $LangPath 		= 'extends/adverts';
	
	public $ViewPath 		= 'extends/adverts';
	
	public $PagePath 		= 'webmaster/extends/adverts';
	public $GroupPagePath	= 'webmaster/extends/adg';

	public $ActionModelKey 		= 'advert';
	
	public $ActionModelName		= 'advert';

	public $menu_id 		= 'E';
	
	public $nav_item 		= 'E04';
	
	public $is_search 		= TRUE;
	
	// tz vars 类生成的自定义字段使用
	public $vars = array(
		'search'=>array(
			array('txt'=>'form_ad_title',     'value'=>'ad_title',  	'color'=>''),
			array('txt'=>'form_ad_words', 	  'value'=>'ad_words',  	'color'=>''),
			array('txt'=>'form_start_date',   'value'=>'start_date', 	'color'=>''),
			array('txt'=>'form_expire_date',  'value'=>'expire_date', 	'color'=>'')
        )
	);

	public function __construct()
	{
		parent::__construct();
		
		$this->ControllerTitle = $this->lang_current['controller_title'];
        $this->add_js('tzwechat/libs/datepicker.js');
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

		$this->advert->set_order_mode($sort_field, $sort_mode);
		$this->advert->page($p);

		unset($sort_field, $sort_mode);

		$lists 		= $this->advert->lists($params);
		
		$total 		= $this->advert->total($params);
		
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

    public function save()
    {
        $data = $this->get_data('data');
		
		$id = $this->get_data('id');
		
        if (isset($data['start_date'])){$data['start_date'] = strtotime($data['start_date']);}
        if (isset($data['expire_date'])){$data['expire_date'] = strtotime($data['expire_date']);}
        
		$this->save_data($data, $id);
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
		$this->load_model('adg');

		return $this->adg->get_all('id, title');
	}
}

/* End of file Adverts.php */
/* Location: ./application/webmaster/extends/Adverts.php */