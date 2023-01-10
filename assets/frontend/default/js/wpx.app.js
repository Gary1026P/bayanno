/*
Theme Name: Boomerang - Multipurpose Template
Theme URI: https://wrapbootstrap.com/theme/tribus-multipurpose-template-WB0367H15
Author: Webpixels
Author URI: http://www.webpixels.io
License URI: http://wrapbootstrap.com
*/



// Background image holder with fullscreen option
$(window).on('load resize', function() {


    // WPX Slider - Background image holder
    if ($('.background-image-holder').length) {
        $('.background-image-holder').each(function() {

            var $this = $(this);
            var holderHeight;

            if ($this.data('holder-type') == 'fullscreen') {
                if ($this.attr('data-holder-offset')) {
                    if ($this.data('holder-offset')) {
                        var offsetHeight = $('body').find($this.data('holder-offset')).height();
                        holderHeight = $(window).height() - offsetHeight;
                    }
                } else {
                    holderHeight = $(window).height();
                }
                if ($(window).width() > 991) {
                    $('.background-image-holder').css({
                        'height': holderHeight + 'px'
                    });
                } else {
                    $('.background-image-holder').css({
                        'height': 'auto'
                    });
                }

            }
        })
    }



    // Swiper
    if ($(".swiper-js-container").length > 0) {
        $('.swiper-js-container').each(function(i, swiperContainer) {

            var $swiperContainer = $(swiperContainer);
            var $swiper = $swiperContainer.find('.swiper-container');

            var swiperEffect = $swiper.data('swiper-effect');

            var slidesPerViewXs = $swiper.data('swiper-xs-items');
            var slidesPerViewSm = $swiper.data('swiper-sm-items');
            var slidesPerViewMd = $swiper.data('swiper-md-items');
            var slidesPerViewLg = $swiper.data('swiper-items');
            var spaceBetweenSlidesXs = $swiper.data('swiper-xs-space-between');
            var spaceBetweenSlidesSm = $swiper.data('swiper-sm-space-between');
            var spaceBetweenSlidesMd = $swiper.data('swiper-md-space-between');
            var spaceBetweenSlidesLg = $swiper.data('swiper-space-between');


            // Slides per view written in data attributes for adaptive resoutions
            slidesPerViewXs = !slidesPerViewXs ? 1 : slidesPerViewXs;
            slidesPerViewSm = !slidesPerViewSm ? 1 : slidesPerViewSm;
            slidesPerViewMd = !slidesPerViewMd ? 1 : slidesPerViewMd;
            slidesPerViewLg = !slidesPerViewLg ? 1 : slidesPerViewLg;

            // Space between slides written in data attributes for adaptive resoutions
            spaceBetweenSlidesXs = !spaceBetweenSlidesXs ? 0 : spaceBetweenSlidesXs;
            spaceBetweenSlidesSm = !spaceBetweenSlidesSm ? 0 : spaceBetweenSlidesSm;
            spaceBetweenSlidesMd = !spaceBetweenSlidesMd ? 0 : spaceBetweenSlidesMd;
            spaceBetweenSlidesLg = !spaceBetweenSlidesLg ? 0 : spaceBetweenSlidesLg;


            var animEndEv = 'webkitAnimationEnd animationend';

            var $swiper = new Swiper($swiper, {
                pagination: $swiperContainer.find('.swiper-pagination'),
                nextButton: $swiperContainer.find('.swiper-button-next'),
                prevButton: $swiperContainer.find('.swiper-button-prev'),
                slidesPerView: slidesPerViewLg,
                spaceBetween: spaceBetweenSlidesLg,
                autoplay: $swiper.data('swiper-autoplay'),
                effect: swiperEffect,
                speed: 800,
                loop: true,
                grabCursor: false,
                paginationClickable: true,
                direction: 'horizontal',
                preventClicks: true,
                preventClicksPropagation: true,
                observer: true,
                observeParents: true,
                breakpoints: {
                    460: {
                        slidesPerView: slidesPerViewXs,
                        spaceBetweenSlides: spaceBetweenSlidesXs
                    },
                    767: {
                        slidesPerView: slidesPerViewSm,
                        spaceBetweenSlides: spaceBetweenSlidesSm
                    },
                    991: {
                        slidesPerView: slidesPerViewMd,
                        spaceBetweenSlides: spaceBetweenSlidesMd
                    },
                    1100: {
                        slidesPerView: slidesPerViewLg,
                        spaceBetweenSlides: spaceBetweenSlidesLg
                    }
                },
                onInit: function(s) {

                    var currentSlide = $(s.slides[s.activeIndex]);
                    var elems = currentSlide.find(".animated");

                    elems.each(function() {
                        var $this = $(this);

                        if (!$this.hasClass('animation-ended')) {
                            var animationInType = $this.data('animation-in');
                            var animationOutType = $this.data('animation-out');
                            var animationDelay = $this.data('animation-delay');

                            setTimeout(function() {
                                $this.addClass('animation-ended ' + animationInType, 100).on(animEndEv, function() {
                                    $this.removeClass(animationInType);
                                });
                            }, animationDelay);
                        }
                    });
                },
                onSlideChangeStart: function(s) {

                    var currentSlide = $(s.slides[s.activeIndex]);
                    var elems = currentSlide.find(".animated");

                    elems.each(function() {
                        var $this = $(this);

                        if (!$this.hasClass('animation-ended')) {
                            var animationInType = $this.data('animation-in');
                            var animationOutType = $this.data('animation-out');
                            var animationDelay = $this.data('animation-delay');

                            setTimeout(function() {
                                $this.addClass('animation-ended ' + animationInType, 100).on(animEndEv, function() {
                                    $this.removeClass(animationInType);
                                });
                            }, animationDelay);
                        }
                    });
                },
                onSlideChangeEnd: function(s) {

                    var previousSlide = $(s.slides[s.previousIndex]);
                    var elems = previousSlide.find(".animated");

                    elems.each(function() {
                        var $this = $(this);
                        var animationOneTime = $this.data('animation-onetime');

                        if (!animationOneTime || animationOneTime == false) {
                            $this.removeClass('animation-ended');
                        }
                    });
                }
            });
        });
    }
});

// On document ready functions
$(document).ready(function() {

    // Bootstrap - Submenu event for small resolutions

    $('.dropdown-menu .dropdown-submenu [data-toggle="dropdown"]').on('click', function(e) {
        if ($(window).width() < 992) {
            if (!$(this).next().hasClass('show')) {
                $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
            }
            var $subMenu = $(this).next(".dropdown-menu");
            $subMenu.toggleClass('show');


            $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
                $('.dropdown-submenu .show').removeClass("show");
            });

            return false;
        }
    });

    // Fix the closing problem when clicking inside dopdown menu
    $('.navbar .dropdown-menu').on('click', function(event) {
        event.stopPropagation();
    });



    // Hamburger
    if ($('.hamburger-js')[0]) {
        $(".hamburger-js").each(function() {
            var $this = $(this);

            $this.on("click", function(e) {
                $this.toggleClass("is-active");
                // Do something else, like open/close menu
            });
        });

    }







    // Datepicker
    if ($('.datepicker')[0]) {
        $('.datepicker').each(function() {
            var $this = $(this);

            $($this).flatpickr({
                inline: $this.data('datepicker-inline') ? $this.data('datepicker-inline') : false,
                static: true,
                nextArrow: '<i class="ion-ios-arrow-right" />',
                prevArrow: '<i class="ion-ios-arrow-left" />',
                enableTime: true
            });
        })

    }





    // To top
    var offset = 300,
        //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
        offset_opacity = 1200,
        //duration of the top scrolling animation (in ms)
        scroll_top_duration = 700,
        //grab the "back to top" link
        $back_to_top = $('.back-to-top');

    //hide or show the "back to top" link
    $(window).scroll(function() {
        ($(this).scrollTop() > offset) ? $back_to_top.addClass('back-to-top-is-visible'): $back_to_top.removeClass('back-to-top-is-visible cd-fade-out');
        if ($(this).scrollTop() > offset_opacity) {
            $back_to_top.addClass('back-to-top-fade-out');
        }
    });

    //smooth scroll to top
    $back_to_top.on('click', function(event) {
        event.preventDefault();
        $('body, html').animate({
            scrollTop: 0,
        }, scroll_top_duration);
    });






    // Collapse
    // $('.collapse-wrapper .panel').on('shown.bs.collapse', function() {
    //     $(this).addClass('open');
    // });
    //
    // $('.collapse-wrapper .panel').on('hidden.bs.collapse', function() {
    //     $(this).removeClass('open');
    // });

    // WOW animation
    if ($('.has-wow-animation').length > 0) {
        wow = new WOW({
            boxClass: 'has-wow-animation',
            animateClass: 'animated',
            offset: 0,
            mobile: true,
            live: true
        });
        wow.init();
    }

    // Collapse component settings
    $('.accordion--style-1 .collapse, .accordion--style-2 .collapse').on('show.bs.collapse', function() {

        $(this).parent().find(".fa-chevron-right").removeClass("fa-chevron-right").addClass("fa-chevron-down");
    }).on('hide.bs.collapse', function() {
        $(this).parent().find(".fa-chevron-down").removeClass("fa-chevron-down").addClass("fa-chevron-right");
    });




    //tooltip enable
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })


}); // END document ready
