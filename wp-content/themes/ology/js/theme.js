/* 
 * Author: Aleksandr Glovatskyy
 * Author e-mail: alex1278@list.ru
 * Author URI: http://themeforest.net/user/torbara/portfolio/?ref=torbara
 * Copyright (C) Aleksandr Glovatskyy, http://www.gnu.org/licenses/gpl.html GNU/GPL 
 */

jQuery(function($) {
    "use strict";
    
    var config = $('html').data('config') || {};
    
    // fix UiKit slider for RTL to LRT
    UIkit.on('beforeready.uk.dom', function () {
        UIkit.$('[data-uk-slideset],[data-uk-slider]').attr('dir', 'ltr');
    });
    
    /*-----------------------------------------------------------------------------------*/
    /* Page PreLoader
    /*-----------------------------------------------------------------------------------*/
    
    $(window).load(function () {
            $(".preloader-wrap").delay(300).fadeOut("slow", function () {
            $(this).remove();
        });
    });
        
    // Bottom fullscreen mega slider hover navigation 
    function fullSliderNavHover(){
        $(".ang-html-absolute").hover(function(){
                $(".ang-html-absolute .uk-slidenav").css({'display':'block', 'z-index': '9999' }); 
                }, function() {
                $(".ang-html-absolute .uk-slidenav").css({'display':'none', 'z-index': '0' }); 
              }
        );
    }
        
    // infinite background scroll
    function infiniteBgScroll(){
        $(".tm-backgroundScroll-x").parent().parent().parent().addClass("backgroundScrollX");
        $(".tm-backgroundScroll-y").parent().parent().parent().addClass("backgroundScrollY");
    }
    
    // form styler
    function themeFancySelect(){
        $(".epl-search-form select").fancySelect();
        $(".epl-search-form input[type='number']").fancySelect();
    }
    
    //trigger once when object becomes visible, team member skills archive page
    // Defaults
    
    $('.ang-member-progress-group').one("inview", function(e) {
        var settings = {
            'time': 4,
        };
        $(this).find('p .ang-team-progress-val').each(function() {
            var $this = $(this);
            var nums = [];
            var getProgressVal = $this.parent().data('team-progress'); // get data value
            getProgressVal = getProgressVal.toString().replace(/,/g, '.'); // convert to string and replace commas with dot.
            getProgressVal = parseFloat(getProgressVal).toFixed(); //convert back to float
            
            // Generate list of incremental numbers to display
            for (var i = settings.time * 4; i >= 1; i--) {             
                var newNum = Math.round(getProgressVal / (settings.time * 4) * i); // round value if it is float
                nums.unshift(newNum);
            }
            var interval = settings.time / nums.length * 1000;
            
            $this.data('ang-nums', nums);
            $this.text('0');
       
            var fanc = function(){
                $this.text($this.data('ang-nums').shift() + '%');
                if ($this.data('ang-nums').length) {
                    setTimeout($this.data('ang-func'), interval);
                }
            };
            $this.data('ang-func', fanc);
            // Start counting
            setTimeout($this.data('ang-func'), interval);
            // Activate progress bar
            $(this).parent().next('.uk-progress').find('.uk-progress-bar').css({'width':getProgressVal + '%', 'transition-duration':settings.time +'s', 'transition-timing-function': 'ease-in'});

        });

    });
    
    
    // displays inview statistic
    $(".tm-data-circle").one("init.uk.scrollspy", function(isVisible) {
        // counter up for circular progress bars
        $('.countThis') .counterUp({
            delay: 5,
            time: 1200
        });
    
        //Draw animated circular progress bars
        $('div[data-circle-value]').each(function() {
            $(this).circleProgress({
                value: $(this).attr('data-circle-value'),
                size: 180,
                fill: {gradient: ["#fff", "#fff"]},
                animation: { duration: 5000, easing: 'circleProgressEasing' }
            });
        });    
    
    });

    //displays easy pie chart om inviev
    jQuery(".ang-easypiechart").one("inview", function(isVisible) {
        jQuery('.chart').easyPieChart({
            //your options goes here
            
            barColor:'rgba(84, 180, 230, 1)',
            scaleLength:0,
            lineWidth:5,
            lineCap:'circle',
            size:160,
            rotate:0,
            animate:{
                duration:6000,
                enabled:true,
            },
            easing:
                'easeOutBounce',
                onStep: function(from, to, percent) {
                        jQuery(this.el).find('.percent').text(Math.round(percent));
            },
            
        });
        
    });
    
    $(".ang-achievements-wrapp").one("init.uk.scrollspy", function(isVisible) {
        // counter up for Achievements
        $('.countIvents') .counterUp({
            delay: 10,
            time: 1200
        });
    
    });
    
    // Vedeo cover and play button
     jQuery('.presentation-wrap .info .play').on('click', function(ev) {
        jQuery(this).parent().parent().fadeOut();   
        jQuery("#video")[0].src += "&autoplay=1";
        ev.preventDefault();
        jQuery(".video-wrap").fadeIn();
      });
      
      
    // window resizer for gallery switcher
    jQuery("#ang-main-gallery-switcher li a").click(function (){
        jQuery(window).trigger('resize');
    });
    
    /*************
     * Toggle map hide and show
     */
    function toggleMapButt(){
        $("#chpok-map").toggle(
          function () {
            $('#map-id').slideUp(600);
            $(this).html('<i class="uk-icon-chevron-down uk-margin-small-right"></i><span>Show map</span>')
          },
          function () {
            $('#map-id').slideDown(600);
            $(this).html('<i class="uk-icon-chevron-up uk-margin-small-right"></i><span>Close map</span>')
          }
        );
    }
    
    /*************
     * Toggle filter hide and show
     */
    function toggleFilterButt(){
        $("#chpok-filter").toggle(
          function () {
            $('#filter-id').slideDown(600);
            $(this).html('<i class="uk-icon-chevron-up uk-margin-small-right"></i><span>Close filter</span>')
          },
          function () {
            $('#filter-id').slideUp(600);
            $(this).html('<i class="uk-icon-chevron-down uk-margin-small-right"></i><span>Show filter</span>')
          }
        );
    }
    
    //smooth scroll button appears on scroll
    function smoothScrollAppear(){
        if( $(document).scrollTop() > 1500 ){
            $('.tm-my-totop-scroller').css({'position':'fixed'});
        }else{
            $('.tm-my-totop-scroller').css({'position':'absolute'});
        }
    }
    
    // content slider scrollable box auto height
    function sliderScrollableBg() {
        var h = $('.ang-cont-slider-thumb').height();
        var panelH = $('.ang-get-height').height();
        var panelOuterH = $('.ang-get-height').outerHeight();
        $('.uk-scrollable-box').height(h - (panelOuterH - panelH));
    }
    
     // Single property listing accordion
    function singleListingAccordion(){
        $('.epl-commercial-features, .epl-rural-features').addClass('uk-accordion').attr('data-uk-accordion', '');
        $('.epl-commercial-features h6, .epl-rural-features h6').addClass('uk-accordion-title');
        $('.epl-commercial-features p, .epl-rural-features p').addClass('uk-accordion-content');
        
    }
    function eplSearchWidgetWrapper(){
        $(".widget_epl_property_search >*:not(h3)").wrapAll("<div class='ang-search-wrapper'></div>");
        $(".widget_ang_epl_property_search >*:not(h3)").wrapAll("<div class='ang-search-wrapper'></div>");
    }
    
    
    //Check if sidebar active and change a grid in main position
    function gridWithSidebar(){
        if($('body').hasClass('tm-sidebars-1')){
            $('.loop-content').addClass('ang-body-sidebars-1')
        }else if($('body').hasClass('tm-sidebars-2')){
            $('.loop-content').addClass('ang-body-sidebars-2')
        }else{$('.loop-content').addClass('ang-no-body-sidebar')}
    }
    
    // enabel uk-height-viewport fo elm google map
    function elmGoogleMapViewportHeight(){
        $('.ang-height-viewport-map .map_container').addClass('uk-height-viewport').removeAttr("style");
        var h = $('.ang-height-viewport-map .map_container').height();
        $('.ang-height-viewport-map, .ang-height-viewport-map .google-maps').height(h);
    }
    
    // testimonials page uikit markup
    function testimonialsPage(){
        $(".ang-testimonials-wrapp .qe-testimonial-wrapper").wrap("<div class='ang-testimonials-grid-wrapp'></div>");
    }
    
    
    // sidebar calendar widget. Add class for tabel cell with link
    function widgetCalendarClass(){
        $('.widget_calendar').find('tbody td a').parent('td').addClass('ang-calendar-link-bg');
    }
    
    // Ang most popular posts change DOM position
    function changeTimeTagPosition(){
        jQuery('aside .ang-popular-meta').each(function() {
            jQuery(this).prependTo($(this).parent());
        });
    }
    
    // The event calendar plugin, Change img src for popup event
    function changePopupEventImgSrc(){
        jQuery('.tribe-events-calendar .has-post-thumbnail').each(function(){
            var data_json = jQuery(this).data('tribejson');
            data_json['imageTooltipSrc'] = data_json['imageTooltipSrc'].replace('-150x150', '');
            jQuery(this).data('tribejson', data_json);
        });
    }
    

    // window load
    $(window).on('load', function () {
        sliderScrollableBg();
        $('.epl-search-btn').addClass('uk-button uk-button-primary'); // add classes for Filter button
    });
    
    // window scroll
    $(window).on('scroll', function () {
        smoothScrollAppear();
    });
    
    // window resize
    $(window).on('resize', function () {
        sliderScrollableBg();
        elmGoogleMapViewportHeight();
    });
    // doc ready
    $(document).on('ready', function () {
        singleListingAccordion();
        toggleFilterButt();
        toggleMapButt();
        fullSliderNavHover();
        infiniteBgScroll();
        gridWithSidebar();
        eplSearchWidgetWrapper();
        elmGoogleMapViewportHeight();
        testimonialsPage();
        themeFancySelect();
        widgetCalendarClass();
        changeTimeTagPosition();
        changePopupEventImgSrc();
    });
    
});

// comments respond js

        jQuery(function ($) {

            var respond = $("#respond");

            $("span.js-reply > a").bind("click", function () {

                var id = $(this).attr('rel');

                respond.find(".comment-cancelReply:first").remove();

                $("<a>CANCEL</a>").addClass('comment-cancelReply').addClass('uk-button uk-button-primary uk-margin-bottom-remove uk-text-bold uk-border-rounded uk-width-1-1 uk-margin-top').attr('href', "#respond").bind("click", function () {
                    respond.find(".comment-cancelReply:first").remove();
                    respond.appendTo($('#comments')).find("[name=comment_parent]").val(0);

                    return false;
                }).appendTo(respond.find(".actions:first"));

                respond.find("[name=comment_parent]").val(id);
                respond.appendTo($("#comment-" + id));

                return false;

            });
        });