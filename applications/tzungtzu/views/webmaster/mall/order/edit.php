<div id="form_add">
	<form action="<?php echo site_url($this->PagePath);?>" method="post" id="form_data">
		<input type="hidden" name="id" value="<?php echo $data['id'];?>" />
		<table class="table_lists editbox">
			<tr>
				<td width="150" class="fr"><span class="fred">* </span><?php echo $langcu['form_flink_name'] . $langco['colon']?></td>
				<td><input type="text" name="data[uname]" class="comm_ipt" value="<?php echo $data['flink_name']?>"></td>
			</tr>
			<tr>
				<td class="fr"><span class="fred">* </span><?php echo $langcu['form_flink_url'] . $langco['colon']?></td>
				<td><input type="text" name="data[unick]" class="comm_ipt" value="<?php echo $data['flink_url']?>"> </td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_forder'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[forder]" value="<?php echo $data['forder']?>"></td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_owner'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[owner]" value="<?php echo $data['owner']?>"></td>
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
		</table>
	</form>
</div>
<div class="footer_fixed">
    <div class="box_1000">
        <span><?php echo $langco['view_action_title'] . $langco['colon']?></span>
		<?php $tz->btn('E0201', 'javascript:;', $langcu['btn_save_flink'], 'btn3 js_btn_save');?> 
		<?php $tz->btn('E02', base_url($this->PagePath), $langco['btn_back_list'], 'btn3');?> 
    </div>
</div>
