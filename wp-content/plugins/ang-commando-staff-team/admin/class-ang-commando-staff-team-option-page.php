<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Option page class.
 * 
 * @link       http://torbara.com
 * @since      1.0.0
 *
 * @package    Ang_Commando_Staff_Team
 * @subpackage Ang_Commando_Staff_Team/admin
 * @author     Aleksandr Glovatskyy <aleksand1278@gmail.com>
 */

class Ang_Commando_Staff_Team_Option_Page {
    public $post_type_name;
    public $plugin_name;
    
    
    /**
     * public constructor function.
     *
     * @since   1.3.0
     */
    public function __construct($plugin_name, $post_type_name) {
        $this->post_type_name = $post_type_name;
        $this->plugin_name = $plugin_name;
    }
    
        /**
        * Register option page
        *
        * @since     1.0.0
        */
        
        public function ang_plugin_options_menu() {

            add_submenu_page( 'edit.php?post_type='.$this->post_type_name, 'Settings', 'Settings', 'administrator', $this->plugin_name.'_settings', array( $this, 'ang_plugin_option_settings' ) );
        }
        
        /**
        * Updute option page
        *
        * @since     1.0.0
        */
        
        public function ang_plugin_option_settings() {

            if ( isset( $_REQUEST[ 'ang_commando_staff_team_save' ] ) && $_REQUEST[ 'ang_commando_staff_team_save' ] == 'Update' ) :
                update_option( 'ang_commando_staff_team_options', $_REQUEST[ 'ang_commando_staff_team_options' ] );
            endif;

            require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/options.php';
        }

        
}