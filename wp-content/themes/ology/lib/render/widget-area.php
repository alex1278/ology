<?php
/**
 * Registers Beans's default widget areas.
 *
 * @package Render\Widgets
 */

torbara_add_smart_action( 'widgets_init', 'torbara_do_register_widget_areas', 5 );

/**
 * Register Beans's default widget areas.
 *
 * @since 1.0.0
 */
function torbara_do_register_widget_areas() {

	// Keep primary sidebar first for default widget asignment.
	torbara_register_widget_area( array(
		'name' => esc_html__( 'sidebar-a', 'torbara' ),
		'id' => 'sidebar-a'
	) );

	torbara_register_widget_area( array(
		'name' => esc_html__( 'Sidebar Secondary', 'torbara' ),
		'id' => 'sidebar_secondary'
	) );

	if ( current_theme_supports( 'offcanvas-menu' ) )
		torbara_register_widget_area( array(
			'name' => esc_html__( 'Off-Canvas Menu', 'torbara' ),
			'id' => 'offcanvas_menu',
			'torbara_type' => 'offcanvas',
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
add_action( 'widgets_init', 'torbara_register_widget_area' );