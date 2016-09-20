<?php
/*
* @package      Custom icon style
* @encoding     UTF-8
* @version      2.0.1
* @author       Aleksandr Glovatskyy (aleksandr1278@gmail.com)
* @copyright    Copyright ( C ) 2015 torbar (http://torbara.com/). All rights reserved.
* @license      Copyrighted Commercial Software
* @support      support@torbara.com
*/


//Custom login (registration) page
function ang_admin_style() { ?>
    <style type="text/css">
        .warp .tm-sidebar .tm-sidebar-logo {
            background: url(<?php echo get_template_directory_uri(); ?>/images/icon.png) no-repeat center center;
            width: auto;
            height: 50px;
            margin: 25px 0 0;
            padding: 0;
            color: #fafbf8;
            text-align:center;
        }
        .warp .tm-sidebar .tm-sidebar-logo img {
            display:none;         
        }
        #toplevel_page_warp .wp-menu-image.dashicons-before img {
            display: none;
        }
        #toplevel_page_warp div.dashicons-before:before {
            content:"";
            background:url(<?php echo get_template_directory_uri() ; ?>/images/icon.png) no-repeat center center; 
            background-size:cover;
            background-origin:content-box;
        }
        #warp .tm-sidebar {
            width: 195px;
            min-width: 195px;
        }
    </style>
<?php 
}
add_action( 'admin_head', 'ang_admin_style' );