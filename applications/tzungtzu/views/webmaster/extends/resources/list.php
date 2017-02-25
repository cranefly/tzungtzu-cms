<!-- 查询隐藏表单-->
<div style="display: none" id="query_box_category">
    <div id="screen" class="box_970">
        <ul class="screening se_manage res_scre">
            <li class="bndata_li">
                <form name="search" method="post" action="<?php echo site_url($this->PagePath);?>" id="search_form">
                    <span class="l"><?php echo $langco['view_search_select'];?></span>
                    <div class="l">
                        <?php echo $tz->tz_vars->input_str(array('node'=>'search','name'=>'stype','type'=>'select_single','default'=>$tz->get_data('stype'),'is_data'=>FALSE));?>                
					</div>
                    <span class="l"><?php echo $langco['view_search_keyword'];?></span>
                    <input type="text" value="<?php echo $tz->get_data('svalue');?>" name="svalue" class="comm_ipt l">
                    
                    &nbsp;<input type="submit" value="<?php echo $langco['btn_search']?>" id="search_btn" class="btn">
                </form>
            </li>
        </ul>
    </div>
    <p class="line-t-20"></p>
</div>

<div style="width:100%;" class="box2 box4">
	<form action="<?php echo site_url($this->PagePath);?>" id="table_list_form">
		<table class="table_lists table_click">
			<thead>
				<tr>
					<th width="40" align="center"><input type="checkbox" onclick="C.form.check_all('.chk_list');"></th>
					<th align="left"><?php echo $tz->set_sort(site_url($this->PagePath), 'oname', $langcu['form_oname']);?>/<?php echo $langcu['form_url'];?></th>
					<th width="50" align="left"><?php echo $tz->set_sort(site_url($this->PagePath), 'width', $langcu['form_width']);?></th>
					<th width="50" align="left"><?php echo $tz->set_sort(site_url($this->PagePath), 'height', $langcu['form_height']);?></th>
					<th width="80" align="left"><?php echo $tz->set_sort(site_url($this->PagePath), 'size', $langcu['form_size']);?></th>
					<th width="80" align="left"><?php echo $tz->set_sort(site_url($this->PagePath), 'type', $langcu['form_type']);?></th>
					<th width="80" align="left"><?php echo $langcu['view_exist'];?></th>
					<th align="100"><?php echo $tz->set_sort(site_url($this->PagePath), 'cdate', $langcu['form_cdate']);?></th>
					<th width="100" align="left"><?php echo $langco['view_action_title'];?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($lists as $key => $value)
				{
				?>
				<tr id="formli<?php echo $key;?>">
					<td align="center"><input type="checkbox" value="<?php echo $value['id']?>" class="chk_list"></td>
                    <td><?php echo $value['oname'];?><br><?php echo $value['url'];?></td>
					<td><?php echo $value['width'];?></td>
					<td><?php echo $value['height'];?></td>
					<td><?php echo $value['size'];?></td>
					<td><?php echo $value['type'];?></td>
                    <td><?php $_url = strstr($value['url'], 'http') ? $value['url'] : './' . $value['url'];echo file_exists('./' . $_url) ? $langcu['view_exist_1'] : $langcu['view_exist_0'];?></td>
					<td><?php echo date('Y-m-d', $value['cdate']);?></td>
                    <td>&nbsp;
					</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</form>
    <p class="line-t-20"></p>
    <div class="pagebar">
        <?php echo $pagecode;?>
    </div>
    <p class="line-t-20"></p>
</div>
<p class="line-t-20"></p>
<div class="footer_fixed">
    <div class="box_1000">
        <span><?php echo $langco['view_action_title'] . $langco['colon']?></span>
    </div>
</div>
