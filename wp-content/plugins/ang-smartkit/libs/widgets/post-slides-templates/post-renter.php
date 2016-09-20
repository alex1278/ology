<?php

/**
 * Widget template
 *
 * @name        Woo Products slide widget themplate ishop
 * @package     iBloga
 * @subpackage  Admin/Author
 * @copyright   Copyright (c) 2016, Aleksandr Glovatskyy, All rights protected. Anly commertial license.
 * @author      Aleksandr Glovatskyy, aleksandr1278@gmail.com
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 * @date        12.05.2016
 */

?>
    <div class="ang-post-slides-factory ang-renter-slides-tmp <?php echo ' ' . $instance['ex_class']; ?>">
        <div class="uk-grid">
            <?php if($instance['descr'] != NULL) : ?>
                <div class="uk-width-1-1">
                    <p class="tm-widget-title-content"><?php echo $instance['descr']; ?></p>
                </div>
             <?php endif; ?>
        </div>
        <div class="ang-post-slides-wrapp uk-margin-large-bottom" <?php if($instance['slide_mode'] == "1") { ?> data-uk-slideset="{small: 2, medium: 3, large: 4, <?php echo esc_attr(implode(', ', $slideset_cfg)); ?>}" <?php } ?>>
            <div class="uk-slidenav-position" <?php if($instance['slide_mode'] == "2") { ?> data-uk-slider="{<?php echo esc_attr(implode(', ', $slider_cfg)); ?> }" <?php } ?>>
                
                <?php if($instance['slide_mode'] == "2"){ ?><div class="uk-slider-container"><?php } ?>

                <ul class="<?php echo $instance['slide_mode'] == '1' ? 'uk-slideset' : 'uk-slider'; ?> <?php echo $instance['slide_mode'] == '2' && $instance['slider_fullscreen'] == '1' ? 'uk-slider-fullscreen' : 'uk-grid uk-flex-center uk-grid-medium uk-grid-width-1-1 uk-grid-width-small-1-2 uk-grid-width-medium-1-3'; ?>" data-uk-grid-match="" >
                   <?php
                    while ( $item->have_posts() ) {
                        $item->the_post(); ?>
                    <?php if(has_post_thumbnail()){ ?>
                        <li class="<?php if($p_featured1 == true){ echo 'featured-post' ;} ?> post-id-<?php echo get_the_ID(); ?>">
                            <article class="tm-tab-content">
                                <h4 class=""><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <div class="effect blow-effect">
                                    <div class="uk-position-relative">
                                        <?php echo get_the_post_thumbnail (get_the_ID(), $image_size, array('class' => 'ang-news-thumb')); ?>
                                    </div>
                                    <a href="<?php the_permalink(); ?>"><div class="overlay overlay-1"></div></a>
                                    <div class="ang-stickers-wrapper">
                                        <span class="uk-float-left">
                                            <span class="ang-status-sticker">
                                                <time datetime="<?php print get_the_date('Y-m-d');?>"><?php print get_the_date('j M, y');?></time>
                                            </span>
                                        </span>
                                    </div>
                                    
                                </div>
                                <div class="">
                                    <div class="uk-margin-top uk-margin-bottom ang-post-slides-excerpt">

                                    <?php if($p_excpt != false){
                                            $exp = get_the_excerpt();
                                            if ( $exp != '' ){
                                                echo "<div class='uk-width-1-1 excerpt'>". do_shortcode($exp) ."</div>";
                                            } else {
                                                echo "<div class='uk-width-1-1 content'><p class='uk-margin-remove'>". wp_trim_words( do_shortcode(get_the_content()), $instance['p_number_words1'], '...') ."</p></div>";
                                            }
                                        }else {
                                            echo "<div class='uk-width-1-1 content'><p class='uk-margin-remove'>". wp_trim_words( do_shortcode(get_the_content()), $instance['p_number_words1'], '...') ."</p></div>";
                                        }
                                    ?>

                                    </div>
                                    <div class="ang-arhive-links uk-clearfix">
                                        <?php
                                            printf(wp_kses(__('<span class="uk-float-left"> Author: %s</span>', 'ang-plugins'), 'post' ), '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'" title="'.get_the_author().'">'.get_the_author().'</a>');
                                        ?>
                                        <?php if(comments_open() || get_comments_number()) : ?>
                                        <span class="uk-float-right"><?php _e('Comments: ', 'ang-plugins'); comments_popup_link(esc_html__('0', 'ang-plugins'), esc_html__('1', 'ang-plugins'), esc_html__('%', 'ang-plugins'), "", "");?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </article>
                        </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
                <?php if($instance['slide_mode'] == "2"){ ?></div><?php } ?>
                
                <?php if($instance['slidenav_btn']=="1") { ?>
                    <div class="ang-right-bot-slidenav">
                        <span class='uk-position-relative uk-display-inline-block'>
                            <?php if($instance['slidenav_btn']=="1") { ?>
                            <a draggable="false" href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous"  <?php echo $instance['slide_mode'] == '1' ? 'data-uk-slideset-item="previous"' : 'data-uk-slider-item="previous"'; ?>></a>
                            <a draggable="false" href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" <?php echo $instance['slide_mode'] == '1' ? 'data-uk-slideset-item="next"' : 'data-uk-slider-item="next"'; ?>></a>
                            <?php } ?>
                        </span>
                    </div>
                <?php } ?>
                
            </div>
            <?php if($instance['slidenav']=="1" && $instance['slide_mode'] == "1") { ?>
                <ul class="uk-slideset-nav uk-dotnav uk-dotnav-contrast uk-flex-center uk-margin-top"></ul>
            <?php } ?>
        </div>

        <?php if($p_page_link != true) { ?>
        <div class="">
            <a class="uk-button uk-button-primary tm-button-theme" href="<?php echo get_page_link( $instance['page_link_id'] ); ?>" data-uk-scrollspy="{cls:'uk-animation-fade', repeat: false, delay:800}"><?php echo $instance['but_name']; ?></a>
        </div>
        <?php } ?>    
    </div>        
    <?php
wp_reset_query(); 