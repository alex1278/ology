<?php
/**
 * Echo the structural markup for each comment. It also calls the comment action hooks.
 *
 * @package Structure\Comment
 */

echo ology_open_markup( 'ology_comment', 'article', array(
	'id' => 'div-comment-' . get_comment_ID(), // Automatically escaped.
	'class' => 'uk-comment',
	'itemprop' => 'comment',
	'itemscope' => 'itemscope',
	'itemtype' => 'http://schema.org/Comment'
) );

	echo ology_open_markup( 'ology_comment_header', 'header', array( 'class' => 'uk-comment-header' ) );

		/**
		 * Fires in the comment header.
		 *
		 * @since 1.0.0
		 */
		do_action( 'ology_comment_header' );

	echo ology_close_markup( 'ology_comment_header', 'header' );

	echo ology_open_markup( 'ology_comment_body', 'div', array( 'class' => 'uk-comment-body', 'itemprop' => 'text' ) );

		/**
		 * Fires in the comment body.
		 *
		 * @since 1.0.0
		 */
		do_action( 'ology_comment_content' );

	echo ology_close_markup( 'ology_comment_body', 'div' );

echo ology_close_markup( 'ology_comment', 'article' );
