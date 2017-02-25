<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * 字段模型
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
 * Fields Model Class
 *
 * @package		TzungTzu
 * @subpackage	Models
 * @category	Models
 * @author		TZ Dev Team
 */
class Fields_Model extends TZ_Model
{
    protected $PickTableName    = 'sys_fields_picklist';
    protected $TableName 		= 'sys_fields';
	
	public $SortField 		= 'forder';

	//primary key
	protected $PKey 	 		= 'fid';

	protected $rules	 		= array(
		//array('url',  	'required')
	);	

	// array('字段名' => '语言包名称')
	protected $field_titles 	= array(
		'antistop' 	=> 'form_antistop'
	);	

	protected $unique 			= array('antistop');

	public function __construct()
	{
		parent::__construct();
		
	}
    
    /**
     * 通过字段id获取到字段详细信息
     * @access public
     * @param type $id
     * @return type
     */
    public function get_field($id)
    {
        $field = $this->find($id);
        $picklist = $this->get_picklist($id);
        
        return $this->get_detail($field, $picklist);
    }
    
    /**
     * 通过字段关键字获取到字段详细信息
     * @access public
     * @param type $antistop
     * @return type
     */
    public function get_field_antistop($antistop)
    {
        $field = $this->find($antistop, 'antistop');
        $picklist = $this->get_picklist($field['id']);
        
        return $this->get_detail($field, $picklist);
    }

    /**
     * 获取字段的值列表信息
     *
     * @access public
     * @param type $fid
     * @param type $pid
     * @return type 
     */
    public function get_picklist($fid, $pid = NULL)
    {
        if ($pid !== NULL){
            $this->db->where('pid', $pid);
        }
        $this->db->from($this->PickTableName);
		$this->db->select('id, fid, pid, pname, pvalue, forder');
		$this->db->where('fid',$fid);
		$this->db->order_by('id', 'DESC');

		return $this->db->get()->result_array();
    }
    
    /**
     * 把字段组合成数组，方便渲染html的时候操作
     * @param type $field
     * @param type $pick
     * @return array
     */
    public function get_detail($field = NULL, $pick = NULL)
    {
        $data = array();
        
        if ($field !== NULL)
        {
            $data['field'] = $field;
        }
        
        if ($pick !== NULL)
        {
            $data['pick'] = $pick;
        }
        return $data;
    }
}

/* End of file fields_model.php */
/* Location: ./application/models/system/fields_model.php */