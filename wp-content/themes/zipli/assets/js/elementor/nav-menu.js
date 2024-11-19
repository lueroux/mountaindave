(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/zipli-nav-menu.default', ($scope) => {
            let $menuItem = $scope.find('.primary-navigation > .menu > .menu-item');
            let $header = $('#masthead');

            if($scope.hasClass('change-bg-yes')){
                $menuItem.on('mouseenter', function () {
                    $header.addClass('change-background');
                }).on('mouseleave',function () {
                    $header.removeClass('change-background');
                });
            }
        });
    });
})(jQuery);