<div id="form_add">
	<form action="<?php echo base_url($this->PagePath);?>" method="post" id="form_data">
		<input type="hidden" name="id" value="<?php echo $data['id'];?>" />
		<table class="table_lists editbox">
			<tr>
				<td width="150" class="fr"><span class="fred">* </span><?php echo $langcu['form_uname'] . $langco['colon']?></td>
				<td><input type="text" name="data[uname]" class="comm_ipt" value="<?php echo $data['uname']?>"></td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_unick'] . $langco['colon']?></td>
				<td><input type="text" name="data[unick]" class="comm_ipt" value="<?php echo $data['unick']?>"> </td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_uavatar'] . $langco['colon']?></td>
				<td>
                    <input name="data[uavatar]" id="upload_img_value" value="<?php echo $data['uavatar']?>" type="hidden">
                    <div class="upload_img dz-clickable" id="upload_img">
                        <img src="<?php echo $data['uavatar']?>" style="height:30px;padding-top:5px; padding-left:5px;"></div>
                    <div class="upload_img_hidden" style="display:none"></div>
                </td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_uemail'] . $langco['colon']?></td>
				<td><input id="uemail" type="text" class="comm_ipt" name="data[uemail]" value="<?php echo $data['uemail']?>"></td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_uphone'] . $langco['colon']?></td>
				<td><input id="uphone" type="text" class="comm_ipt" name="data[uphone]" value="<?php echo $data['uphone']?>"></td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_uqq'] . $langco['colon']?></td>
				<td><input id="uqq" type="text" class="comm_ipt" name="data[uqq]" value="<?php echo $data['uqq']?>"></td>
			</tr>
			<tr>
				<td class="fr"><span class="fred">* </span><?php echo $langcu['form_group'] . $langco['colon']?></td>
				<td>
					<select name="data[group_id]" require="require">
						<option id=""><?php echo $langco['view_select_tip']?></option>
						<?php foreach ($groups as $group){?>
						<option value="<?php echo $group['id']?>" <?php if ($data['group_id'] == $data['group_id']) {echo 'selected="selected"';}?>><?php echo $group['g_name']?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_motto'] . $langco['colon']?></td>
				<td>
					 <textarea name="data[motto]" style="width: 238px;" placeholder=""><?php echo $data["motto"]?></textarea>
				</td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_upass'] . $langco['colon']?></td>
				<td><input id="upass" type="text" class="comm_ipt" name="data[upass]" value="">&nbsp;&nbsp;<?php echo $langcu['explain_upass']; ?></td>
			</tr>
		</table>
	</form>
</div>
<div class="footer_fixed">
    <div class="box_1000">
        <span><?php echo $langco['view_action_title'] . $langco['colon']?></span>
		<?php $tz->btn('B0201', 'javascript:;', $langcu['btn_save_user'], 'btn3 js_btn_save');?> 
		<?php $tz->btn('B02', base_url($this->PagePath), $langco['btn_back_list'], 'btn3');?> 
    </div>
</div>
