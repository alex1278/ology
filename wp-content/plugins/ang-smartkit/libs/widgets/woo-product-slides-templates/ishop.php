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
    <div class="ang-woo-product-slides-factory ishop <?php echo ' ' . $instance['ex_class']; ?>">
        <div class="uk-grid">
            <?php if($instance['descr'] != NULL) : ?>
                <div class="uk-width-1-1">
                    <p class="tm-widget-title-content"><?php echo $instance['descr']; ?></p>
                </div>
             <?php endif; ?>
        </div>
        <div class="woocommerce woocommerce-page ang-woo-product-slides-wrapp" <?php if($instance['slide_mode'] == "1") { ?> data-uk-slideset="{small: 2, medium: 3, large: 4, <?php echo esc_attr(implode(', ', $slideset_cfg)); ?>}" <?php } ?>>
            <div class="uk-slidenav-position" <?php if($instance['slide_mode'] == "2") { ?> data-uk-slider="{<?php echo esc_attr(implode(', ', $slider_cfg)); ?> }" <?php } ?>>
                    <?php if($instance['slidenav_btn']=="1") { ?>
                <div class="ang-woo-product-nav">
                    <span class='uk-position-relative uk-display-inline-block'>
                        <a draggable="false" href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" <?php echo $instance['slide_mode'] == '1' ? 'data-uk-slideset-item="previous"' : 'data-uk-slider-item="previous"'; ?>></a>
                        <a draggable="false" href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" <?php echo $instance['slide_mode'] == '1' ? 'data-uk-slideset-item="next"' : 'data-uk-slider-item="next"'; ?>></a>
                    </span>
                </div>
                    <?php } ?>

                <?php if($instance['slide_mode'] == "2"){ ?><div class="uk-slider-container"><?php } ?>

                <ul class="<?php echo $instance['slide_mode'] == '1' ? 'uk-slideset' : 'uk-slider'; ?> <?php echo $instance['slide_mode'] == '2' && $instance['slider_fullscreen'] == '1' ? 'uk-slider-fullscreen' : 'uk-grid uk-flex-center uk-grid-medium uk-grid-width-1-1 uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4'; ?>" data-uk-grid-match="" >
                   <?php
                    while ( $woo_products->have_posts() ) {
                        $woo_products->the_post(); ?>
                        <li class="product <?php if($p_featured1 == true){ echo 'featured-post' ;} ?> post-id-<?php echo get_the_ID(); ?>">
                            <article class="tm-block-item-cover">

                                <div class="uk-text-center">
                                    <div class="ang-woo-product-thumb-wrapp uk-position-relative">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                                            <div class="ang-woo-sale">
                                                <?php woocommerce_get_template( 'loop/sale-flash.php' ); // Sale ?>
                                            </div>
                                            <?php echo woocommerce_get_product_thumbnail(); //Product Image ?>
                                        </a>
                                    </div>
                                    <?php if($p_excpt != false){
                                            $exp = get_the_excerpt();
                                            if ( $exp != '' ){
                                                echo "<div class='uk-width-1-1 excerpt'>". do_shortcode($exp) ."</div>";
                                            } else {
                                                echo "<div class='uk-width-1-1 content'>". wp_trim_words( do_shortcode(get_the_content()), $instance['p_number_words1'], '') ."</div>";
                                            }
                                        }
                                    ?>
                                    <h5>
                                        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                    </h5>
                                    <div class="ang-woo-rating">
                                        <?php woocommerce_get_template( 'loop/rating.php' ); // Raiting ?>
                                    </div>
                                    <div class="ang-woo-price">
                                         <?php woocommerce_get_template( 'loop/price.php' );// Price ?>
                                    </div>
                                    <div class="ang-woo-cart">
                                        <?php woocommerce_get_template( 'loop/add-to-cart.php' );// Add to cart ?>
                                    </div>
                                </div>
                            </article>
                        </li>
                    <?php } ;?>
                </ul>
                <?php if($instance['slide_mode'] == "2"){ ?></div><?php } ?>
            </div>
            <?php if($instance['slidenav']=="1" && $instance['slide_mode'] == "1") { ?>
                <ul class="uk-slideset-nav uk-dotnav uk-dotnav-contrast uk-flex-center uk-margin-top"></ul>
            <?php } ?>
        </div>

        <?php if($p_page_link != true) { ?>
        <div class="ang-slider-but-wrap">
            <a class="uk-button ang-submit-butt uk-margin-top" href="<?php echo get_page_link( $instance['page_link_id'] ); ?>" data-uk-scrollspy="{cls:'uk-animation-fade', repeat: false, delay:800}"><?php echo $instance['but_name']; ?></a>
        </div>
        <?php } ?>    
    </div>        
    <?php
wp_reset_query(); 


