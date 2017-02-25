<div id="form_add">
	<form action="<?php echo base_url($this->PagePath);?>" method="post" id="form_data">
		<input type="hidden" name="id" value="<?php echo $data['id'];?>" />
        <table class="table_lists editbox">
            <tr>
				<td width="150" class="fr"><span class="fred">* </span><?php echo $langcu['form_title'] . $langco['colon']?></td>
                <td><input type="text" name="data[title]" class="comm_ipt" value="<?php echo $data['title'];?>"></td>
			</tr>
			<!-- <tr>
				<td class="fr"><span class="fred">* </span><?php echo $langcu['form_pfid'] . $langco['colon']?></td>
				<td><input type="text" name="data[pfid]" class="comm_ipt" value="<?php echo $data['pfid'];?>"> </td>
			</tr> -->
			<tr>
				<td class="fr"><span class="fred">* </span><?php echo $langcu['form_field'] . $langco['colon']?></td>
				<td>
					<input type="text" name="data[field]" class="comm_ipt" value="<?php echo $data['field'];?>"> 
				</td>
			</tr>
            <tr>
				<td class="fr"><span class="fred">* </span><?php echo $langcu['form_attribute'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[attribute]" value="<?php echo $data['attribute'];?>"></td>
			</tr>
            <tr>
				<td class="fr"><?php echo $langcu['form_dvalue'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[dvalue]" value="<?php echo $data['dvalue'];?>"></td>
			</tr>
            <tr>
				<td class="fr"><span class="fred">* </span><?php echo $langcu['form_form_type'] . $langco['colon']?></td>
				<td>
                    <?php echo $tz->tz_vars->input_str(array('node'=>'form_type','name'=>'form_type','type'=>'select_single','default'=>$data['form_type'],'is_data'=>TRUE));?>
                </td>
			</tr>
            <tr>
				<td class="fr"><?php echo $langcu['form_field_remark'] . $langco['colon']?></td>
				<td>
                    <?php echo $tz->tz_vars->input_str(array('node'=>'field_remark','name'=>'field_remark','type'=>'select_single','default'=> $data['field_remark'],'is_data'=>TRUE));?>
                </td>
			</tr>
            <tr>
				<td class="fr"><?php echo $langcu['form_forder'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[forder]" value="<?php echo $data['forder'];?>"></td>
			</tr>
            <!-- <tr>
				<td class="fr"><?php echo $langcu['form_is_system'] . $langco['colon']?></td>
				<td>
                    <?php echo $tz->tz_vars->input_str(array('node'=>'is_system', 'name'=>'is_system', 'type'=>'select_single', $data['is_system']));?>  
                </td>
			</tr> -->
            <tr>
				<td class="fr"><?php echo $langcu['form_antistop'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[antistop]" value="<?php echo $data['antistop'];?>"></td>
			</tr>
            <tr>
				<td class="fr"><span class="fred">* </span><?php echo $langcu['form_field_tag'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[field_tag]" value="<?php echo $data['field_tag'];?>"></td>
			</tr>
            <tr>
				<td class="fr"><?php echo $langcu['form_display'] . $langco['colon']?></td>
				<td>
                    <?php echo $tz->tz_vars->input_str(array('node'=>'display', 'name'=>'display', 'type'=>'select_single', $data['display'],'default'=> $data['display'],'is_data'=>TRUE));?>  
                </td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_fdesc'] . $langco['colon']?></td>
                <td><textarea name="data[fdesc]"><?php echo $data['fdesc'];?></textarea></td>
			</tr>
		</table>
	</form>
</div>
<div class="footer_fixed">
    <div class="box_1000">
        <span><?php echo $langco['view_action_title'] . $langco['colon']?></span>
		<?php $tz->btn('E0201', 'javascript:;', $langco['btn_save'], 'btn3 js_btn_save');?> 
		<?php $tz->btn('E02', base_url($this->PagePath), $langco['btn_back_list'], 'btn3');?> 
    </div>
</div>
