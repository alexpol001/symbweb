$(document).ready(function () {
    'use strict';

    function active(item, hover) {
        var color = item.data('color');
        item.addClass('active');
        if (hover) {
            item.addClass('hover');
        } else {
            item.addClass('selected');
            $('.advantage-info .advantage-wrap:eq('+item.index()+')').fadeIn(400);
        }
        item.css('background-color', color);
        var icon = item.find('.advantage-icon');
        icon.css({'color': color, 'background-color': ''});
    }

    function deactive(item, hover, init) {
        var color = item.attr('data-color');
        item.removeClass('active');
        item.removeClass('hover');
        item.css('background-color', '');
        var icon = item.find('.advantage-icon');
        icon.css({'color': '', 'background-color': color});
        if (!hover) {
            var avantage = $('.advantage-info .advantage-wrap:eq('+item.index()+')');
            if (init) {
                avantage.hide();
            } else {
                avantage.fadeOut(400);
            }
            item.removeClass('selected');
        }
    }

    $('.advantage-item').each(function () {
        deactive($(this), false,true);
    });

    $('.advantage-item').on('mouseover', function () {
        if (!$(this).hasClass('active'))
            active($(this), true);
    });

    $('.advantage-item').mouseout(function () {
        if ($(this).hasClass('hover') && !$(this).hasClass('selected')) {
            deactive($(this), true);
            return;
        }
        if ($(this).hasClass('selected')) {
            $(this).removeClass('hover');
        }
    });

    active($('.advantage-item:first-child'));

    $('.advantage-item').on('click', function () {
        if (!$(this).hasClass('selected')) {
            deactive($('.advantage-item.active').not('.hover'));
            active($(this));
        }
    });
});
