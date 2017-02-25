<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  TzungTzu CMS
 *
 * @package     TzungTzu
 * @author      TZ Dev Team
 * @copyright   Copyright (c) 2012-2024, TzungTzu.com.
 * @license     http://tzungtzu.com/doucmentss/license.html
 * @link        http://tzungtzu.com/
 * @since       Version 1.0.0
 */

/**
 * Menu Controller
 * 
 * 微信相关回调地址
 * 
 * @package     TzungTzu
 * @subpackage  Controller
 * @category    Menu
 * @author      Tz Dev Team
 */
class Menu extends Wechat_Controller
{
    public function __construct()
    {
        parent::__construct();
        
    }
    
    /**
     * 微信服务器通知地址 /index.php/wechat/notify
     * @access public
     * @return void
     */
    public function index()
    {
        $this->config->load('wechat');
        $menus  = $this->config->item('menu');
        print_r($menus);
        $res    = $this->wechat->createMenu($menus);
        var_dump($res);
    }
    
}


/* End of file Menu.php */
/* Location: ./application/wechat/Menu.php */