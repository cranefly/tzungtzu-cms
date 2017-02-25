<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $tz->seo['title'] . '-' . $tz->get_config('site_name');?></title>
		<!-- Bootstrap -->
		<link href="<?php echo CSS_HOST . '/style' . '/web/' . $tz->web_dir . '/' ?>css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo CSS_HOST . '/style' . '/web/' . $tz->web_dir . '/' ?>css/font-awesome.min.css" rel="stylesheet">
		<!-- Styling -->
		<link href="<?php echo CSS_HOST . '/style' . '/web/' . $tz->web_dir . '/' ?>css/overrides.css" rel="stylesheet">
		<link href="<?php echo CSS_HOST . '/style' . '/web/' . $tz->web_dir . '/' ?>css/styles.css" rel="stylesheet">
		<!-- Flathost Styling -->
		<link rel="stylesheet" href="<?php echo CSS_HOST . '/style' . '/web/' . $tz->web_dir . '/' ?>css/flathost.css">
	</head>
	<body>
		<section id="main-menu">

			<nav id="nav" class="navbar navbar-inverse navbar-main" role="navigation">
				<div class="container">
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

						<ul class="nav navbar-nav">

							<li menuItemName="首页" id="Primary_Navbar-0">
								 <a href="<?php echo base_url();?>">首页</a>
							</li>
							<?php $categories = $tz->get_category();?>
							<?php 
								foreach($categories as $cate){
									if ($cate['nav_show'] != 1){continue;}
							?>
							<li menuItemName="<?php echo $cate['cname'];?>" id="Primary_Navbar-<?php echo $cate['id'];?>">
								<a href="<?php echo $cate['surl'];?>"><?php echo $cate['cname'];?></a>
							</li>
							<?php }?>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div>
			</nav>

		</section>

		<section id="main-body" class="container">
			<div class="row">
				<div class="col-md-9 pull-md-right">
                    <div class="header-lined">
						<h1><?php echo $data['title'];?></h1>
						<ol class="breadcrumb">
							<li>
								<a href="<?php echo base_url();?>">首页</a>        
							</li>
							<li>
								<a href="<?php echo $tz->get_url($category['id'], NULL, 1);?>" title="<?php echo $category['cname'];?>"><?php echo $category['cname'];?></a>
							</li>
							<li class="active">
								<?php echo $data['title'];?>
							</li>
						</ol>
					</div>

                </div>
				<div class="col-md-3 pull-md-left sidebar">
                    <div menuItemName="Announcements Months" class="panel panel-default hidden-sm hidden-xs">
						<div class="panel-heading">
							<h3 class="panel-title">
								<i class="fa fa-calendar"></i>&nbsp;按月
                            </h3>
						</div>
						<div class="list-group">
							<a menuItemName="<?php echo date('Y年m月');?>" href="announcements.php?view=2016-07" class="list-group-item">
								<?php echo date('Y年m月');?>
							</a>
							<a menuItemName="<?php echo date('Y年m月');?>" href="announcements.php?view=2016-06" class="list-group-item">
								<?php echo date('Y年m月', strtotime('-1 month'));?>
							</a>
							<a menuItemName="<?php echo date('Y年m月');?>" href="announcements.php?view=2016-05" class="list-group-item">
								<?php echo date('Y年m月', strtotime('-2 month'));?>
							</a>
							<a menuItemName="Older" href="announcements.php?view=older" class="list-group-item">
								更久的<?php echo $category['cname'];?>...
							</a>
						</div>
                    </div>
				</div>
                <!-- Container for main page display content -->
				<div class="col-md-9 pull-md-right main-content">
					<?php echo $data['content'];?>
				</div><!-- /.main-content -->
				
				<div class="col-md-3 pull-md-left sidebar">
                    <div menuItemName="Support" class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">
								<i class="fa fa-support"></i>&nbsp;相关类别
                            </h3>
						</div>
						<div class="list-group">
							<?php 
								foreach($categories as $cate){
									if ($cate['nav_show'] != 1){continue;}
									$_class = $_active = '';
									if ($cid == $cate['id']){$_active = 'active';}
									if ($cate['id'] == 6){$_class = 'fa-ticket';}
									if ($cate['id'] == 7){$_class = 'fa-list';}
									if ($cate['id'] == 8){$_class = 'fa-info-circle';}
									if ($cate['id'] == 9){$_class = 'fa-download';}
									if ($cate['id'] == 10){$_class = 'fa-rocket';}
									if ($cate['id'] == 11){$_class = 'fa-comments';}
							?>
							<a menuItemName="Support Tickets" href="<?php echo $cate['surl'];?>" class="list-group-item <?php echo $_active;?>">
								<i class="fa <?php echo $_class;?> fa-fw"></i>&nbsp;<?php echo $cate['cname'];?>
							</a>
							<?php }?>
						</div>
                    </div>

				</div>
            </div>
			<div class="clearfix"></div>
		</section>


		<!--===== Flathost  Footer =====-->

		<div class="footer">
			<div class="container">
				<div class="row copyright">
					<div class="pull-right hidden-xs"><img src="" alt="logo"></div>
					<p>版权所有 &copy; 2016 JiasuCloud. 保留所有权利.  </p>
				</div>
			</div>
		</div>
	</body>
</html>


