<!-- 查询隐藏表单-->
<div style="display: none" id="query_box_category">
    <div id="screen" class="box_970">
        <ul class="screening se_manage res_scre">
            <li class="bndata_li">
                <form name="search" method="post" action="<?php echo base_url($this->PagePath);?>" id="search_form">
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
	<form action="<?php echo base_url($this->PagePath);?>" id="form_data">
		<table class="table_lists table_click">
			<thead>
				<tr>
					<th width="40" align="center"><input type="checkbox" onclick="C.form.check_all('.chk_list');"></th>
					<th width="140" align="left"><?php echo $tz->set_sort(base_url($this->PagePath), 'id', $langcu['form_keyword']);?></th>
					<th width="140" align="left"><?php echo $tz->set_sort(base_url($this->PagePath), 'type', $langcu['form_type']);?></th>
					<th width="140" align="left"><?php echo  $langcu['form_reply'];?></th>
					<th width="120" align="left"><?php echo $tz->set_sort(base_url($this->PagePath), 'cdate', $langcu['form_cdate']);?></th>
					<th width="120" align="left"><?php echo $tz->set_sort(base_url($this->PagePath), 'total', $langcu['form_total']);?></th>
					<th width="100" align="left"><?php echo $langco['view_action_title'];?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($lists as $key => $value)
				{
				?>
				<tr id="formli<?php echo $key;?>">
					<td align="center"><input type="checkbox" value="<?php echo $value['id']?>" class="chk_list"></td>
					<td><?php echo $value['keyword']?></td>
					<td><?php echo $this->tz_vars->get_field_str('types', $value['type']);?></td>
					<td><?php echo $value['reply'];?></td>
					<td><?php echo date('Y-m-d H:i', $value['cdate']);?></td>
					<td><?php echo $value['total'];?></td>
					<td>
					<?php $tz->btn('E0401',  base_url($this->PagePath . '/edit?id=' . $value['id']), $langco['btn_edit'], 'btn');?>
                    <?php $tz->btn('E0402',  "javascript:del_one({$value['id']})", $langco['btn_delete'], 'btn');?> 
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
        <?php $tz->btn('E0401', base_url($this->PagePath . '/add'), $langcu['btn_add'], 'btn3');?>  
        <?php $tz->btn('E0402', "javascript:del_data();", $langco['btn_deletes'], 'btn3');?> 
    </div>
</div>
