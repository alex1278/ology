<?php
/*
* @encoding   UTF-8
* @version    2.0.1
* @author    Aleksandr Glovatskyy (aleksandr1278@gmail.com)
* @copyright  Copyright ( C ) 2015 torbar (http://torbara.com/). All rights reserved.
* @license  Copyrighted Commercial Software
* @support    support@torbara.com
*/


/*******************************************************************************
                     Maintenance mode / start
*******************************************************************************/

/*
 *  Activate WordPress Maintenance Mode
 */
    function theme_maintenance_mode(){
        global $warp;
        if ( ! (stristr($_SERVER['REQUEST_URI'], '/wp-login') || stristr($_SERVER['REQUEST_URI'], '/wp-admin') || isset($_POST['_wpcf7']) || isset($_POST['es_email']) || isset($_POST['es_name']) ) ) {
            if( (!current_user_can('edit_themes') || !is_user_logged_in()) && ($warp['config']->get('maintenance_mode')=="0") ){
                echo $warp['template']->render('offline');         
                die();
            }
        }
    }
    add_action('init', 'theme_maintenance_mode', 20);

/*
 *  Register Custom Post Type
 */
    
if ( ! function_exists('custom_post_type_maintenance_mode') ) {
    
function custom_post_type_maintenance_mode() {

	$labels = array(
		'name'                  => _x( 'Maintenance Mode', 'Post Type General Name', 'ang-smartkit' ),
		'singular_name'         => _x( 'Offline Page', 'Post Type Singular Name', 'ang-smartkit' ),
		'menu_name'             => esc_html__( 'Maintenance Mode', 'ang-smartkit' ),
		'name_admin_bar'        => esc_html__( 'Maintenance Mode', 'ang-smartkit' ),
		'parent_item_colon'     => esc_html__( 'Parent Item:', 'ang-smartkit' ),
		'all_items'             => esc_html__( 'All Offline Pages', 'ang-smartkit' ),
		'add_new_item'          => esc_html__( 'Add New Offline Page', 'ang-smartkit' ),
		'add_new'               => esc_html__( 'Add New', 'ang-smartkit' ),
		'new_item'              => esc_html__( 'Offline Page', 'ang-smartkit' ),
		'edit_item'             => esc_html__( 'Edit Offline Page', 'ang-smartkit' ),
		'update_item'           => esc_html__( 'Update Offline Page', 'ang-smartkit' ),
		'view_item'             => esc_html__( 'View Offline Page', 'ang-smartkit' ),
		'search_items'          => esc_html__( 'Search Page', 'ang-smartkit' ),
		'not_found'             => esc_html__( 'Page Not found', 'ang-smartkit' ),
		'not_found_in_trash'    => esc_html__( 'Page Not found in Trash', 'ang-smartkit' ),
		'items_list'            => esc_html__( 'Pages list', 'ang-smartkit' ),
		'items_list_navigation' => esc_html__( 'Pages list navigation', 'ang-smartkit' ),
		'filter_items_list'     => esc_html__( 'Filter Pages list', 'ang-smartkit' ),
	);
	$args = array(
		'label'                 => esc_html__( 'Maintenance Mode', 'ang-smartkit' ),
		'description'           => esc_html__( 'Maintenance mode and offline pages', 'ang-smartkit' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', ),
		'taxonomies'            => array(),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 81,
                'menu_icon'             => 'dashicons-hammer',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'post',
	);
	register_post_type( 'maintenance_mode', $args );

}
add_action( 'init', 'custom_post_type_maintenance_mode', 0 );
}

/*
 * add theme support post thumbnails in maintenance_mode listing for admin
 */
add_filter('manage_edit-maintenance_mode_columns', 'maintenance_mode_listing', 5);
function maintenance_mode_listing($default1) {
    $default1['post_thumbnails'] = 'Image';
    return $default1;
}
 
/*
 *  maintenance_mode admin listing image size
 */
add_action('manage_maintenance_mode_posts_custom_column', 'maintenance_mode_custom_columns', 5, 2);
function maintenance_mode_custom_columns($row_label) {
    if ($row_label === 'post_thumbnails') :
        print the_post_thumbnail(array(100,100));
    endif;
}

/*******************************************************************************
                          Maintenance mode / end
*******************************************************************************/