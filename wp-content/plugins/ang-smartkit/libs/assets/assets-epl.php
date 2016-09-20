<?php
/**
 * Scripts & Styles
 *
 * @subpackage  Scripts/Styles
 * @copyright   Copyright (c) 2015, Aleksandr Glovatskyy
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Load and enqueue admin scripts and stylesheets
 */
/*
function epl_admin_enqueue_scripts($screen) {
	
	$current_dir_path = plugins_url('', __FILE__ );
	
	if( $screen == 'post.php' || $screen == 'post-new.php' || $screen == 'easy-property-listings_page_epl-extensions' ||  $screen == 'easy-property-listings_page_epl-settings' ||  $screen= 'easy-property-listings_page_epl-extensions') {
		
		wp_enqueue_style(	'epl-jquery-validation-engine-style', 		$current_dir_path . '/css/validationEngine-jquery.css' );
		wp_enqueue_script(	'epl-jquery-validation-engine-lang-scripts', 	$current_dir_path . '/js/jquery-validationEngine-en.js', array('jquery') );
		wp_enqueue_script(	'epl-jquery-validation-engine-scripts', 	$current_dir_path . '/js/jquery-validationEngine.js', 	array('jquery') );
		wp_enqueue_script(	'jquery-datetime-picker',			$current_dir_path . '/js/jquery-datetime-picker.js', 	array('jquery') );
		wp_enqueue_style(	'jquery-ui-datetime-picker-style',  		$current_dir_path . '/css/jquery-ui.min.css');
		wp_enqueue_script( 	'epl-admin-scripts', 				$current_dir_path . '/js/jquery-admin-scripts.js', 	array('jquery'),	EPL_PROPERTY_VER );
		wp_enqueue_style( 	'epl-admin-styles', 				$current_dir_path . '/css/style-admin.css',		FALSE,			EPL_PROPERTY_VER );

	} 
	
	// load admin style on help & documentation pages as well
	if($screen = 'edit.php' || $screen == 'toplevel_page_epl-general' || $screen == 'dashboard_page_epl-about' || $screen == 'dashboard_page_epl-getting-started')	{
		wp_enqueue_style( 'epl-admin-styles', 					$current_dir_path . '/css/style-admin.css',		FALSE,			EPL_PROPERTY_VER );
	}
}
add_action( 'admin_enqueue_scripts', 'epl_admin_enqueue_scripts' );

/**
 * Load and enqueue front end scripts and stylesheets
 */

function ang_smartkit_epl_enqueue_scripts() {
	
	
	$current_dir_path = plugins_url('', __FILE__ );
        
        global $epl_settings;
        if ( !wp_script_is( 'jquery-front-scripts.js', 'enqueued' ) ) {
               wp_enqueue_script( 'epl-front-scripts', $current_dir_path . '/js/jquery-front-scripts.js', array('jquery'), '', true );
        }else{
            wp_dequeue_script( 'epl-front-scripts' );
            wp_deregister_script( 'epl-front-scripts' );
            wp_enqueue_script( 'epl-front-scripts', $current_dir_path . '/js/jquery-front-scripts.js', array('jquery'), '', true );
        }
        
        if( isset($epl_settings['use_fancy_navigation'] ) && $epl_settings['use_fancy_navigation'] == 2){
            wp_enqueue_script( 'true_loadmore_inf', $current_dir_path.'/js/loadmore-inf-epl.js', array(), '', true);
        }
         
	$epl_posts = array('property','land', 'commercial', 'business', 'commercial_land' , 'location_profile','rental','rural', 'post');
        if( is_singular($epl_posts) ) {
           //code here
           
        }
        if( is_singular($epl_posts) && shortcode_exists('listing_map') ) {
            //code here
        }
        
}
add_action( 'wp_enqueue_scripts', 'ang_smartkit_epl_enqueue_scripts' );

function ang_smartkit_epl_enqueue_styles() {
	global $epl_settings;
	$current_dir_path = plugins_url('', __FILE__ );
	$epl_posts = array('property','land', 'commercial', 'business', 'commercial_land' , 'location_profile','rental','rural');
        
	if( is_singular($epl_posts) ) {
	
            //wp_enqueue_style(	'epl-front-styles', $current_dir_path . '/css/style-front.css' ,FALSE, EPL_PROPERTY_VER);
        }
}
add_action( 'wp_enqueue_scripts', 'ang_smartkit_epl_enqueue_styles' );