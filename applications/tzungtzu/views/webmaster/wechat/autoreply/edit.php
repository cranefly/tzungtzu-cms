<div id="form_add">
	<form action="<?php echo base_url($this->PagePath);?>" method="post" id="form_data">
		<input type="hidden" name="id" value="<?php echo $data['id'];?>" />
		<table class="table_lists editbox">
            <tr>
				<td width="150" class="fr"><span class="fred">* </span><?php echo $langcu['form_type'] . $langco['colon']?></td>
				<td><?php echo $tz->tz_vars->input_str(array('node'=>'types','name'=>'type','type'=>'select_single','default'=> $data['type'],'is_data'=>TRUE,'style'=>'style="width:250px;"'))?></td>
			</tr>
			<tr>
				<td width="150" class="fr"><span class="fred">* </span><?php echo $langcu['form_keyword'] . $langco['colon']?></td>
				<td><input type="text" name="data[keyword]" class="comm_ipt" value="<?php echo $data['keyword']?>"></td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_reply'] . $langco['colon']?></td>
                <td><textarea style="width:70%;" name="data[reply]"><?php echo $data['reply']?></textarea></td>
			</tr> 
		</table>
	</form>
</div>
<div class="footer_fixed">
    <div class="box_1000">
        <span><?php echo $langco['view_action_title'] . $langco['colon']?></span>
		<?php $tz->btn('E0201', 'javascript:save_data();', $langcu['btn_save'], 'btn3');?> 
		<?php $tz->btn('E02', base_url($this->PagePath), $langco['btn_back'], 'btn3');?> 
    </div>
</div>
