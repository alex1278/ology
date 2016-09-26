<?php
/**
 * Deprecated fragments.
 *
 * @package Fragments\Deprecated
 */


/**
 * Deprecated. Echo head title.
 *
 * This function is deprecated since it was replaced by the 'title-tag' theme support.
 *
 * @since 1.0.0
 * @deprecated 1.2.0
 */
function ology_head_title() {

	_deprecated_function( __FUNCTION__, '1.2.0', 'wp_title()' );

	wp_title( '|', true, 'right' );

}


/**
 * Deprecated. Modify head wp title.
 *
 * This function is deprecated since it was replaced by the 'title-tag' theme support.
 *
 * @since 1.0.0
 * @deprecated 1.2.0
 *
 * @param string $title The WordPress default title.
 * @param string $sep The title separator.
 *
 * @return string The modified title.
 */
function ology_wp_title( $title, $sep ) {

	_deprecated_function( __FUNCTION__, '1.2.0', 'wp_title()' );

	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name.
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	if ( ( $site_description = get_bloginfo( 'description', 'display' ) ) && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( esc_html__( 'Page %s', 'ology' ), max( $paged, $page ) );

	return $title;

}


/**
 * Deprecated shortcodes.
 *
 * We declare the shortcodes for backward compatibility purposes but it shouldn't be used for further development.
 *
 * @deprecated 1.2.0
 *
 * @ignore
 */
global $shortcode_tags;

$shortcode_tags = array_merge( $shortcode_tags, array(
	'ology_post_meta_date' => 'ology_post_meta_date_shortcode',
	'ology_post_meta_author' => 'ology_post_meta_author_shortcode',
	'ology_post_meta_comments' => 'ology_post_meta_comments_shortcode',
	'ology_post_meta_tags' => 'ology_post_meta_tags_shortcode',
	'ology_post_meta_categories' => 'ology_post_meta_categories_shortcode'
) );