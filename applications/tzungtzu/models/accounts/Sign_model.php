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
 * Sign Model Class
 *
 * @package		TzungTzu
 * @subpackage	Models
 * @category	Sign
 * @author		TZ Dev Team
 */
class Sign_Model extends TZ_Model
{
	protected $TableName 		= 'sys_sign';
	
	public $SortField           = 'id';
	
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

    /**
     * 用户签到
     * @param type $user_id
     * @return type
     */
    public function do_sign($openid)
    {
        $data = array(
            'openid' => $openid,
            'cdate' => time(),
            'sign_date' => time(),
            'type' => 0
        );
        return $this->insert($data);
    }
    
    public function _where($params = array())
    {
        if (isset($params['user_id'])){
            $this->db->where('user_id', $params['user_id']);
        }
        if (isset($params['openid'])){
            $this->db->where('openid', $params['openid']);
        }
        if (isset($params['sign_date'])){
            $this->set_date_filed('sign_date', $params['sign_date'], TRUE);
        }
        parent::_where($params);
    }

    /**
     * 当天是否签到
     * @param type $openid
     * @return type
     */
    public function is_sign($openid)
    {
        $lists = $this->lists(array('openid' => $openid, 'sign_date' => array(date('Y-m-d', time()),'')));
        
        return empty($lists) ? FALSE : TRUE;
    }
}

/* End of file Sign_Model.php */
/* Location: ./application/models/accounts/Sign_Model.php */