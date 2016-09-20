<?php

/**
 * SHORTCODE :: Displays theme layout positions demo page [layout_positions]
 *
 * @package     Torbata team demo tools
 * @subpackage  Shortcode/layout positions/ ANG Shorts
 * @copyright   Copyright (c) 2016, Aleksandr Glovatskyy
 * @since       1.0.0
 * @version     1.0.0
 * @date        12.03.2016
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
// Only load on front
if( is_admin() ) {
	return;
}
    // Show ninja
    function hello_ninja(){
               
        return "<h5><a href='http://ninja.bget.ru' onclick='window.open(this.href); return false;' title='Hello Alex' >WordPress Developer.</a> Aleksandr Glovatskyy. E-mail: alex1278@list.ru</h5>";
    }
     add_shortcode('ninja', 'hello_ninja');
     
    // WARP layout positions
    function layout_positions_html(){
        
        ob_start();
        //get current theme
        $my_theme = wp_get_theme();
        $theme_name = ucfirst($my_theme->get( 'Name' )).' '.$my_theme->get( 'Version' );
        
        include BANG_DOCS_TMP.'layout-positions-html.php';
        
        return ob_get_clean();
    }
    
    add_shortcode('layout_positions', 'layout_positions_html');
    
    // Blog Query posts shortcode
    function query_post_html(){
        
        ob_start();
        //get template
        
        include BANG_DOCS_TMP.'query-posts-blog-shortcode-docs.php';
        
        return ob_get_clean();
    }
    add_shortcode('ang_query_post_shortcode', 'query_post_html');
    
    // Portfolio gallery shortcode
    function portfolio_gallery_html(){
        
        ob_start();
        //get template
        
        include BANG_DOCS_TMP.'portfolio-gallery-shortcode-docs.php';
        
        return ob_get_clean();
    }
    add_shortcode('ang_portfolio_shortcode', 'portfolio_gallery_html');
    
    // Author box shortcode
    function author_box_html(){
        
        ob_start();
        //get template
        
        include BANG_DOCS_TMP.'author-box-shortcode-docs.php';
        
        return ob_get_clean();
    }
    add_shortcode('ang_author_box_shortcode', 'author_box_html');
    
    // Google map shortcode
    function google_map_html(){
        
        ob_start();
        //get template
        
        include BANG_DOCS_TMP.'google-map-shortcode-docs.php';
        
        return ob_get_clean();
    }
    add_shortcode('ang_google_map_shortcode', 'google_map_html');
    
    // Post tabs shortcode
    function post_tabs_html(){
        
        ob_start();
        //get template
        
        include BANG_DOCS_TMP.'post-tabs-shortcode-docs.php';
        
        return ob_get_clean();
    }
    add_shortcode('ang_post_tabs_shortcode', 'post_tabs_html');


