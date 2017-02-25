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
 * Material Controller
 * 
 * 微信素材管理
 * 
 * @package     TzungTzu
 * @subpackage  Controller
 * @category    Material
 * @author      Tz Dev Team
 */
class Material extends Master_Controller
{
    public $LangPath 	= 'wechat/material';
	
	public $ViewPath 	= 'wechat/material';
	
	public $PagePath 	= 'webmaster/wechat/material';
    
	public $ActionModelKey 	= 'material';
	
	public $ActionModelName	= 'material';

	public $menu_id 	= 'W';
	
	public $nav_item    = 'W01';
    
    public $vars        = array(
        'types' => array(
			array('txt'=>'view_type_0',    'value'=>'0',     'color'=>''),
			array('txt'=>'view_type_1',    'value'=>'1',     'color'=>''), // 文本信息
			array('txt'=>'view_type_2',	   'value'=>'2',     'color'=>''), // 图片信息
			array('txt'=>'view_type_3',	   'value'=>'3',     'color'=>''), // 语音信息
			array('txt'=>'view_type_4',	   'value'=>'4',     'color'=>''), // 视频信息
			array('txt'=>'view_type_5',	   'value'=>'5',     'color'=>''), // 音乐信息
			array('txt'=>'view_type_6',	   'value'=>'6',     'color'=>''), // 图文信息
        ),
        'show_cover_pic' => array(
            array('txt'=>'view_cover_0',    'value'=>'0',     'color'=>''),
			array('txt'=>'view_cover_1',    'value'=>'1',     'color'=>''),
        ),
        'search' => array(
            
        ),
    );
    
     private $simditor_js    = array(
        'libs/simditor/scripts/jquery.min.js',
        'libs/simditor/scripts/module.min.js',
        'libs/simditor/scripts/hotkeys.min.js',
        'libs/simditor/scripts/uploader.min.js',
        'libs/simditor/scripts/simditor.min.js',
        'libs/simditor/scripts/install.js',
        'libs/datepicker.js', 
        'webmaster/js/material.js',
        'libs/dropzone/dropzone.js'
    );
    
    private $simditor_css    = array('libs/simditor/styles/simditor.css','libs/dropzone/dropzone.css');
    
    public function __construct()
    {
        parent::__construct();
        $this->ControllerTitle = $this->lang_current['controller_title'];
        $this->load->library('wechat/Wechat');
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

		$this->material->set_order_mode($sort_field, $sort_mode);
		$this->material->page($p);

		unset($sort_field, $sort_mode);

		$lists 		= $this->material->lists($params);
		
		$total 		= $this->material->total($params);
		
		$pagecode 	= $this->get_page_link($this->PagePath, $total, $params);

		$data = array(
			'lists' 	=> $lists,
			'pagecode' 	=> $pagecode
		);
		unset($lists, $pagecode, $total, $params);
		
		$this->render_admin("{$this->ViewPath}/list",$data);
		unset($data);
    }
    
    public function add()
    {
        $this->add_css($this->simditor_css);
        $this->add_js($this->simditor_js);
        parent::add();
    }
    public function edit()
    {
        $this->add_css($this->simditor_css);
        $this->add_js($this->simditor_js);
        parent::edit();
    }

    
    /**
     * 保存素材信息
     */
    public function save()
    {
        $id     = $this->get_data('id');
        $data   = $this->get_data('data');
        
		if ($data['type'] == 6){
			
		}
		
		if ($data['type'] != 6){
			$this->load_model('material_file');
			$this->action_mdoel = $this->material_file;
		}
		$this->save_data($data, $id);
    }
    
}

/* End of file Material.php */
/* Location: ./application/webmaster/wechat/Material.php */
