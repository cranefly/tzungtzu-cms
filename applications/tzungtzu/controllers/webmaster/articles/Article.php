<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 *
 * @package     TzungTzu
 * @author      TZ Dev Team
 * @copyright   Copyright (c) 2012-2024, TzungTzu.com.
 * @license     http://tzungtzu.com/doucmentss/license.html
 * @link        http://tzungtzu.com/
 * @since       Version 1.0.0
 */

/**
 * Article Controller
 * 文档
 * @package     TzungTzu
 * @subpackage  Controller
 * @category    Controller
 * @author      Tz Dev Team
 */
class Article extends Master_Controller
{
	public $LangPath 		= 'articles/article';
	
	public $ViewPath 		= 'articles/article';
	
	public $PagePath 		= 'webmaster/articles/article';
    
    public $ActionModelKey 		= 'article';
	
	public $ActionModelName		= 'article';
	
	public $menu_id 		= 'C';
	
	public $nav_item 		= 'C01';

    public $cid             = 0;
    
    public $mid             = 0;
    
    private $simditor_js    = array(
        'libs/simditor/scripts/jquery.min.js',
        'libs/simditor/scripts/module.min.js',
        'libs/simditor/scripts/hotkeys.min.js',
        'libs/simditor/scripts/uploader.min.js',
        'libs/simditor/scripts/simditor.min.js',
        'libs/simditor/scripts/install.js',
        'libs/datepicker.js', 
        'webmaster/js/article.js',
        'libs/dropzone/dropzone.js'
    );
    
    private $simditor_css    = array('libs/simditor/styles/simditor.css','libs/dropzone/dropzone.css');
    
    private $article_js = array('webmaster/js/article.js');
    public function __construct()
	{
		parent::__construct();
		
		$this->ControllerTitle = $this->lang_current['controller_title'];
        $this->load_model('model');
	}

	/**
	 * 文档导航页
	 * @access public
	 * @return  void
	 */
	public function index()
	{
        $this->load_model('category');
        
        //获取模型
        $models     = $this->model->get_all();
        //获取分类
        $category   = $this->category->show_tree(array('tree'=>$this->category->cate_brother(),"url"=> base_url($this->PagePath . '/lists'), "url_force"=>1));
        
        $data['models']    = $models;
        $data['category']  = $category;
        unset($models, $category);
        
		$this->render_admin("{$this->ViewPath}/index",$data);
		unset($data);
	}

	/**
	 * 文档列表
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function lists($params = array())
	{
		$this->load_model('category');
		
        $this->add_js($this->article_js);
        
		$p 			= $this->get_data('p');
		$sort_field = $this->get_data('sort_field');
		$sort_mode 	= $this->get_data('sort_mode');
		$cid        = $this->get_data('cid');
		$mid        = $this->get_data('mid');
        
        $table_name = '';
        if ($cid > 0)
        { 
            $model_id   = $this->category->find_field($cid, 'id' , 'model_id');
            $table_name = $this->model->find_field($model_id, 'id', 'mname');
            $mid = $model_id;
        }else
        {
            $table_name = $this->model->find_field($mid, 'id', 'mname');
        }
       
        //设置表
        $this->article->set_table_name($table_name);
        unset($table_name);
        
		$params = array(
			'stype' 	=> $this->get_data('stype'),
			'svalue' 	=> $this->get_data('svalue')
		);

        if($cid > 0)
        {
            $params['cid'] = $cid;
        }
		$this->article->set_order_mode($sort_field, $sort_mode);
		$this->article->page($p);

		$lists 		= $this->article->lists($params);
		$total 		= $this->article->total($params);
		
        $params['sort_field'] = $sort_field;
        $params['sort_mode']  = $sort_mode;
		$params['mid'] = $mid;
		$params['cid'] = $cid;
		$pagecode 	= $this->get_page_link($this->PagePath . '/lists', $total, $params);

		//获取到模型字段
		$fields = $this->_get_field_model_id($mid);
		$data = array(
			'lists' 	=> $lists,
			'pagecode' 	=> $pagecode,
			'fields'	=> $fields,
			'mid'		=> $mid,
            'cid'       => $cid
		);
		unset($lists, $pagecode, $total, $params);
		//print_r($data);
		$this->render_admin("{$this->ViewPath}/list",$data);
		unset($data);
	}
    
    /**
     * 添加文档有两种，一种是根据文档分类id来添加，还有一种是根据模型id来添加
     * 每个文章都有模型id和分类id，这样达到文档的唯一性
     * @access public
     * @return void
     */
    public function add()
    {
        $this->load_model('category');
        $this->add_css($this->simditor_css);
		$this->add_js($this->simditor_js);
        
        $cid  = $this->get_data('cid');
        
        $mid  = $this->category->find_field($cid, 'id', 'model_id');
        
        $this->_load_add_view($mid);
    }
    
    /**
     * 编辑都是使用文章的id和模型的id(mid)来联合作为唯一标识更新文章
     * @access public 
     * 
     * @return void
     */
    public function edit()
    {        
        $this->add_css($this->simditor_css);
		$this->add_js($this->simditor_js);
        
        $id  = $this->get_data('id');
        $mid = $this->get_data('mid');
        
        //根据mid获取到表名称
        $table_name = $this->model->find_field($mid, 'id', 'mname');
        
        $this->article->set_table_name($table_name);
        
        $_data = $this->article->find($id);
        $this->render_data(array('data' => $_data));
        $this->load->library('TZ_Fields');
		
        $data['field_info'] = $this->_get_field_model_id($mid);
        $data['categories'] = $this->_get_category_select($_data['cid']);
        $data['models']     = $this->_get_models();
        $data['mid']		= $mid;
        $this->render_admin($this->ViewPath . '/edit', $data);
        unset($data, $mid);
    }
    
    /**
     * 通过模型id加载添加页面
     * 
     * @access public 
     * @return void 
     */
    public function add_model()
    {
        $this->add_css($this->simditor_css);
		$this->add_js($this->simditor_js);
        
        $mid = $this->get_data('mid');
        
        $this->_load_add_view($mid);
    }
    
    /**
     * 保存信息
     * @access public
     * @return void
     */
    public function save()
    {
        
        $mid    = $this->get_data('mid');
        
        //根据mid获取到表名称
        $table_name = $this->model->find_field($mid, 'id', 'mname');
        
        $this->article->set_table_name($table_name);
        
        parent::save();
    }

    /**
     * 删除文档
     * @access public
     * @return void
     */
    public function delete()
    {
        $mid    = $this->get_data('mid');
        
        $table_name = $this->model->find_field($mid, 'id', 'mname');
        
        $this->article->set_table_name($table_name);
        
        parent::delete();
    }
    

    /**
     * 加载添加页面
     * @access public
     * @param type $mid
     * @return void
     */
    public function _load_add_view($mid)
    {
		$this->load->library('TZ_Fields');
		
		$cid = $this->get_data('cid');
        $data['field_info'] = $this->_get_field_model_id($mid);
        $data['categories'] = $this->_get_category_select($cid);
        $data['models']     = $this->_get_models();
        $data['mid']		= $mid;
		$data['cid']		= $cid;
        $this->render_admin($this->ViewPath . '/add', $data);
        unset($data, $mid);
    }

    /**
     * 获取到模型的字段信息
     * @access public
     * @param type $model_id
     * @return array
     */
    private function _get_field_model_id($model_id)
    {
        $model_info = $this->model->get_field_by_model_id($model_id);
        
        return $model_info;
    }

    /**
     * 获取到分类
     * @param type $id
     * @return type
     */
    private function _get_category_select($id = 0)
	{
        $this->load_model('category');
		$fields = $this->category->show_select();
		//array_unshift($fields, array('value'=>0,"txt"=>"顶级分类","txt_color"=>""));
		$this->tz_vars->set_fields("parent_id",$fields);
		
		unset($fields);
		return $this->tz_vars->input_str(array('node'=>'parent_id','name'=>'cid','type'=>'select_single','default'=> $id,'is_data'=>TRUE,'style'=>'style="width:200px;"'));
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
		return $this->model->get_all('id, mtitle');
	}
}

/* End of file Article.php */
/* Location: ./application/webmaster/articles/Article.php */