<?php
/**
 * Version: 1.0.2
 * Prepare and initialize the Beans framework.
 *
 * @package Initialize
 */


add_action( 'ology_init', 'ology_define_constants', -1 );

/**
 * Define constants.
 *
 * @ignore
 */
function ology_define_constants() {

	// Define version.
	define( 'ology_VERSION', '1.3.1' );

	// Define paths.
	if ( !defined( 'ology_THEME_PATH' ) )
		define( 'ology_THEME_PATH', wp_normalize_path( trailingslashit( get_template_directory() ) ) );

	define( 'ology_PATH', ology_THEME_PATH . 'lib/' );
	define( 'ology_API_PATH', ology_PATH . 'api/' );
	define( 'ology_ASSETS_PATH', ology_PATH . 'assets/' );
	define( 'ology_RENDER_PATH', ology_PATH . 'render/' );
	define( 'ology_TEMPLATES_PATH', ology_PATH . 'templates/' );
	define( 'ology_STRUCTURE_PATH', ology_TEMPLATES_PATH . 'structure/' );
	define( 'ology_FRAGMENTS_PATH', ology_TEMPLATES_PATH . 'fragments/' );

	// Define urls.
	if ( !defined( 'ology_THEME_URL' ) )
		define( 'ology_THEME_URL', trailingslashit( get_template_directory_uri() ) );

	define( 'ology_URL', ology_THEME_URL . 'lib/' );
	define( 'ology_API_URL', ology_URL . 'api/' );
	define( 'ology_ASSETS_URL', ology_URL . 'assets/' );
	define( 'ology_LESS_URL', ology_ASSETS_URL . 'less/' );
	define( 'ology_JS_URL', ology_ASSETS_URL . 'js/' );
	define( 'ology_IMAGE_URL', ology_ASSETS_URL . 'images/' );

	// Define admin paths.
	define( 'ology_ADMIN_PATH', ology_PATH . 'admin/' );

	// Define admin url.
	define( 'ology_ADMIN_URL', ology_URL . 'admin/' );
	define( 'ology_ADMIN_ASSETS_URL', ology_ADMIN_URL . 'assets/' );
	define( 'ology_ADMIN_JS_URL', ology_ADMIN_ASSETS_URL . 'js/' );

}


add_action( 'ology_init', 'ology_load_dependencies', -1 );

/**
 * Load dependencies.
 *
 * @ignore
 */
function ology_load_dependencies() {

	require_once( ology_API_PATH . 'init.php' );

	// Load the necessary Beans components.
	ology_load_api_components( array(
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
	ology_add_api_component_support( 'wp_styles_compiler' );
	ology_add_api_component_support( 'wp_scripts_compiler' );

	/**
	 * Fires after Beans API loads.
	 *
	 * @since 1.0.0
	 */
	do_action( 'ology_after_load_api' );

}


add_action( 'ology_init', 'ology_add_theme_support' );

/**
 * Add theme support.
 *
 * @ignore
 */
function ology_add_theme_support() {

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


add_action( 'ology_init', 'ology_includes' );

/**
 * Include framework files.
 *
 * @ignore
 */
function ology_includes() {

	// Include admin.
	if ( is_admin() ) {

		require_once( ology_ADMIN_PATH . 'options.php' );
		require_once( ology_ADMIN_PATH . 'updater.php' );

	}

	// Include assets.
	require_once( ology_ASSETS_PATH . 'assets.php' );

	// Include customizer.
	if ( is_customize_preview() )
		require_once( ology_ADMIN_PATH . 'wp-customize.php' );

	// Include renderers.
	require_once( ology_RENDER_PATH . 'template-parts.php' );
	require_once( ology_RENDER_PATH . 'fragments.php' );
	require_once( ology_RENDER_PATH . 'widget-area.php' );
	require_once( ology_RENDER_PATH . 'walker.php' );
	require_once( ology_RENDER_PATH . 'menu.php' );

}

/**
 * Fires before Beans loads.
 *
 * @since 1.0.0
 */
do_action( 'ology_before_init' );

	/**
	 * Load Beans framework.
	 *
	 * @since 1.0.0
	 */
	do_action( 'ology_init' );

/**
 * Fires after Beans loads.
 *
 * @since 1.0.0
 */
do_action( 'ology_after_init' );