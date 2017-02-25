<div id="form_add">
	<form action="<?php echo base_url($this->PagePath);?>" method="post" id="form_data">
        <input type="hidden" value="<?php echo time();?>" name="data[cdate]" />
		<table class="table_lists editbox">
			<tr>
				<td width="150" class="fr"><span class="fred">* </span><?php echo $langcu['form_title'] . $langco['colon']?></td>
				<td><input type="text" name="data[title]" class="comm_ipt" value=""></td>
			</tr>
			<tr>
				<td class="fr"><span class="fred">* </span><?php echo $langcu['form_ckey'] . $langco['colon']?></td>
				<td><input type="text" name="data[ckey]" class="comm_ipt" value=""> </td>
			</tr> 
			<tr>
				<td class="fr"><span class="fred">* </span><?php echo $langcu['form_cvalue'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[cvalue]" value=""></td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_tag'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[tag]" value=""></td>
			</tr>
            <tr>
				<td class="fr"><?php echo $langcu['form_field_type'] . $langco['colon']?></td>
				<td>
                     <?php echo $tz->tz_vars->input_str(array('node'=>'form_type','name'=>'field_type','type'=>'select_single','default'=>'input','is_data'=>TRUE));?>
				</td>
			</tr>
			
		</table>
	</form>
</div>
<div class="footer_fixed">
    <div class="box_1000">
        <span><?php echo $langco['view_action_title'] . $langco['colon']?></span>
		<?php $tz->btn('A0201', 'javascript:;', $langcu['btn_save'], 'btn3 js_btn_save');?> 
		<?php $tz->btn('A02', base_url($this->PagePath), $langco['btn_back'], 'btn3');?> 
    </div>
</div>
