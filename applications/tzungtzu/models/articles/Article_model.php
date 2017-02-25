<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * 文档模型
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
 * Article Model Class
 *
 * @package		TzungTzu
 * @subpackage	Models
 * @category	Models
 * @author		TZ Dev Team
 */
class Article_Model extends TZ_Model
{
	protected $TableName 		= '';
	
	public $SortField           = 'id';
	//primary key
	protected $PKey 	 		= 'id';

	protected $rules	 		= array(
	);	

	// array('字段名' => '语言包名称')
	protected $field_titles 	= array(
	);	

	public function __construct()
	{
		parent::__construct();
	}
    
    /**
     * 根据标签随机获取5条数据用户微信的回复推送
     * @param type $tag
     * @param type $limit
     */
    public function get_rand($tag = NULL, $limit = 5, $table_name = 'article')
    {
        $this->db->select('id, title, mid, cid, thumb_img, description');
        
        if ($tag !== NULL){
            $this->set_reserve_filed('tag', array('tag'=>$tag));
            $this->db->or_like('title', $tag);
        }
        $this->set_table_name($table_name);
		$this->db->order_by('RAND()');
        $query  = $this->db->get($this->TableName, $limit);
        $result = $query->result_array();
        $query->free_result();
        unset($query, $tag);
		return $result;
    }

    /**
     * 获取到上一条数据
     * @param type $value
     * @param type $field
     * @param string $fields
     * @return type
     */
    public function get_next($value, $field = 'id', $fields = NULL)
    {
        if ($fields === NULL){$fields = '*';}
		$this->db->select($fields);
		$this->db->where($field . ' < ', $value);
		
		$this->db->order_by("`{$field}` ASC");

        $query  = $this->db->get($this->TableName, 1);

        $result = $query->row_array();

        $query->free_result();

        unset($query, $value, $field, $fields);

		return $result;
        
    }

    /**
     * 获取到下一条数据
     * @param type $value
     * @param type $field
     * @param string $fields
     * @return type
     */
    public function get_prev($value, $field = 'id', $fields = NULL)
    {
        if ($fields === NULL){$fields = '*';}
		$this->db->select($fields);
		$this->db->where($field . ' > ', $value);
		
		$this->db->order_by("`{$field}` DESC");

        $query  = $this->db->get($this->TableName, 1);

        $result = $query->row_array();

        $query->free_result();

        unset($query, $value, $field, $fields);

		return $result;
    }

    /**
     * 设置表名称
     * @param type $table_name
     */
    public function set_table_name($table_name)
    {
        $this->TableName = self::TABLE_FIX . $table_name;
    }
    
    public function _where($params = array())
    {
        if (isset($params['ids']) && !empty($params['ids']))
        {
            $this->db->where_in('id', $params['ids']);
        }
		
		if (isset($params['cids']) && !empty($params['cids']))
        {
            $this->db->where_in('cid', $params['cids']);
        }
        
        if (isset($params['cid']) && !empty($params['cid']))
        {
            $this->db->where('cid', $params['cid']);
        }
		if (isset($params['status']) && !empty($params['status']))
        {
            $this->db->where('status', $params['status']);
        }
		
        parent::_where($params);
    }
    
}

/* End of file Article_Model.php */
/* Location: ./application/models/articles/Article_Model.php */