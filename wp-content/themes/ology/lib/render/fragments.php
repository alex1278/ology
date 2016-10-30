<?php
/**
 * Loads Beans fragments.
 *
 * @package Render\Fragments
 */

// Filter.
ology_add_smart_action( 'template_redirect', 'ology_load_global_fragments', 1 );

/**
 * Load global fragments and dynamic views.
 *
 * @since 1.0.0
 *
 * @param string $template The template filename.
 *
 * @return string The template filename.
 */
function ology_load_global_fragments() {

	ology_load_fragment_file( 'breadcrumb' );
	ology_load_fragment_file( 'footer' );
	ology_load_fragment_file( 'header' );
	ology_load_fragment_file( 'menu' );
	ology_load_fragment_file( 'post-shortcodes' );
	ology_load_fragment_file( 'post' );
	ology_load_fragment_file( 'widget-area' );
	ology_load_fragment_file( 'embed' );
	ology_load_fragment_file( 'deprecated' );

}


// Filter.
ology_add_smart_action( 'comments_template', 'ology_load_comments_fragment' );

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
function ology_load_comments_fragment( $template ) {

	if ( empty( $template ) )
		return;

	ology_load_fragment_file( 'comments' );

	return $template;

}


ology_add_smart_action( 'dynamic_sidebar_before', 'ology_load_widget_fragment', -1 );

/**
 * Load widget fragments.
 *
 * The widget fragments only loads if a sidebar is active to prevent unnecessary memory usage.
 *
 * @since 1.0.0
 *
 * @return bool True on success, false on failure.
 */
function ology_load_widget_fragment() {

	return ology_load_fragment_file( 'widget' );

}


ology_add_smart_action( 'pre_get_search_form', 'ology_load_search_form_fragment' );

/**
 * Load search form fragments.
 *
 * The search form fragments only loads if search is active to prevent unnecessary memory usage.
 *
 * @since 1.0.0
 *
 * @return bool True on success, false on failure.
 */
function ology_load_search_form_fragment() {

	return ology_load_fragment_file( 'searchform' );

}