$function(){
$(".bg").css("display", "none");
setTimeout(function(){
$('.bg').fadeOut();
},3800);
});

$(function(){
 $(".mainSite").css({opacity:'0'});
 setTimeout(function(){
 $(".mainSite").css("display", "block");
 $(".mainSite").stop().animate({opacity:'1'},1000);
 },3800);
});
