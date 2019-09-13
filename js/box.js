$(function(){
    $(".box").on({
        "click":function(){
            $(this).addClass("animated bounce");
        },
        "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend":function(){
            $(this).removeClass("animated bounce");
        }
    });
});