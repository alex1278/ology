<?php
/*
 * 
 * @encoding     UTF-8
 * @author       Aleksandr Glovatskyy (aleksandr1278@gmail.com)
 * @copyright    Copyright (C) 2016 torbara (http://torbara.com/). All rights reserved.
 * @license      Copyrighted Commercial Software
 * @support      support@torbara.com
 * 
 */

//Check compatibility
if (!defined('PHP_VERSION_ID') || PHP_VERSION_ID < 50300) {

    if ( !is_admin() && !stristr($_SERVER['REQUEST_URI'], '/wp-login') ) {
        wp_die("<p><b>".wp_get_theme()." Theme error:</b> This theme requires PHP version 5.3 or higher.</p>");
    } else {
        function ology_admin_php_notice() { ?>
            <div class="error">
                <p><b><?php echo wp_get_theme(); ?> Theme error:</b> This theme requires PHP version 5.3 or higher.</p>
            </div>
            <?php
        }
        add_action('admin_notices', 'ology_admin_php_notice');
    }
    return;
}

//Bootstrap Warp 7 Framework
get_template_part('warp');