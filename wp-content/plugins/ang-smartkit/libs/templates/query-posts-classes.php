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
    <article id="item-<?php the_ID(); ?>" <?php post_class('uk-article template-classes'); ?> data-permalink="<?php the_permalink(); ?>">
    
        <h5 class="uk-article-title uk-margin-remove"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
        <?php 
            $post_id = get_the_ID();
            //$metas = get_post_meta( $post_id);
            $organizerID = get_post_meta( $post_id, '_EventOrganizerID', true);
            
            if( $organizerID > 0 ){
                $organizer = get_the_title( $organizerID );
                    
                    print sprintf( '<div class="uk-margin-bottom ang-classes-teacher">%1$s <span class="ang-classes-teacher-name">%2$s</span></div>', esc_html__( 'Teacher:', 'ang-smartkit' ), esc_html($organizer) );
		}
        ?>
        <div class="ang-article-content uk-position-relative uk-overflow-hidden">
        <?php if (has_post_thumbnail()) : ?>

                <div class="ang-post-image-cover">
                    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                        <?php the_post_thumbnail($wp_img_size, array('class' => 'tm-category-post-thumb')); ?>
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
            
        </div>
        <?php 
            $exp = get_the_excerpt();
            print "<div class='ang-classes-excerpt'>".do_shortcode($exp). "</div>";
            
            // tribe_events CPT meta fields. Plugin "The event Calendar".
            $rating = get_post_meta( $post_id, 'event_rating', true );
            $cost = get_post_meta( $post_id, '_EventCost', true);
            $currency = get_post_meta( $post_id, '_EventCurrencySymbol', true);
            $currency_position = get_post_meta( $post_id, '_EventCurrencyPosition', true);

            $classes_cost = ($currency_position == 'prefix') ? "<span class='ang-classes-currensy'>".esc_html($currency)."</span><span class='ang-classes-cost'>".esc_html($cost)."</span>" : "<span class='ang-classes-cost'>".esc_html($cost)."</span><span class='ang-classes-currensy'>".esc_html($currency)."</span>";

            //ang_debug(get_post_custom( $post_id ));
            //ang_debug($organizerID );
            //ang_debug($organizer );
            
            if( $rating || $cost) {
                print '<div class="ang-classes-meta uk-clearfix">';
                    if($rating){
                        print "<div class='uk-display-inline-block ang-classes-star-rating'>";
                        $unrating = 5 - $rating;
                            for( $i = 0; $i < $rating; $i++ ){
                                print "<span class='ang-icon-star'><i class='uk-icon-star'></i></span>";
                            }
                            for( $i = 0; $i < $unrating; $i++ ){
                                print "<span class='ang-icon-star-o'><i class='uk-icon-star-o'></i></span>";
                            }
                        print "</div>";
                    }
                    if($cost){
                        print "<div class='uk-display-inline-block uk-float-right ang-classes-price'>{$classes_cost}</div>";
                    }
                print '</div>';
            }
        ?>
        
        <?php

            // event meta
            $url = get_post_meta( $post_id, '_tzp_portfolio_url', true);
            $date = get_post_meta( $post_id, '_tzp_portfolio_date', true);
            $client = get_post_meta( $post_id, '_tzp_portfolio_client', true);

            if( $url || $date || $client || $woo_active) {
                print '<div class="uk-article-meta uk-clearfix"><div class="portfolio-entry-meta">';

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
                print '</div></div>';
            }
        ?>
</article>
<?php          
                    