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
 * View Controller Class
 * 前端无需登录控制器，
 * @package		TzungTzu
 * @subpackage	Core
 * @category	Core
 * @author		TZ Dev Team
 */
class View_Controller extends Base_Controller
{
    public $web_dir = 'web/default';
    
    public function __construct()
    {
        parent::__construct();
        
        // 默认加载常用模型
        $this->load_model(array('model', 'category', 'article',  'flink', 'advert', 'setted'));
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
	public function get_page_link_web($base_url, $total = 0, $params = array())
	{
		$url 	= $base_url . '?' . http_build_query($params);
       
        $config = array(
            'base_url' 				=> $url,
            'per_page' 				=> TZ_PAGESIZE,
            'total_rows' 			=> $total,
            'num_links' 			=> 2,
            'query_string_segment' 	=> 'p',
            'page_query_string' 	=> TRUE,
            'first_link' 			=> $this->lang_common['first_link'],
            'last_link' 			=> $this->lang_common['last_link'],
            'prev_link' 			=> $this->lang_common['prev_link'],
            'next_link' 			=> $this->lang_common['next_link'],
            'num_tag_open'         => '<li>',
            'num_tag_close'        => '</li>',
            'cur_tag_open' 			=> '<li><a href="#">',
            'cur_tag_close' 		=> '</a></li>',
            'next_tag_open' 		=> '<li>',
            'next_tag_close' 		=> '</li>',
            'prev_tag_open' 		=> '<li>',
            'prev_tag_close' 		=> '</li>',
            'use_page_numbers' 		=> TRUE,
        );

        $this->pagination->initialize($config);
        unset($config, $url);

        return $this->pagination->create_links();
	}
    
    /**
	 * 加载页面
	 * @access public
	 * @param string $view
	 * @param array $data
	 * @return void 
	 */
	public function render_html($view, $data = array())
	{
		//页面基础数据
		$base_data = array(
			'tz' 		=> $this,
		);
		
		// view data
		$view_data  = array_merge($data, $this->render_data, $base_data);
		unset($base_data, $this->render_data, $data);

		// load frame
        $_tpl = $this->get_tpl_name($view);
        
        $this->load->view($_tpl, $view_data);

		unset($view_data, $this);
	}
    
    /**
     * 获取到广告位下面的所有广告
     * @access public
     * @param type $group_id
     * @return array
     */
    public function get_ad($group_id)
    {
        return $this->advert->get_advert_by_group($group_id);
    }

    public function get_flink($group_id = NULL)
    {
        return $this->flink->get_flink($group_id);
    }

    /**
     * 获取到分类数组
     * @access public
     * @param type $cid
     * @return array
     */
    public function get_category($cid = NULL)
    {
        $category = $this->category->categories;
        if ($cid === NULL)
        {
            return $category;
        }else
        {
            return $category[$cid];
        }
    }
	
	public function get_list($cid = NULL, $pagesize = 5, $sort_field = NULL, $sort_mode = NULL)
	{
		if ($cid === NULL)
		{
			$cid = $this->get_data('cid');
		}
		
		if ($sort_field !== NULL && $sort_mode !== NULL)
		{
			$this->article->set_order_mode($sort_field, $sort_mode);
		}

		$ids = $this->category->get_son_ids($cid);
		$model_id   = $this->category->find_field($cid, 'id' , 'model_id');
        $table_name = $this->model->find_field($model_id, 'id', 'mname');
		//设置表
        $this->article->set_table_name($table_name);
        
		$this->article->page(0, $pagesize);
		$params['cids'] = $ids;
		$lists 		= $this->article->lists($params);
		
		unset($params, $ids, $table_name);
		return $lists;
	}

	/**
     * 获取到配置
     * @access public
     * @param type $ckey
     * @return string
     */
    public function get_config($ckey)
    {
        return $this->setted->get_config($ckey);
    }
    
    public function get_url($id, $mid = NULL, $type = NULL, $fix = NULL)
    {
        switch ($type){
            case 1:
                return base_url('web/'.$id.'/index.html');
                break;
            case 2:
                return base_url('detail/'. $mid . '/' . $id . '.html');
                break;
            case 5:
                return base_url() . '?tag=' . $fix;
                break;
            default :
                break;
        }
    }

    /**
     * 
     */
    public function save()
    {
        $this->check_login(TRUE);
        
        $this->load_model($this->ModelModelPath);
        $this->load_model($this->ArticleModelPath);
        
        $mid    = $this->get_data('mid');
        $data   = $this->get_data('data');
		$id     = $this->get_data('id');
        
        //根据mid获取到表名称
        $table_name = $this->model->find_field($mid, 'id', 'mname');
        
        $this->article->set_table_name($table_name);
        
		$this->save_data($data, $id);
    }
    
    /**
     * 随机获取一张图片作为文章的封面图
     * 
     * @param type $tag  要获取的图片的标签
     * @return string
     */
    public function get_thumb($tag = '')
    {
        return $this->resource->get_image_rand($tag);
    }
}

/* End of file View_Controller.php */
/* Location: ./application/core/View_Controller.php */