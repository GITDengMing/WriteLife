$(function () {
   $('.opr_list li').click(function () {
       $(this).addClass('ue_active').siblings().removeClass('ue_active');
   });
});