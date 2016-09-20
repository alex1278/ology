<?php
/**
 * Loop Property Template: Slim home open list
 *
 * @package easy-property-listings
 * @subpackage Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('3 epl-listing-post epl-property-blog epl-property-blog-slim epl-clearfix'); ?>>				
	<?php do_action('epl_property_loop_before_content'); ?>			
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="property-box slim property-box-left-slim property-featured-image-wrapper">
				<a href="<?php the_permalink(); ?>">
                                    <div class="epl-blog-image">
                                        <div class="epl-stickers-wrapper">
						<span class="uk-float-left"><?php echo epl_get_price_sticker(); ?></span>
                                                <span class="uk-float-right"><?php echo ang_get_price_sticker_show(); ?></span>
                                                    
					</div>
					<?php the_post_thumbnail( 'epl-image-medium-crop', array( 'class' => 'teaser-left-thumb' ) ); ?>
                                    </div>
                                </a>
			</div>
                <?php else: ?>
                        <div class="property-box slim property-box-left-slim property-featured-image-wrapper">
				<a href="<?php the_permalink(); ?>">
                                    <div class="epl-blog-image">
                                        <div class="epl-stickers-wrapper">
						<span class="uk-float-left"><?php echo epl_get_price_sticker(); ?></span>
                                                <span class="uk-float-right"><?php echo ang_get_price_sticker_show(); ?></span>
					</div>
                                        <?php
                                        if(file_exists("wp-content/uploads/demo/imgo720x400.jpg")){ ?>
                                            <img class="teaser-left-thumb ang-no-image" alt="alt" src="wp-content/uploads/demo/imgo720x400.jpg" width="720" height="400" />
                                        <?php }else { ?>
                                             <img class="teaser-left-thumb ang-no-image" alt="alt" src="<?php echo ang_load_img_url();?>imgo720x400.jpg" width="720" height="400" />
                                       <?php } ?>
                                    </div>
                                </a>
			</div>
		<?php endif; ?>

		<div class="property-box slim property-box-right-slim property-content">
			<!-- Heading -->
			<h3 class="entry-title"><a href="<?php the_permalink() ?>"><?php do_action('epl_property_heading'); ?></a></h3>
			<?php epl_the_excerpt(); ?>
		
                        <!-- Address -->
                        <div class="property-address">
                                <a href="<?php the_permalink(); ?>">
                                        <?php do_action('epl_property_tab_address'); ?>
                                </a>
                        </div>
		
			<!-- Home Open -->
			<?php do_action('epl_property_inspection_times'); ?>
			
			<!-- Property Featured Icons -->
			<div class="property-feature-icons">
				<?php do_action('epl_property_icons'); ?>						
			</div>
			
			<div class="price">
				<?php do_action('epl_property_price'); ?>
			</div>
		</div>
	<?php do_action('epl_property_loop_after_content'); ?>			
</div>
