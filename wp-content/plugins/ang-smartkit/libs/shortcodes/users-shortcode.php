<?php

/**
 * SHORTCODE :: Agents or any user with filter [authors_view]
 *
 * @package     ESTA
 * @subpackage  Shortcode/agents
 * @copyright   Copyright (c) 2016, Aleksandr Glovatskyy
 * @since       1.1.1
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

function authors_view_shortcode($atts){
        extract(shortcode_atts(array(
	'blog_id'      => $GLOBALS['blog_id'],
	'role'         => 'property_agent',
	'meta_key'     => '',
	'meta_value'   => '',
	'meta_compare' => '',
	'orderby'      => 'login',
	'order'        => 'ASC',
	'offset'       => '',
	'search'       => '',
	'number'       => '',
	'count_total'  => false,
	'fields'       => 'all',
	'who'          => '',
        'view_type'    => 'filter',
        'img_size'     => 80, // default thumbnail size
         ), $atts));
        
       
        
        $args = array(
            'blog_id'      => $blog_id,
            'role'         => $role,
            'meta_key'     => $meta_key,
            'meta_value'   => $meta_value,
            'meta_compare' => $meta_compare,
            'meta_query'   => array(),
            'include'      => array(),
            'exclude'      => array(),
            'orderby'      => $orderby,
            'order'        => $order,
            'offset'       => $offset,
            'search'       => $search,
            'number'       => $number,
            'count_total'  => $count_total,
            'fields'       => $fields,
            'who'          => $who,
            'date_query'   => array(),
                 );
        
        $users = get_users( $args );
        $output = "";
    if($view_type == 'filter'){

        foreach ($users as $user) {
            $Filterpositions [] = get_the_author_meta( 'position' , $user->ID);
        }
        $Filterpositions = array_unique($Filterpositions);
        $output .='<div class="ang-user-'.$view_type.'-shortcode '.$role.' '.$orderby. '">'
            .'<div class="ang-gall-switcher-wrap">
                    <ul id="tm-agent-filter" class="uk-subnav uk-margin-small-bottom">
                        <li class="uk-active" data-uk-filter=""><a class="uk-button uk-button-primary" href="#">All</a></li>';
                        foreach ($Filterpositions as $agent_position) {
                        $output .= '<li class="" data-uk-filter="'.$agent_position.'">
                            <a class="uk-button uk-button-primary" href="#">'.str_ireplace("agent", "", $agent_position).'</a>
                        </li>';
                        }
        $output .='</ul>
                </div>';
        
        $output .= '<div class="tm-agent-gallery">
            <ul id="agent-switch" class="uk-grid uk-grid-medium uk-grid-width-1-1 uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4" data-uk-grid="{controls: \'#tm-agent-filter\', animation: \'scale\'}" >';
   }
    
     if($view_type == 'sidebar'){
       $output .='<div class="ang-user-'.$view_type.'-shortcode '.$role.' '.$orderby. '">';
        $output .= '<div class="tm-agent-'.$view_type.'">
            <ul class="uk-grid uk-grid-width-1-1">';
        }
            foreach( $users as $user ){
                
                    // processing
                $author_id              = $user->ID;
                $author_registered      = get_the_author_meta('user_registered', $author_id);
                $name 			= get_the_author_meta( 'display_name' , $author_id);
                $mobile 		= get_the_author_meta( 'mobile' , $author_id);
                $mobile2 		= get_the_author_meta( 'mobile2' , $author_id);
                $website 		= get_the_author_meta( 'url' , $author_id);
                $facebook 		= get_the_author_meta( 'facebook' , $author_id);
                $linkedin 		= get_the_author_meta( 'linkedin' , $author_id);
                $google 		= get_the_author_meta( 'google' , $author_id);
                $twitter 		= get_the_author_meta( 'twitter' , $author_id);
                $email 			= get_the_author_meta( 'email' , $author_id);
                $skype 			= get_the_author_meta( 'skype' , $author_id);
                $slogan 		= get_the_author_meta( 'slogan' , $author_id);
                $position 		= get_the_author_meta( 'position' , $author_id);
                $video 			= get_the_author_meta( 'video' , $author_id);
                $description 		= get_the_author_meta( 'description' , $author_id);
                $contact_form           = get_the_author_meta( 'contact-form' , $author_id);
                $author_ava             = get_the_author_meta( 'user_email', $author_id);

                $post_type              = array('property','land', 'rental', 'commercial', 'business', 'commercial_land' , 'location_profile','rural');
                $author_posts_count     = count_user_posts($author_id, $post_type, $public_only = false );
                
            if($view_type == 'filter'){
                if (function_exists('get_wp_user_avatar')) {
                    $agent_ava = get_wp_user_avatar(get_the_author_meta('user_email', $author_id), 'original');
                    }else{
                    $agent_ava = get_avatar(get_the_author_meta('user_email', $author_id), 650); 
                    }
            }
            
            if($view_type == 'sidebar'){    
                if (function_exists('get_wp_user_avatar')) {
                    $agent_ava = get_wp_user_avatar(get_the_author_meta('user_email', $author_id), $img_size);
                    }else{
                    $agent_ava = get_avatar(get_the_author_meta('user_email', $author_id), $img_size); 
                    }
            }   
            ?>
            <?php 
                $facebook_check = ( $facebook != '' ) ? "<a rel='nofollow' class='uk-icon-small uk-icon-hover uk-icon-facebook' href='{$facebook}' onclick='window.open(this.href); return false;'></a>" : "";
                $twitter_check = ( $twitter != '' ) ? "<a rel='nofollow' class='uk-icon-small uk-icon-hover uk-icon-twitter' href='{$twitter}' onclick='window.open(this.href); return false;'></a>" : "";
                $google_check = ( $google != '' ) ? "<a rel='nofollow' class='uk-icon-small uk-icon-hover uk-icon-google-plus' href='{$google}' onclick='window.open(this.href); return false;'></a>" : "";
                $linkedin_check = ( $linkedin != '' ) ? "<a rel='nofollow' class='uk-icon-small uk-icon-hover uk-icon-linkedin' href='{$linkedin}' onclick='window.open(this.href); return false;'></a>" : "";

                $mobile_check = ( $mobile != '' ) ? "<p class='ang-agent-mobile'>{$mobile}</p>" : "";
                $email_check = ( $email != '' ) ? "<p class='ang-agent-email'>{$email}</p>" : "";
                $position_check = ( $position != '' ) ? "<p class='tm-agent-position'>{$position}</p>" : "";

                $permalink = get_author_posts_url($author_id, $user->user_nicename);
            ?>

            <?php
                if($view_type == 'filter'){            
                    $output .='<li class="uk-margin-large-top" data-uk-filter="'.$position.'">
                                <article class="tm-tab-content uk-text-center">
                                    <div class="effect blow-effect">'
                                        .$agent_ava
                                        .'<div class="overlay overlay-1"></div>
                                        <div class="overlay overlay-2"></div>
                                        <div class="uk-height-1-1 tm-overlay-agent">
                                            <div class="uk-height-1-1 uk-position-relative uk-vertical-align">
                                                <div class="tm-border-block uk-vertical-align-middle  uk-container-center">'
                                                    .$mobile_check
                                                    .$email_check
                                                    .'<div class="uk-width-1-1 uk-text-center ang-agent-social ">'
                                                        .$facebook_check.$twitter_check.$google_check.$linkedin_check
                                                     .'</div>
                                                    <div class="home-page-button"><a class="uk-button uk-button-primary" href="'.$permalink.'" title="More Info">More Info</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-1 tm-bottom-agent-info">
                                        <h5><a class="author-title" href="'.$permalink.'">'.$name.'</a></h5>'
                                        .$position_check
                                    .'</div>
                                </article>
                            </li>';
                }

                if($view_type == 'sidebar'){          
                    $output .='<li class="" data-uk-filter="'.$position.'">
                                <div class="tm-tab-content">

                                    <div class="effect blow-effect uk-float-left tm-agent-small">'
                                        .$agent_ava
                                        .'<div class="overlay overlay-1"></div>
                                        <div class="overlay overlay-2"></div>
                                        <div class="uk-height-1-1 tm-overlay-agent">
                                            <div class="uk-height-1-1 uk-position-relative uk-vertical-align uk-text-center">
                                                <div class="tm-border-block uk-vertical-align-middle  uk-container-center">'
                                                    .'<div class="uk-width-1-1 uk-text-center ang-agent-social ">'
                                                        .$facebook_check.$twitter_check.$linkedin_check
                                                     .'</div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="uk-float-left tm-agent-small-info">'
                                        .'<a href="'.$permalink.'">'
                                            .'<h5>'.$name.'</h5>'
                                            .$position_check
                                            .$email_check
                                            .$mobile_check
                                        .'</a>'
                                    .'</div>
                                </div>
                            </li>';
                }
            }
        $output .='</ul></div></div>';
        wp_reset_postdata();
            return $output;
    }
    add_shortcode('authors_view', 'authors_view_shortcode');