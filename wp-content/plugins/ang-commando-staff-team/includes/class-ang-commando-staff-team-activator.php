<?php

/**
 * Fired during plugin activation
 *
 * @link       http://torbara.com
 * @since      1.0.0
 *
 * @package    Ang_Commando_Staff_Team
 * @subpackage Ang_Commando_Staff_Team/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Ang_Commando_Staff_Team
 * @subpackage Ang_Commando_Staff_Team/includes
 * @author     Aleksandr Glovatskyy <alex1278@list.ru>
 */
class Ang_Commando_Staff_Team_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
            
            $options = array(
                'redirect'              => false,

                //'title'                 => 'yes',
                //'profile_link'          => 'yes',
                'template'              => 'images',
                'columns'               => 4,
                'title_size'            => 20,
                'card_margin'           => 0,
                'main_color'            => '1F7DCF',
                'accent_color'          => '1F7DCF',
                'background_color'      => '00BBFF',
                'text_color'            => '1F7DCF',
                //'margin'                => 5,
                //'height'                => 400,
                'link_text'             => 'Click Here >>',
                'word_count'            => 10,
                'member_count'          => -1,
                'single_template'       => 'standard',
                
                //ang
                'single_cases'          => 'yes',
                'single_skills'         => 'yes',
                'single_stars'          => 'yes',
                'single_social'         => 'yes',
                'single_social_style'   => 'round',
                'single_image_style'    => 'center',
                
                'uikit_css'             => 'no',
                'uikit_js'              => 'no',
                'delete_on_uninstall'   => 'no',

            );

            if ( !get_option( 'ang_commando_staff_team_options' ) ) {
                add_option( 'ang_commando_staff_team_options', $options );
                $options[ 'redirect' ] = true;
                update_option( 'ang_commando_staff_team_options', $options );
            }


	}

}
