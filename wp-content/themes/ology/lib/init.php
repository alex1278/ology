<?php
/**
 * Version: 1.0.2
 * Prepare and initialize the Beans framework.
 *
 * @package Initialize
 */


add_action( 'torbara_init', 'torbara_define_constants', -1 );

/**
 * Define constants.
 *
 * @ignore
 */
function torbara_define_constants() {

	// Define version.
	define( 'torbara_VERSION', '1.3.1' );

	// Define paths.
	if ( !defined( 'torbara_THEME_PATH' ) )
		define( 'torbara_THEME_PATH', wp_normalize_path( trailingslashit( get_template_directory() ) ) );

	define( 'torbara_PATH', torbara_THEME_PATH . 'lib/' );
	define( 'torbara_API_PATH', torbara_PATH . 'api/' );
	define( 'torbara_ASSETS_PATH', torbara_PATH . 'assets/' );
	define( 'torbara_RENDER_PATH', torbara_PATH . 'render/' );
	define( 'torbara_TEMPLATES_PATH', torbara_PATH . 'templates/' );
	define( 'torbara_STRUCTURE_PATH', torbara_TEMPLATES_PATH . 'structure/' );
	define( 'torbara_FRAGMENTS_PATH', torbara_TEMPLATES_PATH . 'fragments/' );

	// Define urls.
	if ( !defined( 'torbara_THEME_URL' ) )
		define( 'torbara_THEME_URL', trailingslashit( get_template_directory_uri() ) );

	define( 'torbara_URL', torbara_THEME_URL . 'lib/' );
	define( 'torbara_API_URL', torbara_URL . 'api/' );
	define( 'torbara_ASSETS_URL', torbara_URL . 'assets/' );
	define( 'torbara_LESS_URL', torbara_ASSETS_URL . 'less/' );
	define( 'torbara_JS_URL', torbara_ASSETS_URL . 'js/' );
	define( 'torbara_IMAGE_URL', torbara_ASSETS_URL . 'images/' );

	// Define admin paths.
	define( 'torbara_ADMIN_PATH', torbara_PATH . 'admin/' );

	// Define admin url.
	define( 'torbara_ADMIN_URL', torbara_URL . 'admin/' );
	define( 'torbara_ADMIN_ASSETS_URL', torbara_ADMIN_URL . 'assets/' );
	define( 'torbara_ADMIN_JS_URL', torbara_ADMIN_ASSETS_URL . 'js/' );

}


add_action( 'torbara_init', 'torbara_load_dependencies', -1 );

/**
 * Load dependencies.
 *
 * @ignore
 */
function torbara_load_dependencies() {

	require_once( torbara_API_PATH . 'init.php' );

	// Load the necessary Beans components.
	torbara_load_api_components( array(
		'actions',
		'html',
		'term-meta',
		'post-meta',
		'image',
		'wp-customize',
		'compiler',
		'uikit',
		'template',
		'layout',
		'widget'
	) );

	// Add third party styles and scripts compiler support.
	torbara_add_api_component_support( 'wp_styles_compiler' );
	torbara_add_api_component_support( 'wp_scripts_compiler' );

	/**
	 * Fires after Beans API loads.
	 *
	 * @since 1.0.0
	 */
	do_action( 'torbara_after_load_api' );

}


add_action( 'torbara_init', 'torbara_add_theme_support' );

/**
 * Add theme support.
 *
 * @ignore
 */
function torbara_add_theme_support() {

	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'menus' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	add_theme_support( 'custom-header', array(
		'width' => 2000,
		'height' => 500,
		'flex-height' => true,
		'flex-width' => true,
		'header-text' => false
	) );

	// Beans specific.
	add_theme_support( 'offcanvas-menu' );
	add_theme_support( 'beans-default-styling' );

}


add_action( 'torbara_init', 'torbara_includes' );

/**
 * Include framework files.
 *
 * @ignore
 */
function torbara_includes() {

	// Include admin.
	if ( is_admin() ) {

		require_once( torbara_ADMIN_PATH . 'options.php' );
		require_once( torbara_ADMIN_PATH . 'updater.php' );

	}

	// Include assets.
	require_once( torbara_ASSETS_PATH . 'assets.php' );

	// Include customizer.
	if ( is_customize_preview() )
		require_once( torbara_ADMIN_PATH . 'wp-customize.php' );

	// Include renderers.
	require_once( torbara_RENDER_PATH . 'template-parts.php' );
	require_once( torbara_RENDER_PATH . 'fragments.php' );
	require_once( torbara_RENDER_PATH . 'widget-area.php' );
	require_once( torbara_RENDER_PATH . 'walker.php' );
	require_once( torbara_RENDER_PATH . 'menu.php' );

}

/**
 * Fires before Beans loads.
 *
 * @since 1.0.0
 */
do_action( 'torbara_before_init' );

	/**
	 * Load Beans framework.
	 *
	 * @since 1.0.0
	 */
	do_action( 'torbara_init' );

/**
 * Fires after Beans loads.
 *
 * @since 1.0.0
 */
do_action( 'torbara_after_init' );