<?php
/*
* @package      ANG Themes
* @subpackage   Multiple gallery custom field (post)
* @encoding     UTF-8
* @version      1.0.0
* @author       Aleksandr Glovatskyy (aleksandr1278@gmail.com)
* @copyright    Copyright ( C ) 2015 torbar (http://torbara.com/). All rights reserved.
* @license      Copyrighted Commercial Software
* @support      support@torbara.com
*/


/*******************************************************************************
                     Custom field image gallery upload / start
*******************************************************************************/
/**
 * @file
 * Theme functions
 */

/**
 * Action on admin init.
 *
 * Place here register post types, taxonomies or meta boxes.
 */
function ang_meta_gallery_admin_init_action() {
	// meta box for post
	add_meta_box( 'alternative_gallery', // meta box #id
		esc_html__( 'Gallery', 'ang-plugins' ), // meta box name
		'ang_meta_gallery_meta_box_callback', // callback function
		array('post', 'page'), // screen: post or page
		'advanced', // position: site, advanced
		'low' // order position: low, high
	);
}

add_action( 'admin_init', 'ang_meta_gallery_admin_init_action' );

/**
 * Meta box callback.
 *
 * @param $post WP_Post
 */

function ang_meta_gallery_meta_box_callback( $post ) {
	$alt_image_id = get_post_meta( $post->ID, '_multiple_thumbnail_ids' );
	echo ang_meta_gallery_get_alt_thumbnail_html( $alt_image_id );
}

/**
 * Show alternative image, if false show link to add it.
 *
 * @param null|int|array $thumb_id
 * @return string html code
 */
function ang_meta_gallery_get_alt_thumbnail_html( $thumb_id = null ) {
	global $content_width;

	$set_thumbnail_link = '<p class="hide-if-no-js"><button type="button" title="%s" class="button" id="set-post-multiple-thumbnails">%s</button></p>';
	$content            = sprintf( $set_thumbnail_link, esc_attr__( 'Set gallery images', 'ang-plugins' ), esc_html__( 'Set gallery images', 'ang-plugins' ) );

	if ( $thumb_id >0) {
		if ( !is_array( $thumb_id ) ) {
			$thumb_id = array( $thumb_id );
		}
		$old_content_width = $content_width;
		$content_width     = 254;
		$thumbnail_html    = '';
		$size              = count( $thumb_id ) == 1 ? array( $content_width, $content_width ) : array( 100, 100 );
		foreach ( $thumb_id as $id ) {
			$thumbnail_html .= '<li class="ang-item-meta-gal" style="display:inline-block; margin-bottom: 10px; margin-right: 10px; position:relative;" data-image-id="'.$id.'"><div class="ang-click-to-remove dashicons-before dashicons-no-alt" title="Remove" style="position: absolute; top: 0px; right: 0px; cursor: pointer; background: rgba(255, 255, 255, 0.2);"></div>'.wp_get_attachment_image( $id, $size).'</li>';
		}
		if ( !empty( $thumbnail_html ) ) {
			$content = sprintf( $set_thumbnail_link, esc_attr__( 'Set gallery images', 'ang-plugins' ), esc_html__( 'Set gallery images', 'ang-plugins' ) );
                        $content.= '<ul class="attachments">'.$thumbnail_html.'</ul>';
			$content .= '<p class="hide-if-no-js"><button type="button" class="button" id="remove-post-multiple-thumbnails">' . esc_html__( 'Remove gallery images', 'ang-plugins' ) . '</button></p>';
		}
		$content_width = $old_content_width;
	}

	return $content;
}

/**
 * Enqueue admin scripts.
 *
 * @param $hook string
 */
function ang_meta_gallery_admin_enqueue_scripts_action( $hook ) {

	global $post;
        //$current_ang_js_dir_path = plugins_url('ang-smartkit/libs/assets/js');

	if ( ( $hook == 'post-new.php' || $hook == 'post.php' )
	) {

		wp_enqueue_media();
		wp_enqueue_style( 'editor-buttons' );

		wp_enqueue_script( 'alternative-gallery',  ang_load_js_url().'meta-field-alternative-featured-image-multiple.js', array( 'jquery' ) );

		wp_localize_script( 'alternative-gallery', 'ang_meta_gallery', array(
				'l10n'  => array(
					'uploaderTitle'  => esc_html__( 'Set gallery images', 'ang-plugins' ),
					'uploaderButton' => esc_html__( 'Select images', 'ang-plugins' ),
				),
				'nonce' => wp_create_nonce( 'set-post_multiple-thumbnails' ),
			) );
	}
}

add_action( 'admin_enqueue_scripts', 'ang_meta_gallery_admin_enqueue_scripts_action' );

/**
 * Ajax callback for attaching/detaching alternative thumbnail to post
 */
function ang_meta_gallery_ajax_action() {
	$post_ID = intval( $_POST['post_id'] );
	if ( !current_user_can( 'edit_post', $post_ID ) ) {
		wp_die( -1 );
	}

	$thumbnail_id = $_POST['thumbnail_id'];

	check_ajax_referer( "set-post_multiple-thumbnails", 'nonce' );

	$success = false;
	if ( $thumbnail_id == '-1' ) {
		$success = delete_post_meta( $post_ID, '_multiple_thumbnail_ids' );
	} elseif ( is_array( $thumbnail_id ) ) {
		if ( !empty ( $thumbnail_id ) ) {
			delete_post_meta( $post_ID, '_multiple_thumbnail_ids' );
			foreach ( $thumbnail_id as $id ) {
				add_post_meta( $post_ID, '_multiple_thumbnail_ids', $id );
			}
			$success = true;
		}
	} else {
		$success = update_post_meta( $post_ID, '_multiple_thumbnail_ids', intval( $thumbnail_id ) );
	}

	if ( $success ) {
		$return = ang_meta_gallery_get_alt_thumbnail_html( $thumbnail_id, $post_ID );
		wp_send_json_success( $return );
	}
	wp_die( 0 );
}

add_action( 'wp_ajax_set-multiple-thumbnails', 'ang_meta_gallery_ajax_action' );


/**
 * Display Post Alternative Thumbnail.
 */
function the_multiple_thumbnail( $size = 'post-thumbnail', $attr = '' ) {
	echo get_multiple_thumbnail( null, $size, $attr );
}


/**
 * Retrieve Post Alternative Thumbnail ID.
 */
function get_multiple_thumbnail_ids( $post_id = null ) {
	$post_id = ( null === $post_id ) ? get_the_ID() : $post_id;

	return get_post_meta( $post_id, '_multiple_thumbnail_ids', true );
}

/**
 * Retrieve Post Alternative Thumbnail.
 */
function get_multiple_thumbnail( $post_id = null, $size = 'post-thumbnail', $attr = '' ) {
	$post_id           = ( null === $post_id ) ? get_the_ID() : $post_id;
	$post_thumbnail_id = get_multiple_thumbnail_ids( $post_id );

	$size = apply_filters( 'post_thumbnail_size', $size );

	if ( $post_thumbnail_id ) {
		do_action( 'begin_fetch_post_thumbnail_html', $post_id, $post_thumbnail_id, $size );
		if ( in_the_loop() ) {
			update_post_thumbnail_cache();
		}
		$html = wp_get_attachment_image( $post_thumbnail_id, $size, false, $attr );
		do_action( 'end_fetch_post_thumbnail_html', $post_id, $post_thumbnail_id, $size );
	} else {
		$html = '';
	}

	return apply_filters( 'post_thumbnail_html', $html, $post_id, $post_thumbnail_id, $size, $attr );
}
