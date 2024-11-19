(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/zipli-image-hotspots.default', function ($scope) {
            Image_Hotspot($scope);
            $(window).on('resize', function () {
                Image_Hotspot($scope);
            });
        });
    });

    function Image_Hotspot($scope) {
        let imgHotspotsElem     = $scope.find('.zipli-image-hotspots-container'),
            imgHotspotsSettings = imgHotspotsElem.data('settings'),
            triggerClick        = null,
            triggerHover        = null;
        // accordion
        let $tabs = $scope.find('.elementor-hotspots');
        $tabs.find('.elementor-active').show(300);
        $tabs.find('.elementor-hotspots-tab-title').on('click', function () {
            if (!$(this).hasClass('elementor-active')) {
                $tabs.find('.elementor-hotspots-tab-title').removeClass('elementor-active');
                $tabs.find('.elementor-tab-content').removeClass('elementor-active').hide(300);
                $(this).addClass('elementor-active');
                let id = $(this).attr('aria-controls');
                $tabs.find('#' + id).addClass('elementor-active').show(300);
            }
        });
        // if ($(window).width() > 767) {
        //     $scope.find('.elementor-hotspots').scrollbar();
        // }
        // $(window).resize(() => {
        //     if ($(window).width() > 767) {
        //         $scope.find('.elementor-hotspots').scrollbar();
        //     } else {
        //         $scope.find('.elementor-hotspots').scrollbar('destroy');
        //     }
        // });


        if (imgHotspotsSettings['trigger'] === 'click') {
            triggerClick = true;
            triggerHover = false;
            if ($scope.find('.zipli-image-hotspots-accordion').length) {
                $scope.find('.zipli-image-hotspots-main-icons').on('click', function () {
                    let $tab = $($(this).data('tab'));
                    if (!$tab.hasClass('elementor-active')) {
                        $tabs.find('.elementor-hotspots-tab-title').removeClass('elementor-active');
                        $tab.addClass('elementor-active');
                    }
                });
                $scope.find('.elementor-hotspots-tab-title').on('click', function () {
                    let $tab = $($(this).data('tab'));
                    $tab.trigger('click').addClass('elementor-active');
                });
            }
        } else if (imgHotspotsSettings['trigger'] === 'hover') {
            triggerClick = false;
            triggerHover = true;
            if ($scope.find('.zipli-image-hotspots-accordion').length) {
                $scope.find('.zipli-image-hotspots-main-icons').on('mouseover', function () {
                    let $tab = $($(this).data('tab'));
                    if (!$tab.hasClass('elementor-active')) {
                        $tabs.find('.elementor-hotspots-tab-title').removeClass('elementor-active');
                        $tab.addClass('elementor-active');
                    }
                });
                $scope.find('.elementor-hotspots-tab-title').on('mouseover', function () {
                    let $tab = $($(this).data('tab'));
                    $tab.trigger('mouseover').addClass('active');
                });
                $scope.find('.elementor-hotspots-tab-title').on('mouseout', function () {
                    let $tab = $($(this).data('tab'));
                    $tab.trigger('mouseout').removeClass('active');
                });
            }
        }
        imgHotspotsElem.find('.tooltip-wrapper').tooltipster({
            functionBefore() {
                if (imgHotspotsSettings['hideMobiles'] && $(window).outerWidth() < 768) {
                    return false;
                }
            },
            functionInit     : function (instance, helper) {
                var content = $(helper.origin).find("[id^='tooltip_content-']").detach();
                instance.content(content);
            },
            functionReady    : function () {
                $(".tooltipster-box").addClass("tooltipster-box-" + imgHotspotsSettings['id']);
                $(".tooltipster-arrow").addClass("tooltipster-arrow-" + imgHotspotsSettings['id']);
            },
            contentCloning   : true,
            plugins          : ['sideTip'],
            animation        : imgHotspotsSettings['anim'],
            animationDuration: imgHotspotsSettings['animDur'],
            delay            : imgHotspotsSettings['delay'],
            trigger          : "custom",
            triggerOpen      : {
                click     : triggerClick,
                tap       : true,
                mouseenter: triggerHover
            },
            triggerClose     : {
                click     : triggerClick,
                tap       : true,
                mouseleave: triggerHover
            },
            arrow            : imgHotspotsSettings['arrow'],
            contentAsHTML    : true,
            autoClose        : false,
            minWidth         : imgHotspotsSettings['minWidth'],
            maxWidth         : imgHotspotsSettings['maxWidth'],
            distance         : imgHotspotsSettings['distance'],
            interactive      : true,
            minIntersection  : 16,
            side             : imgHotspotsSettings['side']
        });

        if($scope.find('.show-all-tooltip').length > 0){
            $('.zipli-image-hotspots-main-icons', $scope).trigger('click');
        }

    }
})(jQuery);
