$(function () {
    var navigations = $('#menu'),
        pos = navigations.offset();
    $(window).scroll(function () {
        if ($(this).scrollTop() > pos.top + navigations.height() && navigations.hasClass('normal')) {
            navigations.fadeOut('fast', function () {
                $(this).removeClass('normal').addClass('estavel').fadeIn('fast')
            })
        } else if ($(this).scrollTop() <= pos.top && navigations.hasClass('estavel')) {
            navigations.fadeOut('fast', function () {
                $(this).removeClass('estavel').addClass('normal').fadeIn('fast')
            })
        }
    })
});