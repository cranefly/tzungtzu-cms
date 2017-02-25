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
 * Order Class
 * 微信订单
 * @package	FengXiang	
 * @subpackage	Core
 * @category	Order
 * @author		Hayden
 */
class Order extends Master_Controller
{
    public $ViewPath = 'wechat/order';
    public $PagePath = 'wechat/order';

    protected $ModelPath        = 'weixin/order';
    
    protected $ModelName        = 'order';

    public $viewurl             = 'wechat';
   
    public function __construct()
    {
        parent::__construct();  
    }
    
    /**
     * 
     */
    public function index()
    {
    }
    
    /**
     * 支付课程
     */
    public function course_pay()
    {
        $this->load_model($this->CourseModel);
        
        $course_id      = $this->get_data('id');
        $recommend_user = $this->get_data('rid');
        $course         = $this->xycourse->find($course_id);
        
        //创建一个订单
        $order_data = array(
            'transaction_id' => '',
            'trade_no'       => 'ACT' . date('YmdHis') . rand(100, 999),
            'title'          => $course['name'] . '购买',
            'declaration_id' => $course_id,
            'user_id'        => $this->user->id,
            'money'          => $course['price'],
            'status'         => 1,
            'order_describe' => $course['name'] . '购买支付',
            'cdate'          => time(),
            'type'           => 20,
            'nums'           => 1,
            'recommend_user' => $recommend_user,
            'rebate1'        => $course['teacher_rebate'],
        );
        
        $order_id = $this->order->insert($order_data);
        if ($order_id > 0){
     
            $order_weixin = array(
                'device_info'       => 'WEB',
                'body'              => "{$this->user->nickname}给{$course['name']}付费",
                'detail'            => "{$this->user->nickname}给{$course['name']}支付课程费用",
                'out_trade_no'      => $order_data['trade_no'],
                'total_fee'         => $course['price'] * 100,
                'spbill_create_ip'  => $this->input->ip_address(),
                'notify_url'        => NOTIFY_URL,
                'trade_type'        => 'JSAPI',
                'product_id'        => $order_id,
                'openid'            => $this->user->openid,
            );

            $res = $this->_wechat_pay->unifiedOrder($order_weixin);

            unset($order_weixin, $order_data);
            $data = $res;
            $data['js_params'] = '';

            if ($res  && isset($res['result_code']) && $res['result_code'] == 'SUCCESS')
            {
                $prepay_id = $res['prepay_id'];
                $data['js_params'] = json_encode($this->_wechat_pay->get_package($prepay_id));
                unset($res);
            }
            
            $data['money']  = $course['price'];
            $data['course'] = $course;
            $this->render_html("{$this->ViewPath}/pay", $data);
            
            unset($data);
        }
    }
    
}

/* End of file Teacher.php */
/* Location: ./application/controllers/college/Teacher.php */
