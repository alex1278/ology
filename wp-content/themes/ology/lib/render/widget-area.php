<?php
/**
 * Registers Beans's default widget areas.
 *
 * @package Render\Widgets
 */

ology_add_smart_action( 'widgets_init', 'ology_do_register_widget_areas', 5 );

/**
 * Register Beans's default widget areas.
 *
 * @since 1.0.0
 */
function ology_do_register_widget_areas() {

	// Keep primary sidebar first for default widget asignment.
	ology_register_widget_area( array(
		'name' => esc_html__( 'sidebar-a', 'ology' ),
		'id' => 'sidebar-a'
	) );

	ology_register_widget_area( array(
		'name' => esc_html__( 'Sidebar Secondary', 'ology' ),
		'id' => 'sidebar_secondary'
	) );

	if ( current_theme_supports( 'offcanvas-menu' ) )
		ology_register_widget_area( array(
			'name' => esc_html__( 'Off-Canvas Menu', 'ology' ),
			'id' => 'offcanvas_menu',
			'ology_type' => 'offcanvas',
		) );

}


/**
 * Call register sidebar.
 *
 * Because WordPress.org checker don't understand that we are using register_sidebar properly,
 * we have to add this useless call which only has to be declared once.
 *
 * @since 1.0.0
 *
 * @ignore
 */
add_action( 'widgets_init', 'ology_register_widget_area' );