 <?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * 字段相关
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
 * TZ Fields Class
 *
 * @package		TzungTzu
 * @subpackage	Libraries
 * @category	Libraries
 * @author		TZ Dev Team
 */
class TZ_Fields
{
    private $_ci                = NULL;

    private $_fields_model      = 'system/fields_model';

	public function __construct()
	{
		$this->_ci = &get_instance();

        $this->_ci->load->model($this->_fields_model, 'fields');
	}

    /**
     * 获取到字段的picklist
     * @param type $fid
     * @param type $pid
     */
    public function get_picklist($fid, $pid = NULL)
    {
        return $this->_ci->fields->get_picklist($fid, $pid);
    }

    /**
     * 获取字段信息
     *
     * @access public
     * @param $mixed 取值
     * @return array
     */
    public function get_field($mixed, $is_id = FALSE)
    {
        $_field = 'antistop';

        if ($is_id) 
        {
            $_field = 'fid';
        }

        return  $this->fields->find($mixed, $_field);
    }

    public function get_field_son()
    {

    }

    /**
     * 
     * 根据字段信息生成字段form表单html
     * @access public
     * @param type $mixed
     * @param type $is_id
     * @param type $is_data
     * @return string
     */
    public function get_filed_html($mixed, $is_id = FALSE, $is_data = TRUE)
    {
        $field_info = $this->get_field($mixed, $is_id);
        
        $_html = '';
        if (!empty($field_info))
        {
            if ($field_info['form_type'] == 'input')
            {
                $_html .= $this->_input_html($field_info, $is_data);
            }
            
            if ($field_info['form_type'] == 'select')
            {
                $_html .= $this->_select_html($field_info, $is_data);
            }
        }
        
        unset($field_info);
        return $_html;
    }

    /**
     * 日期选择html
     * @param type $field
     * @param type $value
     * @param type $is_data
     * @return string
     */
    private function _datepick_html($field, $value, $is_data)
    {
        //<input type="text" class="comm_ipt" name="data[start_date]" value="" onclick="new Calendar().show(this);">
        $_value = $value === NULL ? date('Y-m-d',$field['dvalue']) : date('Y-m-d',$value);
        return '<input type="text" class="comm_ipt" ' . $this->_get_filed_name($field['field'], $is_data) . ' value="' . $_value . '" onclick="new Calendar().show(this);">';
    }

    /**
     * 获取到select的html
     * @access private
     * @param type $field
     * @return string
     */
    private function _select_html($field, $value, $is_data)
    {
        $options = $this->get_picklist($field['id']);
        
        $_name = $this->_get_filed_name($field, $is_data);
        $_html = '<select name="'.$_name.'">';
        if (!empty($options))
        {
            foreach ($options as $val)
            {
                $_select = $val['pvalue'] == $value ? 'selected="selected"' : '';
                $_html .= '<option value="' . $val['pvalue'] . '" ' . $_select . '>' . $val['pname'] . '</option>';
                unset($_select);
            }
        }
        
        unset($options, $_name, $value, $is_data);
        return $_html;
    }

    /**
     * input html
     * 
     * @param type $field
     * @return type
     */
    private function _input_html($field, $value, $is_data)
    {
        $_value = $value === NULL ? $field['dvalue'] : $value;
        $_html =  '<input type="text" ' .$this->_get_filed_name($field['field'], $is_data) . ' placeholder="" value="' . $_value . '" />';
        
        unset($field, $is_data, $value, $_value);
        return $_html;
    }
    
    /**
     * 获取到表单的name值
     * @access private
     * @param type $data_field
     * @param type $is_data
     * @return type
     */
    private function _get_filed_name($data_field, $is_data)
    {
        return $is_data ? 'name="data[' . $data_field. ']"' : $data_field;
    }
    
    /**
     * 单选框
     * @param type $field
     * @param type $value
     * @param type $is_data
     * @return string
     */
    private function _radio_html($field, $value, $is_data)
    {
        $options = $this->get_picklist($field['id']);
        
        $_name = $this->_get_filed_name($field['field'], $is_data);
        $_html = '';
        if (!empty($options))
        {
            foreach ($options as $val)
            {
                $_select = $val['pvalue'] == $value ? 'checked="checked"' : '';
                $_html .= '<label><input type="radio" ' . $_name . '" value="' . $val['pvalue'] . '" ' . $_select . '><span>' . $val['pname'] . '</span></label>';
                unset($_select);
            }
        }
        unset($options, $_name, $value, $is_data);
        return $_html;
    }

    /**
     * 多行文本框
     * @access private
     * @param type $field
     * @param type $value
     * @param type $is_data
     * @return string 
     */
    private function _textarea_html($field, $value, $is_data)
    {
        $_value = $value === NULL ? $field['dvalue'] : $value;
        return '<textarea ' . $this->_get_filed_name($field['field'], $is_data) . ' style="width: 238px;" placeholder="">' . $_value . '</textarea>';
    }

    /**
     * 图片上传
     * @param type $field
     * @param type $value
     * @param type $is_data
     * @return string
     */
    private function _upload_html($field, $value, $is_data)
    {
        $_value = $value === NULL ? $field['dvalue'] : $value;
        $img = '';
        if (!empty($_value)){$img = '<img src="' . $_value . '" style="height:30px;padding-top:5px; padding-left:5px;"/>'; }
        $_html = '';
        $_html .= '<input type="hidden" ' . $this->_get_filed_name($field['field'], $is_data) . '  id="upload_img_value"  value="' . $_value . '" />';
		$_html .= '<div class="upload_img" id="upload_img">' . $img . '</div>';
        $_html .= '<div class="upload_img_hidden" style="display:none"></div>';
        
        return $_html;
    }

    private function _editor_html($field, $value, $is_data)
    {
        $_value = $value === NULL ? $field['dvalue'] : $value;
        
        return '<textarea id="simditor_editor" style="width:60%;" placeholder="Balabala" ' . $this->_get_filed_name($field['field'], $is_data) . ' autofocus>' . $_value . '</textarea>';
    }

    /**
     * 根据字段数据创建input表单，返回html代码
     * @access public 
     * @param type $field
     * @param type $is_data
     * @return string
     */
    public function get_form_html($field, $value = NULL, $is_data = TRUE)
    {
        $html = '';
        switch ($field['form_type'])
        {
            case 'input':    $html .= $this->_input_html($field, $value, $is_data);   break;
            case 'radio':    $html = $this->_radio_html($field, $value, $is_data);    break;
            case 'select':   $html = $this->_input_html($field, $value, $is_data);    break;
            case 'textarea': $html = $this->_textarea_html($field, $value, $is_data); break;
            case 'upload':   $html = $this->_upload_html($field, $value, $is_data);   break;
            case 'editor':   $html = $this->_editor_html($field, $value, $is_data);   break;
            case 'date':     $html = $this->_datepick_html($field, $value, $is_data);    break;
        }
        return $html;
    }
    
    
    public function get_field_html($field_data)
    {
        $params = array();
        
        if (isset($field_data['pick']) && is_array($field_data['pick']))
        {   $node = array();
            foreach($field_data['pick'] as $key => $pick){
                $node[$key]['value'] = $pick['pvalue'];
                $node[$key]['txt'] = $pick['pname'];
            }
            $params['node'] = $node;
            unset($node);
        }
        
        
    }
}

/* End of file TZ_Fields.php */
/* Location: ./application/libraries/TZ_Fields.php */

