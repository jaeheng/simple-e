/**
 * Simple-E Js
 * @Author: jaeheng@qq.com
 */
$(function () {
    var fadeOut2 = function($dom) {
        $dom.fadeOut(100);
    };

    var fadeIn2 = function ($dom) {
        $dom.fadeIn(100);
    };

    // 点击显示
    $(document).on('click', '[v-show]', function (e) {
        e.preventDefault();
        e.stopPropagation();
        fadeIn2($('#' + $(this).attr('v-show')));
    });

    $(document).on('click', function (e) {
        fadeOut2($('#menu'));
        fadeOut2($('#keyword'));
    });

    $(document).on('click', '.icon-close', function (e) {
        fadeOut2($(this).parents('.toggle'));
    });

    $(document).on('click', '#menu', function (e) {
        e.stopPropagation();
    });
    $(document).on('click', '#keyword', function (e) {
        e.stopPropagation();
    });
});