<article id="item-<?php the_ID(); ?>" <?php post_class('uk-article night-blogger'); ?> data-permalink="<?php the_permalink(); ?>">
    <div class="ang-article-content uk-position-relative uk-overflow-hidden">
    <?php if (has_post_thumbnail()) : ?>
        <?php
        $width = get_option('thumbnail_size_w'); //get the width of the thumbnail setting
        $height = get_option('thumbnail_size_h'); //get the height of the thumbnail settin
        ?>
            <div class=" uk-position-relative">
                <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                    <?php the_post_thumbnail('main-blog-loop', array('class' => 'uk-width-1-1')); ?>
                    <?php if($woo_active && in_array( 'product', $args['post_type'])){
                            // define templates for 'WooCommmerce' plugin

                                // Sale label
                                print "<div class='ang-woo-sale'>";
                                woocommerce_get_template( 'loop/sale-flash.php' );
                                print "</div>";
                            }; 
                    ?>
                </a>
            </div>
        <?php else: ?>
            <div class=" uk-position-relative ang-noimage">
                <a class="" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><img class="uk-width-1-1" src="<?php echo get_template_directory_uri(); ?>/images/no-image/noimg.svg" data-uk-svg alt="no-image" /></a>
            </div>
        <?php endif; ?>
        <div class="ang-meta-container">
            <?php 
                // WooCommerce Products
                if($woo_active && in_array( 'product', $args['post_type'])){
                // define templates for 'WooCommmerce' plugin

                    // Price
                    print "<div class='ang-woo-price'>";
                    woocommerce_get_template( 'loop/price.php' );
                    print "</div>";

                    // Raiting 
                    print "<div class='ang-woo-rating'>";
                    woocommerce_get_template( 'loop/rating.php' );
                    print "</div>";

                    // Add to cart
                    print "<div class='ang-woo-cart'>";
                    woocommerce_get_template( 'loop/add-to-cart.php' );
                    print "</div>";
                }
            ?>
            <h2 class="uk-article-title uk-margin-small-top"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            
            <div class="uk-article-meta uk-clearfix">
                
                <time datetime="<?php print get_the_date('Y-m-d');?>"><?php print get_the_date('j F, Y');?></time>
                <?php if ( shortcode_exists( 'ya_share' ) ) { echo do_shortcode('[ya_share]'); } ?>
                <?php      
                    if(comments_open() || get_comments_number()) :
                        comments_popup_link(esc_html__('No Comments', 'ang-plugins'), esc_html__('1 Comment', 'ang-plugins'), esc_html__('% Comments', 'ang-plugins'), "", "");
                    endif;
                ?>
            </div>
        </div>
    </div>
</article>