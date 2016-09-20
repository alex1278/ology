<?php
/*
* @package      Renter
* @encoding     UTF-8
* @version      2.0.1
* @author       Aleksandr Glovatskyy (aleksandr1278@gmail.com)
* @copyright    Copyright ( C ) 2015 torbar (http://torbara.com/). All rights reserved.
* @license      Copyrighted Commercial Software
* @support      support@torbara.com
*/


//Custom login (registration) page
function ang_login_logo() { ?>
    
    <style type="text/css">
        body.login {
            background: url(<?php echo get_template_directory_uri() ; ?>/images/login-bg.jpg) no-repeat center center; background-size: cover;
        }
        .login .message {
            background-color:rgba(255, 255, 255, 0.5)!important;
            border-left: 4px solid #ffe348!important;
/*           color: #fafbf8;*/
        }
        .login #login_error {
            background-color:rgba(255, 255, 255, 0.5)!important;
            border-left: 4px solid #ffe348!important;
        }
        .login h1 a {
            background-image: url(<?php echo get_template_directory_uri() ; ?>/images/icon.png) !important;
        }
        #login {
            padding-top: 4%!important;
        }
        #login form {
            color: #9bb2a4!important;
            background-color:rgba(255, 255, 255, 0.5)!important;
        }
        .login input[type="text"],
        .login input[type="password"]{
            background-color: rgba(251, 251, 251, 0.65)!important;
            color: #777!important;
        }
        .login #nav a, .login #backtoblog a  {
            color: #fafbf8!important;
        }
        .login #nav a:hover, .login #backtoblog a:hover {
            color: #ffe348!important;
        }
        
    </style>
    <?php
}
add_action( 'login_enqueue_scripts', 'ang_login_logo' );