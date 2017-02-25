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
 * Article Controller
 * 
 * @package     TzungTzu
 * @subpackage  Controller
 * @category    Index
 * @author      Tz Dev Team
 */
class Article extends View_Controller{
    
    const WEB_PAGESIZE = 10;
    
    public $ModelPath 		= 'articles/article';
	
	public $ModelName		= 'article';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * 分类下面的列表,包括分类首页
     * @access public
     * @return void 
     */
    public function lists($cid = NULL, $p = NULL)
    {
        if ($cid === NULL){
            $cid = $this->get_data('cid');
        }
        
        if ($p === NULL){
            $p   = $this->get_data('p');
        }
        
        $category   = array();
        $table_name = '';
        if ($cid > 0)
        { 
            $category   = $this->category->find($cid);
            $table_name = $this->model->find_field($category['model_id'], 'id', 'mname');
            //$mid = $category['model_id'];
        }
       
        //设置表
        $this->article->set_table_name($table_name);
        unset($table_name);
        
		$params = array(
			'stype' 	=> $this->get_data('stype'),
			'svalue' 	=> $this->get_data('svalue'),
            'cids'      => $this->category->get_son_ids($cid),
            'status'    => 1
		);

		$this->article->page($p, self::WEB_PAGESIZE);

		$lists 		= $this->article->lists($params);
		$total 		= $this->article->total($params);
		
        $list_url = base_url('web/'.$cid .'/list.html');
        $params['cids'] = $cid;
		$pagecode 	= $this->get_page_link_web($list_url, $total, $params);

        $this->seo = array(
            'title'         => !empty($category['ctitle']) ? $category['ctitle'] : $category['cname'],
            'keywords'      => $category['ckey'],
            'description'   => $category['cdesc']
        );
        
        //根据分类的模板信息处理模板
        $set_tpl = 'list';
        if ($p <= 1 && !empty($category['tpl_index'])){
            $set_tpl = $category['tpl_list'];
        }else if (!empty($category['tpl_list'])){
            $set_tpl = $category['tpl_list'];
        }
        
        $data['lists']    = $lists;
        $data['total']    = $total;
        $data['pagecode'] = $pagecode;
        $data['category'] = $category;
        $data['categories'] = $this->category->cateAllSon(1);
        $data['cid']      = $cid;
        unset($lists, $total, $pagecode);
        
        $this->render_html($set_tpl, $data);
        unset($data);
    }
    
    /**
     * 系统详情页面
     * @access public
     * @param type $id
     * @return void 
     */
    public function detail($id = 0, $mid = 0){
        if ($id <= 0){$id = $this->get_data('id');} //文档id
        if ($mid <= 0){$mid = $this->get_data('mid');}//模型id
        
        //获取模型信息
        $table_name = $this->model->find_field($mid, 'id', 'mname');
        $this->article->set_table_name($table_name);
        
        //获取文档信息
        $info = $this->article->find($id);
        //更新访问数
        $this->article->update_num(1, 'visited', $id);
        //获取上一条数据
        $prev = $this->article->get_prev($id);
        //获取下一条数据
        $next = $this->article->get_next($id);
        //根据文档获取分类信息
        $category   = $this->category->find($info['cid']);
        
        $set_tpl = 'detail';
        if (!empty($category['tpl_content'])){
            $set_tpl = $category['tpl_content'];
        }
        
        if (isset($info['description'])){$description = $info['description'];}
        
        if (isset($info['characteristic'])){$description = $info['characteristic'];}
        $this->seo = array(
            'title'         => $info['title'],
            'keywords'      => $info['title'],
            'description'   => $description
        );
        $data = array(
            'data'      => $info,
            'category'  => $category,
            'next'      => $next,
            'prev'      => $prev,
            'cid'       => $category['id'],
        );
        unset($info, $table_name);
        $this->render_html($set_tpl, $data);
        unset($data);
    }
    
    /**
     * 用户扩展信息详情
     * @param type $id 用户id
     * @param type $mid 扩展的模板id
     */
    public function account($id = 0, $mid = 0)
    {
        if ($id <= 0){$id = $this->get_data('id');} //文档id
        if ($mid <= 0){$mid = $this->get_data('mid');}//模型id
        
        //获取模型信息
        $table_name = $this->model->find_field($mid, 'id', 'mname');
        $this->article->set_table_name($table_name);
        
        //获取文档信息
        $info = $this->article->find($id);
        //更新访问数
        $this->article->update_num(1, 'visited', $id);
        //获取上一条数据
        $prev = $this->article->get_prev($id);
        //获取下一条数据
        $next = $this->article->get_next($id);
        //根据文档获取分类信息0
        $category   = $this->category->find($info['cid']);
        
        $set_tpl = 'detail';
        if (!empty($category['tpl_content'])){
            $set_tpl = $category['tpl_content'];
        }
        
        $this->seo = array(
            'title'         => $info['title'],
            'keywords'      => $info['title'],
            'description'   => '',
        );
        $data = array(
            'data'      => $info,
            'category'  => $category,
            'next'      => $next,
            'prev'      => $prev,
            'cid'       => $category['id'],
        );
        unset($info, $table_name);
        $this->render_html($set_tpl, $data);
        unset($data);
    }

    /**
     * 
     */
    public function search($mid = NULL, $tag = NULL)
    {
        if ($mid === NULL){
            $mid = $this->get_data('mid');
        }
        
        if ($tag === NULL){
            $tag = $this->get_data('keyword');
        }
    }
}

/* End of file Article.php */
/* Location: ./application/web/Article.php */
