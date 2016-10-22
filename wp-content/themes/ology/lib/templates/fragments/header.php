<?php
/**
 * Echo header fragments.
 *
 * @package Fragments\Header
 */

torbara_add_smart_action( 'torbara_head', 'torbara_head_meta', 0 );

/**
 * Echo head meta.
 *
 * @since 1.0.0
 */
function torbara_head_meta() {

	echo '<meta charset="' . get_bloginfo( 'charset' ) . '" />' . "\n";
	echo '<meta name="viewport" content="width=device-width, initial-scale=1" />' . "\n";

}


torbara_add_smart_action( 'wp_head', 'torbara_head_pingback' );

/**
 * Echo head pingback.
 *
 * @since 1.0.0
 */
function torbara_head_pingback() {

	echo '<link rel="pingback" href="' . get_bloginfo( 'pingback_url' ) . '">' . "\n";

}


torbara_add_smart_action( 'wp_head', 'torbara_header_image' );

/**
 * Print the header image css inline in the header.
 *
 * @since 1.0.0
 */
function torbara_header_image() {

	if ( !current_theme_supports( 'custom-header' ) || !( $header_image = get_header_image() ) || empty( $header_image ) )
		return;
}


torbara_add_smart_action( 'torbara_header', 'torbara_site_branding' );

/**
 * Echo header site branding.
 *
 * @since 1.0.0
 */
function torbara_site_branding() {

	echo torbara_open_markup( 'torbara_site_branding', 'div', array(
		'class' => 'tm-site-branding uk-float-left' . ( !get_bloginfo( 'description' ) ? ' uk-margin-small-top' : null ),
	) );

		echo torbara_open_markup( 'torbara_site_title_link', 'a', array(
			'href' => home_url('/'), // Automatically escaped.
			'rel' => 'home',
			'itemprop' => 'headline'
		) );

			if ( $logo = get_theme_mod( 'torbara_logo_image', false ) )
				echo torbara_selfclose_markup( 'torbara_logo_image', 'img', array(
					'class' => 'tm-logo',
					'src' => $logo, // Automatically escaped.
					'alt' => get_bloginfo( 'name' ), // Automatically escaped.
				) );
			else
				echo torbara_output( 'torbara_site_title_text', get_bloginfo( 'name' ) );

		echo torbara_close_markup( 'torbara_site_title_link', 'a' );

	echo torbara_close_markup( 'torbara_site_branding', 'div' );

}


torbara_add_smart_action( 'torbara_site_branding_append_markup', 'torbara_site_title_tag' );

/**
 * Echo header site title tag.
 *
 * @since 1.0.0
 */
function torbara_site_title_tag() {

	// Stop here if there isn't a description.
	if ( !$description = get_bloginfo( 'description' ) )
		return;

	echo torbara_open_markup( 'torbara_site_title_tag', 'span', array(
		'class' => 'tm-site-title-tag uk-text-small uk-text-muted uk-display-block',
		'itemprop' => 'description'
	) );

		echo torbara_output( 'torbara_site_title_tag_text', $description );

	echo torbara_close_markup( 'torbara_site_title_tag', 'span' );

}