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
class Test extends Base_Controller{
    
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
          $html1 = "<p><i>This is</i> some sample text to <strong>demonstrate</strong> the capability of the <strong>HTML diff tool</strong>.</p>
                                <p>It is based on the <b>Ruby</b> implementation found <a href='http://github.com/myobie/htmldiff'>here</a>. Note how the link has no tooltip</p>
                                <table cellpadding='0' cellspacing='0'>
                                <tr><td>Some sample text</td><td>Some sample value</td></tr>
                                <tr><td>Data 1 (this row will be removed)</td><td>Data 2</td></tr>
                                </table>
                                Here is a number 2 32";
//	$html2 = "<p>This is some sample <strong>text to</strong> demonstrate the awesome capabilities of the <strong>HTML <u>diff</u> tool</strong>.</p><br/><br/>Extra spacing here that was not here before.
//                                <p>It is <i>based</i> on the Ruby implementation found <a title='Cool tooltip' href='http://github.com/myobie/htmldiff'>here</a>. Note how the link has a tooltip now and the HTML diff algorithm has preserved formatting.</p>
//                                <table cellpadding='0' cellspacing='0'>
//                                <tr><td>Some sample <strong>bold text</strong></td><td>Some sample value</td></tr>
//                                </table>
//                                ";
          $html2 = '';
        $this->load->library('HtmlDiff', array('oldText' => $html2, 'newText' => $html1));
        
      
	$this->htmldiff->build();
	echo "<h2>Compared html</h2>";
	var_dump( $this->htmldiff->getDifference());
    }
    
}

/* End of file Index.php */
/* Location: ./application/Index.php */
