<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       http://torbara.com
 * @since      1.0.0
 *
 * @package    Ang_Commando_Staff_Team
 */
// If uninstall not called from WordPress, then exit.
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

if (get_option('ang_commando_staff_team_options')['delete_on_uninstall'] == 'yes') {
    // Delete custom post meta 

    $cpt_object  = new Ang_Commando_Staff_Team_Post_Type;
    $meta_fields = $cpt_object->get_commando_fields_settings();
    foreach ($meta_fields as $key => $v) {
        delete_post_meta_by_key('_' . $key);
    }

    // Delete option
    delete_option('ang_commando_staff_team_options');

    // Set global
    global $wpdb;

    // Delete terms
    $wpdb->query("
		DELETE FROM
		{$wpdb->terms}
		WHERE term_id IN
		( SELECT * FROM (
			SELECT {$wpdb->terms}.term_id
			FROM {$wpdb->terms}
			JOIN {$wpdb->term_taxonomy}
			ON {$wpdb->term_taxonomy}.term_id = {$wpdb->terms}.term_id
			WHERE taxonomy = {$cpt_object->tax_name}
		) as T
		);
 	");

    // Delete taxonomies
    $wpdb->query("DELETE FROM {$wpdb->term_taxonomy} WHERE taxonomy = {$cpt_object->tax_name}");
    $wpdb->query("DELETE FROM {$wpdb->term_taxonomy} WHERE taxonomy = {$cpt_object->tax_name_second}");

    // Delete events
    $wpdb->query("DELETE FROM {$wpdb->posts} WHERE post_type = {$cpt_object->post_type_name}");
}
