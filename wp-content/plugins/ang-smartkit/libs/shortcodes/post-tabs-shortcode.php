<?php

/**
 * SHORTCODE :: Displays Latest posts from selected category, tab mode [latest_post_tab]
 *
 * @package     ANG Plugins
 * @subpackage  Shortcode/tabs
 * @copyright   Copyright (c) 2016, Aleksandr Glovatskyy
 * @since       1.1.1
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
// Only load on front
if( is_admin() ) {
	return;
}

/* Displays Latest posts from selected category in tabs style */
    function latest_post_tab_short($atts, $content = null){
        extract(shortcode_atts(array(
            'ex_class' => '',
            'number_of_posts' => '3',
            'category_id' => array(),
        ), $atts));
        
        ob_start();
        
        if($number_of_posts > 6){
            $number_of_posts = 6;
        }elseif($number_of_posts < 1){
            $number_of_posts = 1;
        }else{
            $number_of_posts;
        }
        $args = array (
                'cat'               => $category_id,
                'posts_per_page'    => $number_of_posts
        ); ?>

        <p class='ang-short-descr'><?php echo $content; ?></p>
        <?php $query = New WP_Query($args ); ?>

        <div class="ang-tab-wrap <?php print $ex_class; ?>">
            <ul class="uk-tab uk-tab-grid" data-uk-tab="{connect:'#ang-tab-cont'}">
                <?php if( $query->have_posts()): while( $query->have_posts()): $query->the_post(); ?>
                
                <li class="uk-width-1-<?php echo $number_of_posts; ?>">
                    <a href=""><?php the_title(); ?></a>
                </li>
                <?php endwhile;?>
                <?php endif; ?>
            </ul>
            <ul id="ang-tab-cont" class="uk-switcher">
                
                <?php if( $query->have_posts()): while( $query->have_posts()): $query->the_post(); ?>
                
                <li>
                    <article class="ang-tab-content">
                        <?php the_post_thumbnail ('thumbnail', array('class' => 'alignleft tm-tab-content-thumb ')); ?>
                        <?php the_content(); ?>
                    </article>
                </li>
                <?php endwhile; ?>
                <?php endif; ?>
            </ul>
        </div>
        <?php wp_reset_postdata();
        return ob_get_clean();
    }
    add_shortcode('latest_post_tab', 'latest_post_tab_short');
