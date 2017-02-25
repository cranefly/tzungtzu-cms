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
 * Material Model Class
 *
 * 微信自动回复
 * 
 * @package		TzungTzu
 * @subpackage	Models
 * @category	Models
 * @author		TZ Dev Team
 */
class Material_Model extends TZ_Model
{
	protected $TableName 		= 'wechat_article';
	
	public $SortField			= 'id';

	//primary key
	protected $PKey 	 		= 'id';

	protected $rules	 		= array(
	);	

	// array('字段名' => '语言包名称')
	protected $field_titles 	= array(
	);	

    public $type_text = array(
        '1' => '多图文',
        '2' => '图文',
        '3' => '图片',
        '4' => '语音',
        '5' => '视频',
    );
    
    public $is_public_text = array(
        '1' => '不公开',
        '2' => '公开',
    );
    public function __construct()
	{
		parent::__construct();
	}
}

/* End of file Material_Model.php */
/* Location: ./application/models/wechat/Material_Model.php */