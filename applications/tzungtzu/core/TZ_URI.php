<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * 
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
 * URI Class
 *
 * 解决URI中包含中文的问题
 *
 * @package		 SmartCall
 * @subpackage      Libraries
 * @category        Libraries
 * @author          TZ Dev Team
 */

class TZ_URI extends CI_URI
{
	function _filter_uri($str)
	{
		$result = trim($str);
		if ($result != '' AND $this->config->item('permitted_uri_chars') != '')
		{
			$result = urlencode(mb_convert_encoding($result, $this->config->item('charset'), 'gb2312'));
			if (!preg_match("|^[" . str_replace(array('\\-', '\-' ), '-', preg_quote($this->config->item('permitted_uri_chars'), '-')) . "]+$|i", $result))
			{
				show_error('The URI you submitted has disallowed characters.', 400);
			}
			$result = urldecode($result);
		}
		return $result;
	}
}

/* End of file TZ_URI.php */
/* Location: ./applications/tzwechat/core/TZ_URI.php */