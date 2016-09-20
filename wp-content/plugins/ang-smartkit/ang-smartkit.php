<?php
/**
 * The plugin bootstrap file
 * 
 * Plugin Name: ANG SmartKit
 * Description: This is the package of hooks, functions, shortcodes, templates required by WordPress Renter theme. Patch files for Easy-property-listings plugin.
 * Plugin URI: http://themeforest.net/user/torbara/?ref=torbara
 * Author: Aleksandr Glovatskyy
 * Author URI: http://torbara.com
 * Date: 05.08.2016
 * Version: 1.0.0
 * Package: Renter
 * License: GPL2+
 * Domain Path: languages/ang-smartkit
 * Requires at least: 4.3.1
 * tested up to: 4.3.1
 * Stable tag: 4.3.1
 * EPL requires at least: 2.2.4
 * EPL tested up to: 2.3.1
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

// Script version, used to add version for scripts and styles
define( 'BANG_VER', '1.0.0' );


/****************************  ang  ************************/


// check if Woocommerce plugin is active. We use the global variable to activate special widgets.
$woo_active = in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
// check if Easy-property-Listing plugin is active. We use the global variable to activate special widgets.
$epl_active = in_array( 'easy-property-listings/easy-property-listings.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
 

// activate plugin if EPL plugin already exists
    
    // defines constants
    $ang_smartkit_plugin_path = plugin_dir_path( __FILE__ );

    if ( ! defined( 'BANG_PLUGIN_BASE_NAME' ) )
    define('BANG_PLUGIN_BASE_NAME', plugin_basename(__FILE__));

    // Define plugin URLs, for fast enqueuing scripts and styles
    $ang_smartkit_plugin_url = plugin_dir_url( __FILE__ );
    if ( ! defined( 'BANG_PLUGIN_URL' ) )
            define( 'BANG_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

    define( 'BANG_LIBS_URL', trailingslashit( BANG_PLUGIN_URL . 'libs' ) );
    define( 'BANG_ASSETS_URL', trailingslashit( BANG_LIBS_URL . 'assets' ) );

    define( 'BANG_JS_URL', trailingslashit( BANG_ASSETS_URL . 'js' ) );
    define( 'BANG_CSS_URL', trailingslashit( BANG_ASSETS_URL . 'css' ) );
    define( 'BANG_IMG_URL', trailingslashit( BANG_ASSETS_URL . 'imgs' ) );


    // Define Plugin paths, for renter function files
    if ( ! defined( 'BANG_PLUGIN_DIR' ) )
            define( 'BANG_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
    define('BANG_THEME_DIR', trailingslashit(BANG_PLUGIN_DIR . 'inc'));
    define('BANG_ADMIN_DIR', trailingslashit(BANG_THEME_DIR . 'admin')); //define folder to admin scripts and styles
        
    define( 'BANG_LIBS_DIR', trailingslashit( BANG_PLUGIN_DIR . 'libs' ) );
    define( 'BANG_TEMPLAT_DIR', trailingslashit( BANG_LIBS_DIR . 'templates' ) );
    
    define( 'BANG_ASSETS_DIR', trailingslashit( BANG_LIBS_DIR . 'assets' ) );
    define( 'BANG_ASSETSEPL_DIR', trailingslashit( BANG_LIBS_DIR . 'assets-epl' ) );
    define( 'BANG_FILTER_DIR', trailingslashit( BANG_LIBS_DIR . 'filters' ) );
    define( 'BANG_FUNC_DIR', trailingslashit( BANG_LIBS_DIR . 'functs' ) );
    define( 'BANG_CLASS_DIR', trailingslashit( BANG_LIBS_DIR . 'class' ) );
    define( 'BANG_SHORTCODES_DIR', trailingslashit( BANG_LIBS_DIR . 'shortcodes' ) );
    define( 'BANG_DOCS_TMP', trailingslashit(BANG_SHORTCODES_DIR . 'documentation-tmp'));
    define( 'BANG_ACTS_DIR', trailingslashit( BANG_LIBS_DIR . 'actions' ) );
    define( 'BANG_WIDGET_DIR', trailingslashit( BANG_LIBS_DIR . 'widgets' ) );

    require_once BANG_ASSETS_DIR . 'assets.php'; // Main plugin file URL for fast enqueuing scripts and styles
    require_once BANG_ASSETS_DIR . 'assets.php'; // Main plugin file URL for fast enqueuing scripts and styles
    
    // Registering admin functions and scripts
    foreach (glob(BANG_ADMIN_DIR . '*.php') as $admin) {
        require_once $admin;
    }
    // Registering filters
    foreach ( glob( BANG_FILTER_DIR . '*.php' ) as $filter )
    {       require_once $filter;    }

    // Registering functions, main function files
    foreach ( glob( BANG_FUNC_DIR . '*.php' ) as $functions )
    {       require_once $functions;    }
    
    // Registering Classes, class files
    foreach ( glob( BANG_CLASS_DIR . '*.php' ) as $class )
    {       require_once $class;    }

    // Registering new actions
    foreach ( glob( BANG_ACTS_DIR . '*.php' ) as $action )
    {       require_once $action;    }

    // Registering shortcodes
    foreach ( glob( BANG_SHORTCODES_DIR . '*.php' ) as $shortcode )
    {       require_once $shortcode;    }

    // widgets path
    foreach ( glob( BANG_WIDGET_DIR . '*.php' ) as $widget )
    {	require_once $widget;       }


    //coping files from plugin dir to theme location
    function renter_make_up_activation() {

        require_once(ABSPATH . 'wp-admin/includes/file.php');

        $url = wp_nonce_url('themes.php?page=example','example-theme-options');
        if (false === ($creds = request_filesystem_credentials($url, '', false, false, null) ) ) {
                return;
        }

        if ( ! WP_Filesystem($creds) ) {
                request_filesystem_credentials($url, '', true, false, null);
                return;
        }

        $stylesheet_dir = get_stylesheet_directory();

        $plugin_dir = untrailingslashit(plugin_dir_path( __FILE__ ));

        global $wp_filesystem;
        $target = $stylesheet_dir.'/easypropertylistings';
        if (!is_dir($target)) //check for multisite installations
        {
            if ( !$wp_filesystem->mkdir($stylesheet_dir . '/easypropertylistings', FS_CHMOD_DIR) )
                    new WP_Error('mkdir_failed', __('Could not create directory.','ang-smartkit'), $stylesheet_dir . '/easypropertylistings');

            if ( ! copy_dir( $plugin_dir . '/easypropertylistings', $stylesheet_dir . '/easypropertylistings')
             ) {
            echo __('Error copying file!','ang-smartkit');
            }
        }
    }
    
    // if epl plugin active
    if($epl_active){
        register_activation_hook( __FILE__, 'renter_make_up_activation' );
        // Registering filters
        foreach ( glob( BANG_FILTER_DIR . 'epl/*.php' ) as $filter )
        {       require_once $filter;    }

        // Registering functions, main renter function files
        foreach ( glob( BANG_FUNC_DIR . 'epl/*.php' ) as $functions )
        {       require_once $functions;    }

        // Registering new actions
        foreach ( glob( BANG_ACTS_DIR . 'epl/*.php' ) as $action )
        {       require_once $action;    }
        
        // Registering shortcodes
        foreach ( glob( BANG_SHORTCODES_DIR . 'epl/*.php' ) as $shortcode )
        {       require_once $shortcode;    }
        
        // register узд scripts and styles
        require_once BANG_ASSETSEPL_DIR . 'assets-epl.php'; // Main plugin file URL for fast enqueuing scripts and styles
 
    }
    
     
    // if WooCommerce plugin active
    if($woo_active){
        
    }