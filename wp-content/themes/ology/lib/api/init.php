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
if ( defined( 'torbara_API' ) )
	return;

// Declare Beans API.
define( 'torbara_API', true );

// Mode.
if ( !defined( 'SCRIPT_DEBUG' ) )
	define( 'SCRIPT_DEBUG', false );

// Assets.
define( 'torbara_MIN_CSS', SCRIPT_DEBUG ? '' : '.min' );
define( 'torbara_MIN_JS', SCRIPT_DEBUG ? '' : '.min' );

// Path.
if ( !defined( 'torbara_API_PATH' ) )
	define( 'torbara_API_PATH', wp_normalize_path( trailingslashit( get_template_directory().'/lib/api/' ) ) );

define( 'torbara_API_ADMIN_PATH', torbara_API_PATH . 'admin/' );

// Load dependencies here as it is used further down.
require_once( torbara_API_PATH . 'utilities/functions.php' );
require_once( torbara_API_PATH . 'utilities/deprecated.php' );
require_once( torbara_API_PATH . 'components.php' );

// Url.
if ( !defined( 'torbara_API_URL' ) )
	define( 'torbara_API_URL', torbara_path_to_url( torbara_API_PATH ) );

// Backwards compatibility constants.
define( 'torbara_API_COMPONENTS_PATH', torbara_API_PATH );
define( 'torbara_API_COMPONENTS_ADMIN_PATH', torbara_API_PATH . 'admin/' );
define( 'torbara_API_COMPONENTS_URL', torbara_API_URL );