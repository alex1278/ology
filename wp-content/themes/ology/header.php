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
    // start output buffer to capture content for use in footer.php

} else {
    // Otherwise, we work in legacy mode.
    // Template situated in /lib/templates/structure/header.php
    require_once get_template_part().'/lib/templates/structure/header.php';
}