<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://torbara.com
 * @since             1.0.0
 * @package           Ang_Commando_Staff_Team
 *
 * @wordpress-plugin
 * Plugin Name:       ANG Commando Staff Team
 * Plugin URI:        https://github.com/alex1278/ang-commando-staff-team
 * Description:       The plugin creates and displays your company team members.
 * Tags:              team, member, staff, custom post type, custom taxonomy, images, custom fields, shortcode
 * Version:           1.0.0
 * Date:              30.06.2016
 * Author:            Aleksandr Glovatskyy
 * Author URI:        http://torbara.com
 * Author e-mail:     alex1278@list.ru
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ang-commando-staff-team
 * Domain Path:       /languages
 * 
 * 
 * ANG Commando Staff Team is free software: you can redistribute it and/or modify 
 * it under the terms of the GNU General Public License as published by 
 * the Free Software Foundation, either version 2 of the License, or 
 * any later version.
 *
 * ANG Commando Staff Team is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * A copy of the GNU General Public License has been included with
 * ANG Commando Staff Team.
 *
 * @subpackage  Widget/CPT
 * @copyright  Copyright (c) 2016, ANG
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'ANG_COMMANDO_BASE', plugin_basename(__FILE__) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ang-commando-staff-team-activator.php
 */
function activate_ang_commando_staff_team() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ang-commando-staff-team-activator.php';
	Ang_Commando_Staff_Team_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ang-commando-staff-team-deactivator.php
 */
function deactivate_ang_commando_staff_team() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ang-commando-staff-team-deactivator.php';
	Ang_Commando_Staff_Team_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ang_commando_staff_team' );
register_deactivation_hook( __FILE__, 'deactivate_ang_commando_staff_team' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ang-commando-staff-team.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ang_commando_staff_team($version) {
        
	$plugin = new Ang_Commando_Staff_Team($version);
	$plugin->run();

}
run_ang_commando_staff_team('1.0.0');
