<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $controller_title;?>-<?php echo TZ_SYS_NAME;?></title>
<meta content="" name="keywords" />
<meta content="" name="description"/>
<link rel="stylesheet" type="text/css" href="<?php echo $tz->get_css('webmaster/css/admin.css'); ?>">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<?php echo $css;?>

</head>
<body>
<!-- 加载头部 -->
<div class="header_wrap"><!-- 头部 -->
    <div class="header">
        <div class="hd_logo l"><a href="index.php"><img src="<?php echo $tz->get_css('webmaster/image/logo.png'); ?>" /></a></div>
        <div class="user_hd r">
			<div class="user_img r">
                <a href="#"><img src="<?php echo empty($this->tz_user->UAvatar) ? $tz->get_css('webmaster/image/default.png') . '' : $this->tz_user->UAvatar; ?>" /></a>
			</div>
			<ul class="l">
            <li><a href="<?php echo base_url('webmaster/articles/article');?>">添加文档</a></li>
            <li><a href="<?php echo base_url('webmaster/articles/category');?>">分类管理</a></li>
			<li><a href="<?php echo base_url();?>" target="_blank">前台首页</a></li>
            <li><a href="<?php echo base_url('login/logout');?>" title="点击退出系统">退出</a></li>
            <li><span><?php echo $this->tz_user->UNick;?>(<a href="<?php echo base_url('webmaster/accounts/users/edit?id=' . $tz->tz_user->UId);?>" title=""><?php echo $this->tz_user->GroupName;?></a>)</span></li>
			</ul>
			<div class="motto"><span class="r"><?php echo $this->tz_user->Motto;?></span></div>
        </div>
        <ul class="hd_tabs" id="hd_tabs">
			<?php foreach($items['items'] as $item){?>
            <?php if (!$tz->tz_user->check_authority($item['level'])){continue;}?>
			<li><a href="<?php echo $item['url'];?>" <?php if($tz->menu_id == $item['level']){echo 'class="current"';}?> title="<?php echo $item['title'];?>"><?php echo $item['title'];?></a></li>
			<?php }?>
		</ul>
    </div>
</div>
<!-- 主体内容 -->
<div class="content">
    <ul class="manage_btn">
		<?php foreach($items['nav_items'] as $nav_item){?>
        <?php if (!$tz->tz_user->check_authority($nav_item['level'])){continue;}?>
		<li><a href="<?php echo $nav_item['url'];?>" <?php if($tz->nav_item == $nav_item['level']){echo 'class="current"';}?> title="<?php echo $nav_item['title'];?>"><?php echo $nav_item['title'];?></a></li>
		<?php }?>
    </ul>
    <p class="line-t-6"></p>
    <div class="crumbs">
		<span class="cbs_left">
			<?php 
			$count = count($items['min_nav']);
			foreach($items['min_nav'] as $key => $min_nav){$key++;?>
				<b><a href="<?php echo $min_nav['url']?>" title="<?php echo $min_nav['title']?>"><?php echo $min_nav['title']?></a></b>
				<?php if($count > $key){echo '<em>></em>';}?>
			<?php }?>
		</span>
		<?php if($is_search){?>
		<span class="cbs_right"><a onclick="show_more('query_box_category');" href="javascript:void(0);"><?php echo $langweb['search_title']?></a></span>
		<?php }?>
	</div>
	<p class="line-t-15"></p>
	<!-- main content start -->
	<?php echo $main_content;?>
	<!-- main content end -->
    <!-- 加载底部 -->
    <p class="footer_cpy">
        &COPY; &nbsp;&nbsp;<?php echo SYS_NAME;?> &nbsp;&nbsp;<?php echo date('Y');?> &nbsp;&nbsp;<?=@count($this->db->queries); ?> queries, Processed in  {elapsed_time} second(s), {memory_usage} memory
    </p>
    <p class="line-t-20"></p>
</div>

<div class="to-top" style="display:none;">
    <a class="to-top-a" title="返回顶部"></a>
</div>
</body>
<script type="text/javascript" src="<?php echo $tz->get_css('libs/jquery-1.7.1.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo $tz->get_css('webmaster/js/public.js'); ?>"></script>
<script type="text/javascript" src="<?php echo $tz->get_css('libs/layui/layui.js'); ?>"></script>
<script type="text/javascript">
	$(function(){
		layui.use(['layer']);
	});

</script>
<?php echo $js;?>

</html>