(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        const addHandler = ($element) => {
            elementorFrontend.elementsHandler.addHandler(zipliSwiperBase, {
                $element,
            });
        };
        elementorFrontend.hooks.addAction('frontend/element_ready/zipli-testimonials.default', addHandler);
    });
})(jQuery);