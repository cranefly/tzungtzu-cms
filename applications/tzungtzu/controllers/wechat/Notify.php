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
 * Notify Class
 * 微信回调通知
 * 
 * @package	FengXiang	
 * @subpackage	Core
 * @category	Notify
 * @author		Hayden
 */
class Notify extends FX_Controller
{
    protected $ModelPath        = 'mall/order';
    
    protected $ModelName        = 'order';
    
    public function __construct()
    {
        parent::__construct();
        $this->load_model($this->RebateModelPath);
    }
    
    /**
     * 支付回调通知
     * @access public
     * @return void
     */
    public function index()
    {
        $this->load_model($this->UserModelPath);
        
        $pay_res = $this->wechat_pay->get_back_data();
        
        $success = $pay_res && isset($pay_res['result_code']) && isset($pay_res['return_code']) && ($pay_res['result_code'] == 'SUCCESS') && ($pay_res['return_code'] == 'SUCCESS');
        if ($success)
        {
            // 用户信息
            $userinfo = $this->account->find($pay_res['openid'], 'openid', 'id, openid, nickname, mobile, parent_id, store_user_id, agent_user_id, resource_user_id');
          
            //根据订单修改授权席位
            $order_info = $this->order->find($pay_res['out_trade_no'], 'number');
            
            //更新订单信息
            $update_order = array(
                'transaction_id'    => $pay_res['transaction_id'],
                'status'            => 2,
            );
            
            $this->order->update($update_order, $pay_res['out_trade_no'], 'number', FALSE);
           
            unset($update_order, $order_info, $userinfo);
            
            $this->wechat_pay->response_back('SUCCESS', 'OK');
        }else
        {
            $this->wechat_pay->response_back('FAIL', 'NO RESPONSE');
        }
        
        unset($pay_res, $success);
        exit();
    }
    
    /**
     * 二维码支付回调地址
     */
    public function qrcode_pay()
    {
        $back_data = $this->_wechat_pay->get_back_data();

        if (!empty($back_data) && is_array($back_data)){
            
            $product_id     = $back_data['product_id'];
            $openid         = $back_data['openid'];
            
            $pay_info       = $this->coursepay->find($product_id);
            $course_info    = $this->xycourse->find($pay_info['course_id'], 'id', 'id, name, teacher_rebate, professor_rebate');
            $user_info      = $this->account->find($openid, 'openid', 'id, openid');
            $user_id = 0;
            if (!empty($user_info)){$user_id = $user_info['id'];}
            $order_data = array(
                'transaction_id' => '',
                'trade_no'       => 'HWS' . date('YmdHis') . rand(100, 999),
                'title'          => '支付课程' . $pay_info['name'] . '的费用',
                'user_id'        => $user_id,
                'declaration_id' => $pay_info['course_id'],
                'money'          => $pay_info['price'],
                'status'         => 1,
                'order_describe' => '支付课程参与费用',
                'cdate'          => time(),
                'type'           => 20,
                'nums'           => 1,
                'recommend_user' => $pay_info['user_id'],
                'rebate1'        => $course_info['teacher_rebate'],
                'openid'         => $openid,
            );
            $order_id = $this->order->insert($order_data);
            $order_weixin = array(
                'device_info'       => 'QRCODE',
                'body'              => $course_info['name'] . "付费",
                'detail'            => $course_info['name'] . "支付费用",
                'out_trade_no'      => $order_data['trade_no'],
                'total_fee'         => $order_data['money'] * 100,
                'spbill_create_ip'  => $this->input->ip_address(),
                'notify_url'        => NOTIFY_URL,
                'trade_type'        => 'NATIVE',
                'product_id'        => $order_id,
            );

            $res = $this->_wechat_pay->unifiedOrder($order_weixin);
            unset($order_weixin, $order_data);
            if ($res  && isset($res['result_code']) && $res['result_code'] == 'SUCCESS')
            {
                $prepay_id = $res['prepay_id'];
                
                $response_xml = $this->_wechat_pay->getOneResponseData('SUCCESS', NULL, $prepay_id, 'SUCCESS');
                
                print $response_xml;
                unset($res);
                exit();
            }
            
            $this->_wechat_pay->response_back('FAIL');
        }
    }
}

/* End of file Notify.php */
/* Location: ./application/controllers/wechat/Notify.php */
