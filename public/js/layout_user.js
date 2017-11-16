$(function () {
    $('.cancel').click(function (e) {
        if (confirm('确定取消关注?')){

        }else {
            e.preventDefault();
        }
    });
})
