<?php

/**
 * SHORTCODE :: Small shortcode pack
 *
 * @package     ANG Plugins
 * @subpackage  Shortcode/pack
 * @copyright   Copyright (c) 2016, Aleksandr Glovatskyy
 * @since       1.1.1
 * @date        01.08.2015
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
// Only load on front
if( is_admin() ) {
	return;
}

/* 
 * Shortcode creates form for admin login
 */
    function admin_login_form($atts) {
        extract(shortcode_atts(array(
                'button_name' => 'Administrator',
            ), $atts));
        $log_admin = esc_url(site_url('wp-login.php', 'login_post')); 
        return     '<a class="tm-footer-button uk-button uk-button-primary uk-margin-bottom" href="#tm-offline-modal" data-uk-modal="{center:true}">'.$button_name.'</a>
                        <div id="tm-offline-modal" class="uk-modal">
                            <div class="uk-modal-dialog">
                                <a href="" class="uk-modal-close uk-close"></a>
                                <h2 class="uk-text-center">Administrator Login</h2>
                                <div class="uk-grid uk-grid-medium " data-uk-grid-margin >
                                    <div class="uk-width-1-1 uk-width-small-2-3 uk-container-center">
                                        <form name="loginform" class="login_form" action="'.$log_admin.'" method="post">
                                             <p><label for="user_login">Username</label></p>
                                             <input class="tm-touch-name" type="text" placeholder="username" name="log" />
                                             <p><label for="user_login">Password</label></p>
                                             <input  class="tm-touch-email" type="password" placeholder="password" name="pwd" />
                                             <div class="uk-text-center uk-width-1-1 uk-width-small-1-2">
                                                 <input  type="submit" value="Login" class="tm-touch-button uk-button uk-button-primary" style="color: #fff"/>
                                             </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>' ;
    }
    add_shortcode( 'admin_log', 'admin_login_form' );
            
/* 
 * Login-logout Link
 */
     function add_login_logout_link($items, $args) {
        $loginoutlink = wp_loginout('index.php', false);
        $items .= '<span class="ang-user-logout">'.$loginoutlink.'</span>';
        return $items;
    }
    add_shortcode('user_logout', 'add_login_logout_link');
    
    /* 
     * last user logged time 
     */
    function user_last_login(){

        if ( is_user_logged_in() ) :
            global $userdata;
            wp_get_current_user();

            return 'Your last visit:<br/>'.get_last_login($userdata->ID);
        endif;
    }
    add_shortcode('login_time', 'user_last_login');
    
    /* 
     * user last login date
     */
    function your_last_login($login) {
        global $user_ID;
        $user = get_user_by('login',$login);
        update_user_meta($user->ID, 'last_login', current_time('mysql'));
    }
    add_action('wp_login','your_last_login');
    
    function get_last_login($user_id) {
        $last_login = get_user_meta($user_id, 'last_login', true);
        $date_format = get_option('date_format') . ' ' . get_option('time_format');
        $the_last_login = mysql2date($date_format, $last_login, false);
        return $the_last_login;
    }

    // get theme info
    function ang_theme_info($atts, $content = nul){
        extract(shortcode_atts(array(
                'info'    =>	'description', //
	), $atts ) );
	
        return get_bloginfo($info);
        
        /*
         * params we can use:
        
            name - название блога;
            description - короткое описание сайта, которое задается в настройках;
            template_url - УРЛ директории текущей темы;
            rss2_url - УРЛ RSS 2.0 фида (/feed);
            comments_rss2_url - УРЛ RSS 2.0 фида комментариев (/comments/feed);
            pingback_url - УРЛ для уведомлений на XML-RPC файл (xmlrpc.php);
            stylesheet_url - УРЛ на файл стилей CSS (обычно style.css) текущей темы;
            charset - кодировка сайта;
            version - используемая версия WordPress;
            html_type - Content-Type HTML стараницы (обычно text/html).

        Rarely used:

            stylesheet_directory - УРЛ директории текущей темы;
            template_directory - УРЛ директории текущей темы;
            admin_email - Емаил адресс администратора;
            rdf_url - УРЛ RDF/RSS 1.0 фида (/feed/rfd);
            rss_url - УРЛ RSS 0.92 фида (/feed/rss);
            atom_url - УРЛ Atom фида (/feed/atom).
        
         */
    }
    add_shortcode('ang_theme','ang_theme_info');