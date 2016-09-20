<?php
/**
 * WIDGET :: Property Search
 *
 * @package     EPL
 * @subpackage  Widget/Search
 * @copyright   Copyright (c) 2014, Merv Barrett
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class ANG_EPL_Widget_Property_Search extends WP_Widget {
    
	function __construct() {
		parent::__construct( false, $name = __('EPL - Listing Search', 'epl') );
	}

	function widget($args, $instance) {
		
		$defaults = epl_search_get_defaults();
		$instance = wp_parse_args( (array) $instance, $defaults );
		 
		extract( $args );
		
		echo $before_widget;
		
		$title	= apply_filters('widget_title', $instance['title']);
		
		if ( $title ) {
			echo $before_title . $title . $after_title;			
		}
		
		echo ang_shortcode_listing_search_callback($instance);
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance 	= $old_instance;
		$all_fields = epl_search_widget_fields();
		foreach($all_fields as $all_field) {
			$instance[$all_field['key']] = epl_strip_tags($new_instance[$all_field['key']]);	
		}
		return $instance;
	}

	function form($instance) {
	
		$defaults 			= epl_search_get_defaults();
		$instance 			= wp_parse_args( (array) $instance, $defaults );
		$instance 			= array_map('epl_esc_attr',$instance);
		extract($instance);
		$post_types			= $post_type; 
		$fields 			= epl_search_widget_fields();
		
		foreach($fields as $field) {
			$field_value	=	${$field['key']};
			epl_widget_render_backend_field($field,$this,$field_value);
		}
	}
}
// activate widget if Easy-Property-Listing is active
if ( in_array( 'easy-property-listings/easy-property-listings.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    add_action( 'widgets_init', create_function('', 'return register_widget("ANG_EPL_Widget_Property_Search");') );
}
