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
 * Advert Model Class
 * 广告
 * @package		TzungTzu
 * @subpackage	Models
 * @category	Advert Model
 * @author		TZ Dev Team
 */
class Advert_Model extends TZ_Model
{
	protected $TableName	= 'ads';
	
	public $SortField 		= 'forder';
	//primary key
	protected $PKey			= 'id';

	protected $rules	 	= array(
        array('ad_title',  'required'),
        array('flink_url',  'required')
	);	

	// array('字段名' => '语言包名称')
	protected $field_titles = array(
        'ad_title'     => 'form_ad_title' ,
	);	

	public function __construct()
	{
		parent::__construct();
	}
    
    /**
     * 根据组id获取到广告
     * @access public
     * @param type $group_id
     * @return array
     */
    public function get_advert_by_group($group_id)
    {
        $this->db->from($this->TableName);
        $this->db->select('*');
        $this->db->where('g_id', $group_id);
        $query  = $this->db->get();
        $result = $query->result_array();

        $query->free_result();

        unset($query);

        return $result;
    }
}

/* End of file Advert_Model.php */
/* Location: ./application/models/extends/Advert_Model.php */