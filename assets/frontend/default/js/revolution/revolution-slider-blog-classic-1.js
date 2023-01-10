var tpj = jQuery;
var revapi471;

tpj(document).ready(function() {
    if (tpj("#rev_slider_1").revolution == undefined) {
        revslider_showDoubleJqueryError("#rev_slider_1");
    } else {
        revapi471 = tpj("#rev_slider_1").show().revolution({
            sliderType: "carousel",
            jsFileLocation: "assets/revolution/js/",
            sliderLayout: "fullwidth",
            dottedOverlay: "none",
            delay: 9000,
            navigation: {
                keyboardNavigation: "off",
                keyboard_direction: "horizontal",
                mouseScrollNavigation: "off",
                mouseScrollReverse: "default",
                onHoverStop: "off",
                touch: {
                    touchenabled: "on",
                    swipe_threshold: 75,
                    swipe_min_touches: 1,
                    swipe_direction: "horizontal",
                    drag_block_vertical: false
                },
                arrows: {
                    style: "gyges",
                    enable: true,
                    hide_onmobile: true,
                    hide_onleave: true,
                    hide_delay: 200,
                    tmp: '',
                    left: {
                        h_align: "left",
                        v_align: "center",
                        h_offset: 20,
                        v_offset: 0
                    },
                    right: {
                        h_align: "right",
                        v_align: "center",
                        h_offset: 20,
                        v_offset: 0
                    }
                },
                tabs: {

                }
            },
            carousel: {
                horizontal_align: "center",
                vertical_align: "center",
                fadeout: "on",
                vary_fade: "on",
                maxVisibleItems: 3,
                infinity: "on",
                space: 40,
                stretch: "off"
            },
            visibilityLevels: [1240, 1024, 778, 480],
            gridwidth: 720,
            gridheight: 405,
            lazyType: "none",
            shadow: 0,
            spinner: "off",
            stopLoop: "on",
            stopAfterLoops: 0,
            stopAtSlide: 1,
            shuffle: "off",
            autoHeight: "off",
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
