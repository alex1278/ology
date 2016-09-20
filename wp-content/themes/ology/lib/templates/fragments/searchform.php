<?php
/**
 * Modify the search from.
 *
 * @package Fragments\Search_Form
 */

// Filter.
ology_add_smart_action( 'get_search_form', 'ology_search_form' );

/**
 * Modify the search form.
 *
 * @since 1.0.0
 *
 * @return string The form.
 */
function ology_search_form() {

	$output = ology_open_markup( 'ology_search_form', 'form', array(
		'class' => 'uk-form uk-form-icon uk-form-icon-flip uk-width-1-1',
		'method' => 'get',
		'action' => esc_url( home_url( '/' ) ),
		'role' => 'search'
	) );

		$output .= ology_selfclose_markup( 'ology_search_form_input', 'input', array(
			'class' => 'uk-width-1-1',
			'type' => 'search',
			'placeholder' => __( 'Search', 'ology' ), // Automatically escaped.
			'value' => esc_attr( get_search_query() ),
			'name' => 's'
		) );

		$output .= ology_open_markup( 'ology_search_form_input_icon', 'i', 'class=uk-icon-search' );

		$output .= ology_close_markup( 'ology_search_form_input_icon', 'i' );

	$output .= ology_close_markup( 'ology_search_form', 'form' );

	return $output;

}