(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        const addHandler = ($element) => {

            var originalPosition = null;

            $('.movingButton').on('mouseenter', function() {
                if (originalPosition === null) {
                    originalPosition = $(this).offset();
                }

                $(this).on('mousemove', function(event) {
                    var deltaX = event.pageX - originalPosition.left - ($(this).outerWidth() /2);
                    var deltaY = event.pageY - originalPosition.top - ($(this).outerHeight() /2);
                    if (deltaX > 20) {
                        deltaX = 20;
                    } else if (deltaX < -20) {
                        deltaX = -20;
                    }

                    if (deltaY > 20) {
                        deltaY = 20;
                    } else if (deltaY < -20) {
                        deltaY = -20;
                    }

                    $(this).css({
                        'transform': 'translate3d(' + deltaX + 'px, ' + deltaY + 'px, 0px)'
                    });
                });
            });

            $('.movingButton').on('mouseleave', function() {
                $(this).css({
                    'transform': 'translate3d(0px, 0px, 0px)'
                });
            });
        };

        elementorFrontend.hooks.addAction('frontend/element_ready/zipli-button-mousemove.default', addHandler);
        });
})(jQuery);
