<?php

/*
 * Filter created to change castom post type capabilities for Epl/Esta
 * Date: 25.11.2015
 * Author: Aleksandr Glovatskyy
 */
function ang_change_business_args($property_args) { 
                
        $archives = defined( 'EPL_BUSINESS_DISABLE_ARCHIVE' ) && EPL_BUSINESS_DISABLE_ARCHIVE ? false : true;
	$slug     = defined( 'EPL_BUSINESS_SLUG' ) ? EPL_BUSINESS_SLUG : 'business';
	$rewrite  = defined( 'EPL_BUSINESS_DISABLE_REWRITE' ) && EPL_BUSINESS_DISABLE_REWRITE ? false : array('slug' => $slug, 'with_front' => false);

	$labels = apply_filters( 'epl_business_labels', array(
		'name'			=>	__('Business Listings', 'epl'),
		'singular_name'		=>	__('Business Listings', 'epl'),
		'menu_name'		=>	__('Business', 'epl'),
		'add_new'		=>	__('Add New', 'epl'),
		'add_new_item'		=>	__('Add New Business Listing', 'epl'),
		'edit_item'		=>	__('Edit Business Listing', 'epl'),
		'new_item'		=>	__('New Business Listing', 'epl'),
		'update_item'		=>	__('Update Business Listing', 'epl'),
		'all_items'		=>	__('All Business Listings', 'epl'),
		'view_item'		=>	__('View Business Listing', 'epl'),
		'search_items'		=>	__('Search Business Listing', 'epl'),
		'not_found'		=>	__('Business Listing Not Found', 'epl'),
		'not_found_in_trash'	=>	__('Business Listing Not Found in Trash', 'epl'),
		'parent_item_colon'	=>	__('Parent Business Listing:', 'epl')
	) );

        //ang
                $capabilities = array(
                    'edit_post'              => 'edit_property',
                    'read_post'              => 'read_property',
                    'delete_post'            => 'delete_property',
                    'edit_posts'             => 'edit_properties',
                    'edit_others_posts'      => 'edit_others_properties',
                    'publish_posts'          => 'publish_properties',
                    'read_private_posts'     => 'read_private_properties',
                    'delete_posts'           => 'delete_properties',
                    'delete_private_posts'   => 'delete_private_properties',
                    'delete_published_posts' => 'delete_published_properties',
                    'delete_others_posts'    => 'delete_others_properties',
                    'edit_private_posts'     => 'edit_private_properties',
                    'edit_published_posts'   => 'edit_published_properties',
                    'create_posts'           => 'edit_properties',
                    
                );
                $business_args = array(
                        'labels'		=>	$labels,
                        'public'		=>	true,
                        'publicly_queryable'	=>	true,
                        'show_ui'		=>	true,
                        'show_in_menu'		=>	true,
                        'query_var'		=>	true,
                        'rewrite'		=>	$rewrite,
                        'menu_icon'		=>	'dashicons-cart',
                        'capability_type'	=>	'property',
                        'capabilities'          =>      $capabilities,
                        'map_meta_cap'          =>      true,
                        'has_archive'		=>	$archives,
                        'hierarchical'		=>	false,
                        'menu_position'		=>	'26.6',
                        'taxonomies'		=>	array( 'location', 'tax_feature' ),
                        'supports'		=>	apply_filters( 'epl_business_supports', array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' , 'comments' ) ),
                );
                return $business_args;
}
add_filter('epl_business_post_type_args', 'ang_change_business_args');

function ang_change_commercial_args($property_args) { 
                
        $archives = defined( 'EPL_COMMERCIAL_DISABLE_ARCHIVE' ) && EPL_COMMERCIAL_DISABLE_ARCHIVE ? false : true;
	$slug     = defined( 'EPL_COMMERCIAL_SLUG' ) ? EPL_COMMERCIAL_SLUG : 'commercial';
	$rewrite  = defined( 'EPL_COMMERCIAL_DISABLE_REWRITE' ) && EPL_COMMERCIAL_DISABLE_REWRITE ? false : array('slug' => $slug, 'with_front' => false);
	
	$labels = apply_filters( 'epl_commercial_labels', array(
		'name'			=>	__('Commercial Listings', 'epl'),
		'singular_name'		=>	__('Commercial Listing', 'epl'),
		'menu_name'		=>	__('Commercial', 'epl'),
		'add_new'		=>	__('Add New', 'epl'),
		'add_new_item'		=>	__('Add New Commercial Listing', 'epl'),
		'edit_item'		=>	__('Edit Commercial Listing', 'epl'),
		'new_item'		=>	__('New Commercial Listing', 'epl'),
		'update_item'		=>	__('Update Commercial Listing', 'epl'),
		'all_items'		=>	__('All Commercial Listings', 'epl'),
		'view_item'		=>	__('View Commercial Listing', 'epl'),
		'search_items'		=>	__('Search Commercial Listing', 'epl'),
		'not_found'		=>	__('Commercial Listing Not Found', 'epl'),
		'not_found_in_trash'	=>	__('Commercial Listing Not Found in Trash', 'epl'),
		'parent_item_colon'	=>	__('Parent Commercial Listing:', 'epl')
	) );

        //ang
                $capabilities = array(
                    'edit_post'              => 'edit_property',
                    'read_post'              => 'read_property',
                    'delete_post'            => 'delete_property',
                    'edit_posts'             => 'edit_properties',
                    'edit_others_posts'      => 'edit_others_properties',
                    'publish_posts'          => 'publish_properties',
                    'read_private_posts'     => 'read_private_properties',
                    'delete_posts'           => 'delete_properties',
                    'delete_private_posts'   => 'delete_private_properties',
                    'delete_published_posts' => 'delete_published_properties',
                    'delete_others_posts'    => 'delete_others_properties',
                    'edit_private_posts'     => 'edit_private_properties',
                    'edit_published_posts'   => 'edit_published_properties',
                    'create_posts'           => 'edit_properties',
                    
                );
                $commercial_args = array(
                        'labels'		=>	$labels,
                        'public'		=>	true,
                        'publicly_queryable'	=>	true,
                        'show_ui'		=>	true,
                        'show_in_menu'		=>	true,
                        'query_var'		=>	true,
                        'rewrite'		=>	$rewrite,
                        'menu_icon'		=>	'dashicons-welcome-widgets-menus',
                        'capability_type'	=>	'property',
                        'capabilities'          =>      $capabilities,
                        'map_meta_cap'          =>      true,
                        'has_archive'		=>	$archives,
                        'hierarchical'		=>	false,
                        'menu_position'		=>	'26.7',
                        'taxonomies'		=>	array( 'location', 'tax_feature' ),
                        'supports'		=>	apply_filters( 'epl_commercial_supports', array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' , 'comments' ) ),
                );
	return $commercial_args;
}
add_filter('epl_commercial_post_type_args', 'ang_change_commercial_args');

function ang_change_commercial_land_args($property_args) { 
                
        $archives = defined( 'EPL_COMMERCIAL_LAND_DISABLE_ARCHIVE' ) && EPL_COMMERCIAL_LAND_DISABLE_ARCHIVE ? false : true;
	$slug     = defined( 'EPL_COMMERCIAL_LAND_SLUG' ) ? EPL_COMMERCIAL_LAND_SLUG : 'commercial-land';
	$rewrite  = defined( 'EPL_COMMERCIAL_LAND_DISABLE_REWRITE' ) && EPL_COMMERCIAL_LAND_DISABLE_REWRITE ? false : array('slug' => $slug, 'with_front' => false);

	$labels = apply_filters( 'epl_commercial_land_labels', array(
		'name'			=>	__('Commercial Land Listings', 'epl'),
		'singular_name'		=>	__('Commercial Land Listing', 'epl'),
		'menu_name'		=>	__('Commercial Land', 'epl'),
		'add_new'		=>	__('Add New', 'epl'),
		'add_new_item'		=>	__('Add New Commercial Land Listing', 'epl'),
		'edit_item'		=>	__('Edit Commercial Land Listing', 'epl'),
		'new_item'		=>	__('New Commercial Land Listing', 'epl'),
		'update_item'		=>	__('Update Commercial Land Listing', 'epl'),
		'all_items'		=>	__('All Commercial Land Listings', 'epl'),
		'view_item'		=>	__('View Commercial Land Listing', 'epl'),
		'search_items'		=>	__('Search Commercial Land Listing', 'epl'),
		'not_found'		=>	__('Commercial Land Listing Not Found', 'epl'),
		'not_found_in_trash'	=>	__('Commercial Land Listing Not Found in Trash', 'epl'),
		'parent_item_colon'	=>	__('Parent Commercial Land Listing:', 'epl')
	) );

        //ang
                $capabilities = array(
                    'edit_post'              => 'edit_property',
                    'read_post'              => 'read_property',
                    'delete_post'            => 'delete_property',
                    'edit_posts'             => 'edit_properties',
                    'edit_others_posts'      => 'edit_others_properties',
                    'publish_posts'          => 'publish_properties',
                    'read_private_posts'     => 'read_private_properties',
                    'delete_posts'           => 'delete_properties',
                    'delete_private_posts'   => 'delete_private_properties',
                    'delete_published_posts' => 'delete_published_properties',
                    'delete_others_posts'    => 'delete_others_properties',
                    'edit_private_posts'     => 'edit_private_properties',
                    'edit_published_posts'   => 'edit_published_properties',
                    'create_posts'           => 'edit_properties',
                    
                );
                $commercial_land_args = array(
                        'labels'		=>	$labels,
                        'public'		=>	true,
                        'publicly_queryable'	=>	true,
                        'show_ui'		=>	true,
                        'show_in_menu'		=>	true,
                        'query_var'		=>	true,
                        'rewrite'		=>	$rewrite,
                        'menu_icon'		=>	'dashicons-image-crop',
                        'capability_type'	=>	'property',
                        'capabilities'          =>      $capabilities,
                        'map_meta_cap'          =>      true,
                        'has_archive'		=>	$archives,
                        'hierarchical'		=>	false,
                        'menu_position'		=>	'26.8',
                        'taxonomies'		=>	array( 'location', 'tax_feature' ),
                        'supports'		=>	apply_filters( 'epl_commercial_land_supports', array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' , 'comments' ) ),
                );
                return $commercial_land_args;
}
add_filter('epl_commercial_land_post_type_args', 'ang_change_commercial_land_args');

function ang_change_land_args($property_args) { 
                
        $archives = defined( 'EPL_LAND_DISABLE_ARCHIVE' ) && EPL_LAND_DISABLE_ARCHIVE ? false : true;
	$slug     = defined( 'EPL_LAND_SLUG' ) ? EPL_LAND_SLUG : 'land';
	$rewrite  = defined( 'EPL_LAND_DISABLE_REWRITE' ) && EPL_LAND_DISABLE_REWRITE ? false : array('slug' => $slug, 'with_front' => false);

	$labels = apply_filters( 'epl_land_labels', array(
		'name'			=>	__('Land', 'epl'),
		'singular_name'		=>	__('Land', 'epl'),
		'menu_name'		=>	__('Land', 'epl'),
		'add_new'		=>	__('Add New', 'epl'),
		'add_new_item'		=>	__('Add New Land Listing', 'epl'),
		'edit_item'		=>	__('Edit Land Listing', 'epl'),
		'new_item'		=>	__('New Land Listing', 'epl'),
		'update_item'		=>	__('Update Land Listing', 'epl'),
		'all_items'		=>	__('All Land Listings', 'epl'),
		'view_item'		=>	__('View Land Listing', 'epl'),
		'search_items'		=>	__('Search Land Listing', 'epl'),
		'not_found'		=>	__('Land Listing Not Found', 'epl'),
		'not_found_in_trash'	=>	__('Land Listing Not Found in Trash', 'epl'),
		'parent_item_colon'	=>	__('Parent Land Listing:', 'epl')
	) );

        //ang
                $capabilities = array(
                    'edit_post'              => 'edit_property',
                    'read_post'              => 'read_property',
                    'delete_post'            => 'delete_property',
                    'edit_posts'             => 'edit_properties',
                    'edit_others_posts'      => 'edit_others_properties',
                    'publish_posts'          => 'publish_properties',
                    'read_private_posts'     => 'read_private_properties',
                    'delete_posts'           => 'delete_properties',
                    'delete_private_posts'   => 'delete_private_properties',
                    'delete_published_posts' => 'delete_published_properties',
                    'delete_others_posts'    => 'delete_others_properties',
                    'edit_private_posts'     => 'edit_private_properties',
                    'edit_published_posts'   => 'edit_published_properties',
                    'create_posts'           => 'edit_properties',
                    
                );
                $land_args = array(
                        'labels'		=>	$labels,
                        'public'		=>	true,
                        'publicly_queryable'	=>	true,
                        'show_ui'		=>	true,
                        'show_in_menu'		=>	true,
                        'query_var'		=>	true,
                        'rewrite'		=>	$rewrite,
                        'menu_icon'		=>	'dashicons-image-crop',
                         'capability_type'	=>	'property',
                        'capabilities'          =>      $capabilities,
                        'map_meta_cap'          =>      true,
                        'has_archive'		=>	$archives,
                        'hierarchical'		=>	false,
                        'menu_position'		=>	'26.3',
                        'taxonomies'		=>	array( 'location', 'tax_feature' ),
                        'supports'		=>	apply_filters( 'epl_land_supports', array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' , 'comments' ) ),
                );
	return $land_args;
}
add_filter('epl_land_post_type_args', 'ang_change_land_args');

function ang_change_property_args($property_args) { 
                
                $archives = defined( 'EPL_PROPERTY_DISABLE_ARCHIVE' ) && EPL_PROPERTY_DISABLE_ARCHIVE ? false : true;
                $slug     = defined( 'EPL_PROPERTY_SLUG' ) ? EPL_PROPERTY_SLUG : 'property';
                $rewrite  = defined( 'EPL_PROPERTY_DISABLE_REWRITE' ) && EPL_PROPERTY_DISABLE_REWRITE ? false : array('slug' => $slug, 'with_front' => false);

                $labels = apply_filters( 'epl_property_labels', array(
                    'name'		=>	__('Properties', 'epl'),
                    'singular_name'	=>	__('Property', 'epl'),
                    'menu_name'		=>	__('Property', 'epl'),
                    'add_new'		=>	__('Add New', 'epl'),
                    'add_new_item'	=>	__('Add New Listing', 'epl'),
                    'edit_item'		=>	__('Edit Listing', 'epl'),
                    'new_item'		=>	__('New Listing', 'epl'),
                    'update_item'	=>	__('Update Listing', 'epl'),
                    'all_items'		=>	__('All Listings', 'epl'),
                    'view_item'		=>	__('View Listing', 'epl'),
                    'search_items'	=>	__('Search Listing', 'epl'),
                    'not_found'		=>	__('Listing Not Found', 'epl'),
                    'not_found_in_trash'=>	__('Listing Not Found in Trash', 'epl'),
                    'parent_item_colon'	=>	__('Parent Listing:', 'epl')
                ) );

        //ang
                $capabilities = array(
                    'edit_post'              => 'edit_property',
                    'read_post'              => 'read_property',
                    'delete_post'            => 'delete_property',
                    'edit_posts'             => 'edit_properties',
                    'edit_others_posts'      => 'edit_others_properties',
                    'publish_posts'          => 'publish_properties',
                    'read_private_posts'     => 'read_private_properties',
                    'delete_posts'           => 'delete_properties',
                    'delete_private_posts'   => 'delete_private_properties',
                    'delete_published_posts' => 'delete_published_properties',
                    'delete_others_posts'    => 'delete_others_properties',
                    'edit_private_posts'     => 'edit_private_properties',
                    'edit_published_posts'   => 'edit_published_properties',
                    'create_posts'           => 'edit_properties',
                    
                );
                $property_args = array(
                    'labels'		=>	$labels,
                    'public'		=>	true,
                    'publicly_queryable'=>	true,
                    'show_ui'		=>	true,
                    'show_in_menu'	=>	true,
                    'query_var'		=>	true,
                    'rewrite'		=>	$rewrite,
                    'menu_icon'		=>	'dashicons-admin-home',
                    'capability_type'	=>	'property',
                    'capabilities'      =>      $capabilities,
                    'map_meta_cap'      =>      true,
                    'has_archive'	=>	$archives,
                    'hierarchical'	=>	false,
                    'menu_position'	=>	'26.2',
                    'taxonomies'	=>	array( 'location', 'tax_feature' ),
                    'supports'		=>	apply_filters( 'epl_property_supports', array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' , 'comments' ) ),
            );
	return $property_args;
}
add_filter('epl_property_post_type_args', 'ang_change_property_args');


function ang_change_rental_args($property_args) { 
                
        $archives = defined( 'EPL_RENTAL_DISABLE_ARCHIVE' ) && EPL_RENTAL_DISABLE_ARCHIVE ? false : true;
	$slug     = defined( 'EPL_RENTAL_SLUG' ) ? EPL_RENTAL_SLUG : 'rental';
	$rewrite  = defined( 'EPL_RENTAL_DISABLE_REWRITE' ) && EPL_RENTAL_DISABLE_REWRITE ? false : array('slug' => $slug, 'with_front' => false);

	$labels = apply_filters( 'epl_rental_labels', array(
		'name'			=>	__('Rentals', 'epl'),
		'singular_name'		=>	__('Rental', 'epl'),
		'menu_name'		=>	__('Rentals', 'epl'),
		'add_new'		=>	__('Add New', 'epl'),
		'add_new_item'		=>	__('Add New Rental', 'epl'),
		'edit_item'		=>	__('Edit Rental', 'epl'),
		'new_item'		=>	__('New Rental', 'epl'),
		'update_item'		=>	__('Update Rental', 'epl'),
		'all_items'		=>	__('All Rentals', 'epl'),
		'view_item'		=>	__('View Rental', 'epl'),
		'search_items'		=>	__('Search Rentals', 'epl'),
		'not_found'		=>	__('Rental Not Found', 'epl'),
		'not_found_in_trash'	=>	__('Rental Not Found in Trash', 'epl'),
		'parent_item_colon'	=>	__('Parent Rental:', 'epl')
	) );

        //ang
                $capabilities = array(
                    'edit_post'              => 'edit_property',
                    'read_post'              => 'read_property',
                    'delete_post'            => 'delete_property',
                    'edit_posts'             => 'edit_properties',
                    'edit_others_posts'      => 'edit_others_properties',
                    'publish_posts'          => 'publish_properties',
                    'read_private_posts'     => 'read_private_properties',
                    'delete_posts'           => 'delete_properties',
                    'delete_private_posts'   => 'delete_private_properties',
                    'delete_published_posts' => 'delete_published_properties',
                    'delete_others_posts'    => 'delete_others_properties',
                    'edit_private_posts'     => 'edit_private_properties',
                    'edit_published_posts'   => 'edit_published_properties',
                    'create_posts'           => 'edit_properties',
                    
                );
                $rental_args = array(
                        'labels'		=>	$labels,
                        'public'		=>	true,
                        'publicly_queryable'	=>	true,
                        'show_ui'		=>	true,
                        'show_in_menu'		=>	true,
                        'query_var'		=>	true,
                        'rewrite'		=>	$rewrite,
                        'menu_icon'		=>	'dashicons-admin-home',
                        'capability_type'	=>	'property',
                        'capabilities'          =>      $capabilities,
                        'map_meta_cap'          =>      true,
                        'has_archive'		=>	$archives,
                        'hierarchical'		=>	false,
                        'menu_position'		=>	'26.5',
                        'taxonomies'		=>	array( 'location', 'tax_feature' ),
                        'supports'		=>	apply_filters( 'epl_rental_supports', array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' , 'comments' ) ),
                );
	return $rental_args;
}
add_filter('epl_rental_post_type_args', 'ang_change_rental_args');


function ang_change_rural_args($property_args) { 
                
        $archives = defined( 'EPL_RURAL_DISABLE_ARCHIVE' ) && EPL_RURAL_DISABLE_ARCHIVE ? false : true;
	$slug     = defined( 'EPL_RURAL_SLUG' ) ? EPL_RURAL_SLUG : 'rural';
	$rewrite  = defined( 'EPL_RURAL_DISABLE_REWRITE' ) && EPL_RURAL_DISABLE_REWRITE ? false : array('slug' => $slug, 'with_front' => false);
	
	$labels = apply_filters( 'epl_rural_labels', array(
		'name'			=>	__('Rural', 'epl'),
		'singular_name'		=>	__('Rural', 'epl'),
		'menu_name'		=>	__('Rural', 'epl'),
		'add_new'		=>	__('Add New', 'epl'),
		'add_new_item'		=>	__('Add New Rural Listing', 'epl'),
		'edit_item'		=>	__('Edit Rural Listing', 'epl'),
		'new_item'		=>	__('New Rural Listing', 'epl'),
		'update_item'		=>	__('Update Rural Listing', 'epl'),
		'all_items'		=>	__('All Rural Listings', 'epl'),
		'view_item'		=>	__('View Rural Listing', 'epl'),
		'search_items'		=>	__('Search Rural Listing', 'epl'),
		'not_found'		=>	__('Rural Listing Not Found', 'epl'),
		'not_found_in_trash'	=>	__('Rural Listing Not Found in Trash', 'epl'),
		'parent_item_colon'	=>	__('Parent Rural Listing:', 'epl')
	) );
        //ang
                $capabilities = array(
                    'edit_post'              => 'edit_property',
                    'read_post'              => 'read_property',
                    'delete_post'            => 'delete_property',
                    'edit_posts'             => 'edit_properties',
                    'edit_others_posts'      => 'edit_others_properties',
                    'publish_posts'          => 'publish_properties',
                    'read_private_posts'     => 'read_private_properties',
                    'delete_posts'           => 'delete_properties',
                    'delete_private_posts'   => 'delete_private_properties',
                    'delete_published_posts' => 'delete_published_properties',
                    'delete_others_posts'    => 'delete_others_properties',
                    'edit_private_posts'     => 'edit_private_properties',
                    'edit_published_posts'   => 'edit_published_properties',
                    'create_posts'           => 'edit_properties',
                    
                );
                $rural_args = array(
                        'labels'		=>	$labels,
                        'public'		=>	true,
                        'publicly_queryable'	=>	true,
                        'show_ui'		=>	true,
                        'show_in_menu'		=>	true,
                        'query_var'		=>	true,
                        'rewrite'		=>	$rewrite,
                        'menu_icon'		=>	'dashicons-location-alt',
                        'capability_type'	=>	'property',
                        'capabilities'          =>      $capabilities,
                        'map_meta_cap'          =>      true,
                        'has_archive'		=>	$archives,
                        'hierarchical'		=>	false,
                        'menu_position'		=>	'26.4',
                        'taxonomies'		=>	array( 'location', 'tax_feature' ),
                        'supports'		=>	apply_filters( 'epl_rural_supports', array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' , 'comments' ) ),
                );
	return $rural_args;
}
add_filter('epl_rural_post_type_args', 'ang_change_rural_args');


