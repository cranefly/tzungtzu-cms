
$(function(){
    $("#btnSave").click(function(){
		Login.doLogin();
    });
	
	$('body').on('keydown','#upass', function(e){
		if((e ? e.which : event.keyCode)==13) {
			Login.doLogin();
		};
	});
});

var Login = {
	doLogin : function(){
		var form_obj = $("#form_obj");
        $.post(form_obj.attr('action'),form_obj.serialize(),function(data){
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
	}
}
