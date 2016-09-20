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

    // get content from output buffer and set a slot for the template renderer
    $warp['template']->set('content', ob_get_clean());

    // load main theme file, located in /layouts/theme.php
    echo $warp['template']->render('theme');
} else { 
    // Otherwise, we work in legacy mode.
    // Template situated in /lib/templates/structure/footer.php
    require_once get_template_directory().'/lib/templates/structure/footer.php';
}
