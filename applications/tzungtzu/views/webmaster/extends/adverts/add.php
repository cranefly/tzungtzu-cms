<div id="form_add">
    <form action="<?php echo base_url($this->PagePath);?>" method="post" id="form_data">
        <input type="hidden" value="<?php echo time();?>" name="data[cdate]" />
		<table class="table_lists editbox">
			<tr>
				<td width="150" class="fr"><span class="fred">* </span><?php echo $langcu['form_ad_title'] . $langco['colon']?></td>
				<td><input type="text" name="data[ad_title]" class="comm_ipt" value=""></td>
			</tr>
			<tr>
				<td class="fr"><span class="fred">* </span><?php echo $langcu['form_ad_nav_title'] . $langco['colon']?></td>
				<td><input type="text" name="data[ad_nav_title]" class="comm_ipt" value=""> </td>
			</tr> 
			<tr>
				<td class="fr"><?php echo $langcu['form_ad_url'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[ad_url]" value=""></td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_ad_code'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[ad_code]" value=""></td>
			</tr>
            <tr>
				<td class="fr"><?php echo $langcu['form_ad_img'] . $langco['colon']?></td>
                <td>
                    <input name="data[ad_img]" id="upload_img_value" value="" type="hidden">
                    <div class="upload_img dz-clickable" id="upload_img"></div>
                    <div class="upload_img_hidden" style="display:none"></div>
                </td>
			</tr>
			<tr>
				<td class="fr"><span class="fred">* </span><?php echo $langcu['view_g_title'] . $langco['colon']?></td>
				<td>
					<select name="data[g_id]" require="require">
						<option id=""><?php echo $langco['view_select_tip']?></option>
						<?php foreach ($groups as $group){?>
						<option value="<?php echo $group['id']?>"><?php echo $group['title']?></option>
						<?php }?>
					</select>
				</td>
			</tr>
            <tr>
				<td class="fr"><?php echo $langcu['form_start_date'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[start_date]" value="" onclick="new Calendar().show(this);"></td>
			</tr>
            <tr>
				<td class="fr"><?php echo $langcu['form_expire_date'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[expire_date]" value="" onclick="new Calendar().show(this);"></td>
			</tr>
            <tr>
				<td class="fr"><?php echo $langcu['form_forder'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[forder]" value=""></td>
			</tr>
		</table>
	</form>
</div>
<div class="footer_fixed">
    <div class="box_1000">
        <span><?php echo $langco['view_action_title'] . $langco['colon']?></span>
		<?php $tz->btn('E0401', 'javascript:;', $langcu['btn_save'], 'btn3 js_btn_save');?> 
		<?php $tz->btn('E04', site_url($this->PagePath), $langco['btn_back'], 'btn3');?> 
    </div>
</div>
