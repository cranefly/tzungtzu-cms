<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
|  公众号配置
| -------------------------------------------------------------------
 */
$config['config']['appid']          = '';
$config['config']['appsecret']      = '';
$config['config']['encodingaeskey'] = ''; 
$config['config']['token']          = '';
$config['config']['debug']          = FALSE;
$config['config']['logcallback']    = '';

/*
| -------------------------------------------------------------------
|  支付配置
| -------------------------------------------------------------------
 */     
$config['pay']['appid']       = '';
$config['pay']['apikey']      = '';
$config['pay']['mch_id']      = '';
$config['pay']['mch_key']     = '';
$config['pay']['sslkeyPath']  = getcwd() . '';
$config['pay']['sslcertPath'] = getcwd() . '';

$config['menu'] = array(
    'button' => array (
            
    ),
);
/* End of file wechat.php */
/* Location: ./applications/config/wechat.php */