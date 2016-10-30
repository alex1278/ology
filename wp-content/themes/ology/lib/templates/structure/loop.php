<?php
/**
 * Echo the posts loop structural markup. It also calls the loop action hooks.
 *
 * @package Structure\Loop
 */


/**
 * Fires before the loop.
 *
 * This hook fires even if no post exists.
 *
 * @since 1.0.0
 */
do_action( 'ology_before_loop' );

	if ( have_posts() && !is_404() ) :

		/**
		 * Fires before posts loop.
		 *
		 * This hook fires if posts exist.
		 *
		 * @since 1.0.0
		 */
		do_action( 'ology_before_posts_loop' );

		while ( have_posts() ) : the_post();

			$article_attributes = array(
				'id' => get_the_ID(), // Automatically escaped.
				'class' => implode( ' ', get_post_class( array( 'uk-article', ( current_theme_supports( 'beans-default-styling' ) ? 'uk-panel-box' : null ) ) ) ), // Automatically escaped.
				'itemscope' => 'itemscope',
				'itemtype' => 'http://schema.org/CreativeWork'
			);

			// Blog specifc attributes.
			if ( 'post' === get_post_type() ) {

				$article_attributes['itemtype']  = 'http://schema.org/BlogPosting';

				// Only add to blogPost attribute to the main query,
				if ( is_main_query() && !is_search() )
					$article_attributes['itemprop']  = 'blogPost';

			}

			echo ology_open_markup( 'ology_post', 'article', $article_attributes );

				echo ology_open_markup( 'ology_post_header', 'header' );

					/**
					 * Fires in the post header.
					 *
					 * @since 1.0.0
					 */
					do_action( 'ology_post_header' );

				echo ology_close_markup( 'ology_post_header', 'header' );

				echo ology_open_markup( 'ology_post_body', 'div' );

					/**
					 * Fires in the post body.
					 *
					 * @since 1.0.0
					 */
					do_action( 'ology_post_body' );

				echo ology_close_markup( 'ology_post_body', 'div' );

			echo ology_close_markup( 'ology_post', 'article' );

		endwhile;

		/**
		 * Fires after the posts loop.
		 *
		 * This hook fires if posts exist.
		 *
		 * @since 1.0.0
		 */
		do_action( 'ology_after_posts_loop' );

	else :

		/**
		 * Fires if no posts exist.
		 *
		 * @since 1.0.0
		 */
		do_action( 'ology_no_post' );

	endif;

/**
 * Fires after the loop.
 *
 * This hook fires even if no post exists.
 *
 * @since 1.0.0
 */
do_action( 'ology_after_loop' );
