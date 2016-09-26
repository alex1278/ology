<?php
/**
 * Add Beans options to the WordPress Customizer.
 *
 * @package Admin
 */

ology_add_smart_action( 'customize_preview_init', 'ology_do_enqueue_wp_customize_assets' );

/**
 * Enqueue Beans assets for the WordPress Customizer.
 *
 * @since 1.0.0
 */
function ology_do_enqueue_wp_customize_assets() {

	wp_enqueue_script( 'beans-wp-customize-preview', ology_ADMIN_JS_URL . 'wp-customize-preview.js', array( 'jquery', 'customize-preview' ), ology_VERSION, true );

}


ology_add_smart_action( 'customize_register', 'ology_do_register_wp_customize_options' );

/**
 * Add Beans options to the WordPress Customizer.
 *
 * @since 1.0.0
 */
function ology_do_register_wp_customize_options() {

	$fields = array(
		array(
			'id' => 'ology_logo_image',
			'label' => esc_html__( 'Logo Image', 'ology' ),
			'type' => 'WP_Customize_Image_Control',
			'transport' => 'refresh'
		)
	);

	ology_register_wp_customize_options( $fields, 'title_tagline', array( 'title' => esc_html__( 'Branding', 'ology' ) ) );

	// Get layout option without default for the count.
	$options = ology_get_layouts_for_options();

	// Only show the layout options if more than two layouts are registered.
	if ( count( $options ) > 2 ) {

		$fields = array(
			array(
				'id' => 'ology_layout',
				'label' => esc_html__( 'Default Layout', 'ology' ),
				'type' => 'radio',
				'default' => ology_get_default_layout(),
				'options' => $options,
				'transport' => 'refresh'
			)
		);

		ology_register_wp_customize_options( $fields, 'ology_layout', array( 'title' => esc_html__( 'Default Layout', 'ology' ), 'priority' => 1000 ) );

	}

	$fields = array(
		array(
			'id' => 'ology_viewport_width_group',
			'label' => esc_html__( 'Viewport Width', 'ology' ),
			'type' => 'group',
			'fields' => array(
				array(
					'id' => 'ology_enable_viewport_width',
					'type' => 'activation',
					'default' => false
				),
				array(
					'id' => 'ology_viewport_width',
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
			'id' => 'ology_viewport_height_group',
			'label' => esc_html__( 'Viewport Height', 'ology' ),
			'type' => 'group',
			'fields' => array(
				array(
					'id' => 'ology_enable_viewport_height',
					'type' => 'activation',
					'default' => false
				),
				array(
					'id' => 'ology_viewport_height',
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

	ology_register_wp_customize_options( $fields, 'ology_preview', array( 'title' => esc_html__( 'Preview Tools', 'ology' ), 'priority' => 1010 ) );

}