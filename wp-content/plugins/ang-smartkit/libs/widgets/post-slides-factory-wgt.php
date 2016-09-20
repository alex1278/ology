<?php
/*
 * Plugin Name: ANG WooCommerce Slider Pack
 * Description: WooCommerce Products Slider pack widget with customizable settings and various templates.
 * Plugin URL: http://karate.do-i-posle.dzu/
 * Author: Aleksandr Glovatskyy
 * Author URI: http://karate.do-i-posle.dzu/
 * Date: 10.06.2016
 * Version: 1.0.0
 * @package     WooCommerce / iBloga
 * @subpackage  Widget/Blog
 * @copyright   Copyright (c) 2016, Aleksandr Glovatskyy
 * @since       1.0.0
 */

class ANGPostSliderPack extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'ANG-Post-Slider-Pack', // Base ID
            __('ANG Post Slider Pack', 'ang-plugins'), // Name
            array( 'description' => __( 'Post Slider pack widget with customizable settings and various templates.', 'ang-plugins' ), ) // Args
        );
    }
    
    function form($instance) { ?>

        <!--        Title input-->

        <?php $title = isset( $instance['title']) ? esc_attr( $instance['title'] ) : "Latest posts"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php esc_html_e('Title:', 'ang-plugins');?>
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
                <?php esc_html_e('Description: ', 'ang-plugins');?>
                <textarea class="widefat" rows="3" cols="10" 
                        id="<?php echo $this->get_field_id('descr'); ?>" 
                        name="<?php echo $this->get_field_name('descr'); ?>"><?php echo $descr; ?></textarea>
            </label>
        </p>
        
<!--   ADD Extra class -->
        
        <?php $ex_class = isset( $instance[ 'ex_class' ] ) ? $instance[ 'ex_class' ] : ''; ?>
        <p>
            <label for="<?php echo $this->get_field_id('ex_class'); ?>">
                <?php esc_html_e('Extra class:', 'ang-plugins');?>
                <input  class="widefat"
                        id="<?php echo $this->get_field_id('ex_class'); ?>" 
                        name="<?php echo $this->get_field_name('ex_class'); ?>" 
                        type="text" 
                        value="<?php echo $ex_class; ?>" />
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
                    <option value="" <?php if('' == $CatID){echo 'selected=""';} ?>><?php esc_html_e('-- All Posts --', 'ang-plugins'); ?></option>             
                              <?php
                foreach ($cats as $cat){
                    ?><option value="<?php echo esc_attr($cat->term_id); ?>" <?php if($cat->term_id==$CatID){echo 'selected=""';} ?>><?php echo $cat->name; ?></option><?php
                }
                ?>
                </select>
            </label>
        </p>
        
        <!--        Select image size-->
        <?php $image_size = isset( $instance[ 'image_size' ] ) ? $instance[ 'image_size' ] : ''; ?>
        
        <p>
            <label for="<?php echo $this->get_field_id('image_size'); ?>">Image Size: </label>
            <select class="widefat" id="<?php echo $this->get_field_id('image_size'); ?>" name="<?php echo $this->get_field_name('image_size'); ?>">
                <option class="widefat" value="" <?php if('' == $image_size){echo 'selected="selected"';} ?>><?php esc_html_e('--Default (100 X 100)--', 'ang-plugins'); ?></option>
                <?php
                    $sizes = $this->ang_get_thumbnail_sizes();
                    foreach ($sizes as $k => $v) {
                            $v = implode(" x ", $v);
                            echo '<option class="widefat" value="' . $k . '" id="' . $k . '"', $image_size == $k ? ' selected="selected"' : '', '>', __($k, 'epl') . ' (' . __($v, 'epl') . ' )', '</option>';
                    }
                ?>
            </select>
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
                foreach ($pages as $page){ ?>
                    <option value="<?php echo esc_attr($page->ID); ?>" <?php if($page->ID==$page_link_id){echo 'selected=""';} ?>><?php echo $page->post_title; ?></option>
                <?php } ?>
                </select>
            </label>
        </p>
        
        
        <!--   Button name -->
        
        <?php $but_name = isset( $instance['but_name']) ? esc_attr( $instance['but_name'] ) : "All News"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('but_name')); ?>">
                <?php esc_html_e('Button label: ', 'ang-plugins'); ?>
                <input class="" 
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
            <label for="<?php echo $this->get_field_id('p_page_link'); ?>"><?php esc_html_e('Hide page link button', 'ang-plugins'); ?></label>
        </p>
        
        
          <!--     Number of Items to display -->
        
        <?php $ItemCount = isset( $instance['ItemCount'] ) ? $instance['ItemCount'] : 6; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('ItemCount')); ?>">
                <?php esc_html_e('Number of posts:', 'ang-plugins'); ?>
                <input class="" 
                        id="<?php echo esc_attr($this->get_field_id('ItemCount')); ?>" 
                        name="<?php echo esc_attr($this->get_field_name('ItemCount')); ?>" 
                        type="number"
                        min="-1"
                        value="<?php echo esc_attr($ItemCount); ?>" />
            </label>
        </p>
        
        <!--        Number of words per post -->
        
        <?php $p_number_words1 = isset( $instance[ 'p_number_words1' ] ) ? $instance[ 'p_number_words1' ] : 15; ?>
        <p>
            <label for="<?php echo $this->get_field_id('p_number_words1'); ?>">
                <?php esc_html_e('Words per each post:', 'ang-plugins'); ?>
                <input class="" 
                        id="<?php echo $this->get_field_id('p_number_words1'); ?>" 
                        name="<?php echo $this->get_field_name('p_number_words1'); ?>" 
                        type="number"
                        min="0"
                        max="50"
                        value="<?php echo esc_attr($p_number_words1); ?>" />
            </label>
        </p>
        
        
        <!--     Select animation type -->
        
        <?php $animation = isset( $instance['animation'] ) ? $instance['animation'] : "fade"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'animation' )); ?>">
                <?php esc_html_e('Animation (Slideset only):', 'ang-plugins'); ?>
            </label> 
            <br>
            <select id="<?php echo esc_attr($this->get_field_id('animation')); ?>" name="<?php echo esc_attr($this->get_field_name('animation')); ?>">
                <option value="fade" <?php echo ($animation=='fade')?'selected':''; ?>><?php esc_html_e('Fade', 'ang-plugins'); ?></option>
                <option value="scale" <?php echo ($animation=='scale')?'selected':''; ?>><?php esc_html_e('Scale', 'ang-plugins'); ?></option>
                <option value="slide-horizontal" <?php echo ($animation=='slide-horizontal')?'selected':''; ?>><?php esc_html_e('Slide-horizontal', 'ang-plugins'); ?></option>
                <option value="slide-vertical" <?php echo ($animation=='slide-vertical')?'selected':''; ?>><?php esc_html_e('Slide-vertical', 'ang-plugins'); ?></option>
                <option value="slide-top" <?php echo ($animation=='slide-top')?'selected':''; ?>><?php esc_html_e('Slide-top', 'ang-plugins'); ?></option>
                <option value="slide-bottom" <?php echo ($animation=='slide-bottom')?'selected':''; ?>><?php esc_html_e('Slide-bottom', 'ang-plugins'); ?></option>
            </select>
        </p>
        
<!--     Select animation duration -->
        
        <?php $duration = isset( $instance['duration'] ) ? $instance['duration'] : "200"; ?>
        <p>
            <label for="<?php echo esc_attr ($this->get_field_id('duration')); ?>">
                <?php esc_html_e('Animation Duration (Slideset):', 'ang-plugins'); ?>
                <input class="" 
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
                <?php esc_html_e('Animation Delay (Slideset):', 'ang-plugins'); ?>
                <input class="" 
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
                <?php esc_html_e('Autoplay Interval:', 'ang-plugins'); ?>
                <input class="" 
                        id="<?php echo esc_attr($this->get_field_id('autoplayInterval')); ?>" 
                        name="<?php echo esc_attr($this->get_field_name('autoplayInterval')); ?>" 
                        type="text" 
                        value="<?php echo esc_attr($autoplayInterval); ?>" />
            </label>
        </p>
            
<!--        Select view type, template  -->
         
        <?php
            // define plugin pathes
            $plugin_dir = plugin_dir_path( __FILE__ ); //plagin path
            $temp_dir_path = $plugin_dir.'post-slides-templates/'; // path to templates folder
            $templates = array();

            // Open existing dir and scan it.
            if (is_dir($temp_dir_path)) {
                if ($dh = opendir($temp_dir_path)) {
                    while (($file = readdir($dh)) !== false) {
                        if ($file != "." && $file != "..") {
                            $templates[] = $file;
                        }
                    }
                    closedir($dh);
                }
            }
            sort($templates);
       ?>
        
        <?php $view_template = isset( $instance[ 'view_template' ] ) ? $instance[ 'view_template' ] : 'default.php' ; ?>
        <p>
            <label for="<?php echo $this->get_field_id('view_template'); ?>">
                <?php esc_html_e('View Type:', 'ang-plugins'); ?>
                <select id="<?php echo $this->get_field_id('view_template'); ?>" 
                        name="<?php echo $this->get_field_name('view_template'); ?>">
                <?php
                    foreach ($templates as $key => $template){ ?>
                        <option value="<?php echo esc_attr($template); ?>" <?php if($template == $view_template){echo 'selected=""';} ?>>
                            <?php 
                                $p_tag = strrpos($template, '.');
                                if ($p_tag > 0) {
                                    echo ucfirst(str_replace('-', ' ', substr($template, 0, $p_tag)));
                                }else{ 
                                    echo ucfirst(str_replace('-', ' ', $template)); 
                                }
                           ?>
                        </option>
                <?php } ?>
                </select>
            </label>
        </p>
        
<!--        Check Slider or Slideset-->

        <?php $slide_mode = isset( $instance['slide_mode'] ) ? $instance['slide_mode'] : "1"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'slide_mode' )); ?>">
                <?php esc_html_e('Slide mode:', 'ang-plugins'); ?>
            </label>
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slide_mode')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('slide_mode')); ?>" value="1" <?php if($slide_mode=="1"){ echo "checked"; }?>><?php esc_html_e('Slideset', 'ang-plugins'); ?>
            &nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slide_mode')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('slide_mode')); ?>" value="2" <?php if($slide_mode=="2"){ echo "checked"; }?>><?php esc_html_e('Slider', 'ang-plugins'); ?>
        </p>
        
<!--   Post Order type -->
        
        <?php $p_order_type = isset( $instance['p_order_type'] ) ? $instance['p_order_type'] : "DESC"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'p_order_type' )); ?>">
                <?php esc_html_e('Posts order type:', 'ang-plugins'); ?>
            </label> 
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('p_order_type')."_ASC"); ?>" name="<?php echo esc_attr($this->get_field_name('p_order_type')); ?>" value="ASC" <?php if($p_order_type=="ASC"){ echo "checked"; }?>><?php esc_html_e('ASC', 'ang-plugins'); ?>
            &nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('p_order_type')."_DESC"); ?>" name="<?php echo esc_attr($this->get_field_name('p_order_type')); ?>" value="DESC" <?php if($p_order_type=="DESC"){ echo "checked"; }?>><?php esc_html_e('DESC', 'ang-plugins'); ?>
        </p>
        
        <!--     Check autoplay  -->
        
        <?php $autoplay = isset( $instance['autoplay'] ) ? $instance['autoplay'] : "1"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'autoplay' )); ?>">
                <?php esc_html_e('Autoplay:', 'ang-plugins'); ?>
            </label>
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('autoplay')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('autoplay')); ?>" value="1" <?php if($autoplay=="1"){ echo "checked"; }?>><?php esc_html_e('Yes', 'ang-plugins'); ?> 
            &nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('autoplay')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('autoplay')); ?>" value="2" <?php if($autoplay=="2"){ echo "checked"; }?>><?php esc_html_e('No', 'ang-plugins'); ?> 
        </p>
        
        <!--     Check pause on hover  -->
                
        <?php $pauseOnHover = isset( $instance['pauseOnHover'] ) ? $instance['pauseOnHover'] : "1"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'pauseOnHover' )); ?>">
                <?php esc_html_e('Pause on Hover:', 'ang-plugins'); ?>
            </label>
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('pauseOnHover')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('pauseOnHover')); ?>" value="1" <?php if($pauseOnHover=="1"){ echo "checked"; }?>><?php esc_html_e('Yes', 'ang-plugins'); ?> 
            &nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('pauseOnHover')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('pauseOnHover')); ?>" value="2" <?php if($pauseOnHover=="2"){ echo "checked"; }?>><?php esc_html_e('No', 'ang-plugins'); ?> 
        </p>
        
        <!--        Slideshow next and prev navigation -->
          
        <?php $slidenav_btn = isset( $instance['slidenav_btn'] ) ? $instance['slidenav_btn'] : "1"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'slidenav_btn' )); ?>">
                <?php esc_html_e('Show next and previous buttons:', 'ang-plugins'); ?>
            </label> 
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav_btn')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav_btn')); ?>" value="1" <?php if($slidenav_btn=="1"){ echo "checked"; }?>><?php esc_html_e('Yes', 'ang-plugins'); ?>
            &nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav_btn')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav_btn')); ?>" value="2" <?php if($slidenav_btn=="2"){ echo "checked"; }?>><?php esc_html_e('No', 'ang-plugins'); ?> 
        </p>
        
<!--     Show dot navigation  -->
    <!--Slideset only-->            
        <?php $slidenav = isset( $instance['slidenav'] ) ? $instance['slidenav'] : "1"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'slidenav' )); ?>">
                <?php esc_html_e('Show dot navigation (Slideset only):', 'ang-plugins'); ?>
            </label> 
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav')); ?>" value="1" <?php if($slidenav=="1"){ echo "checked"; }?>><?php esc_html_e('Yes', 'ang-plugins'); ?> 
            &nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav')); ?>" value="2" <?php if($slidenav=="2"){ echo "checked"; }?>><?php esc_html_e('No', 'ang-plugins'); ?> 
        </p>
        
<!--        infinite scroll true or false-->
    <!--Slider only-->
        <?php $infinite = isset( $instance['infinite'] ) ? $instance['infinite'] : "1"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'infinite' )); ?>">
                <?php esc_html_e('Infinite scroll (Slider only):', 'ang-plugins'); ?>
            </label>
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('infinite')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('infinite')); ?>" value="1" <?php if($infinite=="1"){ echo "checked"; }?>><?php esc_html_e('Yes', 'ang-plugins'); ?>
            &nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('infinite')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('infinite')); ?>" value="2" <?php if($infinite=="2"){ echo "checked"; }?>><?php esc_html_e('No', 'ang-plugins'); ?> 
        </p>
        
<!--        Center slider-->
    <!--Slider only-->
        <?php $centerSlider = isset( $instance['centerSlider'] ) ? $instance['centerSlider'] : "2"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'centerSlider' )); ?>">
                <?php esc_html_e('Center Slider (Slider only):', 'ang-plugins'); ?>
            </label>
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('centerSlider')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('centerSlider')); ?>" value="1" <?php if($centerSlider=="1"){ echo "checked"; }?>><?php esc_html_e('Yes', 'ang-plugins'); ?>
            &nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('centerSlider')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('centerSlider')); ?>" value="2" <?php if($centerSlider=="2"){ echo "checked"; }?>><?php esc_html_e('No', 'ang-plugins'); ?> 
        </p>
        
<!--        Fullscreen slider-->
    <!--Slider only-->
        <?php $slider_fullscreen = isset( $instance['slider_fullscreen'] ) ? $instance['slider_fullscreen'] : "2"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'slider_fullscreen' )); ?>">
                <?php esc_html_e('Fullscreen Slider (Slider only):', 'ang-plugins'); ?>
            </label>
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slider_fullscreen')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('slider_fullscreen')); ?>" value="1" <?php if($slider_fullscreen=="1"){ echo "checked"; }?>><?php esc_html_e('Yes', 'ang-plugins'); ?>
            &nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slider_fullscreen')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('slider_fullscreen')); ?>" value="2" <?php if($slider_fullscreen=="2"){ echo "checked"; }?>><?php esc_html_e('No', 'ang-plugins'); ?>
        </p>
        
<!--   Checkox Show the post excerpt -->
         
         <?php $p_excpt = isset( $instance['p_excpt'] ) ? $instance['p_excpt'] : false; ?>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('p_excpt'); ?>" name="<?php echo $this->get_field_name('p_excpt'); ?>" <?php if ($p_excpt) echo 'checked'; ?> />
            <label for="<?php echo $this->get_field_id('p_excpt'); ?>"><?php esc_html_e('Show the post excerpt', 'ang-plugins'); ?></label>
        </p>
        
<!--   Checkox Show only featured or sticky -->
        
        <?php $p_featured1 = isset( $instance['p_featured1'] ) ? $instance['p_featured1'] : false; ?>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('p_featured1'); ?>" name="<?php echo $this->get_field_name('p_featured1'); ?>" <?php if ($p_featured1) echo 'checked' ?> />
            <label for="<?php echo $this->get_field_id('p_featured1'); ?>"><?php esc_html_e('Only Show Featured posts', 'ang-plugins'); ?></label>
        </p>
        
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['descr'] = $new_instance['descr'];
        
        $instance['ex_class'] = $new_instance['ex_class'];
        $instance['view_template'] = $new_instance['view_template'];
        
        $instance['CatID'] = $new_instance['CatID'];
        $instance['page_link_id'] = $new_instance['page_link_id'];
        $instance['p_page_link'] = $new_instance['p_page_link'];
        $instance['image_size'] = $new_instance['image_size'];
        $instance['but_name'] = $new_instance['but_name'];
        $instance['ItemCount'] = $new_instance['ItemCount'];
        $instance['p_excpt'] = $new_instance['p_excpt'];
        $instance['p_number_words1'] = $new_instance['p_number_words1'];
        $instance['p_order_type'] = $new_instance['p_order_type'];
        $instance['p_featured1'] = $new_instance['p_featured1'];
        $instance['slidenav_btn'] = $new_instance['slidenav_btn'];
        $instance['slidenav'] = $new_instance['slidenav'];
        $instance['infinite'] = $new_instance['infinite'];
        $instance['centerSlider'] = $new_instance['centerSlider'];
        $instance['slider_fullscreen'] = $new_instance['slider_fullscreen'];
        $instance['slide_mode'] = $new_instance['slide_mode'];
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
        
        $p_excpt = $instance['p_excpt'] ? true : false;
        $p_featured1 = $instance['p_featured1'] ? true : false;
        $p_page_link = $instance['p_page_link'] ? true : false;
        
        $image_size = $instance['image_size'] ? $instance['image_size'] : array(100, 100);
        
        // UIkit Slideset configuration
        $slideset_cfg = array ();
        $slideset_cfg[] = "animation: '".$instance['animation']."'";
        $slideset_cfg[] = "duration: ".$instance['duration'];
        $slideset_cfg[] = "delay: ".$instance['delay'];
        $slideset_cfg[] = "autoplayInterval: ".$instance['autoplayInterval'];
        if($instance['autoplay']=="1"){$slideset_cfg[] = "autoplay: true";}else{$slideset_cfg[] = "autoplay: false";}
        if($instance['pauseOnHover']=="1"){$slideset_cfg[] = "pauseOnHover: true";}else{$slideset_cfg[] = "pauseOnHover: false";}
        
        // Uikit Slider configuration
        $slider_cfg = array ();
        $slider_cfg[] = "autoplayInterval: ".$instance['autoplayInterval'];
        if($instance['autoplay']=="1"){$slider_cfg[] = "autoplay: true";}else{$slider_cfg[] = "autoplay: false";}
        if($instance['pauseOnHover']=="1"){$slider_cfg[] = "pauseOnHover: true";}else{$slider_cfg[] = "pauseOnHover: false";}
        if($instance['infinite']=="1"){$slider_cfg[] = "infinite: true";}else{$slider_cfg[] = "infinite: false";}
        if($instance['centerSlider']=="1"){$slider_cfg[] = "center: true";}else{$slider_cfg[] = "center: false";}
        
        $args = array(
            'post_type'        => 'post',
            'posts_per_page'   => $instance['ItemCount'],
            'offset'           => 0,
            'orderby'          => 'post_date',
            'order'            => $instance['p_order_type'],
            'post_status'      => 'publish',
            'suppress_filters' => true,
        );
        
        /*
         * Check Post category
         */
         if($instance['CatID'] != ''){
            $args['cat'] = $instance['CatID'];
        }
        
        if ( $p_featured1 == true ) {
                $args['post__in'] = get_option( 'sticky_posts' );
        }
        
        $item = new WP_Query( $args );?>
        
       <?php
    // define plugin template path
        $plugin_dir = plugin_dir_path( __FILE__ ); //plagin path

        // code here template
        include $plugin_dir.'post-slides-templates/'.$instance['view_template']; // path to templates

    echo $after_widget;
    }
    
    function ang_get_thumbnail_sizes() {
            global $_wp_additional_image_sizes;
            $sizes = array();
            foreach( get_intermediate_image_sizes() as $s ) {
                    $sizes[ $s ] = array( 0, 0 );
                    if( in_array( $s, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
                            $sizes[ $s ][0] = get_option( $s . '_size_w' );
                            $sizes[ $s ][1] = get_option( $s . '_size_h' );
                            $sizes[ $s ]['crop'] = get_option( $s . '_crop' ) ? 'crop' : 'no-crop';
                    } else {
                            if( isset( $_wp_additional_image_sizes ) && isset( $_wp_additional_image_sizes[ $s ] ) ) {
                                    $sizes[ $s ] = array( $_wp_additional_image_sizes[ $s ]['width'], $_wp_additional_image_sizes[ $s ]['height'], );
                            }
                    }
            }
            return $sizes;
    }
}


/*********** 
******* apply style dir
*****/
function load_ang_post_slides_css() {
    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_style('css-ang-slides-factory', $plugin_url . 'woo-product-slides-css/woo-product-slides.css' );
}
add_action('wp_enqueue_scripts', 'load_ang_post_slides_css' );

    add_action('widgets_init', create_function('', 'return register_widget("ANGPostSliderPack");'));
?>