<?php
/**
 * Echo the structural markup that wraps around comments. It also calls the comments action hooks.
 *
 * This template will return empty if the post which is called is password protected.
 *
 * @package Structure\Comments
 */

// Stop here if the post is password protected.
if (post_password_required()) {
    return;
}

echo ology_open_markup( 'ology_comments', 'div', array( 'id' => 'comments', 'class' => 'tm-comments' . ( current_theme_supports( 'beans-default-styling' ) ? ' uk-panel-box' : null ) ) );

	if ( comments_open() || get_comments_number() ) :

		if ( have_comments() ) :

			echo ology_open_markup( 'ology_comments_list', 'ol', array( 'class' => 'uk-comment-list' ) );

				wp_list_comments( array(
					'avatar_size' => 50,
					'callback' => 'ology_comment_callback'
				) );

			echo ology_close_markup( 'ology_comments_list', 'ol' );

		else :

			/**
			 * Fires if no comments exist.
			 *
			 * This hook only fires if comments are open.
			 *
			 * @since 1.0.0
			 */
			do_action( 'ology_no_comment' );

		endif;

		/**
		 * Fires after the comments list.
		 *
		 * This hook only fires if comments are open.
		 *
		 * @since 1.0.0
		 */
		do_action( 'ology_after_open_comments' );

	endif;

	if ( !comments_open() ) :

		/**
		 * Fires if comments are closed.
		 *
		 * @since 1.0.0
		 */
		do_action( 'ology_comments_closed' );

	endif;

echo ology_close_markup( 'ology_comments', 'div' );