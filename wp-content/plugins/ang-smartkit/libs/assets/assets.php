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

function ang_smartkit_wp_enqueue_scripts() {
	$current_dir_path = plugins_url('', __FILE__ );
        
        if(shortcode_exists('portfolio_freewall') ) {
            wp_enqueue_script( 'freewall', $current_dir_path.'/js/freewall.js', array('jquery'), '', true);
            wp_enqueue_script( 'jquery.nested', $current_dir_path.'/js/jquery.nested.js', array('jquery'), '', true);
        }
        wp_enqueue_script( 'custom-ang', $current_dir_path.'/js/custom-ang.js', array(), '', true);
        wp_enqueue_script( 'true_loadmore', $current_dir_path.'/js/loadmore-epl.js', array(), '', true);

        wp_enqueue_script( 'pgwslideshow', $current_dir_path.'/js/pgwslideshow.js', array(), '', true);
}
add_action( 'wp_enqueue_scripts', 'ang_smartkit_wp_enqueue_scripts' );

function ang_smartkit_wp_enqueue_styles() {
	
        $current_dir_path = plugins_url('', __FILE__ );
        
        wp_enqueue_style('freewall', $current_dir_path . '/css/freewall-style.css' ,FALSE);
        
        if(shortcode_exists('portfolio_freewall') ) {
            wp_enqueue_style('simple-line-icons', $current_dir_path . '/css/simple-line-icons.css' ,FALSE);
        }
        wp_enqueue_style('flaticon-school', $current_dir_path . '/css/flaticon.css' ,FALSE);
	
}
add_action( 'wp_enqueue_scripts', 'ang_smartkit_wp_enqueue_styles' );