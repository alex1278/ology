<?php
/**
 * SHORTCODE :: Listing Category [renter_listing_category]
 *
 * @package     Renter
 * @subpackage  Shortcode/main
 * @copyright   Copyright (c) 2016, Aleksandr Glovatskyy
 * @since       1.1.1
 * @version     1.1.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Only load on front
if( is_admin() ) {
	return;
}
/**
 * This shortcode allows for you to specify the property type(s) using 
 * [renter_listing_category post_type="property" status="current,sold,leased" category_key="property_rural_category" category_key="farm"] option. You can also 
 * limit the number of entries that display. using  [renter_listing_category limit="5"]
 */
function ang_shortcode_listing_category_renter( $atts ) {
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
		'template'			=>	false, // Template can be set to "slim" for home open style template
		'location'			=>	'', // Location slug. Should be a name like sorrento
		'tools_top'			=>	'off', // Tools before the loop like Sorter and Grid on or off
		'tools_bottom'			=>	'off', // Tools after the loop like pagination on or off
		'sortby'			=>	'', // Options: price, date : Default date
		'sort_order'			=>	'DESC',
                'img_size'                      =>      100, // default thumbnail size. themplate "sidebar"
                'pagination'                    =>      'on', //ang
                'extra_class'                   =>      '', //ang Enter classes;
                'exclude'                       =>      '', //ang enter IDs;
                'view_position'                 =>      '', //ang. For example: 'sidebar';
                'author'                        =>      '' //ang enter author IDs;
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
		} else {
			$args['orderby']	=	'post_date';
			$args['order']		=	'DESC';

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
         if($view_position == 'sidebar'){
            ?>
        <div class="ang-loop epl-ang-property-sidebar-shortcode">
            <div class="ang-property-sidebar <?php echo $extra_class; ?>">
                <ul class="uk-grid uk-grid-width-1-1">
                    <?php
                        while ( $query_open->have_posts() ) {
                                    $query_open->the_post(); 
                                ?>
                    <li id="post-<?php the_ID(); ?>" class="">
                        <div class="tm-tab-content">
                            <div class="uk-margin-bottom uk-float-left tm-property-small">
                            <?php if ( has_post_thumbnail() ) : ?>
                                 <figure class="uk-overlay uk-overlay-hover">
                                    <?php the_post_thumbnail( array($img_size,$img_size), array( 'class' => 'ang-recent-deal-thumb uk-overlay-scale' ) ); ?>
                                    <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background uk-overlay-icon"></div>
                                    <a class="uk-position-cover" href="<?php the_permalink(); ?>"></a>
                                </figure>
                                <?php else: ?>
                                <figure class="uk-overlay uk-overlay-hover">
                                <?php
                                if(file_exists("wp-content/uploads/demo/imgo-400x400.jpg")){ ?>
                                    <img class="ang-recent-deal-thumb uk-overlay-scale ang-no-image" alt="alt" src="wp-content/uploads/demo/imgo-400x400.jpg" width="<?php print $img_size; ?>" height="<?php print $img_size; ?>" />
                                <?php }else { ?>
                                     <img class="ang-recent-deal-thumb uk-overlay-scale ang-no-image" alt="alt" src="<?php echo ang_load_img_url();?>imgo-400x400.jpg" width="<?php print $img_size; ?>" height="<?php print $img_size; ?>" />
                               <?php } ?>
                                    <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background uk-overlay-icon"></div>
                                    <a class="uk-position-cover" href="<?php the_permalink(); ?>"></a>
                                </figure>
                                    
                            <?php endif; ?>
                            </div>
                            <div class="uk-float-left tm-property-small-info">
                                <a href="<?php the_permalink(); ?>">
                                    <h5 class="entry-title"><?php do_action('epl_property_heading'); ?></h5>
                                    <div class="tm-property-price">
                                    <?php $val_to_rep = array("For Sale", "For Lease", "For Rent", "$");
                                          $val_rep = array("Sale &nbsp;", "Lease &nbsp;", "Rent &nbsp;", "&nbsp;$&nbsp;");
                                          echo str_ireplace($val_to_rep, $val_rep, epl_get_property_price()); 
                                    ?>
                                    </div>
                                    
                                    <div class="tm-property-address">
                                        <i class="uk-icon-map-marker"></i>
                                        <?php do_action('epl_property_tab_address'); ?>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>
                    <?php  } ?>
                </ul>
            </div>
        </div>
            <?php
            }else{
                if ( $query_open->have_posts() ) { ?>
                    <div class="loop epl-shortcode epl-clearfix">
                       <?php if ( $tools_top == 'on' ) {
                                        do_action( 'epl_property_loop_start' );
                                } ?>
                        <div class="loop-content ang-shortcode-listing-category epl-shortcode-listing-category <?php echo epl_template_class( $template ); ?> <?php echo $extra_class; ?>">
                            <?php
                                
                                while ( $query_open->have_posts() ) {
                                        $query_open->the_post();

                                        $template = str_replace('_','-',$template);
                                        epl_property_blog($template);
                                }
                                if ( $tools_bottom == 'on' ) {
                                        do_action( 'epl_property_loop_end' );
                                }
                            ?>
                        </div>
                        <?php if($pagination == 'on'){
                            ?>
                        <div class="loop-footer">
                                    <?php do_action('epl_pagination', array('query'	=>	$query_open)); ?>
                            </div>
                        <?php } ?>

                    </div>
                    <?php
                } elseif (!empty($author) ){
                    echo '<p>'._e('No properties by this agent.', 'epl').'</p>';
                } else {
                    echo '<h3>'.__('Nothing found, please check back later.', 'epl').'</h3>';
                }
            }
            wp_reset_postdata();
        return ob_get_clean();
}
if($epl_active){
    add_shortcode( 'renter_listing_category', 'ang_shortcode_listing_category_renter' );
}

