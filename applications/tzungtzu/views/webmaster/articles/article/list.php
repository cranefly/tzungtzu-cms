<!-- 查询隐藏表单-->
<div style="display: none" id="query_box_category">
    <div id="screen" class="box_970">
        <ul class="screening se_manage res_scre">
            <li class="bndata_li">
                <form name="search" method="post" action="<?php echo base_url($this->PagePath);?>" id="search_form">
                   
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
					<th width="50" align="left"><?php echo $tz->set_sort(base_url($this->PagePath.'/lists?mid=' . $mid),'id', 'ID');?></th>
					<?php
					foreach($fields as $field){
                        if ($field['display'] == 1){
					?>
					<th align="left"><?php echo $field['title'];?></th>
                    <?php } }?>
					<th width="140" align="left"><?php echo $langco['view_action_title'];?></th>
				</tr>
			</thead>
			<tbody>
				<?php 
				foreach ($lists as $key => $value)
				{
				?>
				<tr id="formli<?php echo $key;?>">
					<td align="center"><input type="checkbox" value="<?php echo $value['id']?>" class="chk_list"></td>
					<td><a href="<?php echo base_url($this->PagePath)?>/detail?id=<?php echo $value['id'];?>"><?php echo $value['id']?></a></td>
					<?php
					foreach($fields as $field){
                        if ($field['display'] == 1){
					?>
                    <?php if ($field['form_type'] != 'upload'){?>
                    <td align="left"><?php echo isset($value[$field['field']]) ? mb_substr(strip_tags($value[$field['field']]),0, 60) : '';?></td>
                    <?php }else{?>
                    <td align="left"><?php echo isset($value[$field['field']]) && !empty($value[$field['field']]) ? '<img src="' . $value[$field['field']] . '" style="width:40px;height40px;overflow:hidden" />': '';?></td>
                    <?php } } }?>
					<td>
					<?php $tz->btn('C0101',  base_url($this->PagePath . '/edit?id=' . $value['id'] . '&mid='.$mid), $langco['btn_edit'], 'btn');?>   
					<?php $tz->btn('C0103', "javascript:status({$value['status']},{$value['id']});", $this->tz_vars->get_field_str("article_status_action",$value['status']), 'btn');?> 
                    <?php $tz->btn('C0102',  "javascript:del_article({$value['id']},{$mid})", $langco['btn_delete']);?> 
						
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
        <?php if ($mid > 0){ $tz->btn('C101',base_url($this->PagePath . '/add_model?mid=' . $mid).'&cid=' . $cid, $langco['btn_add'], 'btn3');}?> 
		<?php $tz->btn('C0103', "javascript:update_status(1);", $langcu['btn_enable_list'], 'btn3');?>   
		<?php $tz->btn('C0103', "javascript:update_status(0);", $langcu['btn_disable_list'], 'btn3');?>   
        <?php $tz->btn('C0102', "javascript:del_articles({$mid});", $langcu['btn_deletes'], 'btn3');?> 
    </div>
</div>
