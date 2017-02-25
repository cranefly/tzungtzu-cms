<!-- 查询隐藏表单-->
<div style="display: none" id="query_box_category">
    <div id="screen" class="box_970">
        <ul class="screening se_manage res_scre">
        </ul>
    </div>
    <p class="line-t-20"></p>
</div>
<div id="query_box_category" style="">
    <div class="box_970" id="screen">
        <ul class="screening se_manage res_scre">
            <li class="bndata_li">
                <form id="rank_form" action="<?php echo base_url($this->PagePath);?>" method="post" name="search">
					<span class="l">当前模型：</span>
                    <div class="l">
                        <select id="form_mid" name="id">
							<option value="0"><?php echo $langco['view_select_tip']?></option>
							<?php foreach($models as $model){ ?>
								<option value="<?php echo $model['id']?>" <?php if($id == $model['id']){echo 'selected="selected"';}?>><?php echo $model['mtitle']?></option>
							<?php }?>
							</select>               
					</div>
				</form>
            </li>
        </ul>
    </div>
    <p class="line-t-20"></p>
</div>

<form id="form_data" method="post" action="<?php echo base_url($this->PagePath);?>" prefix="create_model">
<div class="role_tabs">
	<?php foreach($tags as $key => $tag){?>
	<a class="selected_no" href="javascript:void(0);" id="tab_<?php echo $key + 1;?>"><?php echo empty($tag['field_tag']) ? $langcu['view_default_tag'] : $tag['field_tag'];?> </a>
	<?php }?>
</div>
<div class="box4">
  <div style="height:10px;"></div>
  <div id="postdata" style="display:none;">
	  <input type="hidden" name="id" value="<?php echo $id?>" />
  </div>
		<?php 
		$index = 0;
		foreach($tags as $tag){
			$index++
		?>
		<div id="con_<?php echo $index;?>" style="overflow: hidden; padding-bottom: 10px; display: none;">
		 <table class="table_lists">
			<tbody>
				<tr >
				<td width="100" align="left">
					<?php
					$_key_field = empty($tag['field_tag']) ? $langcu['view_default_tag'] : $tag['field_tag'];
					foreach($field_array[$_key_field] as $field){?>
					<span class="res_classify">
						<input type="checkbox" value="<?php echo $field['id'];?>" id="field_<?php echo $field['id'];?>" class="cbx_child_and" <?php echo in_array($field['id'], $related) ? 'checked="checked"' : '' ?> name="data[]">
					<label for="field_<?php echo $field['id'];?>"><?php echo $field['title'] . '--' . $field['field_tag'];?></label>
				  </span>
					<?php }?>
				</td>
			  </tr>
			</tbody>
		</table>
	</div>
	<?php }?>
	</div>
</form>

<p class="line-t-20"></p>
<div class="footer_fixed">
    <div class="box_1000">
        <span><?php echo $langco['view_action_title'] . $langco['colon'] ?></span>
		<?php $tz->btn('D0203', 'javascript:save_data();', $langcu['btn_save'], 'btn3'); ?>   
		<?php $tz->btn('D02', base_url($this->PagePath), $langco['btn_back_list'], 'btn3');?> 
    </div>
</div>
