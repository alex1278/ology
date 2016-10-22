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

// Detect Warp 7 plugin. It is required plugin.
if ( defined('TT_WARP_PLUGIN_URL') ) {
    // get warp
    $warp = require(get_template_directory().'/warp.php');

    // load template file, located in /warp/systems/wordpress/layouts/comments.php
    echo $warp['template']->render('comments');
} else {
    // Otherwise, we work in legacy mode.
    // Template situated in /lib/templates/structure/comments.php
    require_once get_template_part().'/lib/templates/structure/comments.php';
}
