<?php

/**
 * Widget template
 *
 * @name        Testimonials slide template Ology
 * @package     ology
 * @subpackage  Admin/Author
 * @copyright   Copyright (c) 2016, Aleksandr Glovatskyy, All rights protected. Anly commertial license.
 * @author      Aleksandr Glovatskyy, aleksandr1278@gmail.com
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 * @date        16.08.2016
 */

?>
    <div class="ang-slides-factory <?php echo $template; if($woo_active) echo ' woocommerce'; echo ' ' . $extra_class; ?>">
        <?php if($content){?>
            <div class="uk-grid uk-grid-width-1-1"><div class="ang-short-descr uk-text-center uk-margin-bottom"><?php echo $content; ?></div></div>
        <?php } ?>
        <div class="woocommerce woocommerce-page ang-slides-wrapp" <?php if($slide_mode == 'slideset') { ?> data-uk-slideset="{small: 2, medium: 3, large: 3, <?php echo esc_attr(implode(', ', $slideset_cfg)); ?>}" <?php } ?>>
            <div class="uk-slidenav-position" <?php if($slide_mode == 'slider') { ?> data-uk-slider="{<?php echo esc_attr(implode(', ', $slider_cfg)); ?> }" <?php } ?>>
                    <?php if($slidenav_btn) { ?>
                <div class="ang-woo-product-nav">
                    <span class='uk-position-relative uk-display-inline-block'>
                        <a draggable="false" href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" <?php echo $slide_mode == 'slideset' ? 'data-uk-slideset-item="previous"' : 'data-uk-slider-item="previous"'; ?>></a>
                        <a draggable="false" href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" <?php echo $slide_mode== 'slideset' ? 'data-uk-slideset-item="next"' : 'data-uk-slider-item="next"'; ?>></a>
                    </span>
                </div>
                    <?php } ?>

                <?php if($slide_mode == 'slider'){ ?><div class="uk-slider-container"><?php } ?>

                <ul class="uk-grid uk-flex-center uk-grid-<?php print $gutter; ?> <?php echo $slide_mode == 'slideset' ? 'uk-slideset' : 'uk-slider uk-grid-width-1-1 uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4'; ?> <?php echo $slide_mode == 'slider' && $slider_fullscreen ? 'uk-slider-fullscreen' : ''; ?>" data-uk-grid-match="{target:'article'}" >
                   <?php
                   $query_open = new WP_Query( $args );
                   $slide_count=0;
                    if ( $query_open->have_posts() ) {
                    while ( $query_open->have_posts() ) {
                        $query_open->the_post();
                        $slide_count++;
                        
                        $custom_fields_data = get_post_custom($query_open->post->ID);
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
                        
                        if(has_post_thumbnail( $query_open->post->ID )){
                            $response = get_the_post_thumbnail ($query_open->post->ID, array(45,45), array('class' => 'uk-border-circle'));
                        }else{
                            if ( isset ( $testimonial_email ) ){
                                $response = get_avatar( $testimonial_email, 45, '', '', array('class'=>'uk-border-circle') );
                            }
                        }
                        
                        // get testimonials category terms
                        $tax_term = get_the_terms( $query_open->post->ID, 'testimonial-category' );
                        
                        ?>
                        <li class="<?php if($woo_active) echo ' product'; ?> item-<?php print $slide_count; ?> <?php echo 'post_type-'.$query_open->post->post_type; ?> <?php echo $tax_term[0]->slug; if($featured){ echo 'featured-post' ;} ?> post-id-<?php echo get_the_ID(); ?>" >
                            <article>
                                <div class="clear"></div> 
                                
                                <?php
                                    if($ava){
                                        if ( $testimonial_email_bool || has_post_thumbnail( $query_open->post->ID ) ) {
                                          //echo empty ( $testimonial_url ) ? '' : '<a href="' . $testimonial_url . '" target="_blank">' ;
                                          echo $response;
                                          //echo empty ( $testimonial_url ) ? '' : '</a>' ;
                                        }
                                    }
                                ?>
                                <div class="uk-display-inline-block uk-vertical-align-middle uk-margin-left">
                                    <?php if($title){ ?>
                                            <h5 class="ang-pulse-anim uk-margin-remove"><?php echo $query_open->post->post_title; ?></h5>
                                    <?php } ?>
                                    <?php if($query_open->post->post_type == 'testimonial'){ 

                                            if ( ! empty ( $testimonial_byline ) ) { ?>
                                            <cite>
                                                <span class="qe-testimonial-byline tm-wiget-content uk-margin-remove">
                                                    <?php
                                                    echo empty ( $testimonial_url ) ? '' : '<a href="' . $testimonial_url . '" target="_blank">' ;
                                                    echo $testimonial_byline;
                                                    echo empty ( $testimonial_url ) ? '' : '</a>' ;
                                                    ?>
                                                </span>
                                            </cite>
                                    <?php   }
                                        } ?>
                                </div>
                                <?php if($excpt){
                                        //$exp = get_the_excerpt();
                                        $exp = $query_open->post->post_excerpt;
                                        if ( $exp != '' ){
                                            echo "<div class='uk-width-1-1 excerpt'>". do_shortcode($exp) ."</div>";
                                        } else {
                                            echo "<div class='uk-width-1-1 content'>". wp_trim_words( do_shortcode(get_the_content()), $number_words, '') ."</div>";
                                        }
                                    }
                                ?>
                            </article>
                        </li>
                    
                    <?php } ?>
                    <?php } ?>
                </ul>
                <?php if($slide_mode == 'slider'){ ?></div><?php } ?>
            </div>
            <?php if($slidenav && $slide_mode == 'slideset') { ?>
                <ul class="uk-slideset-nav uk-dotnav uk-dotnav-contrast uk-flex-center uk-margin-top"></ul>
            <?php } ?>
        </div>

        <?php if($page_link_id) { ?>
        <div class="ang-slider-but-wrap">
            <a class="uk-button ang-submit-butt uk-margin-top" href="<?php echo get_page_link( $page_link_id ); ?>" data-uk-scrollspy="{cls:'uk-animation-fade', repeat: false, delay:700}"><?php echo $but_name; ?></a>
        </div>
        <?php } ?>    
    </div>        
    <?php
wp_reset_query(); 


