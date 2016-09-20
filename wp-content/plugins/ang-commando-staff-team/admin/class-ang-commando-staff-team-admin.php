<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://torbara.com
 * @since      1.0.0
 *
 * @package    Ang_Commando_Staff_Team
 * @subpackage Ang_Commando_Staff_Team/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ang_Commando_Staff_Team
 * @subpackage Ang_Commando_Staff_Team/admin
 * @author     Aleksandr Glovatskyy <alex1278@list.ru>
 */
class Ang_Commando_Staff_Team_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
        
        /**
	 * Admin option page.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	private $devmode;
        
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $devmode) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->devmode = $devmode;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ang_Commando_Staff_Team_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ang_Commando_Staff_Team_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ang-commando-staff-team-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name. '-font-awesome', plugin_dir_url( __FILE__ ) . 'css/font-awesome.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ang_Commando_Staff_Team_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ang_Commando_Staff_Team_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ang-commando-staff-team-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'-jscolor', plugin_dir_url( __FILE__ ) . 'js/jscolor/jscolor.js', array( 'jquery' ), $this->version, false );

	}

}
