<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * 字段选值
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
 * Picklist Model Class
 *
 * @package		TzungTzu
 * @subpackage	Models
 * @category	Models
 * @author		TZ Dev Team
 */
class Picklist_Model extends TZ_Model
{
	protected $TableName 		= 'sys_fields_picklist';
	
	public $SortField 		= 'forder';

	//primary key
	protected $PKey 	 		= 'id';

	//array('url',  	'required')
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
     * 根据fid获取到字段下面的预设值
     * @access public
     * 
     * @param type $fid
     * @return array
     */
    public function get_picklist($fid, $pid = NULL)
    {
        $this->db->select('*');

        $this->db->order_by($this->SortField, $this->SortMode);
        $this->db->where('fid', $fid);
        
        if ($pid !== NULL)
        {
            $this->db->where('pid', $pid);
        }
        $query  = $this->db->get($this->TableName);

        $result = $query->result_array();

        $query->free_result();

        unset($query, $fid);
        return $result;
    }
}

/* End of file picklist_model.php */
/* Location: ./application/models/system/picklist_model.php */