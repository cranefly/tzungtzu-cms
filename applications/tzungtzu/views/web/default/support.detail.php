<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $tz->seo['title'] . '-' . $tz->get_config('site_name'); ?></title>
		<!-- Bootstrap -->
		<link href="<?php echo CSS_HOST . '/style' . '/web/' . $tz->web_dir . '/' ?>css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo CSS_HOST . '/style' . '/web/' . $tz->web_dir . '/' ?>css/font-awesome.min.css" rel="stylesheet">
		<!-- Styling -->
		<link href="<?php echo CSS_HOST . '/style' . '/web/' . $tz->web_dir . '/' ?>css/overrides.css" rel="stylesheet">
		<link href="<?php echo CSS_HOST . '/style' . '/web/' . $tz->web_dir . '/' ?>css/styles.css" rel="stylesheet">
		<!-- Flathost Styling -->
		<link rel="stylesheet" href="<?php echo CSS_HOST . '/style' . '/web/' . $tz->web_dir . '/' ?>css/flathost.css">
		<link rel="stylesheet" href="<?php echo CSS_HOST . '/style' . '/web/' . $tz->web_dir . '/' ?>css/cart_style.css">
	</head>
	<body>
		<section id="main-menu">

			<nav id="nav" class="navbar navbar-inverse navbar-main" role="navigation">
				<div class="container">
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li menuItemName="首页" id="Primary_Navbar-0">
								<a href="<?php echo base_url(); ?>">首页</a>
							</li>
							<?php $categories = $tz->get_category(); ?>
							<?php
							foreach ($categories as $cate)
							{
								if ($cate['nav_show'] != 1)
								{
									continue;
								}
								?>
								<li menuItemName="<?php echo $cate['cname']; ?>" id="Primary_Navbar-<?php echo $cate['id']; ?>">
									<a href="<?php echo $cate['surl']; ?>"><?php echo $cate['cname']; ?></a>
								</li>
							<?php } ?>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div>
			</nav>
		</section>
		<section class="container" id="main-body">
			<div class="row">
                <!-- Container for main page display content -->
				<div class="col-xs-12 main-content">
					<div class="container-fluid p-y-md">
						<div class="card card-block">
							<div class="portlet">
								<div id="order-standard_cart">

									<div class="row">

										<div class="pull-md-right col-md-9">

											<div class="header-lined">
												<h1>
													<?php echo $data['title']; ?>
												</h1>
											</div>
										</div>

										<div class="col-md-3 pull-md-left sidebar hidden-xs hidden-sm">
											<div class="panel panel-default" menuitemname="Categories">
												<div class="panel-heading">
													<h3 class="panel-title">
														<i class="fa fa-shopping-cart"></i>&nbsp;分类
													</h3>
												</div>
												<?php $support = $tz->get_category(10); ?>
												<div class="list-group">
													<?php
													foreach ($support['son'] as $val)
													{
														?>
														<a class="list-group-item <?php echo $val['id'] == $cid ? 'active' : ''; ?>" href="<?php echo $tz->get_url($val['id'], NULL, 1); ?>" title="<?php echo $val['cname']; ?>"><?php echo $val['cname']; ?></a>
													<?php } ?>
                                                </div>
											</div>

											<div class="panel panel-default" menuitemname="Actions">
												<div class="panel-heading">
													<h3 class="panel-title">
														<i class="fa fa-plus"></i>&nbsp;相关类别</h3>
												</div>
												<div class="list-group">
													<?php
													foreach ($categories as $cate)
													{
														if ($cate['nav_show'] != 1)
														{
															continue;
														}
														$_class = $_active = '';
														if ($cid == $cate['id'])
														{
															$_active = 'active';
														}
														if ($cate['id'] == 6)
														{
															$_class = 'fa-ticket';
														}
														if ($cate['id'] == 7)
														{
															$_class = 'fa-list';
														}
														if ($cate['id'] == 8)
														{
															$_class = 'fa-info-circle';
														}
														if ($cate['id'] == 9)
														{
															$_class = 'fa-download';
														}
														if ($cate['id'] == 10)
														{
															$_class = 'fa-rocket';
														}
														if ($cate['id'] == 11)
														{
															$_class = 'fa-comments';
														}
														?>
														<a menuItemName="Support Tickets" href="<?php echo $cate['surl']; ?>" class="list-group-item <?php echo $_active; ?>">
															<i class="fa <?php echo $_class; ?> fa-fw"></i>&nbsp;<?php echo $cate['cname']; ?>
														</a>
													<?php } ?>
                                                </div>

											</div>
										</div>

										<div class="col-md-9 pull-md-right"><div id="products" class="products">
												<form onsubmit="catchEnter(event);" id="frmConfigureProduct">
													<input type="hidden" value="true" name="configure">
													<input type="hidden" value="1" name="i">

													<div class="row">
														<div class="col-md-8">

															<p>购买说明</p>

															<div class="product-info">
																<p class="product-title"><br><?php echo $data['description'];?><br></p>
																<p><br>服务方式：<?php echo $data['server_type'];?><br><br>
																	用途场景：<?php echo $data['use_demo'];?></p>
															</div>
															<div class="sub-heading">
																<span>附加信息</span>
															</div>

															<div class="field-container">
																<div class="form-group">
																	<label for="customfield1"></label>
																	<span>
																		<?php echo $data['buy_tip'];?>
																	</span>
																</div>
                                                            </div>
															<div class="alert alert-warning info-text-sm">
																<i class="fa fa-question-circle"></i>
																有什么疑问吗？您可以联系我们的客服人员。 <a class="alert-link" target="_blank" href="contact.php">Click here</a>
															</div>

														</div>
														<div id="scrollingPanelContainer" class="col-md-4">

															<div id="orderSummary" style="margin-top: 0px;">
																<div class="order-summary">
																	<div id="orderSummaryLoader" class="loader" style="display: none;">
																		<i class="fa fa-fw fa-refresh fa-spin"></i>
																	</div>
																	<h2>订单详情</h2>
																	<div id="producttotal" class="summary-container"><span class="product-name"><?php echo $data['title']?></span>
																		<span class="product-group"><?php echo $data['server_type']?></span>

<!--																		<div class="clearfix">
																			<span class="pull-left">10元流量包</span>
																			<span class="pull-right">￥10.00RMB</span>
																		</div>-->
																		<div class="summary-totals">
<!--																			<div class="clearfix">
																				<span class="pull-left">初装费:</span>
																				<span class="pull-right" style="">￥0.00RMB</span>
																			</div>-->
																			<div class="clearfix">
																				<span class="pull-left">价格:</span>
																				<span class="pull-right">￥<?php echo $data['price']?>&nbsp;&nbsp;<?php echo $data['pay_unit']?></span>
																			</div>
																		</div>

																		<div class="total-due-today">
																			<span class="amt">￥<?php echo $data['price']?></span>
<!--																			<span>当前总计</span>-->
																		</div>
																	</div>
																</div>
																<div class="text-center">
																	<button onclick="addtocart()" class="btn btn-primary btn-lg" id="btnCompleteProductConfig" type="button">
																		支付
																		<i class="fa fa-arrow-circle-right"></i>
																	</button>
																</div>
															</div>

														</div>

													</div>

												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>




				</div><!-- /.main-content -->
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


