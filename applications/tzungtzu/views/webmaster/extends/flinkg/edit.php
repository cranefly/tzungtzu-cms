<div id="form_add">
	<form action="<?php echo site_url($this->PagePath);?>" method="post" id="form_data">
		<input type="hidden" name="id" value="<?php echo $data['id'];?>" />
		<table class="table_lists editbox">
			<tr>
				<td width="150" class="fr"><span class="fred">* </span><?php echo $langcu['form_gname'] . $langco['colon']?></td>
				<td><input type="text" name="data[gname]" class="comm_ipt" value="<?php echo $data['gname']?>"></td>
			</tr>
			<tr>
				<td class="fr"><span class="fred">* </span><?php echo $langcu['form_gurl'] . $langco['colon']?></td>
				<td><input type="text" name="data[gurl]" class="comm_ipt" value="<?php echo $data['gurl']?>"> </td>
			</tr>
            <tr>
				<td class="fr"><?php echo $langcu['form_gimg'] . $langco['colon']?></td>
				<td>
                    <input name="data[thumb_image]" id="upload_img_value" value="<?php echo $data['gimg']?>" type="hidden">
                    <div class="upload_img dz-clickable" id="upload_img">
                        <img src="<?php echo $data['gimg']?>" style="height:30px;padding-top:5px; padding-left:5px;"></div>
                    <div class="upload_img_hidden" style="display:none"></div>
                    </td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_forder'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[forder]" value="<?php echo $data['forder']?>"></td>
			</tr>
		</table>
	</form>
</div>
<div class="footer_fixed">
    <div class="box_1000">
        <span><?php echo $langco['view_action_title'] . $langco['colon']?></span>
		<?php $tz->btn('E0101', 'javascript:;', $langcu['btn_save'], 'btn3 js_btn_save');?> 
		<?php $tz->btn('E01', site_url($this->PagePath), $langco['btn_back_list'], 'btn3');?> 
    </div>
</div>
