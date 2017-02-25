/**
 * 模型js
 */
$(function(){
    
});

//包括模型和字段关系
function doField(){
    
    var params=[];
    $('.chk_list').each(function () {
        if ($(this).attr('checked') == 'checked') params.push($(this).val());
    });
    var model_id = $("#model_id").val();
    //提交数据处理
    $.post('/back/model/doField', { "params": params,"model_id":model_id }, function (result) {
        try {
            var ret = $.evalJSON(result);
            if (ret.code == 0) {
                C.alert.alert({ "content": "" + ret.msg + "" ,"funcOk":function(){
                    window.location.reload(); 
                }});
            } else {
                C.alert.alert({ "content":ret.msg});
            } 
        } catch (e) {
            C.alert.alert({"content":result + e});
        }
    });
}

function updateModel(id){
 
    //提交数据处理
    $.post('/back/model/updateModel?id=' + id, "", function (result) {
        try {
            var ret = $.evalJSON(result);
            if (ret.code == 0) {
                C.alert.alert({ "content": "" + ret.msg + "" ,"funcOk":function(){
                    window.location.reload(); 
                }});
            } else {
                C.alert.alert({ "content":ret.msg});
            }
        } catch (e) {
            C.alert.alert({"content":result + e});
        }
    });
}