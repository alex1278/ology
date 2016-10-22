<?php
/**
 * The Beans UIkit component integrates the awesome {@link http://getuikit.com UIkit framework}.
 *
 * Only the desired components are compiled into a single cached file and may be different on a per page basis. UIkit
 * default or custom themes can be enqueued to the UIkit compiler. All UIkit LESS variables are accessible
 * and overwritable via custom themes.
 *
 * When development mode is enabled, files changes will automatically be detected. This makes it very easy
 * to style UIkit themes using LESS.
 *
 * @package API\UIkit
 */

/**
 * Enqueue UIkit components.
 *
 * Enqueued components will be compiled into a single file. Refer to
 * {@link http://http://getuikit.com/ UIkit} to learn more about the available components.
 *
 * When development mode is enabled, files changes will automatically be detected. This makes it very easy
 * to style UIkit themes using LESS.
 *
 * This function must be called in the 'torbara_uikit_enqueue_scripts' action hook.
 *
 * @since 1.0.0
 *
 * @param string|array $components Name of the component(s) to include as an indexed array. The name(s) must be
 *                                 the UIkit component filename without the extention (e.g. 'grid'). Set to true
 *                                 load all components.
 * @param string       $type       Optional. Type of UIkit components ('core' or 'add-ons').
 * @param bool         $autoload   Optional. Automatically include components dependencies.
 */
function torbara_uikit_enqueue_components( $components, $type = 'core', $autoload = true ) {

	global $torbara_tt_uikit_enqueued_items;

	// Get all uikit components.
	if ( $components === true ) {

		$uikit = new torbara_tt_Uikit;
		$components = $uikit->get_all_components( $type );

	} elseif ( $autoload ) {

		$uikit = new torbara_tt_Uikit;
		$autoloads = $uikit->get_autoload_components( (array) $components );

		foreach ( $autoloads as $autotype => $autoload )
			torbara_uikit_enqueue_components( $autoload, $autotype, false );

	}

	// Add components.
	$torbara_tt_uikit_enqueued_items['components'][$type] = array_merge( (array) $torbara_tt_uikit_enqueued_items['components'][$type], (array) $components );

}


/**
 * Dequeue UIkit components.
 *
 * Dequeued components are removed from the UIkit compiler. Refer to
 * {@link http://http://getuikit.com/ UIkit} to learn more about the available components.
 *
 * When development mode is enabled, files changes will automatically be detected. This makes it very easy
 * to style UIkit themes using LESS.
 *
 * This function must be called in the 'torbara_uikit_enqueue_scripts' action hook.
 *
 * @since 1.0.0
 *
 * @param string|array $components Name of the component(s) to exclude as an indexed array. The name(s) must be
 *                                 the UIkit component filename without the extention (e.g. 'grid'). Set to true
 *                                 exclude all components.
 * @param string       $type       Optional. Type of UIkit components ('core' or 'add-ons').
 */
function torbara_uikit_dequeue_components( $components, $type = 'core' ) {

	global $torbara_tt_uikit_enqueued_items;

	if ( $components === true ) {

		$uikit = new torbara_tt_Uikit;
		$components = $uikit->get_all_components( $type );

	}

	// Remove components.
	$torbara_tt_uikit_enqueued_items['components'][$type] = array_diff( (array) $torbara_tt_uikit_enqueued_items['components'][$type], (array) $components );

}


/**
 * Register a UIkit theme.
 *
 * The theme must not contain sub-folders. Component files in the theme will be automatically combined to
 * the UIkit compiler if that component is used.
 *
 * This function must be called in the 'torbara_uikit_enqueue_scripts' action hook.
 *
 * @since 1.0.0
 *
 * @param string $id   A unique string used as a reference. Similar to the WordPress scripts $handle argument.
 * @param string $path Absolute path to the UIkit theme folder.
 *
 * @return bool False on error or if already exists, true on success.
 */
function torbara_uikit_register_theme( $id, $path ) {

	global $torbara_tt_uikit_registered_items;

	// Stop here if already registered.
	if ( torbara_get( $id, $torbara_tt_uikit_registered_items['themes'] ) )
		return true;

	if ( !$path )
		return false;

	if ( stripos( $path, 'http' ) !== false )
		$path = torbara_url_to_path( $path );

	$torbara_tt_uikit_registered_items['themes'][$id] = trailingslashit( $path );

	return true;

}


/**
 * Enqueue a UIkit theme.
 *
 * The theme must not contain sub-folders. Component files in the theme will be automatically combined to
 * the UIkit compiler if that component is used.
 *
 * This function must be called in the 'torbara_uikit_enqueue_scripts' action hook.
 *
 * @since 1.0.0
 *
 * @param string $id   A unique string used as a reference. Similar to the WordPress scripts $handle argument.
 * @param string $path Optional. Path to the UIkit theme folder if the theme isn't yet registered.
 *
 * @return bool False on error, true on success.
 */
function torbara_uikit_enqueue_theme( $id, $path = false ) {

	// Make sure it is registered, if not, try to do so.
	if ( !torbara_uikit_register_theme( $id, $path ) )
		return false;

	global $torbara_tt_uikit_enqueued_items;

	$torbara_tt_uikit_enqueued_items['themes'][$id] = torbara_tt_uikit_get_registered_theme( $id );

	return true;

}


/**
 * Dequeue a UIkit theme.
 *
 * This function must be called in the 'torbara_uikit_enqueue_scripts' action hook.
 *
 * @since 1.0.0
 *
 * @param string $id The id of the theme to dequeue.
 *
 * @return bool Will always return true.
 */
function torbara_uikit_dequeue_theme( $id ) {

	global $torbara_tt_uikit_enqueued_items;

	unset( $torbara_tt_uikit_enqueued_items['themes'][$id] );

}


/**
 * Initialize registered UIkit items global.
 *
 * @ignore
 */
global $torbara_tt_uikit_registered_items;

if ( !isset( $torbara_tt_uikit_registered_items ) )
	$torbara_tt_uikit_registered_items = array(
		'themes' => array(
			'default' => torbara_API_PATH . 'uikit/src/themes/default',
			'almost-flat' => torbara_API_PATH . 'uikit/src/themes/almost-flat',
			'gradient' => torbara_API_PATH . 'uikit/src/themes/gradient',
			'wordpress-admin' => torbara_API_PATH . 'uikit/themes/wordpress-admin'
		)
	);


/**
 * Initialize enqueued UIkit items global.
 *
 * @ignore
 */
global $torbara_tt_uikit_enqueued_items;

if ( !isset( $torbara_tt_uikit_enqueued_items ) )
	$torbara_tt_uikit_enqueued_items = array(
		'components' => array(
			'core' => array(),
			'add-ons' => array(),
		),
		'themes' => array()
	);


/**
 * Get registered theme.
 *
 * @ignore
 */
function torbara_tt_uikit_get_registered_theme( $id ) {

	global $torbara_tt_uikit_registered_items;

	// Stop here if is already registered.
	if ( $theme = torbara_get( $id, $torbara_tt_uikit_registered_items['themes'] ) )
		return $theme;

	return false;

}


add_action( 'wp_enqueue_scripts', 'torbara_tt_uikit_enqueue_assets', 7 );

/**
 * Enqueue UIkit assets.
 *
 * @ignore
 */
function torbara_tt_uikit_enqueue_assets() {

	if ( !has_action( 'torbara_uikit_enqueue_scripts' ) )
		return;

	/**
	 * Fires when UIkit scripts and styles are enqueued.
	 *
	 * @since 1.0.0
	 */
	do_action( 'torbara_uikit_enqueue_scripts' );

	// Compile everything.
	$uikit = new torbara_tt_Uikit;

	$uikit->compile();

}


add_action( 'admin_enqueue_scripts', 'torbara_tt_uikit_enqueue_admin_assets', 7 );

/**
 * Enqueue UIkit admin assets.
 *
 * @ignore
 */
function torbara_tt_uikit_enqueue_admin_assets() {

	if ( !has_action( 'torbara_uikit_admin_enqueue_scripts' ) )
		return;

	/**
	 * Fires when admin UIkit scripts and styles are enqueued.
	 *
	 * @since 1.0.0
	 */
	do_action( 'torbara_uikit_admin_enqueue_scripts' );

	// Compile everything.
	$uikit = new torbara_tt_Uikit;

	$uikit->compile();

}