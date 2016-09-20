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
    require_once TT_WARP_PLUGIN_DIR.'warp/config/layouts/fields/demoinstall_ajax.php';
}