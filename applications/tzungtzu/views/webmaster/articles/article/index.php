<!--按模块查看-->
<div class="totals clearfix">
    <ul>
        <li class="hdli"><?php echo $langcu['view_select_model'];?></li>
        <?php foreach ($models as $k => $v){?>
        <li><a href="<?php echo base_url($this->PagePath . '/lists?mid='.$v['id']);?>"><?php echo $v['mname'] . '-' . $v['mtitle'];?></a></li>
        <?php }?>
    </ul>
</div>
<p class="line-t-10" style="clear:both;"></p>
<!--按分类查看 -->
<div class="columns-mod l">
    <div class="hd">
        <h5><?php echo $langcu['view_select_category'];?></h5>
    </div>
    <div class="bd">
        <div class="sys-info">
            <?php echo $category;?>
        </div>
    </div>
</div>
<p class="line-t-20"></p>
