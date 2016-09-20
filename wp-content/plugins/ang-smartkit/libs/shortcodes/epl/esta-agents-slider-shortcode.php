<?php

/**
 * SHORTCODE :: Agents or any user role [agent_slider]
 * Description: Widget, displays property agents in slider style.
 * Plugin URL: http://karate.do-i-posle.dzu/
 * Author: Aleksandr Glovatskyy
 * Author URI: http://karate.do-i-posle.dzu/
 * Date: 27.11.2015
 * Version: 1.0.0
 * License: GPL2+
 * @package     ESTA
 * @subpackage  Shortcode/agents
 * @copyright   Copyright (c) 2016, Aleksandr Glovatskyy
 * @since       1.1.1
 */

/*
 * [agent_slider role = property_agent
                orderby  = login
                order=ASC
                number = "8"
                title = "Property Agents"
                but_name = "All agents"
                page_link_id = "17"
                slidenav_btn = 1
                autoplay    = 1
                infinite = 1
                pauseOnHover = 1
                autoplayInterval = 7000]
                Here is a place for your shortcode content.
    [/agent_slider]

 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Only load on front
if( is_admin() ) {
	return;
}

/***************************************
 ********************** The Shortcode, displays sortable users  with argument, filter-tab or sidebar wiev
*********************************/

function agent_slider_shortcode($atts, $content = null){
        extract(shortcode_atts(array(
            'role'         => 'property_agent',
            'orderby'      => 'login',
            'order'        => 'ASC',
            'offset'       => '',
            'search'       => '',
            'number'       => '',
            'title'        => 'Property Agents',
            'but_name'     => '',
            'page_link_id' => '',
            'slidenav_btn' => 1,
            'autoplay'     => 1,
            'infinite'     => 1,
            'pauseOnHover' => 1,
            'autoplayInterval' => 7000,
            
            
             ), $atts));
        
        ob_start();
        
        $slideshow_cfg = array ();
        
        $slideshow_cfg[] = "autoplayInterval: ".$autoplayInterval;
        if($autoplay == 1){$slideshow_cfg[] = "autoplay: true";}else{$slideshow_cfg[] = "autoplay: false";}
        if($infinite == 1){$slideshow_cfg[] = "infinite: true";}else{$slideshow_cfg[] = "infinite: false";}
        if($pauseOnHover == 1){$slideshow_cfg[] = "pauseOnHover: true";}else{$slideshow_cfg[] = "pauseOnHover: false";}
        
        $args = array(
                'blog_id'      => $GLOBALS['blog_id'],
                'role'         => $role,
                'meta_key'     => '',
                'meta_value'   => '',
                'meta_compare' => '',
                'meta_query'   => array(),
                'include'      => array(),
                'exclude'      => array(),
                'orderby'      => $orderby,
                'order'        => $order,
                'offset'       => $offset,
                'search'       => $search,
                'number'       => $number,
                'count_total'  => false,
                'fields'       => 'all',
                'who'          => '',
                'date_query'   => array() // look at WP_Date_Query
        );
        
        
        $users = get_users( $args );
       ?>
<div class="ang-user-slider role-<?php echo $role; ?> order_by-<?php echo $p_order_by; ?> esta-header-style">
    <div class="uk-slidenav-position" data-uk-slider="{<?php echo esc_attr(implode(', ', $slideshow_cfg)); ?>}">
    
        <?php if($title != NULL) : ?>
            <h3 class="uk-panel-title">
                <span>
                    <?php if($slidenav_btn == 1) { ?>
                    <a draggable="false" href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slider-item="previous"></a>
                        <?php echo $title; ?>
                    <a draggable="false" href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slider-item="next"></a>
                    <?php } else{
                        echo $title;
                    } ?>
                </span>
            </h3>
        <?php endif; ?>
        <?php if($content != NULL) : ?>
            <div class="uk-width-1-1 tm-widget-descr uk-margin-large-bottom">
                <p class="tm-widget-title-content"><?php echo $content; ?></p>
            </div>
         <?php endif; ?>

        <div class="uk-slider-container">
            <ul class="uk-slider uk-grid uk-grid-medium uk-grid-width-1-1 uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 uk-grid-width-xlarge-1-4">
     <?php
            foreach( $users as $user ){
                
                // processing
                $author_id              = $user->ID;
                $name 			= get_the_author_meta( 'display_name' , $author_id);
                $mobile 		= get_the_author_meta( 'mobile' , $author_id);
                $facebook 		= get_the_author_meta( 'facebook' , $author_id);
                $linkedin 		= get_the_author_meta( 'linkedin' , $author_id);
                $google 		= get_the_author_meta( 'google' , $author_id);
                $twitter 		= get_the_author_meta( 'twitter' , $author_id);
                $email 			= get_the_author_meta( 'email' , $author_id);
                $position 		= get_the_author_meta( 'position' , $author_id);
                
                $facebook_check= "";
                $twitter_check="";
                $post_type              = array('property','land', 'rental', 'commercial', 'business', 'commercial_land' , 'location_profile','rural');
                $author_posts_count     = count_user_posts($author_id, $post_type, $public_only = false );
                
                    if($author_posts_count < 1){
                        $prop_number = "No Listings yet";
                    }else{
                        $prop_number = $author_posts_count." properties";
                    }

                if (function_exists('get_wp_user_avatar')) {
                        $agent_ava = get_wp_user_avatar(get_the_author_meta('user_email', $author_id), 'original');
                    }else{
                        $agent_ava = get_avatar(get_the_author_meta('user_email', $author_id), 650); 
                    }

                    $permalink = get_author_posts_url($author_id, $user->user_nicename);
                    ?>
           
                <li class="">
                    <article class="tm-tab-content uk-text-center">
                        <div class="effect blow-effect">
                            <?php echo $agent_ava; ?>
                            <div class="overlay overlay-1"></div>
                            <div class="overlay overlay-2"></div>
                            <div class="uk-height-1-1 tm-overlay-agent">
                                <div class="uk-height-1-1 uk-position-relative uk-vertical-align">
                                    <div class="tm-border-block uk-vertical-align-middle  uk-container-center">
                                        <?php if ($mobile != '') { ?>
                                            <p class=' ang-agent-mobile'><?php echo esc_attr($mobile); ?></p>
                                        <?php } ?>
                                            
                                        <?php if ($email != '') { ?>
                                            <p class='ang-agent-email'><?php echo esc_attr($email); ?></p>
                                        <?php } ?>
                                        <div class="uk-width-1-1 uk-text-center ang-agent-social ">
                                            <?php if ($facebook != '') { ?>
                                                <a rel='nofollow' class='uk-icon-small uk-icon-hover uk-icon-facebook' href="<?php echo esc_attr($facebook); ?>" onclick="window.open(this.href); return false;"></a>
                                            <?php } ?>

                                            <?php if ($twitter != '') { ?>
                                                <a rel='nofollow' class='uk-icon-small uk-icon-hover uk-icon-twitter' href="<?php echo esc_attr($twitter); ?>" onclick="window.open(this.href); return false;"></a>
                                            <?php } ?>

                                            <?php if ($google != '') { ?>
                                                <a rel='nofollow' class='uk-icon-small uk-icon-hover uk-icon-google-plus' href="<?php echo esc_attr($google); ?>" onclick="window.open(this.href); return false;"></a>
                                            <?php } ?>

                                            <?php if ($linkedin != '') { ?>
                                                <a rel='nofollow' class='uk-icon-small uk-icon-hover uk-icon-linkedin' href="<?php echo esc_attr($linkedin); ?>" onclick="window.open(this.href); return false;"></a>
                                            <?php } ?>
                                         </div>
                                        <div class="home-page-button"><a class="uk-button uk-button-primary" href="<?php echo $permalink ;?>" title="More Info">More Info</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-1 tm-bottom-agent-info">
                            <h5><a class="author-title" href="<?php echo $permalink; ?>"> <?php echo $name; ?></a></h5>
                            <?php if($instance['wp_roles']=="property_agent"){ ?>
                                    <p class="uk-margin-remove agent-prop-number"><?php echo $prop_number; ?></p>
                            <?php } ?>
                            <?php if ($position != '') { ?>
                                    <p class='tm-agent-position'><?php echo esc_attr($position); ?></p>
                            <?php } ?>
                        </div>
                    </article>
                </li>
    
   <?php } ?>
                
            </ul>
        </div>
    </div>
    <?php if($but_name != '') { ?>
    <div class="ang-slider-but-wrap">
        <a class="uk-button uk-button-primary tm-button-esta" href="<?php echo get_page_link( $page_link_id ); ?>" data-uk-scrollspy="{cls:'uk-animation-fade', repeat: false, delay:800}"><?php echo $but_name; ?></a>
    </div>
    <?php } ?>
</div>
        <?php
    wp_reset_query(); 

        return ob_get_clean();
    }
if($epl_active){
    add_shortcode('agent_slider', 'agent_slider_shortcode');
}
    