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
 * Model Controller
 * 模型管理
 * @package     TzungTzu
 * @subpackage  Controller
 * @category    Model
 * @author      Tz Dev Team
 */
class Model extends Master_Controller
{
	public $LangPath 		= 'moulds/model';
	
	public $ViewPath 		= 'moulds/model';
	
	public $PagePath 		= 'webmaster/moulds/model';
	
	public $ActionModelKey 		= 'model';
	
	public $ActionModelName		= 'model';

	public $menu_id 		= 'D';
	
	public $nav_item 		= 'D01';
	
	public $vars			= array(
		'mtype' => array(
			array('txt'=>'view_mtyp_0',      'value'=>'0',       'color'=>''),
			array('txt'=>'view_mtyp_1',      'value'=>'1',       'color'=>''),
		),
        'is_table' => array(
			array('txt'=>'view_is_table_0',      'value'=>'0',       'color'=>'red'),
			array('txt'=>'view_is_table_1',      'value'=>'1',       'color'=>'green'),
		),
	);
	public function __construct()
	{
		parent::__construct();
		
		$this->ControllerTitle = $this->lang_current['controller_title'];
		$this->add_js('webmaster/js/moulds.model.js');
        
        $this->load_model('field');
        $this->load_model('model_field');
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

		$this->model->set_order_mode($sort_field, $sort_mode);
		$this->model->page($p);

		unset($sort_field, $sort_mode);

		$lists 		= $this->model->lists($params);
		
		$total 		= $this->model->total($params);
		
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
		$data['models'] = $this->_get_models();
		
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
		$data['data'] = $this->model->find($this->get_data('id'));
		$data['models'] = $this->_get_models();
		
		$this->render_data($data);
		unset($data);
		parent::edit();
	}

	/**
	 * 模型页面
	 * @access public
	 * 
	 * @return void
	 */
	public function model_field()
	{
		$id     = $this->get_data('id');
		
		$fields = $this->field->get_all();
		$tags   = $this->field->get_tags();
		$field_array = array();
		foreach($fields as $key =>$val)
		{
			foreach($tags as $value)
            {
                if ($val['field_tag'] == $value['field_tag'])
                {
                    $value['field_tag'] = empty($value['field_tag']) ? $this->lang_current['view_default_tag'] : $value['field_tag'];
                    $field_array[$value['field_tag']][$key] = $val;
                    continue;
                }
            }
		}
		$related_field = $this->model_field->get_field_model($id);
		$related = array();
		
		foreach($related_field as $rel)
		{
			$related[] = $rel['field_id'];
		}
		
		$data['related'] = $related;
		$data['models'] = $this->_get_models();
 		$data['tags'] = $tags;
		$data['field_array'] = $field_array;
		$data['id'] = $id;
        unset($tags, $field_array, $id, $fields, $related_field, $related);
        
		$this->render_admin("{$this->ViewPath}/model_field", $data);
        unset($data);
	}

	/**
	 * 创建或者编辑模型
	 * 
	 * @access public
	 * @return void
	 */
	public function create_model()
	{
		$id     = $this->get_data('id'); //模型id
		$data   = $this->get_data('data');
		
		$insert_data = array();
		foreach ($data as $val)
		{
			//判断关系是否存在，如果存在就略过
			$exist_res = $this->model_field->exist_relation($id, $val);
			if ($exist_res){
				continue;
			}
			
			$insert_data[] = array(
				'model_id' => $id,
				'field_id' => $val
			);
			
		}
		$this->db->trans_start();
        //模型与字段关系
		if (!empty($insert_data))
		{
			$this->model_field->insert_batch($insert_data);
		}	
        unset($insert_data);
        
        //模型信息
        $fields             = $this->field->get_fields_in($data);
        $table_name         = $this->model->find_field($id, 'id', 'mname');
        
        $this->model->set_model_name($table_name);
		
        $create_table_res   = $this->model->create_table($fields);
        unset($fields, $table_name, $data);
		
        $this->db->trans_complete();
		
        if ($create_table_res)
        {
            $this->success();
        }else
        {
            $this->fail();
        }
	}

    /**
     * 更新表提交接口
     * 根据模型id更新模型信息
     * 
     * @access public
     * @return void
     */
    public function update_model()
    {
        $id = $this->get_data('id'); //模型id
        //模型信息
        $fields       = $this->model->get_field_by_model_id($id);
        $table_name   = $this->model->find_field($id, 'id', 'mname');
        
        $this->model->set_model_name($table_name);
        $create_table_res   = $this->model->create_table($fields);
        unset($fields, $table_name);
        
        if ($create_table_res)
        {
            $this->success();
        }else
        {
            $this->fail();
        }
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

/* End of file Model.php */
/* Location: ./application/webmaster/moulds/Model.php */