<?php
/**
 * Echo widget areas.
 *
 * @package Fragments\Widget_Area
 */

torbara_add_smart_action( 'torbara_sidebar_primary', 'torbara_widget_area_sidebar_primary' );

/**
 * Echo primary sidebar widget area.
 *
 * @since 1.0.0
 */
function torbara_widget_area_sidebar_primary() {

	echo torbara_widget_area( 'sidebar-a' );

}


torbara_add_smart_action( 'torbara_sidebar_secondary', 'torbara_widget_area_sidebar_secondary' );

/**
 * Echo secondary sidebar widget area.
 *
 * @since 1.0.0
 */
function torbara_widget_area_sidebar_secondary() {

	echo torbara_widget_area( 'sidebar_secondary' );

}


torbara_add_smart_action( 'torbara_site_after_markup', 'torbara_widget_area_offcanvas_menu' );

/**
 * Echo off-canvas widget area.
 *
 * @since 1.0.0
 */
function torbara_widget_area_offcanvas_menu() {

	if ( !current_theme_supports( 'offcanvas-menu' ) )
		return;

	echo torbara_widget_area( 'offcanvas_menu' );

}