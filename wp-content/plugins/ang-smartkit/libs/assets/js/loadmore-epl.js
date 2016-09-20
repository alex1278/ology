/* Copyright (C) Aleksandr Glovatskyy, Mykolaiv, http://www.gnu.org/licenses/gpl.html GNU/GPL */

jQuery(function($){
	$('#true_loadmore').click(function(){
		$(this).text('').append('Loading..&nbsp;&nbsp;&nbsp;<i class="uk-icon-spinner uk-icon-spin uk-icon-small"></i>'); // change text of button
		var data = {
			'action': 'loadmore',
			'query': true_posts,
			'page' : current_page,
                        'template' : template,
		};
		$.ajax({
			url: ajaxurl, // handler
			data: data, // data
                        
			type: 'POST',
                        cache: false,
                        // handle error
//            error: function (xhr, status, error) {
//                debugger;
//                alert(xhr.readyState);
//                alert(xhr.statusText);
//                alert(xhr.status);
//                alert(xhr.responseText);
//                alert(status);
//                alert(error);
//            },
			success:function(data){
				if( data ) {
					$('#true_loadmore').text('Load More'); // insert text of button
                                        //.before(data); // insert new posts
                                        $('.loop-content, .ang-search-wrapp, .tm-content > div.uk-grid > div').append(data); // insert new posts
					current_page++; // increase the number of pages per unit
                                        
					if (current_page == max_pages) {$("#true_loadmore").remove(); // if last page - remove a button
                                           //alert(current_page+ ' - that was the last page');
                                        }
				} else {
					$('#true_loadmore').remove(); // if we are in the last page of posts, hide the button
				}
			}
		});
	});
}); 

// Ajax pagination espesially for Torbara themes, shortcode [main_query_posts]

jQuery(function($){
        var clickButton = $('.true_loadmore_property');
            clickButton.click(function(){
                var clickButtonThis = $(this);
		var data = {
			'action':       'loadmore',
			'query':        true_posts_rent,
			'page' :        current_page_rent,
                        'template' :    template_rent,
                        'pImgSize' :    pImgSize_rent,
                        'pOverlayCls' : pOverlayCls_rent,
                        'pTitle' :      pTitle_rent,
                        'pLightbox' :   pLightbox_rent,
                        'pLink' :       pLink_rent,
		};
		$.ajax({
			url: ajaxurl_rent, // handler
			data: data, // data
			type: 'POST',
                        cache: false,
			success:function(data){
				if( data ) {
                                        clickButtonThis.parent().parent().prev('.ang-ajax-container').append(data); // insert new posts
					current_page_rent++; // increase the number of pages per unit
                                        //setTimeout($(window).trigger('resize'), 300); // initialize new group of downloaded items with window resize
                                        setTimeout(function(){ $(window).triggerHandler('resize')}, 800); // initialize new group of downloaded items with window resize
					if (current_page_rent == max_pages_rent) {clickButtonThis.remove(); // if last page - remove a button
                                           //alert(current_page+ ' - that was the last page');
                                        }
				} else {
					clickButtonThis.remove(); // if we are in the last page of posts, hide the button
				}
			}
		});
	});
}); 

// Ajax pagination espesially for Torbara themes, shortcode [main_query_posts]

jQuery(function($){
        var clickButton = $('.true_loadmore_blog');
            clickButton.click(function(){
                var clickButtonThis = $(this);
		var data = {
			'action':       'loadmore',
			'query':        true_posts,
			'page' :        current_page,
                        'template' :    template,
                        'warp_style' :  warp_style,
                        'pAnimation' :  pAnimation,
                        'pImgSize' :    pImgSize,
                        'pOverlayCls' : pOverlayCls,
                        'pTitle' :      pTitle,
                        'pLightbox' :   pLightbox,
                        'pLink' :       pLink,
		};
		$.ajax({
			url: ajaxurl, // handler
			data: data, // data
			type: 'POST',
                        cache: false,
			success:function(data){
				if( data ) {
                                        clickButtonThis.parent().parent().prev('.ang-ajax-container').append(data); // insert new posts
                                        $(".ang-woo-cart").find('a.button').addClass('add_to_cart_button ajax_add_to_cart'); // add special class for Woocommerce 'add to cart' button when new products was loaded.					current_page++; // increase the number of pages per unit
                                        //setTimeout($(window).trigger('resize'), 300); // initialize new group of downloaded items with window resize
                                        setTimeout(function(){ $(window).triggerHandler('resize')}, 800); // initialize new group of downloaded items with window resize
					if (current_page == max_pages) {clickButtonThis.remove(); // if last page - remove a button
                                           //alert(current_page+ ' - that was the last page');
                                        }
				} else {
					clickButtonThis.remove(); // if we are in the last page of posts, hide the button
				}
			}
		});
	});
}); 

       
      