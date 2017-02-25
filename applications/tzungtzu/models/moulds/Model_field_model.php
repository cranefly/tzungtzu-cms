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
 * Field Model Class
 * 字段的模型
 * @package		TzungTzu
 * @subpackage	Models
 * @category	Field
 * @author		TZ Dev Team
 */
class Model_field_Model extends TZ_Model
{
	protected $TableName	= 'sys_model_fields';
	
	//primary key
	protected $PKey			= 'id';

	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * 获取管理模型信息
	 * @param type $model_id
	 * @return type
	 */
	public function get_field_model($model_id)
	{
        $this->db->from($this->TableName);
       
        $this->db->where('model_id', $model_id);
		
        $query  = $this->db->get();
		
        $result = $query->result_array();

        $query->free_result();
		
        unset($query);
	
        return $result;
	}
	
	/**
	 * 判断模型字段关系是否存在
	 * @param type $model_id
	 * @param type $field_id
	 * @return type
	 */
	public function exist_relation($model_id, $field_id)
	{
		$this->db->select('id');
		$this->db->where('model_id', $model_id);
		$this->db->where('field_id', $field_id);
		
        $query  = $this->db->get($this->TableName, 1);

        $result = $query->row_array();

        $query->free_result();

        unset($query, $model_id, $field_id);

		return count($result) > 0;
		
	}
}

/* End of file Field_Model.php */
/* Location: ./application/models/moulds/Field_Model.php */