<?php
/*
 * actions that we removed or or overridden
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**************************** remove and add new actions *********************************/

function ang_property_featured_image( $attr, $image_size = 'fullscreen-single' , $image_class = 'ang-single-property-thumb' ) { 
	
	if ( has_post_thumbnail() ) { ?>
                <div class="epl-stickers-wrapper uk-clearfix">
                    <span class="uk-float-left"><?php echo epl_get_price_sticker(); ?></span>
                    <span class="uk-float-right"><?php echo ang_get_price_sticker_show(); ?></span>
                </div>
		<div class="entry-image">
			<div class="epl-featured-image it-featured-image">
                            <?php the_post_thumbnail( $image_size, array( 'class' => $image_class ) ); ?>
			</div>
		</div>
	<?php }

}
//remove_action('epl_property_featured_image', 'epl_property_featured_image', 10);
//remove_action('epl_single_featured_image', 'epl_property_featured_image', 10);
//add_action( 'epl_property_featured_image' , 'ang_property_featured_image' , 10, 2);
//add_action( 'epl_single_featured_image' , 'ang_property_featured_image' , 10, 2);

/**
 * Featured Image on archive template now loading through filter
 *
 * @since 2.2
 */
//ang
function ang_property_archive_featured_image( $image_size = 'epl-image-medium-crop' , $image_class = 'teaser-left-thumb' ) { 
	if($image_size == '') {
            $image_size = 'epl-image-medium-crop';
	} 
	if ( has_post_thumbnail() ) : ?>
		<div class="epl-archive-entry-image">
                    <a href="<?php the_permalink(); ?>">
                        <div class="epl-blog-image">
                            <div class="epl-stickers-wrapper">

                               <span class="uk-float-left"><?php echo epl_get_price_sticker(); ?></span>

                               <span class="uk-float-right"><?php //echo ang_get_price_sticker_show(); ?></span> 

                            </div>
                            
                            <?php the_post_thumbnail( 'epl-image-medium-crop', array( 'class' => 'teaser-left-thumb' )); ?>
                        </div>
                    </a>
		</div>
	<?php else: ?>
                           
                <div class="epl-archive-entry-image">
                    <a href="<?php the_permalink(); ?>">
                        <div class="epl-blog-image">
                            <div class="epl-stickers-wrapper">

                               <span class="uk-float-left"><?php echo epl_get_price_sticker(); ?></span>

                               <span class="uk-float-right"><?php echo ang_get_price_sticker_show(); ?></span>

                            </div>
                            <?php if(file_exists("wp-content/uploads/demo/imgo720x400.jpg")){ ?>
                                    <img class="teaser-left-thumb ang-no-image" alt="alt" src="wp-content/uploads/demo/imgo720x400.jpg" width="720" height="400" />
                                <?php }else { ?>
                                    <img class="teaser-left-thumb ang-no-image" alt="alt" src="<?php echo ang_load_img_url();?>imgo720x400.jpg" width="720" height="400" />
                               <?php } ?>
                        </div>
                    </a>
		</div>
   
<?php endif; 
}
//remove_action( 'epl_property_archive_featured_image' , 'epl_property_archive_featured_image' , 10);
//add_action( 'epl_property_archive_featured_image' , 'ang_property_archive_featured_image' , 10 , 2 );

function ang_property_tab_section_after() {
	global $property;
	$post_type = $property->post_type;
	if ( 'commercial' == $post_type || 'business' == $post_type || 'commercial_land' == $post_type) {
		
		$the_property_commercial_feature_list = '';
		$features_lists = array(
			'property_com_further_options',
			'property_com_highlight_1',
			'property_com_highlight_2',
			'property_com_highlight_3',
			'property_com_zone',
		);
		foreach($features_lists as $features_list){
			$the_property_commercial_feature_list .= $property->get_additional_commerical_features_html($features_list);
		}
	if($the_property_commercial_feature_list !=''){
	?>
		<div class="epl-tab-section epl-tab-section-commercial-features">
                    <h3 class="epl-tab-title-commercial-features tab-title uk-panel-title"><span><?php _e('Commercial Features', 'epl'); ?></span></h3>
			<div class="epl-tab-content tab-content">
				<div class="epl-commercial-features listing-info">
					<?php echo $the_property_commercial_feature_list; ?>							
				</div>
			</div>
        </div> <?php }
	} 
	
	if ( $property->post_type == 'rural') { 
		$the_property_rural_feature_list = '';
		$features_lists = array(
							'property_rural_fencing',
							'property_rural_annual_rainfall',
							'property_rural_soil_types',
							'property_rural_improvements',
							'property_rural_council_rates',
							'property_rural_irrigation',
							'property_rural_carrying_capacity',
		);
		foreach($features_lists as $features_list){
			$the_property_rural_feature_list .= $property->get_additional_rural_features_html($features_list);
		}
	
	?>
		<div class="epl-tab-section epl-tab-section-rural-features">
                    <h3 class="epl-tab-title-rural-features tab-title uk-panel-title"><span><?php _e('Rural Features', 'epl'); ?></span></h3>
			<div class="epl-tab-content tab-content">
				<div class="epl-rural-features listing-info">
					<?php echo $the_property_rural_feature_list; ?>							
				</div>
			</div>
		</div>
	<?php }
}
//remove_action('epl_property_tab_section_after','epl_property_tab_section_after'); 
//add_action('epl_property_tab_section_after','ang_property_tab_section_after');

/*
 * change epl switch view
 */

function ang_switch_views () { ?>
	<div class="epl-switch-view epl-clearfix">
            <span><?php _e('View:','epl'); ?></span>
            <ul>
                    <li title="<?php _e('Grid','epl'); ?>" class="view-grid" data-view="grid"><span><?php _e('Grid','epl'); ?></span></li>
                    <li title="<?php _e('List','epl'); ?>" class="epl-current-view view-list" data-view="list"><span><?php _e('List','epl'); ?></span></li>
            </ul>
	</div> <?php

}

/* 
 * change epl switch view and sorting panel
 */
function ang_switch_views_sorting() {
	$sortby = '';
	if(isset($_GET['sortby']) && trim($_GET['sortby']) != ''){
		$sortby = sanitize_text_field(trim($_GET['sortby']));
	}
	do_action('epl_archive_utility_wrap_start');
	$sorters = epl_sorting_options();
	?>
	<div class="epl-switching-sorting-wrap uk-align-medium-right epl-clearfix">
		
            <div class="epl-properties-sorting epl-clearfix"> <span><?php esc_html_e('Sort by:','epl'); ?></span>
			<select id="epl-sort-listings">
				<option <?php selected( $sortby, '' ); ?> value=""><?php esc_html_e('Sort','epl'); ?></option>
				<?php
					foreach($sorters as $sorter) { ?>
						<option <?php selected( $sortby, $sorter['id'] ); ?> value="<?php echo $sorter['id']; ?>">
							<?php echo $sorter['label']; ?>
						</option> <?php
					}
				?>
			</select>
		</div>
                <?php do_action('epl_add_custom_menus'); ?>
	</div>
	<?php
	do_action('epl_archive_utility_wrap_end');
}

/**
 * Video Output Function
 * @hooked property_after_content
**/
function ang_property_video_callback( $width = 600 ) {
	if(get_post_meta( get_the_ID(), 'property_video_url', true) != ""){ ?>
            <div id="property-video" class="epl-tab-section ang-single-video">
                <h3 class="uk-panel-title"><span><?php esc_html_e('Video','epl'); ?></span></h3>
                <?php 
                global $property;

                $video_width 		= $width != '' ? $width : 600;
                $property_video_url	= $property->get_property_meta('property_video_url');

                if($property_video_url != '') {
                    $videoID = epl_get_youtube_id_from_url($property_video_url);
                    echo '<div class="epl-video-container videoContainer">';
                        // Echo the embed code via oEmbed
                        echo wp_oembed_get( ('http://www.youtube.com/watch?v=' . $videoID ) , array( 'width' => apply_filters( 'epl_property_video_width', $video_width  ) )  ); 
                    echo '</div>';
                } ?>
            </div> 
        <?php }
}
//remove_action('epl_property_content_after','epl_property_video_callback' , 10 , 1);
//add_action('epl_property_content_after','ang_property_video_callback' , 10 , 1);


/** 
 * @hooked property_secondary_heading
**/
function ang_property_secondary_heading() {
	echo '<span class="epl-property-category">' .ang_get_property_category() . ' - </span> ';
	ang_property_address();
	

}
//remove_action('epl_property_secondary_heading','epl_property_secondary_heading');
//add_action('epl_property_secondary_heading','ang_property_secondary_heading');


/*
 * get short address
 */
function ang_property_address(){
    global $property;
    if($property->get_property_meta('property_address_suburb') != ''){
        echo ' <span class="suburb"> ' . $property->get_property_meta('property_address_suburb') . ', </span>';
    }
    if($property->get_property_meta('property_address_state') != ''){
	echo ' <span class="state">' . $property->get_property_meta('property_address_state') . '</span>';
    }
}
    //add_action('ang_property_address','ang_property_address');
    
    
/** 
 * @hooked property_land_category
**/
function ang_property_category(){
	//global $property;
	echo '<span class="ang-property-cut">'.esc_html__("Type:","epl").' </span><span class="ang-property-category"> '.ang_get_property_category().'</span>';
}

//remove_action('epl_property_land_category','epl_property_land_category');
//remove_action('epl_property_commercial_category','epl_property_commercial_category');
//add_action('epl_property_commercial_category','ang_property_category');


/*
 * get property type category
 */
function ang_get_property_category() {
    global $property;
    // property category
        if ( 'property' == $property->post_type || 'rental' == $property->post_type){
            if ( $property->get_property_meta('property_category') !='' ) {
                return epl_listing_meta_property_category_value( $property->get_property_meta('property_category') );
            }
    }
    // property rural category
        if ( 'rural' == $property->post_type){
            if ( $property->get_property_meta('property_rural_category') !='' ) {
                return epl_listing_load_meta_rural_category_value( $property->get_property_meta('property_rural_category') );
            }
    }
    // property land category
        if ( 'land' == $property->post_type ){
            if ( $property->get_property_meta('property_land_category') !='' ) {
                return epl_listing_meta_land_category_value( $property->get_property_meta('property_land_category') );
            }
    }
    // property commercial land category
        if ( 'commercial_land' == $property->post_type || 'commercial' == $property->post_type || 'business' == $property->post_type){
            if ( $property->get_property_meta('property_commercial_category') !='' ) {
                return epl_listing_load_meta_commercial_category_value( $property->get_property_meta('property_commercial_category') );
            }
    }
}


/*
 * EPL pagination hook
 */
function ang_pagination ($query = array() ) {
	global $epl_settings;
	if( isset($epl_settings['use_fancy_navigation'] ) && $epl_settings['use_fancy_navigation'] == 1)
            {
            epl_fancy_pagination($query);
        }elseif( isset($epl_settings['use_fancy_navigation'] ) && $epl_settings['use_fancy_navigation'] == 0)
            {
            epl_wp_default_pagination($query);
        }elseif( isset($epl_settings['use_fancy_navigation'] ) && $epl_settings['use_fancy_navigation'] == 2)
            {
            ang_wp_ajax_infinite_pagination($query);
        } else{
            ang_wp_ajax_pagination($query);
        }
	        
} //ang

//remove_action('epl_pagination','epl_pagination');
//add_action('epl_pagination','ang_pagination');
/*************************
 **************** Main hook to remove and add new hooks
 *************************/

/**
 * ANG Esta 1.8 fix 'htmlspecialchars' for agent contact-form shortcode text-field. Date 18.04.2016
 * Add Additional options to the author profiles for use in 
 * the author profile box
 *
 * @since 1.0
 */
function ang_add_custom_user_profile_fields( $user ) { ?>
	
	<h3><?php esc_html_e('Easy Property Listings: Author Box Profile', 'epl'); ?></h3>
	<p><?php esc_html_e('The following details will appear in your author box and widgets.', 'epl'); ?></p>
	
	<table class="form-table">
		<?php
			$user_fields = epl_get_custom_user_profile_fields();
			
			foreach($user_fields as $user_field ) { ?>
				<tr>
					<th>
						<label for="<?php echo $user_field['name'] ?>">
							<?php echo $user_field['label'] ?>
						</label>
					</th>
					<td>
						<input 
							type="text" 
							name="<?php echo $user_field['name'] ?>" 
							id="<?php echo $user_field['name'] ?>" 
                                                        value="<?php echo htmlspecialchars(get_the_author_meta( $user_field['name'], $user->ID ), ENT_COMPAT); ?>" 
							class="regular-text" 
						/><br />
						<span class="description">
							<?php 
								echo isset ($user_field['description']) ?  $user_field['description'] : '';
							?>
						</span>
					</td>
				</tr> <?php
			}
		?>
	</table>
<?php }


function ang_after_epl_hooks() { // write here action you wish to add or remove
    $rem = remove_action('epl_property_tab_section_after', 'epl_property_tab_section_after');
    $add = add_action('epl_property_tab_section_after', 'ang_property_tab_section_after');
    
    $rem2 = remove_action('epl_property_featured_image', 'epl_property_featured_image', 10);
    $rem3 = remove_action('epl_single_featured_image', 'epl_property_featured_image', 10);
    $add2 = add_action( 'epl_property_featured_image' , 'ang_property_featured_image' , 10);
    $add3 = add_action( 'epl_single_featured_image' , 'ang_property_featured_image' , 10);
    
    $remove_result = remove_action( 'epl_property_archive_featured_image', 'epl_property_archive_featured_image', 10);
    $add_result = add_action( 'epl_property_archive_featured_image', 'ang_property_archive_featured_image', 10);
    
    $rem_buttons1 = remove_action('epl_buttons_single_property', 'epl_button_external_link');
    $rem_buttons2 = remove_action('epl_buttons_single_property', 'epl_button_floor_plan');
    $rem_buttons3 = remove_action('epl_buttons_single_property', 'epl_button_mini_web');
    $rem_buttons4 = remove_action('epl_buttons_single_property', 'epl_buttons_wrapper_before' , 1);
    $rem_buttons5 = remove_action('epl_buttons_single_property', 'epl_buttons_wrapper_after' , 99);
    $rem_gallery = remove_action('epl_property_gallery', 'epl_property_gallery');
    $add_gallery = add_action('epl_property_gallery', 'ang_property_gallery');
    
    //$rem_author_box1 = remove_action( 'epl_single_before_author_box', 'epl_single_before_author_box' );
    //$rem_author_box2 = remove_action('epl_single_after_author_box', 'epl_single_after_author_box');
    $rem_author_box3 = remove_action( 'epl_single_author' , 'epl_property_author_box' , 10 );
    $add_author_box3 = add_action('epl_single_author', 'ang_property_author_box' , 10);
    
    $rem_pre1 = remove_action( 'pre_get_posts', 'epl_property_author_archives' );
    $rem_pre2 = remove_action('pre_get_posts', 'epl_custom_post_author_archive');
    
    remove_action('epl_property_content_after','epl_property_video_callback' , 10 , 1);
    add_action('epl_property_content_after','ang_property_video_callback' , 10 , 1);
    
    add_action('epl_property_content_after','ang_floor_plan_from_link'); // floor plan from links
    add_action('epl_property_content_after','ang_show_floor_plans'); // alternative with media loader
    
    remove_action('epl_add_custom_menus','epl_switch_views',1);
    add_action('epl_add_custom_menus','ang_switch_views',1);
    
    remove_action( 'epl_property_loop_start' , 'epl_switch_views_sorting' , 20 );
    add_action( 'epl_property_loop_start' , 'ang_switch_views_sorting' , 20 );
    
    remove_action('epl_property_land_category','epl_property_land_category');
    remove_action('epl_property_commercial_category','epl_property_commercial_category');
    add_action('epl_property_commercial_category','ang_property_category');
    
    remove_action('epl_property_secondary_heading','epl_property_secondary_heading');
    //add_action('epl_property_secondary_heading','ang_property_secondary_heading');
    
    remove_action('epl_pagination','epl_pagination');
    add_action('epl_pagination','ang_pagination');
    
    
    add_action('ang_property_address','ang_property_address');
    
    remove_action('epl_property_icons','epl_property_icons');
    
    remove_filter('excerpt_length', 'epl_excerpt_length' , 999);
    remove_filter('excerpt_more', 'epl_property_new_excerpt_more');
    
    remove_action( 'show_user_profile', 'epl_add_custom_user_profile_fields' );
    remove_action( 'edit_user_profile', 'epl_add_custom_user_profile_fields' );
    add_action( 'show_user_profile', 'ang_add_custom_user_profile_fields' );
    add_action( 'edit_user_profile', 'ang_add_custom_user_profile_fields' );
    
    // check actions
  
}
add_action('plugins_loaded','ang_after_epl_hooks');
add_action('init','ang_after_epl_hooks');

//unregister EPL widgets and any other widget
function ang_deregister_epl_widget() {
    unregister_widget( 'EPL_Widget_Author' );
    unregister_widget( 'EPL_Widget_Property_Gallery' );
    unregister_widget( 'EPL_Widget_Property_Search' );
}
add_action( 'widgets_init', 'ang_deregister_epl_widget', 11 );  
