<?php
/**
 * Add post shortcodes.
 *
 * @package Fragments\Post_Shortcodes
 */

ology_add_smart_action( 'ology_post_meta_date', 'ology_post_meta_date_shortcode' );

/**
 * Echo post meta date shortcode.
 *
 * @since 1.0.0
 */
function ology_post_meta_date_shortcode() {

	echo ology_output( 'ology_post_meta_date_prefix', esc_html__( 'Posted on ', 'ology' ) );

	echo ology_open_markup( 'ology_post_meta_date', 'time', array(
		'datetime' => get_the_time( 'c' ),
		'itemprop' => 'datePublished',
	) );

		echo ology_output( 'ology_post_meta_date_text', get_the_time( get_option( 'date_format' ) ) );

	echo ology_close_markup( 'ology_post_meta_date', 'time' );

}


ology_add_smart_action( 'ology_post_meta_author', 'ology_post_meta_author_shortcode' );

/**
 * Echo post meta author shortcode.
 *
 * @since 1.0.0
 */
function ology_post_meta_author_shortcode() {

	ology_output( 'ology_post_meta_author_prefix', esc_html__( 'By ', 'ology' ) ) ;

	echo ology_open_markup( 'ology_post_meta_author', 'a', array(
		'href' => get_author_posts_url( get_the_author_meta( 'ID' ) ), // Automatically escaped.
		'rel' => 'author',
		'itemprop' => 'author',
		'itemtype' => 'http://schema.org/Person'
	) );

		echo ology_output( 'ology_post_meta_author_text', get_the_author() );

	echo ology_close_markup( 'ology_post_meta_author', 'a' );

}


ology_add_smart_action( 'ology_post_meta_comments', 'ology_post_meta_comments_shortcode' );

/**
 * Echo post meta comments shortcode.
 *
 * @since 1.0.0
 */
function ology_post_meta_comments_shortcode() {

	global $post;

	if ( post_password_required() || !comments_open() )
		return;

	$comments_number = (int) get_comments_number( $post->ID );

	if ( $comments_number < 1 )
		$comment_text = ology_output( 'ology_post_meta_empty_comment_text', esc_html__( 'Leave a comment', 'ology' ) );
	else if ( $comments_number === 1 )
		$comment_text = ology_output( 'ology_post_meta_comments_text_singular', esc_html__( '1 comment', 'ology' ) );
	else
		$comment_text = ology_output( 'ology_post_meta_comments_text_plurial', esc_html__( '%s comments', 'ology' ) );

	echo ology_open_markup( 'ology_post_meta_comments', 'a', array(
		'href' => get_comments_link() // Automatically escaped.
	) );

		printf( $comment_text, (int) get_comments_number( $post->ID ) );

	echo ology_close_markup( 'ology_post_meta_comments', 'a' );

}


ology_add_smart_action( 'ology_post_meta_tags', 'ology_post_meta_tags_shortcode' );

/**
 * Echo post meta tags shortcode.
 *
 * @since 1.0.0
 */
function ology_post_meta_tags_shortcode() {

	$tags = get_the_tag_list( null, ', ' );

	if ( !$tags || is_wp_error( $tags ) )
		return;

	echo ology_output( 'ology_post_meta_tags_prefix', esc_html__( 'Tagged with: ', 'ology' ) ) . $tags;

}


ology_add_smart_action( 'ology_post_meta_categories', 'ology_post_meta_categories_shortcode' );

/**
 * Echo post meta categories shortcode.
 *
 * @since 1.0.0
 */
function ology_post_meta_categories_shortcode() {

	$categories = get_the_category_list( ', ' );

	if ( !$categories || is_wp_error( $categories ) )
		return;

	echo ology_output( 'ology_post_meta_categories_prefix', esc_html__( 'Filed under: ', 'ology' ) ) . $categories;

}
