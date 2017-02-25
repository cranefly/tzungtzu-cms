                            <div class="container">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="menu-container">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse"><i class="ion-navicon"></i></button>
                                    <!-- Navbar Brand -->
                                    <div class="navbar-brand">
                                        <a href="<?php echo base_url();?>" title="<?php echo $tz->get_config('site_name') ?>">
                                            <img class="default-logo" src="<?php echo $tz->get_css('web/default/logo-tzungtzu.png'); ?>" alt="<?php echo $tz->get_config('site_name') ?>" title="<?php echo $tz->get_config('site_name') ?>"/>
                                        </a>
                                    </div>
                                    <!-- End Navbar Brand -->

                                    <!-- End Header Inner Right -->
                                </div>
                                <!-- End Menu Container -->

                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse navbar-responsive-collapse">
                                    <div class="menu-container">
                                        <ul class="nav navbar-nav navbar-right">
                                            <!-- Home -->
                                            <li class="dropdown active">
                                                <a href="<?php echo base_url();?>" class="dropdown-toggle">首页</a>
                                            </li>
                                            <!-- End Home -->
                                            <?php $categories = $tz->get_category();?>
                                            <?php 
                                                foreach($categories as $cate){
                                                    if ($cate['nav_show'] != 1){continue;}
                                            ?>
											<li class=""><a href="<?php echo $cate['surl'];?>" <?php if($cate['id'] == 10){echo 'class="btn btn-sm btn-app-green-outline"';}?>><?php echo $cate['cname'];?></a></li>
                                            <?php }?>
                                            <!-- End Pages -->
                                        </ul>
                                    </div>
                                </div>
                                <!-- .navbar-collapse-->
                            </div>