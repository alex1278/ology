<?php


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// get plugin path
function load_plugin_dir_path(){
    $plugin_dir_path = BANG_PLUGIN_DIR;
    return $plugin_dir_path;
}

// get plugin  template path
function load_template_path($template){
    $temp_path = BANG_TEMPLAT_DIR.$template;
    return $temp_path;
}

//get plugin image url
function ang_load_img_url(){
    $temp_url = BANG_IMG_URL;
    return $temp_url;
}
//get plugin js url
function ang_load_js_url(){
    $js_url = BANG_JS_URL;
    return $js_url;
}
//get plugin css url
function ang_load_css_url(){
    $css_url = BANG_CSS_URL;
    return $css_url;
}

// rus to lat translit
if(!function_exists('rus2translit')) {
    function rus2translit($string) {
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => '',    'ы' => 'y',   'ъ' => '',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => '',    'Ы' => 'Y',   'Ъ' => '',
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        );
        return strtr($string, $converter);
    }
}

// transliterate from res to lat character -> to lowercase, replase spaces, trim first and last slashes
if(!function_exists('translit_tolower_replace_trim')) {
    function translit_tolower_replace_trim($rus2lat) {
        if(function_exists('rus2translit')) {
            $rus2lat = rus2translit($rus2lat);
        }
        $rus2lat = mb_strtolower($rus2lat, 'utf-8');
        $rus2lat = str_replace(' ', '-', $rus2lat);
        $rus2lat = trim($rus2lat, "-");
        return $rus2lat;
    }
}

// portfolio post type  admin panel support


add_filter('manage_edit-portfolio_columns', 'portfolio_listing', 5);
function portfolio_listing($default1) {
    $default1['post_thumbnails'] = 'Image';
    return $default1;
}
 
//image size
add_action('manage_portfolio_posts_custom_column', 'portfolio_custom_columns', 5, 2);
function portfolio_custom_columns($row_label, $id) {
    if ($row_label === 'post_thumbnails') :
        print the_post_thumbnail(array(85,85));
    endif;
}

// sortable columns
add_filter('manage_edit-portfolio_sortable_columns', 'add_portfolio_sortable_column');
function add_portfolio_sortable_column($sortable_columns){
	$sortable_columns['post_thumbnails'] = 'Image';

	return $sortable_columns;
}

// post type support
    add_post_type_support( 'portfolio', array('page-attributes', 'author', 'excerpt','comments') );

// Logo post type admin panel support

// post type support
    
        add_post_type_support( 'kwlogos', array('editor') );
        

/* 
 * posts custom columns attachment id
 */

add_filter('manage_media_columns', 'posts_columns_attachment_id', 1);
add_action('manage_media_custom_column', 'posts_custom_columns_attachment_id', 1, 2);
function posts_columns_attachment_id($defaults){
    $defaults['wps_post_attachments_id'] = __('ID');
    return $defaults;
} //add function
function posts_custom_columns_attachment_id($column_name, $id){
        if($column_name === 'wps_post_attachments_id'){
        echo $id;
    }
}
    
/**
 * Register image sizes for the admin list of property 
 * and a hard cropped 300x200 px image for use in widgets
 *
 * @since 1.0
 */

/******************************************************************************
                         Remove and add new image sizes
*******************************************************************************/

function ang_image_sizes() {

    if ( function_exists( 'add_image_size' ) ) {
         remove_image_size('medium_large');
         remove_image_size('large');
       
        add_image_size( 'fullscreen-single', '1200', '600', true );
//        add_image_size( 'tab-content', '160', '110', true );
//        add_image_size( 'agent-size-box', '170', '170', true );
//        add_image_size( 'sidebar-agent', '100', '100', true );
//        add_image_size( 'renter-caregory', '300', '200', true );
       add_image_size( 'gallery-slider', '700', '500', true );
       add_image_size( 'event-loop', '700', '400', true );
//        add_image_size( 'featured-slider', '500', '330', true );
       add_image_size( 'main-blog-loop', '600', '600', true );
    }
	
}
add_action( 'init', 'ang_image_sizes' );

/******************************************************************************
        Add new registred image size to image library of admin menu
*******************************************************************************/

 $sizes = array( 'id'			=>	'fullscreen-single',
//                 'id'			=>	'tab-content',
//                 'id'			=>	'agent-size-box',
//                 'id'			=>	'sidebar-agent',
                 'id'			=>	'gallery-slider',
                 'id'			=>	'event-loop',
//                 'id'			=>	'featured-slider',
//                 'id'			=>	'renter-caregory',
                 'id'			=>	'main-blog-loop',
                );
 
function ang_custom_sizes($sizes) {
	return array_merge( $sizes, array(

                'fullscreen-single' => 'Single image crop',
//                'tab-content' => 'Tab image crop',
//                'agent-size-box' => 'Agent box crop',
//                'sidebar-agent' => 'Sidebar crop',
//                'renter-caregory' => 'Category archive crop',
                'gallery-slider' => 'Gallery slider crop',
                'event-loop' => 'Event crop',
//                'featured-slider' => 'Featured slider crop',
                'main-blog-loop' => 'Photo image crop',
	) );
}
add_filter( 'image_size_names_choose', 'ang_custom_sizes' );
 
//special function for debuging

function ang_debug($debug){
    print "<pre>";
    var_dump($debug);
    print "</pre>";
}