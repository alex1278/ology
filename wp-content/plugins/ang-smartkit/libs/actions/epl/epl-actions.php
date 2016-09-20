<?php

/*
 * small actions
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/****************
 * function displays author box in single page
 */
 
// AUTHOR CARD : Tabbed Style
function ang_property_author_box() {
	global $property,$epl_author,$epl_author_secondary;
	epl_get_template_part('single-content-author-tall.php');
    if($property != NULL) {
        $property_second_agent = $property->get_property_meta('property_second_agent');
            if ( '' != $property_second_agent ) {
                $second_author = get_user_by( 'login' , $property_second_agent );
                if($second_author !== false){
                        $epl_author_secondary = new EPL_Author_meta($second_author->ID);
                        epl_get_template_part('single-content-author-tall.php',array('epl_author'	=>	$epl_author_secondary));
                }
                epl_reset_post_author();
            }
    }
}

add_action( 'ang_single_author' , 'ang_property_author_box' , 10 );

/**
 * Ability to hide author box on single listings
 *
 * @since 2.1.11
 */
function ang_hide_author_box_from_front() {
	$epl_posts 		= epl_get_active_post_types();
	$epl_posts 		= array_keys($epl_posts);
	
	global $post,$property;
	
	if( is_single() && in_array($post->post_type,$epl_posts) ) {
		
		$hide_author_box = get_post_meta($post->ID,'property_agent_hide_author_box',true);
		if($hide_author_box == 'yes') {
			remove_all_actions( 'ang_single_author' );
		}
	}
}
add_action('wp','ang_hide_author_box_from_front',10);

/*
 * add 'excerpt' support  for 'testimonial' post type (use 'quick-and-easy-testimonials' plugin for wordpress)
 */

function ang_testimonial_excerpt_support() {
	add_post_type_support( 'testimonial', 'excerpt' );
}
add_action('init', 'ang_testimonial_excerpt_support');

/*
 * get property inspection times
 */

function ang_inspection_times(){
   global $property;
   $property_inspection_times = $property->get_property_inspection_times();
    if ((trim($property_inspection_times) != '') || ( 'rental' == $property->post_type && $property->get_property_meta('property_date_available') != '' && $property->get_property_meta('property_status') != 'leased' )) 
        { 
    ?>
        <div class="property-meta">
            <?php do_action('epl_property_available_dates'); // meant for rent only   ?>								
            <?php do_action('epl_property_inspection_times'); ?>
        </div>
    <?php  
        
        }
}
add_action('ang_inspection_times', 'ang_inspection_times' );
