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

$function(){
$(".bg").css("display", "none");
setTimeout(function(){
$('.bg').fadeOut();
},2800);
});

$(function(){
 $(".mainSite").css({opacity:'0'});
 setTimeout(function(){
 $(".mainSite").css("display", "block");
 $(".mainSite").stop().animate({opacity:'1'},1000);
 },3800);
});