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
                    <figure class="banner bg-img bg-app bg-inverse" data-height="500" style="background-image: url(/themes/tzungtzu/web/default/images/frontend_header_bg.png)">
                        <figcaption class="banner-caption">
                            <div class="container">
                                <div class="row vcenter-md">
                                    <div class="col-md-5 col-md-push-7 text-center text-md-left">
                                        <h1 class="display-2 m-y">一个自由的PHPCMS系统-TzungTzu CMS</h1>
                                        <p class="lead m-b-md">一个菜鸟程序员的业余之作，不为别的，只为因为当初选了PHP作为糊口的职业。</p>
                                       <!-- <a class="btn btn-default btn-lg" href="pricing.php">立即订购</a> -->
                                    </div>
                                    <div class="col-md-6 col-md-pull-5 hidden-sm hidden-xs">
                                        <img class="img-responsive img-full" src="<?php echo base_url('/themes/tzungtzu/web/default/picture/ad1.png');?>" alt="" />
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
                                    <h2 class="h1 display-2 m-t">自由的CMS</h2>
                                    <p>CMS正在变得日渐喧嚣，我们似乎很难停下追逐的脚步。而我们有时候可能只是需要那一份自由，最简单的方式来诠释我们的业务。</p>
                                </div>
                            </div>
                            <!-- .row -->

                            <div class="row text-center">
                                <div class="col-md-4">
                                    <i class="ion-locked text-muted fa-4x"></i>
                                    <h4 class="m-t-0">安全可靠</h4>
                                    <p class="text-muted">使用成熟的框架系统，每一行代码都体现了安全的重要性</p>
                                </div>
                                <div class="col-md-4">
                                    <i class="ion-earth text-muted fa-4x"></i>
                                    <h4 class="m-t-0">快速部署</h4>
                                    <p class="text-muted">只需简单的几步，就能随意创建你想要的企业PC网站，手机网站，甚至是微信服务号</p>
                                </div>
                                <div class="col-md-4">
                                    <i class="ion-person-stalker text-muted fa-4x"></i>
                                    <h4 class="m-t-0">优质客户</h4>
                                    <p class="text-muted">我们的客户不多，但是每一个都是用心做好站的企业人</p>
                                </div>
                            </div>
                            <!-- .row -->
                        </div>
                        <!-- .container -->
                    </div>
                    <!-- .section -->

                    <div class="section p-y-xl bg-white">
                        <div class="container">
                            <div class="row vcenter-md m-b-md">
                                <div class="col-md-4 col-md-offset-1 text-center text-md-left">
                                    <h4 class="h4 display-2 m-b">天下武功，唯快不破</h4>
                                    <p class="m-b-lg">我们使用免费开源的轻量级CI框架作为基础，配合优秀的程序架构设计，真正实现网站的快速响应。更有新功能的快速开发，真正节省开发流程和开发成本。</p>
                                </div>
                                <!-- .col-md-4 -->
                                <div class="col-md-4 col-md-offset-2">
                                    <img class="img-responsive" src="<?php echo base_url('/themes/tzungtzu/web/default/picture/frontend_home2.png');?>" alt="" />
                                </div>
                                <!-- .col-md-4 -->
                            </div>
                            <!-- .row -->
                        </div>
                        <!-- .container -->
                    </div>
                    <!-- .section -->

                    <div class="section p-y-xl bg-white">
                        <div class="container">
                            <div class="row vcenter-md m-b-md">
                                <div class="col-md-4 col-md-push-7 text-center text-md-left">
                                    <h4 class="h4 display-2 m-b">功能齐全，实现一站式管理</h4>
                                    <p class="m-b-lg">系统自动识别PC端用户和手机端用户，更有微信公众号管理模块，让你一站式发布信息，让你轻松搞定各个平台的信息发布</p>
                                </div>
                                <!-- .col-md-4 -->
                                <div class="col-md-4 col-md-pull-3">
                                    <img class="img-responsive" src="<?php echo base_url('/themes/tzungtzu/web/default/picture/frontend_home3.png');?>" alt="" />
                                </div>
                                <!-- .col-md-4 -->
                            </div>
                            <!-- .row -->
                        </div>
                        <!-- .container -->
                    </div>
                    <!-- .section -->

                    <div class="section p-y-xl bg-white">
                        <div class="container">
                            <div class="row vcenter-md m-b-md">
                                <div class="col-md-4 col-md-offset-1 text-center text-md-left">
                                    <h4 class="h4 display-2 m-b">简单自由，解放天性的操作</h4>
                                    <p class="m-b-lg">我们没有太多的限制，只为那一份自由的原始天性</p>
                                </div>
                                <!-- .col-md-4 -->
                                <div class="col-md-4 col-md-offset-2">
                                    <img class="img-responsive" src="<?php echo base_url('/themes/tzungtzu/web/default/picture/frontend_home4.png');?>" alt="" />
                                </div>
                                <!-- .col-md-4 -->
                            </div>
                            <!-- .row -->
                        </div>
                        <!-- .container -->
                    </div>
                    <!-- .section -->

                    <!-- <div class="section p-y-xl bg-white hidden-sm hidden-xs">
                        <div class="container">
                            <div class="row m-b-md">
                                <div class="col-md-4 col-md-offset-1">
                                    <div class="img-box">
                                        <div class="img-avatar"><i class="ion-load-a text-muted fa-4x"></i> </div>
                                        <div class="img-text">
                                            <h2 class="h1 m-t-0">流量套餐</h2>
                                            <p class="m-b">适用于不是经常使用的用户，所有流量套餐均为一年有效期，用多少算多少！更经济、更实惠！</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-md-offset-2">
                                    <div class="img-box">
                                        <div class="img-avatar"><i class="ion-load-b text-muted fa-4x"></i> </div>
                                        <div class="img-text">
                                            <h2 class="h1 m-t-0">包月套餐</h2>
                                            <p class="m-b">适用于网虫，不同等级每月有不同的流量额度，让您浏览高清图片，播放高清视频不再有后顾之忧！</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- .section -->

                    <div class="section p-y-xl bg-app bg-inverse">
                        <div class="container text-center">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <h2 class="h1 display-2">未来可以有更多期待</h2>
                                    <p class="lead">我们行走前进的道路上，也许前进的不快，但是我们信守只不断前进！</p>
                                </div>
                                <div>
                                    <img style="width:120px;" src="<?php echo $tz->get_css('web/default/images/494589054.png');?>" alt="494589054"/>
                                </div>
                            </div>
                        </div>
                        <!-- .container -->
                    </div>
                    <!-- .section -->

                    <!-- Footer -->
                    <?php echo $tz->get_template('web/default/common/inc.footer.php');?>
                    <!-- End Footer -->
                </main>
                <!-- .app-layout-content -->

            </div>
            <!-- .app-layout-container -->
        </div>
        <!-- .app-layout-canvas -->

        <!-- AppUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock, Placeholder and App.js -->
        <script src="<?php echo $tz->get_css('web/default/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo $tz->get_css('web/default/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo $tz->get_css('web/default/js/jquery.slimscroll.min.js'); ?>"></script>
        <script src="<?php echo $tz->get_css('web/default/js/jquery.scrolllock.min.js'); ?>"></script>
        <script src="<?php echo $tz->get_css('web/default/js/jquery.placeholder.min.js'); ?>"></script>
        <script src="<?php echo $tz->get_css('web/default/js/app.js'); ?>"></script>
    </body>
</html>