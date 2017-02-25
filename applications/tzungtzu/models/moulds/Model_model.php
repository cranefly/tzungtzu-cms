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
 * Model Model Class
 * 模型的模型
 * @package		TzungTzu
 * @subpackage	Models
 * @category	Models
 * @author		TZ Dev Team
 */
class Model_Model extends TZ_Model
{

	protected $TableName 		= 'sys_model';
	protected $FieldTableName   = 'sys_fields';
    protected $MFTableName      = 'sys_model_fields';
    public $SortField			= 'forder';
	//primary key
	protected $PKey 	 		= 'id';

	protected $rules	 		= array(
        array('mtitle',  'required'),
        array('mname',  'required'),
	);	

	// array('字段名' => '语言包名称')
	protected $field_titles 	= array(
        'mtitle' => 'form_mtitle' ,
        'mname'  => 'form_mname',
	);	

	protected $unique 		= array('mname');
	
    private $dbprefix       = NULL;
    
    private $model_name      = '';
	public function __construct()
	{
		parent::__construct();
        
        $this->dbprefix = $this->dbprefix === NULL ? $this->db->dbprefix : $this->dbprefix ;
	}
    
    public function _where($params = array())
    {
        if (isset($params['models'])){
            $this->db->where_in('id', $params['models']);
        }
        parent::_where($params);
    }

    /**
     * 根据模型id获取到模型的字段信息
     * @param type $model_id
     * @return type
     */
    public function get_field_by_model_id($model_id)
    {
        $this->db->select('*');
        
        $this->db->from("{$this->FieldTableName} AS a");   
        $this->db->join("{$this->MFTableName} AS b", 'b.field_id = a.id');
        
        $this->db->where('b.model_id', $model_id);
        $query  = $this->db->get();
        $result = $query->result_array();
        
        $query->free_result();
        unset($query);

        return $result;
    }
    
    /**
     * 设置模型名称值
     * @param type $model_name
     */
    public function set_model_name($model_name)
    {
        $this->model_name  = self::TABLE_FIX . $model_name;
    }

    /**
     * 创建模型，包括更新模型（主要是给模型添加新字段)
     * @access public
     * @param type $fields
     * @param type $this->model_name
     * @return type
     */
    public function create_table($fields)
    {
        //表存在就更新字段信息，不处理旧字段，只添加原来没有的字段
        if ($this->is_exist_table($this->model_name)) 
        {
            $colums = $this->_get_table_fields($this->model_name);
            
            foreach($fields as $k => $v){
                if(!in_array($v['field'],$colums)){
                    $this->add_column($v);
                }
            }
            unset($colums);
        }else
        {
            //创建表
            $this->db->query($this->_get_create_table_sql($fields));
        }
        
        return TRUE;
    }

    /**
     * 创建表的sql语句
     * @access private
     * @param type $fields
     * @param type $this->model_name
     * @return string
     */
    private function _get_create_table_sql($fields)
    {
        $sql = "CREATE TABLE IF NOT EXISTS `{$this->dbprefix}{$this->model_name}` (";
        $sql .= " `id` int(11) unsigned not null auto_increment,";
        $sql .= " `mid` int(11) not null default 0 comment '模型ID',";
        $sql .= " `cid` int(11) not null default 0 comment '分类ID',";
        $sql .= " `uid` int(11) not null default 0 comment '用户ID',";
        $sql .= " `forder` int(4) not null default 0 comment '排序',";
        $sql .= " `visited` int(5) not null default 0 comment '访问数',";
        $sql .= " `commented` int(5) not null default 0 comment '评论数',";
        $sql .= " `cdate` int(5) not null default 0 comment '创建时间',";
        $sql .= " `status` tinyint(2) not null default 1 comment '发布状态',";
        foreach($fields as $k => $v){
            $sql .= " `{$v['field']}` {$v['attribute']} DEFAULT '{$v['dvalue']}' COMMENT '{$v['title']}',";
        }
        
        $sql .= " primary key (`id`)) engine=myisam default charset=utf8;";
        
        return $sql;
    }

    /**
     * 判断表是否存在
     * @param type $this->model_name
     * @param type $prefix
     * @return type
     */
    public function is_exist_table()
    {
        $_table_name = $this->dbprefix . $this->model_name;
        $sql = " SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '". $this->db->database ."' AND TABLE_NAME = '{$_table_name}' ";
        
        $this->db->query($sql);
        unset($sql, $_table_name);
        return $this->db->affected_rows() > 0;
    }
    
    /**
     * 获取表已经存在的字段
     * @access private
     * @param type $this->model_name
     * @return array
     */
    private function _get_table_fields(){
        
        $sql = "SHOW COLUMNS FROM ". $this->dbprefix . $this->model_name;
        
        $query =  $this->db->query($sql);
        unset($sql);
        
        $colums = array();
        foreach ($query->result_array() as $row){
            array_push($colums, $row['Field']);
        } 
        unset($query);
        
        return $colums;
    }
            
    /**
     * 给表添加字段
     * @param type $this->model_name
     * @param type $field
     * @return type
     */
    public function add_column($field){
        
        $sql = "ALTER TABLE `{$this->dbprefix}{$this->model_name}` ADD COLUMN `{$field['field']}` {$field['attribute']} DEFAULT '{$field['dvalue']}' COMMENT '{$field['title']}' ";
                    
        return $this->db->query($sql);
    }
}

/* End of file Model_Model.php */
/* Location: ./application/models/moulds/Model_Model.php */