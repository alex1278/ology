<?php
/*
* @package      ANG Themes
* @encoding     UTF-8
* @version      1.0.1
* @author       Aleksandr Glovatskyy (aleksandr1278@gmail.com)
* @copyright    Copyright ( C ) 2015 torbar (http://torbara.com/). All rights reserved.
* @license      Copyrighted Commercial Software
* @support      support@torbara.com
*/


/*******************************************************************************
                     Custom field image upload, alternativ featured image/ start
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
function ang_meta_image_admin_init_action() {
	// meta box for post
	add_meta_box( 'alternative_image', // meta box #id
		esc_html__( 'Breadcrumbs background', 'ang-plugins' ), // meta box name
		'ang_meta_image_meta_box_callback', // callback function
		array('post', 'page'), // screen: post or page
		'side', // position: site, advanced
		'low' // order position: low, high
	);
}

add_action( 'admin_init', 'ang_meta_image_admin_init_action' );

/**
 * Meta box callback.
 *
 * @param $post WP_Post
 */
function ang_meta_image_meta_box_callback( $post ) {
	$alt_image_id = get_post_meta( $post->ID, '_alt_thumbnail_id' );
	echo ang_meta_image_get_alt_thumbnail_html( $alt_image_id );
}

/**
 * Show alternative image, if false show link to add it.
 *
 * @param null|int|array $thumb_id
 * @return string html code
 */
function ang_meta_image_get_alt_thumbnail_html( $thumb_id = null ) {
	global $content_width;

	$set_thumbnail_link = '<p class="hide-if-no-js"><a title="%s" href="#" id="set-post-alternative-thumbnail">%s</a></p>';
	$content            = sprintf( $set_thumbnail_link, esc_attr__( 'Set alternative image', 'dev' ), esc_html__( 'Set alternative image', 'ang-plugins' ) );

	if ( $thumb_id ) {
		if ( !is_array( $thumb_id ) ) {
			$thumb_id = array( $thumb_id );
		}
		$old_content_width = $content_width;
		$content_width     = 254;
		$thumbnail_html    = '';
		$size              = count( $thumb_id ) == 1 ? array( $content_width, $content_width ) : array( 150, 150 );
		foreach ( $thumb_id as $id ) {
			$thumbnail_html .= wp_get_attachment_image( $id, $size );
		}
		if ( !empty( $thumbnail_html ) ) {
			$content = sprintf( $set_thumbnail_link, esc_attr__( 'Set alternative image', 'dev' ), $thumbnail_html );
			$content .= '<p class="hide-if-no-js"><a href="#" id="remove-post-alternative-thumbnail">' . esc_html__( 'Remove alternative image', 'ang-plugins' ) . '</a></p>';
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
function ang_meta_image_admin_enqueue_scripts_action( $hook ) {

	global $post;
        //$current_ang_js_dir_path = plugins_url('ang-smartkit/libs/assets/js');

	if ( ( $hook == 'post-new.php' || $hook == 'post.php' )
	) {

		wp_enqueue_media();
		wp_enqueue_style( 'editor-buttons' );

		wp_enqueue_script( 'alternative-image',  ang_load_js_url().'meta-field-alternative-featured-image.js', array( 'jquery' ) );

		wp_localize_script( 'alternative-image', 'ang_meta_image', array(
				'l10n'  => array(
					'uploaderTitle'  => esc_html__( 'Set alternative image', 'ang-plugins' ),
					'uploaderButton' => esc_html__( 'Select image', 'ang-plugins' ),
				),
				'nonce' => wp_create_nonce( 'set_post_alternative_thumbnail' ),
			) );
	}
}

add_action( 'admin_enqueue_scripts', 'ang_meta_image_admin_enqueue_scripts_action' );

/**
 * Ajax callback for attaching/detaching alternative thumbnail to post
 */
function ang_meta_image_ajax_action() {
	$post_ID = intval( $_POST['post_id'] );
	if ( !current_user_can( 'edit_post', $post_ID ) ) {
		wp_die( -1 );
	}

	$thumbnail_id = $_POST['thumbnail_id'];

	check_ajax_referer( "set_post_alternative_thumbnail", 'nonce' );

	$success = false;
	if ( $thumbnail_id == '-1' ) {
		$success = delete_post_meta( $post_ID, '_alt_thumbnail_id' );
	} elseif ( is_array( $thumbnail_id ) ) {
		if ( !empty ( $thumbnail_id ) ) {
			delete_post_meta( $post_ID, '_alt_thumbnail_id' );
			foreach ( $thumbnail_id as $id ) {
				add_post_meta( $post_ID, '_alt_thumbnail_id', $id );
			}
			$success = true;
		}
	} else {
		$success = update_post_meta( $post_ID, '_alt_thumbnail_id', intval( $thumbnail_id ) );
	}

	if ( $success ) {
		$return = ang_meta_image_get_alt_thumbnail_html( $thumbnail_id, $post_ID );
		wp_send_json_success( $return );
	}
	wp_die( 0 );
}

add_action( 'wp_ajax_set_alternative_thumbnail', 'ang_meta_image_ajax_action' );


/**
 * Display Post Alternative Thumbnail.
 */
function the_alt_thumbnail( $size = 'post-thumbnail', $attr = '' ) {
	echo get_alt_thumbnail( null, $size, $attr );
}


/**
 * Retrieve Post Alternative Thumbnail ID.
 */
function get_alt_thumbnail_id( $post_id = null ) {
	$post_id = ( null === $post_id ) ? get_the_ID() : $post_id;

	return get_post_meta( $post_id, '_alt_thumbnail_id', true );
}

/**
 * Retrieve Post Alternative Thumbnail.
 */
function get_alt_thumbnail( $post_id = null, $size = 'post-thumbnail', $attr = '' ) {
	$post_id           = ( null === $post_id ) ? get_the_ID() : $post_id;
	$post_thumbnail_id = get_alt_thumbnail_id( $post_id );

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

/*
 * Get attacment image array with image data
 * 
 */

function ang_get_alt_attachment_data($post_id = null){
    $imgData = wp_prepare_attachment_for_js ( get_alt_thumbnail_id($post_id) );
    return $imgData;
}

/*
 * Get attacment image array with image src
 * 
 */

function ang_get_alt_attachment_src($post_id = null){
   $img = ang_get_alt_attachment_data($post_id);
   return $img["url"];
}


/*
 * Add style tag 'background'  for breadcrumbs position. Call action
 */

function ang_breadcrumbs_bg(){
    if(ang_get_alt_attachment_src() && !is_home()){
        echo 'style="background-image: url('.ang_get_alt_attachment_src().')"';
    }
}
add_action('ang_breadcrumbs_bg', 'ang_breadcrumbs_bg');

