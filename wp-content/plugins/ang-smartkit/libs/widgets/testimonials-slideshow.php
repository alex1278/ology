<?php
/*
  Plugin Name: ANG Testimonials Slideshow
  Plugin URI: http://karate.do-i-posle.dzu/
  Description: Displays testimonials post type in Slideshow
  Author: Aleksandr Glovatskyy
  Version: 1.1.0
  Date: 04.03.2016
  Author e-mail: alex1278@list.ru
  Author URI: http://karate.do-i-posle.dzu/
 */

class ANGTestimonialsSlides extends WP_Widget {
    
    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'ANG-Testimonials-Slides', // Base ID
            __('ANG Testimonials Slides', 'ang-plugins'), // Name
            array( 'description' => __( 'Displays testimonials posts in Slideshow style', 'ang-plugins' ), ) // Args
        );
    }
    
    function form($instance) { ?>

<!--        Title input-->

        <?php $title = isset( $instance['title']) ? esc_attr( $instance['title'] ) : "Testimonials"; ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php esc_html_e('Title:', 'ang-plugins');?>
                <input class="widefat" 
                        id="<?php echo $this->get_field_id('title'); ?>" 
                        name="<?php echo $this->get_field_name('title'); ?>" 
                        type="text" 
                        value="<?php echo $title; ?>" />
            </label>
        </p>
        
        <!--        Description input-->
        
        <?php $descr = isset( $instance['descr']) ?  $instance['descr'] : ''; ?>
        <p>
            <label for="<?php echo $this->get_field_id('descr'); ?>">
                <?php esc_html_e('Description: ', 'ang-plugins');?>
                <textarea class="widefat" rows="5" cols="10" 
                        id="<?php echo $this->get_field_id('descr'); ?>" 
                        name="<?php echo $this->get_field_name('descr'); ?>"><?php echo $descr; ?></textarea>
            </label>
        </p>
        
       <!--     Returns all registered post types-->
            
    <?php $p_post_type = isset( $instance[ 'p_post_type' ] ) ? $instance[ 'p_post_type' ] : 'testimonial'; ?>
        <p>
            <label for="<?php echo $this->get_field_id('p_post_type'); ?>">
                <?php esc_html_e('Select post type:', 'ang-plugins'); ?>
                    <?php
                    $args = array(
                                'public'   => true,
                                //'_builtin' => true,
                                //'publicly_queryable' => false,
                              );
                $post_types = get_post_types($args,'names'); 
                
                ?><select class="widefat" 
                          id="<?php echo esc_attr($this->get_field_id('p_post_type')); ?>" 
                          name="<?php echo esc_attr($this->get_field_name('p_post_type')); ?>" >
                    
                      <option value="testimonial" <?php if('testimonial'==$p_post_type){echo 'selected=""';} ?>><?php esc_html_e('testimonial', 'ang-plugins');?></option>
          <?php
                foreach ($post_types as $post_type){ ?>
                      <option value="<?php echo esc_attr($post_type); ?>" <?php if($post_type==$p_post_type){echo 'selected=""';} ?>><?php echo $post_type; ?></option>
              <?php } ?>
                </select>
            </label>
        </p>
        
        <!--             Returns  Testimonials taxonomy -->
        
        <?php $TaxEvent = isset( $instance['TaxEvent'] ) ? $instance['TaxEvent'] : ''; ?>
        
        <?php
                $args = array(
                    'type'                     => 'testimonial',
                    'child_of'                 => 0,
                    'parent'                   => '',
                    'orderby'                  => 'name',
                    'order'                    => 'ASC',
                    'hide_empty'               => 1,
                    'hierarchical'             => 1,
                    'exclude'                  => '',
                    'include'                  => '',
                    'number'                   => '',
                    'taxonomy'                 => 'testimonial-category',
                    'pad_counts'               => false 
                );
                
        $tax_events = get_categories( $args );
            if( $tax_events ){
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('TaxEvent'); ?>">
                <?php esc_html_e('Testimonials category :', 'ang-plugins'); ?>
                    <select class="widefat" 
                          id="<?php echo esc_attr($this->get_field_id('TaxEvent')); ?>" 
                          name="<?php echo esc_attr($this->get_field_name('TaxEvent')); ?>" >
                      <option value="" <?php if('' == $TaxEvent){echo 'selected=""';} ?>><?php esc_html_e('--All Testimonials--', 'ang-plugins'); ?></option> <?php
                foreach ($tax_events as $tax_event){
                    ?><option value="<?php echo esc_attr($tax_event->term_id); ?>" <?php if($tax_event->term_id==$TaxEvent){echo 'selected=""';} ?>><?php echo $tax_event->name; ?></option><?php
                }
                ?>
                </select>
            </label>
        </p>
        <?php } ?>
        
        <!--        Selecting category id-->
        <?php $CatID = isset( $instance['CatID'] ) ? $instance['CatID'] : ''; ?>
         <p>
            <label for="<?php echo $this->get_field_id('CatID'); ?>">
                <?php esc_html_e('Post Category (only post type):', 'ang-plugins');?>
                <?php
  
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
                          name="<?php echo esc_attr($this->get_field_name('CatID')); ?>" ><?php
                foreach ($cats as $cat){
                    ?><option value="<?php echo esc_attr($cat->term_id); ?>" <?php if($cat->term_id==$CatID){echo 'selected=""';} ?>><?php echo $cat->name; ?></option><?php
                }
                ?>
                </select>
            </label>
        </p>
       

        <!--     Number of Items to display -->
        
        <?php $ItemCount = isset( $instance['ItemCount'] ) ? $instance['ItemCount'] : 6 ; ?>
        <p>
            <label for="<?php echo $this->get_field_id('ItemCount'); ?>">
                <?php esc_html_e('Posts Count:', 'ang-plugins');?>
                <input  
                        id="<?php echo $this->get_field_id('ItemCount'); ?>" 
                        name="<?php echo $this->get_field_name('ItemCount'); ?>" 
                        type="number"
                        min="-1"
                        max="20"
                        value="<?php echo $ItemCount; ?>" />
            </label>
        </p>
        
        <!--        Number of words per post -->
        
        <?php $p_number_words1 = isset( $instance[ 'p_number_words1' ] ) ? $instance[ 'p_number_words1' ] : 40; ?>
        <p>
            <label for="<?php echo $this->get_field_id('p_number_words1'); ?>">
                <?php esc_html_e('Words per each post:', 'ang-plugins'); ?>
                <input  
                        id="<?php echo $this->get_field_id('p_number_words1'); ?>" 
                        name="<?php echo $this->get_field_name('p_number_words1'); ?>" 
                        type="number"
                        min="5"
                        value="<?php echo $p_number_words1; ?>" />
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
        
        
        <!--        Select view type, template  -->
         
        <?php
            // define plugin pathes
            $plugin_dir = plugin_dir_path( __FILE__ ); //plagin path
            $temp_dir_path = $plugin_dir.'testimonials-templates/'; // path to templates folder
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
                <?php _e('View Type:', 'ang-plugins'); ?>
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
        
        
        <!--   Checbox Hide the post title -->
         
         <?php $p_title1 = isset( $instance['p_title1'] ) ? $instance['p_title1'] : false; ?>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('p_title1'); ?>" name="<?php echo $this->get_field_name('p_title1'); ?>" <?php if ($p_title1) echo 'checked'; ?> />
            <label for="<?php echo $this->get_field_id('p_title1'); ?>"><?php esc_html_e('Hide the post title', 'ang-plugins'); ?></label>
        </p>
        
        <!--   Checkox Hide the post excerpt -->
         
         <?php $p_excerpt1 = isset( $instance['p_excerpt1'] ) ? $instance['p_excerpt1'] : false; ?>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('p_excerpt1'); ?>" name="<?php echo $this->get_field_name('p_excerpt1'); ?>" <?php if ($p_excerpt1) echo 'checked'; ?> />
            <label for="<?php echo $this->get_field_id('p_excerpt1'); ?>"><?php esc_html_e('Hide the post excerpt', 'ang-plugins'); ?></label>
        </p>
        
        <!--   Checkox Hide author ava -->
         
         <?php $p_ava = isset( $instance['p_ava'] ) ? $instance['p_ava'] : false; ?>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('p_ava'); ?>" name="<?php echo $this->get_field_name('p_ava'); ?>" <?php if ($p_ava) echo 'checked'; ?> />
            <label for="<?php echo $this->get_field_id('p_ava'); ?>"><?php esc_html_e('Hide the author avatar', 'ang-plugins'); ?></label>
        </p>
        
        <!--        Slideshow animation -->
                  
        <?php $animation = isset( $instance['animation'] ) ? $instance['animation'] : "fade"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'animation' )); ?>">
                <?php esc_html_e('Animation:', 'ang-plugins');?>
            </label> 
            <br>
            <select id="<?php echo esc_attr($this->get_field_id('animation')); ?>" name="<?php echo esc_attr($this->get_field_name('animation')); ?>">
                <option value="fade" <?php echo ($animation=='fade')?'selected':''; ?>>Fade</option>
                <option value="scroll" <?php echo ($animation=='scroll')?'selected':''; ?>>Scroll</option>
                <option value="scale" <?php echo ($animation=='scale')?'selected':''; ?>>Scale</option>
                <option value="swipe" <?php echo ($animation=='swipe')?'selected':''; ?>>Swipe</option>
                <option value="fold" <?php echo ($animation=='fold')?'selected':''; ?>>Fold</option>
                <option value="puzzle" <?php echo ($animation=='puzzle')?'selected':''; ?>>Puzzle</option>
                <option value="boxes" <?php echo ($animation=='boxes')?'selected':''; ?>>Boxes</option>
                <option value="boxes-reverse" <?php echo ($animation=='boxes-reverse')?'selected':''; ?>>Boxes-reverse</option>
            </select>
        </p>
        
        <!--        Slideshow animation duration -->
        
        <?php $duration = isset( $instance['duration'] ) ? $instance['duration'] : "500"; ?>
        <p>
            <label for="<?php echo esc_attr ($this->get_field_id('duration')); ?>">
                <?php esc_html_e('Duration of animation:', 'ang-plugins');?>
                <input  
                        id="<?php echo esc_attr($this->get_field_id('duration')); ?>" 
                        name="<?php echo esc_attr($this->get_field_name('duration')); ?>" 
                        type="text" 
                        value="<?php echo esc_attr($duration); ?>" />
            </label>
        </p>
        
        
        <!--        Slideshow autoplay interval -->
        
        <?php $autoplayInterval = isset( $instance['autoplayInterval'] ) ? $instance['autoplayInterval'] : "9000"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('autoplayInterval')); ?>">
                <?php esc_html_e('Autoplay Interval:', 'ang-plugins');?>
                <input 
                        id="<?php echo esc_attr ($this->get_field_id('autoplayInterval')); ?>" 
                        name="<?php echo esc_attr ($this->get_field_name('autoplayInterval')); ?>" 
                        type="text" 
                        value="<?php echo esc_attr ($autoplayInterval); ?>" />
            </label>
        </p>
        
        <!--   Order type -->
        
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
                <?php esc_html_e('Show next and previous buttons:', 'ang-plugins');?>
            </label> 
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav_btn')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav_btn')); ?>" value="1" <?php if($slidenav_btn=="1"){ echo "checked"; }?>>Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav_btn')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav_btn')); ?>" value="2" <?php if($slidenav_btn=="2"){ echo "checked"; }?>>No
        </p>
        
        <!--        Slideshow thumbnail navigation -->
        
        <?php $slidenav = isset( $instance['slidenav'] ) ? $instance['slidenav'] : "1"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'slidenav' )); ?>">
                <?php esc_html_e('Show dot navigation:', 'ang-plugins');?>
            </label> 
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav')); ?>" value="1" <?php if($slidenav=="1"){ echo "checked"; }?>>Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav')); ?>" value="2" <?php if($slidenav=="2"){ echo "checked"; }?>>No
        </p>
        
        <!--checkbox select slidenav position-->
                  
        <?php $slidenav_position = isset( $instance['slidenav_position'] ) ? $instance['slidenav_position'] : "center"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'slidenav_position' )); ?>">
                <?php esc_html_e('Slidenav position:', 'ang-plugins');?>
            </label> 
            <br>
            <select id="<?php echo esc_attr($this->get_field_id('slidenav_position')); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav_position')); ?>">
                <option value="center" <?php echo ($slidenav_position=='center')?'selected':''; ?>><?php esc_html_e('Center', 'ang-plugins');?></option>
                <option value="left" <?php echo ($slidenav_position=='left')?'selected':''; ?>><?php esc_html_e('Left', 'ang-plugins');?></option>
                <option value="right" <?php echo ($slidenav_position=='right')?'selected':''; ?>><?php esc_html_e('Right', 'ang-plugins');?></option>
            </select>
        </p>
        
        <!--        Slideshow thumbnail navigation type -->
        
        <?php $slidenav_type = isset( $instance['slidenav_type'] ) ? $instance['slidenav_type'] : "1"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'slidenav_type' )); ?>">
                <?php esc_html_e('Navigation type:', 'ang-plugins'); ?>
            </label> 
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav_type')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav_type')); ?>" value="1" <?php if($slidenav_type=="1"){ echo "checked"; }?>><?php esc_html_e('Round', 'ang-plugins'); ?> &nbsp;&nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav_type')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav_type')); ?>" value="2" <?php if($slidenav_type=="2"){ echo "checked"; }?>><?php esc_html_e('Square', 'ang-plugins'); ?> &nbsp;&nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav_type')."_3"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav_type')); ?>" value="3" <?php if($slidenav_type=="3"){ echo "checked"; }?>><?php esc_html_e('Dashed', 'ang-plugins'); ?>
        </p>
        
        <!--        Slideshow autoplay -->
        
        <?php $autoplay = isset( $instance['autoplay'] ) ? $instance['autoplay'] : "1"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'autoplay')); ?>">
                <?php esc_html_e('Autoplay:', 'ang-plugins');?>
            </label> 
            <br>
            <input type="radio" id="<?php echo esc_attr ($this->get_field_id('autoplay')."_1"); ?>" name="<?php echo esc_attr ($this->get_field_name('autoplay')); ?>" value="1" <?php if($autoplay=="1"){ echo "checked"; }?>>Yes 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr ($this->get_field_id('autoplay')."_2"); ?>" name="<?php echo esc_attr ($this->get_field_name('autoplay')); ?>" value="2" <?php if($autoplay=="2"){ echo "checked"; }?>>No
        </p>
        
         
        <!--     Check pause on hover  -->
                
        <?php $pauseOnHover = isset( $instance['pauseOnHover'] ) ? $instance['pauseOnHover'] : "1"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'pauseOnHover' )); ?>">
                <?php esc_html_e('Pause on Hover:', 'ang-plugins');?>
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
        $instance['CatID'] = $new_instance['CatID'];
        $instance['TaxEvent'] = $new_instance['TaxEvent'];
        $instance['ItemCount'] = $new_instance['ItemCount'];
        $instance['p_number_words1'] = $new_instance['p_number_words1'];
        $instance['ex_class'] = $new_instance['ex_class'];
        $instance['view_template'] = $new_instance['view_template'];
        $instance['p_order_type'] = $new_instance['p_order_type'];
        $instance['p_title1'] = $new_instance['p_title1'];
        $instance['p_excerpt1'] = $new_instance['p_excerpt1'];
        $instance['p_ava'] = $new_instance['p_ava'];
        
        $instance['slidenav_btn'] = $new_instance['slidenav_btn'];
        $instance['slidenav'] = $new_instance['slidenav'];
        $instance['slidenav_position'] 	= $new_instance['slidenav_position'];
        $instance['slidenav_type'] = $new_instance['slidenav_type'];
        $instance['animation'] = $new_instance['animation'];
        $instance['duration'] = $new_instance['duration'];
        $instance['autoplay'] = $new_instance['autoplay'];
        $instance['autoplayInterval'] = $new_instance['autoplayInterval'];
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
        
        
        $p_title1 = $instance['p_title1'] ? true : false;
        $p_excerpt1 = $instance['p_excerpt1'] ? true : false;
        $p_ava = $instance['p_ava'] ? true : false;
       
        // UIkit Slideshow configuration
        $slideshow_cfg = array ();
        $slideshow_cfg[] = "animation: '".$instance['animation']."'";
        $slideshow_cfg[] = "duration: '".$instance['duration']."'";
        $slideshow_cfg[] = "autoplayInterval: '".$instance['autoplayInterval']."'";
        if($instance['autoplay']=="1"){$slideshow_cfg[] = "autoplay: true";}else{$slideshow_cfg[] = "autoplay: false";}
        if($instance['pauseOnHover']=="1"){$slideshow_cfg[] = "pauseOnHover: true";}else{$slideshow_cfg[] = "pauseOnHover: false";}
        
        
        $args = array(
            'posts_per_page'   => $instance['ItemCount'],
            'offset'           => 0,
            //'category'         => $cat_typeID,
            //'orderby'          => $instance['p_order_by'],
            'order'            => $instance['p_order_type'],
            'post_status'      => 'publish',
            'post_type'        => $instance['p_post_type'],
            'suppress_filters' => true 
        );
        
        if($instance[ 'p_post_type' ] == 'testimonial' && $instance['TaxEvent'] !=''){
        /*
         * Check Post type testimonial and taxonomy
         */
            $args['tax_query'][] = array(
                        'taxonomy'  => 'testimonial-category',
                        'field'     => 'term_id',
                        'terms'     => $instance['TaxEvent'],
            );
        }elseif($instance[ 'p_post_type' ] == 'post'){
        /*
         * Check Post type post and category
         */
           $args['category'] = $instance['CatID'];
        }else{
            $args['category'] = '';
        }
        
        $list = get_posts( $args ); 
        
        // define plugin template path
            $plugin_dir = plugin_dir_path( __FILE__ ); //plagin path

            // code here template

            include $plugin_dir.'testimonials-templates/'.$instance['view_template']; // path to templates
            
        echo $after_widget;
    }
}

/*********** 
******* apply style dir
*****/
function load_ang_testimonials_css() {
    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_style('css-ang-testimonials', $plugin_url . 'testimonials-css/testim-css.css' );
}
add_action('wp_enqueue_scripts', 'load_ang_testimonials_css' );

add_action('widgets_init', create_function('', 'return register_widget("ANGTestimonialsSlides");')); ?>