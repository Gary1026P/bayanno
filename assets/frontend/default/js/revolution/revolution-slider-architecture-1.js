var tpj = jQuery;
var revapi469;

tpj(document).ready(function() {
    if (tpj("#rev_slider_1").revolution == undefined) {
        revslider_showDoubleJqueryError("#rev_slider_1");
    } else {
        revapi469 = tpj("#rev_slider_1").show().revolution({
            sliderType: "carousel",
            jsFileLocation: "assets/revolution/js/",
            sliderLayout: "fullscreen",
            dottedOverlay: "none",
            delay: 9000,
            navigation: {
                keyboardNavigation: "off",
                keyboard_direction: "horizontal",
                mouseScrollNavigation: "off",
                mouseScrollReverse: "default",
                onHoverStop: "off",
                tabs: {
                    style: "zeus",
                    enable: true,
                    width: 100,
                    height: 30,
                    min_width: 100,
                    wrapper_padding: 0,
                    wrapper_color: "transparent",
                    wrapper_opacity: "0",
                    tmp: '<span class="tp-tab-title">{{title}}</span>',
                    visibleAmount: 3,
                    hide_onmobile: true,
                    hide_under: 480,
                    hide_onleave: false,
                    hide_delay: 200,
                    direction: "horizontal",
                    span: true,
                    position: "inner",
                    space: 1,
                    h_align: "center",
                    v_align: "top",
                    h_offset: 0,
                    v_offset: 30
                }
            },
            carousel: {
                horizontal_align: "center",
                vertical_align: "center",
                fadeout: "on",
                vary_fade: "on",
                maxVisibleItems: 3,
                infinity: "on",
                space: 0,
                stretch: "off"
            },
            responsiveLevels: [1240, 1024, 778, 480],
            visibilityLevels: [1240, 1024, 778, 480],
            gridwidth: [800, 640, 480, 480],
            gridheight: [720, 720, 480, 360],
            lazyType: "none",
            parallax: {
                type: "scroll",
                origo: "enterpoint",
                speed: 400,
                levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 46, 47, 48, 49, 50, 55],
                type: "scroll",
            },
            shadow: 0,
            spinner: "off",
            stopLoop: "on",
            stopAfterLoops: 0,
            stopAtSlide: 1,
            shuffle: "off",
            autoHeight: "off",
            fullScreenOffsetContainer: ".navbar-main",
            disableProgressBar: "on",
            hideThumbsOnMobile: "off",
            hideSliderAtLimit: 0,
            hideCaptionAtLimit: 0,
            hideAllCaptionAtLilmit: 0,
            debugMode: false,
            fallbacks: {
                simplifyAll: "off",
                nextSlideOnWindowFocus: "off",
                disableFocusListener: false,
            }
        });
    }
}); /*ready*/
