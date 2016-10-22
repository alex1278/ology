<?php
/**
 * Add Beans admin options.
 *
 * @package Admin
 */

torbara_add_smart_action( 'admin_init', 'torbara_do_register_term_meta' );

/**
 * Add Beans term meta.
 *
 * @since 1.0.0
 */
function torbara_do_register_term_meta() {

	// Get layout option without default for the count.
	$options = torbara_get_layouts_for_options();

	// Stop here if there is less than two layouts options.
	if ( count( $options ) < 2 )
		return;

	$fields = array(
		array(
			'id' => 'torbara_layout',
			'label' => esc_attr_x( 'Layout', 'term meta', 'torbara' ),
			'type' => 'radio',
			'default' => 'default_fallback',
			'options' => torbara_get_layouts_for_options( true )
		)
	);

	torbara_register_term_meta( $fields, array( 'category', 'post_tag' ), 'torbara' );

}


torbara_add_smart_action( 'admin_init', 'torbara_do_register_post_meta' );

/**
 * Add Beans post meta.
 *
 * @since 1.0.0
 */
function torbara_do_register_post_meta() {

	// Get layout option without default for the count.
	$options = torbara_get_layouts_for_options();

	// Stop here if there is less than two layouts options.
	if ( count( $options ) < 2 )
		return;

	$fields = array(
		array(
			'id' => 'torbara_layout',
			'label' => esc_attr_x( 'Layout', 'post meta', 'torbara' ),
			'type' => 'radio',
			'default' => 'default_fallback',
			'options' => torbara_get_layouts_for_options( true )
		)
	);

	torbara_register_post_meta( $fields, array( 'post', 'page' ), 'torbara', array( 'title' => esc_html__( 'Post Options', 'torbara' ) ) );

}