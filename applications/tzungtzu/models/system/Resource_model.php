<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * 资源模型
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
 * Resource Model Class
 *
 * @package		TzungTzu
 * @subpackage	Models
 * @category	Models
 * @author		TZ Dev Team
 */
class Resource_Model extends TZ_Model
{
	protected $TableName 		= 'sys_resources';
	protected $RITableName 		= 'sys_resource_info';
	
	public $SortField 		= 'id';

	//primary key
	protected $PKey 	 		= 'id';

	protected $rules	 		= array(
		array('url',  	'required')
	);	

	// array('字段名' => '语言包名称')
	protected $field_titles 	= array(
		'url' 	=> 'form_url'
	);	

	protected $unique 			= array('url');
	
	public function __construct()
	{
		parent::__construct();
		
	}

    /**
     * 随机获取到一个资源图片
     * @param type $tag
     * @return string
     */
    public function get_image_rand($tag = NULL)
    {
		$this->db->select('id, url, tag');
        
        if ($tag !== NULL){
            $this->set_reserve_filed('tag', array('tag'=>$tag));
        }
		$this->db->where('width <', 700);
		$this->db->order_by('RAND()');
        $query  = $this->db->get($this->TableName, 1);
        $result = $query->row_array();
        $query->free_result();
        unset($query, $tag);
		return $result['url'];
    }
}

/* End of file Resource_Model.php */
/* Location: ./application/models/system/Resource_Model.php */