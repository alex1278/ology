<div class="ang-tabs-switcher-content" id="tab-id-<?php the_ID(); ?>" data-permalink="<?php the_permalink(); ?>">
    <div class="uk-grid uk-grid-collapse uk-grid-width-medium-1-2" data-uk-grid-match>
        <div class="ang-article-content uk-overflow-hidden uk-block uk-block-large">

            <?php   if ($title == 'on'){ ?>
            <h3 class="uk-panel-title uk-margin-top-remove">
                <?php $meta = get_post_meta(get_the_ID());
                if ((isset ($meta['timeline']) || isset($meta['_timeline'])) && $timeline_meta == 'on') { ?>
                    <time class="uk-display-block uk-margin-right"><?php echo (get_post_meta(get_the_ID(), 'timeline', true)) ? get_post_meta(get_the_ID(), 'timeline', true) : get_post_meta(get_the_ID(), '_timeline', true) ?></time>
                <?php } ?>
                    <span><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></span>
            </h3>
            <?php } ?>
            <?php   if ($excerpt == 'on'){
                        global $post;
                        $exp = get_the_excerpt();
                        print "<div class='ang-tab-switch-excerpt'>";
                            //set post content
                            if($content_words > 0){
                                echo '<p>'.wp_trim_words($post->post_content, $content_words, '').'</p>'; 
                            }
                            if($content_words == 0){
                                echo '<p>'. do_shortcode($exp). '</p>';
                            }
                            if($content_words == -1){
                                echo $post->post_content;
                            }
                            if($link == 'on') { ?>
                                <a class="uk-button ang-action-button uk-margin-top" href="<?php the_permalink() ?>"><?php esc_html_e('READ MORE', 'ang-plugins'); ?><i class="uk-icon-long-arrow-right uk-margin-left"></i></a>
                            <?php }
                        print "</div>";
                    } ?>

            <div class="ang-post-meta-info">

                <?php if ($post_date){ ?>
                    <time datetime="<?php print get_the_date('Y-m-d');?>"><?php print get_the_date($time_format);?></time>
                <?php } ?>
                <?php if($meta_data) { ?> 
                    <div class="uk-article-meta uk-clearfix">

                        <?php
                            if(comments_open() || get_comments_number()) :
                                comments_popup_link(esc_html__('No Comments', 'ang-plugins'), esc_html__('1 Comment', 'ang-plugins'), esc_html__('% Comments', 'ang-plugins'), "", "");
                            endif;
                        ?>
                        <?php if ( shortcode_exists( 'ya_share' ) && ($ya_share) ) { echo do_shortcode('[ya_share]'); } ?>

                    </div>
                <?php } ?>
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
        </div>
        
        <?php if (has_post_thumbnail()) :
            $thumb_id = get_post_thumbnail_id( $query_open->post->ID ); //add post thumbnail id;
            $img = wp_prepare_attachment_for_js ( $thumb_id ); // get image data array
            $image_attributes = wp_get_attachment_image_src( $img["id"], 'full' ); ?>
            <div class="ang-post-image-cover" style="background: url(<?php echo esc_url ($image_attributes[0]); ?>) no-repeat center / cover">
                <img src="<?php echo $image_attributes[0] ?>"
                     width="<?php echo $image_attributes[1] ?>"
                     height="<?php echo $image_attributes[2] ?>"
                     alt="<?php echo $img["alt"]; ?>"
                     title="<?php echo $img["title"];?>"
                     class="uk-visible-small">
                <?php if($woo_active && in_array( 'product', $args['post_type'])){
                        // define templates for 'WooCommmerce' plugin

                            // Sale label
                            print "<div class='ang-woo-sale'>";
                            woocommerce_get_template( 'loop/sale-flash.php' );
                            print "</div>";
                        }; 
                ?>
            </div>
        <?php endif; ?>
    </div>
</div>