<?php
/**
 * Add Beans options to the WordPress Customizer.
 *
 * @package Admin
 */

torbara_add_smart_action( 'customize_preview_init', 'torbara_do_enqueue_wp_customize_assets' );

/**
 * Enqueue Beans assets for the WordPress Customizer.
 *
 * @since 1.0.0
 */
function torbara_do_enqueue_wp_customize_assets() {

	wp_enqueue_script( 'beans-wp-customize-preview', torbara_ADMIN_JS_URL . 'wp-customize-preview.js', array( 'jquery', 'customize-preview' ), torbara_VERSION, true );

}


torbara_add_smart_action( 'customize_register', 'torbara_do_register_wp_customize_options' );

/**
 * Add Beans options to the WordPress Customizer.
 *
 * @since 1.0.0
 */
function torbara_do_register_wp_customize_options() {

	$fields = array(
		array(
			'id' => 'torbara_logo_image',
			'label' => esc_html__( 'Logo Image', 'torbara' ),
			'type' => 'WP_Customize_Image_Control',
			'transport' => 'refresh'
		)
	);

	torbara_register_wp_customize_options( $fields, 'title_tagline', array( 'title' => esc_html__( 'Branding', 'torbara' ) ) );

	// Get layout option without default for the count.
	$options = torbara_get_layouts_for_options();

	// Only show the layout options if more than two layouts are registered.
	if ( count( $options ) > 2 ) {

		$fields = array(
			array(
				'id' => 'torbara_layout',
				'label' => esc_html__( 'Default Layout', 'torbara' ),
				'type' => 'radio',
				'default' => torbara_get_default_layout(),
				'options' => $options,
				'transport' => 'refresh'
			)
		);

		torbara_register_wp_customize_options( $fields, 'torbara_layout', array( 'title' => esc_html__( 'Default Layout', 'torbara' ), 'priority' => 1000 ) );

	}

	$fields = array(
		array(
			'id' => 'torbara_viewport_width_group',
			'label' => esc_html__( 'Viewport Width', 'torbara' ),
			'type' => 'group',
			'fields' => array(
				array(
					'id' => 'torbara_enable_viewport_width',
					'type' => 'activation',
					'default' => false
				),
				array(
					'id' => 'torbara_viewport_width',
					'type' => 'slider',
					'default' => 1000,
					'min' => 300,
					'max' => 2500,
					'interval' => 10,
					'unit' => 'px'
				),
			)
		),
		array(
			'id' => 'torbara_viewport_height_group',
			'label' => esc_html__( 'Viewport Height', 'torbara' ),
			'type' => 'group',
			'fields' => array(
				array(
					'id' => 'torbara_enable_viewport_height',
					'type' => 'activation',
					'default' => false
				),
				array(
					'id' => 'torbara_viewport_height',
					'type' => 'slider',
					'default' => 1000,
					'min' => 300,
					'max' => 2500,
					'interval' => 10,
					'unit' => 'px'
				),
			)
		)
	);

	torbara_register_wp_customize_options( $fields, 'torbara_preview', array( 'title' => esc_html__( 'Preview Tools', 'torbara' ), 'priority' => 1010 ) );

}