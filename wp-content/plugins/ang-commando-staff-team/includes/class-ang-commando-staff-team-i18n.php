<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://torbara.com
 * @since      1.0.0
 *
 * @package    Ang_Commando_Staff_Team
 * @subpackage Ang_Commando_Staff_Team/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Ang_Commando_Staff_Team
 * @subpackage Ang_Commando_Staff_Team/includes
 * @author     Aleksandr Glovatskyy <alex1278@list.ru>
 */
class Ang_Commando_Staff_Team_i18n {

    /**
     * The domain specified for this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $domain    The domain identifier for this plugin.
     */
    private $domain; //ang

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			$this->domain, //ang
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

    /**
     * Set the domain equal to that of the specified domain.
     *
     * @since    1.0.0
     * @param    string    $domain    The domain that represents the locale of this plugin.
     */
    public function set_domain( $domain ) {
            $this->domain = $domain;
    } //ang



}
