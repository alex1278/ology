<?php
/*
 * Plugin Name: ANG Users Slider
 * Description: Widget, displays property agents in slider style.
 * Plugin URL: http://karate.do-i-posle.dzu/
 * Author: Aleksandr Glovatskyy
 * Author URI: http://karate.do-i-posle.dzu/
 * Date: 22.11.2015
 * Version: 1.0.0
 * License: GPL2+
 * @package     ESTA
 * @subpackage  Widget/Agents
 * @copyright   Copyright (c) 2016, Aleksandr Glovatskyy
 * @since       1.1.1
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class ANGUserSlider extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'ANG-Agents-Slider', // Base ID
            __('ANG Users Slider', 'text_domain'), // Name
            array( 'description' => __( 'Widget, displays property agents and other users in slider style.', 'text_domain' ), ) // Args
        );
    }

    function form($instance) { ?>

        <?php $title = isset( $instance['title']) ? esc_attr( $instance['title'] ) : "Our Agents"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                Title: 
                <input class="widefat" 
                        id="<?php echo esc_attr($this->get_field_id('title')); ?>" 
                        name="<?php echo esc_attr($this->get_field_name('title')); ?>" 
                        type="text" 
                        value="<?php echo esc_attr($title); ?>" />
            </label>
        </p>
        
        
        <?php $descr = isset( $instance['descr']) ? esc_attr( $instance['descr'] ) : ""; ?>
        <p>
            <label for="<?php echo $this->get_field_id('descr'); ?>">
                Description: 
                <textarea class="widefat" rows="3" cols="10" 
                        id="<?php echo $this->get_field_id('descr'); ?>" 
                        name="<?php echo $this->get_field_name('descr'); ?>"><?php echo $descr; ?></textarea>
            </label>
        </p>
        
        <!--     Returns all registered pages-->
            
        <?php $page_link_id = isset( $instance['page_link_id'] ) ? $instance['page_link_id'] : "/"; ?>
        
        <p>
            <label for="<?php echo $this->get_field_id('page_link_id'); ?>">
                <?php _e('Select page link:', 'text_domain'); ?>
                    <?php
                    $args = array(
                               'sort_order' => 'ASC',
                               'sort_column' => 'post_title',
                               'hierarchical' => 1,
                               'exclude' => '',
                               'include' => '',
                               'meta_key' => '',
                               'meta_value' => '',
                               'authors' => '',
                               'child_of' => 0,
                               'parent' => -1,
                               'exclude_tree' => '',
                               'number' => '',
                               'offset' => 0,
                               'post_type' => 'page',
                       ); 
                       $pages = get_pages($args);
                    
                ?><select class="widefat" 
                          id="<?php echo esc_attr($this->get_field_id('page_link_id')); ?>" 
                          name="<?php echo esc_attr($this->get_field_name('page_link_id')); ?>" ><?php
                foreach ($pages as $page){
                    ?><option value="<?php echo esc_attr($page->ID); ?>" <?php if($page->ID==$page_link_id){echo 'selected=""';} ?>><?php echo $page->post_title; ?></option><?php
                }
                ?>
                </select>
            </label>
        </p>
        
        
        <!--   Button name -->
        
        <?php $but_name = isset( $instance['but_name']) ? esc_attr( $instance['but_name'] ) : "All Agents"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('but_name')); ?>">
                Button label: 
                <input class="widefat" 
                        id="<?php echo esc_attr($this->get_field_id('but_name')); ?>" 
                        name="<?php echo esc_attr($this->get_field_name('but_name')); ?>" 
                        type="text" 
                        value="<?php echo esc_attr($but_name); ?>" />
            </label>
        </p>
        
        <!--   Hide page link -->
         
        <?php $p_page_link = isset( $instance['p_page_link'] ) ? $instance['p_page_link'] : false; ?>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('p_page_link'); ?>" name="<?php echo $this->get_field_name('p_page_link'); ?>" <?php if ($p_page_link) echo 'checked'; ?> />
            <label for="<?php echo $this->get_field_id('p_page_link'); ?>"><?php _e('Hide page link button', 'text_domain'); ?></label>
        </p>
        
        <!--     Display all available wp roles -->
        
        <?php $wp_roles = isset( $instance['wp_roles'] ) ? $instance['wp_roles'] : "author"; ?>
        <p>
            <label for="<?php echo $this->get_field_id('wp_roles'); ?>">
                <?php _e('Select user role to display:', 'text_domain'); ?>
                    <?php
                    $all_wp_roles = new WP_Roles();
                    $roles = $all_wp_roles->get_names();
                    
                ?><select class="widefat" 
                          id="<?php echo esc_attr($this->get_field_id('wp_roles')); ?>" 
                          name="<?php echo esc_attr($this->get_field_name('wp_roles')); ?>" ><?php
                foreach ($roles as $key=>$role){
                    ?><option value="<?php echo esc_attr($key); ?>" <?php if($key==$wp_roles){echo 'selected=""';} ?>><?php echo $role; ?></option><?php
                }
                ?>
                </select>
            </label>
        </p>
               
          <!--     Number Items to display -->
        
        <?php $ItemCount = isset( $instance['ItemCount'] ) ? $instance['ItemCount'] : 6; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('ItemCount')); ?>">
                Number of items:
                <input class="widefat" 
                        id="<?php echo esc_attr($this->get_field_id('ItemCount')); ?>" 
                        name="<?php echo esc_attr($this->get_field_name('ItemCount')); ?>" 
                        type="number"
                        min=1
                        value="<?php echo esc_attr($ItemCount); ?>" />
            </label>
        </p>
        
<!--        Autoplay interval-->

        <?php $autoplayInterval = isset( $instance['autoplayInterval'] ) ? $instance['autoplayInterval'] : "7000"; ?>
        <p>
            <label for="<?php echo esc_attr ($this->get_field_id('autoplayInterval')); ?>">
                Autoplay Interval:
                <input class="widefat" 
                        id="<?php echo esc_attr($this->get_field_id('')); ?>" 
                        name="<?php echo esc_attr($this->get_field_name('autoplayInterval')); ?>" 
                        type="text" 
                        value="<?php echo esc_attr($autoplayInterval); ?>" />
            </label>
        </p>
        
        
        <!--   Order type extended -->
        
        <?php 
		$p_orders = array(
                        'Login' => 'login',
                        'Nicename' => 'nicename',
			'E-mail' => 'email',
			'URL' => 'url',
			'Registered' => 'registered',
			'Post count' => 'posts_count',
                        
		);
                ?>
        
       <?php $p_order_by = isset( $instance[ 'p_order_by' ] ) ? $instance[ 'p_order_by' ] : 'login'; ?>
        <p>
            <label for="<?php echo $this->get_field_id('p_order_by'); ?>">
                Order type format :
            </label> 
            <br>
            
            <select id="<?php echo esc_attr($this->get_field_id('p_order_by')); ?>" name="<?php echo esc_attr($this->get_field_name('p_order_by')); ?>">
                <?php foreach($p_orders as $p_order =>$value){ ?>
            
                                
                <option value="<?php echo $value; ?>" <?php if ($value == $p_order_by){ echo 'selected=""';}?> name="<?php echo esc_attr($this->get_field_name('p_order_by')); ?>" ><?php echo $p_order ; ?></option>
            <?php } ?>
                
            </select>
        </p>
        
        <!--   Post Order type -->
        
        <?php $p_order_type = isset( $instance['p_order_type'] ) ? $instance['p_order_type'] : "ASC"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'p_order_type' )); ?>">
                <?php _e('Posts order type:', 'text_domain'); ?>
            </label> 
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('p_order_type')."_ASC"); ?>" name="<?php echo esc_attr($this->get_field_name('p_order_type')); ?>" value="ASC" <?php if($p_order_type=="ASC"){ echo "checked"; }?>>ASC &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('p_order_type')."_DESC"); ?>" name="<?php echo esc_attr($this->get_field_name('p_order_type')); ?>" value="DESC" <?php if($p_order_type=="DESC"){ echo "checked"; }?>>DESC
        </p>
        
        
        <!--        Slideshow next and prev navigation -->
          
        <?php $slidenav_btn = isset( $instance['slidenav_btn'] ) ? $instance['slidenav_btn'] : "1"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'slidenav_btn' )); ?>">
                Show next and previous buttons:
            </label> 
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav_btn')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav_btn')); ?>" value="1" <?php if($slidenav_btn=="1"){ echo "checked"; }?>>Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav_btn')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav_btn')); ?>" value="2" <?php if($slidenav_btn=="2"){ echo "checked"; }?>>No
        </p>
        
<!--        Check Autoplay-->

        <?php $autoplay = isset( $instance['autoplay'] ) ? $instance['autoplay'] : "1"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'autoplay' )); ?>">
                Autoplay:
            </label>
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('autoplay')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('autoplay')); ?>" value="1" <?php if($autoplay=="1"){ echo "checked"; }?>>Yes 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('autoplay')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('autoplay')); ?>" value="2" <?php if($autoplay=="2"){ echo "checked"; }?>>No
        </p>
        
        <!--        infinite scroll true or false-->

        <?php $infinite = isset( $instance['infinite'] ) ? $instance['infinite'] : "1"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'infinite' )); ?>">
                Infinite scroll:
            </label>
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('infinite')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('infinite')); ?>" value="1" <?php if($infinite=="1"){ echo "checked"; }?>>Yes 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('infinite')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('infinite')); ?>" value="2" <?php if($infinite=="2"){ echo "checked"; }?>>No
        </p>
        
<!--        Pause on hover-->

        <?php $pauseOnHover = isset( $instance['pauseOnHover'] ) ? $instance['pauseOnHover'] : "1"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'pauseOnHover' )); ?>">
                Pause on Hover:
            </label>
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('pauseOnHover')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('pauseOnHover')); ?>" value="1" <?php if($pauseOnHover=="1"){ echo "checked"; }?>>Yes 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('pauseOnHover')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('pauseOnHover')); ?>" value="2" <?php if($pauseOnHover=="2"){ echo "checked"; }?>>No
        </p>
        
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['descr'] = $new_instance['descr'];
        $instance['page_link_id'] = $new_instance['page_link_id'];
        $instance['p_page_link'] = $new_instance['p_page_link'];
        $instance['but_name'] = $new_instance['but_name'];
        $instance['p_order_type'] = $new_instance['p_order_type'];
        $instance['p_order_by'] = $new_instance['p_order_by'];
        $instance['ItemCount'] = $new_instance['ItemCount'];
        $instance['wp_roles'] = $new_instance['wp_roles'];
        $instance['slidenav_btn'] = $new_instance['slidenav_btn'];
        $instance['autoplayInterval'] = $new_instance['autoplayInterval'];
        $instance['autoplay'] = $new_instance['autoplay'];
        $instance['infinite'] = $new_instance['infinite'];
        $instance['pauseOnHover'] = $new_instance['pauseOnHover'];
        
        return $instance;
    }

    function widget($args, $instance) {
        extract($args, EXTR_SKIP);

        echo $before_widget;
        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);

        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        }
        
        $p_page_link = $instance['p_page_link'] ? true : false;
        
        // UIkit Slideset configuration
        $slideshow_cfg = array ();
        
        $slideshow_cfg[] = "autoplayInterval: ".$instance['autoplayInterval'];
        if($instance['autoplay']=="1"){$slideshow_cfg[] = "autoplay: true";}else{$slideshow_cfg[] = "autoplay: false";}
        if($instance['infinite']=="1"){$slideshow_cfg[] = "infinite: true";}else{$slideshow_cfg[] = "infinite: false";}
        if($instance['pauseOnHover']=="1"){$slideshow_cfg[] = "pauseOnHover: true";}else{$slideshow_cfg[] = "pauseOnHover: false";}
        
       
         $args = array(
                'blog_id'      => $GLOBALS['blog_id'],
                'role'         => $instance['wp_roles'],
                'meta_key'     => '',
                'meta_value'   => '',
                'meta_compare' => '',
                'meta_query'   => array(),
                'include'      => array(),
                'exclude'      => array(),
                'orderby'      => $instance['p_order_by'],
                'order'        => $instance['p_order_type'],
                'offset'       => '',
                'search'       => '',
                'number'       => $instance['ItemCount'],
                'count_total'  => false,
                'fields'       => 'all',
                'who'          => '',
                'date_query'   => array() // look at WP_Date_Query
        );
        
        $users = get_users( $args );
       ?>
<div class="ang-user-slider role-<?php echo $instance['wp_roles']; ?> order_by-<?php echo $instance['p_order_by'] ; ?> esta-header-style">
    <div class="uk-slidenav-position" data-uk-slider="{<?php echo esc_attr(implode(', ', $slideshow_cfg)); ?>}">
    
        <?php if($instance['title'] != NULL) : ?>
            <h3 class="uk-panel-title">
                <span>
                    <?php if($instance['slidenav_btn']=="1") { ?>
                    <a draggable="false" href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slider-item="previous"></a>
                        <?php echo $instance['title']; ?>
                    <a draggable="false" href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slider-item="next"></a>
                    <?php } else{
                        echo $instance['title'];
                    } ?>
                </span>
            </h3>
        <?php endif; ?>
        <?php if($instance['descr'] != NULL) : ?>
            <div class="uk-width-1-1 tm-widget-descr uk-margin-large-bottom">
                <p class="tm-widget-title-content"><?php echo $instance['descr']; ?></p>
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
                                        <div class="home-page-button"><a class="uk-button uk-button-primary" href="<?php echo $permalink ;?>" title="More Info"><?php esc_html_e( 'More Info', 'ang-plugins' ) ; ?></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-1 tm-bottom-agent-info">
                            <h5><a class="author-title" href="<?php echo $permalink; ?>"> <?php echo $name; ?></a></h5>
                            <?php if($instance['wp_roles']=="property_agent"){ ?>
                                    <p class="uk-margin-remove agent-prop-number"><?php echo $prop_number; ?></p>
                            <?php } ?>
                            <?php if ($email != '') { ?>
                                    <p class='tm-agent-position'><?php echo esc_attr($position); ?></p>
                            <?php } ?>
                        </div>
                    </article>
                </li>
    
   <?php } ?>
                
            </ul>
        </div>
    </div>
    <?php if($p_page_link != true) { ?>
    <div class="ang-slider-but-wrap">
        <a class="uk-button uk-button-primary tm-button-esta" href="<?php echo get_page_link( $instance['page_link_id'] ); ?>" data-uk-scrollspy="{cls:'uk-animation-fade', repeat: false, delay:800}"><?php echo $instance['but_name']; ?></a>
    </div>
    <?php } ?>
</div>
        <?php
    wp_reset_query(); 

    echo $after_widget;
    }
    
}

add_action('widgets_init', create_function('', 'return register_widget("ANGUserSlider");')); ?>