<?php
/*
 * Filter created to change or remove castom post property type labels for Epl/Esta.
 * You can change another Epl/Esta CPT, jast cange the name of function.(Change the name, uncoment last column with "ass_filter" and save).
 * Date: 25.11.2015
 * Author: Aleksandr Glovatskyy
 */
function set_property_labels($labels) {
	$labels = array(
		'name'			=>	__('Properties', 'epl'),
		'singular_name'		=>	__('Property', 'epl'),
		'menu_name'		=>	__('Property', 'epl'),
		'add_new'		=>	__('Add New', 'epl'),
		'add_new_item'		=>	__('Add New Listing', 'epl'),
		'edit_item'		=>	__('Edit Listing', 'epl'),
		'new_item'		=>	__('New Listing', 'epl'),
		'update_item'		=>	__('Update Listing', 'epl'),
		'all_items'		=>	__('All Listings', 'epl'),
		'view_item'		=>	__('View Listing', 'epl'),
		'search_items'		=>	__('Search Listing', 'epl'),
		'not_found'		=>	__('Listing Not Found', 'epl'),
		'not_found_in_trash'    =>	__('Listing Not Found in Trash', 'epl'),
		'parent_item_colon'	=>	__('Parent Listing:', 'epl')
	);
	return $labels;
}
//add_filter('epl_property_labels', 'set_property_labels');

