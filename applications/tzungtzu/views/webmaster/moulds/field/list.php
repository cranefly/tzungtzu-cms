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
					<th width="140" align="left"><?php echo $tz->set_sort(base_url($this->PagePath),'id',$langcu['form_title'] . '(ID)');?></th>
					<th width="80" align="left"><?php echo $tz->set_sort(base_url($this->PagePath), 'field', $langcu['form_field']);?></th>
					<th width="100" align="left"><?php echo $tz->set_sort(base_url($this->PagePath), 'attribute', $langcu['form_attribute']);?></th>
					<th width="100" align="left"><?php echo $tz->set_sort(base_url($this->PagePath), 'form_type', $langcu['form_form_type']);?></th>
					<th width="60" align="left"><?php echo $tz->set_sort(base_url($this->PagePath), 'dvalue', $langcu['form_dvalue']);?></th>
					<th align="left"><?php echo $langcu['form_fdesc'];?></th>
					<th width="80" align="left"><?php echo $tz->set_sort(base_url($this->PagePath), 'field_remark', $langcu['form_field_remark']);?></th>
					<th width="60" align="left"><?php echo $langcu['form_field_tag'];?></th>
					<th width="50" align="left"><?php echo $langcu['form_antistop'];?></th>
                    <th width="60" align="right"><?php echo $langco['view_action_title'];?>&nbsp;&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($lists as $key => $value)
				{		
				?>
				<tr id="formli<?php echo $key;?>">
					<td align="center"><input type="checkbox" value="<?php echo $value['id']?>" class="chk_list"></td>
					<td><a href="<?php echo base_url($this->PagePath)?>/detail?id=<?php echo $value['id'];?>"><?php echo $value['title']?>(<?php echo $value['id']?>)</a></td>
					 <td><?php echo $value['field'];?></td>
					<td><?php echo $value['attribute'];?></td>
                    <td><?php echo $this->tz_vars->get_field_str('form_type', $value['form_type']);?></td>
					<td><?php echo $value['dvalue'];?></td>
					<td><?php echo $value['fdesc'];?></td>
					<td><?php echo $this->tz_vars->get_field_str('field_remark', $value['field_remark']);?></td>
					<td><?php echo $value['field_tag'];?></td>
					<td><?php echo $value['antistop'];?></td>
					<td  align="right">
					<?php $tz->btn('E0201',  base_url($this->PagePath . '/edit?id=' . $value['id']), $langco['btn_edit'], 'btn');?>   
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
        <?php $tz->btn('E0201', base_url($this->PagePath . '/add'), $langcu['btn_add'], 'btn3');?> 
    </div>
</div>
