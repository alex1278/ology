<?php
/*
 * Single Property Template: Expanded
 *
 * @package easy-property-listings
 * @subpackage Theme
 */
?>

<div id = "post-<?php the_ID(); ?>" <?php post_class('epl-listing-single epl-property-single view-expanded underlined-header ang-property-article'); ?>>
    <div class="entry-header epl-header epl-clearfix">

        
        <!-- heading -->
        <div class="epl-tab-section epl-section-property-details">
            <div class="tab-content">
                
                <div class="uk-margin-bottom ang-property-pricing-details uk-grid-small uk-flex uk-flex-wrap uk-flex-space-between"  data-uk-grid-margin>

                    <div class="property-feature-icons epl-clearfix">
                        <?php //do_action('epl_property_icons'); ?>				
                        <?php do_action('ang_property_icons_notext'); ?>				
                    </div>
                    <?php do_action('epl_property_price_before'); ?>
                    <div class="ang-property-meta">
                        <?php do_action('epl_property_price'); ?>
                    </div>
                    <?php do_action('epl_property_price_after'); ?>
                </div>
                
                <?php do_action('epl_property_featured_image'); ?>
                
                <div class="uk-margin-large-top uk-grid-small uk-flex uk-flex-wrap uk-flex-space-between"  data-uk-grid-margin>
                    <?php do_action('ang_inspection_times'); ?>
                    <div class="ang-property-category-wrapper">
                        <?php do_action('epl_property_land_category'); ?>
                        <?php do_action('epl_property_commercial_category'); ?>
                    </div>
                </div>
                <div class="tab-address">
                    <p>
                        <?php do_action('epl_property_address'); ?>
                        <a href="#property-map" title="<?php esc_html_e('Go to map', 'renter'); ?>" data-uk-smooth-scroll><?php esc_html_e('View on map', 'renter'); ?></a>
                        <!--<a href="#property-video" title="Go to video" data-uk-smooth-scroll>Watch video</a>-->
                    </p>

                </div>
            </div>
        </div>
    </div>


    <div class="epl-content epl-clearfix">

        <div class="tab-wrapper">

            <div class="epl-tab-section epl-section-description">
<!--                <h3 class="uk-panel-title">
                    <span>
                    <?php //echo apply_filters('epl_property_tab_title_description', esc_html__('Description', 'renter')); ?>
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

            <?php //do_action( 'epl_property_gallery' );  ?>

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

    <?php edit_post_link(esc_html__('Edit this post.', 'renter'), '<p class="uk-clearfix"><i class="uk-icon-pencil"></i> ', '</p>'); ?>

    <?php do_action('ang_similar_properties_filter'); //ang  ?>

    <?php
    $prev = get_previous_post();
    $next = get_next_post();
    ?>
    <?php if ($prev || $next) : ?>
        <div class="ang-pagination-wrap">
            <ul class="uk-pagination uk-margin-remove uk-clearfix">
                <?php if ($prev) : ?>
                    <li class="uk-pagination-previous">
                        <a class="uk-button" href="<?php echo get_permalink($prev->ID) ?>" title="<?php echo esc_html__('Previous', 'renter'); ?>">

                            <?php echo esc_html__('Previous', 'renter'); ?>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if ($next) : ?>
                    <li class="uk-pagination-next">
                        <a class="uk-button" href="<?php echo get_permalink($next->ID) ?>" title="<?php echo esc_html__('Next', 'renter'); ?>">
                            <?php echo esc_html__('Next', 'renter'); ?>

                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- categories, tags and comments -->
    <div class="entry-footer epl-clearfix">
        <div class="entry-meta">

            <?php //comments_template(); ?>
            <?php
            wp_link_pages(array(
                'before'         => '<div class="entry-utility entry-pages">' . esc_html__('Pages:', 'renter') . '',
                'after'          => '</div>', 'next_or_number' => 'number'
            ));
            ?>		
        </div>
    </div>
</div>
<!-- end property -->