<div id="form_add">
	<form action="<?php echo base_url($this->PagePath);?>" method="post" id="form_data">
		<input type="hidden" name="data[mid]" value="<?php echo $mid;?>">
		<input type="hidden" name="data[cdate]" value="<?php echo time();?>">
		<input type="hidden" name="data[uid]" value="<?php echo $tz->tz_user->UId;?>">
		<input type="hidden" name="mid" value="<?php echo $mid;?>">
		<table class="table_lists editbox">
			<tr>
				<td class="fr" width="150"><span class="fred">* </span><?php echo $langcu['form_category'] . $langco['colon']?></td>
				<td><?php echo $categories;?> </td>
			</tr>
            <?php foreach($field_info as $key => $value){?>
            <tr>
				<td class="fr"><?php echo $value['field_remark'] == 1 ? '<span class="fred">* </span>' : ''; ?><?php echo $value['title'] . $langco['colon']?></td>
				<td><?php echo $tz->tz_fields->get_form_html($value, NULL);?> </td>
			</tr>
            <?php }?>
            <tr>
				<td class="fr"><?php echo $langcu['form_resource'] . $langco['colon']?></td>
				<td>
                    <div id="resource" class="upload_img dz-clickable">
                    </div>
                    <div style="display:none" class="resource_hidden"></div> 
				</td>
			</tr>
		</table>
	</form>
</div>
<div class="footer_fixed">
    <div class="box_1000">
        <span><?php echo $langco['view_action_title'] . $langco['colon']?></span>
		<?php $tz->btn('C0101', 'javascript:save_data();', $langcu['btn_save'], 'btn3');?> 
		<?php $tz->btn('C01', site_url($this->PagePath . '/lists?mid=' . $mid), $langco['btn_back_list'], 'btn3');?> 
    </div>
</div>
