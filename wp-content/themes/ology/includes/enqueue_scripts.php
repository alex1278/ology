<?php
/*
* @encoding   UTF-8
* @author    Aleksandr Glovatskyy (aleksandr1278@gmail.com)
* @copyright  Copyright ( C ) 2015 torbara (http://torbara.com/). All rights reserved.
* @license  Copyrighted Commercial Software
* @support    support@torbara.com
*/

/*
 *  add scripts
 */
function ology_add_scripts() {
    global $warp;
    
    $current_theme_js_dir_path = WP_PLUGIN_URL .'/tt-warp7/warp/vendor/uikit/js';

    wp_enqueue_script( 'uikit', $current_theme_js_dir_path . '/uikit.js', array(), '', true);
    wp_enqueue_script( 'acordion', $current_theme_js_dir_path . '/components/accordion.js', array(), '', true);
    wp_enqueue_script( 'autocomplete', $current_theme_js_dir_path . '/components/autocomplete.js', array(), '', true);
    wp_enqueue_script( 'grid', $current_theme_js_dir_path . '/components/grid.js', array(), '', true);
    wp_enqueue_script( 'grid-parallax', $current_theme_js_dir_path . '/components/grid-parallax.js', array(), '', true);
    wp_enqueue_script( 'lightbox', $current_theme_js_dir_path . '/components/lightbox.js', array(), '', true);
    wp_enqueue_script( 'parallax', $current_theme_js_dir_path . '/components/parallax.js', array(), '', true);
    wp_enqueue_script( 'search', $current_theme_js_dir_path . '/components/search.js', array(), '', true);
    wp_enqueue_script( 'slider', $current_theme_js_dir_path . '/components/slider.js', array(), '', true);
    wp_enqueue_script( 'slideset', $current_theme_js_dir_path . '/components/slideset.js', array(), '', true);
    wp_enqueue_script( 'slideshow', $current_theme_js_dir_path . '/components/slideshow.js', array(), '', true);
    wp_enqueue_script( 'slideshow-fx', $current_theme_js_dir_path . '/components/slideshow-fx.js', array(), '', true);
    wp_enqueue_script( 'sticky', $current_theme_js_dir_path . '/components/sticky.js', array(), '', true);
    wp_enqueue_script( 'tooltip', $current_theme_js_dir_path . '/components/tooltip.js', array(), '', true);

    wp_enqueue_script( "comment-reply" );
    wp_enqueue_script( 'inview', get_template_directory_uri().'/js/jquery.inview.js', array(), '', true);
    wp_enqueue_script( 'easy-pie-chart', get_template_directory_uri().'/js/jquery.easypiechart.min.js', array(), '', true);
    //wp_enqueue_script( 'counterup', get_template_directory_uri().'/js/jquery.counterup.js', array(), '', true);
    wp_enqueue_script( 'fancySelect', get_template_directory_uri().'/js/fancySelect.js', array(), '', true);
   
    //wp_enqueue_script( 'waypoints', 'http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js', array(), '', true);
    
    if($warp['config']->get('style') == "default"){
        if ( file_exists( get_template_directory().'/js/theme.js' ) ) {
            wp_enqueue_script( 'ology-theme-js', get_template_directory_uri() . '/js/theme.js', array(), '', true);
        }
    }else{
        if ( file_exists( get_template_directory() . '/styles/'.$warp['config']->get('style').'/js/theme.js' ) ) {
            wp_enqueue_script( 'ology-theme-js', get_template_directory_uri() . '/styles/'.$warp['config']->get('style').'/js/theme.js', array(), '', true);
        }else{
            if ( file_exists( get_template_directory().'/js/theme.js' ) ) {
                wp_enqueue_script( 'ology-theme-js', get_template_directory_uri() . '/js/theme.js', array(), '', true);
            }
        }
        
    }
}
add_action('wp_enqueue_scripts', 'ology_add_scripts' );


/*
 *  add css
 */
function ology_add_css() {
    global $warp;
    
    $current_theme_css_dir_path = WP_PLUGIN_URL .'/tt-warp7/warp/vendor';
    
    if($warp['config']->get('style') == "default"){
        
        
        if ( file_exists( get_template_directory().'/css/woocommerce.css' ) ) {
            wp_enqueue_style( 'ology-woocommerce', get_template_directory_uri() . '/css/woocommerce.css');
        }
        if ( file_exists( get_template_directory().'/css/theme.css' ) ) {
            wp_enqueue_style( 'ology-theme', get_template_directory_uri() . '/css/theme.css');
        }
        if ( file_exists( get_template_directory().'/css/custom.css' ) ) {
            wp_enqueue_style( 'ology-custom', get_template_directory_uri() . '/css/custom.css');
        }
        
    }else{
        
        
        if ( file_exists( get_template_directory() . '/styles/'.$warp['config']->get('style').'/css/woocommerce.css' ) ) {
            wp_enqueue_style( 'ology-woocommerce', get_template_directory_uri() . '/styles/'.$warp['config']->get('style').'/css/woocommerce.css');
        }else{
            if ( file_exists( get_template_directory().'/css/woocommerce.css' ) ) {
                wp_enqueue_style( 'ology-woocommerce', get_template_directory_uri() . '/css/woocommerce.css');
            }
        }
        if ( file_exists( get_template_directory() . '/styles/'.$warp['config']->get('style').'/css/theme.css' ) ) {
            wp_enqueue_style( 'ology-theme', get_template_directory_uri() . '/styles/'.$warp['config']->get('style').'/css/theme.css');
        }else{
            if ( file_exists( get_template_directory().'/css/theme.css' ) ) {
                wp_enqueue_style( 'ology-theme', get_template_directory_uri() . '/css/theme.css');
            }
        }
        
        if ( file_exists( get_template_directory() . '/styles/'.$warp['config']->get('style').'/css/custom.css' ) ) {
            wp_enqueue_style( 'ology-custom', get_template_directory_uri() . '/styles/'.$warp['config']->get('style').'/css/custom.css');
        }else{
            if ( file_exists( get_template_directory().'/css/custom.css' ) ) {
                wp_enqueue_style( 'ology-custom', get_template_directory_uri() . '/css/custom.css');
            }
        }
        
    }    
    
    wp_enqueue_style( 'highlight', $current_theme_css_dir_path . '/highlight/highlight.css');
    
    }
add_action('wp_enqueue_scripts', 'ology_add_css',50);

