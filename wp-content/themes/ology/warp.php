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

use Warp\Warp;
use Warp\Autoload\ClassLoader;
use Warp\Config\Repository;

if (!function_exists('ology_warp_init')) {
    function ology_warp_init () {
        global $warp;

        if (!$warp) {

            require_once(TT_WARP_PLUGIN_DIR.'warp/src/Warp/Autoload/ClassLoader.php');

            // set loader
            $loader = new ClassLoader;
            $loader->add('Warp', TT_WARP_PLUGIN_DIR.'warp/src');
            $loader->add('Warp\Wordpress', TT_WARP_PLUGIN_DIR.'warp/systems/wordpress/src');
            $loader->register();

            // set config
            $config = new Repository;
            $config->load(TT_WARP_PLUGIN_DIR.'warp/config.php');
            $config->load(TT_WARP_PLUGIN_DIR.'warp/systems/wordpress/config.php');
            $config->load(TT_WARP_PLUGIN_DIR.'/config.php');

            // set warp
            $warp = new Warp(compact('loader', 'config'));
            $warp['system']->init();
        }
        return $warp;
    }
}

return ology_warp_init();