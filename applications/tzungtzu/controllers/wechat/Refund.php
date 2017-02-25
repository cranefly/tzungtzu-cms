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
 * Refund Class
 * 微信退款通知
 * @package	FengXiang	
 * @subpackage	Core
 * @category	Notify
 * @author		Hayden
 */
class Refund extends Manage_Controller
{
    public $wechat_obj = NULL;
    
    public $ViewPath = 'wechat/refund';
    
    protected $ActivityRefundModel = 'activity/activity_refund';
    protected $DeclarationModel = 'activity/declaration';
    protected $ModelPath        = 'weixin/refund';
    
    protected $ModelName        = 'refund';

    public function __construct()
    {
        parent::__construct();
        $this->load_model($this->DeclarationModel);
        
        $this->user_id = $this->_user->id;
    }
    
    /**
     * 
     * @access public
     * 
     * @return void
     */
    public function index()
    {
        
    }

    /**
     * 执行退款操作
     * 
     * @param type $id
     */
    public function action($id = NULL)
    {
        $this->load_model($this->ActivityRefundModel);
        $this->load_model($this->DeclarationModel);
        
        if ($id === NULL)
        {
            $id = $this->get_data('id');
        }
        
        $activity_refund = $this->activity_refund->find($id);
        $refund          = $this->refund->find($activity_refund['refund_id']);
        $op_user_id      = $this->user_id;
        $res             = $this->_wechat_pay->refund($refund['trade_no'], $refund['refund_no'], $refund['total_fee'], $refund['refund_fee'], $op_user_id);

        if (isset($res['return_code']) && $res['return_code'] == 'SUCCESS' && isset($res['refund_id']) && !empty($res['refund_id']))
        {
            $data = array(
                'refund_id'  => $res['refund_id'],
                'updatedate' => time(),
                'status'     => 3,
                'op_user_id' => $op_user_id
            );
            // 更新退款记录状态
            $this->refund->update($data, $refund['id']);
            // 更新申请退款记录状态
            $this->activity_refund->update(array('status' => 3), $id);
            // 更新报单状态
            $this->declaration->update(array('status' => 3), $refund['declaration_id']);
            $this->print_state(0, '', '');
        }else
        {
            $this->print_state(100, '退款失败', '没有返回退款单号，系统不进行更新状态操作. 退款单号：' . @$res['refund_id']);
        }
    }
}

/* End of file Refund.php */
/* Location: ./application/controllers/wechat/Refund.php */
