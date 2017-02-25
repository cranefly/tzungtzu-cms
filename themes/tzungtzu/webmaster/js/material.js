$(function(){
    $("body").on("change", "#js-change", function(){
        var selected = $(this).val();

        if (selected == 2){
            $("#agent_area").show();
        }else{
            $("#agent_area").hide();
        }
    });
});