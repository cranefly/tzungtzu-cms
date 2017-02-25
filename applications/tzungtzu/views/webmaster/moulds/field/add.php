<div id="form_add">
	<form action="<?php echo base_url($this->PagePath);?>" method="post" id="form_data">
		<table class="table_lists editbox">
			<tr>
				<td width="150" class="fr"><span class="fred">* </span><?php echo $langcu['form_title'] . $langco['colon']?></td>
				<td><input type="text" name="data[title]" class="comm_ipt" value=""> 如：标题</td>
			</tr>
			<!-- <tr>
				<td class="fr"><?php echo $langcu['form_pfid'] . $langco['colon']?></td>
				<td><input type="text" name="data[pfid]" class="comm_ipt" value=""> </td>
			</tr> -->
			<tr>
				<td class="fr"><span class="fred">* </span><?php echo $langcu['form_field'] . $langco['colon']?></td>
				<td>
					<input type="text" name="data[field]" class="comm_ipt" value="">  如：title
				</td>
			</tr>
            <tr>
				<td class="fr"><span class="fred">* </span><?php echo $langcu['form_attribute'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[attribute]" value="varchar(128)"> 如：varchar(100)</td>
			</tr>
			<tr>
				<td class="fr"><span class="fred">* </span><?php echo $langcu['form_form_type'] . $langco['colon']?></td>
				<td>
                    <?php echo $tz->tz_vars->input_str(array('node'=>'form_type','name'=>'form_type','type'=>'select_single','default'=>'input','is_data'=>TRUE));?>
                </td>
			</tr>
			<tr>
				<td class="fr"><span class="fred">* </span><?php echo $langcu['form_field_tag'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[field_tag]" value="<?php echo $field_tag;?>"> 如：文档</td>
			</tr>
            <tr>
				<td class="fr"><?php echo $langcu['form_dvalue'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[dvalue]" value=""></td>
			</tr>
            
            <tr>
				<td class="fr"><?php echo $langcu['form_field_remark'] . $langco['colon']?></td>
				<td>
                    <?php // echo $tz->tz_vars->input_str(array('node'=>'field_remark','name'=>'field_remark','type'=>'select_single','is_data'=>TRUE));?>
                    <input type="text" class="comm_ipt" name="data[field_remark]" value="">
                </td>
			</tr>
            <tr>
				<td class="fr"><?php echo $langcu['form_forder'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[forder]" value="0"></td>
			</tr>
            <!-- <tr>
				<td class="fr"><?php echo $langcu['form_is_system'] . $langco['colon']?></td>
				<td>
                    <?php echo $tz->tz_vars->input_str(array('node'=>'is_system','name'=>'is_system','type'=>'select_single',0));?>  
                </td>
			</tr> -->
            <tr>
				<td class="fr"><?php echo $langcu['form_antistop'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[antistop]" value=""> 如：INFO_TITLE</td>
			</tr>
            <tr>
				<td class="fr"><?php echo $langcu['form_display'] . $langco['colon']?></td>
				<td>
                    <?php echo $tz->tz_vars->input_str(array('node'=>'display','name'=>'display','type'=>'select_single','is_data'=>TRUE,'default'=>0));?>  
                </td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_fdesc'] . $langco['colon']?> </td>
                <td><textarea name="data[fdesc]"></textarea> 如：文档模型的文档标题</td>
			</tr>
		</table>
	</form>
</div>
<div class="footer_fixed">
    <div class="box_1000">
        <span><?php echo $langco['view_action_title'] . $langco['colon']?></span>
		<?php $tz->btn('D0201', 'javascript:;', $langcu['btn_save'], 'btn3 js_btn_save');?> 
		<?php $tz->btn('D02', base_url($this->PagePath), $langco['btn_back_list'], 'btn3');?> 
    </div>
</div>

