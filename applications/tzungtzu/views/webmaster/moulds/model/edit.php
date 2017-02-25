<div id="form_add">
	<form action="<?php echo base_url($this->PagePath);?>" method="post" id="form_data">
		<input type="hidden" name="id" value="<?php echo $data['id'];?>" />
        <table class="table_lists editbox">
            <tr>
				<td width="150" class="fr"><span class="fred">* </span><?php echo $langcu['form_mtitle'] . $langco['colon']?></td>
				<td><input type="text" name="data[mtitle]" class="comm_ipt" value="<?php echo $data['mtitle'];?>"></td>
			</tr>
			<tr>
				<td class="fr"><span class="fred">* </span><?php echo $langcu['form_mname'] . $langco['colon']?></td>
				<td><input type="text" name="data[mname]" class="comm_ipt" value="<?php echo $data['mname'];?>"> </td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_cmid'] . $langco['colon']?></td>
				<td>
					<select name="data[cmid]" require="require">
						<option id=""><?php echo $langco['view_select_tip']?></option>
						<?php foreach ($models as $m){?>
						<option value="<?php echo $m['id']?>" <?php echo $data['cmid'] == $m['id'] ? 'selected="selected"' : '';?>><?php echo $m['mtitle']?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_attr_content'] . $langco['colon']?></td>
                <td><textarea name="data[attr_content]"><?php echo $data['attr_content'];?></textarea></td>
			</tr>
		</table>
	</form>
</div>
<div class="footer_fixed">
    <div class="box_1000">
        <span><?php echo $langco['view_action_title'] . $langco['colon']?></span>
		<?php $tz->btn('D0201', 'javascript:;', $langco['btn_save'], 'btn3 js_btn_save');?> 
		<?php $tz->btn('D02', base_url($this->PagePath), $langco['btn_back_list'], 'btn3');?> 
    </div>
</div>
