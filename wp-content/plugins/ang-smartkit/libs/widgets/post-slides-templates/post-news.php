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
    <div class="ang-post-slides-factory underlined-header ang-postnews-slider <?php echo ' ' . $instance['ex_class']; ?>">
        
        <div class="ang-post-slides-wrapp" <?php if($instance['slide_mode'] == "1") { ?> data-uk-slideset="{small: 2, medium: 3, large: 4, <?php echo esc_attr(implode(', ', $slideset_cfg)); ?>}" <?php } ?>>
            <div class="uk-slidenav-position" <?php if($instance['slide_mode'] == "2") { ?> data-uk-slider="{<?php echo esc_attr(implode(', ', $slider_cfg)); ?> }" <?php } ?>>
                
                 <?php if(($instance['title'] != NULL) || ($instance['slidenav_btn']=="1")) : ?>
                    <h3 class="uk-panel-title">
                        <span>
                            <?php if($instance['slidenav_btn']=="1") { ?>
                            <a draggable="false" href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous"  <?php echo $instance['slide_mode'] == '1' ? 'data-uk-slideset-item="previous"' : 'data-uk-slider-item="previous"'; ?>></a>
                                <?php echo $instance['title']; ?>
                            <a draggable="false" href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" <?php echo $instance['slide_mode'] == '1' ? 'data-uk-slideset-item="next"' : 'data-uk-slider-item="next"'; ?>></a>
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

                <?php if($instance['slide_mode'] == "2"){ ?><div class="uk-slider-container"><?php } ?>

                <ul class="<?php echo $instance['slide_mode'] == '1' ? 'uk-slideset' : 'uk-slider'; ?> <?php echo $instance['slide_mode'] == '2' && $instance['slider_fullscreen'] == '1' ? 'uk-slider-fullscreen' : 'uk-grid uk-flex-center uk-grid-medium uk-grid-width-1-1 uk-grid-width-small-1-2 uk-grid-width-medium-1-3'; ?>" data-uk-grid-match="" >
                   <?php
                    while ( $item->have_posts() ) {
                        $item->the_post(); ?>
                    <?php if(has_post_thumbnail()){ ?>
                        <li class="<?php if($p_featured1 == true){ echo 'featured-post' ;} ?> post-id-<?php echo get_the_ID(); ?>">
                            <article class="tm-tab-content">
                                <div class="effect blow-effect">
                                    <div class="uk-position-relative">
                                        <?php echo get_the_post_thumbnail (get_the_ID(), $image_size, array('class' => 'ang-news-thumb')); ?>
                                    </div>
                                    <a href="<?php the_permalink(); ?>"><div class="overlay overlay-1"></div></a>
                                    <div class="epl-stickers-wrapper">
                                        <span class="uk-float-left">
                                            <span class="status-sticker current">
                                                <time datetime="<?php echo get_the_date('j M, y');?>"><?php echo get_the_date('j M, y');?></time>
                                            </span>
                                        </span>
                                    </div>
                                    <h5 class="uk-panel-title uk-position-absolute uk-margin-remove"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                </div>
                                <div class="uk-width-1-1 tm-slider-post">
                                    <div class="tm-slider-post-excerpt">

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
                                    <a class="author-title " href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>"><i class="uk-icon-user"></i> <?php the_author() ;?></a>
                                        <?php if(comments_open() || get_comments_number()) : ?>
                                    <?php comments_popup_link(__('<i class="uk-icon-comment"></i>0', 'warp'), __('<i class="uk-icon-comment"></i>1', 'warp'), __('<i class="uk-icon-comment"></i>%', 'warp'), "", ""); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </article>
                        </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
                <?php if($instance['slide_mode'] == "2"){ ?></div><?php } ?>
            </div>
            <?php if($instance['slidenav']=="1" && $instance['slide_mode'] == "1") { ?>
                <ul class="uk-slideset-nav uk-dotnav uk-dotnav-contrast uk-flex-center uk-margin-top"></ul>
            <?php } ?>
        </div>

        <?php if($p_page_link != true) { ?>
        <div class="ang-slider-but-wrap">
            <a class="uk-button uk-button-primary tm-button-theme" href="<?php echo get_page_link( $instance['page_link_id'] ); ?>" data-uk-scrollspy="{cls:'uk-animation-fade', repeat: false, delay:800}"><?php echo $instance['but_name']; ?></a>
        </div>
        <?php } ?>    
    </div>        
    <?php
wp_reset_query(); 