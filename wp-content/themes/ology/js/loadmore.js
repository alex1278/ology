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
			success:function(data){
				if( data ) { 
					$('#true_loadmore').text('Load More'); // insert text of button
                                        $('.loop-content, .ang-search-wrapp, .tm-content > div.uk-grid > div').append(data); // insert new posts
					current_page++; // increase the number of pages per unit
					if (current_page == max_pages) {$("#true_loadmore").remove(); // if last page - remove a button
                                       }
				} else {
					$('#true_loadmore').remove(); // if we are in the last page of posts, hide the button
				}
			}
		});
	});
}); 

//infinite load

jQuery(function($){
	$(window).scroll(function(){
		var bottomOffset = 2000; // scroll offset from page bottom before loading new posts
		var data = {
			'action': 'loadmore_inf',
			'query': true_posts_inf,
			'page' : current_page_inf,
                        'template' : template_inf,
		};
		if( $(document).scrollTop() > ($(document).height() - bottomOffset) && !$('body').hasClass('loading')){
			$.ajax({
				url:ajaxurl_inf,
				data:data,
				type:'POST',
                                cache: false,
				beforeSend: function(xhr){
					$('body').addClass('loading');
				},
				success:function(data){
					if( data ) { 
                                                $('.loop-content, .ang-search-wrapp, .tm-content > div.uk-grid > div').append(data); //insert received data
						current_page_inf++; // increase the number of pages per unit
                                                if (current_page_inf == max_pages_inf)
                                                    $("#true_loadmore_inf").hide().remove(); // if last page - remove a button
                                                    $('body').removeClass('loading'); // if last page - remove a button additional class from body
                                        } else {
                                                $('#true_loadmore_inf').remove(); // if we are in the last page of posts, hide the button
                                        }  
                                }
                        });
                }
            });
});

       
      