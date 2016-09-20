<?php
/*
  Plugin Name: ANG Testimonials Slideshow
  Plugin URI: http://karate.do-i-posle.dzu/
  Description: Displays testimonials post type in Slideshow
  Author: Aleksandr Glovatskyy
  Version: 1.0.5
  Date: 25.08.2015
  Author e-mail: alex1278@list.ru
  Author URI: http://karate.do-i-posle.dzu/
 */

class EstaTestimonialsSlides extends WP_Widget {
    
    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'ANG-Testimonials-Slides', // Base ID
            __('ANG Testimonials Slides', 'text_domain'), // Name
            array( 'description' => __( 'Displays testimonials post type in Slideshow', 'text_domain' ), ) // Args
        );
    }
    
    function form($instance) { ?>

<!--        Title input-->

        <?php $title = isset( $instance['title']) ? esc_attr( $instance['title'] ) : "Testimonials"; ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                Title: 
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
                Description: 
                <textarea class="widefat" rows="5" cols="10" 
                        id="<?php echo $this->get_field_id('descr'); ?>" 
                        name="<?php echo $this->get_field_name('descr'); ?>"><?php echo $descr; ?></textarea>
            </label>
        </p>
        
       <!--     Returns all registered post types-->
            
    <?php $p_post_type = isset( $instance[ 'p_post_type' ] ) ? $instance[ 'p_post_type' ] : 'testimonial'; ?>
        <p>
            <label for="<?php echo $this->get_field_id('p_post_type'); ?>">
                <?php _e('Select post type:', 'text_domain'); ?>
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
                    
                      <option value="testimonial" <?php if('testimonial'==$instance['p_post_type']){echo 'selected=""';} ?>>testimonial</option>
          <?php
                foreach ($post_types as $post_type){ ?>
                      <option value="<?php echo esc_attr($post_type); ?>" <?php if($post_type==$instance['p_post_type']){echo 'selected=""';} ?>><?php echo $post_type; ?></option>
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
                <?php _e('Testimonials category :', 'text_domain'); ?>
                    <select class="widefat" 
                          id="<?php echo esc_attr($this->get_field_id('TaxEvent')); ?>" 
                          name="<?php echo esc_attr($this->get_field_name('TaxEvent')); ?>" >
                      <option value="" <?php if('' == $instance['TaxEvent']){echo 'selected=""';} ?>>--All Testimonials--</option> <?php
                foreach ($tax_events as $tax_event){
                    ?><option value="<?php echo esc_attr($tax_event->term_id); ?>" <?php if($tax_event->term_id==$instance['TaxEvent']){echo 'selected=""';} ?>><?php echo $tax_event->name; ?></option><?php
                }
                ?>
                </select>
            </label>
        </p>
        <?php } ?>
        
        <!--        Selecting category id-->
        
         <p>
            <label for="<?php echo $this->get_field_id('CatID'); ?>">
                Post Category:(only post type):<?php
  
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
                    ?><option value="<?php echo esc_attr($cat->term_id); ?>" <?php if($cat->term_id==$instance['CatID']){echo 'selected=""';} ?>><?php echo $cat->name; ?></option><?php
                }
                ?>
                </select>
            </label>
        </p>
       

        <!--     Number of Items to display -->
        
        <?php $ItemCount = isset( $instance['ItemCount'] ) ? $instance['ItemCount'] : -1; ?>
        <p>
            <label for="<?php echo $this->get_field_id('ItemCount'); ?>">
                Posts Count: 
                <input class="widefat" 
                        id="<?php echo $this->get_field_id('ItemCount'); ?>" 
                        name="<?php echo $this->get_field_name('ItemCount'); ?>" 
                        type="number"
                        min="-1"
                        max="20"
                        value="<?php echo $instance['ItemCount']; ?>" />
            </label>
        </p>
        
        <!--        Number of words per post -->
        
        <?php $p_number_words1 = isset( $instance[ 'p_number_words1' ] ) ? $instance[ 'p_number_words1' ] : 35; ?>
        <p>
            <label for="<?php echo $this->get_field_id('p_number_words1'); ?>">
                <?php _e('Words per each post:', 'text_domain'); ?>
                <input class="widefat" 
                        id="<?php echo $this->get_field_id('p_number_words1'); ?>" 
                        name="<?php echo $this->get_field_name('p_number_words1'); ?>" 
                        type="number"
                        min="5"
                        value="<?php echo $instance['p_number_words1']; ?>" />
            </label>
        </p>
        
        
        <!--   Checkox Hide the post title -->
         
         <?php $p_title1 = isset( $instance['p_title1'] ) ? $instance['p_title1'] : false; ?>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('p_title1'); ?>" name="<?php echo $this->get_field_name('p_title1'); ?>" <?php if ($instance['p_title1']) echo 'checked'; ?> />
            <label for="<?php echo $this->get_field_id('p_title1'); ?>"><?php _e('Hide the post title', 'text_domain'); ?></label>
        </p>
        
        <!--   Checkox Hide the post excerpt -->
         
         <?php $p_excerpt1 = isset( $instance['p_excerpt1'] ) ? $instance['p_excerpt1'] : false; ?>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('p_excerpt1'); ?>" name="<?php echo $this->get_field_name('p_excerpt1'); ?>" <?php if ($instance['p_excerpt1']) echo 'checked'; ?> />
            <label for="<?php echo $this->get_field_id('p_excerpt1'); ?>"><?php _e('Hide the post excerpt', 'text_domain'); ?></label>
        </p>
        
        
        <!--        Slideshow animation -->
                  
        <?php $animation = isset( $instance['animation'] ) ? $instance['animation'] : "fade"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'animation' )); ?>">
                Animation:
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
                Duration of animation:
                <input class="widefat" 
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
                Autoplay Interval:
                <input class="widefat" 
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
        
        <!--        Slideshow thumbnail navigation -->
        
        <?php $slidenav = isset( $instance['slidenav'] ) ? $instance['slidenav'] : "1"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'slidenav' )); ?>">
                Show dot navigation:
            </label> 
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav')); ?>" value="1" <?php if($slidenav=="1"){ echo "checked"; }?>>Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('slidenav')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('slidenav')); ?>" value="2" <?php if($slidenav=="2"){ echo "checked"; }?>>No
        </p>
        
        <!--        Slideshow autoplay -->
        
        <?php $autoplay = isset( $instance['autoplay'] ) ? $instance['autoplay'] : "1"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'autoplay')); ?>">
                Autoplay:
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
        $instance['CatID'] = $new_instance['CatID'];
        $instance['TaxEvent'] = $new_instance['TaxEvent'];
        $instance['ItemCount'] = $new_instance['ItemCount'];
        $instance['p_number_words1'] = $new_instance['p_number_words1'];
        $instance['p_order_type'] = $new_instance['p_order_type'];
        $instance['p_title1'] = $new_instance['p_title1'];
        $instance['p_excerpt1'] = $new_instance['p_excerpt1'];
        
        $instance['slidenav_btn'] = $new_instance['slidenav_btn'];
        $instance['slidenav'] = $new_instance['slidenav'];
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
        
        $list = get_posts( $args ); ?>
    <div class="ang-testimonials-slides">   
        <div class="uk-grid">
            <?php if($instance['descr'] != NULL) : ?>
            <div class="uk-width-1-1 tm-widget-descr">
                <p class="tm-widget-title-content"><?php echo $instance['descr']; ?></p>
            </div>
            <?php endif; ?>
            <div class="uk-width-1-1">
                <div class="uk-slidenav-position uk-text-center" data-uk-slideshow="{<?php echo esc_attr(implode(", ", $slideshow_cfg)); ?>}">
                    
                    <ul class="uk-slideshow">
                        
                      <?php 
                      $count=0;
                      foreach ($list as $post) {
                        if(has_post_thumbnail($post->ID)){
                        $count+=1;
                        
                        $custom_fields_data = get_post_custom($post->ID);
                        $testimonial_email = '';
                        $testimonial_byline = '';
                        $testimonial_url = '';

                        if ( isset (  $custom_fields_data['_gravatar_email'] ) ) {
                            $testimonial_email = $custom_fields_data['_gravatar_email'][0];
                        }
                        if ( isset (  $custom_fields_data['_byline'] ) ) {
                            $testimonial_byline = $custom_fields_data['_byline'][0];
                        }
                        if ( isset (  $custom_fields_data['_url'] ) ) {
                            $testimonial_url = $custom_fields_data['_url'][0];
                        }
                         $testimonial_email = is_email( $testimonial_email );
                        
                        if(has_post_thumbnail( $post->ID )){
                            $response = get_the_post_thumbnail ($post->ID, array(100,100), array('class' => 'uk-border-circle'));
                            if (function_exists('get_wp_user_avatar') && ( isset ( $gravatar_email ) )) {
                                $response = get_wp_user_avatar($testimonial_email, 100);
                            }else{
                                if ( isset ( $gravatar_email ) ){
                                    $response = get_avatar( $testimonial_email, 100 );
                                }
                            } 
                        }
                        ?>  
                        <li class="<?php echo 'post_type-'.$post->post_type ?> <?php echo 'post-'.$post->ID ?>">
                            
                            <?php if($p_excerpt1 != true){
                                $my_excerpt = $post->post_excerpt;
                                if ( $my_excerpt != '' ){
                                    echo "<article class='tm-widget-excerpt'><p>". $my_excerpt ."</p></article>";
                                } else {
                                    echo "<article class='tm-widget-excerpt'><p>". wp_trim_words( $post->post_content, $instance['p_number_words1'], '') ."</p></article>";
                                }
                            }
                            ?>
                            <div class="uk-panel uk-text-center uk-width-1-1"> 
                                <div>
                                    <?php 
                                    if ( $testimonial_email || has_post_thumbnail( $post->ID ) ) {
                                      echo empty ( $testimonial_url ) ? '' : '<a href="' . $testimonial_url . '" target="_blank">' ;
                                      echo $response;
                                      echo empty ( $testimonial_url ) ? '' : '</a>' ;
                                    } ?>
                                </div>
                                <?php if($p_title1 != true){ ?>
                                <h5 class="uk-panel-title ang-pulse-anim uk-display-block"><?php echo $post->post_title; ?></h5>
                                <?php } ?>
                                <?php if($instance[ 'p_post_type' ] == 'testimonial'){ 
                                        if ( ! empty ( $testimonial_byline ) ) { ?>
                                <cite>
                                    <p class="qe-testimonial-byline tm-wiget-content">
                                        <?php
                                        echo empty ( $testimonial_url ) ? '' : '<a href="' . $testimonial_url . '" target="_blank">' ;
                                        echo $testimonial_byline;
                                        echo empty ( $testimonial_url ) ? '' : '</a>' ;
                                        ?>
                                    </p>
                                </cite>
                                    <?php  }
                                        } 
                                    ?>
                            </div>
                        </li>
                        <?php  }
                            }
                        ?>
                    </ul>
                    <?php if($instance['slidenav_btn']=="1") : ?>
                    <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
                    <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"></a>
                <?php endif; ?>
                    <?php if($instance['slidenav']=="1") { ?>
                    <div class="tm-border-nav uk-text-center uk-flex uk-flex-center uk-position-relative">
                        <ul class="uk-position-relative uk-dotnav uk-dotnav-contrast uk-flex-center">
                        <?php for($i=0; $i<$count; $i++){ ?>
                            <li data-uk-slideshow-item="<?php echo $i; ?>"><a href=""></a></li>
                        <?php } ?>
                        </ul>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
    </div>
        
        <?php
        
        echo $after_widget;
    }
}

add_action('widgets_init', create_function('', 'return register_widget("EstaTestimonialsSlides");')); ?>