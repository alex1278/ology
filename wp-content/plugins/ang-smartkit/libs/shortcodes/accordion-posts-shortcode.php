<?php

/**
 * SHORTCODE :: Displays posts and categories with asinchronious pagination [accordion_posts]
 *
 * @package     main query loop
 * @subpackage  Shortcode/main query/ ANG
 * @copyright   Copyright (c) 2016, Aleksandr Glovatskyy
 * @since       1.0.0
 * @version     1.0.0
 * @date        12.03.2016
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * This shortcode allows you to specify post(s)
 * Accordion Shortcode:
 * [ accordion_posts ]  
 * Accordion Shortcode with parameters:
 * [ accordion_posts post_type="post" limit="6" sortby="comment_count" sort_order="ASC" extra_class="my-extra-class" pagination="off"]
 * You can also write text into shortcode:
 * [ accordion_posts ]  Taxonomy from custom post type. Should be a name like...  [ /accordion_posts ]  
 * 
 * Animation classes:
                .uk-animation-fade              The element fades in.
                .uk-animation-scale-up          The element scales up.
                .uk-animation-scale-down 	The element scales down.
                .uk-animation-slide-top 	The element slides in from the top.
                .uk-animation-slide-bottom 	The element slides in from the bottom.
                .uk-animation-slide-left 	The element slides in from the left.
                .uk-animation-slide-right 	The element slides in from the right.
                .uk-animation-shake             The element shakes.
                .uk-animation-scale             The element scales down without fading in.
 */

// Only load on front
if( is_admin() ) {
	return;
}

/* Displays Latest posts from selected category in tabs style */

    function ang_accordion_posts($atts, $content = null){
        extract(shortcode_atts(array(
                'post_type'                     =>	'post', // Any post type like "portfolio", "event", "testimonial", "slideshow", "product" - WooCommerce ready. Default is "post".
                'limit'				=>	'5', // Number of maximum posts to show for first and every next load. Integer.
                'animation_cls'                 =>      '', // Class to add when the element is in view. Available params: slide-top, slide-bottom, slide-left, slide-right, fade, shake, scale, scale-up, scale-down.
                'animation_delay'               =>      '0', // Integer. Delay time in ms. (150, 300, 500, 800)
                'animation_repeat'              =>      'false', // true or false
                'cat'                    	=>	'', // Category id separated by comma.
                'category_name'              	=>	'', // Category. Should be a name like 'fashion' or string of terms separated by comma. For 'portfolio' CPT use 'portfolio-type', 'portfolio_category' taxonomies.
                'taxonomy'              	=>	'', // Any Taxonomy from custom post type. Should be a name like 'fashion', enter only one taxonomy name. ('people', 'emotions', 'animals'). For 'event' CPT use 'event_cat' taxonomy.
                'taxonomy_term'              	=>	'', // Any Taxonomy terms from custom post type. Should be a name like 'fashion' or string of terms separated by comma. For 'event' CPT use 'event_cat' taxonomy terms.
                'sortby'			=>	'date', // Options: title, date, author, rand, modified, comment_count. Default state is date.
                'sort_order'			=>	'DESC', // ASC or DESC.
                'pagination'                    =>      'off', // "on", "ajax", "both" - will show ajax and ordinary pagination together, "off" to disable pagination.
                'wp_img_size'                   =>      'thumbnail', // Any registered WP image sizes. Only "uikit" template. ('main-blog-loop', 'music-blog-loop', 'literary-blog-loop', 'fashion-blog-loop')
                'link'                          =>      'off', //"on" or "off" to disable. Show button link to current post, on mouseover overlay. Available only for "uikit" template.
                'template'                      =>      'blog_acc', // 'post' is default template for photographer blog. (Blog tmpl: 'music_blog', 'fashion_blog', 'literary_blog', 'art_blog', 'night_blog', 'photo_blog';  Portfolio tmpl:'music', 'fashion', 'literary', 'art', 'night', 'event')
                
                'ya_share'                      =>      false, // Yandex social share buttons. Requers Ya.Share plugin.
                'meta_data'                     =>      false, // Show post meta data(date, comments).
                'excerpt'                       =>      true, // Show post short description if it is or post content if option 'content_words' is higher than '0'.
                'content_words'                 =>      0,  // Show entered number of content words insted of excerpt. Overrides option 'excerpt'.
                'extra_class'                   =>      '', // Enter extra class for custom styling.
                'offset'                        =>      0, // Query posts offset.
                'exclude'                       =>      '', // id separated by comma.
                'author'                        =>      '' // Set an integer, author id='25'.
	), $atts ) );
	
        ob_start();
        
        if(empty($post_type)) {
		return;
	}
        
        //start collecting args for WP_Query
        if( !is_array($post_type) ) {
		$post_type 			= array_map('trim',explode(',',$post_type) );
	}
        
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        $args = array (
                'post_type'           => $post_type,
                'posts_per_page'      => $limit,
                'paged'               => $paged,
                'ignore_sticky_posts' => 1,
                'offset'              => $offset,
        );
        
        // Category name for post type
	if(!empty($category_name) ) {
                $args['category_name'][] = $category_name;
	}
        
        // Category id for post type
	if(!empty($cat) ) {
                $args['cat'][] = $cat;
	}
        
        // get taxonomy terms list for CPT
        if(!empty($taxonomy) && empty($taxonomy_term)){
            // get all terms in the taxonomy
            $terms = get_terms( $taxonomy ); 
            // convert array of term objects to array of term IDs or slugs
            $term_slug = wp_list_pluck( $terms, 'slug' );
            $args['tax_query'][] = array(
				'taxonomy' => $taxonomy,
				'field' => 'slug',
				'terms' => $term_slug,
			);
        }
        
        // get taxonomy  and taxonomy terms for CPT
	if(!empty($taxonomy) && !empty($taxonomy_term)  ) {
		if( !is_array( $taxonomy_term ) ) {
			$taxonomy_term = explode(",", $taxonomy_term);
			$taxonomy_term = array_map('trim', $taxonomy_term);
			
			$args['tax_query'][] = array(
				'taxonomy' => $taxonomy,
				'field' => 'slug',
				'terms' => $taxonomy_term,
			);
		}
	}
        
        // query sorting parameters
        if( $sortby != '' ) {
	
		if($sortby == 'title'){
			$args['orderby']	=	'post_title';
			$args['order']		=	'DESC';
		} elseif($sortby == 'rand'){
			$args['orderby']	=	'rand';
			$args['order']		=	'DESC';
		} elseif($sortby == 'modified'){
			$args['orderby']	=	'modified';
			$args['order']		=	'DESC';
		} elseif($sortby == 'comment_count'){
			$args['orderby']	=	'comment_count';
			$args['order']		=	'DESC';
		} elseif($sortby == 'date'){
			$args['orderby']	=	'post_date';
			$args['order']		=	'DESC';

		} else{
                    $args['orderby']            =	$sortby;
                }
                
		$args['order']			=	$sort_order;
	}
        
        //exclude posts from main query
        if(!empty($exclude)) {
                $args['post__not_in'] = array($exclude);				
	}
        
        //get author args
        if(!empty($author)) {
                $args['author'] = $author;			
	}
        
        //get animation settings
        $blog_animation = "";
        if($animation_cls != '') {$blog_animation = 'data-uk-scrollspy="{cls:\'uk-animation-'.$animation_cls.'\', delay:'.$animation_delay.', repeat:'.$animation_repeat.'}"';}
        
        
        //require loop template
        if($post_type!= ''){
            global $woo_active;
                require load_template_path("accordion-posts-loop-template.php");
        }
       
        return ob_get_clean();
    }
    add_shortcode('accordion_posts', 'ang_accordion_posts');

