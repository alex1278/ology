/* Copyright (C) Aleksandr Glovatskyy, Mykolaiv, http://www.gnu.org/licenses/gpl.html GNU/GPL */


            
jQuery(function($) {
    "use strict";

$(function () {
                    // my code here
       $('.pgwSlideshow').pgwSlideshow(); // single article property slider

   });
  
 /* 
  * portfolio gallery with ajax loading
  * masonry style
  * start
  * 
  * freewall plugin
  */
    if(window.wallGutter !== undefined && window.wallFit  !== undefined && window.wallDraggable  !== undefined && window.wallAnimate  !== undefined && window.wallDelay  !== undefined && window.wallCellW  !== undefined && window.wallCellH  !== undefined) {
               
        $(function() {
            
                var wall = new Freewall("#freewall");
                wall.reset({
                        selector: '.brick',
                        draggable: wallDraggable,
                        animate: wallAnimate,
                        delay: wallDelay,
                        cellW: wallCellW,
                        cellH: wallCellH,
                        fixSize: null,
                        
                        gutterY: wallGutter,
                        gutterX: wallGutter,
                   
        //                onResize: function() {
        //                        wall.refresh();
        //                }
                        // fit height
                        onResize: function() {
                                if(wallFit=='height'){wall.fitHeight($(window).height() - 200);}
                                else if(wallFit=="zone"){
                                    wall.fitZone($(window).width() - 30 , $(window).height() - 60);
                                }
                        }
                });
                
                // caculator height for IE7;
                if(wallFit=='height'){
                    wall.fitHeight($(window).height() - 200);
                    $(window).trigger("resize");
                }else if(wallFit=="width"){
                    wall.fitWidth(); // fit width
                }else if(wallFit=="zone"){
                    wall.fitZone($(window).width() - 30 , $(window).height() - 60);
                }
                //wall.fillHoles();
                // ajax loading

                $('.ang-ajax-wreewall-pagination').on('click', function(){
                        $('#true_loadmore_freewall').text('').append('<p>Loading...&nbsp;</p><p class="uk-text-center uk-margin-small-top uk-margin-small-bottom"><i class="uk-icon-spinner uk-icon-spin uk-icon-large"></i></p>'); // change text of button
                        var data = {
                                'action': 'loadmore',
                                'query': true_posts_freewall,
                                'page' : current_page_freewall,
                                'template' : template_freewall,
                        };
                        $.ajax({
                                url: ajaxurl_freewall, // handler
                                data: data, // data
                                type: 'POST',
                                cache: false,
                                success:function(data){
                                        if( data ) { 
                                                $('#true_loadmore_freewall').html('<p>Show more</p><i class="upanddown" data-icon="&#xe07b;"></i>'); // insert text of button
                                                wall.prepend(data); // insert new posts
                                                current_page_freewall++; // increase the number of pages per unit

                                                if (current_page_freewall == max_pages_freewall) {
                                                    $("#true_loadmore_freewall").html('<p>No more !</p><i data-icon="&#xe07f;"></i>'); // if last page - remove a button
                                                    $('.ang-ajax-wreewall-pagination').off('click'); //remove event handler
                                                   //alert(current_page+ ' - that was the last page');
                                               }
                                        } else {
                                                $('#true_loadmore_freewall').html('<p>No more !</p><i data-icon="&#xe07f;"></i>').remove(); // if we are in the last page of posts, hide the button
                                                $('.ang-ajax-wreewall-pagination').off('click'); //remove event handler
                                        }
                                }
                        });
                });

                // freewall gallery filtering
                wall.filter("");
                $(".filter-label").click(function() {
                        $(".filter-label").removeClass("active");
                        var filter = $(this).addClass('active').data('filter');
                        if (filter) {
                                wall.filter(filter);
                        } else {
                                wall.unFilter();
                        }
                });

        });
        
                 
        /*
         * end freewall plugin
         * 
         * start jquery.nested plugin
         */
        
	$(function() { 
            $("#container").nested({
                selector: '.box',
                minWidth: 140,
                minColumn: 1,
                gutter: wallGutter,
                resizeToFit: true,
                resizeToFitOptions: { 
                  resizeAny: true
                },
                animate: wallAnimate,
                animationOptions: {
                speed: 100,
                duration: 250,
                queue: true,
                },
              });
            $('#prepend').click(function(){
              var boxes = makeBoxes();
              $('#container').prepend(boxes).nested('prepend',boxes);
            })
            $('#append').click(function(){
              var boxes = makeBoxes();
              $('#container').append(boxes).nested('append',boxes);     
            })

          });
          
    }
        /*
         * end nested plugin
         * 
         * end of portfolio gallery
         */
        
        
    // Set placeholder fo subscribe form in widget "Email Subscribers"
    function $subscribeAddPlaceholder(){

        //Subscribe form for Offline page
        var offline = $('.tm-offline-page');
        offline.find('.es_lablebox').each(function() {
            var getLabel = $(this).text();
            $(this).hide().next('.es_textbox').find('input').attr('placeholder', getLabel);
        });
        offline.find('.es_textbox_button').val('Notify me').addClass('uk-button ang-submit-butt');
    }
        
   
    
    
    
    /*
     * Activate functions on event
     */
    $(document).on('ready', function () {
        $subscribeAddPlaceholder();
    });
    
    
    
    
});