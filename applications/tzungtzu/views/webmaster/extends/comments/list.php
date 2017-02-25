<!-- 查询隐藏表单-->
<div style="display: none" id="query_box_category">
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
	<form action="<?php echo base_url($this->PagePath);?>" id="table_list_form">
		<table class="table_lists table_click">
			<thead>
				<tr>
					<th width="40" align="center"><input type="checkbox" onclick="C.form.check_all('.chk_list');"></th>
					<th align="left"><?php echo $langcu['form_content'];?></th>
					<th align="left"><?php echo  $tz->set_sort(base_url($this->PagePath), 'uid', $langcu['form_uname']);?></th>
					<th width="80" align="left"><?php echo $langcu['form_ip'];?></th>
					<th width="80" align="left"><?php echo $tz->set_sort(base_url($this->PagePath), 'son', $langcu['form_son']);?></th>
					<th width="60" align="left"><?php echo $tz->set_sort(base_url($this->PagePath), 'good', $langcu['form_good']);?></th>
					<th width="60" align="left"><?php echo $tz->set_sort(base_url($this->PagePath), 'bad', $langcu['form_bad']);?></th>
					<th width="60" align="left"><?php echo $tz->set_sort(base_url($this->PagePath), 'is_check', $langcu['form_is_check']);?></th>
					<th align="left"><?php echo $tz->set_sort(base_url($this->PagePath), 'replay_id', $langcu['form_reply']);?></th>
					<th align="left"><?php echo $langcu['form_reply_name'];?></th>
					<th width="100" align="left"><?php echo $langco['view_action_title'];?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($lists as $key => $value)
				{
				?>
				<tr id="formli<?php echo $key;?>">
					<td align="center"><input type="checkbox" value="<?php echo $value['id']?>" class="chk_list"></td>
					<td><?php echo $value['content'];?></td>
					<td><?php echo $value['uname'];?></td>
					<td><?php echo $value['ip'];?></td>
					<td><?php echo $value['son'];?></td>
					<td><?php echo $value['good'];?></td>
					<td><?php echo $value['bad'];?></td>
					<td><?php echo $this->tz_vars->get_field_str("check",$value['is_check']);?></td>
					<td><?php echo $value['reply'];?></td>
					<td><?php echo $value['reply_name'];?></td>
					<td>
					<?php $tz->btn('E0803', "javascript:status({$value['is_check']},{$value['id']});", $this->tz_vars->get_field_str("check_action",$value['is_check']), 'btn');?>  
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
        <?php $tz->btn('E0203', "javascript:update_status(0);", $langcu['btn_enable_list'], 'btn3');?>   
		<?php $tz->btn('E0203', "javascript:update_status(1);", $langcu['btn_disable_list'], 'btn3');?>   
    </div>
</div>
