<?php
/*
* @encoding   UTF-8
* @author    Aleksandr Glovatskyy (aleksandr1278@gmail.com)
* @copyright  Copyright ( C ) 2015 torbar (http://torbara.com/). All rights reserved.
* @license  Copyrighted Commercial Software
* @support    support@torbara.com
*/

if (!isset($content_width)) { $content_width = 1200; }

/*
 * Add theme support
 */    
function ology_add_support(){
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( "title-tag" );
    add_theme_support( 'post-thumbnails' );
    $defaults = array(
        'default-color'          => '',
        'default-image'          => '',
        'default-repeat'         => 'no-repeat',
        'default-position-x'     => 'left',
        'default-attachment'     => '',
        'wp-head-callback'       => '_custom_background_cb',
        'admin-head-callback'    => '',
        'admin-preview-callback' => ''
    );
    add_theme_support( 'custom-background', $defaults );
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
    // Add theme support for document Title tag
    add_theme_support( 'title-tag' );

    // Add theme support for custom CSS in the TinyMCE visual editor
    add_editor_style( get_template_directory_uri() .'/css/editor-style.css' );

    // Add theme support for Translation
    load_theme_textdomain( 'ology', get_template_directory() . '/languages' );
    add_post_type_support( 'page', 'excerpt' );
}
add_action('after_setup_theme', 'ology_add_support');


// add star rating custom field for tribe_events CPT
if(class_exists('tribeEventsMetafield')){
    /**
     * current class attributes
     * @param      string    $p_type        The name of CPT.
     * @param      string    $field_id      The ID of the meta field.
     * @param      string    $fiels_name    The name of this meta field.
     */
    $eventRating = new tribeEventsMetafield('tribe_events');
    $eventRating->add_hooks();
}
