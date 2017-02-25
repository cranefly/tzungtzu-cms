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
// ------------------------------------------------------------------------

/**
 * Base Controller Class
 * 基础数据操作控制器， 比如数据的增删改查，修改状态，等
 * 
 * @package		TzungTzu
 * @subpackage	Core
 * @category	Core
 * @author		TZ Dev Team
 */
class Base_Controller extends TZ_Controller
{
    // 跳转地址
    public $go_url = '';
    public function __construct()
    {
        parent::__construct();
        
        //自动加载 定义字段
		if (!empty($this->vars))
		{
			foreach($this->get_vars() as $k => $v){
               
                $this->tz_vars->set_fields($k,$v);
            }
		}
    }
    
    /**
	 * 重设vars数组，用语言包系统化
	 *
	 * @access public
	 * @return $this
	 */
	public function get_vars()
	{
		foreach ($this->vars as $var_key => $var)
		{
			foreach ($var as $key => $val)
			{
				$var[$key]['txt'] = $this->lang_current[$val['txt']];
			}
			$this->vars[$var_key] = $var;
			unset($var);
		}
		
		return $this->vars;
	}

    /**
     * 加载列表
     * @param type $params
     */
    public function lists($params = array())
    {
        $this->check_authority();
        
        $page = $this->getData('p');
        
        $this->action_model->page($page, PAGESIZE);
        
        $total  = $this->action_model->total($params);
        $lists  = $this->action_model->lists($params);
        $data   = array(
            'page' =>  $this->get_page_link($this->PagePath, $total, $params, TZ_PAGESIZE),
            'list' => $lists,
        );
        $this->render_view($this->ViewPath . '/list', $data);
    }

    /**
	 * add page view
	 *
	 * @access public
	 * @return void
	 */
	public function add()
	{
        $this->check_authority();
        
		$this->render_admin($this->ViewPath . '/add');
	}

	/**
	 * edit page view
	 * 
	 * @access public
	 * @return $this
	 */
	public function edit()
	{
        $this->check_authority();
        
		$data['data'] = $this->action_model->find($this->get_data('id'), 'id');
		$this->render_admin($this->ViewPath . '/edit', $data);
		unset($data);
	}
	
	/**
	 * 保存用户信息 编辑和添加共用一个入口
	 *
	 * @access public
	 * @return void
	 */
	public function save()
	{
        $this->check_authority();
        
		$data = $this->get_data('data');
		$id   = $this->get_data('id');
		
		$this->save_data($data, $id);
        unset($data, $id);
	}

    /**
	 * 保存用户信息操作
	 *
	 * @access public
	 * @param $data array
	 * @param $id int
	 * @return void
	 */
	public function save_data($data = NULL, $id = NULL)
	{
        // 获取到旧信息，用户写入日志中
        $old_text = $new_text = serialize($data);
        if ($id > 0){
            $old_text = serialize($this->action_model->find($id));
        }
        $resource = array();
        // 把资源文件单独处理
        if (isset($data['resource']) && !empty($data['resource']))
        {
            $resource = $data['resource'];
        }
        
        if (isset($data['resource'])) {unset($data['resource']);}
        $this->action_model->lang_current = $this->lang_current;
        
		$res = $this->action_model->set_attrs($data)->set_PKeyValue($id)->save($data, $id);
		
		if ($res > 0)
		{
            // 操作成功就添加资源文件
            if (!empty($resource))
            {
                if (isset($data['mid'])){
                    $this->save_resource($resource, $res, $data['mid']);
                }
                unset($resource);
            }
			
			$data = array();
			if (!empty($this->go_url)){
				$data['url'] = $this->go_url;
			}
            
            // 写入日志
            $this->log($old_text, $new_text);
            unset($old_text, $new_text);
            
			$this->print_state(0, '操作成功', '操作成功', $data);
            unset($data);
		}
		
		$error = $this->action_model->errors;
		
		if (isset($error[0]))
		{
			$this->print_state(1, $error[0][0], $error[0][1]);
		}
	}

       /**
     * 保存资源文档关系数据
     * @param array $resource 资源id 
     * @param int $info_id 文档id
     * @param int $mid 文档模型
     * @return type
     */
    public function save_resource($resource,$info_id, $mid)
    {
        if (!is_array($resource)){(array)$resource;}
                
        $resource_data = array();
        foreach($resource as $file)
        {
            $resource_data[] = array(
                'info_id'       => $info_id,
                'model_id'      => $mid,
                'resource_id'   => $file,
                'cdate'         => time(),
            );
        }
        
        unset($resource);
        $this->load_model('resource_info');
        return $this->resource_info->insert_batch($resource_data);
    }

	/**
	 * update state 
	 *
	 * @access public
	 * @return void
	 */
	public function update_state()
	{
        $this->check_authority();
        
		$ids		= $this->get_data('ids');
		$_state 	= $this->get_data('state');

		$state	= $_state == 0 ? 1 : 0;
		
		if ($this->action_model->update_state($ids, $state))
		{
			$this->success();
		}

		$this->fail();
	}

    /**
     * 修改排序
     */
	public function update_order()
	{
        $this->check_authority();
        
		$params = $this->get_data('params');
        
        $order = $ids = array();
        if (!empty($params) && is_array($params))
        {
            foreach ($params as $param)
            {
                $_order[] = $param['val'];
                $_ids[]   = $param['id'];
            }
            
            $order = array(array($this->action_model->order => implode(',', $_order)));
            $ids    = array('id' => implode(',', $_ids));
            
            unset($_order, $_ids);
        }else{
			$this->fail();
		}
        
        $res    = $this->action_model->update_list($order, $ids);
        
        unset($order, $ids);
        
        if ($res)
        {
            $this->print_json(array('code'=>0, 'message'=>'success'));
        }else
        {
            $this->print_json(array('code'=>1, 'message'=>'fail'));
        }
	}

	/**
	 * 删除记录
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function delete()
	{
        $this->check_authority();
        
		$ids 	= $this->get_data('params');

		$result = $this->action_model->deletes($ids);

		unset($ids);
		if ($result)
		{
			$this->success();
		}else{
			$this->fail();
		}
	}

	/**
	 * 排序链接
	 * @access public
	 * 
	 * @param type $url
	 * @param type $sfield
	 * @param type $title
	 * @return string
	 */
	public function set_sort($url,  $sfield = 'id', $title = '')
	{
		$field 	= $this->input->get('sort_filed');
		$mode 	= $this->input->get('sort_mode');
		
		$sort_field = empty($sfield) ? $field : $sfield ;
		$sort_mode 	= $mode == 'ASC' ? 'DESC' : 'ASC';
		
		$_ext = '?';
		
		if(stripos($url, '?'))
		{
			$_ext = '&';
		}
		$href	= "{$url}{$_ext}sort_field={$sort_field}&sort_mode={$sort_mode}";
		return '<a href="' . $href . '" title="' . $title . '"> ' . $title . '<div></div></a>';
	}

	/**
	 * 生成连接
	 *
	 * @access public
	 * @param $base_url 连接地址
	 * @param $total 总数
	 * @param $params 其他请求参数
	 * @return string
	 */
	public function get_page_link($base_url, $total = 0, $params = array())
	{
		$url 	= base_url($base_url . '?' . http_build_query($params));
        $config = array(
            'base_url' 				=> $url,
            'per_page' 				=> TZ_PAGESIZE,
            'total_rows' 			=> $total,
            'num_links' 			=> 10,
            'query_string_segment' 	=> 'p',
            'page_query_string' 	=> TRUE,
            'first_link' 			=> $this->lang_common['first_link'],
            'last_link' 			=> $this->lang_common['last_link'],
            'prev_link' 			=> $this->lang_common['prev_link'],
            'next_link' 			=> $this->lang_common['next_link'],
            'cur_tag_open' 			=> '<span class="current">',
            'cur_tag_close' 		=> '</span>',
            'use_page_numbers' 		=> TRUE,
        );

        $this->pagination->initialize($config);
        unset($config, $url);

        return $this->pagination->create_links();
	}
    
    
    /**
     * 个人中心模板导航页
     * @param type $view
     * @param type $data
     */
//    public function render_account($view, $data = array(), $web_dir = NULL)
//    {
//		if ($web_dir != NULL){$this->web_dir = $web_dir;}
//        //导航菜单
//		$menus = TZ_NavPanel::getInstance()->get_manage_menus($this->menu_id, $this->nav_item);
//		
//		//页面基础数据
//		$base_data = array(
//			'langco' 	=> $this->lang_common,
//			'langcu' 	=> $this->lang_current,
//			'page_path' => $this->PagePath,
//			'tz' 		=> $this,
//		);
//		//print_r($menus);
//		// view data
//		$view_data  = array_merge($data, $this->render_data, $base_data);
//		unset($base_data, $this->render_data, $data);
//		
//		$view_html 	= $this->load->view($this->get_tpl_name($view), $view_data, true);
//		unset($view_data);
//		
//		//frame data
//		$frame_data = array(
//            'main_content' 		=> $view_html,
//            'items' 			=> $menus['item'],
//            'nav_item' 			=> $menus['minNav'],
//            'tz' 				=> $this,
//			'controller_title' 	=> $this->ControllerTitle,
//			'langweb' 			=> $this->_lang_web,
//            'website_name'      => WEBSITE_NAME,
//            'js'				=> implode("\r\n", $this->css_js['js']),
//            'css'				=> implode("\r\n", $this->css_js['css']),
//        );
//		 
//		// load frame
//        $this->load->view($this->get_tpl_name('frame'), $frame_data);
//
//		unset($frame_data, $this, $view_html);
//    }
}

/* End of file Base_Controller.php */
/* Location: ./application/core/Base_Controller.php */