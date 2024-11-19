(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        const addHandler = ($element) => {
            elementorFrontend.elementsHandler.addHandler(zipliSwiperBase, {
                $element,
            });
            var windowsize = $(window).width();
            if (windowsize > 800) {
                $('.blog-grid2', $element).hover(function () {
                    $('.elementor-post-style-2 .blog-column', $element).addClass('active');
                    $('.blog-grid2.active', $element).removeClass('active');
                    $(this).toggleClass('active');
                });
            }
        };
        elementorFrontend.hooks.addAction('frontend/element_ready/zipli-post-grid.default', addHandler);
    });
})(jQuery);