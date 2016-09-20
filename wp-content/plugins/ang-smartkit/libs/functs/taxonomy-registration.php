<?php

    
    
/******************************************************************************
        Register taxonomy for custom post type "portfolio"
*******************************************************************************/


if ( ! function_exists( 'custom_taxonomy_partners' ) ) {

// Register Custom Taxonomy 'partnes' for portfolio
function custom_taxonomy_partners() {

	$labels = array(
		'name'                       => _x( 'Partners', 'Taxonomy General Name', 'ang-plugins' ),
		'singular_name'              => _x( 'Partner', 'Taxonomy Singular Name', 'ang-plugins' ),
		'menu_name'                  => __( 'Partners', 'ang-plugins' ),
		'all_items'                  => __( 'All Partners', 'ang-plugins' ),
		'parent_item'                => __( 'Parent Partner', 'ang-plugins' ),
		'parent_item_colon'          => __( 'Parent Partner:', 'ang-plugins' ),
		'new_item_name'              => __( 'New Partner Name', 'ang-plugins' ),
		'add_new_item'               => __( 'Add New Partner', 'ang-plugins' ),
		'edit_item'                  => __( 'Edit Partner', 'ang-plugins' ),
		'update_item'                => __( 'Update Partner', 'ang-plugins' ),
		'view_item'                  => __( 'View Partner', 'ang-plugins' ),
		'separate_items_with_commas' => __( 'Separate Partners with commas', 'ang-plugins' ),
		'add_or_remove_items'        => __( 'Add or remove Partners ', 'ang-plugins' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'ang-plugins' ),
		'popular_items'              => __( 'Popular Partners', 'ang-plugins' ),
		'search_items'               => __( 'Search Partners', 'ang-plugins' ),
		'not_found'                  => __( 'Not Found', 'ang-plugins' ),
		'items_list'                 => __( 'Partners list', 'ang-plugins' ),
		'items_list_navigation'      => __( 'Partners list navigation', 'ang-plugins' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'partners', array( 'portfolio' ), $args );

}
//add_action( 'init', 'custom_taxonomy_partners', 0 );

}

if ( ! function_exists( 'custom_taxonomy_team_departments' ) ) {

// Register Custom Taxonomy 'departments' for portfolio
function custom_taxonomy_team_departments() {

	$labels = array(
		'name'                       => _x( 'Team Departments', 'Taxonomy General Name', 'ang-plugins' ),
		'singular_name'              => _x( 'Team Department', 'Taxonomy Singular Name', 'ang-plugins' ),
		'menu_name'                  => __( 'Team Departments', 'ang-plugins' ),
		'all_items'                  => __( 'All Team Departments', 'ang-plugins' ),
		'parent_item'                => __( 'Parent Department', 'ang-plugins' ),
		'parent_item_colon'          => __( 'Parent Department:', 'ang-plugins' ),
		'new_item_name'              => __( 'New Team Department Name', 'ang-plugins' ),
		'add_new_item'               => __( 'Add New Team Department', 'ang-plugins' ),
		'edit_item'                  => __( 'Edit Team Department', 'ang-plugins' ),
		'update_item'                => __( 'Update Team Department', 'ang-plugins' ),
		'view_item'                  => __( 'View Team Department', 'ang-plugins' ),
		'separate_items_with_commas' => __( 'Separate Departments with commas', 'ang-plugins' ),
		'add_or_remove_items'        => __( 'Add or remove Team Departments ', 'ang-plugins' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'ang-plugins' ),
		'popular_items'              => __( 'Popular Team Departments', 'ang-plugins' ),
		'search_items'               => __( 'Search Team Departments', 'ang-plugins' ),
		'not_found'                  => __( 'Not Found', 'ang-plugins' ),
		'items_list'                 => __( 'Team Departments list', 'ang-plugins' ),
		'items_list_navigation'      => __( 'Team Departments list navigation', 'ang-plugins' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'team_departments', array( 'portfolio', 'team' ), $args );

}
//add_action( 'init', 'custom_taxonomy_team_departments', 0 );

}

// Register Custom Taxonomy 'features' for 'portfolio'
if ( ! function_exists( 'custom_taxonomy_portfolio_features' ) ) {

function custom_taxonomy_features() {

	$labels = array(
		'name'                       => _x( 'Features', 'Taxonomy General Name', 'ang-plugins' ),
		'singular_name'              => _x( 'Feature', 'Taxonomy Singular Name', 'ang-plugins' ),
		'menu_name'                  => __( 'Features', 'ang-plugins' ),
		'all_items'                  => __( 'All Features', 'ang-plugins' ),
		'parent_item'                => __( 'Parent Feature', 'ang-plugins' ),
		'parent_item_colon'          => __( 'Parent Feature:', 'ang-plugins' ),
		'new_item_name'              => __( 'New Feature Name', 'ang-plugins' ),
		'add_new_item'               => __( 'Add New Feature', 'ang-plugins' ),
		'edit_item'                  => __( 'Edit Feature', 'ang-plugins' ),
		'update_item'                => __( 'Update Feature', 'ang-plugins' ),
		'view_item'                  => __( 'View Feature', 'ang-plugins' ),
		'separate_items_with_commas' => __( 'Separate Features with commas', 'ang-plugins' ),
		'add_or_remove_items'        => __( 'Add or remove Features ', 'ang-plugins' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'ang-plugins' ),
		'popular_items'              => __( 'Popular Features', 'ang-plugins' ),
		'search_items'               => __( 'Search Features', 'ang-plugins' ),
		'not_found'                  => __( 'Not Found', 'ang-plugins' ),
		'items_list'                 => __( 'Features list', 'ang-plugins' ),
		'items_list_navigation'      => __( 'Features list navigation', 'ang-plugins' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'portfolio_features', array( 'portfolio' ), $args );

}
add_action( 'init', 'custom_taxonomy_features', 0 );

}

// Register Custom Taxonomy 'portfolio-category' for 'portfolio'
if ( ! function_exists( 'custom_taxonomy_portfolio_category' ) ) {

// Register Custom Taxonomy
function custom_taxonomy_portfolio_category() {

    $slug = defined( 'PANG_TAX_PORTCAT_SLUG' ) ? PANG_TAX_PORTCAT_SLUG : 'portfolio-category';

        // Label for 'favorite-category' taxonomy
	$labels = apply_filters( 'ang_portfolio_category_labels', array(
		'name'                       => _x( 'Portfolio Categories', 'Taxonomy General Name', 'ang-plugins' ),
		'singular_name'              => _x( 'Portfolio Category', 'Taxonomy Singular Name', 'ang-plugins' ),
		'menu_name'                  => __( 'Portfolio Categories', 'ang-plugins' ),
		'all_items'                  => __( 'All Portfolio Categories', 'ang-plugins' ),
		'parent_item'                => __( 'Parent Portfolio Category', 'ang-plugins' ),
		'parent_item_colon'          => __( 'Parent Portfolio Category:', 'ang-plugins' ),
		'new_item_name'              => __( 'New Portfolio Category Name', 'ang-plugins' ),
		'add_new_item'               => __( 'Add New Portfolio Category', 'ang-plugins' ),
		'edit_item'                  => __( 'Edit Portfolio Category', 'ang-plugins' ),
		'update_item'                => __( 'Update Portfolio Category', 'ang-plugins' ),
		'view_item'                  => __( 'View Portfolio Category', 'ang-plugins' ),
		'separate_items_with_commas' => __( 'Separate Portfolio Categories with commas', 'ang-plugins' ),
		'add_or_remove_items'        => __( 'Add or remove Portfolio Categories ', 'ang-plugins' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'ang-plugins' ),
		'popular_items'              => __( 'Popular Portfolio Categories', 'ang-plugins' ),
		'search_items'               => __( 'Search Portfolio Categories', 'ang-plugins' ),
		'not_found'                  => __( 'Not Found', 'ang-plugins' ),
		'items_list'                 => __( 'Portfolio Categories list', 'ang-plugins' ),
		'items_list_navigation'      => __( 'Portfolio Categories list navigation', 'ang-plugins' ),
	));
	// Arguments for 'favorite-category' taxonomy
	$args = apply_filters( 'ang_portfolio_category_args', array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'query_var'                  => true,
		'rewrite'                    => array( 'slug' => $slug, 'with_front' => false, 'hierarchical' => true )
	));
	register_taxonomy( 'portfolio_category', array( 'portfolio' ), $args );

}
add_action( 'init', 'custom_taxonomy_portfolio_category', 0 );

}
