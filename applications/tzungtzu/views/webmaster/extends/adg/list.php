<!-- 查询隐藏表单-->
<form name="search" method="post" action="<?php echo base_url($this->PagePath);?>" id="search_form">
<div style="display: none;" id="query_box_category">
    <div id="screen" class="box_970">
        <ul class="screening se_manage res_scre">
            <li class="bndata_li">
                    <span class="l"><?php echo $langcu['form_title'];?></span>
					<input type="hidden" name="stype" value="g_name" >
                    <input type="text" value="<?php echo $tz->get_data('svalue');?>" name="svalue" class="comm_ipt l">
                    &nbsp;<input type="submit" value="<?php echo $langco['btn_search']?>" id="search_btn" class="btn">
            </li>
        </ul>
    </div>
    <p class="line-t-20"></p>
</div>
</form>

<div style="width:100%;" class="box2 box4">
    <table class="table_lists table_click">
        <thead>
            <tr>
                <th width="40" align="center"><input type="checkbox" onclick="C.form.check_all('.chk_list');"></th>
                <th width="80" align="left"><?php echo $tz->set_sort(base_url($this->PagePath),'id', 'ID');?></th>
                <th width="120" align="left"><?php echo $tz->set_sort(base_url($this->PagePath), 'title', $langcu['form_title']);?></th>
                <th align="left"><?php echo $langcu['form_remark'];?></th>
                <th width="80"  align="left"><?php echo $tz->set_sort(base_url($this->PagePath), 'identification', $langcu['form_identification']);?></th>
                <th width="170" align="left"><?php echo $langco['view_action_title'];?></th>
            </tr>
        </thead>
        <tbody>
			<?php foreach ($lists as $key => $value)
			{
			?>
            <tr id="formli<?php echo $value['id'];?>" data='{"id":"<?php echo $value['id'] ?>","title":"<?php echo $value['title'] ?>","remark":"<?php echo $value['remark'] ?>","identification":"<?php echo $value['identification'] ?>"}'>
                <td align="center"><input type="checkbox" value="<?php echo $value['id']?>" class="chk_list"></td>
                <td><?php echo $value['id'];?></td>
                <td><?php echo $value['title'];?></td>
                <td><?php echo $value['remark'];?></td>
                <td><?php echo $value['identification'];?></td>
                <td>
                    <?php $tz->btn('E0301', "javascript:void(0);", $langco['btn_edit'], 'btn quickBtn', "key={$value['id']}");?> 
                    <?php $tz->btn('E0302', "javascript:del_one({$value['id']});", $langcu['btn_delete'], 'btn');?>  
                </td>
            </tr>
			<?php }?>
        </tbody>
		</table>
		<form  method="post" action="<?php echo base_url($this->PagePath);?>" id="form_data">
		<table class="table_lists">
		<tbody  id="form_add">
			<tr>
				<td><input type="hidden" name="id" id="id" value="0"></td>
				<td><input type="text" name="data[title]" class="comm_ipt " style="width:80px;" placeholder="<?php echo $langcu['form_title']?>" value=""></td>
				<td><input type="text" name="data[remark]"  placeholder="<?php echo $langcu['form_remark'];?>" class="comm_ipt" value=""></td>
				<td><input type="text" name="data[identification]"  placeholder="<?php echo $langcu['form_identification'];?>" class="comm_ipt" value=""></td>
				<td clss="saveBtn">
					<?php $tz->btn('E0301', 'javascript:save_data();', $langco['btn_add'],'btn');?>         
				</td>
			</tr>
		</tbody>
		</table>
		</form>
    </table>
	<div class="template">
		<table>
			<tr>
				<td><input type="hidden" id="id" name="id" value="{id}"></td>
				<td><input type="text" name="data[title]" class="comm_ipt" style="width:80px;" value="{title}"></td>
				<td><input type="text" name="data[remark]" class="comm_ipt" value="{remark}"></td>
				<td><input type="text" name="data[identification]" class="comm_ipt" value="{identification}"></td>
				<td clss="saveBtn">
					<?php $tz->btn('E0301', 'javascript:save_data();', $langcu['btn_save'],'btn');?>         
				</td>
			</tr>
		</table>
	</div>
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
        <?php $tz->btn('E01', base_url($this->PagePath), $langco['btn_list'], 'btn3');?>  
		<?php $tz->btn('E0302', "javascript:del_data();", $langco['btn_deletes'], 'btn3');?> 
    </div>
</div>
