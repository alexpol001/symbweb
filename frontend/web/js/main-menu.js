$(document).ready(function () {
    'use strict';

    function deactiveAll() {
        $('.main-menu .sub-menu-items a').each(
            function () {
                $(this).removeClass('active');
                $($(this).data('target')).hide();
                $(this).find('.sub-menu-title').css('color', '');
            }
        );
    }

    function active(elem) {
        deactiveAll();
        var target = elem.data('target');
        elem.addClass('active');
        elem.find('.sub-menu-title').css('color', elem.data('color'));
        $(target).show();
    }

    $('.main-menu .menu-item a').on('mouseover mouseenter', function () {
        var target = $(this).data('target');
        $(target).show();
        var descr = $(target).find('.description');
        if (descr.hasClass('description')) {
            active($(target).find('.sub-menu-items li:first-child a'));
        } else {
            deactiveAll();
        }
    });

    $('.main-menu .sub-menu-items a').on('mouseover mouseenter', function () {
        active($(this));
    });

    $('.main-menu .menu-item a').on('mouseout mouseleave', function (event) {
        var menuWrap = $('.main-menu .menu-wrap');
        var target = $($(this).data('target'));
        if (menuWrap.offset().top + menuWrap.height() > event.pageY || menuWrap.offset().left > event.pageX || menuWrap.offset().right < event.pageX) {
            $(target).hide();
        }
    });

    $('.main-menu .sub-menu').on('mouseout mouseleave', function () {
        if (!$(this).is(':hover')) {
            $(this).hide();
        }
    });

    function border_off() {
        var elem = $('.main-menu .sub-menu-items a');
        elem.each(function () {
            if (!$(this).closest('.sub-menu-wrap').find('.description').hasClass('description')) {
                $(this).addClass('border-off')
            }
        });
    }

    border_off();
});
