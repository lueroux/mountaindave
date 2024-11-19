(function ($) {
    'use strict';

    function login_dropdown() {
        $('.site-header-account').mouseenter(function () {
            if (!$('.account-dropdown', this).has('.account-wrap').length) {
                $('.account-dropdown', this).append($('.account-wrap'));
            }
        });
    }

    function account_side() {
        var $account_side = $('body .header-group-action .site-header-account a');
        var $account_active = $('body .header-group-action .site-header-account .account-dropdown');
        $(document).mouseup(function (e) {
            if ($account_side.has(e.target).length == 0 && !$account_active.is(e.target) && $account_active.has(e.target).length == 0) {
                $account_active.removeClass('active');
            }
        });
        $account_side.on('click', function (e) {
            var $parent = $(this).closest('.header-group-hide-dropdown');
            if($parent.length) {
                return;
            }
            e.preventDefault();
            e.stopPropagation();
            $account_active.toggleClass('active');
        });
    }

    function handleWindow() {
        var body = document.querySelector('body');

        if (window.innerWidth > body.clientWidth + 5) {
            body.classList.add('has-scrollbar');
            body.setAttribute('style', '--scroll-bar: ' + (window.innerWidth - body.clientWidth) + 'px');
        } else {
            body.classList.remove('has-scrollbar');
        }
    }

    function minHeight() {
        var $body = $('body'),
            bodyHeight = $(window).outerHeight(),
            headerHeight = $('header.header-1').outerHeight(),
            footerHeight = $('footer.site-footer').outerHeight(),
            $adminBar = $('#wpadminbar');

        if ($adminBar.length > 0) {
            headerHeight += $adminBar.height();
        }

        if ($body.find('header.header-1').length) {

            $('.site-content').css({
                'min-height': bodyHeight - headerHeight - footerHeight
            });
        }
    }

    function setPositionLvN($item) {
        var sub = $item.children('.sub-menu'),
            offset = $item.offset(),
            width = $item.outerWidth(),
            screen_width = $(window).width(),
            sub_width = sub.outerWidth();
        var align_delta = offset.left + width + sub_width - screen_width;
        if (align_delta > 0) {
            if ($item.parents('.menu-item-has-children').length) {
                sub.css({left: 'auto', right: '100%'});
            } else {
                sub.css({left: 'auto', right: '0'});
            }
        } else {
            sub.css({left: '', right: ''});
        }
    }

    function initSubmenuHover() {
        $('.site-header .primary-navigation .menu-item-has-children').hover(function (event) {
            var $item = $(event.currentTarget);
            setPositionLvN($item);
        });
    }

    function backtotop() {
        var progressPath = $(".progress-wrap .progress-circle path");
        if (progressPath.length > 0) {
            var pathLength = progressPath.get(0).getTotalLength();
            progressPath.css({
                "transition": "none",
                "-webkit-transition": "none",
                "stroke-dasharray": pathLength + " " + pathLength
            });
            progressPath.css("stroke-dashoffset", pathLength);
            var updateProgress = function () {
                var scroll = $(window).scrollTop();
                var height = $(document).height() - $(window).height();
                var progress = pathLength - scroll * pathLength / height;
                progressPath.css("stroke-dashoffset", progress);
            };
            updateProgress();
            $(window).scroll(updateProgress);
            var offset = 50;
            var duration = 550;
            $(window).scroll(function () {
                if ($(this).scrollTop() > offset) {
                    $(".progress-wrap").addClass("active-progress");
                } else {
                    $(".progress-wrap").removeClass("active-progress");
                }
            });
            $(".progress-wrap").on("click", function (event) {
                event.preventDefault();
                $("html, body").animate({scrollTop: 0}, duration);
                return false;
            });
        }
    }

    function _makeStickyKit() {
        var top_sticky = 0,
            $adminBar = $('#wpadminbar');

        if ($adminBar.length > 0) {
            top_sticky += $adminBar.height();
        }

        if (window.innerWidth < 992) {
            $('#secondary').trigger('sticky_kit:detach');
        } else {
            $('#secondary').stick_in_parent({
                offset_top: top_sticky
            });

        }
    }

    function Fixed_TOC() {
        var $adminBar = $('#wpadminbar'),
            adminBarHeight = 1;

        if ($adminBar.length > 0) {
            adminBarHeight += $adminBar.height();
        }

        $(window).on('scroll', function () {
            var windowTop = $(window).scrollTop() + ($(window).height()/2);
            $('.table-of-contents').each(function (i, e) {
                let sectionTop = $(this).offset().top;
                let sectionHeight = $(this).height();
                let linkId = $(this).attr('id');
                if (linkId) {
                    if (windowTop > (sectionTop - adminBarHeight) && windowTop <= ((sectionTop + sectionHeight - adminBarHeight))) {
                        $('[href="#' + linkId + '"]').addClass('active');
                    } else {
                        $('[href="#' + linkId + '"]').removeClass('active');
                    }
                }

            });
        });
    }

    initSubmenuHover();
    minHeight();
    handleWindow();
    login_dropdown();
    backtotop();
    Fixed_TOC();

    $(document).ready(function () {
        account_side();
        if ($('#secondary').length > 0) {
            _makeStickyKit();
            $(window).resize(function () {
                setTimeout(function () {
                    _makeStickyKit();
                }, 100);
            });
        }
    });
})(jQuery);

