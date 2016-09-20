<?php
/**
 * SHORTCODE :: Portfolio Freewall gallery  with asinchronious pagination [property_gallery]
 *
 * @package     ANG Themes
 * @subpackage  Shortcode/gallery
 * @copyright   Copyright (c) 2016, Aleksandr Glovatskyy
 * @author      Aleksandr Glovatskyy
 * @version     1.0.0
 * @date        13.04.2016
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * This shortcode allows you to specify portfolio post(s)
 * Portfolio Shortcode:
 * [ property_gallery ]  
 * Portfolio Shortcode with parameters:
 * [ property_gallery  limit="8" gutter="10" sortby="comment_count" sort_order="ASC" extra_class="my-extra-class" pagination="off" filter="off" template="freewall" wall_fit="height"]
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
function ang_realestate_gallery( $atts ) {
        // epl property post types
        $property_types = epl_get_active_post_types();
	if(!empty($property_types)) {
		 $property_types = array_keys($property_types);
	}
        //portfolio terms
        $portfolio_type_terms = get_portfolio_type_terms();
	extract( shortcode_atts( array(
		'post_type' 			=>	$property_types, // Any post type like "portfolio", "event", "testimonial", "slideshow". Defoult is "portfolio".
		'status'			=>	array('current' , 'sold' , 'leased' ),
		'commercial_listing_type'	=>	'',
		'category_key'                  =>	'',
		'category_value'		=>	'',
		'limit'				=>	'10', // Number of maximum posts to show for first and every next load. Integer.
		'location'			=>	'', // Location slug. Should be a name like sorrento
                'sortby'			=>	'date', // Options: price, title, date, rand, modified, comment_count. Default state is date.
		'sort_order'			=>	'DESC', // ASC or DESC.
                
                'template'                      =>      'property', // "property".
                'pagination'                    =>      'ajax', // "on", "ajax", "both", "off" to disable.
                'filter'                        =>      'on', // or "off" to disable. Available only for "freewall" and "uikit" template.
                'wp_img_size'                   =>      'full', // Any registered WP image sizes. Only "uikit" template. ('main-blog-loop', 'music-blog-loop', 'literary-blog-loop', 'fashion-blog-loop')
                'lightbox'                      =>      'on', //"on" or "off" to disable. Show button for fullscreen image view, on mouseover overlay. Available only for "uikit" template.
                'link'                          =>      'on', //"on" or "off" to disable. Show button link to current post, on mouseover overlay. Available only for "uikit" template.
                'title'                         =>      'off', //"on" or "off" to disable.  Show post title, on mouseover overlay. Available only for "uikit" template.
                'overlay_cls'                   =>      'art-style', //overlay classes. Available only for "uikit" template.
                'uk_grid_small'			=>	'1', // Affects device widths of 480px and higher. Maximum columns max=6, min=1, default=2.
                'uk_grid_medium'		=>	'2', // Affects device widths of 768px and higher. Maximum columns max=6, min=1, default=2.
                'uk_grid_large'			=>	'', // Affects device widths of 960px and higher. Maximum columns max=6, min=1, default=2.
                'uk_grid_xlarge'		=>	'', // Affects device widths of 1220px and higher. Maximum columns max=6, min=1, default=2.
                'uk_flex_gutter'                =>      'on', // "on". intager "off" to disable. Available only for "uikit" template. Gutter dafault value is 20px.
                
                'extra_class'                   =>      '', // enter extra class for custom styling.
                'exclude'                       =>      '', // id separated by comma.
                'author'                        =>      '' // set an integer, author id='25'.
	), $atts ) );
	
        ?>
<?php
	if(empty($post_type)) {
		return;
	}
        
// epl properties settings	
	if(is_string($post_type) && $post_type == 'rental') {
		$meta_key_price = 'property_rent';
	} else {
		$meta_key_price = 'property_price';
	}
	
	$sort_options = array(
		'price'			=>	$meta_key_price,
		'date'			=>	'post_date'
	);
        
        //start collecting args for WP_Query
	if( !is_array($post_type) ) {
		$post_type 			= array_map('trim',explode(',',$post_type) );
	}
        $do_not_duplicate= array();
	ob_start();
        
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	$args = array(
		'post_type' 		=>	$post_type,
		'posts_per_page'	=>	$limit,
		'paged' 		=>	$paged,
                'post__not_in'          =>      $do_not_duplicate,
	);
        
	//$args['posts_per_page'] = $limit * count($post_type);
        
        // epl property location taxonomy
        if(!empty($location) ) {
		if( !is_array( $location ) ) {
			$location = explode(",", $location);
			$location = array_map('trim', $location);
			
			$args['tax_query'][] = array(
				'taxonomy' => 'location',
				'field' => 'slug',
				'terms' => $location
			);
		}
	}
        // epl property Status taxonomy
	if(!empty($status)) {
		if(!is_array($status)) {
			$status = explode(",", $status);
			$status = array_map('trim', $status);
			
			$args['meta_query'][] = array(
				'key' => 'property_status',
				'value' => $status,
				'compare' => 'IN'
			);
		}
	}
	// epl property commertial listings
	if(!empty($commercial_listing_type)) {
		if(!is_array($commercial_listing_type)) {
			$commercial_listing_type = explode(",", $commercial_listing_type);
			$commercial_listing_type = array_map('trim', $commercial_listing_type);
			
			$args['meta_query'][] = array(
				'key' => 'property_com_listing_type',
				'value' => $commercial_listing_type,
				'compare' => 'IN'
			);
		}
	}
	
        // epl property categorie key taxonomy
	if(!empty($category_key) && !empty($category_value)) {
		if(!is_array($category_value)) {
			$category_value = explode(",", $category_value);
			$category_value = array_map('trim', $category_value);
			
			$args['meta_query'][] = array(
				'key' => $category_key,
				'value' => $category_value,
				'compare' => 'IN'
			);
		}
	}
	
        
        // query sorting parameters
	if( $sortby != '' ) {
                
                if($sortby == 'price') {
			$args['orderby']	=	'meta_value_num';
			$args['meta_key']	=	$meta_key_price;
                } elseif($sortby == 'title'){
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
	
	// epl properties GET sorting
	if( isset( $_GET['sortby'] ) ) {
		$orderby = sanitize_text_field( trim($_GET['sortby']) );
		if($orderby == 'high') {
			$args['orderby']	=	'meta_value_num';
			$args['meta_key']	=	$meta_key_price;
			$args['order']		=	'DESC';
		} elseif($orderby == 'low') {
			$args['orderby']	=	'meta_value_num';
			$args['meta_key']	=	$meta_key_price;
			$args['order']		=	'ASC';
		} elseif($orderby == 'new') {
			$args['orderby']	=	'post_date';
			$args['order']		=	'DESC';
		} elseif($orderby == 'old') {
			$args['orderby']	=	'post_date';
			$args['order']		=	'ASC';
		}
		
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
        
        // Define Gutter between uikit grid columns
        if($uk_flex_gutter === 'on'){
            $uk_flex_gutter = 'gutter: 20,';
        }elseif($uk_flex_gutter == 'off' || $uk_flex_gutter == 0){
            $uk_flex_gutter = '';
        }else{
            $uk_flex_gutter = "gutter: {$uk_flex_gutter},";
        }
        
        //require template
	if($post_type!= ''){
            require load_template_path("gallery-{$template}-loop-template.php");
        }
        return ob_get_clean();
}

if($epl_active){
    add_shortcode( 'property_gallery', 'ang_realestate_gallery' );
}