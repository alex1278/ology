<?php

/**
 * SHORTCODE :: Custom Search  Form [custom_search_form]
 *
 * @package     main query loop
 * @subpackage  Shortcode/main query/ ANG
 * @copyright   Copyright (c) 2016, Aleksandr Glovatskyy
 * @since       1.0.0
 * @version     1.0.0
 * @date        10.08.2016
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * This shortcode allows you to specify post(s)
 * Custom Search Shortcode:
 * [ custom_search_form ]  
 * Custom Search Shortcode with parameters:
 * [ custom_search_form post_type="post" button='' label='search' extra_class='my-custom-search' ]
 */

// Only load on front
if( is_admin() ) {
	return;
}

/* Displays Latest posts from selected category in tabs style */
    
function ang_wp_custom_search($atts, $content = null){
        extract(shortcode_atts(array(
                'post_type'                     =>	'any', // Any post type like "portfolio", "event", "testimonial", "slideshow", "product" - WooCommerce ready. Default is "post".
                'taxonomy'              	=>	'', // Any Taxonomy from custom post type. Should be a name like 'fashion', enter only one taxonomy name. ('people', 'emotions', 'animals'). For 'event' CPT use 'event_cat' taxonomy.
                'taxonomy_term'              	=>	'', // Any Taxonomy terms from custom post type. Should be a name like 'fashion' or string of terms separated by comma. For 'event' CPT use 'event_cat' taxonomy terms.
                'button'                        =>      'Search', // true , false
                'label'                         =>      'Search', // true , false
                'placeholder'                   =>      'Search', // true , false
                'extra_class'                   =>      '', // Enter extra class for custom styling.
                
	), $atts ) );
	
        ob_start();
?>
        <div class="ang-search-form-wrapp <?php echo $extra_class; ?>">
            <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>">
                <div>
                    <?php if ($label != ''){ ?>
                        <p class="ang-custom-search-input">
                            <label for="s"><?php echo $label; ?></label>
                        </p>
                    <?php } ?>
                        <span>
                            <input type="text" placeholder="<?php echo $placeholder; ?>" value="" name="s" id="s" />
                        </span>
                    <input type="hidden" value="1" name="sentence" />
                    <input type="hidden" value="<?php echo $post_type; ?>" name="post_type" />
                    <?php if ($taxonomy != ''){ ?>
                    <input type="hidden" value="<?php echo $taxonomy_term; ?>" name="<?php echo $taxonomy; ?>" />
                    <?php } ?>
                    <?php if ($button !=''){ ?>
                        <p class="ang-custom-search-submit">
                            <span>
                                <input type="submit" id="searchsubmit" value="<?php echo $button; ?>" />
                            </span>
                        </p>
                    <?php } ?>
                </div>
            </form>
        </div>
    <?php 
        return ob_get_clean();
    }
    add_shortcode('custom_search_form', 'ang_wp_custom_search');