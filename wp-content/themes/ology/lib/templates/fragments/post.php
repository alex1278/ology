<?php
/**
 * Echo post fragments.
 *
 * @package Fragments\Post
 */

torbara_add_smart_action( 'torbara_post_header', 'torbara_post_title' );

/**
 * Echo post title.
 *
 * @since 1.0.0
 */
function torbara_post_title() {

	$title = torbara_output( 'torbara_post_title_text', get_the_title() );
	$title_tag = 'h1';

	if ( empty( $title ) )
		return;

	if ( !is_singular() ) {

		$title_link = torbara_open_markup( 'torbara_post_title_link', 'a', array(
			'href' => get_permalink(), // Automatically escaped.
			'title' => the_title_attribute( 'echo=0' ),
			'rel' => 'bookmark'
		) );

			$title_link .= $title;

		$title_link .= torbara_close_markup( 'torbara_post_title_link', 'a' );

		$title = $title_link;
		$title_tag = 'h2';

	}

	echo torbara_open_markup( 'torbara_post_title', $title_tag, array(
		'class' => 'uk-article-title',
		'itemprop' => 'headline'
	) );

		echo wp_kses($title, array('a' => array('href' => array(), 'title' => array() )) );

	echo torbara_close_markup( 'torbara_post_title', $title_tag );

}


torbara_add_smart_action( 'torbara_before_loop', 'torbara_post_search_title' );

/**
 * Echo search post title.
 *
 * @since 1.0.0
 */
function torbara_post_search_title() {

	if ( !is_search() )
		return;

	echo torbara_open_markup( 'torbara_search_title', 'h1', array( 'class' => 'uk-article-title' ) );

		echo torbara_output( 'torbara_search_title_text', esc_html__( 'Search results for: ', 'torbara' ) ) . get_search_query();

	echo torbara_close_markup( 'torbara_search_title', 'h1' );

}


torbara_add_smart_action( 'torbara_post_header', 'torbara_post_meta', 15 );

/**
 * Echo post meta.
 *
 * @since 1.0.0
 */
function torbara_post_meta() {

	/**
	 * Filter whether {@see torbara_post_meta()} should be short-circuit or not.
	 *
	 * @since 1.0.0
	 *
	 * @param bool $pre True to short-circuit, False to let the function run.
	 */
	if ( apply_filters( 'torbara_pre_post_meta', 'post' != get_post_type() ) )
		return;

	echo torbara_open_markup( 'torbara_post_meta', 'ul', array( 'class' => 'uk-article-meta uk-subnav uk-subnav-line' ) );

		/**
		 * Filter the post meta actions and order.
		 *
		 * A do_action( "torbara_post_meta_{$array_key}" ) is called for each array key set. Array values are used to set the priority of
		 * each actions. The array ordered using asort();
		 *
		 * @since 1.0.0
		 *
		 * @param array $fragments An array of fragment files.
		 */
		$meta_items = apply_filters( 'torbara_post_meta_items', array(
			'date' => 10,
			'author' => 20,
			'comments' => 30
		) );

		asort( $meta_items );

		foreach ( $meta_items as $meta => $priority ) {

			if ( !$content = torbara_render_function( 'do_action', "torbara_post_meta_$meta" ) )
				continue;

			echo torbara_open_markup( "torbara_post_meta_item[_{$meta}]", 'li' );

				echo torbara_output( "torbara_post_meta_item_{$meta}_text", $content ) ;

			echo torbara_close_markup( "torbara_post_meta_item[_{$meta}]", 'li' );

		}

	echo torbara_close_markup( 'torbara_post_meta', 'ul' );

}


torbara_add_smart_action( 'torbara_post_body', 'torbara_post_image', 5 );

/**
 * Echo post image.
 *
 * @since 1.0.0
 */
function torbara_post_image() {

	if ( !has_post_thumbnail() || !current_theme_supports( 'post-thumbnails' ) )
		return false;

	global $post;

	/**
	 * Filter whether Beans should handle the image edition (resize) or let WP do so.
	 *
	 * @since 1.2.5
	 *
	 * @param bool $edit True to use Beans Image API to handle the image edition (resize), false to let {@link http://codex.wordpress.org/Function_Reference/the_post_thumbnail the_post_thumbnail()} taking care of it. Default true.
	 */
	$edit = apply_filters( 'torbara_post_image_edit', true );

	if ( $edit ) {

		/**
		 * Filter the arguments used by {@see torbara_edit_image()} to edit the post image.
		 *
		 * @since 1.0.0
		 *
		 * @param bool|array $edit_args Arguments used by {@see torbara_edit_image()}. Set to false to use WordPress
		 *                              large size.
		 */
		$edit_args = apply_filters( 'torbara_edit_post_image_args', array(
			'resize' => array( 800, false )
		) );

		if ( empty( $edit_args ) )
			$image = torbara_get_post_attachment( $post->ID, 'large' );
		else
			$image = torbara_edit_post_attachment( $post->ID, $edit_args );

		/**
		 * Filter the arguments used by {@see torbara_edit_image()} to edit the post small image.
		 *
		 * The small image is only used for screens equal or smaller than the image width set, which is 480px by default.
		 *
		 * @since 1.0.0
		 *
		 * @param bool|array $edit_args Arguments used by {@see torbara_edit_image()}. Set to false to use WordPress
		 *                              small size.
		 */
		$edit_storbara_args = apply_filters( 'torbara_edit_post_image_storbara_args', array(
			'resize' => array( 480, false )
		) );

		if ( empty( $edit_storbara_args ) )
			$image_small = torbara_get_post_attachment( $post->ID, 'thumbnail' );
		else
			$image_small = torbara_edit_post_attachment( $post->ID, $edit_storbara_args );

	}

	echo torbara_open_markup( 'torbara_post_image', 'div', array( 'class' => 'tm-article-image' ) );

		if ( !is_singular() )
			echo torbara_open_markup( 'torbara_post_image_link', 'a', array(
				'href' => get_permalink(), // Automatically escaped.
				'title' => the_title_attribute( 'echo=0' )
			) );

			echo torbara_open_markup( 'torbara_post_image_item_wrap', 'picture' );

				if ( $edit ) {

					echo torbara_selfclose_markup( 'torbara_post_image_storbara_item', 'source', array(
						'media' => '(max-width: ' . $image_small->width . 'px)',
						'srcset' => esc_url( $image_small->src ),
					), $image_small );

					echo torbara_selfclose_markup( 'torbara_post_image_item', 'img', array(
						'width' => $image->width,
						'height' => $image->height,
						'src' => $image->src, // Automatically escaped.
						'alt' => $image->alt, // Automatically escaped.
						'itemprop' => 'image'
					), $image );

				} else {

					// Beans API isn't available, use wp_get_attachment_image_attributes filter instead.
					the_post_thumbnail();

				}

			echo torbara_close_markup( 'torbara_post_image_item_wrap', 'picture' );

		if ( !is_singular() )
			echo torbara_close_markup( 'torbara_post_image_link', 'a' );

	echo torbara_close_markup( 'torbara_post_image', 'div' );

}


torbara_add_smart_action( 'torbara_post_body', 'torbara_post_content' );

/**
 * Echo post content.
 *
 * @since 1.0.0
 */
function torbara_post_content() {

	global $post;

	echo torbara_open_markup( 'torbara_post_content', 'div', array(
		'class' => 'tm-article-content',
		'itemprop' => 'text'
	) );

		the_content();

		if ( is_singular() && 'open' === get_option( 'default_ping_status' ) && post_type_supports( $post->post_type, 'trackbacks' ) ) :

			echo '<!--';
			trackback_rdf();
			echo '-->' . "\n";

		endif;

	echo torbara_close_markup( 'torbara_post_content', 'div' );

}


// Filter.
torbara_add_smart_action( 'the_content_more_link', 'torbara_post_more_link' );

/**
 * Modify post "more link".
 *
 * @since 1.0.0
 *
 * @return string The modified "more link".
 */
function torbara_post_more_link() {

	global $post;

	$output = torbara_open_markup( 'torbara_post_more_link', 'a', array(
		'href' => get_permalink(), // Automatically escaped.
		'class' => 'more-link',
	) );

		$output .= torbara_output( 'torbara_post_more_link_text', esc_html__( 'Continue reading', 'torbara' ) );

		$output .= torbara_open_markup( 'torbara_next_icon[_more_link]', 'i', array(
					'class' => 'uk-icon-angle-double-right uk-margin-small-left'
				) );
		$output .= torbara_close_markup( 'torbara_previous_icon[_more_link]', 'i' );

	$output .= torbara_close_markup( 'torbara_post_more_link', 'a' );

	return $output;

}


torbara_add_smart_action( 'torbara_post_body', 'torbara_post_content_navigation', 20 );

/**
 * Echo post content navigation.
 *
 * @since 1.0.0
 */
function torbara_post_content_navigation() {

	echo wp_link_pages( array(
		'before' => torbara_open_markup( 'torbara_post_content_navigation', 'p', array( 'class' => 'uk-text-bold' ) ) . torbara_output( 'torbara_post_content_navigation_text', esc_html__( 'Pages:', 'torbara' ) ),
		'after' => torbara_close_markup( 'torbara_post_content_navigation', 'p' ),
		'echo' => false
	) );

}


torbara_add_smart_action( 'torbara_post_body', 'torbara_post_meta_categories', 25 );

/**
 * Echo post meta categories.
 *
 * @since 1.0.0
 */
function torbara_post_meta_categories() {

	if ( !$categories = torbara_render_function( 'do_shortcode', '[torbara_post_meta_categories]' ) )
		return;

	echo torbara_open_markup( 'torbara_post_meta_categories', 'span', array( 'class' => 'uk-text-small uk-text-muted uk-clearfix' ) );

		echo  $categories;

	echo torbara_close_markup( 'torbara_post_meta_categories', 'span' );

}


torbara_add_smart_action( 'torbara_post_body', 'torbara_post_meta_tags', 30 );

/**
 * Echo post meta tags.
 *
 * @since 1.0.0
 */
function torbara_post_meta_tags() {

	if ( !$tags = torbara_render_function( 'do_shortcode', '[torbara_post_meta_tags]' ) )
		return;

	echo torbara_open_markup( 'torbara_post_meta_tags', 'span', array( 'class' => 'uk-text-small uk-text-muted uk-clearfix' ) );

		echo  $tags;

	echo torbara_close_markup( 'torbara_post_meta_tags', 'span' );

}


// Filter.
torbara_add_smart_action( 'previous_post_link', 'torbara_previous_post_link', 10, 4 );

/**
 * Modify post "previous link".
 *
 * @since 1.0.0
 *
 * @return string The modified "previous link".
 */
function torbara_previous_post_link( $output, $format, $link, $post ) {

	// Using $link won't apply wp filters, so rather strip tags the $output.
	$text = strip_tags( $output );

	$output = torbara_open_markup( 'torbara_previous_link[_post_navigation]', 'a', array(
		'href' => get_permalink( $post ), // Automatically escaped.
		'ref' => 'previous',
		'title' => $post->post_title // Automatically escaped.
	) );

		$output .= torbara_open_markup( 'torbara_previous_icon[_post_navigation]', 'i', array(
			'class' => 'uk-icon-angle-double-left uk-margin-small-right'
		) );

		$output .= torbara_close_markup( 'torbara_previous_icon[_post_navigation]', 'i' );

		$output .= torbara_output( 'torbara_previous_text[_post_navigation]', $text );

	$output .= torbara_close_markup( 'torbara_previous_link[_post_navigation]', 'a' );

	return $output;

}


// Filter.
torbara_add_smart_action( 'next_post_link', 'torbara_next_post_link', 10, 4 );

/**
 * Modify post "next link".
 *
 * @since 1.0.0
 *
 * @return string The modified "next link".
 */
function torbara_next_post_link( $output, $format, $link, $post ) {

	// Using $link won't apply wp filters, so rather strip tags the $output.
	$text = strip_tags( $output );

	$output = torbara_open_markup( 'torbara_next_link[_post_navigation]', 'a', array(
		'href' => get_permalink( $post ), // Automatically escaped.
		'rel' => 'next',
		'title' => $post->post_title // Automatically escaped.
	) );

		$output .= torbara_output( 'torbara_next_text[_post_navigation]', $text );

		$output .= torbara_open_markup( 'torbara_next_icon[_post_navigation]', 'i', array(
			'class' => 'uk-icon-angle-double-right uk-margin-small-left'
		) );

		$output .= torbara_close_markup( 'torbara_previous_icon[_post_navigation]', 'i' );

	$output .= torbara_close_markup( 'torbara_next_link[_post_navigation]', 'a' );

	return $output;

}


torbara_add_smart_action( 'torbara_post_after_markup', 'torbara_post_navigation' );

/**
 * Echo post navigation.
 *
 * @since 1.0.0
 */
function torbara_post_navigation() {

	/**
	 * Filter whether {@see torbara_post_navigation()} should be short-circuit or not.
	 *
	 * @since 1.0.0
	 *
	 * @param bool $pre True to short-circuit, False to let the function run.
	 */
	if ( apply_filters( 'torbara_pre_post_navigation', !is_singular( 'post' ) ) )
		return;

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next = get_adjacent_post( false, '', false );

	if ( !$next && !$previous )
		return;

	echo torbara_open_markup( 'torbara_post_navigation', 'ul', array(
		'class' => 'uk-pagination',
		'role' => 'navigation'
	) );

		if ( $previous ) :

			// Previous.
			echo torbara_open_markup( 'torbara_post_navigation_item[_previous]', 'li', array( 'class' => 'uk-pagination-previous' ) );

				echo get_previous_post_link( '%link', esc_html__( 'Previous', 'torbara' ) );

			echo torbara_close_markup( 'torbara_post_navigation_item[_previous]', 'li' );

		endif;

		if ( $next ) :

			// Next.
			echo torbara_open_markup( 'torbara_post_navigation_item[_next]', 'li', array( 'class' => 'uk-pagination-next' ) );

				echo get_next_post_link( '%link', esc_html__( 'Next', 'torbara' ) );

			echo torbara_close_markup( 'torbara_post_navigation_item[_next]', 'li' );

		endif;

	echo torbara_close_markup( 'torbara_post_navigation', 'ul' );

}


torbara_add_smart_action( 'torbara_after_posts_loop', 'torbara_posts_pagination' );

/**
 * Echo posts pagination.
 *
 * @since 1.0.0
 */
function torbara_posts_pagination() {

	/**
	 * Filter whether {@see torbara_posts_pagination()} should be short-circuit or not.
	 *
	 * @since 1.0.0
	 *
	 * @param bool $pre True to short-circuit, False to let the function run.
	 */
	if ( apply_filters( 'torbara_pre_post_pagination', is_singular() ) )
		return;

	global $wp_query;

	if ( $wp_query->max_num_pages <= 1 )
		return;

	$current = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$count = intval( $wp_query->max_num_pages );

	echo torbara_open_markup( 'torbara_posts_pagination', 'ul', array(
		'class' => 'uk-pagination uk-grid-margin',
		'role' => 'navigation'
	) );

		// Previous.
		if ( get_previous_posts_link() ) {

			echo torbara_open_markup( 'torbara_posts_pagination_item[_previous]', 'li' );

				echo torbara_open_markup( 'torbara_previous_link[_posts_pagination]', 'a', array(
					'href' => previous_posts( false ) // Automatically escaped.
				), $current );

					echo torbara_open_markup( 'torbara_previous_icon[_posts_pagination]', 'i', array(
						'class' => 'uk-icon-angle-double-left uk-margin-small-right'
					) );

					echo torbara_close_markup( 'torbara_previous_icon[_posts_pagination]', 'i' );

					echo torbara_output( 'torbara_previous_text[_posts_pagination]', esc_html__( 'Previous', 'torbara' ) );

				echo torbara_close_markup( 'torbara_previous_link[_posts_pagination]', 'a' );

			echo torbara_close_markup( 'torbara_posts_pagination_item[_previous]', 'li' );

		}

		// Links.
		foreach ( range( 1, $wp_query->max_num_pages ) as $link ) {

			// Skip if next is set.
			if ( isset( $next ) && $link != $next )
				continue;
			else
				$next = $link + 1;

			$is_separator = array(
				$link != 1, // Not first.
				$current == 1 && $link == 3 ? false : true, // Force first 3 items.
				$count > 3, // More.
				$link != $count, // Not last.
				$link != ( $current - 1 ), // Not previous.
				$link != $current, // Not current.
				$link != ( $current + 1 ), // Not next.
			);

			// Separator.
			if ( !in_array( false, $is_separator ) ) {

				echo torbara_open_markup( 'torbara_posts_pagination_item[_separator]', 'li' );

					echo torbara_output( 'torbara_posts_pagination_item_separator_text', '...' );

				echo torbara_close_markup( 'torbara_posts_pagination_item[_separator]', 'li' );

				// Jump.
				if ( $link < $current )
					$next = $current - 1;
				elseif ( $link > $current )
					$next = $count;

				continue;

			}

			// Integer.
			if ( $link == $current ) {

				echo torbara_open_markup( 'torbara_posts_pagination_item[_active]', 'li', array( 'class' => 'uk-active' ) );

					echo '<span>' . $link . '</span>';

				echo torbara_close_markup( 'torbara_posts_pagination_item[_active]', 'li' );

			} else {

				echo torbara_open_markup( 'torbara_posts_pagination_item', 'li' );

					echo torbara_open_markup( 'torbara_posts_pagination_item_link', 'a', array(
						'href' => get_pagenum_link( $link ) // Automatically escaped.
					), $link );

						echo torbara_output( 'torbara_posts_pagination_item_link_text', $link );

					echo torbara_close_markup( 'torbara_posts_pagination_item_link', 'a' );

				echo torbara_close_markup( 'torbara_posts_pagination_item', 'li' );

			}

		}

		// Next.
		if ( get_next_posts_link() ) {

			echo torbara_open_markup( 'torbara_posts_pagination_item[_next]', 'li' );

				echo torbara_open_markup( 'torbara_next_link[_posts_pagination]', 'a', array(
					'href' => next_posts( $count, false ) // Automatically escaped.
				), $current );

					echo torbara_output( 'torbara_next_text[_posts_pagination]', esc_html__( 'Next', 'torbara' ) );

					echo torbara_open_markup( 'torbara_next_icon[_posts_pagination]', 'i', array(
						'class' => 'uk-icon-angle-double-right uk-margin-small-left'
					) );

					echo torbara_close_markup( 'torbara_next_icon[_posts_pagination]', 'i' );

				echo torbara_close_markup( 'torbara_next_link[_posts_pagination]', 'a' );

			echo torbara_close_markup( 'torbara_posts_pagination_item[_next]', 'li' );

		}

	echo torbara_close_markup( 'torbara_posts_pagination', 'ul' );

}


torbara_add_smart_action( 'torbara_no_post', 'torbara_no_post' );

/**
 * Echo no post content.
 *
 * @since 1.0.0
 */
function torbara_no_post() {

	echo torbara_open_markup( 'torbara_post', 'article', array( 'class' => 'tm-no-article uk-article' . ( current_theme_supports( 'beans-default-styling' ) ? ' uk-panel-box' : null ) ) );

		echo torbara_open_markup( 'torbara_post_header', 'header' );

			echo torbara_open_markup( 'torbara_post_title', 'h1', array( 'class' => 'uk-article-title' ) );

				echo torbara_output( 'torbara_no_post_article_title_text', esc_html__( 'Whoops, no result found!', 'torbara' ) );

			echo torbara_close_markup( 'torbara_post_title', 'h1' );

		echo torbara_close_markup( 'torbara_post_header', 'header' );

		echo torbara_open_markup( 'torbara_post_body', 'div' );

			echo torbara_open_markup( 'torbara_post_content', 'div', array( 'class' => 'tm-article-content' ) );

				echo torbara_open_markup( 'torbara_no_post_article_content', 'p', array( 'class' => 'uk-alert uk-alert-warning' ) );

					echo torbara_output( 'torbara_no_post_article_content_text', esc_html__( 'It looks like nothing was found at this location. Maybe try a search?', 'torbara' ) );

				echo torbara_close_markup( 'torbara_no_post_article_content', 'p' );

					echo torbara_output( 'torbara_no_post_search_form', get_search_form( false ) );

			echo torbara_close_markup( 'torbara_post_content', 'div' );

		echo torbara_close_markup( 'torbara_post_body', 'div' );

	echo torbara_close_markup( 'torbara_post', 'article' );

}


// Filter.
torbara_add_smart_action( 'the_password_form', 'torbara_post_password_form' );

/**
 * Modify password protected form.
 *
 * @since 1.0.0
 *
 * @return string The form.
 */
function torbara_post_password_form() {

	global $post;

	$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );

	// Notice.
	$output = torbara_open_markup( 'torbara_password_form_notice', 'p', array( 'class' => 'uk-alert uk-alert-warning' ) );

		$output .= torbara_output( 'torbara_password_form_notice_text', esc_html__( 'This post is protected. To view it, enter the password below!', 'torbara' ) );

	$output .= torbara_close_markup( 'torbara_password_form_notice', 'p' );

	// Form.
	$output .= torbara_open_markup( 'torbara_password_form', 'form', array(
		'class' => 'uk-form uk-margin-bottom',
		'method' => 'post',
		'action' => site_url( 'wp-login.php?action=postpass', 'login_post' ) // Automatically escaped.
	) );

		$output .= torbara_selfclose_markup( 'torbara_password_form_input', 'input', array(
			'class' => 'uk-margin-small-top uk-margin-small-right',
			'type' => 'password',
			'placeholder' => apply_filters( 'torbara_password_form_input_placeholder', esc_html__( 'Password', 'torbara' ) ), // Automatically escaped.
			'name' => 'post_password'
		) );

		$output .= torbara_selfclose_markup( 'torbara_password_form_submit', 'input', array(
			'class' => 'uk-button uk-margin-small-top',
			'type' => 'submit',
			'name' => 'submit',
			'value' => esc_attr( apply_filters( 'torbara_password_form_submit_text', esc_html__( 'Submit', 'torbara' ) ) )
		) );

	$output .= torbara_close_markup( 'torbara_password_form', 'form' );

	return $output;

}


// Filter.
torbara_add_smart_action( 'post_gallery', 'torbara_post_gallery', 10, 3 );

/**
 * Modify WP {@link https://codex.wordpress.org/Function_Reference/gallery_shortcode Gallery Shortcode} output.
 *
 * This implements the functionality of the Gallery Shortcode for displaying WordPress images in a post.
 *
 * @since 1.3.0
 *
 * @param string $output   The gallery output. Default empty.
 * @param array  $attr     Attributes of the {@link https://codex.wordpress.org/Function_Reference/gallery_shortcode gallery_shortcode()}.
 * @param int    $instance Unique numeric ID of this gallery shortcode instance.
 *
 * @return string HTML content to display gallery.
 */
function torbara_post_gallery( $output, $attr, $instance ) {

	$post = get_post();
	$html5 = current_theme_supports( 'html5', 'gallery' );
	$defaults = array(
		'order' => 'ASC',
		'orderby' => 'menu_order ID',
		'id' => $post ? $post->ID : 0,
		'itemtag' => $html5 ? 'figure' : 'dl',
		'icontag' => $html5 ? 'div' : 'dt',
		'captiontag' => $html5 ? 'figcaption' : 'dd',
		'columns' => 3,
		'size' => 'thumbnail',
		'include' => '',
		'exclude' => '',
		'link' => ''
	);
	$atts = shortcode_atts( $defaults, $attr, 'gallery' );
	$id = intval( $atts['id'] );

	// Set attachements.
	if ( !empty( $atts['include'] ) ) {

		$_attachments = get_posts( array(
			'include' => $atts['include'],
			'post_status' => 'inherit',
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'order' => $atts['order'],
			'orderby' => $atts['orderby']
		) );

		$attachments = array();

		foreach ( $_attachments as $key => $val )
			$attachments[$val->ID] = $_attachments[$key];

	} elseif ( !empty( $atts['exclude'] ) ) {

		$attachments = get_children( array(
			'post_parent' => $id,
			'exclude' => $atts['exclude'],
			'post_status' => 'inherit',
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'order' => $atts['order'],
			'orderby' => $atts['orderby']
		) );

	} else {

		$attachments = get_children( array(
			'post_parent' => $id,
			'post_status' => 'inherit',
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'order' => $atts['order'],
			'orderby' => $atts['orderby']
		) );

	}

	// Stop here if no attachment.
	if ( empty( $attachments ) )
		return '';

	if ( is_feed() ) {

		$output = "\n";

		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";

		return $output;

	}

	// Valid tags.
	$valid_tags = wp_kses_allowed_html( 'post' );
	$validate = array(
		'itemtag',
		'captiontag',
		'icontag'
	);

	// Validate tags.
	foreach ( $validate as $tag )
		if ( !isset( $valid_tags[$atts[$tag]] ) )
			$atts[$tag] = $defaults[$tag];

	// Set variables used in the output.
	$columns = intval( $atts['columns'] );
	$size_class = sanitize_html_class( $atts['size'] );

	// WP adds the opening div in the gallery_style filter (weird), so we follow it as don't want to break people's site.
	$gallery_div = torbara_open_markup( "torbara_post_gallery[_{$id}]", 'div', array(
		'class' => "uk-grid uk-grid-width-small-1-{$columns} gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}", // Automatically escaped.
		'data-uk-grid-margin' => false
	), $id, $columns );

	/**
	 * Apply WP core filter. Filter the default gallery shortcode CSS styles.
	 *
	 * Documented in WordPress.
	 *
	 * @ignore
	 */
	$output = apply_filters( 'gallery_style', $gallery_div );

		$i = 0; foreach ( $attachments as $attachment_id => $attachment ) {

			$attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "gallery-{$instance}-{$id}" ) : '';
			$image_meta = wp_get_attachment_metadata( $attachment_id );
			$orientation = '';

			if ( isset( $image_meta['height'], $image_meta['width'] ) )
				$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';

			// Set the image output.
			if ( 'none' === $atts['link'] )
				$image_output = wp_get_attachment_image( $attachment_id, $atts['size'], false, $attr );
			else
				$image_output = wp_get_attachment_link( $attachment_id, $atts['size'], ( 'file' !== $atts['link'] ), false, false, $attr );

			$output .= torbara_open_markup( "torbara_post_gallery_item[_{$attachment_id}]", $atts['itemtag'], array( 'class' => 'gallery-item' ) );

				$output .= torbara_open_markup( "torbara_post_gallery_icon[_{$attachment_id}]", $atts['icontag'], array( 'class' => "gallery-icon {$orientation}" ) ); // Automatically escaped.

					$output .= torbara_output( "torbara_post_gallery_icon[_{$attachment_id}]", $image_output, $attachment_id, $atts );

				$output .= torbara_close_markup( "torbara_post_gallery_icon[_{$attachment_id}]", $atts['icontag'] );

				if ( $atts['captiontag'] && trim( $attachment->post_excerpt ) ) {

					$output .= torbara_open_markup( "torbara_post_gallery_caption[_{$attachment_id}]", $atts['captiontag'], array( 'class' => 'wp-caption-text gallery-caption' ) );

						$output .= torbara_output( "torbara_post_gallery_caption_text[_{$attachment_id}]", wptexturize( $attachment->post_excerpt ) );

					$output .= torbara_close_markup( "torbara_post_gallery_caption[_{$attachment_id}]", $atts['captiontag'] );

				}

			$output .= torbara_close_markup( "torbara_post_gallery_item[_{$attachment_id}]", $atts['itemtag'] );

		}

	$output .= torbara_close_markup( "torbara_post_gallery[_{$id}]", 'div' );

	return $output;

}
