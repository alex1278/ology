<?php
/**
 * Add Beans assets.
 *
 * @package Assets
 */

torbara_add_smart_action( 'torbara_uikit_enqueue_scripts', 'torbara_enqueue_uikit_components', 5 );

/**
 * Enqueue UIKit components and Beans style.
 *
 * Beans style is enqueued with the UIKit components to have access to UIKit LESS variables.
 *
 * @since 1.0.0
 */
function torbara_enqueue_uikit_components() {

	$core = array(
		'base',
		'block',
		'grid',
		'article',
		'comment',
		'panel',
		'nav',
		'navbar',
		'subnav',
		'table',
		'breadcrumb',
		'pagination',
		'list',
		'form',
		'button',
		'badge',
		'alert',
		'dropdown',
		'offcanvas',
		'text',
		'utility',
		'icon'
	);

	torbara_uikit_enqueue_components( $core, 'core', false );

	// Include uikit default theme.
	torbara_uikit_enqueue_theme( 'default' );

	// Enqueue uikit overwrite theme folder.
	torbara_uikit_enqueue_theme( 'beans', torbara_ASSETS_PATH . 'less/uikit-overwrite' );

	// Add the theme style as a uikit fragment to have access to all the variables.
	torbara_compiler_add_fragment( 'uikit', torbara_ASSETS_PATH . 'less/style.less', 'less' );

	// Add the theme default style as a uikit fragment only if the theme supports it.
	if ( current_theme_supports( 'beans-default-styling' ) )
		torbara_compiler_add_fragment( 'uikit', torbara_ASSETS_PATH . 'less/default.less', 'less' );

}


torbara_add_smart_action( 'wp_enqueue_scripts', 'torbara_enqueue_assets', 5 );

/**
 * Enqueue Beans assets.
 *
 * @since 1.0.0
 */
function torbara_enqueue_assets() {

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

}


torbara_add_smart_action( 'after_setup_theme', 'torbara_add_editor_assets' );

/**
 * Add Beans editor assets.
 *
 * @since 1.2.5
 */
function torbara_add_editor_assets() {

	add_editor_style( torbara_ASSETS_URL . 'css/editor' . torbara_MIN_CSS . '.css' );

}