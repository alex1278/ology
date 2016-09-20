<?php
/*
 * Single Property Template: Expanded Compatibility
 *
 * @package easy-property-listings
 * @subpackage Theme
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('epl-listing-single epl-property-single view-expanded epl-property-single-compatibility underlined-header'); ?>>
    <div class="entry-header epl-header epl-clearfix">

        <?php do_action('epl_property_featured_image'); ?>
        <!-- heading -->
        <div class="epl-tab-section epl-section-property-details">
            <div class="tab-content">
                <div class="ang-epl-heading uk-grid-small uk-flex uk-flex-wrap uk-flex-space-between"  data-uk-grid-margin>
                    <h3 class="entry-title"><?php do_action('epl_property_heading'); ?></h3>

                    <?php do_action('epl_property_price_before'); ?>
                    <div class="ang-property-meta">
                        <?php do_action('epl_property_price'); ?>
                    </div>
                    <?php do_action('epl_property_price_after'); ?>

                    <h4 class="secondary-heading"><?php do_action('epl_property_secondary_heading'); ?></h4>
                </div>
                <div class="ang-property-pricing-details uk-grid-small uk-flex uk-flex-wrap uk-flex-space-between"  data-uk-grid-margin>

                    <div class="property-feature-icons epl-clearfix">
                        <?php do_action('epl_property_icons'); ?>				
                    </div>
                    <?php
                    $author_id = get_the_author_meta('ID');
                    if (get_the_author_meta('contact-form', $author_id) != '') {
                        ?>
                        <div class="ang-author-contact-form author-id-<?php echo esc_attr($author_id); ?>">
                            <button class="uk-button uk-button-primary uk-float-right uk-width-1-1" data-uk-modal="{target:'#book-modal'}"><?php esc_html_e('Book Now', 'renter'); ?></button>
                        </div>

                    <?php } ?>
                </div>
                <div id="book-modal" class="uk-modal">
                    <div class="uk-modal-dialog">
                        <button type="button" class="uk-modal-close uk-close"></button>
                        <div class="uk-modal-header">
                            <h3 class="uk-panel-title uk-margin-bottom"><span><?php esc_html_e('Contact', 'renter'); ?> <?php echo get_the_author_meta('display_name', $author_id); ?></span></h3>
                        </div>
                        <?php echo do_shortcode(get_the_author_meta('contact-form', $author_id)); ?>
                    </div>
                </div>
                <div class="tab-address">
                    <p>
                        <?php do_action('epl_property_address'); ?>
                        <a href="#property-map" title="<?php esc_html_e('Go to map', 'renter'); ?>" data-uk-smooth-scroll><?php esc_html_e('View on map', 'renter'); ?></a>
                        <!--<a href="#property-video" title="Go to video" data-uk-smooth-scroll>Watch video</a>-->
                    </p>

                </div>
                <div class="uk-grid-small uk-flex uk-flex-wrap uk-flex-space-between"  data-uk-grid-margin>
                    <?php do_action('ang_inspection_times'); ?>
                    <div class="ang-property-category-wrapper">
                        <?php do_action('epl_property_land_category'); ?>
                        <?php do_action('epl_property_commercial_category'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="entry-content epl-content epl-clearfix">

        <div class="tab-wrapper">

            <div class="epl-tab-section epl-section-description">
<!--                <h3 class="uk-panel-title">
                    <span>
                        <?php// echo apply_filters('epl_property_tab_title_description', esc_html__('Description', 'renter')); ?>
                    </span>
                </h3>-->
                <div class="tab-content">
                    <?php
                    do_action('epl_property_content_before');

                    do_action('epl_property_the_content');
                    ?>
                </div>
            </div>

            <?php do_action('epl_property_tab_section_before'); ?>
            <div class="epl-tab-section epl-tab-section-features">
                <?php do_action('epl_property_tab_section'); ?>
            </div>
            <?php do_action('epl_property_tab_section_after'); ?>

            <?php //do_action( 'epl_property_gallery' );   ?>

            <?php do_action('epl_property_content_after'); ?>

            <?php if (get_post_meta(get_the_ID(), 'property_address_coordinates', true) != ""): ?>
                <div class="epl-tab-section ang-location-box uk-clearfix">
                    <h3 id="property-map" class="uk-panel-title"><span><?php esc_html_e('Location on Map', 'renter'); ?></span></h3> 
                    <?php do_action('epl_property_map'); ?> 
                </div>
            <?php endif; ?>
            <?php do_action('epl_single_extensions'); ?>

            <?php do_action('epl_single_before_author_box'); ?>
            <?php do_action('epl_single_author'); ?>
            <?php do_action('epl_single_after_author_box'); ?>

        </div>

        <div class="epl-tab-section ang-editional-links-box uk-clearfix">
            <div class="uk-grid">
                <div class="uk-width-1-1 uk-width-medium-1-2 ang-partner-links-wrap">
                    <div class="uk-align-medium-left ">
                        <?php do_action('ang_partners_link'); ?>
                    </div>
                </div>
                <div class=" uk-width-1-1 uk-width-medium-1-2 ang-external-links-wrap">
                    <div class="uk-align-medium-right">
                        <?php do_action('ang_external_link'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- categories, tags and comments -->
    <div class="entry-footer epl-clearfix">
        <div class="entry-meta">
            <?php wp_link_pages(array('before' => '<div class="entry-utility entry-pages">' . esc_html__('Pages:', 'renter') . '', 'after' => '</div>', 'next_or_number' => 'number')); ?>		
        </div>
    </div>
</div>
<!-- end property -->
