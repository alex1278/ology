<?php

/*********************** 
 * Filter users dropdown who can publish_posts
 * the filter replases standart wp settings
 */
    // ----- Filter users dropdown v0.1 -----

add_filter( 'wp_dropdown_users', 'filter_wp_dropdown_users' );
function filter_wp_dropdown_users( $output ) {
	
	// Exit if this isn't the theme author override dropdown
	if( !preg_match( '/post_author_override/', $output ) ) {
		return $output;
	}
	
	// Exit if we've already replaced this dropdown (prevents recursion)
	if( preg_match( '/post_author_override_replaced/', $output ) ) {
		return $output;
	}
	
	// Get valid roles
	global $wp_roles, $post;
	$roles = $wp_roles->role_objects;
	$valid_roles = array();
	foreach( $roles as $role ) {
		if( isset( $role->capabilities['publish_posts'] ) ) {
			$valid_roles[] = $role->name;
		}
	}
	
	// Get user IDs
	$user_ids = array();
	foreach( $valid_roles as $role ) {
		$users = get_users( array( 'role' => $role ) );
		foreach( $users as $user ) {
			$user_ids[] = $user->ID;
		}
	}
	
	// Replacement call to wp_dropdown_users
	$output = wp_dropdown_users( array(
		'echo' => 0,
		'name' => 'post_author_override_replaced',
		'include' => implode( ',', $user_ids ),
		'selected' => empty( $post->ID ) ? get_current_user_id() : $post->post_author,
		'include_selected' => true
	) );
	
	// Put the original name back
	$output = preg_replace( '/post_author_override_replaced/', 'post_author_override', $output );
	
	// Return
	return $output;
        
}

