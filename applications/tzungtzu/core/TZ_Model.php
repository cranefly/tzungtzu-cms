<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * 基础模型
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
 * TZ Model Class
 *
 * @package		TzungTzu
 * @subpackage	Core
 * @category	Core
 * @author		TZ Dev Team
 */
class TZ_Model extends CI_Model
{
	const TABLE_FIX = 'model_';
    /**
     * 缓存类型
     * @var type 
     */
    public $cache_type       = '1'; // 1=session 2=redis 
    
	//table name
	protected $TableName 	= '';

	//primary key
	protected $PKey 		= 'id';
	protected $PKeyValue 	= '';

	//order field
	protected $FOrder 		= 'forder';
	public $SortField 	    = 'id';
	public $SortMode 	    = 'DESC';
	// 状态字段
    protected $StateField   = '';
	
    // 缓存key
    protected $CacheKey     = 'key';
    /**
     * 模型数据检查规则
     *array(
     *       array('fieldName', 'required'),//必须输入，不能为空
     *       array('fieldName', 'email'),//必须为邮箱
     *       array('fieldName', 'numeric'),//必须为数字
     *       array('fieldName', 'int'),//必须为整数值
     *       array('fieldName', 'minlen', 5),//必须大于5个字符
     *       array('fieldName', 'maxlen', 5),//不能超过5个字符
     *       array('fieldName', 'ip'),//ip
     *       array('fieldName', 'url'),//url
     *       array('fieldName', 'regex'),//正则表达式匹配
     *       array('fieldName', 'callback'),//自定义函数检测
     * 		 array('fieldName', 'qq'),//QQ号
     *   );
     * @var type 
     */
	protected $rules 		= array();

	/**
     * 字段的标题说明
     * array(
     *    'fieldName' => 'title',...
     * )
     * 
     * @var array
     */
    protected $field_titles = array();

	/**
     *校验的错误信息， 格式
     * array(
     *    array('fieldName', 'msg'), ...
     * );
     * @var array
     */
    public $errors 		   = array();

	/**
     * 属性值
     * @var array
     */
    protected $attr 		= array();
    
    /**
     * 唯一字段检查，会根据字段自动判断唯一性，多个表示联合唯一 
     * unique field array('id','uname','uphone'...)
     */
    protected $unique 		= array();

    /**
     * 当前控制模型语言包
     * @var type 
     */
	public $lang_current	= NULL;
	
	public function __construct()
	{
		parent::__construct();

        $this->load->library('TZ_Validation');
	}

	/**
	 * total data
	 *
	 * @access	public
	 * @param $params 
	 * @return	int
	 */
	public function total($params = array())
	{
		$this->db->select($this->PKey);
		$this->db->from($this->TableName);
		$this->_where($params);

        unset($params);
		return $this->db->count_all_results();
	}

	/**
	 * find data
	 *
	 * @access	public
	 * @param	mixed
	 * @param	string
	 * @param	bool
	 * @return	array
	 */
	public function find($value, $field = 'id', $fields = '*')
	{
		$this->db->select($fields);
		$this->db->where($field, $value);
		
		$this->db->order_by("`{$field}` DESC");

        $query  = $this->db->get($this->TableName, 1);

        $result = $query->row_array();

        $query->free_result();

        unset($query, $value, $field, $fields);

		return $result;
	}

    /**
     * 创建一个对象
     * @param type $value 值
     * @param type $field 字段
     * @param type $fields 需要设置的字段
     * @return boolean 返回值
     */
    public function create($value, $field = 'id', $fields = '*')
    {
        $_attrs = $this->find($value, $field, $fields);
        
        if (!empty($_attrs)){
            $this->set_attrs($_attrs);
            unset($_attrs);
            return TRUE;
        }
        
        show_error('Object cannot be created or cannot be found');
    }
    /**
     * 返回具体数据的某个字段
     * 
     * @param type $mixed
     * @param type $field
     * @param type $fields
     * @return type
     */
    public function find_field($mixed, $field = 'id', $fields = '*')
    {
        $info = $this->find($mixed, $field, $fields);
        
        if ($fields === '*')
        {
            return $info;
        }else
        {
            return isset($info[$fields]) ? $info[$fields] : '';
        }
    }

    /**
	 * get list
	 *
	 * @access	public
	 *
	 * @return	array
	 */
	public function lists($params = array())
	{
		$this->db->from("{$this->TableName} AS a");
        
        $this->_where($params);
        unset($params);
        //$this->set_order_mode();
        $this->db->order_by($this->SortField, $this->SortMode);

        $query  = $this->db->get();

        $result = $query->result_array();

        $query->free_result();

        unset($query, $params);

        return $result;
	}

    /**
     * get all 查询所有信息
     *
     * @access  public
     * @param $field 查询字段
     * @return  array
     */
    public function get_all($field = '')
    {
        $_field = empty($field) ? '*' : $field;

        $this->db->select($_field);

        $this->db->order_by($this->SortField, $this->SortMode);

        $query  = $this->db->get($this->TableName);

        $result = $query->result_array();

        $query->free_result();

        unset($query, $field, $_field);
        return $result;
    }
    
	/**
	 * where
	 *
	 * @access	protected
	 * @param array $params 限制条件
	 * @return	void
	 */
	protected function _where($params = array())
	{
		if (isset($params['stype']) && isset($params['svalue']) && !empty($params['stype']) && !empty($params['svalue']))
		{
			$this->db->like($params['stype'], $params['svalue']);
		}
        
        if (isset($params['uid']))
        {
            $this->db->where('uid', $params['uid']);
        }
        unset($params);
	}

	/**
	 * save table data
	 *
	 * @access	public
	 * @param $id
	 * @return	void
	 */
	public function save($data = NULL, $id = 0)
	{
		$return_id = FALSE;

		// check data validation
		if (!$this->check_validation($data))
		{
			return FALSE;
		}
		
		$is_insert = $id == 0 ? TRUE : FALSE;

		// check unique
		if (!$this->checkout_unique($is_insert))
		{
			return FALSE;
		}

        if (!$this->save_before($id, $data)){return FALSE;}
		if ($is_insert)
		{
			// add data
			$return_id = $this->insert($data);
		}else
		{
			// update data
			$return_id = $this->update($data, $id);
		}

        if (!$this->save_after($id, $data)){return FALSE;}
        unset($data, $is_insert);
        
		return $return_id;
	}

	/**
	 * update table data
	 *
	 * @access	public
	 * @param $data
	 * @param $mixed where
	 * @param $field
	 * @param $is_int
	 * @return	boolean
	 */
	public function update($data, $mixed, $field = NULL, $is_int = TRUE)
	{
		if ($field === NULL) {$field = $this->PKey;}

		if (count($data) <= 0 ||
			($is_int == TRUE && intval($mixed) <= 0) ||
			($is_int == FALSE && strlen($mixed) == 0))
		{
			return FALSE;
		}

		if ($is_int == TRUE)
		{
			$this->db->where($field, intval($mixed));
		}
		else
		{
			$this->db->where($field, $mixed);
		}

		$result = $this->db->update($this->TableName, $data);
		unset($data, $mixed);

		return $result;
	}

     /**
     * 更新字段数值，在原有的值上添加数
     * @access public
     * @param type $num
     * @param type $update_field
     * @param type $mixed
     * @param type $field
     * @param type $action
     * @return type
     */
    public function update_num($num, $update_field, $mixed, $field = 'id', $action = '+')
    {
        $sql = "UPDATE {$this->db->dbprefix}{$this->TableName} SET {$update_field} = `{$update_field}`{$action}{$num}  WHERE {$field} = '{$mixed}'";

        $this->db->query($sql);
        unset($sql, $update_field, $mixed, $field);

        return $this->db->affected_rows() > 0;
    }
    
	/**
	 * insert table data
	 *
	 * @access	public
	 * @param $data
	 * @return	int
	 */
	public function insert($data)
	{
		$result = $this->db->insert($this->TableName, $data);
		unset($data);

		if ($result)
		{
			return $this->db->insert_id();
		}

		return FALSE;
	}
	
    /**
     * 批量添加
     * @access public
     * @param type $data
     * @return type
     */
    public function insert_batch($data)
    {
        $result = $this->db->insert_batch($this->TableName, $data);
		unset($data);

		return $result;
    }
	
    /**
     * 重写字段对应的名称，调用语言包，系统化语言包
     * 
     * @access protected
     * @return $this
     */
	protected function get_field_title()
	{
		foreach ($this->field_titles as $key => $value)
		{
			$this->field_titles[$key] = $this->lang_current[$value];
		}
		
		return $this->field_titles;
	}

	/**
     * 检测数据合法性
     * @access public
     * @param $data array
     * @return boolean
     */
    public function check_validation($data)
    {
        if (empty($data)) { return FALSE; }

		$this->get_field_title();

        $this->tz_validation->set_rules($this->rules);
		
        $this->tz_validation->set_field_titles($this->field_titles);

        $validation     =  $this->tz_validation->check_rules($data);

        $this->errors   = $this->tz_validation->errors;

        unset($data);

        return $validation;
    }

	/**
     * 删除记录
     *
     * @access public
     * @param type $mixed
     * @param type $field
     * @return boolean
     */
    public function delete($mixed, $field = 'id') 
    {
    	$this->db->where_in($field, $mixed);

        $this->db->delete($this->TableName);

        unset($mixed, $field);
        return $this->db->affected_rows() > 0;
    }
    
    /**
     * 更多的条件删除记录
     * @access public
     * @param type $where
     * @param type $field
     * @return boolean
     */
    public function deletes($where, $field = 'id') 
    {
        $this->db->where_in($field, explode(',', $where));
        $this->db->delete($this->TableName);

        unset($where, $field);
        return $this->db->affected_rows() > 0;
    }
    
	/**
	 * 批量更新同字段不同值
     *
	 * @access	public
	 * @param $update_data array(array(order=>'1,2,3'),array(visit=>'10,13,16'),...)
     * @param $where_data array('id'=>'2,5,7')
	 * @return	void
	 */
	public function update_list($update_data = array(), $where_data = '')
	{
		$where_field  = key($where_data);
        $where_values = explode(',', $where_data[$where_field]);

        $set_array    = array();

        foreach ($update_data as $key => $update) 
        {
            $set_field  = key($update);
            $set_values = explode(',', $update[$set_field]);
            $set_msg    = "`{$set_field}` = CASE {$where_field}";
                
            //字段数量不匹配的时候返回FALSE
            if (count($set_values) != count($where_values)) { return FALSE;}

            foreach ($where_values as $set_key => $set_value) 
            {
                $_update_value = isset($set_values[$set_key]) ? $set_values[$set_key] : '';

                $set_msg      .= " WHEN {$set_value} THEN '{$_update_value}' ";
                unset($_update_value);
            }

            $set_msg    .= 'END';
            $set_array[] = $set_msg;

            unset($set_msg);
        }

        if (empty($set_array)){return FALSE;}

        $set_query  = implode(' , ', $set_array);

        $set_sql    = "UPDATE {$this->db->dbprefix}{$this->TableName} SET {$set_query} WHERE {$where_field} IN ({$where_data[$where_field]})";

        $this->db->query($set_sql);

        unset($where_values, $set_array, $update_data, $where_data, $set_query, $set_sql);
        return $this->db->affected_rows() > 0;
	}

    /**
     * 修改记录状态
     *
     * @access public
     * @param $ids
     * @param $state
     * @return boolean
     */
    public function update_state($ids, $state)
    {
        $sql = "UPDATE {$this->db->dbprefix}{$this->TableName} SET {$this->StateField} = {$state} WHERE {$this->PKey} IN ($ids)";

        $this->db->query($sql);
        unset($sql, $ids, $state);

        return $this->db->affected_rows() > 0;
    }
	/**
	 * 设置排序
	 * @access public
	 * @param type $field
	 * @param type $mode
	 * @return void
	 */
	public function set_order_mode($field = 'id', $mode = 'DESC')
	{
		if (empty($field) || empty($mode)){return;}
		$this->db->order_by($field, $mode);
	}

	/**
     * 分页
	 * @access 
     * @param int $page
     * @param int $page_size
     * @return void
     */
    public function page($page, $page_size = NULL) 
	{
		if ($page_size == NULL){
			$page_size = TZ_PAGESIZE;
		}
		
        if ($page < 1) {
            $offset = 0;
        } else {
            $offset = $page_size * (intval($page) - 1);
        }
        
        return $this->db->limit($page_size, $offset);
    }

    /**
     * 检测唯一性
     *
     * @access public
     * @param $is_insert
     * @return boolean 
     */
    public function checkout_unique($is_insert = TRUE)
    {     
        foreach($this->unique as $unique)
        {
            if($is_insert){

                if($this->unique(array($unique.' = "' . $this->$unique . '"'), $unique))
                {
                    $this->errors[] = array($unique,sprintf($this->lang_current['model_error_unique'],  $this->field_titles[$unique]));

                    return FALSE;
                }
            }else
            {
                if($this->unique(array($unique.' = "' . $this->$unique . '"', $this->PKey." != " . $this->get_PKeyValue()),$unique)){
                    $this->errors[] = array($unique,sprintf($this->lang_current['model_error_unique'],  $this->field_titles[$unique]));

                    return FALSE;
                }
            }
        }

        return TRUE;
    }

    /**
     * 检测唯一性查询
     *
     * @access public
     * @param $where array
     * @return boolean 
     */
    public function unique($where, $field = NULL)
    {
        $f      = $field !== NULL ? $field : $this->PKey;
        $_where = implode(" AND ", $where);
        
        $sql    = " SELECT {$f} FROM {$this->db->dbprefix}{$this->TableName} WHERE {$_where} LIMIT 1";
       
        $this->db->query($sql);
       
       	unset($sql, $_where);

        return $this->db->affected_rows() > 0;
    }

    /**
     * 自动识别 设置查询字段
     * @access public 
     * @param $field_name 
     * @param $field_value  array|string
     * @return void
     */
    public function set_reserve_filed($field_name, $field_value = '')
    {
        if (is_array($field_value))
        {
            $count = count($field_value);
            if ($count > 0)
            {
                if ($count == 2 && (is_date($field_value[0]) || is_date($field_value[1])))
                {
                    $field_value[0] = replace_empty($field_value[0], $field_value[1]);
                    $field_value[1] = replace_empty($field_value[1], $field_value[0]);

                    if (strlen($field_value[0]) > 0 && strlen($field_value[1]) > 0)
                    {
                        $this->db->where("{$field_name} BETWEEN '{$field_value[0]}' AND '{$field_value[1]}'");
                    }
                }
                else
                {
                    $sqlstr = '';
                    foreach ($field_value as $item)
                    {
                        if (strlen($item) > 0)
                        {
                            if (strlen($sqlstr) > 0) $sqlstr .= ' OR ';
                            $sqlstr .= "FIND_IN_SET('{$item}', `{$field_name}`)";
                        }
                    }

                    if (strlen($sqlstr) > 0)
                    {
                        $this->db->where("({$sqlstr})");
                    }
                }
            }
        }
        else if (strlen($field_value) > 0)
        {
            $this->db->where($field_name, $field_value);
        }
    }

    /**
     * 设置时间查询
     * @access public 
     * @param $field_name 
     * @param $field_value  array
     * @param $is_unix 在数据库是否为时间戳格式
     * @return void
     */
    public function set_date_filed($field_name, $field_value = array(), $is_unix = FALSE)
    {
        if(!isset($field_value[1])){ $field_value[1] = '';}
        
        if (!is_array($field_value) || 
            count($field_value) != 2 ||
            (!is_date($field_value[0]) && !is_date($field_value[1]))) 
        {
            return FALSE;
        }

        $field_value[0] = replace_empty($field_value[0], $field_value[1]);
        $field_value[1] = replace_empty($field_value[1], $field_value[0]);
        
        if ($is_unix === FALSE) 
        {
            $this->db->where("{$field_name} BETWEEN '{$field_value[0]} 0:0:0' AND '{$field_value[1]} 23:59:59'");
        }
        else
        {
            $field_value[0] = strtotime("{$field_value[0]} 0:0:0");
            $field_value[1] = strtotime("{$field_value[1]} 23:59:59");

            $this->db->where("({$field_name} >= {$field_value[0]} AND {$field_name} <= {$field_value[1]})");
        }
    }

    /**
     * 设置缓存key
     * @param type $key
     */
    public function set_cache_key($key = NULL)
    {
        if ($key === NULL){$key = $this->TableName;}
        $this->CacheKey = $key;
    }
    
    /**
     * 获取到缓存key
     * @return type
     */
    public function get_cache_key()
    {
        return $this->CacheKey;
    }
    /**
     * 实例化缓存数据，并且可以通过$this->model->Id这样的形式获取数据
	 * Init user data
	 *
	 * @access	public
	 *
	 * @return	void
	 */
	public function init_data()
	{
		$_data = $this->get_access();
        if(!empty($_data)){
            $this->set_attrs($_data);
        }
        unset($_data);
    }
    
    /**
     * 设置缓存信息
     * 
     * @param type $data
     * @param type $time
     */
    public function set_access($data, $time = 36000)
    {
        switch ($this->cache_type){
            case 1:
                $this->set_session($data);
                break;
            case 2:
                $this->set_redis($data, $time);
                break;
        }
    }
    
    /**
     * 获取缓存信息
     */
    public function get_access()
    {
        $data = array();
        switch ($this->cache_type){
            case 1:
                $data = $this->get_session();
                break;
            case 2:
                $data = $this->get_redis();
                break;
        }
        return $data;
    }

    /**
     *  设置redis信息
     * @param type $data
     */
    public function get_redis()
    {
        return $this->tz_redis->get($this->get_cache_key());
    }
    
    /**
     * 获取session信息
     * 
     * @param type $key 缓存值
     * @return type
     */
    public function get_session()
    {
        return $this->session->userdata($this->get_cache_key());
    }
    
    /**
     *  设置redis信息
     * @param type $data
     */
    public function set_redis($data, $time)
    {
        $this->tz_redis->set($this->get_cache_key(), $data, $time);
    }
    
    /**
     * 设置session信息
     * 
     * @param type $data
     * @return boolean
     */
    public function set_session($data)
    {
        $this->session->set_userdata(array($this->get_cache_key() => $data));
        unset($data);
    }
    
	/**
     * 设置主键值
     * @param mixed $value
     * @return \Base 
     */
    public function set_PKeyValue($value) 
    { 
        $this->PKeyValue = $value;
        return $this;
    }
    
    /**
     * 取得主键值
     * @return mixed
     */
    public function get_PKeyValue()
    {
        return $this->PKeyValue;
    }

    /**
     * 设置属性值
     * @param array $attrs
     * @return \Basic
     */
    public function set_attrs($attrs) 
    {
        $this->attr = array_merge($this->attr, $attrs);
        return $this;
    }

    /**
     * 执行保存操作之前
     * @param type $id
     * @param type $data
     * @return boolean
     */
    public function save_before($id, $data = array())
    {
        unset($id, $data);
        return TRUE;
    }
    /**
     * 执行保存操作之后
     * @param type $id
     * @param type $data
     * @return boolean
     */
    public function save_after($id, $data = array())
    {
        unset($id, $data);
        return TRUE;
    }
    /**
     * 取得属性值
     * @param string $key
     * @return mixed
     */
    public function __get($key) 
    {
        if (isset($this->attr[$key])) {
            return $this->attr[$key];
        } else {
            return parent::__get($key);
        }
    }
    
    /**
     * 设置属性值
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value) 
    {
        $this->attr[$name] = $value;
    }
    
    /**
     * 判断属性是否存在
     * @param string $name
     * @return boolean
     */
    public function __isset($name) 
    {
        return isset($this->attr[$name]);
    }
    
    /**
     * 删除属性
     * @param type $name
     */
    public function __unset($name) 
    {
        unset($this->attr[$name]);
    }
}

/* End of file TZ_Model.php */
/* Location: ./application/core/TZ_Model.php */