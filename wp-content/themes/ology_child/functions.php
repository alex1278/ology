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
function ology_child_scripts() {
    wp_enqueue_style( 'ology-style', get_template_directory_uri(). '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'ology_child_scripts' );
