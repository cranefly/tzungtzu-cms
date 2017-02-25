$(function(){
    
	$(".btnSave").click(function(e){
		
		var form_obj = $("#table_list_form");
		$.post(form_obj.attr('action'), form_obj.serialize(), function(data){
            
            try {
                if(data.state == 0){
                    if(typeof(data.url) != 'undefined' && data.url != ''){
                        window.location.href = data.url;
                    }else{
                        window.location.reload();
                    }
                }else{
					// C.alert.alert({content:data.message});
				}
				
            }catch(e){
                
            }
        },'json');
	});
	
	$(".js_btn_save").click(function(){
		var lay_index = layer.load(2);
		var tag = "#form_data";
		var form_obj = $(tag);
		var prefix = form_obj.attr('prefix');

		if (typeof(prefix) == "undefined"){ prefix = 'save';}

		$.post(form_obj.attr('action') + '/' + prefix, form_obj.serialize(), function(data){
			try {
				if(data.state == 0){
					layer.msg(data.message);
					//C.alert.tips({content:data.message,timeout:5000});
					window.location.reload();
				}else{
					layer.msg(data.message, {icon: 2, time: 2000});
					// C.alert.tips({content:data.message,timeout:5000});
				}
			}catch(e){ /* C.alert.alert({content:e.message+data});*/}
		},'json');
		layer.close(lay_index);
	});
	/*
    var isShow=false;
    $(".son_div").hide();
    $(".son_menu").mouseover(function(){
        $(".son_div").show();
    });
    $(".son_div").mouseover(function(){
        isShow=true;   
        $(this).show(); 
    });
    $(".son_div").mouseout(function(){
        if(isShow)
        {
            $(this).hide(); 
            isShow=false;
        }   
    });
    */
    //table列表选择行自动勾选
    $('.table_click').find('tr').click(function(e){
        var chkbox=$(this).find('.chk_list');
        if(chkbox.length==1){
            if(!chkbox.attr('disabled')){
                if(chkbox.attr('checked')){
                    chkbox.attr('checked',false);
                }else{
                    chkbox.attr('checked',true);
                }
            }
        }
        $('.chk_list').each(function(){
            if($(this).attr('checked')){
                $(this).parent().parent().css({'background':'#f7f7f7'});
            }else{
                $(this).parent().parent().css({'background':'none'});
            }
        });
    });
    $('.chk_list').click(function(e){
       e.stopPropagation();
       $('.chk_list').each(function(){
            if($(this).attr('checked')){
                $(this).parent().parent().css({'background':'#f7f7f7'});
            }else{
                $(this).parent().parent().css({'background':'none'});
            }
        });
    });
    
    $('.table_click').find('input[type=text]').click(function(e){
        e.stopPropagation();
    });
    
    //返回顶部效果
    $(window).scroll(function(){
            var scrolltop=$(this).scrollTop();
            scrolltop > 0 ? $('.to-top').show(): $('.to-top').hide();
            var top = $(window).height();
            $('.to-top').css({'top':scrolltop + top - 130});
        });
    $('.to-top').on('click',function(){
        if(!$('html,body').is(":animated"))
            $('html,body').animate({scrollTop: 0}, 300);
    });

    $('#search_btn').on('click',function(){
        var form_obj = $("#search_form");
        $.post(form_obj.attr('action'), form_obj.serialize(), function(data){
            alert(form_obj.attr('action'));
            try {
                if(data.state == 0){
                    if(typeof(data.url) != 'undefined' && data.url != ''){
                        window.location.href = data.url;
                    }else{
                        window.location.reload();
                    }
                }
            }catch(e){
                
            }
        },'json');
    });
    
    if($('#upload_img').length > 0){
        $("#upload_img").dropzone({
            url: "/webmaster/upload/file_upload", //必须填写
            method:"post",  //也可用put
            paramName:"Filedata", //默认为file
            maxFiles:10,//一次性上传的文件数量上限
            maxFilesize: 20, //MB
            acceptedFiles: ".jpg,.gif,.png", //上传的类型
            previewsContainer:".upload_img_hidden", //显示的容器
            parallelUploads: 3,
            dictMaxFilesExceeded: "您最多只能上传10个文件！",
            dictResponseError: '文件上传失败!',
            dictInvalidFileType: "你不能上传该类型文件,文件类型只能是*.jpg,*.gif,*.png。",
            dictFallbackMessage:"浏览器不受支持",
            dictFileTooBig:"文件过大上传文件最大支持.",
            //previewTemplate: document.querySelector('#show_image').innerHTML,//设置显示模板
            init:function(){

                this.on("success", function(file){
                    console.log(file) ;
                    if (file){
                        var response = $.parseJSON(file.xhr.responseText);
                        var _html = '<img src="'+ response.file_path +'" style="height:30px;padding-top:5px; padding-left:5px;"/>'; 
                        $("#upload_img").append(_html);
                        $('#upload_img_value').val(response.file_path);
                    }
                });

                this.on("removedfile",function(file){
                    //删除文件时触发的方法
                });
            }
        });
    }
    
    if($('#resource').length > 0){
        $("#resource").dropzone({
            url: "/webmaster/upload/file_upload", //必须填写
            method:"post",  //也可用put
            paramName:"Filedata", //默认为file
            maxFiles:10,//一次性上传的文件数量上限
            maxFilesize: 20, //MB
            acceptedFiles: ".jpg,.gif,.png", //上传的类型
            previewsContainer:".resource_hidden", //显示的容器
            parallelUploads: 3,
            dictMaxFilesExceeded: "您最多只能上传10个文件！",
            dictResponseError: '文件上传失败!',
            dictInvalidFileType: "你不能上传该类型文件,文件类型只能是*.jpg,*.gif,*.png。",
            dictFallbackMessage:"浏览器不受支持",
            dictFileTooBig:"文件过大上传文件最大支持.",
            //previewTemplate: document.querySelector('#show_image').innerHTML,//设置显示模板
            init:function(){
                this.on("success", function(file){
                    console.log(file) ;
                    if (file){
                        var response = $.parseJSON(file.xhr.responseText);
                        var _html = '<input type="hidden" name="data[resource][]" value="' + response.resource_id + '">';
                         _html += '<img src="'+ response.file_path +'" style="height:30px;padding-top:5px; padding-left:5px;"/>'; 
                        $("#resource").append(_html);
                        $('#resource_hidden').val(response.file_path);
                    }
                });

                this.on("removedfile",function(file){
                    //删除文件时触发的方法
                });
            }
        });
    }
});

//设置隐藏显示层
function show_more(o){
    var obj=$('#'+o);
    if(obj.css('display')=='none'){
        obj.css('display','');
        // C.cookie.set(o,1);
    }else{
        obj.css('display','none');
        // C.cookie.set(o,0);
    }
}

//保存表单数据
function save_data(tag){
	
    if(!arguments[0]){tag = "#form_data";}
	var form_obj = $(tag);
    var prefix = form_obj.attr('prefix');
	
    if (typeof(prefix) == "undefined"){ prefix = 'save';}
    
    $.post(form_obj.attr('action') + '/' + prefix, form_obj.serialize(), function(data){
        try {
            if(data.state == 0){
                //C.alert.tips({content:data.message,timeout:5000});
				window.location.reload();
            }else{
                // C.alert.tips({content:data.message,timeout:5000});
            }
        }catch(e){ /* C.alert.alert({content:e.message+data});*/}
    },'json');
}

//删除
function del_data(tag){
    var form_obj = $("#form_data");

    if(!arguments[0]){tag = ".chk_list";}
    var params=[];
    $(tag).each(function () {
        if ($(this).attr('checked') == 'checked') params.push($(this).val());
    });
    if (params.length == 0) { C.alert.alert({ "content": "没有选中项，无法操作" }); return; }
        C.alert.confirm({height:200,content:"确认要删除数据"+params.length + "条数据吗？",funcOk:function(){
        C.alert.opacty_close();
        C.form.batch_modify(form_obj.attr('action') + "/delete",tag);
        
    }});
}

//删除单个
function del_one(id){
    var form_obj = $("#form_data");

    C.alert.confirm({height:200,content:"确认要删除数据数据吗？",funcOk:function(){
        $.post(form_obj.attr('action') + "/delete",{"params":id},function(data){
            try {
                if(data.state == 0){
                    window.location.reload();
                }else{
                    C.alert.tips({content:data.message,timeout:5000});
                }
            }catch(e){C.alert.alert({content:e.message+data});}
        },'json'); 
    }});
}
//修改排序
function update_order(tag){
    if(!arguments[0]){tag = ".corder";}
	var form_obj = $("#form_data");
	
    C.form.update_field(form_obj.attr("action") + "/update_order",tag);
}

function update_status(status){
	var form_obj = $("#table_list_form");
	var params=[];
    $(".chk_list").each(function () {
        if ($(this).attr('checked') == 'checked') params.push($(this).val());
    });
    if (params.length == 0) { C.alert.alert({ "content": "没有选中项，无法操作" }); return; }
	var params_str = params.join(',');
	$.post(form_obj.attr("action") + "/update_state",{"ids":params_str,"state":status},function(data){
        try {
            if(data.state == 0){
                window.location.reload();
            }else{
                C.alert.alert({content:data.msg});
            }
        }catch(e){C.alert.alert({content:e.message+data});}
    },'json');
}
//更改状态
function status(status,id){
    var form_obj = $("#form_data");
    $.post(form_obj.attr("action") + "/update_state",{"ids":id,"state":status},function(data){
        try {
            if(data.state == 0){
                window.location.reload();
            }else{
                C.alert.alert({content:data.msg});
            }
        }catch(e){C.alert.alert({content:e.message+data});}
    },'json');
}

$(function(){
    $(document).on('click', '.quickBtn', function(){
		var _template = $('.template').find('table').find('tbody').html();
		
		var key = $(this).attr('key');
		
		$(".table_lists").find('tr').each(function(){
			var _key = $(this).find('.quickBtn').attr('key');
			
			if (key == _key){
				var data = $.parseJSON($(this).attr('data'));
				var _html = Tzungtzu.nano(_template, data);
				$('#form_add').html(_html);
				$('#form_add').find('input').focus();
			}
		});
		
	});
});

var Tzungtzu = {
	"nano" : function(template, data){
		return template.replace(/\{([\w\.]*)\}/g, function(str, key) {
			var keys = key.split("."), v = data[keys.shift()];
			for (var i = 0, l = keys.length; i < l; i++) v = v[keys[i]];
			return (typeof v !== "undefined" && v !== null) ? v : "";
		  });
	}
}


//弹出层提示后自动重载页面
function show_close(msg,t){
    if(!arguments[0]){msg = "操作成功";}
    if(!arguments[1]){t = 2000;}
    C.alert.alert({content:msg});
    setInterval(function(){

        window.location.reload();
    },t);
}


var Rank  = {
	authority : function(){
		var form_obj = $("#rank_form");
		
		var user_id = $('select[name="user_id"]').val();
		var group_id = $('select[name="group_id"]').val();
		
		window.location.href = form_obj.attr('action') + "/?user_id=" + user_id + "&group_id=" + group_id;
	},
    tabs : function(__params){
        //默认选中
        var selected=__params.selected;
        if(__params.selected){selected=__params.selected}else{selected=__params.params[0].nav;}
        //切换动作
        var event=__params.event;
        if(__params.event){event=__params.event}else{event='click';}
        //默认样式选中和不选中
        if(!__params.style) __params.style={"sclass":"selected","nclass":"selected_no"};
        //切换卡参数
        var params=__params.params;
        //遍历切换卡参数
        for(var i=0;i<params.length;i++){
            var tab=params[i];
            //选项卡自定义了样式
            var sclass=__params.style.sclass;if(tab.sclass) sclass=tab.sclass;
            var nclass=__params.style.nclass;if(tab.nclass) nclass=tab.nclass;
            //判断选中选项卡
            if(selected==tab.nav){
                $(tab.nav).removeClass(nclass);
                $(tab.nav).addClass(sclass);
                $(tab.con).css({'display':''});
            }else{
                $(tab.nav).removeClass(sclass);
                $(tab.nav).addClass(nclass);
                $(tab.con).css({'display':'none'});
            }//alert(event);
            //绑定事件
            $(tab.nav).unbind(event);
            $(tab.nav).bind(event,function(){
                Rank.tabs({"selected":"#"+$(this).attr('id'),"event":event,"style":__params.style,"params":params});
            });
        }
    },
};

