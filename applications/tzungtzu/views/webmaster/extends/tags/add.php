<div id="form_add">
	<form action="<?php echo base_url($this->PagePath);?>" method="post" id="form_data">
		<table class="table_lists editbox">
			<tr>
				<td width="150" class="fr"><span class="fred">* </span><?php echo $langcu['form_tag'] . $langco['colon']?></td>
				<td><input type="text" name="data[tag]" class="comm_ipt" value=""></td>
			</tr>
			<tr>
				<td class="fr"><span class="fred">* </span><?php echo $langcu['form_tag_url'] . $langco['colon']?></td>
				<td><input type="text" name="data[tagurl]" class="comm_ipt" value=""> </td>
			</tr> 
			<tr>
				<td class="fr"><?php echo $langcu['form_tag_img'] . $langco['colon']?></td>
                <td>
                    <input name="data[tagimg]" id="upload_img_value" value="" type="hidden">
                    <div class="upload_img dz-clickable" id="upload_img"></div>
                    <div class="upload_img_hidden" style="display:none"></div>
                </td>
			</tr>
            <tr>
				<td class="fr"><?php echo $langcu['form_forder'] . $langco['colon']?></td>
				<td><input id="forder" type="text" class="comm_ipt" name="data[forder]" value="100"></td>
			</tr>
			<tr>
				<td class="fr"><span class="fred">* </span><?php echo $langcu['form_group_id'] . $langco['colon']?></td>
				<td>
					<select name="data[group_id]" require="require">
						<option id=""><?php echo $langco['view_select_tip']?></option>
						<?php foreach ($groups as $group){?>
						<option value="<?php echo $group['id']?>"><?php echo $group['gname']?></option>
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
		<?php $tz->btn('E0601', 'javascript:;', $langcu['btn_save'], 'btn3 js_btn_save');?> 
		<?php $tz->btn('E06', base_url($this->PagePath), $langco['btn_back'], 'btn3');?> 
    </div>
</div>
