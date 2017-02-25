<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * 权限
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
 * Rank Model Class
 *
 * @package		TzungTzu
 * @subpackage	Models
 * @category	Models
 * @author		TZ Dev Team
 */
class Rank_Model extends TZ_Model
{
	protected $TableName 		= 'users_group';
	
	public $SortField 		= 'id';
	
	protected $StateField		= 'g_state';
	
	public $SortMode			= 'DESC';
	//primary key
	protected $PKey 	 		= 'id';


	public function __construct()
	{
		parent::__construct();
	}
}

/* End of file Rank_Model.php */
/* Location: ./application/models/accounts/Rank_Model.php */