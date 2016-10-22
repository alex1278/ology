<?php
/**
 * Add post shortcodes.
 *
 * @package Fragments\Post_Shortcodes
 */

torbara_add_smart_action( 'torbara_post_meta_date', 'torbara_post_meta_date_shortcode' );

/**
 * Echo post meta date shortcode.
 *
 * @since 1.0.0
 */
function torbara_post_meta_date_shortcode() {

	echo torbara_output( 'torbara_post_meta_date_prefix', esc_html__( 'Posted on ', 'torbara' ) );

	echo torbara_open_markup( 'torbara_post_meta_date', 'time', array(
		'datetime' => get_the_time( 'c' ),
		'itemprop' => 'datePublished',
	) );

		echo torbara_output( 'torbara_post_meta_date_text', get_the_time( get_option( 'date_format' ) ) );

	echo torbara_close_markup( 'torbara_post_meta_date', 'time' );

}


torbara_add_smart_action( 'torbara_post_meta_author', 'torbara_post_meta_author_shortcode' );

/**
 * Echo post meta author shortcode.
 *
 * @since 1.0.0
 */
function torbara_post_meta_author_shortcode() {

	torbara_output( 'torbara_post_meta_author_prefix', esc_html__( 'By ', 'torbara' ) ) ;

	echo torbara_open_markup( 'torbara_post_meta_author', 'a', array(
		'href' => get_author_posts_url( get_the_author_meta( 'ID' ) ), // Automatically escaped.
		'rel' => 'author',
		'itemprop' => 'author',
		'itemtype' => 'http://schema.org/Person'
	) );

		echo torbara_output( 'torbara_post_meta_author_text', get_the_author() );

	echo torbara_close_markup( 'torbara_post_meta_author', 'a' );

}


torbara_add_smart_action( 'torbara_post_meta_comments', 'torbara_post_meta_comments_shortcode' );

/**
 * Echo post meta comments shortcode.
 *
 * @since 1.0.0
 */
function torbara_post_meta_comments_shortcode() {

	global $post;

	if ( post_password_required() || !comments_open() )
		return;

	$comments_number = (int) get_comments_number( $post->ID );

	if ( $comments_number < 1 )
		$comment_text = torbara_output( 'torbara_post_meta_empty_comment_text', esc_html__( 'Leave a comment', 'torbara' ) );
	else if ( $comments_number === 1 )
		$comment_text = torbara_output( 'torbara_post_meta_comments_text_singular', esc_html__( '1 comment', 'torbara' ) );
	else
		$comment_text = torbara_output( 'torbara_post_meta_comments_text_plurial', esc_html__( '%s comments', 'torbara' ) );

	echo torbara_open_markup( 'torbara_post_meta_comments', 'a', array(
		'href' => get_comments_link() // Automatically escaped.
	) );

		printf( $comment_text, (int) get_comments_number( $post->ID ) );

	echo torbara_close_markup( 'torbara_post_meta_comments', 'a' );

}


torbara_add_smart_action( 'torbara_post_meta_tags', 'torbara_post_meta_tags_shortcode' );

/**
 * Echo post meta tags shortcode.
 *
 * @since 1.0.0
 */
function torbara_post_meta_tags_shortcode() {

	$tags = get_the_tag_list( null, ', ' );

	if ( !$tags || is_wp_error( $tags ) )
		return;

	echo torbara_output( 'torbara_post_meta_tags_prefix', esc_html__( 'Tagged with: ', 'torbara' ) ) . $tags;

}


torbara_add_smart_action( 'torbara_post_meta_categories', 'torbara_post_meta_categories_shortcode' );

/**
 * Echo post meta categories shortcode.
 *
 * @since 1.0.0
 */
function torbara_post_meta_categories_shortcode() {

	$categories = get_the_category_list( ', ' );

	if ( !$categories || is_wp_error( $categories ) )
		return;

	echo torbara_output( 'torbara_post_meta_categories_prefix', esc_html__( 'Filed under: ', 'torbara' ) ) . $categories;

}
