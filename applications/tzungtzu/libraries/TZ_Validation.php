<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * 数据字段验证
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
 * TZ Validation Class
 *
 * @package		TzungTzu
 * @subpackage	Libraries
 * @category	Libraries
 * @author		TZ Dev Team
 */
class TZ_Validation
{
	private $_ci		= NULL;
	/**
     *array(
     *       array('fieldName', 'required'),//必须输入，不能为空
     *       array('fieldName', 'email'),//必须为邮箱
     *       array('fieldName', 'numeric'),//必须为数字
     *       array('fieldName', 'int'),//必须为整数值
     *       array('fieldName', 'minlen', 5),//必须大于5个字符
     *       array('fieldName', 'maxlen', 5),//不能超过5个字符
     *       array('fieldName', 'ip'),//ip
     *       array('fieldName', 'url'),//url
     *       array('fieldName', 'regex','/reg/'),//正则表达式匹配
     *       array('fieldName', 'callback'),//自定义函数检测
     *       array('fieldName', 'qq'),//QQ号
     *   );
     * @var type 
     */
    private $rules        = array();

    /**
     * 字段的标题说明
     * array(
     *    'fieldName' => 'title',...
     * )
     * 
     * @var array
     */
    private $field_titles = array();

	private $_lang_common_path = 'common';
	
	private $_lang_common = NULL;
	/**
     *校验的错误信息， 格式
     * array(
     *    array('fieldName', 'msg'), ...
     * );
     * @var array
     */
    public $errors       = array();

	
	public function __construct()
	{
		$this->_ci = &get_instance();
		$this->_ci->lang->load($this->_lang_common_path, 'chinese');
		$this->_lang_common = $this->_ci->lang->language;
	}

	/**
     * 设置规则
     * @access public
     * @param array $data
     * @return void
     */
    public function set_rules($rules)
    {
        $this->rules = $rules;
    }

    /**
     * 设置字段
     * @access public
     * @param array $data
     * @return void
     */
    public function set_field_titles($field_titles)
    {
        $this->field_titles = $field_titles;
    }

    /**
     * 检测数据是否有效
     * @access public
     * @param array $data
     * @return boolean
     */
    public function check_rules($data) 
    {
        $this->errors = array();
        foreach ($this->rules as $rule) {
            
            $field_name     = array_shift($rule);
            $rule_name  = array_shift($rule);
            $method     = '_rule' . $rule_name;
            
            if (isset($data[$field_name])) {
                
                if ($rule_name != 'required' && $data[$field_name] == '') {//不必须且为空
                    continue;
                }
                
                array_unshift($rule, $data[$field_name]);
                
                $return = call_user_func_array(array($this, $method), $rule);

                //回调自己处理错误
                if (!$return && $rule_name != 'callback') {  
					
                    $this->errors[] = array($field_name, sprintf($this->_lang_common['model_error_' . $rule_name], isset($this->field_titles[$field_name]) ? $this->field_titles[$field_name] : $field_name));
                }
            }
        }
        unset($data);

        return count($this->errors) == 0;
    }

     /**
     * 检测是否为空
     * @param string $value
     * @return boolean
     */
    private function _ruleRequired($value) 
    {
        return $value != '';
    }
    
    /**
     * 检测是否为有效的邮箱
     * @param string $value
     * @return boolean
     */
    private function _ruleEmail($value) 
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
    
    /**
     * 检测是否手机号
     * @param type $value
     * @return type
     */
    private function _rulePhone($value)
    {
        return preg_match('/^[1][3-8]{1}\\d{9}$/', $value);
    }
    
    /**
     * 检测是否为数字
     * @param string $value
     * @return boolean
     */
    private function _ruleNumeric($value) 
    {
        return is_numeric($value);
    }
    
    /**
     * 检测是否为整数
     * @param string $value
     * @return boolean
     */
    private function _ruleInt($value) 
    {
        return $value > 0;
        //return preg_match('/^[0-9]+$/', $value);
    }
    
    /**
     * 最少多少的字符
     * @param string $value
     * @param int $len
     * @return boolean
     */
    private function _ruleMinLen($value, $len) 
    {
        return mb_strlen($value) >= $len;
    }
    
    /**
     * 最多不超过字符数
     * @param string $value
     * @param int $len
     * @return boolean
     */
    private function _ruleMaxLen($value, $len) 
    {
        return mb_strlen($value) <= $len;
    }
    
    /**
     * 判断是否为ip
     * @param string $value
     * @return boolean
     */
    private function _ruleIp($value) 
    {
        return filter_var($value, FILTER_VALIDATE_IP);
    }
    
    /**
     * 判断是否为url
     * @param string $value
     * @return boolean
     */
    private function _ruleUrl($value) 
    {
        return filter_var($value, FILTER_VALIDATE_URL);
    }
    
    /**
     * 正则验证
     * @param string $value
     * @param string $regex
     * @return boolean
     */
    private function _ruleRegex($value, $regex) 
    {
        return preg_match($regex, $value);
    }
    
    /**
     * 自定义检测函数
     * @param string $value
     * @param string $callback
     * @return boolean
     */
    private function _ruleCallback($value, $callback) 
    {
        return $this->$callback($value);
    }

    /**
     * 匹配qq
     * @param type $value
     * @return type
     */
    private function _ruleQq($value)
    {
        return preg_match('/[1-9][0-9]{4,}/', $value);
    }

    /**
     * 检查是否合法的手机号
     * @access public
     * @param type $value
     * @return type
     */
    public function check_phone($value){
        return $this->_rulePhone($value);
    }
    
    /**
     * 检查是否合法的email
     * @access public
     * @param type $value
     * @return type
     */
    public function check_email($value){
        return $this->_ruleEmail($value);
    }
    
    /**
     * 验证字符串在一定的长度范围内
     * @param type $value
     * @param type $max
     * @param type $min
     * @return type
     */
    public function len_str($value, $max, $min){
        
        return $this->_ruleMaxLen($value, $max) && $this->_ruleMinLen($value, $min);
    }
}

/* End of file TZ_Validation.php */
/* Location: ./application/libraries/TZ_Validation.php */

