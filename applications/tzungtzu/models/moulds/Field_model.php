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
class Field_Model extends TZ_Model
{
	protected $TableName	= 'sys_fields';
	
	public $SortField 		= 'forder';
	//primary key
	protected $PKey			= 'id';

	protected $rules	 	= array(
        array('title',  'required'),
        array('field',  'required'),
        array('attribute',  'required'),
        array('form_type',  'required')
	);	

	// array('字段名' => '语言包名称')
	protected $field_titles = array(
        'title'     => 'form_title' ,
        'field'     => 'form_field',
        'attribute' => 'form_attribute',
        'form_type' => 'form_form_type',
	);	

	public function __construct()
	{
		parent::__construct();
	}
	
	/*
     * 获取字段标签，方便查看
	 * @access public
	 * 
	 * @return void
     */
    public function get_tags(){
        
        $sql = "SELECT id,field_tag FROM ". $this->db->dbprefix . $this->TableName . " GROUP BY field_tag";
        
        $query =  $this->db->query($sql);
        
		unset($sql);
        return $query->result_array();
    }
	
    /**
     * 获取到模型字段信息，
     * @access public
     * @param type $ids
     * @return type
     */
    public function get_fields_in($ids)
    {
        $this->db->from($this->TableName);
       
        $this->db->where_in('id', $ids);
        
        $query  = $this->db->get();
		
        $result = $query->result_array();

        $query->free_result();
		
        unset($query, $ids);
	
        return $result;
    }
}

/* End of file Field_Model.php */
/* Location: ./application/models/moulds/Field_Model.php */