<?php

/**
 * Widget template
 *
 * @name        testimonials ibloga
 * @package     iBloga
 * @subpackage  Admin/Author
 * @copyright   Copyright (c) 2016, Aleksandr Glovatskyy, All rights protected. Anly commertial license.
 * @author      Aleksandr Glovatskyy, aleksandr1278@gmail.com
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 * @date        12.05.2016
 */

?>
<div class="ang-testimonials-slides ibloga-testim-tmp <?php echo ' ' . $instance['ex_class']; ?>">   
        <div class="uk-grid">
            <?php if($instance['descr'] != NULL) : ?>
            <div class="uk-width-1-1 tm-widget-descr">
                <p class="tm-widget-title-content"><?php echo $instance['descr']; ?></p>
            </div>
            <?php endif; ?>
            <div class="uk-width-1-1">
                <div class="uk-slidenav-position" data-uk-slideshow="{<?php echo esc_attr(implode(", ", $slideshow_cfg)); ?>}">
                    
                    <ul class="uk-slideshow">
                        
                      <?php 
                      $count=0;
                      foreach ($list as $post) {
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
                         $testimonial_email_bool = is_email( $testimonial_email );
                         
                        // get testimonials category terms
                        $tax_term = get_the_terms( $post->ID, 'testimonial-category' );
                        
                        if(has_post_thumbnail( $post->ID )){
                            $response = get_the_post_thumbnail ($post->ID, array(100,100), array('class' => 'uk-border-circle'));
                        }else{
                            if ( isset ( $testimonial_email ) ){
                                $response = get_avatar( $testimonial_email, 100, '', '', array('class'=>'uk-border-circle wp-post-image') ); ;
                            }
                        }
                        ?>  
                        <li class="<?php echo 'post_type-'.$post->post_type ?> <?php echo 'testimonial-id-'.$post->ID; ?>">
                            <div class="uk-grid">
                                <div class="uk-hidden-small uk-width-1-1 uk-width-medium-1-6 testimonials-icon <?php echo $tax_term[0]->slug;?>"><span></span></div>
                                <div class="uk-panel uk-width-1-1 uk-width-medium-5-6">
                                <?php if($p_excerpt1 != true){
                                        $my_excerpt = $post->post_excerpt;
                                        if ( $my_excerpt != '' ){
                                            echo "<article class='tm-widget-excerpt'><p>". $my_excerpt ."</p></article>";
                                        } else {
                                            echo "<article class='tm-widget-excerpt'><p>". wp_trim_words( $post->post_content, $instance['p_number_words1'], '') ."</p></article>";
                                        }
                                    }
                                    
                                    if($p_ava != true){ ?>
                                        <div class="ang-testim-ava-wrapp">
                                            <?php 
                                            if ( $testimonial_email_bool || has_post_thumbnail( $post->ID ) ) {
                                              echo empty ( $testimonial_url ) ? '' : '<a href="' . $testimonial_url . '" target="_blank">' ;
                                              echo $response;
                                              echo empty ( $testimonial_url ) ? '' : '</a>' ;
                                            } ?>
                                        </div>
                                    <?php } ?>
                                    <?php if($p_title1 != true){ ?>
                                            <h6 class="uk-panel-title ang-pulse-anim"><?php echo $post->post_title; ?></h6>
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
                            </div>
                        </li>
                        <?php  }  ?>
                    </ul>
                    <?php if($instance['slidenav_btn']=="1") : ?>
                    <a href="" class="uk-slidenav uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
                    <a href="" class="uk-slidenav uk-slidenav-next" data-uk-slideshow-item="next"></a>
                <?php endif; ?>
                    <?php if($instance['slidenav']=="1") { ?>
                        <div class="uk-grid">
                            <div class="uk-width-1-1 uk-width-medium-5-6 uk-push-1-6 uk-overflow-hidden uk-position-relative uk-flex uk-flex-<?php echo $instance['slidenav_position'];?>">
                                <ul class="uk-position-relative uk-dotnav uk-dotnav-contrast uk-flex-center">
                                <?php for($i=0; $i<$count; $i++){ ?>
                                    <li data-uk-slideshow-item="<?php echo $i; ?>"><a href=""></a></li>
                                <?php } ?>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
    </div>
        