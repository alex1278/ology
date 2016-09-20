<?php
/**
 * Loop Property Template: Default Compatibility
 *
 * @package easy-property-listings
 * @subpackage Theme
 */
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;
if (!function_exists("renter_call_tpl_default_compat")) {

    function renter_call_tpl_default_compat() {

        global $property;
        ?>

        <div id="post-<?php the_ID(); ?>" <?php post_class(' 5 epl-listing-post epl-property-blog epl-property-blog-compatibility epl-clearfix'); ?>>
            <?php do_action('epl_property_before_content'); ?>				

            <div class="property-box property-box-left<?php do_action('epl_compatibility_archive_class'); ?> property-featured-image-wrapper">
                <?php do_action('epl_property_archive_featured_image'); ?>
                <!-- Home Open -->
                <?php do_action('epl_property_inspection_times'); ?>
            </div>


            <div class="property-box property-box-right<?php do_action('epl_compatibility_archive_class'); ?> property-content">
                <!-- Heading -->
                <h3 class="entry-title"><a href="<?php the_permalink() ?>"><?php do_action('epl_property_heading'); ?></a></h3>
                <div class="entry-content">
                    <?php epl_the_excerpt(); ?>
                </div>
                <!-- Address -->
                <div class="property-address">
                    <a href="<?php the_permalink(); ?>">
                        <?php do_action('epl_property_address'); ?>
                    </a>
                </div>
                <!-- Property Featured Icons -->
                <div class="property-feature-icons">
                    <?php do_action('epl_property_icons'); ?>				
                </div>
                <!-- Price -->
                <div class="price">
                    <?php do_action('epl_property_price'); ?>
                </div>
            </div>	
            <?php do_action('epl_property_after_content'); ?>
        </div>
        <?php
    }

}
renter_call_tpl_default_compat();
