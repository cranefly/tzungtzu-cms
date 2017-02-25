<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TzungTzu CMS
 *
 * 系统字段
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
 * TZ Vars Class
 *
 * @package		TzungTzu
 * @subpackage	Libraries
 * @category	Libraries
 * @author		TZ Dev Team
 */
class TZ_Vars
{
    private $_lang_current = NULL;

    public function __construct($lang = NULL)
    {
        if ($lang !== NULL)
        {
            $this->_lang_current = $lang;
        }
    }

    private $fields = array(
       
        //用户状态操作，刚好和状态相反，正常下显示禁用，禁用下显示启用
        'user_status' => array( 
            array('value' => 1, 'txt' => '禁用', 'color' => 'red'),
            array('value' => 0, 'txt' => '正常', 'color' => 'green'),
        ),
        
        //用户状态操作，刚好和状态相反，正常下显示禁用，禁用下显示启用
        'user_status_action' => array( 
            array('value' => 1, 'txt' => '启用', 'color' => 'green'),
            array('value' => 0 , 'txt' => '禁用', 'color' => 'red'),
        ),
        'article_status_action' => array( 
            array('value' => 2, 'txt' => '启用', 'color' => 'green'),
            array('value' => 1, 'txt' => '禁用', 'color' => 'red'),
		),
        'check' => array( 
            array('value' => 1, 'txt' => '已审核', 'color' => 'green'),
            array('value' => 0, 'txt' => '未审核', 'color' => 'red'),
        ),
        'is_table' => array( 
            array('value' => 1, 'txt' => '已建表', 'color' => 'green'),
            array('value' => 0, 'txt' => '未建表', 'color' => 'red'),
        ),
        
        'is_admin' => array( 
            array('value' => 1, 'txt' => '管理用户', 'color' => 'green'),
            array('value' => 0, 'txt' => '普通用户', 'color' => 'blue'),
        ),
        
        //用户状态操作，刚好和状态相反，正常下显示禁用，禁用下显示启用
        'check_action' => array( 
            array('value' => 1, 'txt' => '不通过', 'color' => 'red'),
            array('value' => 0 , 'txt' => '通过', 'color' => 'green'),
        ),
        
        'form_type' => array( //表单类型
            array('value' => 'input',      'txt' => '文本框'), //文本框
            array('value' => 'textarea',   'txt' => '多行文本框'), //多行文本框
            array('value' => 'radio',      'txt' => '单选框'), //单选框
            array('value' => 'checkbox',   'txt' => '多选框'), //多选框
            array('value' => 'upload',     'txt' => '上传按钮'), //上传按钮
            array('value' => 'edit',       'txt' => '编辑框'), //编辑框
            array('value' => 'select',     'txt' => '下拉框'), //下拉框
            array('value' => 'link',       'txt' => '联动表单'), //联动表单
            array('value' => 'datapicker', 'txt' => '日期选择器'), //日期选择器
        ),
    ); 

    /**
     * 增加或者重设一个节点
     * @param $node 节点名称 如 yesno
     * @param $field 节点内容 如 array(array('value'=>'','txt'=>'','txt_color'=>''),...)
     */
    public function set_fields($node, $field)
    {
        $this->fields[$node] = $field;
    }

    public function get_fields($node = '')
    {
        return $node == '' ? $this->fields : $this->fields[$node];
    }

    //某个借点插入一项
    public function set_field($node, $field, $pos=0)
    {
        $tmp = $this->get_fields($node);
        array_splice($tmp, $pos, 0, array($field));
        $this->set_fields($node, $tmp);
    }

    /**
     * 返回某个节点的某个值对应的数组数组
     * @param $node 节点名称
     * @param $value 节点值
     */
    public function get_field($node, $value) 
    {
        foreach($this->fields[$node] as $v) 
        {
            if ($v['value'] == $value) {
                return $v;
            }
        }

        return array('value' => '', 'txt' => '请选择', 'color' => '');
    }
    
    /**
     * 根据值，返回某个节点某个值对应的文本或者HTML
     * @param $node 节点名称
     * @param $value 节点值
     * @param $type 返回字符串类型，txt或者html
     */
    public function get_field_str($node, $value, $type = FALSE) 
    {
        $field = $this->get_field($node, $value); //print_r($field);
        if ($type) {

            return $field['txt'];
        } else 
        {
            $color = isset($field['color']) ? 'color="'.$field['color'].'"' : '';
            
            return '<font '.$color.'>' . $field['txt'] . '</font>';
        }
    }
    
    /**
     * 输出HTML表单
     * @access public
     * @param $params 参数数组 array('node'=>'','type'=>'','default'=>'')
     * @param =>type 表单类型 select,checkbox,radio
     * @param =>node    节点
     * @param =>default 默认选中
     * @param =>name    表单名称后缀，用于一个页面多次出现时候区分
     * @param =>alias 别名，用于同值但是文字相同的表单
     * @param =>stype 模拟下拉框的样式
     * @param =>on 表单函数 click,change等
     * @return string
     */
    public function input_str($params) {
        
        // 初始化
        $node       = isset($params['node'])    ? $params['node'] : '';
        $type       = isset($params['type'])    ? $params['type'] : 'select_single';
        $default    = isset($params['default']) ? $params['default'] : '';
        $name       = isset($params['name'])    ? $params['name'] : '';
        $on         = isset($params['on'])      ? $params['on'] : '';
        $alias      = isset($params['alias'])   ? $params['alias'] : '';
        $style      = isset($params['style'])   ? $params['style'] : 'style="width:120px"';
        $is_data    = isset($params['is_data']) ? $params['is_data'] : FALSE;
        $isCallBack = isset($params['callback'])? $params['callback'] : 'false';

        $html       = '';
        // 下拉框
        if ($type == 'select') 
        {
            $html .= '<select name="'. $this->_get_data_name($name, $is_data).'" '.$on.' id="' . $node . $name . '">';

            foreach($this->fields[$node] as $f) 
            {
                $select = '';
                if (strlen($default) > 0 && $f['value'] == $default) $select = ' selected';
                $html  .= '<option value="' . $f['value'] . '"' . $select . '>' . $f['txt'] . '</option>';
            }

            $html .= '</select>';
        }

        // 单选框
        if ($type == 'radio') 
        {
            foreach($this->fields[$node] as $f) 
            {
                $select = '';
                if (strlen($default) > 0 && $f['value'] == $default) $select = ' checked';
                $html  .= '&nbsp;&nbsp;<input type="radio" ' . $on . ' name="' . $this->_get_data_name($name, $is_data) . '" value="' . $f['value'] . '"' . $select . '>&nbsp;' . $f['txt'] . '';
            }
        }

        // 复选框
        if ($type == 'checkbox') 
        {
            foreach($this->fields[$node] as $f) 
            {
                $select = '';
                $df_val = explode(',',$default);

                if (strlen($default) > 0 && in_array($f['value'],$df_val)) $select = ' checked';

                $html  .= '<span class="cbx_wrap"><input ' . $on . ' type="checkbox"  class="' . ($alias==''?$node.$name:$alias.$name) . '" name="' . $this->_get_data_name($name, $is_data) . '" value="' . $f['value'] . '"' . $select . '><label for="' . $node . $name . '">&nbsp;&nbsp;' . $f['txt'] . '&nbsp;&nbsp;</label></span>';
            }
        }
        // 模拟下拉单选框
        if($type == 'select_single')
        {
            $html .= '<select name='.$this->_get_data_name($name, $is_data) . '  id="' . ($alias=='' ? $node . $name:$alias . $name) . '">';
            $html .= '<option value="">请选择</a>';
            foreach($this->fields[$node] as $f) 
            {
                $selected = '';
                if (strlen($default) > 0 && $f['value'] == $default) $selected = 'selected="selected"';
                $html  .= '<option value="' . $f['value'] . '" ' . $selected . ' >' . $f['txt'] . '</a>';
            }
            $html .= '</seclect>';
            /*
            $html .= '<div class="sel_box" onclick="select_single(event,this'.(empty($on) ? '' : ',\'' . $on . '\'') . ',' . $isCallBack . ');return false;" ' . $style . '>';
            $html .= '<a href="javascript:void(0);" class="txt_box" id="txt_box">';
            $html .= '<div class="sel_inp" id="sel_inp">' . $this->get_field_str($node , $default , FALSE) . '</div>';
            $html .= '<input type="hidden" name="'.$this->_get_data_name($name, $is_data) . '" id="' . ($alias=='' ? $node . $name:$alias . $name) . '" value="' . $default . '" class="sel_subject_val">';
            $html .= '</a>';
            $html .= '<div class="sel_list" id="sel_list" style="display:none;">';
            foreach($this->fields[$node] as $f) 
            {
                $select = '';
                if (strlen($default) > 0 && $f['value'] == $default) $select = 'current';
                $html  .= '<a href="javascript:void(0);" value="' . $f['value'] . '" class="'.$select.'" '.$on.'>' . $f['txt'] . '</a>';
            }

            $html .= '    </div>';
            $html .= '</div>';
            * */
        }

        unset($params);

        return $html;
    }  

    /**
     * 把array(array('name' => '' ,=>'id' =>0),...)
     * 转成==> array(array('value'=>0,'txt'=>'name'),...)
     *
     * @access public
     * @param $data
     * @param $change_fileds = array('txt' => 'name','value'=>'id')
     * @param $change_fileds = array('txt' => 'name','value'=>'id')
     * @return string
     */
    public function data2input($data, $change_fileds, $params = array())
    {
        $nodes = $this->data2field($data, $change_fileds);

        $params['node']       = isset($params['node']) ? $params['node'] : 'group_id';
        $params['type']       = isset($params['type'])?$params['type']:'select';
        $params['default']    = isset($params['default'])?$params['default']:'';
        $params['is_data']    = isset($params['is_data']) ? $params['is_data'] : TRUE;

        $this->set_fields($nodes, $params['node']);

        unset($nodes);

        return $this->input_str($params);
    }

    /**
     * 把array(array('name' => '' ,=>'id' =>0),...)
     * 转成==> array(array('value'=>0,'txt'=>'name'),...)
     *
     * @access public
     * @param $data
     * @param $change_fileds = array('txt' => 'name','value'=>'id')
     * @return array()
     */
    public function data2field($data = array(), $change_fileds = array())
    {
        $return_array = array();

        foreach ($data as $key => $value) {
            $return_array[$key]['txt']    = $value[$change_fileds['txt']];
            $return_array[$key]['value']  = $value[$change_fileds['value']];
        }

        unset($data, $change_fileds);
        return $return_array;
    }


    /**
     * 获取字段名称
     * @access private
     * @param $name
     * @param $is_data
     * @return string
     */
    private function _get_data_name($name, $is_data)
    {
        return $is_data ? "data[{$name}]" : $name;
    }
}

/* End of file TZ_Vars.php */
/* Location: ./application/libraries/TZ_Vars.php */

