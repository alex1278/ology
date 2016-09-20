<?php
/**
 * Archive Template for Custom Post Types
 */
 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
 
get_header(); ?>
<section id="primary" class="11111 site-content content epl-archive-default <?php echo epl_get_active_theme_name(); ?>">
	<div id="content" role="main">
		<?php
		if ( have_posts() ) : ?>
			<div class="loop pad">
				<header class="archive-header entry-header loop-header underlined-header">
                                    <h3 class="uk-panel-title archive-title loop-title uk-margin-remove">
                                        <span>
						<?php
							the_post();
							 
							if ( is_tax() && function_exists( 'epl_is_search' ) && false == epl_is_search() ) { // Tag Archive
								$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
								$title = sprintf( esc_html__( 'Property in %s', 'renter'), $term->name );
							}
							else if ( function_exists( 'epl_is_search' ) && epl_is_search() ) { // Search Result
								$title = esc_html__( 'Search Result', 'renter');
							}
							
							else if ( function_exists( 'is_post_type_archive' ) && is_post_type_archive() && function_exists( 'post_type_archive_title' ) ) { // Post Type Archive
								$title = post_type_archive_title( '', false );
							} 
							
							else { // Default catchall just in case
								$title = esc_html__( 'Listing', 'renter');
							}
							
							if ( is_paged() )
								printf( '%s &ndash; Page %d', $title, get_query_var( 'paged' ) );
							else
								echo esc_attr($title);
							
							rewind_posts();
						?>
                                        </span>
                                    </h3>
				</header>
				
				<div class="entry-content loop-content  epl-shortcode-listing">
					<?php do_action( 'epl_property_loop_start' ); ?>

					<?php while ( have_posts() ) : // The Loop
							the_post();
							do_action('epl_property_blog');
						endwhile; // end of one post
					?>
					<?php do_action( 'epl_property_loop_end' ); ?>
				</div>
				
				<div class="loop-footer">
					<!-- Previous/Next page navigation -->
                                        <div class="loop-footer">
                                                <?php do_action('epl_pagination', array('query'	=>	$wp_query)); ?>
                                        </div>

				</div>
			</div>
		<?php 
		else :
			?><div class="hentry">
				<div class="entry-header clearfix">
					<h3 class="entry-title"><?php esc_html_e('Listing not Found', 'renter'); ?></h3>
				</div>
				
				<div class="entry-content clearfix">
					<p><?php esc_html_e('Listing not found, expand your search criteria and try again.', 'renter'); ?></p>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>
<?php
get_sidebar();
get_footer(); 
