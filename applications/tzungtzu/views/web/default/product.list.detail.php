<!DOCTYPE html>
<html class="app-ui">
    <head>
        <?php echo $tz->get_template('web/default/common/inc.nav.php');?>
    </head>
    <body class="app-ui">
        <div class="app-layout-canvas">
            <div class="app-layout-container">
                <main class="app-layout-content">
                    <!-- Site Header -->
                    <div class="site-header bg-white">
                        <!-- Navbar -->
                        <div class="navbar" role="navigation">
                            <?php echo $tz->get_template('web/default/common/inc.header.php');?>
                        </div>
                        <!-- End Navbar -->
                    </div>
                    <!-- End Site Header -->
                    <style>
                    .navbar-nav > li > a.btn{
                    line-height: 20px;
                    margin-top: 30px;
                    padding: 5px 15px;
                    }
                    </style>                    
                    <!-- Page header -->
                    <figure class="banner bg-img bg-app bg-inverse" data-height="500" style="background-image: url(/themes/tzwechat/web/default/images/frontend_header_bg.png)">
                        <figcaption class="banner-caption">
                            <div class="container">
                                <div class="row vcenter-md">
                                    <div class="col-md-5 col-md-push-7 text-center text-md-left">
                                        <h1 class="display-2 m-y">轻量级CMS系统-TzungTzu CMS</h1>
                                        <p class="lead m-b-md">CMS的良心之作，轻量级，高性能，高安全，易扩展，高稳定性的符合管理体验的CMS。
这次我们重新定义CMS系统</p>
                                        <a class="btn btn-default btn-lg" href="pricing.php">立即下载</a>
                                    </div>
                                    <div class="col-md-6 col-md-pull-5 hidden-sm hidden-xs">
                                        <img class="img-responsive img-full" src="<?php echo base_url('/themes/tzwechat/web/default/picture/ad2.png');?>" alt="" />
                                    </div>
                                </div>
                                <!-- .row -->
                            </div>
                            <!-- .container -->
                        </figcaption>
                    </figure>
                    <!-- End page header -->

                    <div class="section bg-white">
                        <div class="container p-y-xl b-b">
                            <div class="row m-b-md">
                                <div class="col-md-6 col-md-offset-3 text-center">
                                    <h2 class="h1 display-2 m-t">TzungTzu CMS V1.0.0</h2>
                                    <p>精心实现每一行代码，真正做到优雅的代码创建出来的优雅的CMS</p>
                                </div>
                            </div>
                        </div>
                        <!-- .container -->
                    </div>
                    <!-- Footer -->
                    <?php $tz->get_template('web/default/common/inc.footer.php');?>
                    <!-- End Footer -->

                </main>
                <!-- .app-layout-content -->

            </div>
            <!-- .app-layout-container -->
        </div>
        <!-- .app-layout-canvas -->

        <!-- AppUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock, Placeholder and App.js -->
        <script src="<?php echo CSS_HOST . '/style' . '/web/' . $tz->web_dir . '/' ?>js/jquery.min.js"></script>
        <script src="<?php echo CSS_HOST . '/style' . '/web/' . $tz->web_dir . '/' ?>js/bootstrap.min.js"></script>
        <script src="<?php echo CSS_HOST . '/style' . '/web/' . $tz->web_dir . '/' ?>js/jquery.slimscroll.min.js"></script>
        <script src="<?php echo CSS_HOST . '/style' . '/web/' . $tz->web_dir . '/' ?>js/jquery.scrolllock.min.js"></script>
        <script src="<?php echo CSS_HOST . '/style' . '/web/' . $tz->web_dir . '/' ?>js/jquery.placeholder.min.js"></script>
        <script src="<?php echo CSS_HOST . '/style' . '/web/' . $tz->web_dir . '/' ?>js/app.js"></script>
    </body>
</html>