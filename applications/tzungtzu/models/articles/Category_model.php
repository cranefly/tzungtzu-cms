<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * 用户组模型
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
 * Category Model Class
 *
 * @package		TzungTzu
 * @subpackage	Models
 * @category	Models
 * @author		TZ Dev Team
 */
class Category_Model extends TZ_Model
{
	protected $TableName 		= 'cms_category';
	
	public $SortField 	= 'forder';
	public $SortMode 	= 'ASC';
	//primary key
	protected $PKey 	 		= 'id';

	protected $rules	 		= array(
		array('cname',  	'required'),
		array('model_id',  	'required'),
		array('model_id',  	'int'),
		array('go_url',		'url')
	);	

	// array('字段名' => '语言包名称')
	protected $field_titles 	= array(
		'cname' 	=> 'form_cname',
		'model_id'	=> 'form_model_id',
		'go_url'	=> 'form_go_url'
	);	
    
    
    public $cateList = array();
    
    public $categories = array();
    
    public $order = "forder";
    
    public function  __construct(){
        parent::__construct();
        
        $cate = $this->session->userdata('categorys');
        
        if (empty($cate)){
            
            $this->cateList = $this->get_all();
            $cate = $this->getCategories();
            $this->session->set_userdata('categorys');
        }
        $this->categories = $cate;
        //print_r($this->categories);
    }
    
	public function _where($params = array())
	{
		parent::_where($params);
		
		if (isset($params['parent_id']) && $params['parent_id'] >= 0)
		{
			$this->db->where('parent_id', $params['parent_id']);
		}
	}

	/**
     * 判断分类下面是否子分类
     * 
     * @param type $cateId
     * @return type
     */
    public function haveSonCate($cateId){
        
        $sql = " select cate_id from " . $this->tableName . " where parent_id = " . $cateId . " limit 1";
        $this->db->query($sql);
        
        return $this->db->affected_rows() > 0;
    }

    /**
     * 判断分类下面是否有文章
     * 
     * @param type $cateId
     * @return type
     */
    public function haveInfo($cateId){
        
        $sql = "select info_id from " . $this->infoTabel . " where last_cate_id = " . $cateId . "limit 1";
        
        $this->db->query($sql);
        
        return $this->db->affected_rows() > 0;
    }
    
    
    /**
     * 获取所有目录数组，可以用分类ID作为下标读取分类信息
     */
    private function getCategories()
    {
//        $sql = "select * from {$this->tableName} order by corder asc";
//        $a = $this->db->query($sql)->result_array();
        $tmp_trees = array();
        
        $a = $this->cateList;
        //遍历全部分类
        foreach ($a as $k => $v) {
            if (REWRITE) {
                $v['surl'] = base_url('web/'.$v['id'].'/index.html');
            } else {
                $v['surl'] = base_url('web/article/lists?cid='.$v['id']);
            }
            //绑定了主域名的分类优先
//            if ($v['cdomain'] != '') {
//                $v['surl'] = $v['cdomain'];
//            }else{
//                $v['surl'] = preg_replace('~^(http://.*?)/(.*?)$~',$this->cate_parent_cdomain($v['id']).'/${2}',$v['surl']);
//            }
            //跳转链接优先
            if (!empty($v['go_url'])) {$v['surl'] = $v['go_url'];}

            //print_r($v);die();
            //遍历查询子类
//            $sql = "select * from {$this->tableName} where parent_id='{$v['id']}' order by corder asc";
//            $rs = $this->db->query($sql)->result_array();
            $rs = $this->cate_son($v['id']);
            $v['son'] = $rs;
            //遍历子类修改URL
            foreach ($v['son'] as $ks => $vs) {
                //判断是否绑定域名到站点根目录
                //$host = $vs['cdomain'] == '' ? DOMAIN_SITE : $vs['cdomain'];
                //print_r($host);die();
                if (REWRITE) {
                    $v['son'][$ks]['surl'] = base_url('web/'.$vs['id'].'/index.html');
                } else {
                    $v['son'][$ks]['surl'] = base_url('web/Article/lists?id='.$vs['id']);
                }
                //绑定了主域名的分类优先
//                if ($vs['cdomain'] != '') {
//                    $v['son'][$ks]['surl'] = $vs['cdomain'];
//                }else{
//                    $v['son'][$ks]['surl'] = preg_replace('~^(http://.*?)/(.*?)$~',$this->cate_parent_cdomain($vs['cate_id']).'/${2}',$v['son'][$ks]['surl']);
//                }
                //跳转链接优先
                if (!empty($vs['go_url'])) {$v['son'][$ks]['surl'] = $vs['go_url'];}
            }
            $tmp_trees[$v['id']] = $v;
        }
        return $tmp_trees;
    }

    /**
     * 根据分类ID返回完整树形
     *
     * @param  $type 为空输出全部分类，为其他数字则返回各自类型的树
     * @param  $cate_id 分类ID，为0则返回全部树
     */
    public function cate_tree($type = '', $cate_id = 0) {
        $tree = array();
        if ($cate_id == 0) {
            foreach($this -> cateList as $c) {
                if ($type == '') {
                    if ($c['parent_id'] == 0) {
                        array_push($tree, $c);
                        $tree[count($tree)-1]['son'] = $this -> cate_son($c['cate_id']);
                    }
                } else {
                    if ($c['parent_id'] == 0 ) {
                        array_push($tree, $c);
                        $tree[count($tree)-1]['son'] = $this -> cate_son($c['cate_id']);
                    }
                }
            }
        } else {
            $tree = $this -> cate_son($cate_id);
        }
        
        return $tree;
    }
    
    /**
     * 判断分类是否为终极分类
     *
     * @param  $cate_id 分类ID
     * @param  $categories 树形目录
     */
    public function cate_last($cate_id, $categories = '') {
        $a = $categories == ''?$this -> cateList:$categories;
        foreach($a as $b) {
            if ($b['parent_id'] == $cate_id) return 1;
        }
        return 0;
    }
    
    /**
     * 取分类的子分类，返回数组，树形结构
     *
     * @param  $cate_id 分类ID
     * 返回值为树形，因为子分类有可能是多分支的
     */
    public function cate_son($cate_id) {
        $ret = array();
        foreach($this -> cateList as $c) {
            if ($c['parent_id'] == $cate_id) {
                $c['son'] = $this -> cate_son($c['id']);
                array_push($ret, $c);
            }
        }
        return $ret;
    }
    
    /**
     * 返回分类下面的所有子分类的数组，平级结构
     * @param type $cate_id
     * @return type
     */
    public function cateAllSon($cate_id){
        $ret = array();
        
        foreach($this -> cateList as $c) {
            if ($c['parent_id'] == $cate_id) {
                array_push($ret, $c);
                $ret2 = $this -> cateAllSon($c['id']);
                $ret = array_merge($ret2,$ret);
            }
        }
        return $ret;
    }

	/**
     * 获取到分类下面的所有子分类
     * @param type $pid
     * @return type
     */
    public function get_son_ids($pid = 1){
        
        $sons = $this->cateAllSon($pid);
        $ids = array($pid=>$pid);
        foreach($sons as $sv){
            $ids[$sv["id"]] = $sv['id'];
        }
        return $ids;
    }

	/**
     * 获取平级目录（水平）
     * @param $cate_id int 目录树id
     */
    public function cate_brother($cate_id=0) {

        $parent_id=$cate_id==0?0:$this->categories[$cate_id]['parent_id'];
        if($cate_id==0 || $parent_id==0){
            $ret=array();
            foreach($this->categories as $v){
                if($v['parent_id']==0) array_push($ret,$v);
            }
            return $ret;
        }else{
            return $this->categories[$parent_id]['son'];
        }
    }
    
    public function show_select($cid=0,$i=0){
        
        $i++;//层级标记
        $font='';//设置层级缩进
        for($j=1;$j<$i;$j++){
            $font.='　';
        }
        $tmp=array();
        if($cid==0){//输出顶级类
            foreach($this->categories as $v){
                if($v['parent_id']==0){
                    //if(!check_level('T'.$v['id'],0,1)) continue;
                    array_push($tmp,array('value'=>$v['id'],'txt'=>$font.$v['cname'],'txt_color'=>''));
                    $a=$this->show_select($v['id'],$i);
                    foreach($a as $v1){
                        array_push($tmp,$v1);
                    }
                }
            }
        }else{//输出子类
            
            foreach($this->categories[$cid]['son'] as $v){
                //if(!check_level('T'.$v['id'],0,1)) continue;
                array_push($tmp,array('value'=>$v['id'],'txt'=>$font.$v['cname'],'txt_color'=>''));
                $a=$this->show_select($v['id'],$i);
                foreach($a as $v1){
                    array_push($tmp,$v1);
                }
            }
        }

        return $tmp;
    }
    
    /**
     * 输出目录树
     * @param -> tree $this->categories['son']数组
     * @param -> expand_func 点击展开收缩的回调方法 expand_func(this)
     * @param -> is_expand_all 是否默认全部展开 1,0
     * @param -> ulevel 传递选中值
     * @param -> checkbox 1,0
     * @param -> url 链接URL，为空或者没有子树(强制输出链接=0)，输出纯文本
     * @param -> url_force 1,0 强制输出链接
     * @param -> click 文本上onclick 函数 onclick="javascript:void(0);";
     * @param -> rtype_last 默认最后一级显示复选框，1,2,3|4,5,6,tid1_path,tid2_path
     * @param -> loop_limit 输出子树级数
     */
    public function show_tree($params){
        //预处理参数
        $tree=$params['tree']=isset($params['tree'])?$params['tree']:array();
        $expand_func=$params['expand_func']=isset($params['expand_func'])?$params['expand_func']:'expand_func(this)';
        $is_expand_all=$params['is_expand_all']=isset($params['is_expand_all'])?$params['is_expand_all']:1;
        if($is_expand_all==1) $expand_func='';
        $ulevel=isset($params['ulevel'])?$params['ulevel']:array();
        $checkbox=$params['checkbox']=isset($params['checkbox'])?$params['checkbox']:0;
        $url=$params['url']=isset($params['url'])?$params['url']:'';
        $url_force=$params['url_force']=isset($params['url_force'])?$params['url_force']:0;
        $click=$params['click']=isset($params['click'])?$params['click']:'';
        $rtype_last=$params['rtype_last']=isset($params['rtype_last'])?$params['rtype_last']:0;
        $loop=$params['loop']=isset($params['loop'])?$params['loop']:1;
        $loop=$params['loop']++;
        $loop_limit=$params['loop_limit']=isset($params['loop_limit'])?$params['loop_limit']:100;
        if($loop>$loop_limit) return;

        //遍历数组
        $html='<ul class="tree">';
        if(is_array($tree)) {
            foreach($tree as $v){
                $vson=@$this->categories[$v['id']]['son'];
                //if(!check_level('T'.$v['id'],0,1)) continue;//判断是否有显示权限
                $open_status='close';
                if($is_expand_all==1) $open_status='open';
                $html.='<li id="li'.$v['id'].'">';
                $html.='<span onclick="tree_icon_click(this'.($expand_func==''?'':','.$expand_func).');" class="tree-icon tree-expand-'.$open_status.'"></span>';
                if(($checkbox==1 || ($rtype_last==1 && count($vson)==0))){
                    //$chk='';if(in_array('T'.$v['id'],$ulevel)) $chk=' checked';
                    $html.='<input type="checkbox" name="level" '.$chk.' value="T'.$v['id'].'" id="T'.$v['id'].'">';
                }

                if($url=='' || (count($vson)==0 && $url_force==0)){
                    $html.='<label for="T'.$v['id'].'"><em '.$click.' class="no_link">'.$v['cname'].'</em></label>';
                }else{
                    $style = isset($_GET['cate_id'])&&$_GET['cate_id'] == $v['id']?'class="selected"':'';
                    $html.='<a '.$style.' href="'.$url.'?cid='.$v['id'].'">'.$v['cname'].'</a>';
                }
                //展开子级
                if(count($vson)>0 && $is_expand_all==1){
                    $params['tree']=$vson;
                    $html.=$this->show_tree($params);
                }
                $html.='</li>';
            }

        }
        $html.='</ul>';
        return $html;
    }
}

/* End of file Category_Model.php */
/* Location: ./application/models/articles/Category_Model.php */