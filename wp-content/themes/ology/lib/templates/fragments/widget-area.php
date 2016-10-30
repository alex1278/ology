<?php
/**
 * Echo widget areas.
 *
 * @package Fragments\Widget_Area
 */

ology_add_smart_action( 'ology_sidebar_primary', 'ology_widget_area_sidebar_primary' );

/**
 * Echo primary sidebar widget area.
 *
 * @since 1.0.0
 */
function ology_widget_area_sidebar_primary() {

	echo ology_widget_area( 'sidebar-a' );

}


ology_add_smart_action( 'ology_sidebar_secondary', 'ology_widget_area_sidebar_secondary' );

/**
 * Echo secondary sidebar widget area.
 *
 * @since 1.0.0
 */
function ology_widget_area_sidebar_secondary() {

	echo ology_widget_area( 'sidebar_secondary' );

}


ology_add_smart_action( 'ology_site_after_markup', 'ology_widget_area_offcanvas_menu' );

/**
 * Echo off-canvas widget area.
 *
 * @since 1.0.0
 */
function ology_widget_area_offcanvas_menu() {

	if ( !current_theme_supports( 'offcanvas-menu' ) )
		return;

	echo ology_widget_area( 'offcanvas_menu' );

}