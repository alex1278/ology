<?php
/**
 * SHORTCODE :: Listing Category [gallery_listing]
 *
 * @package     ESTA
 * @subpackage  Shortcode/gallery
 * @copyright   Copyright (c) 2016, Aleksandr Glovatskyy
 * @since       1.1.1
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Only load on front
if( is_admin() ) {
	return;
}
/**
 * This shortcode allows for you to specify the property type(s) using 
 * [gallery_listing post_type="property" status="current,sold,leased" category_key="property_rural_category" category_key="farm"] option. You can also 
 * limit the number of entries that display. using  [gallery_listing limit="5"]
 * Added Commercial Category Support 
 */
function renter_main_gallery( $atts ) {
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
        
	$query_open = new WP_Query( $args );
         if ( $query_open->have_posts() ) { ?>
         <div class="loop epl-shortcode epl-clearfix ang-main-gal-wrap">  
         <?php while ( $query_open->have_posts() ) {
                    $query_open->the_post();
                    global $post;
                    $Filterpositions [] = $post->post_type;
                }
         
         $Filterpositions = array_unique($Filterpositions);
                ?>
                <div class="ang-gall-filter-wrap">
                    <ul id="ang-main-gallery-filter" class="uk-tab uk-margin-small-bottom">
                        <li class="uk-active" data-uk-filter=""><a href="#">All</a></li>
                        <?php
                        foreach ($Filterpositions as $post_filter) { ?>
                        <li class="" data-uk-filter="<?php echo $post_filter; ?>">
                            <a href="#"><?php echo $post_filter; ?></a>
                        </li>
                     <?php  }
                        ?>
                        
                    </ul>
                </div> 
                <div class="ang-main-gallery-f <?php echo $extra_class; ?>">
                    <div class="uk-grid uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 loop-content" data-uk-grid="{controls: '#ang-main-gallery-filter', animation: 'uk-animation-fade'}">
                <?php while ( $query_open->have_posts() ) {
                    $query_open->the_post();
                    global $post;
                    ?>
                        
                    <?php
                // Store All Meta
                $meta = get_post_custom($post->ID);
                if(isset($meta['ANG_img-gallery'])) {
                    $g_img_ids = array_diff($meta['ANG_img-gallery'], array('')); //array with images IDs
                    if(!empty($g_img_ids)){

                        //get post thumbnail id
                        if ( has_post_thumbnail() ) {
                            $thumb_id = get_post_thumbnail_id( $post->ID );
                            $g_img_ids[] = $thumb_id; //add post thumbnail id;
                        }

                    $g_img_ids = array_unique($g_img_ids); // unique IDs array
                    $p_gallary = array(); // Array with images data
                        //$imgIDs_str = implode( ',', $meta['ANG_img-gallery'] );
                            //$imgIDs = explode(",", $imgIDs_str); // Images IDs
                    foreach ($g_img_ids as $g_img_id) {
                        $img_g_data = wp_prepare_attachment_for_js ( $g_img_id );
                            if ( $img_g_data == NULL ) { continue; } //If an ID picture is, and the image is not - skipping, we go to the next element of the array
                                $p_gallary[$img_g_data["title"]][] = $img_g_data;
                        }
                    ?>
                        
                    <div class="ang-main-gallery-item uk-margin-top" data-uk-observe data-uk-filter="<?php echo $post->post_type; ?>">
                        
                        
                        <div class="uk-slidenav-position " data-uk-slider="{animation: 'scroll'}">
                            <div class="uk-slider-container">
                            <ul class="uk-slider uk-grid-width-1-1">
                                <?php foreach ($p_gallary as $group) {
                                        foreach ($group as $img ) { ?>
                                <li class=""> 
                                    <?php $image_attributes = wp_get_attachment_image_src( $img["id"], 'gallery-slider' );
                                        // returned array
                                        ?> 
                                   <figure class="uk-overlay uk-overlay-hover">                                    
                                    <img src="<?php echo $image_attributes[0] ?>"
                                         width="<?php echo $image_attributes[1] ?>"
                                         height="<?php echo $image_attributes[2] ?>"
                                         alt="<?php echo $img["alt"]; ?>" 
                                         title="<?php echo $img["title"];?>">
                                         
                                    <figcaption class="uk-overlay-panel uk-overlay-background uk-text-center uk-overlay-fade">
                                        <div class="ang-gallery-item-overlay uk-height-1-1 uk-flex uk-flex-center uk-flex-middle">
                                            <a data-uk-lightbox="{group:'renter_gallery-<?php echo $post->ID; ?>'}" 
                                               data-lightbox-type="image" 
                                               title="<?php echo $img["title"]; ?>"
                                               href="<?php echo $img["url"]; ?>">
                                                <i class="uk-icon-search-plus"></i>
                                            </a>
                                            <a href="<?php the_permalink() ?>"><i class="uk-icon-eye"></i></a>
                                        </div>
                                    </figcaption>
                                </figure>
                                </li>
                                    
                              <?php } 
                                }
                            ?>
                            </ul>
                             </div>
                            <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slider-item="previous"></a>
                            <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slider-item="next"></a>
                        
                        </div>
                        <a class="ang-prop-link" href="<?php the_permalink() ?>">
                            <div class="ang-gal-info uk-text-center">
                                <h5 class="uk-margin-remove"><?php do_action('epl_property_heading'); ?></h5>
                                <p class="uk-margin-remove"> Type: 
                                    <?php do_action('epl_property_commercial_category'); ?>
                                </p>
                                
                                <p class="uk-margin-remove ang-gallery-item-location"><i class="uk-icon-map-marker"></i>
                                    <?php do_action('ang_property_address'); ?>
                                </p>
                            </div>
                        </a>
                        
                        </div>
                      <?php }
                        }
                    }
                ?>    
                    </div>
                </div>
                <?php if($pagination == 'on'){ ?>
                    <div class="loop-footer">
                            <?php do_action('epl_pagination', array('query'	=>	$query_open)); ?>
                    </div>
                <?php } ?>
            </div>
            <?php } 
            wp_reset_postdata();
        return ob_get_clean();

}
if($epl_active){
    add_shortcode( 'gallery_listing', 'renter_main_gallery' );
}




