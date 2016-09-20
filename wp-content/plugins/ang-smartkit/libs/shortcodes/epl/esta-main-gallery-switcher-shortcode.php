<?php
/**
 * SHORTCODE :: Listing Category [gallery_listing_switcher]
 *
 * @package     ESTA
 * @subpackage  Shortcode/gallery
 * @copyright   Copyright (c) 2016, Aleksandr Glovatskyy
 * @since       1.1.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * This shortcode allows for you to specify the property type(s) using 
 * [gallery_listing_switcher post_type="property" status="current,sold,leased" category_key="property_rural_category" category_key="farm"] option. You can also 
 * limit the number of entries that display. using  [gallery_listing_switcher limit="5"]
 * Added Commercial Category Support 
 */
function renter_main_gallery_switcher( $atts ) {
	$property_types = epl_get_active_post_types();
	if(!empty($property_types)) {
		 $property_types = array_keys($property_types);
	}
	
	extract( shortcode_atts( array(
		'post_type' 			=>	$property_types,
		'status'			=>	array('current' , 'sold' , 'leased' ),
		'commercial_listing_type'	=>	'',
		'category_key'			=>	'',
		'category_value'		=>	'',
		'limit'				=>	'10', // Number of maximum posts to show
		'location'			=>	'', // Location slug. Should be a name like sorrento
		'sortby'			=>	'date', // Options: price, date : Default date
		'sort_order'			=>	'DESC',
                //'pagination'                    =>      'on', //ang
                'extra_class'                   =>      '', //ang
                'exclude'                       =>      '', //ang
                'author'                        =>      '' //ang
	), $atts ) );
	
        
	if(empty($post_type)) {
		return;
	}
	
	if(is_string($post_type) && $post_type == 'rental') {
		$meta_key_price = 'property_rent';
	} else {
		$meta_key_price = 'property_price';
	}
	
	$sort_options = array(
		'price'			=>	$meta_key_price,
		'date'			=>	'post_date'
	);
	if( !is_array($post_type) ) {
		$post_type 			= array_map('trim',explode(',',$post_type) );
	}
	ob_start();
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	$args = array(
		'post_type' 		=>	$post_type,
		'posts_per_page'	=>	$limit,
		'paged' 		=>	$paged
	);
        
	$args['posts_per_page'] = $limit * count($post_type);
        
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
	
	if( $sortby != '' ) {
	
		if($sortby == 'price') {
			$args['orderby']	=	'meta_value_num';
			$args['meta_key']	=	$meta_key_price;
		} elseif($sortby == 'date'){
			$args['orderby']	=	'post_date';
			$args['order']		=	'DESC';

		} else{
                    $args['orderby']	=	$sortby;
                }
                
		$args['order']			=	$sort_order;
	}
	
	
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
	if(!empty($exclude)) {
                $args['post__not_in'] = array($exclude);
					
	}
        if(!empty($author)) {
                $args['author'] = $author;
					
	}
        
	if($post_type!= ''){ ?>

    <div class="uk-grid" data-uk-observe>
         <div class="uk-width-1-1 loop epl-shortcode epl-clearfix ang-main-gal-wrap <?php echo $extra_class; ?>">  
         
                <div class="ang-gall-switcher-wrap">
                    <ul id="ang-main-gallery-switcher" class="uk-subnav uk-subnav-pill" data-uk-switcher="{connect:'#ang-gallery-switcher-content'}">
                        <li class="uk-active"><a class="uk-button uk-button-primary" href="#"><?php _e('All.', 'epl'); ?></a></li>
                        <?php
                        foreach ($post_type as $p_type) { ?>
                        <li class="" >
                            <a class="uk-button uk-button-primary" href="#"><?php echo str_ireplace("_", " ", $p_type); ?></a>
                        </li>
                     <?php  }
                        ?>
                         
                    </ul>
                </div>
             <ul id="ang-gallery-switcher-content" class="uk-switcher ang-main-gallery" >
                    
                    <?php $query_open = new WP_Query( $args ); 
                    $slide_count=0;
                         if ( $query_open->have_posts() ) {?>
                    <li class="all-properties">
                        <div class="uk-grid uk-grid-small uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 loop-content" data-uk-grid-margin data-uk-grid-match >
                     
                    <?php      
                    while ( $query_open->have_posts() ) {
                    $query_open->the_post();
                     $slide_count++;
                    global $post;
                    
                    // all posts loop
                    ?>
                    <?php require load_template_path("main-gallery-loop-template.php"); ?>
                            
                    <?php
                    // end of all posts loop
                    }
                    
                     ?>
                    </div>
                    
                    </li>
                <?php    } 
                    wp_reset_postdata(); ?>
                    
<!--                   new loop-->
                        <?php
                        foreach($property_types as $p_type){ ?>
                            <?php 
                            $args['post_type'] = $p_type;
                            $args['posts_per_page'] = $limit;
                            $query_open = new WP_Query( $args ); 
                         if ( $query_open->have_posts() ) {  ?>
                    <li class="<?php echo $p_type; ?>">
                        <div class="uk-grid uk-grid-small uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 loop-content<?php if(!is_array($p_type)){echo '-'.$p_type;}; ?>" data-uk-grid-margin data-uk-grid-match >
                     
                    <?php      
                    while ( $query_open->have_posts() ) {
                    $query_open->the_post();
                    global $post;
                    
                    // property type loop
                    ?>
                     
                    <?php require load_template_path("main-gallery-loop-template.php"); ?>
                    <?php 
                    //end of posts type loop
                    }
                     ?>
                    </div>
                    
                    </li>
                <?php    } 
                    wp_reset_postdata(); ?>
                     <?php   }
                        
                        ?>
                    </ul>             
            </div>
    </div>
        <?php }
        return ob_get_clean();
}
if($epl_active){
    add_shortcode( 'gallery_listing_switcher', 'renter_main_gallery_switcher' );
}


//function show_renter_main_gallery(){
//           echo get_renter_main_gallery();
//       }
//add_action( 'show_renter_main_gallery' , 'show_renter_main_gallery' , 10 );

