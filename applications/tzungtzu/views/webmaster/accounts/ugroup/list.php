
<!-- 查询隐藏表单-->
<form name="search" method="post" action="<?php echo base_url($this->PagePath);?>" id="search_form">
<div style="display: none;" id="query_box_category">
    <div id="screen" class="box_970">
        <ul class="screening se_manage res_scre">
            <li class="bndata_li">
                    <span class="l"><?php echo $langcu['form_g_name'];?></span>
					<input type="hidden" name="stype" value="g_name" >
                    <input type="text" value="<?php echo $tz->get_data('svalue');?>" name="svalue" class="comm_ipt l">
                    &nbsp;<input type="submit" value="<?php echo $langco['btn_search']?>" id="search_btn" class="btn">
            </li>
        </ul>
    </div>
    <p class="line-t-20"></p>
</div>
</form>

<div style="width:100%;" class="box2 box4">
    <table class="table_lists table_click">
        <thead>
            <tr>
                <th  width="40" align="center"><input type="checkbox" onclick="C.form.check_all('.chk_list');"></th>
                <th  width="120" align="left"><?php echo $tz->set_sort(base_url($this->PagePath),'id',$langcu['form_g_name'] . '(ID)');?></th>
                <th width="80" align="left"><?php echo $langcu['form_g_state'];?></th>
                <th width="120" align="left"><?php echo $langcu['form_cdate'];?></th>
                <th align="left"><?php echo $langcu['form_remark'];?></th>
				<th width="80" align="left"><?php echo $langcu['form_is_admin_g'];?></th>
                <th width="170" align="left"><?php echo $langco['view_action_title'];?></th>
            </tr>
        </thead>
        <tbody>
			<?php foreach ($lists as $key => $value)
			{
			?>
            <tr id="formli<?php echo $value['id'];?>" data='{"id":"<?php echo $value['id'] ?>","g_name":"<?php echo $value['g_name'] ?>","g_remark":"<?php echo $value['g_remark'] ?>"}'>
                <td align="center"><input type="checkbox" value="<?php echo $value['id']?>" class="chk_list"></td>
                <td><a class="g_name" title="<?php echo $value['g_name']?>" href="<?php echo base_url($this->PagePath)?>/detail?id=<?php echo $value['id'];?>"><?php echo $value['g_name']?>(<?php echo $value['id']?>)</a></td>
                <td><?php  echo $this->tz_vars->get_field_str('user_status', $value['g_state']);?></td>
				<td><?php echo format_date(date('Y-m-d H:i:s',$value['cdate']), '#');?></td>
                <td><?php echo $value['g_remark'];?></td>
				<td><?php echo $this->tz_vars->get_field_str('is_admin', $value['is_admin_g']);?></td>
                <td>
                    <?php $tz->btn('B0101', "javascript:void(0);", $langco['btn_edit'], 'btn quickBtn', "key={$value['id']}");?> 
                    <?php $tz->btn('B0102', "javascript:del_one({$value['id']});", $langcu['btn_delete'], 'btn');?>  
                    <?php $tz->btn('B0103', "javascript:status({$value['g_state']},{$value['id']});", $this->tz_vars->get_field_str("user_status_action",$value['g_state']), 'btn');?>      
					<?php $tz->btn('B0104', base_url($this->RankPath . '?group_id=' . $value['id']), $langcu['btn_authority'], 'btn');?> 
                </td>
            </tr>
			<?php }?>
        </tbody>
		</table>
		<form  method="post" action="<?php echo base_url($this->PagePath);?>" id="form_data">
		<table class="table_lists">
		<tbody  id="form_add">
			<tr>
				<td><input type="hidden" name="id" id="id" value="0"></td>
				<td><input type="text" name="data[g_name]" class="comm_ipt " style="width:80px;" placeholder="<?php echo $langcu['form_g_name']?>" value=""></td>
				<td><input type="hidden" name="data[cdate]" value="<?php echo time();?>"></td>
				<td>&nbsp;</td>
				<td><input type="text" name="data[g_remark]"  placeholder="<?php echo $langcu['form_remark'];?>" class="comm_ipt" value=""></td>
				<td>
					<?php echo $this->tz_vars->input_str(array('node'=>'is_admin','name'=>'data[is_admin_g]','default'=>'{is_admin}'));?>
				</td>
				<td clss="saveBtn">
					<?php $tz->btn('B0101', 'javascript:;', $langcu['btn_add_ugroup'],'btn js_btn_save');?>         
				</td>
			</tr>
		</tbody>
		</table>
		</form>
    </table>
	<div class="template">
		<table>
			<tr>
				<td><input type="hidden" id="id" name="id" value="{id}"></td>
				<td><input type="text" name="data[g_name]" class="comm_ipt " style="width:80px;" value="{g_name}"></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td><input type="text" name="data[g_remark]" class="comm_ipt" value="{g_remark}"></td>
				<td>
					<?php echo $this->tz_vars->input_str(array('node'=>'is_admin','name'=>'data[is_admin_g]'));?>
				</td>
				<td clss="saveBtn">
					<?php $tz->btn('B0101', 'javascript:save_data();', $langcu['btn_save'],'btn');?>         
				</td>
			</tr>
		</table>
	</div>
    <p class="line-t-20"></p>
    <div class="pagebar">
        <?php echo $pagecode;?>
    </div>
    <p class="line-t-20"></p>
</div>
<p class="line-t-20"></p>
<div class="footer_fixed">
    <div class="box_1000">
        <span><?php echo $langco['view_action_title'] . $langco['colon']?></span>
        <?php $tz->btn('B01', base_url($this->PagePathUser), $langcu['btn_user_list'], 'btn3');?>  
		<?php $tz->btn('B0102', "javascript:del_data();", $langco['btn_deletes'], 'btn3');?> 
    </div>
</div>
