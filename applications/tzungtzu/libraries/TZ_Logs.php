<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * 操作日志
 *
 * @package	 TzungTzu
 * @author      TZ Dev Team
 * @copyright   Copyright (c) 2012-2024, TzungTzu.com.
 * @license	 http://tzungtzu.com/doucmentss/license.html
 * @link		 http://tzungtzu.com/
 * @since	     Version 1.0.0
 */
// ------------------------------------------------------------------------

/**
 * TZ Logs Class
 *
 * @package	TzungTzu
 * @subpackage	Libraries
 * @category	tz logs
 * @author		TZ Dev Team
 */
class TZ_Logs
{
	private $_ci				= NULL;

	//logs table name
	private $logs_table_name	= 'sys_log';

	public function __construct()
	{
		$this->_ci = &get_instance();
	}

	/**
	 * insert logs
	 *
	 * @access  public
	 * @param string
	 * @param int
	 * @param int
	 * @param string
	 * @return  int
	 */
	public function insert($content, $tag = 'SYS', $info_id = 0, $model_id = 0)
	{
		$logs_data = array(
			'uid'       => $this->_ci->tz_user->UId,
			'uname'     => $this->_ci->tz_user->UName,
			'content'   => $content,
			'cdate'     => time(),
			'ip'		=> $this->_ci->input->ip_address(),
			'tag'       => $tag,
			'info_id'   => $info_id,
			'model_id'  => $model_id,
		);

		$log_id = $this->_ci->db->insert($this->logs_table_name, $logs_data);

		unset($logs_data, $content, $tag, $info_id, $model_id);
		return $log_id;
	}

	/**
	 * get log
	 *
	 * @access  public
	 * @param int
	 * @param int
	 * @return  array
	 */
	public function get($info_id, $model_id)
	{
		$sql	= "SELECT * FROM {$this->logs_table_name} WHERE info_id = {$info_id} and model_id = {$model_id}";

		$query  = $this->_ci->db->query($sql);

		return $query->result();
	}

	 /**
	 * get log html
	 *
	 * @access  public
	 * @param int
	 * @param int
	 * @return  string
	 */
	public function get_html($info_id, $model_id)
	{
		return '';
	}
}

/* End of file TZ_Logs.php */
/* Location: ./application/libraries/TZ_Logs.php */

