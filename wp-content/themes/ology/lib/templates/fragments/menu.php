<?php
/**
 * Echo menu fragments.
 *
 * @package Fragments\Menu
 */

torbara_add_smart_action( 'torbara_header', 'torbara_primary_menu', 15 );

/**
 * Echo primary menu.
 *
 * @since 1.0.0
 */
function torbara_primary_menu() {

	$nav_visibility = current_theme_supports( 'offcanvas-menu' ) ? 'uk-visible-large' : '';

	echo torbara_open_markup( 'torbara_primary_menu', 'nav', array(
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
		$args = apply_filters( 'torbara_primary_menu_args', array(
			'theme_location' => has_nav_menu( 'primary' ) ? 'primary' : '',
			'fallback_cb' => 'torbara_no_menu_notice',
			'container' => '',
			'menu_class' => $nav_visibility, // Automatically escaped.
			'echo' => false,
			'torbara_type' => 'navbar'
		) );

		// Navigation.
		echo torbara_output( 'torbara_primary_menu', wp_nav_menu( $args ) );

	echo torbara_close_markup( 'torbara_primary_menu', 'nav' );

}


torbara_add_smart_action( 'torbara_primary_menu_append_markup', 'torbara_primary_menu_offcanvas_button', 5 );

/**
 * Echo primary menu offcanvas button.
 *
 * @since 1.0.0
 */
function torbara_primary_menu_offcanvas_button() {

	if ( !current_theme_supports( 'offcanvas-menu' ) )
		return;

	echo torbara_open_markup( 'torbara_primary_menu_offcanvas_button', 'a', array(
		'href' => '#offcanvas_menu',
		'class' => 'uk-button uk-hidden-large',
		'data-uk-offcanvas' => ''
	) );

		echo torbara_open_markup( 'torbara_primary_menu_offcanvas_button_icon', 'i', array(
			'class' => 'uk-icon-navicon uk-margin-small-right',
		) );

		echo torbara_close_markup( 'torbara_primary_menu_offcanvas_button_icon', 'i' );

		echo torbara_output( 'torbara_offcanvas_menu_button', esc_html__( 'Menu', 'torbara' ) );

	echo torbara_close_markup( 'torbara_primary_menu_offcanvas_button', 'a' );

}


torbara_add_smart_action( 'torbara_widget_area_offcanvas_bar_offcanvas_menu_prepend_markup', 'torbara_primary_offcanvas_menu' );

/**
 * Echo off-canvas primary menu.
 *
 * @since 1.0.0
 */
function torbara_primary_offcanvas_menu() {

	if ( !current_theme_supports( 'offcanvas-menu' ) )
		return;

	echo torbara_open_markup( 'torbara_primary_offcanvas_menu', 'nav', array(
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
		$args = apply_filters( 'torbara_primary_offcanvas_menu_args', array(
			'theme_location' => has_nav_menu( 'primary' ) ? 'primary' : '',
			'fallback_cb' => 'torbara_no_menu_notice',
			'container' => '',
			'echo' => false,
			'torbara_type' => 'offcanvas'
		) );

		echo torbara_output( 'torbara_primary_offcanvas_menu', wp_nav_menu( $args ) );

	echo torbara_close_markup( 'torbara_primary_offcanvas_menu', 'nav' );

}


/**
 * Echo no menu notice.
 *
 * @since 1.0.0
 */
function torbara_no_menu_notice() {

	echo torbara_open_markup( 'torbara_no_menu_notice', 'p', array( 'class' => 'uk-alert uk-alert-warning' ) );

		echo torbara_output( 'torbara_no_menu_notice_text', esc_html__( 'Whoops, your site does not have a menu!', 'torbara' ) );

	echo torbara_close_markup( 'torbara_no_menu_notice', 'p' );

}