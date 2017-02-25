<!-- 查询隐藏表单-->
<div style="" id="query_box_category">
    <div id="screen" class="box_970">
        <ul class="screening se_manage res_scre">
            <li class="bndata_li">
                <form name="search" method="post" action="<?php echo base_url($this->PagePath);?>" id="rank_form">
					<?php if (!empty($users)){?>
                    <span class="l"><?php echo $langcu['view_users'];?></span>
                    <div class="l">
                        <select name="user_id" id="form_user_id">
							<option value="0"><?php echo $langco['view_select_tip']?></option>
							<?php foreach($users as $user){?>
							<option value="<?php echo $user['id']?>" <?php echo $user['id'] == $user_id ? 'selected="selected"' : '' ?>><?php echo $user['uname']?></option>
							<?php }?>
						</select>               
					</div>
					<?php }?>
					<?php if (!empty($group)){?>
					<span class="l"><?php echo $langcu['view_group'];?></span>
                    <div class="l">
                        <select name="group_id">
							<option value="0"><?php echo $langco['view_select_tip']?></option>
							<?php foreach($group as $g){?>
							<option value="<?php echo $g['id']?>" <?php echo $g['id'] == $group_id ? 'selected="selected"' : '' ?>><?php echo $g['g_name']?></option>
							<?php }?>
						</select>               
					</div>
					<?php }?>
                </form>
            </li>
        </ul>
    </div>
    <p class="line-t-20"></p>
</div>
<form action="<?php echo base_url($this->PagePath);?>" method="post" id="form_data">
<div class="role_tabs">
<?php foreach($menus as $menu){?>
  <a id="tab_<?php echo $menu['level']?>" href="javascript:void(0);" class="selected_no">
    <?php echo $menu['title']?>
  </a>
<?php }?>
</div>
<div class="box4">
  <div style="height:10px;">
  </div>
  <div style="display:none;" id="postdata">
    <input type="hidden" value="<?php echo $group_id;?>" name="group_id">
    <input type="hidden" value="<?php echo $user_id;?>" name="user_id">
  </div>
	<?php foreach ($menus as $menu) {?>
	<div style="overflow: hidden; padding-bottom: 10px; display: none;" id="con_<?php echo $menu['level']?>">
		 <table class="table_lists">
			<thead>
			  <tr>
				<th>
					<input type="checkbox" name="level[]" class="cbx_all" value="<?php echo $menu['level'];?>" <?php if ($this->users->check_authority($menu['level'], $authority)){echo 'checked="checked"';}?>>
				</th>
				<th><?php echo $langcu['view_page_level']?></th>
				<th><?php echo $langcu['view_button_level']?></th>
			  </tr>
			</thead>
			<tbody>
				<?php foreach($menu['menu'] as $value){?>
			  <tr>
				<td width="40" align="center">
				  <input type="checkbox" name="level[]" class="cbx_child" value="<?php echo $value['level'] ?>" <?php if ($this->users->check_authority($value['level'], $authority)){echo 'checked="checked"';}?>>
				</td>
				<td width="100">
				  <b>
					<?php echo $value['title'] ?>
				  </b>
				</td>
				<td>
					<?php foreach($value['menu'] as $val){?>
					<span class="res_classify">
						<input type="checkbox" name="level[]" class="cbx_child_and" value="<?php echo $val['level']?>" id="<?php echo $val['level']?>" <?php if ($this->users->check_authority($val['level'], $authority)){echo 'checked="checked"';}?>>
					<label for="<?php echo $val['level']?>">
					  <?php echo $val['title']?>
					</label>
				  </span>
					<?php }?>
				</td>
			  </tr>
				<?php }?>
			</tbody>
		</table>
	</div>
	<?php } ?>
 </div>
</form>
<div class="footer_fixed">
    <div class="box_1000">
        <span><?php echo $langco['view_action_title'] . $langco['colon']?></span>
		<?php $tz->btn('B0201', 'javascript:;', $langcu['btn_save'], 'btn3 js_btn_save');?> 
		<?php $tz->btn('B02', base_url($this->PagePath), $langco['btn_back_list'], 'btn3');?> 
    </div>
</div>
