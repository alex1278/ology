<?php
/*
* @encoding   UTF-8
* @author    Aleksandr Glovatskyy (aleksandr1278@gmail.com)
* @copyright  Copyright ( C ) 2015 torbar (http://torbara.com/). All rights reserved.
* @license  Copyrighted Commercial Software
* @support    support@torbara.com
*/

/*
 *  Load TGM plugin activation
 */
require_once( get_template_directory() . '/includes/class-tgm-plugin-activation.php' );

/*  TGM plugin activation
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'ology_recommended_plugins' ) ) {

        function ology_recommended_plugins() {

                $plugins = array(

                    // Plugins from Wordpress.org
                        array(
                            'name'      => esc_html__('Contact Form 7', 'ology'),
                            'slug'      => 'contact-form-7',
                            'required'  => false,
                        ),
                        array(
                            'name'      => esc_html__('Widget Logic', 'ology'),
                            'slug'      => 'widget-logic',
                            'required'  => false,
                        ),
                        array(
                            'name'      => esc_html__('WP Editor', 'ology'),
                            'slug'      => 'wp-editor',
                            'required'  => false,
                        ),
                        array(
                            'name'      => esc_html__('Widget Shortcode', 'ology'),
                            'slug'      => 'widget-shortcode',
                            'required'  => false,
                        ),
                    
                        array(
                            'name'      => esc_html__('Quick and Easy Testimonials', 'ology'),
                            'slug'      => 'quick-and-easy-testimonials',
                            'required'  => false,
                        ),
                        array(
                            'name'     => esc_html__('Email Subscribers', 'ology'),
                            'slug'     => 'email-subscribers',
                            'required' => false,
                        ),
                        array(
                            'name'      => esc_html__('T(-) Countdown', 'ology'),
                            'slug'      => 'jquery-t-countdown-widget',
                            'required'  => false,
                        ),
                        array(
                            'name'      => esc_html__('PS Disable Auto Formatting', 'ology'),
                            'slug'      => 'ps-disable-auto-formatting',
                            'required'  => false,
                        ),
                        array(
                            'name'      => esc_html__('The Events Calendar', 'ology'),
                            'slug'      => 'the-events-calendar',
                            'required'  => false,
                        ),
                        
			// Custom Plugins
                        
                        array(
                            'name'      => esc_html__('ANG SmartKit', 'ology'),
                            'slug'      => 'ang-smartkit',
                            'source'    => get_template_directory() . '/plugins/ang-smartkit.zip',
                            'version'  => '1.0.0',
                            'required'  => false,
                        ),
                        array(
                            'name'     => esc_html__('ANG Mega Slide', 'ology'),
                            'slug'     => 'ang-megaslide',
                            'source'   => get_stylesheet_directory() . '/plugins/ang-megaslide.zip',
                            'version'  => '1.0.0',
                            'required' => false,
                        ),
                        array(
                            'name'      => esc_html__('ANG Most Popular Posts', 'ology'),
                            'slug'      => 'ang-most-popular-posts',
                            'source'    => get_template_directory() . '/plugins/ang-most-popular-posts.zip',
                            'version'  => '1.2.1',
                            'required'  => false,
                        ),
                        array(
                            'name'      => esc_html__('ANG Breadcrumbs & Title', 'ology'),
                            'slug'      => 'ang-breadcrumbs-plus-title',
                            'source'    => get_template_directory() . '/plugins/ang-breadcrumbs-plus-title.zip',
                            'version'  => '1.1.5',
                            'required'  => false,
                        ),
                        array(
                            'name'      => esc_html__('ANG Text Field Generator', 'ology'),
                            'slug'      => 'ang-text-field-generator',
                            'source'    => get_template_directory() . '/plugins/ang-text-field-generator.zip',
                            'version'  => '1.0.0',
                            'required'  => false,
                        ),
                        array(
                            'name'      => esc_html__('ANG Commando Staff Team', 'ology'),
                            'slug'      => 'ang-commando-staff-team',
                            'source'    => get_template_directory() . '/plugins/ang-commando-staff-team.zip',
                            'version'  => '1.0.0',
                            'required'  => false,
                        ),
                        array(
                            'name'      => esc_html__('Envato Market', 'ology'),
                            'slug'      => 'envato-market',
                            'source'    => get_template_directory() . '/plugins/envato-market.zip',
                            'required'  => false,
                        ),
                        array(
                            'name'     => esc_html__('TT Warp 7 Framework', 'ology'),
                            'slug'     => 'tt-warp.7.3.30',
                            'version'  => '7.3.30',
                            'source'   => get_template_directory() . '/plugins/tt-warp.7.3.30.zip',
                            'required' => TRUE,
                        )
                );
                $config = array('is_automatic' => true);
                tgmpa($plugins, $config);
        }
}
add_action( 'tgmpa_register', 'ology_recommended_plugins' );
