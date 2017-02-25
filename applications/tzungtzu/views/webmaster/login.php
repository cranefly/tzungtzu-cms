<!DOCTYPE html>
<html class="login_bg">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $langcu['view_title'];?>-<?php echo TZ_SYS_NAME;?>-<?php echo $langcu['view_nav']?></title>
<meta content="" name="keywords">
<meta content="" name="description">

<link href="/static/logo/logo_ico.ico" type="image/x-icon" rel="shortcut icon"/>
<link rel="stylesheet" type="text/css" href="<?php echo $tz->get_css('webmaster/css/admin.css'); ?>">
<!--插件JS和样式-->
<script src="<?php echo $tz->get_css('lib/jquery-1.7.1.min.js'); ?>"></script>
<script src="<?php echo $tz->get_css('webmaster/js/login.js'); ?>"></script>

</head>
<body class="login_bg">
    <div class="login_wrap">
        <div class="login_box">
            <div class="login_logo"><img src="<?php echo $tz->get_css('webmaster/image/logo.png'); ?>" /></div>
            <div class="login_form" id="login_form">
				<form action="<?php echo base_url($this->PagePath . '/do_login');?>" method="post" id="form_obj" >
                <table class="lg_table">
                    <tr>
                        <td><input id="uname" name="uname" type="text" class="user_name" value="" required="required"/></td>
                    </tr>
                    <tr>
                        <td><input id="upass" name="upass"  type="password" class="user_pwd" required="required" value=""/></td>
                    </tr>
                    <tr>
                        <td><input id="remember" name="remember"  type="checkbox" class="user_remember" value="1"  checked="checked"/><label for="remember"><?php echo $langcu['view_remember']?></label></td>
                    </tr>
                </table>
                <p class="line-t-6"></p>
                <a href="javascript:void(0);" id="btnSave" class="login_btn"><?php echo $langcu['btn_login']?></a>
                <p class="line-t-6"></p>
				</form>
            </div>
        </div>
        <p class="ft_crt">Copyright(c) &nbsp;&nbsp;<?php echo date('Y');?> &nbsp;&nbsp;<?php echo $langco['company_name']?></p>
    </div>
</body>
</html>