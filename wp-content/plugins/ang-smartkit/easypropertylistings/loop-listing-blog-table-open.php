<?php
/**
 * Loop Property Template: Table Open
 *
 * @package easy-property-listings
 * @subpackage Theme
 */
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;
if (!function_exists("renter_call_tpl_table_open")) {

    function renter_call_tpl_table_open() {

        global $property;
        ?>

        <div id="post-<?php the_ID(); ?>" <?php post_class('epl-listing-post epl-property-blog epl-property-table epl-table epl-table-open epl-clearfix'); ?>>
            <?php do_action('epl_property_before_content'); ?>				
            <?php if (has_post_thumbnail()) : ?>
                <div class="epl-table-column-image property-featured-image-wrapper">
                    <a href="<?php the_permalink(); ?>">
                        <div class="epl-blog-image">
                            <div class="epl-stickers-wrapper">
                                <span class="uk-float-left"><?php echo epl_get_price_sticker(); ?></span>
                                <span class="uk-float-right"><?php echo ang_get_price_sticker_show(); ?></span>

                            </div>
                            <?php the_post_thumbnail('epl-image-medium-crop', array('class' => 'teaser-left-thumb')); ?>
                        </div>
                    </a>
                </div>
            <?php else: ?>
                <div class="epl-table-column-image property-featured-image-wrapper">
                    <a href="<?php the_permalink(); ?>">
                        <div class="epl-blog-image">
                            <div class="epl-stickers-wrapper">
                                <span class="uk-float-left"><?php echo epl_get_price_sticker(); ?></span>
                                <span class="uk-float-right"><?php echo ang_get_price_sticker_show(); ?></span>
                            </div>
                            <?php if (file_exists("wp-content/uploads/demo/imgo720x400.jpg")) { ?>
                                <img class="teaser-left-thumb ang-no-image" alt="alt" src="wp-content/uploads/demo/imgo720x400.jpg" width="720" height="400" />
                            <?php } else { ?>
                                <img class="teaser-left-thumb ang-no-image" alt="alt" src="<?php echo ang_load_img_url();?>imgo720x400.jpg" width="720" height="400" />
                            <?php } ?>
                        </div>
                    </a>
                </div>
            <?php endif; ?>

            <div class="epl-table-column-content property-box property-box-right property-content">
                <!-- Address -->
                <div class="epl-table-box epl-table-column epl-table-column-left">
                    <div class="epl-table-address"><a href="<?php the_permalink(); ?>"><?php do_action('epl_property_address'); ?></a></div>
                    <div class="property-feature-icons">
                        <?php do_action('epl_property_icons'); ?>				
                    </div>
                </div>
                <!-- Property Featured Icons -->
                <div class="epl-table-box epl-table-column epl-table-column-middle">
                    <?php do_action('epl_property_price'); ?>	
                </div>
                <!-- Price -->
                <div class="epl-table-box epl-table-column epl-table-column-right">
                    <?php do_action('epl_property_inspection_times'); ?>
                </div>
            </div>	
            <?php do_action('epl_property_after_content'); ?>
        </div>
        <?php
    }

}
renter_call_tpl_table_open();
