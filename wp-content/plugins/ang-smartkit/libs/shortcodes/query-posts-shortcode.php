<?php

/**
 * SHORTCODE :: Displays posts and categories with asinchronious pagination [main_query_posts]
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
 * Blog Shortcode:
 * [ main_query_posts ]  
 * Blog Shortcode with parameters:
 * [ main_query_posts post_type="post" limit="6" columns="4" gutter="medium" sortby="comment_count" sort_order="ASC" extra_class="my-extra-class" pagination="off" grid_parallax="500" ]
 * You can also write text into shortcode:
 * [ main_query_posts ]  Taxonomy from custom post type. Should be a name like...  [ /main_query_posts ]  
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

    function ang_wp_query_posts($atts, $content = null){
        extract(shortcode_atts(array(
                'post_type'                     =>	'post', // Any post type like "portfolio", "event", "testimonial", "slideshow", "tribe_events", "product" - WooCommerce ready. Default is "post".
                'limit'				=>	'6', // Number of maximum posts to show for first and every next load. Integer.
                'uk_grid_small'			=>	'1', // Affects device widths of 480px and higher. Maximum columns max=6, min=1, default=2.
                'uk_grid_medium'		=>	'2', // Affects device widths of 768px and higher. Maximum columns max=6, min=1, default=2.
                'uk_grid_large'			=>	'', // Affects device widths of 960px and higher. Maximum columns max=6, min=1, default=2.
                'uk_grid_xlarge'		=>	'', // Affects device widths of 1220px and higher. Maximum columns max=6, min=1, default=2.
                'gutter'                        =>      '', // Available params: collapse, small, medium, large.
                'animation_cls'                 =>      '', // Class to add when the element is in view. Available params: slide-top, slide-bottom, slide-left, slide-right, fade, shake, scale, scale-up, scale-down.
                'animation_delay'               =>      '0', // Integer. Delay time in ms. (150, 300, 500, 800)
                'animation_repeat'              =>      'false', // true or false
                'cat'                    	=>	'', // Category id separated by comma.
                'category_name'              	=>	'', // Category. Should be a name like 'fashion' or string of terms separated by comma. For 'portfolio' CPT use 'portfolio-type', 'portfolio_category' taxonomies.
                'taxonomy'              	=>	'', // Any Taxonomy from custom post type. Should be a name like 'fashion', enter only one taxonomy name. ('people', 'emotions', 'animals'). For 'event' CPT use 'event_cat' taxonomy.
                'taxonomy_term'              	=>	'', // Any Taxonomy terms from custom post type. Should be a name like 'fashion' or string of terms separated by comma. For 'event' CPT use 'event_cat' taxonomy terms.
                'taxonomy_2'              	=>	'', // Any Taxonomy from custom post type. Should be a name like 'fashion', enter only one taxonomy name. ('people', 'emotions', 'animals'). For 'event' CPT use 'event_cat' taxonomy.
                'taxonomy_term_2'              	=>	'', // Any Taxonomy terms from custom post type. Should be a name like 'fashion' or string of terms separated by comma. For 'event' CPT use 'event_cat' taxonomy terms.
                'sortby'			=>	'date', // Options: title, date, author, rand, modified, comment_count. Default state is date.
                'sort_order'			=>	'DESC', // ASC or DESC.
                'pagination'                    =>      'ajax', // "on", "ajax", "both" - will show ajax and ordinary pagination together, "off" to disable pagination.
                'grid_parallax'                 =>      '', //set an integer without comma and quotes (150, 200, 300, etc.), disabled by default, default value is '150' if set not a number. Not supported with ajax pagination.
                'wp_img_size'                   =>      'full', // Any registered WP image sizes. Only "uikit" template. ('main-blog-loop', 'music-blog-loop', 'literary-blog-loop', 'fashion-blog-loop')
                'lightbox'                      =>      'on', //"on" or "off" to disable. Show button for fullscreen image view, on mouseover overlay. Available only for "uikit" template.
                'link'                          =>      'on', //"on" or "off" to disable. Show button link to current post, on mouseover overlay. Available only for "uikit" template.
                'title'                         =>      'off', //"on" or "off" to disable.  Show post title, on mouseover overlay. Available only for "uikit" template.
                'overlay_cls'                   =>      '', //overlay classes. Available only for "uikit" template.
                //'filter'                        =>      'on', //"on" or "off" to disable.
                //'uk_flex_gutter'                =>      'on', //"on" or "off" to disable.
                'template'                      =>      'post', // 'post' is default template for photographer blog. (Blog tmpl: 'music_blog', 'fashion_blog', 'literary_blog', 'art_blog', 'night_blog', 'photo_blog';  Portfolio tmpl:'music', 'fashion', 'literary', 'art', 'night', 'event'; Events tmpl: 'classes')
                
                'extra_class'                   =>      '', // Enter extra class for custom styling.
                'exclude'                       =>      '', // id separated by comma.
                'author'                        =>      '' // Set an integer, author id='25'.
	), $atts ) );
	
        
        if(empty($post_type)) {
		return;
	}
        
        ob_start();
                
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
//            var_dump($terms);
//            var_dump($term_slug);
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
        
        // get second taxonomy  and second taxonomy terms for CPT
	if(!empty($taxonomy_2) && !empty($taxonomy_term_2)  ) {
		if( !is_array( $taxonomy_term_2 ) ) {
			$taxonomy_term_2 = explode(",", $taxonomy_term_2);
			$taxonomy_term_2 = array_map('trim', $taxonomy_term_2);
			
			$args['tax_query'][] = array(
				'taxonomy' => $taxonomy_2,
				'field' => 'slug',
				'terms' => $taxonomy_term_2,
			);
		}
	}
        
        if(!empty($taxonomy) && !empty($portfolio_type) ) {
            $args['tax_query']['relation'] = 'AND';
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
        
        
        // Apply uk-grid-width parameters and create grid classes
        
        $uk_grid_small = ($uk_grid_small > 0 && $uk_grid_small < 7) ? ' uk-grid-width-small-1-'.$uk_grid_small :'';
        $uk_grid_medium = ($uk_grid_medium > 0 && $uk_grid_medium < 7) ? ' uk-grid-width-medium-1-'.$uk_grid_medium :'';
        $uk_grid_large = ($uk_grid_large > 0 && $uk_grid_large < 7) ? ' uk-grid-width-large-1-'.$uk_grid_large :'';
        $uk_grid_xlarge = ($uk_grid_xlarge > 0 && $uk_grid_xlarge < 7) ? ' uk-grid-width-xlarge-1-'.$uk_grid_xlarge :'';
        
        //get animation settings
        $blog_animation = '';
        if($animation_cls != '') {$blog_animation = 'data-uk-scrollspy="{cls:\'uk-animation-'.$animation_cls.'\', delay:'.$animation_delay.', repeat:'.$animation_repeat.'}"';}
        
        
        //require loop template
        if($post_type!= ''){
            global $woo_active;
                require load_template_path("query-posts-post-loop-template.php");
        }
       
        return ob_get_clean();
    }
    add_shortcode('main_query_posts', 'ang_wp_query_posts');
