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
 * Setted Model Class
 *
 * 网站配置
 * @package		TzungTzu
 * @subpackage	Models
 * @category	Models
 * @author		TZ Dev Team
 */
class Setted_Model extends TZ_Model
{
	protected $TableName 		= 'sys_configs';
	
	public $SortField			= 'id';

	//primary key
	protected $PKey 	 		= 'id';

	protected $rules	 		= array(
		array('title',  	'required'),
		array('ckey',  	'required'),
		array('cvalue',  	'required')
	);	

	// array('字段名' => '语言包名称')
	protected $field_titles 	= array(
		'title' 	=> 'form_title',
		'ckey' 	=> 'form_ckey',
		'cvalue' 	=> 'form_cvalue',
	);	

	protected $unique 			= array('ckey');

	public function __construct()
	{
		parent::__construct();
	}

    /**
     * 获取到配置值
     * @param type $mixed
     * @return type
     */
    public function get_config($mixed)
    {
        return $this->find_field($mixed, 'ckey', 'cvalue');
    }
}

/* End of file Setted_model.php */
/* Location: ./application/models/system/setted_model.php */