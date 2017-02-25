<!-- 查询隐藏表单-->
<div style="display: none" id="query_box_category">
    <div id="screen" class="box_970">
        <ul class="screening se_manage res_scre">

        </ul>
    </div>
    <p class="line-t-20"></p>
</div>
<div style="width:100%;" class="box2 box4">
	<form action="<?php echo base_url($this->PagePath);?>" id="form_data">
	<table class="table_lists table_click">
		<thead>
			<tr>
				<th width="40"><input type="checkbox" onclick="C.form.check_all('.chk_list');"></th>
				<th  align="left">ID</td>
				<th width="60" align="left">排序</th>
				<th width="240"  align="left">分类名称</th>
				<th width="60"  align="left">导航显示</th>
				<th></th> 
				<th width="100" align="left">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($lists as $key => $value){?>
			<tr title="文档数量：6 绑定域名： 跳转地址：" id="formli1">
				<td align="center"><input type="checkbox" value="<?php echo $value['id'];?>" class="chk_list"></td>
				<td><a target="_blank" href=""><?php echo $value['id'];?></a></td>
				<td><input type="text" value="<?php echo $value['forder'];?>" style="width:30px;" class="comm_ipt corder" pid="<?php echo $value['id']?>"></td>
				<td><b><?php echo $value['cname'];?></b>
					<?php echo !empty($value['cnick']) ? '/' . $value['cnick'] : '' ;echo !empty($value['cname_py']) ? '/' . $value['cname_py'] : '' ;?>
                    <a href="?parent_id=<?php echo $value['id'];?>">查看下级</a>
				</td>
				<td><?php echo $this->tz_vars->get_field_str('nav_show', $value['nav_show']);?></td>
				<td style="color:#888;text-align:left;line-height:160%;">
					&nbsp;&nbsp;<?php echo $langcu['view_arctile'];?>：<?php echo $value['articles'];?>  
					&nbsp;&nbsp;<?php echo $langcu['view_visitor'];?>：<?php echo $value['visitors'];?><br>
				</td>
				<td>
					<?php $tz->btn('C0201',  base_url($this->PagePath . '/edit?id=' . $value['id']), $langco['btn_edit'], 'btn');?> 
                    <?php $tz->btn('C0202',  "javascript:del({$value['id']})", $langco['btn_delete'], 'btn');?> 
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
        <span><?php echo $langco['view_action_title'] . $langco['colon'] ?></span>
		<?php $tz->btn('C0201', base_url($this->PagePath . '/add'), $langcu['btn_add_category'], 'btn3'); ?>    
		<?php $tz->btn('C0203', 'javascript:update_order()', $langco['btn_order'], 'btn3'); ?>    
        <?php $tz->btn('C0202', "javascript:del_data();", $langcu['btn_deletes'], 'btn3');?> 

    </div>
</div>
