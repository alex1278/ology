<article id="item-<?php the_ID(); ?>" <?php post_class('uk-article fashion-blogger'); ?> data-permalink="<?php the_permalink(); ?>">
    <div>
        <div class=" uk-grid uk-grid-collapse uk-position-relative">
            <div class="uk-width-medium-3-5 ang-meta-container uk-flex uk-flex-column uk-flex-space-between">
                    <div>
                        <time datetime="<?php print get_the_date('Y-m-d');?>"><?php print get_the_date('j F, Y');?></time>
                        <?php if ( shortcode_exists( 'ya_share' ) ) { echo do_shortcode('[ya_share]'); } ?>
                        <h2 class="uk-article-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                    </div>
                    <div class="uk-article-meta uk-clearfix ang-comments-loop">
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
                        <?php      
                            //echo ' <span><a href="'.get_author_posts_url(get_the_author_meta('ID')).'" title="'.get_the_author().'"><i class="uk-icon-user"></i>'.get_the_author().'</a></span>';
                            if(comments_open() || get_comments_number()) :
                                comments_popup_link(esc_html__('No Comments', 'ang-plugins'), esc_html__('1 Comment', 'ang-plugins'), esc_html__('% Comments', 'ang-plugins'), "", "");
                                //comments_popup_link(wp_kses(__('<i class="uk-icon-comments"></i> 0', 'ang-plugins'), 'post' ), wp_kses(__('<i class="uk-icon-comment"></i>1', 'ang-plugins'), 'post' ), wp_kses(__('<i class="uk-icon-comment"></i>%', 'ang-plugins'), 'post' ), "", "");
                            endif;
                        ?>
                    </div>
            </div>
        <?php if (has_post_thumbnail()) : ?>
            <?php
            $width = get_option('thumbnail_size_w'); //get the width of the thumbnail setting
            $height = get_option('thumbnail_size_h'); //get the height of the thumbnail settin
            ?>
                <div class="uk-width-medium-2-5 uk-position-relative">
                    <a class="uk-display-inline-block  uk-width-1-1" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                        <?php the_post_thumbnail('music-blog-loop', array('class' => 'ang-fashion-thumb')); ?>
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
                    <div class="uk-width-medium-2-5 uk-position-relative ang-noimage">
                        <a class="uk-display-inline-block  uk-width-1-1" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><img class="ang-fashion-thumb" src="<?php echo get_template_directory_uri(); ?>/images/no-image/noimg.svg" data-uk-svg alt="no-image" /></a>
                    </div>
            <?php endif; ?>
            
        </div>
    </div>
</article>