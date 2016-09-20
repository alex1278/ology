<?php
/*
 * Plugin Name: ANG Property Slider
 * Description: Widget, displays property in slider style.
 * Plugin URL: http://karate.do-i-posle.dzu/
 * Author: Aleksandr Glovatskyy
 * Author URI: http://karate.do-i-posle.dzu/
 * Date: 24.11.2015
 * Version: 1.0.0
 * License: GPL2+
 * @package     ESTA
 * @subpackage  Widget/Property
 * @copyright   Copyright (c) 2016, Aleksandr Glovatskyy
 * @since       1.1.1
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class ANGPropertySlider extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'ANG-Property-Slider', // Base ID
            esc_html__('ANG Property Slider', 'ang-plugins'), // Name
            array( 'description' => esc_html__( 'Widget, displays property in slider style.', 'ang-plugins' ), ) // Args
        );
    }

    function form($instance) { ?>

        <?php $title = isset( $instance['title']) ? esc_attr( $instance['title'] ) : "Featured"; ?>
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
        
<!--        Widget description-->

        <?php $descr = isset( $instance['descr']) ? esc_attr( $instance['descr'] ) : ""; ?>
        <p>
            <label for="<?php echo $this->get_field_id('descr'); ?>">
                Description: 
                <textarea class="widefat" rows="3" cols="10" 
                        id="<?php echo $this->get_field_id('descr'); ?>" 
                        name="<?php echo $this->get_field_name('descr'); ?>"><?php echo $descr; ?></textarea>
            </label>
        </p>
        
        
       <!--     Returns all EPL active post types-->
            
    <?php $p_post_type = isset( $instance['p_post_type'] ) ? $instance['p_post_type'] : array('property'); ?>
        <p>
            <label for="<?php echo $this->get_field_id('p_post_type'); ?>">
                <?php esc_html_e('Listing type, hold CTRL to select multiple:', 'ang-plugins'); ?>
                    <select multiple="multiple" size="4" class="widefat" 
                          id="<?php echo esc_attr($this->get_field_id('p_post_type')); ?>" 
                          name="<?php echo esc_attr($this->get_field_name('p_post_type')); ?>[]" >
           <?php if(function_exists('epl_get_active_post_types')){
                $supported_post_types = epl_get_active_post_types();
                    }
                if(!empty($supported_post_types)) {
                    foreach ($supported_post_types as $k=>$post_type){
                        $selected = '';
                        if(in_array($k,$p_post_type)) {
                                    $selected = 'selected="selected"';
                            }
                        echo '<option value="'.$k.'" '.$selected.'>'.esc_html__($post_type, 'ang-plugins').'</option>';
                    }
                } ?>
                </select>
            </label>
        </p>
        
<!--        Select property status-->

        <?php $property_status = isset( $instance['property_status'] ) ? $instance['property_status'] : 'Any'; ?>
       <p>
            <label for="<?php echo $this->get_field_id('property_status'); ?>"><?php esc_html_e('Status:', 'ang-plugins'); ?></label> 
            <select class="widefat" id="<?php echo $this->get_field_id('property_status'); ?>" name="<?php echo $this->get_field_name('property_status'); ?>">
                <?php
                    $status_list = array(
                            ''		=>	esc_html__('Any' , 'ang-plugins'),
                            'current'	=>	esc_html__('Current' , 'ang-plugins'),
                            'sold'      =>	apply_filters( 'epl_sold_label_status_filter' , esc_html__('Sold', 'ang-plugins') ),
                            'leased'	=>	apply_filters( 'epl_leased_label_status_filter' , esc_html__('Leased', 'ang-plugins') )
                    );

                    foreach($status_list as $k=>$v) {
                            $selected = '';
                            if(isset($property_status) && $k == $property_status) {
                                    $selected = 'selected="selected"';
                            }
                            echo '<option value="'.$k.'" '.$selected.'>'.esc_html__($v, 'ang-plugins').'</option>';
                    }
                ?>
            </select>
        </p>
                
        <!--   Checkox Show only featured or sticky -->
        
        <?php $p_featured1 = isset( $instance['p_featured1'] ) ? $instance['p_featured1'] : false; ?>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('p_featured1'); ?>" name="<?php echo $this->get_field_name('p_featured1'); ?>" <?php if ($instance['p_featured1']) echo 'checked' ?> />
            <label for="<?php echo $this->get_field_id('p_featured1'); ?>"><?php esc_html_e('Only Show Featured or Sticky', 'ang-plugins'); ?></label>
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
        
        
        <!--   Button label -->
        
        <?php $but_name = isset( $instance['but_name']) ? esc_attr( $instance['but_name'] ) : "All Listings"; ?>
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
        
        <!--        Autoplay interval-->
        
        <?php $autoplayInterval = isset( $instance['autoplayInterval'] ) ? $instance['autoplayInterval'] : "9000"; ?>
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
        
        <!--        Check autoplay-->
        
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

        $instance['p_post_type'] = $new_instance['p_post_type'];
        $instance['property_status'] = $new_instance['property_status'];
        $instance['page_link_id'] = $new_instance['page_link_id'];
        $instance['p_page_link'] = $new_instance['p_page_link'];
        $instance['but_name'] = $new_instance['but_name'];
        $instance['p_order_type'] = $new_instance['p_order_type'];
        $instance['ItemCount'] = $new_instance['ItemCount'];
        $instance['p_featured1'] = $new_instance['p_featured1'];
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
        
        $p_featured1 = $instance['p_featured1'] ? true : false;
        $p_page_link = $instance['p_page_link'] ? true : false;
        
        // UIkit Slideset configuration
        $slideshow_cfg = array ();
        
        $slideshow_cfg[] = "autoplayInterval: ".$instance['autoplayInterval'];
        if($instance['autoplay']=="1"){$slideshow_cfg[] = "autoplay: true";}else{$slideshow_cfg[] = "autoplay: false";}
        if($instance['infinite']=="1"){$slideshow_cfg[] = "infinite: true";}else{$slideshow_cfg[] = "infinite: false";}
        if($instance['pauseOnHover']=="1"){$slideshow_cfg[] = "pauseOnHover: true";}else{$slideshow_cfg[] = "pauseOnHover: false";}
        
        
        $epl_posts = array('property', 'land', 'commercial', 'business', 'commercial_land', 'rental', 'rural');
        
        $args = array(
            'post_type'        => $instance['p_post_type'],
            'posts_per_page'   => $instance['ItemCount'],
            'offset'           => 0,
            'orderby'          => 'post_date',
            'order'            => $instance['p_order_type'],
            'post_status'      => 'publish',
            'suppress_filters' => true,
        );
        
        if ( $p_featured1 == true ) {
           $args['meta_query'][]  = array(
                    'key' 	=> 'property_featured',
                    'value'	=> 'yes'
                );
       }
       
       if(isset($instance['property_status']) && !empty($instance['property_status'])) {
                $args['meta_query'][] = array(
                        'key'		=>	'property_status',
                        'value'		=>	$instance['property_status'],
                        'compare'	=>	'='
                );
        }
        
        
    $item = new WP_Query( $args ); ?>
    <div class="ang-property-slider">
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

         <?php if ( $item->have_posts() ) { ?>
        <div class="uk-slider-container">
            <ul class="uk-slider uk-grid uk-grid-medium uk-grid-width-1-1 uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-3 ">
            <?php while ( $item->have_posts() ) {
                            $item->the_post(); 
                                global $post; ?>
                <li id="post-<?php the_ID(); ?> <?php if($p_featured1 == true){ echo "featured-post";} ?>  <?php echo 'post_type-'.$post->post_type; ?> <?php if( !empty($instance['property_status'])) echo 'property-status-'.$instance['property_status']; ?>" class="epl-listing-post">				
                    <div class="ang-property-blog-cover epl-property-blog">
                        <div class="property-box property-box-left property-featured-image-wrapper">
                            <?php do_action('epl_property_archive_featured_image'); ?>
                            <h3 class="entry-title"><a href="<?php the_permalink() ?>"><?php do_action('epl_property_heading'); ?></a></h3>
                        </div>
                        <div class="property-box property-box-right property-content">
                            <!-- Property Featured Icons -->
                            <div class="property-feature-icons">
                                <?php do_action('epl_property_icons'); ?>
                            </div>
                            <!-- Address -->
                            <div class="property-address">
                                <a href="<?php the_permalink(); ?>">
                                        <?php do_action('epl_property_address'); ?>
                                </a>
                            </div>
                        </div>	
                    </div>
                </li>
            <?php } ?>
            </ul>
        </div>
     <?php  } ?>
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

add_action('widgets_init', create_function('', 'return register_widget("ANGPropertySlider");')); ?>