<?php
/**
 * Loop Property Template: Default
 *
 * @package easy-property-listings
 * @subpackage Theme
 */
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;
if (!function_exists("renter_call_tpl_default")) {

    function renter_call_tpl_default() {


        global $property;
        ?>

        <div id="post-<?php the_ID(); ?>" <?php post_class('4 epl-listing-post epl-property-blog epl-clearfix'); ?>>
            <?php do_action('epl_property_before_content'); ?>				
            <div class="ang-property-blog-cover uk-flex uk-flex-bottom 4444444444444444444444444">
                <div class="property-box property-box-left property-featured-image-wrapper">
                    <?php do_action('epl_property_archive_featured_image'); ?>
                    <!-- Home Open -->
                    <?php //do_action('epl_property_inspection_times'); ?>
                    <div class="ang-overlay-archive-icons">
                        <div class="property-feature-icons epl-clearfix">			
                            <?php do_action('ang_property_icons_notext'); ?>				
                        </div>
                    </div>

                </div>


                <div class="property-box property-box-right property-content">
                    <!-- Heading -->
                    <div class="uk-clearfix">
                        <h3 class="entry-title"><a href="<?php the_permalink() ?>"><?php do_action('epl_property_heading'); ?></a></h3>


                        <!-- Property Featured Icons -->
                        <div class="property-feature-icons">
                            <?php do_action('ang_property_icons_notext'); ?>
                        </div>
                    </div>
                    
                    <!-- Address -->
                    <div class="property-address">
                        <a href="<?php the_permalink(); ?>">
                            <?php do_action('epl_property_address'); ?>
                        </a>
                    </div>

                    <div class="entry-content">
                        <?php epl_the_excerpt(); ?>
                    </div>
                    
                    <!-- Price -->
                    <div class="uk-clearfix">
                        <div class="price">
                            <?php do_action('epl_property_price'); ?>
                        </div>
                        <div class="ang-details">
                            <a class="uk-float-right" href="<?php the_permalink() ?>"><?php esc_html_e('Details ', 'renter') ;?><span>&nbsp;></span></a>
                        </div>
                    </div>
                </div>	
                <?php do_action('epl_property_after_content'); ?>
            </div>
        </div>
        <?php
    }

}
renter_call_tpl_default();
