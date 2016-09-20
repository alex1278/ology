<?php
/*
 * Template: (Ajax page loader template) NightLife template.
 * Main query loop template: loop temolate for shortcode [main_query_posts], parent file: "query-posts-post-loop-template.php", "query-posts-loop-shortcode.php"
 * 
 * @package     ANG Plugins
 * @subpackage  Shortcode
 * 
 * @Author:     Aleksandr Glovatskyy
 * @date        01.04.2016
 */

?>
    <article id="item-<?php the_ID(); ?>" <?php post_class('uk-article template-night'); ?> data-permalink="<?php the_permalink(); ?>">
        <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
            <div class=" uk-width-small-1-3">
                <div class="ang-article-content uk-position-relative uk-overflow-hidden">
                <?php if (has_post_thumbnail()) : ?>
                    <?php
                    $width = get_option('thumbnail_size_w'); //get the width of the thumbnail setting
                    $height = get_option('thumbnail_size_h'); //get the height of the thumbnail settin
                    ?>
                        <div class="ang-event-image-cover">
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
                        <div class="ang-event-image-cover ang-noimage">
                            <a class="tm-category-post-thumb" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/no-image/noimg.svg" data-uk-svg alt="no-image" /></a>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
            <div class="uk-width-small-2-3 uk-flex uk-flex-bottom">
            <div class="uk-article-meta uk-clearfix">
            
            <?php
                $post_id = get_the_ID();

                // meta fields from 'zillaportfolio' plugin
                $url = get_post_meta( $post_id, '_tzp_portfolio_url', true);
                $date = get_post_meta( $post_id, '_tzp_portfolio_date', true);
                $client = get_post_meta( $post_id, '_tzp_portfolio_client', true);

                // meta fields from 'very-simple-event-list' plugin
                $event_start_date = get_post_meta( $post_id, 'event-start-date', true );
                $event_date = get_post_meta( $post_id, 'event-date', true );
                $event_location = get_post_meta( $post_id, 'event-location', true ); 

                if( $url || $date || $client || $event_start_date || $event_location || $woo_active) {
                    print '<div class="portfolio-entry-meta">';
                            //portfolio
                            if( $url || $client ) {
                                print sprintf( '<a class="portfolio-project-url" href="%1$s" onclick="window.open(this.href); return false;">%2$s</a>', esc_url( $url ), esc_html($client) );
                            }
                            if( $date ) {
                                print sprintf( '<span>%1$s</span><span class="portfolio-project-date">%2$s</span>', '/', esc_html( $date ) );
                            }
                            // event

                            if( $event_location ) {
                                print sprintf( '<div class="vsel-meta-location">%1$s</div>', esc_html( $event_location ) );
                            }
                            if( $event_start_date ) {
                                if ($event_start_date >= $event_date) {
                                        print '<div class="vsel-meta-date">' . sprintf(esc_attr__( 'Date: %s', 'very-simple-event-list' ), date_i18n( get_option( 'date_format' ), esc_attr($event_start_date) ) ) . '</div>';
                                } else {
                                        print '<div class="vsel-meta-date">' . sprintf(esc_attr__( 'Start date: %s', 'very-simple-event-list' ), date_i18n( get_option( 'date_format' ), esc_attr($event_start_date) ) ) . '</div>';
                                }
                            }
                            // WooCommerce Products
                    if($woo_active && in_array( 'product', $args['post_type'])){
                       // define templates for 'WooCommmerce' plugin
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
        </div>
        <div class="uk-grid uk-grid-medium">
            <div class="uk-width-small-1-3">
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

                    }
                ?>
            </div>
            <div class="uk-width-small-2-3">
                <h2 class="uk-article-title uk-margin-small-bottom"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            </div>
        </div>
    </article>
<?php          
                    