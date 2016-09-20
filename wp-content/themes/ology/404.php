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

    // render error layout
    echo $warp['template']->render('error', array('title' => esc_html__('Page not found', 'ology'), 'error' => '404', 'message' => sprintf(__('404_page_message', 'ology'), $warp['system']->url, $warp['config']->get('site_name'))));
} else {
    // Otherwise, we work in legacy mode.
    beans_load_document();
}
