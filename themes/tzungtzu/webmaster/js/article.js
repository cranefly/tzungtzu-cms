
//删除
function del_articles(mid){
    var form_obj = $("#table_list_form");

    var tag_class = ".chk_list";
    var params=[];
    $(tag).each(function () {
        if ($(this).attr('checked') == 'checked') params.push($(this).val());
    });
    if (params.length == 0) { C.alert.alert({ "content": "没有选中项，无法操作" }); return; }
    C.alert.confirm({height:200,content:"确认要删除数据"+params.length + "条数据吗？",funcOk:function(){
        C.alert.opacty_close();
        //C.form.batch_modify(form_obj.attr('action') + "/delete",tag);
        
        var params = [];
        //遍历所有checkbox值
        $(tag_class).each(function () {
          if ($(this).attr('checked') == 'checked') {
            params.push($(this).val());
          }
        });
        if (params.length == 0) { C.alert.alert({ "content": "没有选中项，无法操作" }); return; }
        var params_str = params.join(',');
        var url = url.replace('[@]', params_str);

        //提交数据处理
        $.post(form_obj.attr('action') + "/delete", { params: params_str, "mid" :mid }, function (data) {
            try {
                if (data.state == 0) {
                   window.location.reload();
                } else {
                    C.alert.alert({ "content":data.message});
                }
            } catch (e) {
                C.alert.alert({"content":data + e});
            }
        }, 'json');
        
    }});
}

//删除单个
function del_article(id, mid){
    var form_obj = $("#table_list_form");

    C.alert.confirm({height:200,content:"确认要删除数据数据吗？",funcOk:function(){
        $.post(form_obj.attr('action') + "/delete",{"params":id,"mid":mid},function(data){
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