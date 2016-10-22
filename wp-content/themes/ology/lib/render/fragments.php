<?php
/**
 * Loads Beans fragments.
 *
 * @package Render\Fragments
 */

// Filter.
torbara_add_smart_action( 'template_redirect', 'torbara_load_global_fragments', 1 );

/**
 * Load global fragments and dynamic views.
 *
 * @since 1.0.0
 *
 * @param string $template The template filename.
 *
 * @return string The template filename.
 */
function torbara_load_global_fragments() {

	torbara_load_fragment_file( 'breadcrumb' );
	torbara_load_fragment_file( 'footer' );
	torbara_load_fragment_file( 'header' );
	torbara_load_fragment_file( 'menu' );
	torbara_load_fragment_file( 'post-shortcodes' );
	torbara_load_fragment_file( 'post' );
	torbara_load_fragment_file( 'widget-area' );
	torbara_load_fragment_file( 'embed' );
	torbara_load_fragment_file( 'deprecated' );

}


// Filter.
torbara_add_smart_action( 'comments_template', 'torbara_load_comments_fragment' );

/**
 * Load comments fragments.
 *
 * The comments fragments only loads if comments are active to prevent unnecessary memory usage.
 *
 * @since 1.0.0
 *
 * @param string $template The template filename.
 *
 * @return string The template filename.
 */
function torbara_load_comments_fragment( $template ) {

	if ( empty( $template ) )
		return;

	torbara_load_fragment_file( 'comments' );

	return $template;

}


torbara_add_smart_action( 'dynamic_sidebar_before', 'torbara_load_widget_fragment', -1 );

/**
 * Load widget fragments.
 *
 * The widget fragments only loads if a sidebar is active to prevent unnecessary memory usage.
 *
 * @since 1.0.0
 *
 * @return bool True on success, false on failure.
 */
function torbara_load_widget_fragment() {

	return torbara_load_fragment_file( 'widget' );

}


torbara_add_smart_action( 'pre_get_search_form', 'torbara_load_search_form_fragment' );

/**
 * Load search form fragments.
 *
 * The search form fragments only loads if search is active to prevent unnecessary memory usage.
 *
 * @since 1.0.0
 *
 * @return bool True on success, false on failure.
 */
function torbara_load_search_form_fragment() {

	return torbara_load_fragment_file( 'searchform' );

}