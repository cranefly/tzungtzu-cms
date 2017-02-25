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
 * Flink Model Class
 * 友链的模型
 * @package		TzungTzu
 * @subpackage	Models
 * @category	Field
 * @author		TZ Dev Team
 */
class Flink_Model extends TZ_Model
{
	protected $TableName	= 'flink';
	
	public $SortField 		= 'forder';
	//primary key
	protected $PKey			= 'id';

	protected $rules	 	= array(
        array('flink_name',  'required'),
        array('flink_url',  'required')
	);	

	// array('字段名' => '语言包名称')
	protected $field_titles = array(
        'flink_name'   => 'form_flink_name' ,
        'flink_url'     => 'form_flink_url',
	);	

	public function __construct()
	{
		parent::__construct();
	}
    
    public function get_flink($group_id = NULL)
    {
        if ($group_id !== NULL){
            $this->db->where('group_id', $group_id);
        }
        return $this->get_all('id, group_id, flink_name, flink_url, flink_img');
    }
}

/* End of file Flink_Model.php */
/* Location: ./application/models/extends/Flink_Model.php */