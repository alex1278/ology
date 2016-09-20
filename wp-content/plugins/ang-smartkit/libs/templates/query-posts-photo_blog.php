<article id="item-<?php the_ID(); ?>" <?php post_class('uk-article photo-blogger'); ?> data-permalink="<?php the_permalink(); ?>">
    <div class="ang-article-content uk-position-relative uk-overflow-hidden">
    <?php if (has_post_thumbnail()) : ?>
        <?php
        $width = get_option('thumbnail_size_w'); //get the width of the thumbnail setting
        $height = get_option('thumbnail_size_h'); //get the height of the thumbnail settin
        ?>
            <div class="ang-post-image-cover">
                <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                    <?php the_post_thumbnail('main-blog-loop', array('class' => 'tm-category-post-thumb')); ?>
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
                <div class="ang-post-image-cover ang-noimage">
                    <a class="tm-category-post-thumb" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/no-image/noimg.svg" data-uk-svg alt="no-image" /></a>
                </div>
        <?php endif; ?>
        <div class="ang-post-meta-info">
            
            <time datetime="<?php print get_the_date('Y-m-d');?>"><?php print get_the_date('j F, Y');?></time>
            <h2 class="uk-article-title uk-margin-top-remove"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            
            <div class="uk-article-meta uk-clearfix">
                
                <?php
                    //echo ' <span><a href="'.get_author_posts_url(get_the_author_meta('ID')).'" title="'.get_the_author().'"><i class="uk-icon-user"></i>'.get_the_author().'</a></span>';
                    if(comments_open() || get_comments_number()) :
                        comments_popup_link(esc_html__('No Comments', 'ang-plugins'), esc_html__('1 Comment', 'ang-plugins'), esc_html__('% Comments', 'ang-plugins'), "", "");
                        //comments_popup_link(wp_kses(__('<i class="uk-icon-comments"></i> 0', 'ang-plugins'), 'post' ), wp_kses(__('<i class="uk-icon-comment"></i>1', 'ang-plugins'), 'post' ), wp_kses(__('<i class="uk-icon-comment"></i>%', 'ang-plugins'), 'post' ), "", "");
                    endif;
                ?>
                <?php if ( shortcode_exists( 'ya_share' ) ) { echo do_shortcode('[ya_share]'); } ?>
                
            </div>
        </div>
        
    <?php //edit_post_link(esc_html__('Edit this post.', 'ang-plugins'), '<p style="clear:both""><i class="uk-icon-pencil"></i> ','</p>'); ?>
    </div>
    <div class="ang-woo-wrapp uk-clearfix">
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
        </div>
</article>