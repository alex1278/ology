<?php
/*
 * Template: (Ajax page loader template) portfolio posts music template.
 * Main query loop template: loop temolate for shortcode [main_query_posts], parent file: "query-posts-post-loop-template.php", "query-posts-loop-shortcode.php"
 * 
 * @package     ANG Plugins
 * @subpackage  Shortcode
 * 
 * @Author:     Aleksandr Glovatskyy
 * @date        01.04.2016
 */

?>
    <article id="item-<?php the_ID(); ?>" <?php post_class('uk-article template-art'); ?> data-permalink="<?php the_permalink(); ?>">
        <div class="ang-article-content uk-position-relative uk-overflow-hidden">
        <?php if (has_post_thumbnail()) : ?>
            <?php
            $width = get_option('thumbnail_size_w'); //get the width of the thumbnail setting
            $height = get_option('thumbnail_size_h'); //get the height of the thumbnail settin
            ?>
                <div>
                    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                        <?php the_post_thumbnail('fashion-blog-loop', array('class' => 'tm-category-post-thumb')); ?>
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
                <div class="ang-noimage">
                    <a class="tm-category-post-thumb" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/no-image/noimg.svg" data-uk-svg alt="no-image" /></a>
                </div>
            <?php endif; ?>

        </div>
        <div class="uk-grid uk-grid-collapse ang-margin-top-minus-25" data-uk-grid-match>
            <div class="uk-width-1-3 uk-position-relative">
                <div class="uk-height-1-1 uk-width-1-1 uk-position-absolute">
                    <div class="ang-pseudo-square uk-height-1-1"></div>
                </div>
            </div>
            <div class="uk-width-2-3 uk-article-meta uk-margin-large-top">
                <h2 class="uk-article-title uk-margin-bottom-remove"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                <?php
                    $post_id = get_the_ID();
                    $url = get_post_meta( $post_id, '_tzp_portfolio_url', true);
                    $date = get_post_meta( $post_id, '_tzp_portfolio_date', true);
                    $client = get_post_meta( $post_id, '_tzp_portfolio_client', true);

                    if( $url || $date || $client || $woo_active ) {
                        print '<div class="portfolio-entry-meta">';

                                if( $url || $client ) {
                                    print sprintf( '<a class="portfolio-project-url" href="%1$s" onclick="window.open(this.href); return false;">%2$s</a>', esc_url( $url ), esc_html($client) );
                                }
                                if( $date ) {
                                    print sprintf( '<span>%1$s</span><span class="portfolio-project-date">%2$s</span>', '/', esc_html( $date ) );
                                }
                                
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
                        print '</div>';
                    }
                ?>
            </div>
        </div>
</article>
<?php          
                    