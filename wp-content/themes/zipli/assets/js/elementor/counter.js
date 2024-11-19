(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/zipli-counter.default', ($scope) => {
            var odo = $scope.find(".odometer-defautl");
            window.odometerOptions = {
                auto: false,
                format: '(ddd),dd',
            };
            if(odo.length){
                var odometer = new Odometer({ el: odo.get(0),format: '(ddd).dd',});
                odo.waypoint(function() {
                    odometer.update(odo.attr("data-count"))
                }, {
                    offset: '90%'
                });
            }

        });
    });
})(jQuery);