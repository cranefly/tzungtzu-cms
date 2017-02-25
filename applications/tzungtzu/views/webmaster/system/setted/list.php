<!-- 查询隐藏表单-->
	<?php $_savlue = $tz->get_data('svalue');?>
	<div <?php echo empty($_savlue) ? 'style="display: none"' : ''; ?> id="query_box_category">
    <div id="screen" class="box_970">
        <ul class="screening se_manage res_scre">
            <li class="bndata_li">
                <form name="search" method="post" action="<?php echo base_url($this->PagePath);?>" id="search_form">
                    <span class="l"><?php echo $langco['view_search_select'];?></span>
                    <div class="l">
                        <?php echo $tz->tz_vars->input_str(array('node'=>'search','name'=>'stype','type'=>'select_single','default'=>$tz->get_data('stype'),'is_data'=>FALSE));?>                
					</div>
                    <span class="l"><?php echo $langco['view_search_keyword'];?></span>
                    <input type="text" value="<?php echo $_savlue;?>" name="svalue" class="comm_ipt l">
                    &nbsp;<input type="submit" value="<?php echo $langco['btn_search']?>" id="search_btn" class="btn">
                </form>
            </li>
        </ul>
    </div>
    <p class="line-t-20"></p>
</div>

<div style="width:100%;" class="box2 box4">
	<form action="<?php echo base_url($this->PagePath);?>" id="table_list_form">
		<table class="table_lists table_click">
			<thead>
				<tr>
					<th width="40" align="center"><input type="checkbox" onclick="C.form.check_all('.chk_list');"></th>
					<th width="60" align="left"><?php echo $tz->set_sort(base_url($this->PagePath), 'id', $langcu['form_id']);?></th>
					<th width="120" align="left"><?php echo $tz->set_sort(base_url($this->PagePath), 'title', $langcu['form_title']);?></th>
					<th width="120" align="left"><?php echo $tz->set_sort(base_url($this->PagePath), 'ckey', $langcu['form_ckey']);?></th>
					<th align="left"><?php echo $tz->set_sort(base_url($this->PagePath), 'cvalue', $langcu['form_cvalue']);?></th>
					<th width="60" align="left"><?php echo $tz->set_sort(base_url($this->PagePath), 'tag', $langcu['form_tag']);?></th>
					<th width="60" align="left"><?php echo $langcu['form_comment'];?></th>
					<th width="100" align="left"><?php echo $tz->set_sort(base_url($this->PagePath), 'cdate', $langcu['form_cdate']);?></th>
					<th width="100" align="left"><?php echo $langco['view_action_title'];?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($lists as $key => $value)
				{
				?>
				<tr id="formli<?php echo $key;?>">
					<td align="center"><input type="checkbox" value="<?php echo $value['id']?>" class="chk_list"></td>
					<td><a href="<?php echo base_url($this->PagePath)?>/detail?id=<?php echo $value['id'];?>"><?php echo $value['id']?></a></td>
					<td><a href="<?php echo base_url($this->PagePath)?>/detail?id=<?php echo $value['id'];?>"><?php echo $value['title']?></a></td>
					<td><?php echo $value['ckey'];?></td>
					<td><?php echo $value['cvalue'];?></td>
					<td><?php echo $value['tag'];?></td>
					<td><?php echo $value['comment'];?></td>
					<td><?php echo date('Y-m-d', $value['cdate']);?></td>
					<td>
					<?php $tz->btn('A0201',  base_url($this->PagePath . '/edit?id=' . $value['id']), $langco['btn_edit'], 'btn');?>   
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
        <?php $tz->btn('A0201', base_url($this->PagePath . '/add'), $langcu['btn_add'], 'btn3');?>  
    </div>
</div>
