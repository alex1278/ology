<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Shortcodes in post content
    add_filter('the_content', 'do_shortcode', 11);
// Shortcodes in default text widget
    add_filter('widget_text', 'do_shortcode');

/**
* Modify the Read More Link of archive pages which can be styled with 
* CSS using the epl-more-link selector
*
* @since 1.0
**/
function ang_new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'ang_new_excerpt_more');

function ang_new_excerpt_length( $length ) {
	return 20;
}
add_filter('excerpt_length', 'ang_new_excerpt_length');	


/**
 * Add Additional Contact methods to author pages. These links 
 * are used in the author widgets and profile boxes
 *
 * @since 1.0
 */
function ang_property_admin_contact ( $contactmethods ) {
        
        $contactmethods['mobile']	= __('Mobile', 'epl');
        $contactmethods['mobile2']	= __('Mobile-2', 'epl');
        $contactmethods['mobile3']	= __('Mobile-3', 'epl');
	
	return $contactmethods;
}
add_filter ('user_contactmethods','ang_property_admin_contact',10,1);
