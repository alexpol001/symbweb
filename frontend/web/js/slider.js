$(document).ready(function () {
    'use strict';

    function clearSlideAttributes() {
        $('#slider-home').find('.attribute .attribute-value').each(function () {
            var value = Number($(this).data('value'));
            if (value > 0) {
                $(this).html('0');
            }
        });
    }

    function countSlideAttributes(attribute) {
        var value = Number(attribute.data('value'));
        if (value > 0) {
            attribute.countTo({
                from: 0,
                to: value,
                speed: 1000,
                refreshInterval: 50
            });
        }
    }

    $('#slider-home').on('translated.owl.carousel', function (event) {
        $(this).find('.active .attribute .attribute-value').each(function () {
            countSlideAttributes($(this))
        });
        clearSlideAttributes();
    });

    clearSlideAttributes();
    setTimeout(function () {
        $('#slider-home .active .attribute .attribute-value').each(function () {
            countSlideAttributes($(this))
        }, 100);
    });


    var currentMousePos = { x: -1, y: -1 };
    var lastMousePos = { x: -1, y: -1 };
    $(document).mousemove(function(event) {
        currentMousePos.x = event.pageX;
        currentMousePos.y = event.pageY;
        $('#slider-home .slide-move-bg').css({"background-position" : -(currentMousePos.x/20) + "px " + -(currentMousePos.y/20) + "px"})
        $('#slider-home .slide').css({"background-position" : -(currentMousePos.x/50) + "px " + -(currentMousePos.y/50) + "px"})
    });
});
