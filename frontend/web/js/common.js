$(document).ready(function () {
    'use strict';

    $('.site-inner-portfolio .portfolio-inner-content > *').addClass('wow fadeInUp').attr('data-wow-duration', '0.5s');

    new WOW(
        {
            boxClass: 'wow',
            animateClass: 'animated',
            offset: 100,
            mobile: false,
            live: true
        }
    ).init();

    function toggleScrollUp() {
        if ($(window).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    }

    toggleScrollUp();

    $(window).scroll(function () {
        toggleScrollUp()
    });

    $('.scrollup').click(function () {
        $("html, body").animate({scrollTop: 0}, 600);
        return false;
    });

    $('.sub-menu-items a').click(function () {
        var url = $(this).attr('href');
        var target = $('#' + url.substring(url.indexOf('#') + 1));
        if (target.length > 0) {
            var offset = $('.main-header .top').height();
            $('html, body').animate({scrollTop: target.offset().top - offset}, 800);
            return false;
        }
    });

    function removeLocationHash() {
        var noHashURL = window.location.href.replace(/#.*$/, '');
        try {
            window.history.replaceState('', document.title, noHashURL)
        } catch (err) {

        }
    }

    var anc = window.location.hash.replace("#", "");

    removeLocationHash();

    if (anc) {
        var offset = 0;
        if ($(window).innerWidth() >= 751) {
            offset = $('.main-header .top').height();
        } else {
            offset = $('.main-header .main-menu').height()
        }
        window.scrollTo(0, $('#' + anc).offset().top - offset);
    }

    $('.port-client-result .attribute-item .attribute-value').each(function () {
        var value = Number($(this).html());
        if (value > 0) {
            $(this).html('0');
            $(this).countTo({
                from: 0,
                to: value,
                speed: 1500,
                refreshInterval: 50
            });
        }
    });
});
