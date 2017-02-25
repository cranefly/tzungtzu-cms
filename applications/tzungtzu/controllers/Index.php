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
 * Index Controller
 *
 * 网站首页
 * 
 * @package     TzungTzu
 * @subpackage  Controller
 * @category    Index
 * @author      Tz Dev Team
 */
class Index extends View_Controller{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * 网站首页
     * 
     */
    public function index()
    {
        $this->seo = array(
            'title'         => $this->get_config('site_title'),
            'keywords'      => $this->get_config('seo_keywords'),
            'description'   => $this->get_config('seo_description')
        );
        $data['cid'] = 0;
        $this->render_html('homepage', $data);
    }
    
	public function phpinfo()
	{
		phpinfo();
	}
	
    public function makepwd($pwd)
    {
        $res = $this->tz_user->make_pwd($pwd);
        echo($res);
    }
}

/* End of file Index.php */
/* Location: ./application/Index.php */
