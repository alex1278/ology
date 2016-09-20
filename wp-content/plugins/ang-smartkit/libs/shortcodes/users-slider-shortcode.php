<?php

/**
 * SHORTCODE :: Any user role [author_slider]
 * Description: Widget, displays authors in slider style.
 * Plugin URL: http://karate.do-i-posle.dzu/
 * Author: Aleksandr Glovatskyy
 * Author URI: http://karate.do-i-posle.dzu/
 * Date: 27.11.2015
 * Version: 1.0.0
 * License: GPL2+
 * @package      ANG Themes
 * @subpackage  Shortcode/Authors
 * @copyright   Copyright (c) 2016, Aleksandr Glovatskyy
 * @since       1.1.1
 */

/*
 * [author_slider role = author
                orderby  = login
                order=ASC
                number = "8"
                title = "Bloggers"
                but_name = "All agents"
                page_link_id = "17"
                slidenav_btn = 1
                autoplay    = 1
                infinite = 1
                pauseOnHover = 1
                autoplayInterval = 7000]
                Here is a place for your shortcode content.
    [/author_slider]

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

function author_slider_shortcode($atts, $content = null){
        extract(shortcode_atts(array(
            'role'         => 'author',
            'orderby'      => 'login',
            'order'        => 'ASC',
            'offset'       => '',
            'search'       => '',
            'number'       => '',
            
            'title'        => 'Bloggers',
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
<div class="ang-user-slider role-<?php echo $role; ?> order_by-<?php echo $orderby; ?> underlined-header">
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
            <ul class="uk-slider uk-grid uk-grid-medium uk-grid-width-1-1 uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 uk-grid-width-xlarge-1-5">
     <?php
            foreach( $users as $user ){
                
                    // processing
                $author_id              = $user->ID;
                $author_registered      = get_the_author_meta('user_registered', $author_id);
                $name                   = get_the_author_meta('display_name', $author_id);
                $mobile                 = get_the_author_meta('mobile', $author_id);
                $mobile2                = get_the_author_meta('mobile2', $author_id);
                $mobile3                = get_the_author_meta('mobile3', $author_id);
                $website                = get_the_author_meta('url', $author_id);
                $facebook               = get_the_author_meta('facebook', $author_id);
                $odnoklassniki          = get_the_author_meta('odnoklassniki', $author_id);
                $vk                     = get_the_author_meta('vk', $author_id);
                $google                 = get_the_author_meta('google', $author_id);
                $google_plus            = get_the_author_meta('google-plus', $author_id);
                $twitter                = get_the_author_meta('twitter', $author_id);
                $linkedin               = get_the_author_meta('linkedin', $author_id);
                $pinterest              = get_the_author_meta('pinterest', $author_id);
                $instagram              = get_the_author_meta('instagram', $author_id);
                $flickr                 = get_the_author_meta('flickr', $author_id);
                $behance                = get_the_author_meta('behance', $author_id);
                $dribbble               = get_the_author_meta('dribbble', $author_id);
                $youtube                = get_the_author_meta('youtube', $author_id);
                $vimeo                  = get_the_author_meta('vimeo', $author_id);
                $email                  = get_the_author_meta('email', $author_id);
                $skype                  = get_the_author_meta('skype', $author_id);
                $slogan                 = get_the_author_meta('slogan', $author_id);
                $position               = get_the_author_meta('position', $author_id);
                $video                  = get_the_author_meta('video', $author_id);
                $e_video                = wp_oembed_get($video);
                $description            = get_the_author_meta('description', $author_id);
                $contact_form           = get_the_author_meta('contact-form', $author_id);
                $author_ava             = get_the_author_meta('user_email', $author_id);
              
                $post_type              = array('post');
                $author_posts_count     = count_user_posts($author_id, $post_type, $public_only = false );
                
                    if($author_posts_count < 1){
                        $prop_number = "No posts yet";
                    }else{
                        $prop_number = $author_posts_count." posts";
                    }

                if (function_exists('get_wp_user_avatar')) {
                    $author_ava = get_wp_user_avatar(get_the_author_meta('user_email', $author_id), 'original');
                    }else{
                    $author_ava = get_avatar(get_the_author_meta('user_email', $author_id), 650); 
                    }

                    $permalink = get_author_posts_url($author_id, $user->user_nicename);
            ?>
           
                <li class="">
                    <article class="tm-tab-content uk-text-center">
                        <div class="effect blow-effect">
                            <?php echo $author_ava; ?>
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
                                                
                                            <?php if ($instagram != '') { ?>
                                                <a rel='nofollow' class='uk-icon-small uk-icon-hover uk-icon-instagram' href="<?php echo esc_attr($instagram); ?>" onclick="window.open(this.href); return false;"></a>
                                            <?php } ?>
                                            <?php if ($flickr != '') { ?>
                                                <a rel='nofollow' class='uk-icon-small uk-icon-hover uk-icon-flickr' href="<?php echo esc_attr($flickr); ?>" onclick="window.open(this.href); return false;"></a>
                                            <?php } ?>
                                            <?php if ($pinterest != '') { ?>
                                                <a rel='nofollow' class='uk-icon-small uk-icon-hover uk-icon-pinterest' href="<?php echo esc_attr($pinterest); ?>" onclick="window.open(this.href); return false;"></a>
                                            <?php } ?>
                                            <?php if ($behance != '') { ?>
                                                <a rel='nofollow' class='uk-icon-small uk-icon-hover uk-icon-behance' href="<?php echo esc_attr($behance); ?>" onclick="window.open(this.href); return false;"></a>
                                            <?php } ?>
                                            <?php if ($dribbble != '') { ?>
                                                <a rel='nofollow' class='uk-icon-small uk-icon-hover uk-icon-dribbble' href="<?php echo esc_attr($dribbble); ?>" onclick="window.open(this.href); return false;"></a>
                                            <?php } ?>
                                         </div>
                                        <div class="home-page-button"><a class="uk-button uk-button-primary" href="<?php echo $permalink ;?>" title="More Info"><?php esc_html_e( 'More Info', 'ang-plugins' ) ; ?></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-1 tm-bottom-agent-info">
                            <h5><a class="author-title" href="<?php echo $permalink; ?>"> <?php echo $name; ?></a></h5>
                            <?php if($role == "property_agent"){ ?>
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
        <a class="uk-button uk-button-primary ang-but-more" href="<?php echo get_page_link( $page_link_id ); ?>" data-uk-scrollspy="{cls:'uk-animation-fade', repeat: false, delay:800}"><?php echo $but_name; ?></a>
    </div>
    <?php } ?>
</div>
        <?php
    wp_reset_query(); 

        return ob_get_clean();
    }
    add_shortcode('author_slider', 'author_slider_shortcode');