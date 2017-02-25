<div id="form_add">
	<form action="<?php echo base_url($this->PagePath);?>" method="post" id="form_data">
		<input type="hidden" name="id" value="<?php echo $data['id'];?>" />
		<table class="table_lists editbox">
            <tr>
				<td width="150" class="fr"><span class="fred">* </span><?php echo $langcu['form_type'] . $langco['colon']?></td>
				<td><?php echo $tz->tz_vars->input_str(array('node'=>'types','name'=>'type','type'=>'select_single','default'=> $data['type'],'is_data'=>TRUE,'style'=>'style="width:250px;"'))?></td>
			</tr>
			<tr>
				<td width="150" class="fr"><span class="fred">* </span><?php echo $langcu['form_title'] . $langco['colon']?></td>
				<td><input type="text" name="data[title]" class="comm_ipt" value="<?php echo $data['title'];?>"></td>
			</tr>
			<tr>
				<td width="150" class="fr"><?php echo $langcu['form_replay'] . $langco['colon']?></td>
				<td><input type="text" name="data[replay]" class="comm_ipt" value="<?php echo $data['replay'];?>"></td>
			</tr>
            <tr>
				<td class="fr"><?php echo $langcu['form_media_url'] . $langco['colon']?></td>
				<td><input name="data[cover]" id="upload_img_value" value="" type="hidden"><div class="upload_img dz-clickable" id="upload_img"></div><div class="upload_img_hidden" style="display:none"></div> </td>
			</tr>
            <tr>
				<td width="150" class="fr"><?php echo $langcu['form_author'] . $langco['colon']?></td>
				<td><input type="text" name="data[author]" class="comm_ipt" value="<?php echo $data['author'];?>"></td>
			</tr>
            <tr>
				<td width="150" class="fr"><?php echo $langcu['form_link'] . $langco['colon']?></td>
				<td><input type="text" name="data[link]" class="comm_ipt" value="<?php echo $data['link'];?>"></td>
			</tr>
            <tr>
				<td class="fr"><?php echo $langcu['form_content'] . $langco['colon']?></td>
				<td><textarea id="simditor_editor" style="width:70%;" placeholder="Balabala" name="data[content]" autofocus><?php echo $data['content'];?></textarea> </td>
            </tr>
            <tr>
				<td class="fr"><?php echo $langcu['form_description'] . $langco['colon']?></td>
				<td><textarea name="data[description]" style="width: 238px;" placeholder=""><?php echo $data['description'];?></textarea> </td>
			</tr>
		</table>
	</form>
</div>
<div class="footer_fixed">
    <div class="box_1000">
        <span><?php echo $langco['view_action_title'] . $langco['colon']?></span>
		<?php $tz->btn('E0201', 'javascript:;', $langcu['btn_save'], 'btn3 js_btn_save');?> 
		<?php $tz->btn('E02', base_url($this->PagePath), $langco['btn_back'], 'btn3');?> 
    </div>
</div>
