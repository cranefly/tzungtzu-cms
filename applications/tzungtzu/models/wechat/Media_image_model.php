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
 * Media_more_Model Model Class
 *
 * 多图文素材
 * 
 * @package		TzungTzu
 * @subpackage	Models
 * @category	Models
 * @author		TZ Dev Team
 */
class Media_image_Model extends TZ_Model
{
	protected $TableName 		= 'wechat_image';
	
	public $SortField			= 'id';
	public $SortMode			= 'DESC';

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
    
    protected function _where($params = array())
    {
        if (isset($params['wechat_id'])){
            $this->db->where('wechat_id', $params['wechat_id']);
        }
        if (isset($params['user_id'])){
            $this->db->where('user_id', $params['user_id']);
        }
        parent::_where($params);
    }
}

/* End of file Media_more_Model.php */
/* Location: ./application/models/wechat/Media_more_Model.php */