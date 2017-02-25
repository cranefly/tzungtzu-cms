<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * 分类
 *
 * @package     TzungTzu
 * @author      TZ Dev Team
 * @copyright   Copyright (c) 2012-2024, TzungTzu.com.
 * @license     http://tzungtzu.com/doucmentss/license.html
 * @link        http://tzungtzu.com/
 * @since       Version 1.0.0
 */

/**
 * Category Controller
 *
 * @package     TzungTzu
 * @subpackage  Controller
 * @category    Controller
 * @author      Tz Dev Team
 */
class Category extends Master_Controller
{
	public $LangPath 		= 'articles/category';
	
	public $ViewPath 		= 'articles/category';
	
	public $PagePath 		= 'webmaster/articles/category';

    public $ActionModelKey 		= 'category';
	public $ActionModelName		= 'category';
	
	public $menu_id 		= 'C';
	
	public $nav_item 		= 'C02';

	public $vars = array(
        'nav_show' => array(
			array('txt'=>'view_radio_nav_0',      'value'=>'0',       'color'=>''),
			array('txt'=>'view_radio_nav_1',	  'value'=>'1',       'color'=>'')
        ),
		 'nav_show_wap' => array(
			array('txt'=>'view_radio_nav_0',      'value'=>'0',       'color'=>''),
			array('txt'=>'view_radio_nav_1',	  'value'=>'1',       'color'=>'')
        ),
	);
    
	public function __construct()
	{
		parent::__construct();
		
		$this->ControllerTitle = $this->lang_current['controller_title'];
        
	}

	/**
	 * index page
	 *
	 * @access public
	 * @return  void
	 */
	public function index()
	{
		$p 			= $this->get_data('p');
		$sort_field = $this->get_data('sort_field');
		$sort_mode 	= $this->get_data('sort_mode');
		$parent_id	= $this->get_data('parent_id') ;
		//默认查询顶级分类
		
		if (!is_numeric($parent_id) || $parent_id < 0){$parent_id = 0;}

		$params = array(
			'stype' 	=> $this->get_data('stype'),
			'svalue' 	=> $this->get_data('svalue'),
			'parent_id' => $parent_id
		);

		if (empty($sort_field) && empty($sort_mode))
		{
			$sort_field = $this->category->SortField;
			$sort_mode  = $this->category->SortMode;
		}
		
		$this->category->set_order_mode($sort_field, $sort_mode);
		$this->category->page($p);

		unset($sort_field, $sort_mode);

		$lists 		= $this->category->lists($params);
		$total 		= $this->category->total($params);
		
		$pagecode 	= $this->get_page_link($this->PagePath, $total, $params);
		
		$data = array(
			'lists'		=> $lists,
			'pagecode'	=> $pagecode,
		);
		
		$this->render_admin("{$this->ViewPath}/list",$data);
		unset($data);
	}
	
	public function edit()
	{
		$tree_html = $this->_get_category_select($this->get_data('id'));
		$this->render_data(array('tree_html'=>$tree_html));
        unset($tree_html);
        $models = $this->_get_models();
        $this->render_data(array('models' => $models));
        unset($models);
        //获取模板列表
        $tpls = $this->_get_tpl_list();
        $this->render_data(array('tpls' => $tpls));
        unset($tpls);
        
		parent::edit();
	}
	
	public function add()
	{
		$pid = $this->get_data('pid');
		$tree_html = $this->_get_category_select($pid);
		$this->render_data(array('tree_html'=>$tree_html));
        $models = $this->_get_models();
        $this->render_data(array('models' => $models));
        //获取模板列表
        $tpls = $this->_get_tpl_list();
        $this->render_data(array('tpls' => $tpls));
        unset($tpls);
        
		parent::add();
	}

	private function _get_category_select($parent_id = 0)
	{
		$fields = $this->category->show_select();
		array_unshift($fields, array('value'=>0,"txt"=>"顶级分类","txt_color"=>""));
		$this->tz_vars->set_fields("parent_id",$fields);
		
		unset($fields);
		return $this->tz_vars->input_str(array('node'=>'parent_id','name'=>'parent_id','type'=>'select_single','default'=> $parent_id,'is_data'=>TRUE,'style'=>'style="width:250px;"'));
	}
    
   /**
	 * 获取所有模型
	 * 
	 * @access public
	 * @return array
	 *
	 */
	private function _get_models()
	{
        $this->load_model('model');
		return $this->model->get_all('id, mtitle');
	}
    
    /**
     * 获取模板
     */
    private function _get_tpl_list(){
        
        $this->load->helper('directory');
        $files = directory_map('./applications/tzwechat/views/web/' . THEME_PATH);
        $index_tpl = $list_tpl = $content_tpl = array(array('txt'=> $this->lang_current['view_default_template'],'value' => ''));
        foreach ($files as $file) {
            if (is_array($file)){ continue;}
            $f = array("txt"=>$file,"value"=>$file);
            if(preg_match("~cover~", $file)){
                array_push($index_tpl, $f);
            }
            if(preg_match("~list~", $file)){
                array_push($list_tpl, $f);
            }
            if(preg_match("~detail~", $file)){
                array_push($content_tpl, $f);
            }
        }
        
        return array(
            'tpl_cover' => $index_tpl,
            'tpl_list' => $list_tpl,
            'tpl_detail' => $content_tpl,
        ); 
    }
}

/* End of file Category.php */
/* Location: ./application/webmaster/articles/Category.php */