$(function () {
    $('#nav_second li').click(function () {
        // $(this).addClass('active');
        // $(this).siblings().removeClass('active');
        $('#nav_second li').eq(3).addClass('active');
        $(this).siblings().removeClass('active');
    });
});