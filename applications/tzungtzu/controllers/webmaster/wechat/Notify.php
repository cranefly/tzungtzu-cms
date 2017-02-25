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
 * Notify Controller
 * 
 * 微信相关回调地址
 * 
 * @package     TzungTzu
 * @subpackage  Controller
 * @category    Controller
 * @author      Tz Dev Team
 */
class Notify extends Wechat_Controller
{
    protected $SignModel     = 'accounts/sign';
    protected $ReplyModel    = 'wechat/reply';
    protected $UserModel     = 'accounts/users';
    protected $ArticleModel  = 'articles/article';
    
    protected $group_id = 5; // 微信会员组
    //微信支付核心类
    private $_wechat_pay = NULL;
    
	const REPLY = "感谢你关注广丰微聚力\n\n广丰微聚力是专注于小初高的教育服务平台\n\n我们的宗旨是培养有理想、有激情、勇于拼搏、敢于挑战、身心健康的新一代优秀人才，全面帮助孩子德智体美劳全面健康发展。\n我们关注孩子学习成绩，更关心孩子身心健康，让每一个孩子都能健康茁壮的成长！";

	public function __construct()
    {
        parent::__construct();
        $this->load_model($this->UserModel);
        $this->load_model($this->ArticleModel);
    }
    
    /**
     * 微信服务器通知地址 /index.php/wechat/notify
     * @access public
     * @return void
     */
    public function index()
    {
        $this->wechat->getRev();
        
        $openid  = $this->wechat->getRevFrom();
        $getfrom = $this->wechat->getRevTo(); //服务号

        $event   = $this->wechat->getRevEvent();
        $revtype = $this->wechat->getRevType();
        
        // 获取消息内容
        $rev_content = $this->wechat->getRevContent();
        
        $user_id = 0;
        // 处理用户信息
        $user = $this->users->find($openid, 'openid');
        if (empty($user))
        {
            // 获取关注用户信息，本地化
            $user_info  = $this->get_user_data($openid);
            $user_id    = $this->users->insert($user_info);
            $user       = $user_info;
            unset($user_info);
            // $this->send_msg('oGpZjwxpxrmOxHUUE7tmzi-qylCU', '一个用户关注了公众号，昵称为：' . $user['unick']);
        }else{
            $user_id = $user['id'];
        }
        //关注回复
        if ($revtype == 'event' && isset($event['event']) && $event['event'] == 'subscribe'){ 
            
            $this->wechat->text(self::REPLY)->reply();
            // $this->auto_reply('关注');
            //通过扫参数二维码关注
            if (isset($event['key']) && !empty($event['key']))
            {
                $qrscene = $this->wechat->getRevSceneId(); 
            }
        }
        
        // 签到
        // $openid = 'oGpZjwxpxrmOxHUUE7tmzi-qylCU';
        if ($revtype == 'event' && isset($event['event']) && strtolower($event['event']) == 'click' && isset($event['key']) && $event['key'] == 'v_sign_in') //
        // if (TRUE)
        {
            $this->load_model($this->SignModel);
            if ($this->sign->is_sign($openid)){
                $this->auto_reply('已签到');
            }else{
                // 更新积分
                $this->users->update_num(5, 'upoint', $openid, 'openid');
                $this->sign->do_sign($openid);
                $this->auto_reply('签到成功');
            }
            
            return ;
        }  
        
        /**
         * 自动回复内容
         */
        if (!empty($rev_content))
        {
            $this->auto_reply($rev_content);
            return '';
        }
    }
    

    /**
     * 微信支付回调接口
     * @access public 
     * @return void
     */
    public function pay_call_back()
    {
        $pay_res = $this->_wechat_pay->get_back_data();
      
        $success = $pay_res && isset($pay_res['result_code']) && isset($pay_res['return_code']) && ($pay_res['result_code'] == 'SUCCESS') && ($pay_res['return_code'] == 'SUCCESS');
        
        if ($success)
        {
            
        }
    }

    /**
     * 系统自动回复查询
     * @param type $keyword
     * @param type $type
     */
    public function auto_reply($keyword, $type = '')
    {
        $this->load_model($this->ReplyModel);
        $reply_info = $this->reply->find($keyword, 'keyword');
        
        if ($reply_info)
        {
            $this->wechat->text($reply_info['reply'])->reply();
            
            // 更新回复次数
            $this->reply->update_num(1, 'total', $keyword, 'keyword');
        }else{
            $news = $this->get_rand_article($keyword);
            
            $this->wechat->news($news)->reply();
        }
    }
   
    /**
     * 获取用户信息
     * @param type $openid
     * @return type
     */
    public function get_user_data($openid)
    {
        $user_info  = $this->wechat->getUserInfo($openid);
        $user_data = array(
            'uname'     => '',
            'openid'    => $openid,
            'unionid'   => isset($user_info['unionid']) ? $user_info['unionid'] : '',
            'unick'     => isset($user_info['nickname']) ? $user_info['nickname'] : '',
            'province'  => isset($user_info['province']) ? $user_info['province'] : '',
            'city'      => isset($user_info['city']) ? $user_info['city'] : '',
            // 'country'       => isset($user_info['country']) ? $user_info['country'] : '',
            'uavatar'   => isset($user_info['headimgurl']) ? $user_info['headimgurl'] : '',
            'group_id'  => $this->group_id,
            'reg_date'     => time()
        );
        unset($user_info);
        return $user_data;
    }
    
    /**
     * 随机获取回复内容的信息
     * @param type $content
     * @return type
     */
    public function get_rand_article($content)
    {
        $articles = $this->article->get_rand($content);
        
        $data = array();
        foreach($articles as $key => $val)
        {
            $_val['Title']       = $val['title'];
            $_val['PicUrl']      = $val['thumb_img'];
            $_val['Description'] = $val['description'];
            $_val['Url']         = base_url("detail/{$val['mid']}/{$val['id']}.html");
            $data[$key] = $_val;
        }
        
        return $data;
    }
}


/* End of file Notify.php */
/* Location: ./application/wechat/Notify.php */