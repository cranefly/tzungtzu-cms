<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * FengXiang
 *
 * @package     FengXiang
 * @author      HuiWeiShang Dev Team
 * @copyright   Copyright (c) 2012-2024, www.huiweishang.com.
 * @license     http://huiweishang.com/doucmentss/license.html
 * @link        http://huiweishang.com/
 * @since       Version 1.0.0
 */
// ------------------------------------------------------------------------

/**
 * Develop Class
 * 
 * @package	FengXiang	
 * @subpackage	Core
 * @category	Notify
 * @author		Hayden
 */
class Develop extends Base_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('wechat/Wechat');

    }
    
    /**
     * 微信服务器主动推送接口
     * @access public
     * 
     * @return void
     */
    public function index()
    {
        if (isset($_GET["echostr"])){
            $this->wechat->valid();
            exit();
        }
        
        $this->wechat_obj->getRev();
        
        $openid  = $this->wechat_obj->getRevFrom();
        $revtype = $this->wechat_obj->getRevType();
        $event   = $this->wechat_obj->getRevEvent();

        $user_info = $this->account->find($openid, 'openid' , 'id, nickname, store_user_id');
        
        if ($revtype == 'event' && isset($event['event']) && $event['event'] == 'subscribe'){ //关注回复
            
            // $this->_send_message($openid, '欢迎你关注兔子大人品牌');
            $this->wechat_obj->text('欢迎你关注兔子大人品牌')->reply();
            
            $scene_info = array();
            if (isset($event['key']) && !empty($event['key']))
            {
                // 扫码的二维码参数
                $qrscene = str_replace('qrscene_', '',$event['key']); 
                // 二维码相关信息
                $scene_info = $this->scene->find($qrscene, 'param');
            }
           
            $this->wechat_obj->reply();
        }
    }
    
    /**
     * 获取用户信息
     * @param type $openid
     * @return type
     */
    public function get_user_data($openid)
    {
        $user_info  = $this->wechat_obj->getUserInfo($openid);
        $user_data = array(
            'openid'        => $openid,
            'unionid'       => isset($user_info['unionid']) ? $user_info['unionid'] : '',
            'nickname'      => isset($user_info['nickname']) ? $user_info['nickname'] : '',
            'province'      => isset($user_info['province']) ? $user_info['province'] : '',
            'city'          => isset($user_info['city']) ? $user_info['city'] : '',
            'country'       => isset($user_info['country']) ? $user_info['country'] : '',
            'headimgurl'    => isset($user_info['headimgurl']) ? $user_info['headimgurl'] : '',
        );
        unset($user_info);
        return $user_data;
    }
    
    /**
     * 通过微信接口发送信息
     * @access private 
     * @param type $openid
     * @param type $msg
     * @return array
     */
    public function  _send_message($openid, $msg)
    {
        $msg_data = array(
            'touser' => $openid,
            'msgtype' => 'text',
            'text' => array(
                'content' => $msg,
            ),
        );
        
        return $this->wechat_obj->sendCustomMessage($msg_data);
    }
    
    /**
     * 创建菜单
     * @access public 
     * @return void
     */
    public function menu()
    {
        // die('no access');
        $this->config->load('wechat');
        $menus  = $this->config->item('menu');
        print_r($menus);
        $res    = $this->wechat_obj->createMenu($menus);
        var_dump($res);
    }
}

/* End of file Notify.php */
/* Location: ./applications/controllers/wechat/Develop.php */
