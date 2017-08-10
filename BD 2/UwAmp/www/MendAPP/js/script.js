$(document).ready(function(){
$(window).load(function() {
    setTimeout(function() {
        $(".loader").animate({opacity: 0}, 1500, function() {
            $(this).remove();
            $("body, html").animate({scrollTop:0},200);
        });
    }, 1000);
});
});
