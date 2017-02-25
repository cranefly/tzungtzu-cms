<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title><?php echo $controller_title;?></title>
    <link rel="stylesheet" href="<?php echo $tz->get_css('libs/layui/css/layui.css');?>"/>
    <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $tz->get_css('libs/layui/layui.js');?>"></script>
</head>
<body>
    <div class="layui-main container " id="container">
        <fieldset class="layui-elem-field" style="margin: auto auto;border: 1px solid #eee;margin-top: 10%;width: 60%;">
            <legend>登录管理系统</legend>
            <div class="layui-field-box">
                <form class="layui-form" action="<?php echo base_url($tz->PagePath . '/do_login');?>" method="post" onsubmit="return false;" style="padding: 20px;margin-right: 100px;">
                    <div class="layui-form-item">
                      <div class="layui-input-block">
                          <input type="text" name="uname" required value="" lay-verify="required" placeholder="请输入登录用户名" autocomplete="off" class="layui-input">
                      </div>
                    </div>
                    <div class="layui-form-item">
                      <div class="layui-input-block">
                          <input type="password" name="upass" required value="" lay-verify="required" placeholder="请输入登录密码" autocomplete="off" class="layui-input">
                      </div>
                    </div>
                     <div class="layui-form-item">
                      <div class="layui-input-block">
                          <button class="layui-btn" lay-submit lay-filter="*">登录</button>
                      </div>
                    </div>
                </form>
          </div>
        </fieldset>
        <script>
            $(function(){
                layui.use(['layer', 'form'], function(){
                    var layer = layui.layer;
                    var layform = layui.form();
                     //监听提交
                    layform.on('submit(*)', function(data){
                        var lay_index = layer.load(2);
                        $.post(data.form.action, data.field, function(data){
                            try {
                                if(data.state == 0){
                                    if(typeof(data.url) != 'undefined' && data.url != ''){
                                        window.location.href = data.url;
                                    }else{
                                        window.location.reload();
                                    }
                                }else{
                                    layer.msg(data.message, {icon: 2, time: 2000});
                                }
                            }catch(e){

                            }
                        },'json');
                        layer.close(lay_index);
                        return false;
                    });
                });      
            });

        </script>
    </div>
</body>
</html>