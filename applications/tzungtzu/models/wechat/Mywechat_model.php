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
 * Mywechat Model Class
 *
 * 微信号模型
 * 
 * @package    TzungTzu
 * @subpackage	Models
 * @category	Wechat
 * @author		TZ Dev Team
 */
class Mywechat_Model extends TZ_Model
{
	protected $TableName 		= 'wechat';
	
	public $SortField			= 'id';
	public $SortMode			= 'DESC';

	//primary key
	protected $PKey 	 		= 'id';

	protected $rules	 		= array(
		array('name',  	   'required'),
		array('appid',     'required'),
		array('appsecret', 'required'),
	);	

	// array('字段名' => '语言包名称')
	protected $field_titles 	= array(
		'name'      => 'form_name',
		'appid' 	=> 'form_appid',
		'appsecret' => 'form_appsecret',
	);	

    public $encode_type_txt = array(
        '1' => '明文模式',
        '2' => '兼容模式',
        '3' => '安全模式',
    );
    
    public $cache_type       = '1'; // 1=session 2=redis 
    
    public function __construct()
	{
		parent::__construct();
        
        $this->init_data();
	}
    
}

/* End of file Mywechat_Model.php */
/* Location: ./application/models/wechat/Mywechat_Model.php */