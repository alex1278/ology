<?php
/**
 *
 * Load components.
 *
 * @ignore
 *
 * @package Beans
 */

// Stop here if the API was already loaded.
if ( defined( 'ology_API' ) )
	return;

// Declare Beans API.
define( 'ology_API', true );

// Mode.
if ( !defined( 'SCRIPT_DEBUG' ) )
	define( 'SCRIPT_DEBUG', false );

// Assets.
define( 'ology_MIN_CSS', SCRIPT_DEBUG ? '' : '.min' );
define( 'ology_MIN_JS', SCRIPT_DEBUG ? '' : '.min' );

// Path.
if ( !defined( 'ology_API_PATH' ) )
	define( 'ology_API_PATH', wp_normalize_path( trailingslashit( get_template_directory().'/lib/api/' ) ) );

define( 'ology_API_ADMIN_PATH', ology_API_PATH . 'admin/' );

// Load dependencies here as it is used further down.
require_once( ology_API_PATH . 'utilities/functions.php' );
require_once( ology_API_PATH . 'utilities/deprecated.php' );
require_once( ology_API_PATH . 'components.php' );

// Url.
if ( !defined( 'ology_API_URL' ) )
	define( 'ology_API_URL', ology_path_to_url( ology_API_PATH ) );

// Backwards compatibility constants.
define( 'ology_API_COMPONENTS_PATH', ology_API_PATH );
define( 'ology_API_COMPONENTS_ADMIN_PATH', ology_API_PATH . 'admin/' );
define( 'ology_API_COMPONENTS_URL', ology_API_URL );