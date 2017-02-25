<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * 自定义控制器
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
 * TZ Controller Class
 * 系统全局控制器
 * @package		TzungTzu
 * @subpackage	Core
 * @category	Core
 * @author		TZ Dev Team
 */
class TZ_Controller extends CI_Controller
{
	//view path
	public $ViewPath 		= '';
    // action model
	public $ActionModelKey 	= '';
	public $ActionModelName = '';
	//lang path
	public $LangPath 		= '';
	//page path
	public $PagePath 		= '';
	// controller id
	public $ControllerId 	= '';
	// controler title
	public $ControllerTitle = '';
	//lang
	public $lang_common 	= NULL;
	public $lang_current 	= NULL;

    // page data
    protected $render_data 	= array();
	
    public $user_agent = 'browser';
	
    public $web_dir = '';
    
    public $vars = array();
    protected $css_js = array(
        'css' => array(),
        'js'  => array(),
    );
    
    public function __construct()
	{
		parent::__construct();
        
        $this->load->library(array('TZ_User', 'TZ_Vars', 'TZ_Logs', 'HtmlDiff'));
		$this->lang->load('common', 'chinese');
		$this->lang_common = $this->lang->language;
        
        // 加载语言包
		if (!empty($this->LangPath))
		{
			$this->lang->load($this->LangPath, 'chinese');
			$this->lang_current = $this->lang->language;
		}
       
        // init action model obj
		if (!empty($this->ActionModelKey))
		{
			$this->load_model($this->ActionModelKey);
			
			$_model_name 		= strtolower($this->ActionModelName);
			$this->action_model = $this->$_model_name;
            // 设置模型语言包
            $this->action_model->lang_current = $this->lang_current;
			unset($_model_name);
		}
        
        // 全局模型变量，比如用于权限判断的菜单模型等
        $this->load_model('menu');
	}

	/**
     * 载入模型
     * @access public
     * @param type $models
     * @return void
     */
    protected function load_model($models)
    {
        $models = (array)$models;
        foreach ($models as $modelkey) 
        {
            $m = $this->config->item($modelkey);
            $pos = strrpos($m, '/');
            if ($pos !== FALSE) {
                $this->load->model($m . '_model', substr($m, $pos + 1));
            } else {
                $this->load->model($m . '_model', $m);
            }
        }
    }
	
    
    /**
     * 获取到微信的签名数据，包括签名的参数
     */
    public function get_signature()
    {
        $timestamp = time();
        $nonec_str = 'HWS' . rand(1000,9999);
        $js_ticket = $this->session->userdata('js_ticket');
        
        if (empty($js_ticket))
        {
            $js_ticket = $this->wechat_obj->getJsTicket();
            $this->session->set_userdata(array('js_ticket' => $js_ticket));
        }
        
        $data['noncestr']       = $nonec_str;
        $data['jsapi_ticket']   = $js_ticket;
        $data['timestamp']      = $timestamp;
        $data['url']            = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        
        $signature = $this->wechat_obj->getSignature($data);
        
        $return['signature'] = $signature;
        $return['timestamp'] = $timestamp;
        $return['noncestr'] = $nonec_str;
        $return['appid'] = $this->wechat_obj->get_appid();
        
        unset($timestamp, $nonec_str, $js_ticket, $signature, $data);
        return $return;
    }
    
    /**
     * 增加js文件
     * @param type $file
     */
    public function add_js($file) {


        if (!is_array($file)) {
            $file = array($file);
        }

        foreach ($file as $value) {
            $this->css_js['js'][] = '<script type="text/javascript" src="' . $this->get_css($value) . '" ></script>';
        }

        return $this;
    }

    /**
     * 增加css
     * @param type $file
     */
    public function add_css($file) {

        if (!is_array($file)) {
            $file = array($file);
        }

        foreach ($file as $value) {
            $this->css_js['css'][] = '<link rel="stylesheet" type="text/css" href="' . $this->get_css($value) . '" />';
        }

        return $this;
    }
    
	/**
	 * 设置页面数据
	 * @access public
	 * @param array $data
	 * @return void
	 */
	public function render_data($data)
	{
		$this->render_data = array_merge($this->render_data, $data);
	}
    
    /**
     * 自动根据地址检测操作权限
     * 
     * @return boolean
     */
    public function check_authority()
    {
        return TRUE;
        // 根据路径获取到权限信息
        $url_path_info = ltrim($_SERVER['PATH_INFO'], '/');
        
        $menu_id = $this->menu->find_field($url_path_info, 'url', 'id');
        // if (empty($menu_id)){return TRUE;}
        $check = $this->tz_user->check_authority($menu_id);
        $ajax = $this->get_data('ajax');
        if ($check){
            return TRUE;
        }else{
            if ($ajax){
                $this->fail();
            }
            // 提示没有权限
            $this->show_error($this->lang_common['unauthorized'], $this->lang_common['unauthorized_detail']);
        }
    }
    
    /**
     * 处理异常页面
     * @param type $title
     * @param type $content
     * @param type $status
     */
    protected function show_error($title, $content, $status = 500)
    {
        show_error($content, $status, $title);
    }
    
    /**
     * 获取css文件路径，一直精确到文件的前一个目录
     * @access public
     * @return string
     */
    public function get_css($dir){
        return CSS_HOST . DIRECTORY_SEPARATOR . 'themes' . DIRECTORY_SEPARATOR . THEME_DIR  . DIRECTORY_SEPARATOR . $dir;
    }
    
	/**
	 * 输出按钮，根据权限判断，没有权限就不输出按钮
	 * @access public
	 * @param $level
	 * @param $url
	 * @param $title
	 * @param $css
	 * @param $prefix
	 * @return void
	 */
	public function btn($level, $url, $title, $css = 'btn btnSave', $prefix = '')
	{
		if ($this->tz_user->check_authority($level))
		{
			echo '<a href="' . $url . '" class="' . $css . '" ' . $prefix . '>' . $title . '</a>';
		}
		
	}

	/**
     *
     * 获取请求数据
     * @access public
     * @param type $field
     * @return type
     */
    public function get_data($field, $default = '') {
        
        $field_val = $this->input->get_post($field);
        return empty($field_val) ? $default : $field_val ;
    }

	/**
	 * ajax 成功请求时输出的json数据结果
	 * @access public
	 * @return void
	 */
	public function success()
	{
		$data = array(
			'state' 	=> 0,
			'title' 	=> $this->lang_common['save_complete'],
			'message' 	=> $this->lang_common['save_complete_detail'],
		);
		$this->print_json($data);
	}

	/**
	 * ajax请求失败时输出的json数据结果
	 * @access public
	 * @return void
	 */
	public function fail()
	{
		$data = array(
			'state' 	=> 1,
			'title' 	=> $this->lang_common['save_failure'],
			'message' 	=> $this->lang_common['save_failure_detail'],
		);
		$this->print_json($data);
	}

	/**
	 * 表单验证不通过。直接输出提示结果
	 * @access public
	 * @return void
	 */
	public function validation_form_fail()
	{
		$data = array(
			'state' 	=> 1,
			'title' 	=> $this->lang_common['oper_prompt'],
			'message' 	=> $this->lang_common['oper_prompt_validation'],
		);
		$this->print_json($data);
	}

	/**
	 * 修改状态，删除等成功操作返回信息
	 * @access public
	 * @return void
	 */
	public function update_success()
	{
		$data = array(
			'state' 	=> 0,
			'title' 	=> $this->lang_common['bulkoper_complete'],
			'message' 	=> $this->lang_common['bulkoper_complete_detail'],
		);
		$this->print_json($data);
	}

	/**
	 * 修改状态，删除等操作失败返回信息
	 * @access public
	 * @return void
	 */
	public function update_fail()
	{
		$data = array(
			'state' 	=> 1,
			'title' 	=> $this->lang_common['bulkoper_failure'],
			'message' 	=> $this->lang_common['bulkoper_failure_detail'],
		);
		$this->print_json($data);
	}

	/**
	 * 未授权返回信息
	 * @access public
	 * @return void
	 */
	public function unauthorized()
	{
		$data = array(
			'state' 	=> 1,
			'title' 	=> $this->lang_common['unauthorized'],
			'message' 	=> $this->lang_common['unauthorized_detail'],
		);
		$this->print_json($data);
	}

	/**
	 * 打印输出ajax请求是的状态输出结果
	 * @access public
	 * @param type $state
	 * @param type $title
	 * @param type $message
	 * @return void 
	 */
	public function print_state($state = 100, $title = '', $message = '', $data = array())
	{
		
		$d = array(
			'state' 	=> $state,
			'title' 	=> $title,
			'message' 	=> $message,
		);
		
		if (!empty($data))
		{
			$d = array_merge($d, $data);
		}
		
		$this->print_json($d);
	}

    /**
     * 用户访问的设备
     * @access public
     * @return void 
     */
    public function set_user_agent(){
        $this->load->library('user_agent');
        if ($this->agent->is_browser())
        {
            $this->user_agent = 'browser';
        }elseif ($this->agent->is_robot()) {
            
        }elseif ($this->agent->is_mobile()){
            $this->user_agent = 'mobile';
        }
        
        if (strpos($_SERVER['HTTP_USER_AGENT'],"MicroMessenger") !== FALSE){
            
            $this->user_agent = 'weixin';
        }
        return $this->user_agent;
    }
    
    /**
     * 获取到模板的文件名称和模板文件夹 如default/list
     * @access public
     * @param type $tpl_name
     * @return string 模板名称
     */
    public function get_tpl_name($tpl_name){
        $r_tpl = '';
        switch ($this->user_agent){
            case 'mobile':
                $r_tpl = $this->web_dir . '_wap';
                break;
            
            case 'browser':
                $r_tpl = $this->web_dir;
                break;
            
            case 'weixin':
                $r_tpl = $this->web_dir . '_wap';
                break;
            default:
                $r_tpl = $this->web_dir;
        }
        return $r_tpl . '/' . $tpl_name;
    }
    
	/**
	 * 打印输出json数据格式的数据
	 * 
	 * @access public
	 * @param type $value 需要打印的数组或者字符串
	 * @param type $autoEncode 是否自动进行json编码
	 * @return void
	 */
	public function print_json($value)
	{
		header("Status: 200");
		header("Cache-Control: no-cache");
		header("Expires: -1");
		header("Content-type: text/html; charset=utf-8");

		echo is_array($value) ? json_encode($value) : $value;
		
		die();
	}
    
    /**
     * 获取模板内容,加载公用模板
     * @access public
     * @param type $template
     * @return void
     */
    public function get_template($template)
    {
        return $this->load->view($template, '', TRUE);
    }
    
    /**
	 * 保存用户信息操作
	 *
	 * @access public
	 * @param $data array
	 * @param $id int
	 * @return void
	 */
	public function save_data($data = NULL, $id = NULL)
	{
		
		$this->action_model->lang_current = $this->lang_current;
		$res = $this->action_model->set_attrs($data)->set_PKeyValue($id)->save($data, $id);
		
		if ($res > 0)
		{
			$this->print_state(0, '操作成功', '');
		}
		
		$error = $this->action_model->errors;
		
		if (isset($error[0]))
		{
			$this->print_state(1, $error[0][0], $error[0][1]);
		}
	}
    
    public function check_login($is_ajax = FALSE)
    {
        $is_login = $this->tz_user->is_login();

		if (!$is_login)
		{
            if ($is_ajax)
            {
                $this->print_state(500, $this->lang_common['on_login_title'], $this->lang_common['on_login_msg']);
            }else{
                redirect(base_url("{$this->webmaster}/login"));
                exit;
            }
		}
    }
    /**
     * 个人中心模板导航页
     * @param type $view
     * @param type $data
     */
    public function render_view($view, $data = array())
    {
		//页面基础数据
		$base_data = array(
			'langco' 	=> $this->lang_common,
			'langcu' 	=> $this->lang_current,
			'page_path' => $this->PagePath,
			'tz' 		=> $this,
            'controller_title' 	=> $this->ControllerTitle,
		);
		//print_r($menus);
		// view data
		$view_data  = array_merge($data, $this->render_data, $base_data);
		unset($base_data, $this->render_data, $data);
		
		$this->load->view($this->get_tpl_name($view), $view_data);
		unset($view_data);
    }
    
    /**
     * 加载图片上传插件
     */
    public function upload_css_js(){
        $upload_js  = array('libs/dropzone/dropzone.js');
        $upload_css  = array('libs/dropzone/dropzone.css');
        $this->add_js($upload_js);
        $this->add_css($upload_css);
    }
    /**
     * 根据新旧文本，比较差别写日志
     * @param type $old 
     * @param type $new
     */
    public function log($old, $new)
    {
       $diff = new HtmlDiff(array('oldText' => $old, 'newText' => $new));
       $diff->build();
       $content = $diff->getDifference();
       $this->tz_logs->insert($content);
       unset($content, $diff, $old, $new);
    }
}

require_once(dirname(__file__) . '/Base_Controller.php');
require_once(dirname(__file__) . '/User_Controller.php');
require_once(dirname(__file__) . '/Master_Controller.php');
require_once(dirname(__file__) . '/View_Controller.php');

/* End of file TZ_Controller.php */
/* Location: ./application/core/TZ_Controller.php */