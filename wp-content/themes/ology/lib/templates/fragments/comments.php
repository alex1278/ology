<?php
/**
 * Echo comments fragments.
 *
 * @package Fragments\Comments
 */

torbara_add_smart_action( 'torbara_comments_list_before_markup', 'torbara_comments_title' );

/**
 * Echo the comments title.
 *
 * @since 1.0.0
 */
function torbara_comments_title() {

	echo torbara_open_markup( 'torbara_comments_title', 'h2' );

		echo torbara_output( 'torbara_comments_title_text', sprintf(
			esc_html(_n( '%s Comment', '%s Comments', get_comments_number(), 'torbara' )),
			number_format_i18n( get_comments_number() )
		) );

	echo torbara_close_markup( 'torbara_comments_title', 'h2' );

}


torbara_add_smart_action( 'torbara_comment_header', 'torbara_comment_avatar', 5 );

/**
 * Echo the comment avatar.
 *
 * @since 1.0.0
 */
function torbara_comment_avatar() {

	global $comment;

	// Stop here if no avatar.
	if ( !$avatar = get_avatar( $comment, $comment->args['avatar_size'] ) )
		return;

	echo torbara_open_markup( 'torbara_comment_avatar', 'div', array( 'class' => 'uk-comment-avatar' ) );

		echo  $avatar;

	echo torbara_close_markup( 'torbara_comment_avatar', 'div' );

}


torbara_add_smart_action( 'torbara_comment_header', 'torbara_comment_author' );

/**
 * Echo the comment author title.
 *
 * @since 1.0.0
 */
function torbara_comment_author() {

	echo torbara_open_markup( 'torbara_comment_title', 'div', array(
		'class' => 'uk-comment-title',
		'itemprop' => 'author',
		'itemscope' => 'itemscope',
		'itemtype' => 'http://schema.org/Person'
	) );

		echo get_comment_author_link();

	echo torbara_close_markup( 'torbara_comment_title', 'div' );

}


torbara_add_smart_action( 'torbara_comment_title_append_markup', 'torbara_comment_badges' );

/**
 * Echo the comment badges.
 *
 * @since 1.0.0
 */
function torbara_comment_badges() {

	global $comment;

	// Trackback badge.
	if ( $comment->comment_type == 'trackback' ) {

		echo torbara_open_markup( 'torbara_trackback_badge', 'span', array( 'class' => 'uk-badge uk-margin-small-left' ) );

			echo torbara_output( 'torbara_trackback_text', esc_html__( 'Trackback', 'torbara' ) );

		echo torbara_close_markup( 'torbara_trackback_badge', 'span' );

	}

	// Pindback badge.
	if ( $comment->comment_type == 'pingback' ) {

		echo torbara_open_markup( 'torbara_pingback_badge', 'span', array( 'class' => 'uk-badge uk-margin-small-left' ) );

			echo torbara_output( 'torbara_pingback_text', esc_html__( 'Pingback', 'torbara' ) );

		echo torbara_close_markup( 'torbara_pingback_badge', 'span' );


	}

	// Moderation badge.
	if ( '0' == $comment->comment_approved ) {

		echo torbara_open_markup( 'torbara_moderation_badge', 'span', array( 'class' => 'uk-badge uk-margin-small-left uk-badge-warning' ) );

			echo torbara_output( 'torbara_moderation_text', esc_html__( 'Awaiting Moderation', 'torbara' ) );

		echo torbara_close_markup( 'torbara_moderation_badge', 'span' );


	}

	// Moderator badge.
	if ( user_can( $comment->user_id, 'moderate_comments' ) ) {

		echo torbara_open_markup( 'torbara_moderator_badge', 'span', array( 'class' => 'uk-badge uk-margin-small-left' ) );

			echo torbara_output( 'torbara_moderator_text', esc_html__( 'Moderator', 'torbara' ) );

		echo torbara_close_markup( 'torbara_moderator_badge', 'span' );


	}

}


torbara_add_smart_action( 'torbara_comment_header', 'torbara_comment_metadata', 15 );

/**
 * Echo the comment metadata.
 *
 * @since 1.0.0
 */
function torbara_comment_metadata() {

	echo torbara_open_markup( 'torbara_comment_meta', 'div', array( 'class' => 'uk-comment-meta' ) );

		echo torbara_open_markup( 'torbara_comment_time', 'time', array(
			'datetime' => get_comment_time( 'c' ),
			'itemprop' => 'datePublished'
		) );

			echo torbara_output( 'torbara_comment_time_text', sprintf(
				esc_attr_x( '%1$s at %2$s', '1: date, 2: time', 'torbara' ),
				get_comment_date(),
				get_comment_time()
			) );

		echo torbara_close_markup( 'torbara_comment_time', 'time' );

	echo torbara_close_markup( 'torbara_comment_meta', 'div' );

}


torbara_add_smart_action( 'torbara_comment_content', 'torbara_comment_content' );

/**
 * Echo the comment content.
 *
 * @since 1.0.0
 */
function torbara_comment_content() {

	echo torbara_output( 'torbara_comment_content', torbara_render_function( comment_text() ) );

}


torbara_add_smart_action( 'torbara_comment_content', 'torbara_comment_links', 15 );

/**
 * Echo the comment links.
 *
 * @since 1.0.0
 */
function torbara_comment_links() {

	global $comment;

	echo torbara_open_markup( 'torbara_comment_links', 'ul', array( 'class' => 'tm-comment-links uk-subnav uk-subnav-line' ) );

		// Reply.
		echo get_comment_reply_link( array_merge( $comment->args, array(
			'add_below' => 'comment-content',
			'depth' => $comment->depth,
			'max_depth' => $comment->args['max_depth'],
			'before' => torbara_open_markup( 'torbara_comment_item[_reply]', 'li' ),
			'after' => torbara_close_markup( 'torbara_comment_item[_reply]', 'li' )
		) ) );

		// Edit.
		if ( current_user_can( 'moderate_comments' ) ) :

			echo torbara_open_markup( 'torbara_comment_item[_edit]', 'li' );

				echo torbara_open_markup( 'torbara_comment_item_link[_edit]', 'a', array(
					'href' => get_edit_comment_link( $comment->comment_ID ) // Automatically escaped.
				) );

					echo torbara_output( 'torbara_comment_edit_text', esc_html__( 'Edit', 'torbara' ) );

				echo torbara_close_markup( 'torbara_comment_item_link[_edit]', 'a' );

			echo torbara_close_markup( 'torbara_comment_item[_edit]', 'li' );

		endif;

		// Link.
		echo torbara_open_markup( 'torbara_comment_item[_link]', 'li' );

			echo torbara_open_markup( 'torbara_comment_item_link[_link]', 'a', array(
				'href' => get_comment_link( $comment->comment_ID ) // Automatically escaped.
			) );

				echo torbara_output( 'torbara_comment_link_text', esc_html__( 'Link', 'torbara' ) );

			echo torbara_close_markup( 'torbara_comment_item_link[_link]', 'a' );

		echo torbara_close_markup( 'torbara_comment_item[_link]', 'li' );

	echo torbara_close_markup( 'torbara_comment_links', 'ul' );

}


torbara_add_smart_action( 'torbara_no_comment', 'torbara_no_comment' );

/**
 * Echo no comment content.
 *
 * @since 1.0.0
 */
function torbara_no_comment() {

	echo torbara_open_markup( 'torbara_no_comment', 'p', 'class=uk-text-muted' );

		echo torbara_output( 'torbara_no_comment_text', esc_html__( 'No comment yet, add your voice below!', 'torbara' ) );

	echo torbara_close_markup( 'torbara_no_comment', 'p' );

}


torbara_add_smart_action( 'torbara_comments_closed', 'torbara_comments_closed' );

/**
 * Echo closed comments content.
 *
 * @since 1.0.0
 */
function torbara_comments_closed() {

	echo torbara_open_markup( 'torbara_comments_closed', 'p', array( 'class' => 'uk-alert uk-alert-warning uk-margin-bottom-remove' ) );

		echo torbara_output( 'torbara_comments_closed_text', esc_html__( 'Comments are closed for this article!', 'torbara' ) );

	echo torbara_close_markup( 'torbara_comments_closed', 'p' );

}


torbara_add_smart_action( 'torbara_comments_list_after_markup', 'torbara_comments_navigation' );

/**
 * Echo comments navigation.
 *
 * @since 1.0.0
 */
function torbara_comments_navigation() {

	if ( get_comment_pages_count() <= 1 && !get_option( 'page_comments' ) )
		return;

	echo torbara_open_markup( 'torbara_comments_navigation', 'ul', array(
		'class' => 'uk-pagination',
		'role' => 'navigation'
	) );

		// Previous.
		if ( get_previous_comments_link() ) {

			echo torbara_open_markup( 'torbara_comments_navigation_item[_previous]', 'li', array( 'class' => 'uk-pagination-previous' ) );

				$previous_icon = torbara_open_markup( 'torbara_previous_icon[_comments_navigation]', 'i', array(
					'class' => 'uk-icon-angle-double-left uk-margin-small-right'
				) );
				$previous_icon .= torbara_close_markup( 'torbara_previous_icon[_comments_navigation]', 'i' );

				echo get_previous_comments_link(
					$previous_icon . torbara_output( 'torbara_previous_text[_comments_navigation]', esc_html__( 'Previous', 'torbara' ) )
				);

			echo torbara_close_markup( 'torbara_comments_navigation_item[_previous]', 'li' );

		}

		// Next.
		if ( get_next_comments_link() ) {

			echo torbara_open_markup( 'torbara_comments_navigation_item[_next]', 'li', array( 'class' => 'uk-pagination-next' ) );

				$next_icon = torbara_open_markup( 'torbara_next_icon[_comments_navigation]', 'i', array(
					'class' => 'uk-icon-angle-double-right uk-margin-small-right'
				) );
				$next_icon .= torbara_close_markup( 'torbara_previous_icon[_comments_navigation]', 'i' );

				echo get_next_comments_link(
					torbara_output( 'torbara_next_text[_comments_navigation]', esc_html__( 'Next', 'torbara' ) ) . $next_icon
				);

			echo torbara_close_markup( 'torbara_comments_navigation_item_[_next]', 'li' );

		}

	echo torbara_close_markup( 'torbara_comments_navigation', 'ul' );

}


torbara_add_smart_action( 'torbara_after_open_comments', 'torbara_comment_form_divider' );

/**
 * Echo comment divider.
 *
 * @since 1.0.0
 */
function torbara_comment_form_divider() {

	echo torbara_selfclose_markup( 'torbara_comment_form_divider', 'hr', array( 'class' => 'uk-article-divider' ) );

}


torbara_add_smart_action( 'torbara_after_open_comments', 'torbara_comment_form' );

/**
 * Echo comment navigation.
 *
 * @since 1.0.0
 */
function torbara_comment_form() {

	$output = torbara_open_markup( 'torbara_comment_form_wrap', 'div', array( 'class' => 'uk-form tm-comment-form-wrap' ) );

		$output .= torbara_render_function( 'comment_form', array(
			'title_reply' => torbara_output( 'torbara_comment_form_title_text', esc_html__( 'Add a Comment', 'torbara' ) )
		) );

	$output .= torbara_close_markup( 'torbara_comment_form_wrap', 'div' );

	$submit = torbara_open_markup( 'torbara_comment_form_submit', 'button', array( 'class' => 'uk-button uk-button-primary', 'type' => 'submit' ) );

		$submit .= torbara_output( 'torbara_comment_form_submit_text', esc_html__( 'Post Comment', 'torbara' ) );

	$submit .= torbara_close_markup( 'torbara_comment_form_submit', 'button' );

	// WordPress, please make it easier for us.
	echo preg_replace( '#<input[^>]+type="submit"[^>]+>#', $submit, $output );

}


// Filter.
torbara_add_smart_action( 'cancel_comment_reply_link', 'torbara_comment_cancel_reply_link', 10 , 3 );

/**
 * Echo comment cancel reply link.
 *
 * This function replaces the default WordPress comment cancel reply link.
 *
 * @since 1.0.0
 */
function torbara_comment_cancel_reply_link( $html, $link, $text ) {

	echo torbara_open_markup( 'torbara_comment_cancel_reply_link', 'a', array(
		'rel' => 'nofollow',
		'id' => 'cancel-comment-reply-link',
		'class' => 'uk-button uk-button-small uk-button-danger uk-margin-small-right',
		'style' => isset( $_GET['replytocom'] ) ? '' : 'display:none;',
		'href' => $link // Automatically escaped.
	) );

		echo torbara_output( 'torbara_comment_cancel_reply_link_text', $text );

	echo torbara_close_markup( 'torbara_comment_cancel_reply_link', 'a' );

}


// Filter.
torbara_add_smart_action( 'comment_form_field_comment', 'torbara_comment_form_comment' );

/**
 * Echo comment textarea field.
 *
 * This function replaces the default WordPress comment textarea field.
 *
 * @since 1.0.0
 */
function torbara_comment_form_comment() {

	$output = torbara_open_markup( 'torbara_comment_form[_comment]', 'p', array( 'class' => 'uk-margin-top' ) );

		/**
		 * Filter whether the comment form textarea legend should load or not.
		 *
		 * @since 1.0.0
		 */
		if ( torbara_apply_filters( 'torbara_comment_form_legend[_comment]', true ) ) {

			$output .= torbara_open_markup( 'torbara_comment_form_legend[_comment]', 'legend' );

				$output .= torbara_output( 'torbara_comment_form_legend_text[_comment]', esc_html__( 'Comment *', 'torbara' ) );

			$output .= torbara_close_markup( 'torbara_comment_form_legend[_comment]', 'legend' );

		}

		$output .= torbara_open_markup( 'torbara_comment_form_field[_comment]', 'textarea', array(
			'id' => 'comment',
			'class' => 'uk-width-1-1',
			'name' => 'comment',
			'required' => '',
			'rows' => 8,
		) );

		$output .= torbara_close_markup( 'torbara_comment_form_field[_comment]', 'textarea' );

	$output .= torbara_close_markup( 'torbara_comment_form[_comment]', 'p' );

	return $output;

}


torbara_add_smart_action( 'comment_form_before_fields', 'torbara_comment_before_fields', 9999 );

/**
 * Echo comment fields opening wraps.
 *
 * This function must be attached to the WordPress 'comment_form_before_fields' action which is only called if
 * the user is not logged in.
 *
 * @since 1.0.0
 */
function torbara_comment_before_fields() {

	echo torbara_open_markup( 'torbara_comment_fields_wrap', 'div', array( 'class' => 'uk-width-medium-1-1' ) );

		echo torbara_open_markup( 'torbara_comment_fields_inner_wrap', 'div', array(
			'class' => 'uk-grid uk-grid-small',
			'data-uk-grid-margin' => ''
		) );

}


// Filter.
torbara_add_smart_action( 'comment_form_default_fields', 'torbara_comment_form_fields' );

/**
 * Modify comment form fields.
 *
 * This function replaces the default WordPress comment fields.
 *
 * @since 1.0.0
 *
 * @param array $fields The WordPress default fields.
 *
 * @return array The modified fields.
 */
function torbara_comment_form_fields( $fields ) {

	$commenter = wp_get_current_commenter();
	$grid = count( (array) $fields );

	// Author.
	if ( isset( $fields['author'] ) ) {

		$author = torbara_open_markup( 'torbara_comment_form[_name]', 'div', array( 'class' => "uk-width-medium-1-$grid" ) );

			/**
			 * Filter whether the comment form name legend should load or not.
			 *
			 * @since 1.0.0
			 */
			if ( torbara_apply_filters( 'torbara_comment_form_legend[_name]', true ) ) {

				$author .= torbara_open_markup( 'torbara_comment_form_legend[_name]', 'legend' );

					$author .= torbara_output( 'torbara_comment_form_legend_text[_name]', esc_html__( 'Name', 'torbara' ) );

				$author .= torbara_close_markup( 'torbara_comment_form_legend[_name]', 'legend' );

			}

			$author .= torbara_selfclose_markup( 'torbara_comment_form_field[_name]', 'input', array(
				'id' => 'author',
				'class' => 'uk-width-1-1',
				'type' => 'text',
				'value' => $commenter['comment_author'], // Automatically escaped.
				'name' => 'author'
			) );

		$author .= torbara_close_markup( 'torbara_comment_form[_name]', 'div' );

		$fields['author'] = $author;

	}

	// Email.
	if ( isset( $fields['email'] ) ) {

		$email = torbara_open_markup( 'torbara_comment_form[_email]', 'div', array( 'class' => "uk-width-medium-1-$grid" ) );

			/**
			 * Filter whether the comment form email legend should load or not.
			 *
			 * @since 1.0.0
			 */
			if ( torbara_apply_filters( 'torbara_comment_form_legend[_email]', true ) ) {

				$email .= torbara_open_markup( 'torbara_comment_form_legend[_email]', 'legend' );

					$email .= torbara_output( 'torbara_comment_form_legend_text[_email]', sprintf( esc_html__( 'Email %s', 'torbara' ), ( get_option( 'require_name_email' ) ? ' *' : '' ) ) );

				$email .= torbara_close_markup( 'torbara_comment_form_legend[_email]', 'legend' );

			}

			$email .= torbara_selfclose_markup( 'torbara_comment_form_field[_email]', 'input', array(
				'id' => 'email',
				'class' => 'uk-width-1-1',
				'type' => 'text',
				'value' => $commenter['comment_author_email'], // Automatically escaped.
				'name' => 'email',
				'required' => get_option( 'require_name_email' ) ? '' : null
			) );

		$email .= torbara_close_markup( 'torbara_comment_form[_email]', 'div' );

		$fields['email'] = $email;

	}

	// Url.
	if ( isset( $fields['url'] ) ) {

		$url = torbara_open_markup( 'torbara_comment_form[_website]', 'div', array( 'class' => "uk-width-medium-1-$grid" ) );

			/**
			 * Filter whether the comment form url legend should load or not.
			 *
			 * @since 1.0.0
			 */
			if ( torbara_apply_filters( 'torbara_comment_form_legend[_url]', true ) ) {

				$url .= torbara_open_markup( 'torbara_comment_form_legend', 'legend' );

					$url .= torbara_output( 'torbara_comment_form_legend_text[_url]', esc_html__( 'Website', 'torbara' ) );

				$url .= torbara_close_markup( 'torbara_comment_form_legend[_url]', 'legend' );

			}

			$url .= torbara_selfclose_markup( 'torbara_comment_form_field[_url]', 'input', array(
				'id' => 'url',
				'class' => 'uk-width-1-1',
				'type' => 'text',
				'value' => $commenter['comment_author_url'], // Automatically escaped.
				'name' => 'url'
			) );

		$url .= torbara_close_markup( 'torbara_comment_form[_website]', 'div' );

		$fields['url'] = $url;

	}

	return $fields;
}


torbara_add_smart_action( 'comment_form_after_fields', 'torbara_comment_form_after_fields', 3 );

/**
 * Echo comment fields closing wraps.
 *
 * This function must be attached to the WordPress 'comment_form_after_fields' action which is only called if
 * the user is not logged in.
 *
 * @since 1.0.0
 */
function torbara_comment_form_after_fields() {

		echo torbara_close_markup( 'torbara_comment_fields_inner_wrap', 'div' );

	echo torbara_close_markup( 'torbara_comment_fields_wrap', 'div' );

}