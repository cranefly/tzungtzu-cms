<div id="form_add">
	<form action="<?php echo base_url($this->PagePath);?>" method="post" id="form_data">
		<input type="hidden" name="id" value="<?php echo $data['id'];?>" />
		<table class="table_lists editbox">
			<tr>
				<td width="150" class="fr"><span class="fred">* </span><?php echo $langcu['form_cname'] . $langco['colon']?></td>
				<td><input type="text" name="data[cname]" class="comm_ipt" value="<?php echo $data['cname'];?>"></td>
			</tr>
			<tr>
				<td class="fr"><span class="fred">* </span><?php echo $langcu['form_parent_id'] . $langco['colon']?></td>
				<td>
					<?php 
					$fields = $this->category->show_select();
					array_unshift($fields, array('value'=>0,"txt"=>"顶级分类","txt_color"=>""));
					$this->tz_vars->set_fields("parent_id",$fields);

					unset($fields);
					echo $this->tz_vars->input_str(array('node'=>'parent_id','name'=>'parent_id','type'=>'select_single','default'=> $data['parent_id'],'is_data'=>TRUE,'style'=>'style="width:250px;"'));
					?> 
				</td>
			</tr>
			<tr>
				<td class="fr"><span class="fred">* </span><?php echo $langcu['form_model_id'] . $langco['colon']?></td>
				<td>
					<select name="data[model_id]" require="require">
						<option value="0"><?php echo $langcu['view_select_model']?></option>
						<?php foreach ($models as $model){?>
						<option value="<?php echo $model['id']?>" <?php echo $model['id'] == $data['model_id'] ? 'selected="selected"' : '';?>><?php echo $model['mtitle']?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_cnick'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[cnick]" value="<?php echo $data['cnick'];?>"></td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_ctitle'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[ctitle]" value="<?php echo $data['ctitle'];?>"></td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_ckey'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[ckey]" value="<?php echo $data['ckey'];?>"></td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_cdesc'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[cdesc]" value="<?php echo $data['cdesc'];?>"></td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_forder'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[forder]" value="<?php echo $data['forder'];?>"></td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_tpl_index'] . $langco['colon']?></td>
				<td>
					<select name="data[tpl_index]" require="require">
						<option value=""><?php echo $langcu['view_select_tpl']?></option>
						<?php foreach ($tpls['tpl_cover'] as $_tpl){?>
						<option value="<?php echo $_tpl['value']?>" <?php if($_tpl['value'] == $data['tpl_index']){echo('selected=selected');} ?>><?php echo $_tpl['txt'];?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_tpl_list'] . $langco['colon']?></td>
				<td>
					<select name="data[tpl_list]" require="require">
						<option value=""><?php echo $langcu['view_select_tpl']?></option>
						<?php foreach ($tpls['tpl_list'] as $_tpl){?>
						<option value="<?php echo $_tpl['value']?>" <?php if($_tpl['value'] == $data['tpl_list']){echo('selected=selected');} ?>><?php echo $_tpl['txt'];?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_tpl_content'] . $langco['colon']?></td>
				<td>
					<select name="data[tpl_content]" require="require">
						<option value=""><?php echo $langcu['view_select_tpl']?></option>
						<?php foreach ($tpls['tpl_detail'] as $_tpl){?>
                        <option value="<?php echo $_tpl['value']?>" <?php if($_tpl['value'] == $data['tpl_content']){echo('selected=selected');} ?>><?php echo $_tpl['txt'];?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_nav_show'] . $langco['colon']?></td>
				<td>
					<label><input name="data[nav_show]" type="radio" value="1" <?php echo $data['nav_show'] == 1 ? 'checked="checked"' : ''?> /><?php echo $langcu['view_radio_nav_1']?> </label> 
					&nbsp;&nbsp;&nbsp;&nbsp;
					<label><input name="data[nav_show]" type="radio" value="0" <?php echo $data['nav_show'] == 0 ? 'checked="checked"' : ''?>  /><?php echo $langcu['view_radio_nav_0']?> </label> 
				</td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_nav_show_wap'] . $langco['colon']?></td>
				<td>
					<label><input name="data[nav_show_wap]" type="radio" value="1" <?php echo $data['nav_show_wap'] == 1 ? 'checked="checked"' : ''?> /><?php echo $langcu['view_radio_nav_1']?> </label> 
					&nbsp;&nbsp;&nbsp;&nbsp;
					<label><input name="data[nav_show_wap]" type="radio" value="0" <?php echo $data['nav_show_wap'] == 0 ? 'checked="checked"' : ''?> /><?php echo $langcu['view_radio_nav_0']?> </label> 
				</td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_clogo'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[clogo]" value="<?php echo $data['clogo'];?>"></td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_clogo_hover'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[clogo_hover]" value="<?php echo $data['clogo_hover'];?>"></td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_cintro'] . $langco['colon']?></td>
				<td>
					<textarea name="data[cintro]"><?php echo $data['cintro'];?></textarea>
				</td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_go_url'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[go_url]" value="<?php echo $data['go_url'];?>"></td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_cdomain'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[cdomain]" value="<?php echo $data['cdomain'];?>"></td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_extern'] . $langco['colon']?></td>
				<td>
					<textarea name="data[extern]"><?php echo $data['extern'];?></textarea>
				</td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_tags'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[tags]" value="<?php echo $data['tags'];?>"></td>
			</tr>
			<tr>
				<td class="fr"><?php echo $langcu['form_ad_id'] . $langco['colon']?></td>
				<td><input type="text" class="comm_ipt" name="data[ad_id]" value="<?php echo $data['ad_id'];?>"></td>
			</tr>
		</table>
	</form>
</div>
<div class="footer_fixed">
    <div class="box_1000">
        <span><?php echo $langco['view_action_title'] . $langco['colon']?></span>
		<?php $tz->btn('C0201', 'javascript:save_data();', $langcu['btn_save_category'], 'btn3');?> 
		<?php $tz->btn('C02', base_url($this->PagePath), $langco['btn_back_list'], 'btn3');?> 
    </div>
</div>
