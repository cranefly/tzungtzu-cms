<!-- 查询隐藏表单-->
<div <?php if (empty($tz->get_data['svalue'])){echo 'style="display: none"';}?> id="query_box_category">
    <div id="screen" class="box_970">
        <ul class="screening se_manage res_scre">
            <li class="bndata_li">
                <form name="search" method="post" action="<?php echo base_url($this->PagePath);?>" id="search_form">
                    <span class="l"><?php echo $langco['view_search_select'];?></span>
                    <div class="l">
                        <?php echo $tz->tz_vars->input_str(array('node'=>'search','name'=>'stype','type'=>'select_single','default'=>$tz->get_data('stype'),'is_data'=>FALSE));?>                
					</div>
                    <span class="l"><?php echo $langco['view_search_keyword'];?></span>
                    <input type="text" value="<?php echo $tz->get_data('svalue');?>" name="svalue" class="comm_ipt l">
                    
                    &nbsp;<input type="submit" value="<?php echo $langco['btn_search']?>" id="search_btn" class="btn">
                </form>
            </li>
        </ul>
    </div>
    <p class="line-t-20"></p>
</div>

<div style="width:100%;" class="box2 box4">
	<form action="<?php echo base_url($this->PagePath);?>" id="form_data">
		<table class="table_lists table_click">
			<thead>
				<tr>
					<th width="40" align="center"><input type="checkbox" onclick="C.form.check_all('.chk_list');"></th>
					<th width="140" align="left"><?php echo $tz->set_sort(base_url($this->PagePath),'id',$langcu['form_uname'] . '(ID)');?></th>
					<th align="left"><?php echo $langcu['form_unick'];?></th>
					<th width="120" align="left"><?php echo $langcu['form_uphone'];?></th>
					<th align="left"><?php echo $langcu['form_uemail'];?></th>
					<th width="120" align="left"><?php echo $langcu['form_uqq'];?></th>
					<th width="50" align="left"><?php echo $tz->set_sort(base_url($this->PagePath), 'a.ustate', $langcu['form_ustate']);?></th>
					<th width="80" align="left"><?php echo $tz->set_sort(base_url($this->PagePath), 'a.group_id', $langcu['form_group']);?></th>
					<th width="170" align="left"><?php echo $langco['view_action_title'];?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($lists as $key => $value)
				{		
				?>
				<tr id="formli<?php echo $key;?>">
					<td align="center"><input type="checkbox" value="<?php echo $value['id']?>" class="chk_list"></td>
					<td><a href="<?php echo base_url($this->PagePath)?>/detail?id=<?php echo $value['id'];?>"><?php echo $value['uname']?>(<?php echo $value['id']?>)</a></td>
					 <td><?php echo $value['unick'];?></td>
					<td><?php echo $value['uphone'];?></td>
					<td><?php echo $value['uemail'];?></td>
					<td><?php echo $value['uqq'];?></td>
					<td><?php echo $this->tz_vars->get_field_str('user_status', $value['ustate']);?></td>
					<td><?php echo $value['g_name'];?></td>
					<td>
					<?php $tz->btn('B0201',  base_url($this->PagePath . '/edit?id=' . $value['id']), $langco['btn_edit'], 'btn');?>   
					<?php $tz->btn('B0203', "javascript:status({$value['ustate']},{$value['id']});", $this->tz_vars->get_field_str("user_status_action",$value['ustate']), 'btn');?> 
					<?php $tz->btn('B0202',  "javascript:del_one({$value['id']})", $langco['btn_delete']);?> 
					<?php $tz->btn('B0204', base_url($this->RankPath . '?user_id=' . $value['id']), $langcu['btn_authority'], 'btn', $value['rank'] == 'SUPER' ? 'disabled="disabled"' : '');?> 
					</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</form>
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
        <?php $tz->btn('B0201', base_url($this->PagePath . '/add'), $langcu['btn_add_user'], 'btn3');?> 
        <?php $tz->btn('B0202', "javascript:del_data();", $langcu['btn_deletes'], 'btn3');?> 
		<?php $tz->btn('B0203', "javascript:update_status(1);", $langcu['btn_enable_list'], 'btn3');?>   
		<?php $tz->btn('B0203', "javascript:update_status(0);", $langcu['btn_disable_list'], 'btn3');?>   
        <?php $tz->btn('B01', base_url($this->GroupPagePath), $langcu['btn_group_user'], 'btn3');?>         
    </div>
</div>
