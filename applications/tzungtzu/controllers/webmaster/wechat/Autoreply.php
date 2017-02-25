<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  TzungTzu CMS
 *
 * @package     TzungTzu
 * @author      TZ Dev Team
 * @copyright   Copyright (c) 2012-2024, TzungTzu.com.
 * @license     http://tzungtzu.com/doucmentss/license.html
 * @link        http://tzungtzu.com/
 * @since       Version 1.0.0
 */

/**
 * Media Controller
 * 
 * 微信自动回复管理
 * 
 * @package     TzungTzu
 * @subpackage  Controller
 * @category    Autoreply
 * @author      Tz Dev Team
 */
class Autoreply extends Master_Controller
{
    public $LangPath 	= 'wechat/reply';
	
	public $ViewPath 	= 'wechat/autoreply';
	
	public $PagePath 	= 'wechat/autoreply';
    
	public $ModelPath 	= 'wechat/reply';
	
	public $ModelName	= 'reply';

	public $menu_id 	= 'W';
	
	public $nav_item    = 'W03';
    
    public $vars        = array(
        'types' => array(
			array('txt'=>'view_type_0',    'value'=>'0',     'color'=>''),
			array('txt'=>'view_type_1',    'value'=>'1',     'color'=>''),
			array('txt'=>'view_type_2',	   'value'=>'2',     'color'=>''),
			array('txt'=>'view_type_3',	   'value'=>'3',     'color'=>''),
			array('txt'=>'view_type_4',	   'value'=>'4',     'color'=>''),
			array('txt'=>'view_type_5',	   'value'=>'5',     'color'=>''),
			array('txt'=>'view_type_6',	   'value'=>'6',     'color'=>''),
        ),
    );
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load_model($this->ModelPath);
    }
    
    public function index()
    {
        $p 			= $this->get_data('p');
		$sort_field = $this->get_data('sort_field');
		$sort_mode 	= $this->get_data('sort_mode');
		
		$params = array(
			'stype' 	=> $this->get_data('stype'),
			'svalue' 	=> $this->get_data('svalue')
		);

		$this->reply->set_order_mode($sort_field, $sort_mode);
		$this->reply->page($p);

		unset($sort_field, $sort_mode);

		$lists 		= $this->reply->lists($params);
		
		$total 		= $this->reply->total($params);
		
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

/* End of file Autoreply.php */
/* Location: ./application/wechat/Autoreply.php */
