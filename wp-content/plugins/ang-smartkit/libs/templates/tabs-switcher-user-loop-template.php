<?php
/*
 * Template: (Ajax page loader template)grid_parallax
 * Main query loop template: loop temolate for shortcode [main_query_posts], parent file: "query-posts-loop-shortcode.php"
 * 
 * @package      ANG Themes
 * @subpackage  Shortcode
 * 
 * @Author:     Aleksandr Glovatskyy
 * @date        12.03.2016
 */

?>
<div class="ang-tabs-switcher-wrapp role-<?php echo $role; ?> order_by-<?php echo $orderby; ?> <?php echo $extra_class; ?>">
    <?php if($content){?>
        <div class="ang-short-descr uk-margin"><div class=""><?php echo $content; ?></div></div>
    <?php } ?>
    <?php   $users = get_users( $user_args ); 
            $slide_count=0; ?>
                <div class="ang-tabs-switcher">
                    <div class="uk-grid <?php if($gutter != '') {echo ' uk-grid-'.$gutter;} ?>" data-uk-grid-margin="">
                        <div class="uk-width-1-1 <?php if($tab_position == 'right' || $tab_position == 'left'){ echo $uk_grid_small_first.$uk_grid_medium_first.$uk_grid_large_first.$uk_grid_xlarge_first ;}; if($tab_position == 'right'){ echo $uk_push;} ?>">
                            <div class="<?php if($center_tab) echo 'uk-tab-center';?>">
                                <ul class="ang-ajax-container <?php echo $toggle_mode; if($tab_grid) echo ' uk-tab-grid'; if($tab_position != '') {echo ' uk-tab-'.$tab_position;} ?>" <?php echo $data_attr ;?>>
                                    <?php foreach( $users as $user_tab ){
                                        
                                        $author_id              = $user_tab->ID;
                                        $name                   = get_the_author_meta('display_name', $author_id);
                                        $position               = get_the_author_meta('position', $author_id);
                                        
                                        //Get Small user avatar for tab
                                        if (function_exists('get_wp_user_avatar')) {
                                            $tab_ava = get_wp_user_avatar(get_the_author_meta('user_email', $author_id), 50);
                                        }else{
                                            $tab_ava = get_avatar(get_the_author_meta('user_email', $author_id), 50); 
                                        }
                                        ?>

                                    <li class="<?php if($tab_grid == true){ echo 'uk-width-1-'.$limit;} ?>">
                                        <a class='author-title' href="">
                                            <?php echo $tab_ava; ?>
                                            <div class="ang-username-tab">
                                                <?php if ($name != '') { ?>
                                                    <h5 class="uk-margin-remove"> <?php echo esc_attr( $name); ?></h5>
                                                <?php } ?>
                                                <?php if ($position != '') { ?>
                                                    <span class=" uk-displau-inline-block ang-agent-position"><?php echo esc_attr($position); ?></span>
                                                <?php } ?>
                                            </div><!-- /.ang-username-tab -->
                                        </a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="uk-width-1-1 <?php if($tab_position == 'right' || $tab_position == 'left'){ echo $uk_grid_small_second.$uk_grid_medium_second.$uk_grid_large_second.$uk_grid_xlarge_second ;}; if($tab_position == 'right'){ echo $uk_pull;}?>">
                            <ul id="<?php echo $connect_id; ?>" class="ang-ajax-container uk-switcher uk-margin">
                    <?php   
                            foreach( $users as $user ){
                            // Foreach users
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
                                //$video                  = get_the_author_meta('video', $author_id);
                                //$e_video                = wp_oembed_get($video);
                                $description            = get_the_author_meta('description', $author_id);
                                $contact_form           = get_the_author_meta('contact-form', $author_id);
                                $author_ava             = get_the_author_meta('user_email', $author_id);

                                $post_type = array('property', 'land', 'rental', 'commercial', 'business', 'commercial_land', 'rural');
                                $agent_properties_count = count_user_posts($author_id, $post_type, $public_only = false);
                                $user_post_count = count_user_posts($author_id);
                                
                                // Get user posts or agent properties
                                if ( $user->has_cap('property_agent') ) {
                                    if($agent_properties_count < 1){
                                        $prop_number = '<span>'.esc_html__('No properties yet', 'renter').'</span>';
                                    }else{
                                        $prop_number = esc_html__('Properties: ', 'renter').'<span>'.esc_attr($agent_properties_count).' </span>';
                                    }
                                }else{
                                    $prop_number = $author_posts_count.esc_html__(' posts', 'renter');
                                }
                                
                                // Get user avatar
                                if (function_exists('get_wp_user_avatar')) {
                                        $author_ava = get_wp_user_avatar(get_the_author_meta('user_email', $author_id), 'original');
                                    }else{
                                        $author_ava = get_avatar(get_the_author_meta('user_email', $author_id), 650); 
                                    }
                                    
                                    // Get user post archive URL
                                    $permalink = get_author_posts_url($author_id, $user->user_nicename);

                              //require post template
                              switch ($template) {
                                    case "property_agent":
                                        print '<li class="item-'.$slide_count.'">';
                                                require load_template_path("tabs-switcher-{$template}.php");
                                        print '</li>';
                                    break;
                                    default:
                                        print '<li class="item-'.$slide_count.'">';
                                        print '<p>Template name does not exist.</p>';          
                                        print '</li>';
                                    break;
                                }

                              $slide_count++;
                        } ?>
            <!--        end of posts loop-->
                            </ul>
                        </div>
                    </div>
                </div>
                <?php 
                
        wp_reset_postdata(); ?>  
</div>
<?php          
                    