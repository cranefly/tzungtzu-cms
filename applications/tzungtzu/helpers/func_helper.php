<?php
/**
 * 创建订单号
 *
 * @return	string
 */
if (!function_exists('create_trade'))
{
	function create_trade()
	{
        return 'TZ' . time() . rand(1000, 9999);
    }
}

/**
 * 生成uuid
 *
 * @return	string
 */
if (!function_exists('create_uuid'))
{
	function create_uuid()
	{
		return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
				mt_rand(0, 0xffff), mt_rand(0, 0xffff),
				mt_rand(0, 0xffff),
				mt_rand(0, 0x0fff) | 0x4000,
				mt_rand(0, 0x3fff) | 0x8000,
				mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
			);
	}
}

/**
 * 格式化时间
 *
 * @access	public
 * @param	string	时间串
 * @param	string	预定义格式
 * @param	array	语言包
 * @return	string
 */
if (!function_exists('format_date'))
{
	function format_date($datetime, $format = 'Y-m-d', $lang = NULL)
	{
		if ($format == '#' || $format == '*')
		{
			if ($datetime)
			{
		
				if ($format == '#')
				{
					if (date_difference(AT_DATEPART_MINUTE, $datetime) < 3)
					{
						return '刚刚';
					}
					else if (date_difference(AT_DATEPART_MINUTE, $datetime) < 60)
					{
						return date_difference(AT_DATEPART_MINUTE, $datetime) . '分钟前';
					}
					else if (date_difference(AT_DATEPART_HOUR, $datetime) < 24)
					{
						return date_difference(AT_DATEPART_HOUR, $datetime) . '小时前';
					}
					else if (date_difference(AT_DATEPART_DAY, $datetime) == 1)
					{
						return '昨天';
					}
					else if (date_difference(AT_DATEPART_MONTH, $datetime) == 0)
					{
						return date('n月j日', strtotime($datetime));
					}
					else
					{
						return date('Y年n月j日', strtotime($datetime));
					}
				}
				else
				{
					if (date_difference(AT_DATEPART_HOUR, $datetime) < 24)
					{
						return date('H:i', strtotime($datetime));
					}
					else if (date_difference(AT_DATEPART_MONTH, $datetime) == 0)
					{
						return date('n月j日 H:i', strtotime($datetime));
					}
					else
					{
						return date('Y年n月j日 H:i', strtotime($datetime));
					}
				}
			}
			else
			{
				return;	
			}
		}
		else
		{
			$timestamp = $datetime;
			if (!is_numeric($timestamp))
			{
				$timestamp = strtotime($timestamp);
			}
			if ($timestamp <= 0)
			{
				return;
			}
			return date($format, $timestamp);
		}
	}
}


/**
 * 比较两个时间差
 *
 * @access	public
 * @param	int			DatePart
 * @param	datetime	开始时间
 * @param	datetime	结束时间
 * @return	int
 */
if (!function_exists('date_difference'))
{
	function date_difference($datepart = AT_DATEPART_DAY, $startdate, $enddate = '')
	{
		$format = 'Y-m-d H:i:s';
		$userbase = 1;

		if (strlen($enddate) == 0)
		{
			$enddate = date($format);
		}
		switch ($datepart)
		{
			case AT_DATEPART_YEAR:
				return date('Y', strtotime($enddate)) - date('Y', strtotime($startdate));

			case AT_DATEPART_MONTH:
				$year_diff = date('Y', strtotime($enddate)) - date('Y', strtotime($startdate));
				$month_diff = date('m', strtotime($enddate)) - date('m', strtotime($startdate));
				return $year_diff * 12 + $month_diff;

			case AT_DATEPART_DAY:
				$format = 'Y-m-d';
				$userbase = 86400;
				break;

			case AT_DATEPART_HOUR:
				$format = 'Y-m-d H:00:00';
				$userbase = 3600;
				break;

			case AT_DATEPART_MINUTE:
				$format = 'Y-m-d H:i:00';
				$userbase = 60;
				break;

			default:
				break;
		}

		$start_stamp = strtotime(date($format, strtotime($startdate)));
		$end_stamp = strtotime(date($format, strtotime($enddate)));
		$datediff = $end_stamp - $start_stamp;

		return ceil($datediff / $userbase);
	}
}

/**
 * Show unauthorized page
 *
 * @access    public
 * @return    void
 */
if (!function_exists('show_unauthorized'))
{
	function show_unauthorized()
	{
		@ob_clean();
		ob_start();
		include(APPPATH . 'errors/error_purview.php');
		$buffer = ob_get_contents();
		ob_end_clean();
		echo $buffer;
		exit();
	}
}

/**
 * get browser name
 *
 * @access    public
 * @return    string
 */
if (!function_exists('get_browser_name'))
{
	function get_browser_name(){
		$agent = $_SERVER["HTTP_USER_AGENT"];
        
        if (strpos($agent,"MicroMessenger") !== FALSE)
            return 'weixin';
		else if(strpos($agent,'MSIE') !== false || strpos($agent,'rv:11.0')) //ie11判断
			return "ie";
		else if (strpos($agent,'Firefox') !== false)
			return "firefox";
		else if (strpos($agent,'Chrome') !== false)
			return "chrome";
		else if (strpos($agent,'Opera') !== false)
			return 'opera';
		else if ((strpos($agent,'Chrome') == false) && strpos($agent,'Safari') !== false)
			return 'safari';
        else
			return 'unknown';
	}
}

/**
 * get browser version
 *
 * @access    public
 * @return    string
 */
if (!function_exists('get_browser_version'))
{
	function get_browser_version(){
		if (empty($_SERVER['HTTP_USER_AGENT'])){ //当浏览器没有发送访问者的信息的时候
			return 'unknow';
		}
		$agent= $_SERVER['HTTP_USER_AGENT'];
		if (preg_match('/MSIE\s(\d+)\..*/i', $agent, $regs))
			return $regs[1];
		elseif (preg_match('/FireFox\/(\d+)\..*/i', $agent, $regs))
			return $regs[1];
		elseif (preg_match('/Opera[\s|\/](\d+)\..*/i', $agent, $regs))
			return $regs[1];
		elseif (preg_match('/Chrome\/(\d+)\..*/i', $agent, $regs))
			return $regs[1];
		elseif ((strpos($agent,'Chrome')==false)&&preg_match('/Safari\/(\d+)\..*$/i', $agent, $regs))
			return $regs[1];
		else
			return 'unknow';
	}
}

/**
 * 取得提交的数据
 * @return array
 */
if (!function_exists('get_args'))
{
    function get_args() {

        $ci = & get_instance();

        $return = array();
        $fields = func_get_args();
        foreach ($fields as $value) {
            $return[$value] = trim($ci->input->get_post($value));
        }

        return $return;
    }
}

/**
 * 判断字符串是否为日期
 *
 * @access	public
 * @param	string
 * @return	bool
 */
if (!function_exists('is_date'))
{
	function is_date($str = '')
	{
		if (!isset($str))
		{
			return FALSE;
		}
		return preg_match('/^(([1-9][0-9]{3})-((0?2-(0?[1-9]|[12][0-9]))|(0?[469]|11)-(0?[1-9]|[12][0-9]|30)|(0?[13578]|1[02])-(0?[1-9]|[12][0-9]|3[01])))$/', $str);
	}
}

/**
 * 生成随机字串
 * @param number $length 长度，默认为16，最长为32字节
 * @return string
 */
if (!function_exists('generateNonceStr'))
{
    function generateNonceStr($length=16)
    {
        // 密码字符集，可任意添加你需要的字符
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for($i = 0; $i < $length; $i++)
        {
            $str .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $str;
    }
}

/**
 * 空值替换
 *
 * @access    public
 * @param     string
 * @param     string
 * @return    string
 */
if (!function_exists('replace_empty'))
{
	function replace_empty($string = '', $replace = '--') 
	{ 
		$result = $replace;
		if (isset($string) && strlen($string) > 0)
		{
			$result = $string;
		}
		return $result;
	}
}

/**
 * 去除所有空字符串
 */
if (!function_exists('trimall'))
{
    function str_split_unicode($str, $l = 0) {
        if ($l > 0) {
            $ret = array();
            $len = mb_strlen($str, "UTF-8");
                for ($i = 0; $i < $len; $i += $l) {
                $ret[] = mb_substr($str, $i, $l, "UTF-8");
                }
            return $ret;
        }
        return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
    }
}

/**
 * 空值替换
 *
 * @access    public
 * @param     string
 * @param     string
 * @return    string
 */
if (!function_exists('replace_empty'))
{
	function replace_empty($string = '', $replace = '--') 
	{ 
		$result = $replace;
		if (isset($string) && strlen($string) > 0)
		{
			$result = $string;
		}
		return $result;
	}
}

if (!function_exists('curl_request'))
{
    function curl_request($url, $header = array(), $body = array(), $json = TRUE){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 执行HTTP请求
        curl_setopt($ch , CURLOPT_URL , $url);
        $res = curl_exec($ch);
        
        return $json ? json_decode($res, TRUE) : $res;
    }
}
/* End of file func_helper.php */
/* Location: ./application/helpers/func_helper.php */