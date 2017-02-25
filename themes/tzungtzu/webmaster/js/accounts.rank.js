$(function(){
	$('.cbx_all').change(function(){
        var cbx_child = $(this).parents('table:eq(0)').find('.cbx_child');
        if(!$(this).prop('checked'))
        {	
            cbx_child.prop('checked',false);
			cbx_child.parent().next().next('td').find('input[type=checkbox]').prop('checked',false);
        }else{
			cbx_child.parent().next().next('td').find('input[type=checkbox]').prop('checked',true);
            cbx_child.prop('checked',true);
        }
    });

    $('input.cbx_child').change(function(){
        var cbx_child_and = $(this).parent().siblings().find('input');
        if($(this).prop('checked'))
        {
			if($("#act").val() == 2) return;
            if(cbx_child_and.length > 0){
                cbx_child_and.prop('checked',true).parents('table:eq(0)').find('.cbx_all').prop('checked',true);
            }else{
				
                $(this).parents('table:eq(0)').find('.cbx_all').prop('checked',true);
            }
            
        }else{
            cbx_child_and.prop('checked',false);
            if($(this).parents('tr').siblings().find('input.cbx_child:checked').length <= 0){
                $(this).parents('table:eq(0)').find('.cbx_all').prop('checked',false)
            }
        }
    });

    $('input.cbx_child_and').change(function(){
        if($(this).prop('checked')){
			if($("#act").val() == 2) return;
            $(this).prop('checked',true).parents('td').siblings().children('.cbx_child').prop('checked',true).parents('table:eq(0)').find('.cbx_all').prop('checked',true);
        }
    });
	
	Rank.tabs({"params":
	[
		{"nav":"#tab_A","con":"#con_A","sclass":"current","nclass":""},										
		{"nav":"#tab_B","con":"#con_B","sclass":"current","nclass":""},										
		{"nav":"#tab_C","con":"#con_C","sclass":"current","nclass":""},										
		{"nav":"#tab_D","con":"#con_D","sclass":"current","nclass":""},										
		{"nav":"#tab_E","con":"#con_E","sclass":"current","nclass":""},										
		{"nav":"#tab_W","con":"#con_W","sclass":"current","nclass":""},										
		{"nav":"#tab_GPA","con":"#con_GPA","sclass":"current","nclass":""}		
	]
	});
	
	$('select[name=user_id]').change(function(){
		Rank.authority();
	});
	$('select[name=group_id]').change(function(){
		Rank.authority();
	});
});
