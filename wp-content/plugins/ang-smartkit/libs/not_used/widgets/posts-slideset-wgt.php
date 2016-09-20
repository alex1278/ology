<?php
/*
 * Plugin Name: ANG Blog Posts Slideset
 * Description: Widget, displays blog posts in slider style.
 * Plugin URL: http://karate.do-i-posle.dzu/
 * Author: Aleksandr Glovatskyy
 * Author URI: http://karate.do-i-posle.dzu/
 * Date: 25.11.2015
 * Version: 1.0.0
 * @package     ESTA
 * @subpackage  Widget/Blog
 * @copyright   Copyright (c) 2016, Aleksandr Glovatskyy
 * @since       1.1.1
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class ANGPostsSlideset extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'ANG-Posts-Slideset', // Base ID
            esc_html__('ANG Posts Slideset', 'ang-plugins'), // Name
            array( 'description' => esc_html__( 'Widget, displays blog posts in slideset style.', 'ang-plugins' ), ) // Args
        );
    }

    function form($instance) { ?>


<!--        Title input-->

        <?php $title = isset( $instance['title']) ? esc_attr( $instance['title'] ) : "News"; ?>
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
        
        <!--        Description input-->
        
        <?php $descr = isset( $instance['descr']) ? esc_attr( $instance['descr'] ) : ""; ?>
        <p>
            <label for="<?php echo $this->get_field_id('descr'); ?>">
                Description: 
                <textarea class="widefat" rows="3" cols="10" 
                        id="<?php echo $this->get_field_id('descr'); ?>" 
                        name="<?php echo $this->get_field_name('descr'); ?>"><?php echo $descr; ?></textarea>
            </label>
        </p>
        
        <!--        Selecting category id-->
        
        <?php $CatID = isset( $instance['CatID'] ) ? $instance['CatID'] : ''; ?>
         <p>
            <label for="<?php echo $this->get_field_id('CatID'); ?>">
                Post Category:<?php
  
                $args = array(
                    'type'                     => 'post',
                    'child_of'                 => 0,
                    'parent'                   => '',
                    'orderby'                  => 'name',
                    'order'                    => 'ASC',
                    'hide_empty'               => 1,
                    'hierarchical'             => 1,
                    'exclude'                  => '',
                    'include'                  => '',
                    'number'                   => '',
                    'taxonomy'                 => 'category',
                    'pad_counts'               => false 
                );
                
                $cats = get_categories( $args );
                
                ?><select class="widefat" 
                          id="<?php echo esc_attr($this->get_field_id('CatID')); ?>" 
                          name="<?php echo esc_attr($this->get_field_name('CatID')); ?>" >
                <option value="" <?php if('' == $instance['CatID']){echo 'selected=""';} ?>>--All posts--</option>             
                              <?php
                foreach ($cats as $cat){
                    ?><option value="<?php echo esc_attr($cat->term_id); ?>" <?php if($cat->term_id==$instance['CatID']){echo 'selected=""';} ?>><?php echo $cat->name; ?></option><?php
                }
                ?>
                </select>
            </label>
        </p>
        
        <!--   Checkox Show only featured or sticky -->
        
        <?php $p_featured1 = isset( $instance['p_featured1'] ) ? $instance['p_featured1'] : false; ?>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('p_featured1'); ?>" name="<?php echo $this->get_field_name('p_featured1'); ?>" <?php if ($instance['p_featured1']) echo 'checked' ?> />
            <label for="<?php echo $this->get_field_id('p_featured1'); ?>"><?php esc_html_e('Only Show Featured (Sticky) posts', 'ang-plugins'); ?></label>
        </p>
         
       
        <!--     Returns all registered pages-->
            
        <?php $page_link_id = isset( $instance['page_link_id'] ) ? $instance['page_link_id'] : "/"; ?>
        
        <p>
            <label for="<?php echo $this->get_field_id('page_link_id'); ?>">
                <?php esc_html_e('Select page link:', 'ang-plugins'); ?>
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
                    ?><option value="<?php echo esc_attr($page->ID); ?>" <?php if($page->ID==$instance['page_link_id']){echo 'selected=""';} ?>><?php echo $page->post_title; ?></option><?php
                }
                ?>
                </select>
            </label>
        </p>
        
        
        <!--   Button name -->
        
        <?php $but_name = isset( $instance['but_name']) ? esc_attr( $instance['but_name'] ) : "All News"; ?>
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
            <input type="checkbox" id="<?php echo $this->get_field_id('p_page_link'); ?>" name="<?php echo $this->get_field_name('p_page_link'); ?>" <?php if ($instance['p_page_link']) echo 'checked'; ?> />
            <label for="<?php echo $this->get_field_id('p_page_link'); ?>"><?php esc_html_e('Hide page link button', 'ang-plugins'); ?></label>
        </p>
        
          <!--     Number of Items to display -->
        
        <?php $ItemCount = isset( $instance['ItemCount'] ) ? $instance['ItemCount'] : 6; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('ItemCount')); ?>">
                Number of posts:
                <input class="widefat" 
                        id="<?php echo esc_attr($this->get_field_id('ItemCount')); ?>" 
                        name="<?php echo esc_attr($this->get_field_name('ItemCount')); ?>" 
                        type="number"
                        min="-1"
                        value="<?php echo esc_attr($ItemCount); ?>" />
            </label>
        </p>
        
        <!--        Number of words per post -->
        
        <?php $p_number_words1 = isset( $instance[ 'p_number_words1' ] ) ? $instance[ 'p_number_words1' ] : 25; ?>
        <p>
            <label for="<?php echo $this->get_field_id('p_number_words1'); ?>">
                <?php esc_html_e('Words per each post:', 'ang-plugins'); ?>
                <input class="widefat" 
                        id="<?php echo $this->get_field_id('p_number_words1'); ?>" 
                        name="<?php echo $this->get_field_name('p_number_words1'); ?>" 
                        type="number"
                        min="5"
                        value="<?php echo $instance['p_number_words1']; ?>" />
            </label>
        </p>
        
        
        <!--     Select animation type -->
        
        <?php $animation = isset( $instance['animation'] ) ? $instance['animation'] : "fade"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'animation' )); ?>">
                Animation:
            </label> 
            <br>
            <select id="<?php echo esc_attr($this->get_field_id('animation')); ?>" name="<?php echo esc_attr($this->get_field_name('animation')); ?>">
                <option value="fade" <?php echo ($animation=='fade')?'selected':''; ?>>Fade</option>
                <option value="scale" <?php echo ($animation=='scale')?'selected':''; ?>>Scale</option>
                <option value="slide-horizontal" <?php echo ($animation=='slide-horizontal')?'selected':''; ?>>Slide-horizontal</option>
                <option value="slide-vertical" <?php echo ($animation=='slide-vertical')?'selected':''; ?>>Slide-vertical</option>
                <option value="slide-top" <?php echo ($animation=='slide-top')?'selected':''; ?>>Slide-top</option>
                <option value="slide-bottom" <?php echo ($animation=='slide-bottom')?'selected':''; ?>>Slide-bottom</option>
            </select>
        </p>
        
        <!--     Select animation duration -->
        
        <?php $duration = isset( $instance['duration'] ) ? $instance['duration'] : "200"; ?>
        <p>
            <label for="<?php echo esc_attr ($this->get_field_id('duration')); ?>">
                Duration of animation:
                <input class="widefat" 
                        id="<?php echo esc_attr($this->get_field_id('duration')); ?>" 
                        name="<?php echo esc_attr($this->get_field_name('duration')); ?>" 
                        type="text" 
                        value="<?php echo esc_attr($duration); ?>" />
            </label>
        </p>
        
                <!--     Select animation delay -->
                
        <?php $delay = isset( $instance['delay'] ) ? $instance['delay'] : "100"; ?>
        <p>
            <label for="<?php echo esc_attr ($this->get_field_id('delay')); ?>">
                Delay Interval:
                <input class="widefat" 
                        id="<?php echo esc_attr($this->get_field_id('delay')); ?>" 
                        name="<?php echo esc_attr($this->get_field_name('delay')); ?>" 
                        type="text" 
                        value="<?php echo esc_attr($delay); ?>" />
            </label>
        </p>
        
         <!--     Select autoplay Interval -->
         
        <?php $autoplayInterval = isset( $instance['autoplayInterval'] ) ? $instance['autoplayInterval'] : "8000"; ?>
        <p>
            <label for="<?php echo esc_attr ($this->get_field_id('autoplayInterval')); ?>">
                Autoplay Interval:
                <input class="widefat" 
                        id="<?php echo esc_attr($this->get_field_id('autoplayInterval')); ?>" 
                        name="<?php echo esc_attr($this->get_field_name('autoplayInterval')); ?>" 
                        type="text" 
                        value="<?php echo esc_attr($autoplayInterval); ?>" />
            </label>
        </p>
        
        
        <!--   Post Order type -->
        
        <?php $p_order_type = isset( $instance['p_order_type'] ) ? $instance['p_order_type'] : "ASC"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'p_order_type' )); ?>">
                <?php esc_html_e('Posts order type:', 'ang-plugins'); ?>
            </label> 
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('p_order_type')."_ASC"); ?>" name="<?php echo esc_attr($this->get_field_name('p_order_type')); ?>" value="ASC" <?php if($p_order_type=="ASC"){ echo "checked"; }?>>ASC &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('p_order_type')."_DESC"); ?>" name="<?php echo esc_attr($this->get_field_name('p_order_type')); ?>" value="DESC" <?php if($p_order_type=="DESC"){ echo "checked"; }?>>DESC
        </p>
        
        <!--     Check autoplay  -->
        
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
        
        <!--     Check pause on hover  -->
                
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
        
         <!--     Show dot navigation  -->
                
        <?php $slidenav = isset( $instance['slidenav'] ) ? $instance['slidenav'] : "1"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'slidenav' )); ?>">
                Show navigation:
            </label> 
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav')); ?>" value="1" <?php if($slidenav=="1"){ echo "checked"; }?>>Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav')); ?>" value="2" <?php if($slidenav=="2"){ echo "checked"; }?>>No
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
        $instance['CatID'] = $new_instance['CatID'];
        $instance['ItemCount'] = $new_instance['ItemCount'];
        $instance['p_number_words1'] = $new_instance['p_number_words1'];
        $instance['p_order_type'] = $new_instance['p_order_type'];
        $instance['p_featured1'] = $new_instance['p_featured1'];
        $instance['slidenav_btn'] = $new_instance['slidenav_btn'];
        $instance['slidenav'] = $new_instance['slidenav'];
        $instance['animation'] = $new_instance['animation'];
        $instance['duration'] = $new_instance['duration'];
        $instance['delay'] = $new_instance['delay'];
        $instance['autoplayInterval'] = $new_instance['autoplayInterval'];
        $instance['autoplay'] = $new_instance['autoplay'];
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
        
        $p_featured1 = $instance['p_featured1'] ? true : false;
        $p_page_link = $instance['p_page_link'] ? true : false;
        
        // UIkit Slideset configuration
        $slideshow_cfg = array ();
        $slideshow_cfg[] = "animation: '".$instance['animation']."'";
        $slideshow_cfg[] = "duration: ".$instance['duration'];
        $slideshow_cfg[] = "delay: ".$instance['delay'];
        $slideshow_cfg[] = "autoplayInterval: ".$instance['autoplayInterval'];
        if($instance['autoplay']=="1"){$slideshow_cfg[] = "autoplay: true";}else{$slideshow_cfg[] = "autoplay: false";}
        if($instance['pauseOnHover']=="1"){$slideshow_cfg[] = "pauseOnHover: true";}else{$slideshow_cfg[] = "pauseOnHover: false";}
        
       if($instance['CatID'] != ''){
           $cat_typeID = $instance['CatID'];
       }else{
           $cat_typeID = '';
       }
       
       $args = array(
                    'post_type'        => 'post',
                    'posts_per_page'   => $instance['ItemCount'],
                    'offset'           => 0,
                    'cat'              => $cat_typeID,
                    'orderby'          => 'post_date',
                    'order'            => $instance['p_order_type'],
                    'post_status'      => 'publish',
                    'suppress_filters' => true,
                    'ignore_sticky_posts' => 1,
                );
        if ( $p_featured1 == true ) {
            $args['post__in'] = get_option( 'sticky_posts' );
        }
        
    $item = new WP_Query( $args ); ?>
    <div class="ang-postnews-slider">
        <div class="ang-slideset-wrap" 
             data-uk-slideset="{small: 2, medium: 3, large: 3, <?php echo esc_attr(implode(', ', $slideshow_cfg)); ?>}">
            <div class="uk-slidenav-position">

            <?php if($instance['title'] != NULL) : ?>
                <h3 class="uk-panel-title">
                    <span>
                        <?php if($instance['slidenav_btn']=="1") { ?>
                        <a draggable="false" href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideset-item="previous"></a>
                            <?php echo $instance['title']; ?>
                        <a draggable="false" href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideset-item="next"></a>
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

             <?php if ( $item->have_posts() ) { ?>
            <div class="uk-slider-container">
                <ul class="uk-slideset uk-flex-center uk-grid uk-grid-small uk-grid-width-1-1 uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-3" data-uk-grid-match>
                <?php while ( $item->have_posts() ) {
                                $item->the_post(); 
                                    global $post; ?>
                    
               <?php if(has_post_thumbnail($post->ID)){ ?>
                    <li class="<?php if($p_featured1 == true){ echo "featured-post";} ?> post-<?php echo $post->ID ?>">
                        <article class="tm-tab-content">
                            <div class="effect blow-effect">
                                <div class="uk-position-relative">
                                    <?php echo get_the_post_thumbnail ($post->ID, 'featured-slider', array('class' => 'ang-news-thumb')); ?>
                                </div>
                                <a href="<?php echo get_permalink($post->ID); ?>"><div class="overlay overlay-1"></div></a>
                                <div class="epl-stickers-wrapper">
                                    <span class="uk-float-left">
                                        <span class="status-sticker current">
                                            <time datetime="<?php echo get_the_date('j M, y');?>"><?php echo get_the_date('j M, y');?></time>
                                        </span>
                                    </span>
                                </div>
                                <h5 class="uk-panel-title uk-position-absolute uk-margin-remove"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></h5>
                            </div>
                            <div class="uk-width-1-1 tm-slider-post">
                                <div class="tm-slider-post-excerpt">

                                <?php if ( $post->post_excerpt != '' ){
                                    echo '<p class="uk-margin-remove">'. wp_trim_words($post->post_excerpt, $instance['p_number_words1'], '').'</p>';
                                    } else {
                                    echo '<p class="uk-margin-remove">'. wp_trim_words($post->post_content, $instance['p_number_words1'], '') .'</p>';
                                    } 
                                ?>

                                </div>
                                <div class="ang-arhive-links uk-clearfix">
                                <a class="author-title " href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>"><i class="uk-icon-user"></i> <?php the_author() ;?></a>
                                    <?php if(comments_open() || get_comments_number()) : ?>
                                <?php comments_popup_link(esc_html__('<i class="uk-icon-comment"></i>0', 'ang-plugins'), esc_html__('<i class="uk-icon-comment"></i>1', 'ang-plugins'), esc_html__('<i class="uk-icon-comment"></i>%', 'ang-plugins'), "", ""); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    </li>
                    <?php } ?>
                <?php } ?>
                </ul>
            </div>
         <?php  } ?>
        </div>
        <?php if($instance['slidenav']=="1") { ?>
            <ul class="uk-slideset-nav uk-dotnav uk-dotnav-contrast uk-flex-center uk-margin-large-top"></ul>
        <?php } ?>
    </div>
    <?php if($p_page_link != true) { ?>
    <div class="ang-slider-but-wrap">
        <a class="uk-button uk-button-primary ang-but-more" href="<?php echo get_page_link( $instance['page_link_id'] ); ?>" data-uk-scrollspy="{cls:'uk-animation-fade', repeat: false, delay:800}"><?php echo $instance['but_name']; ?></a>
    </div>
    <?php } ?>
</div>
        <?php
    wp_reset_query(); 

    echo $after_widget;
    }
    
}

add_action('widgets_init', create_function('', 'return register_widget("ANGPostsSlideset");')); ?>