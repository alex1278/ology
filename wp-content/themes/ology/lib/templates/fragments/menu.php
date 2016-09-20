<?php
/**
 * Echo menu fragments.
 *
 * @package Fragments\Menu
 */

ology_add_smart_action( 'ology_header', 'ology_primary_menu', 15 );

/**
 * Echo primary menu.
 *
 * @since 1.0.0
 */
function ology_primary_menu() {

	$nav_visibility = current_theme_supports( 'offcanvas-menu' ) ? 'uk-visible-large' : '';

	echo ology_open_markup( 'ology_primary_menu', 'nav', array(
		'class' => 'tm-primary-menu uk-float-right uk-navbar',
		'role' => 'navigation',
		'itemscope' => 'itemscope',
		'itemtype' => 'http://schema.org/SiteNavigationElement'
	) );

		/**
		 * Filter the primary menu arguments.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args Nav menu arguments.
		 */
		$args = apply_filters( 'ology_primary_menu_args', array(
			'theme_location' => has_nav_menu( 'primary' ) ? 'primary' : '',
			'fallback_cb' => 'ology_no_menu_notice',
			'container' => '',
			'menu_class' => $nav_visibility, // Automatically escaped.
			'echo' => false,
			'ology_type' => 'navbar'
		) );

		// Navigation.
		echo ology_output( 'ology_primary_menu', wp_nav_menu( $args ) );

	echo ology_close_markup( 'ology_primary_menu', 'nav' );

}


ology_add_smart_action( 'ology_primary_menu_append_markup', 'ology_primary_menu_offcanvas_button', 5 );

/**
 * Echo primary menu offcanvas button.
 *
 * @since 1.0.0
 */
function ology_primary_menu_offcanvas_button() {

	if ( !current_theme_supports( 'offcanvas-menu' ) )
		return;

	echo ology_open_markup( 'ology_primary_menu_offcanvas_button', 'a', array(
		'href' => '#offcanvas_menu',
		'class' => 'uk-button uk-hidden-large',
		'data-uk-offcanvas' => ''
	) );

		echo ology_open_markup( 'ology_primary_menu_offcanvas_button_icon', 'i', array(
			'class' => 'uk-icon-navicon uk-margin-small-right',
		) );

		echo ology_close_markup( 'ology_primary_menu_offcanvas_button_icon', 'i' );

		echo ology_output( 'ology_offcanvas_menu_button', __( 'Menu', 'ology' ) );

	echo ology_close_markup( 'ology_primary_menu_offcanvas_button', 'a' );

}


ology_add_smart_action( 'ology_widget_area_offcanvas_bar_offcanvas_menu_prepend_markup', 'ology_primary_offcanvas_menu' );

/**
 * Echo off-canvas primary menu.
 *
 * @since 1.0.0
 */
function ology_primary_offcanvas_menu() {

	if ( !current_theme_supports( 'offcanvas-menu' ) )
		return;

	echo ology_open_markup( 'ology_primary_offcanvas_menu', 'nav', array(
		'class' => 'tm-primary-offcanvas-menu uk-margin uk-margin-top',
		'role' => 'navigation',
	) );

		/**
		 * Filter the off-canvas primary menu arguments.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args Off-canvas nav menu arguments.
		 */
		$args = apply_filters( 'ology_primary_offcanvas_menu_args', array(
			'theme_location' => has_nav_menu( 'primary' ) ? 'primary' : '',
			'fallback_cb' => 'ology_no_menu_notice',
			'container' => '',
			'echo' => false,
			'ology_type' => 'offcanvas'
		) );

		echo ology_output( 'ology_primary_offcanvas_menu', wp_nav_menu( $args ) );

	echo ology_close_markup( 'ology_primary_offcanvas_menu', 'nav' );

}


/**
 * Echo no menu notice.
 *
 * @since 1.0.0
 */
function ology_no_menu_notice() {

	echo ology_open_markup( 'ology_no_menu_notice', 'p', array( 'class' => 'uk-alert uk-alert-warning' ) );

		echo ology_output( 'ology_no_menu_notice_text', __( 'Whoops, your site does not have a menu!', 'ology' ) );

	echo ology_close_markup( 'ology_no_menu_notice', 'p' );

}