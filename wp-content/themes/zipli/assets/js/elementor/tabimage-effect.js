
(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/zipli-tabimage-effect.default', ($scope) => {
            let $wrapper = $scope.find('.elementor-tabimage-wrapper');
            $wrapper.find('.elementor-active').show();
            $wrapper.find('.elementor-tabimage-item').hover(function (e) {
                e.preventDefault();
                $wrapper.find('.elementor-tabimage-item').removeClass('elementor-active');
                let id =$(this).data('trigger')
                $(this).addClass('elementor-active');
                $wrapper.find('[data-target="'+id+'"]').addClass('elementor-active');
            });
        });
    });
})(jQuery);
