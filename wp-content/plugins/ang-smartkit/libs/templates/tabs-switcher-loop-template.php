<?php
/*
 * Template: (Ajax page loader template)grid_parallax
 * Main query loop template: loop temolate for shortcode [main_query_posts], parent file: "query-posts-loop-shortcode.php"
 * 
 * @package      ANG Themes
 * @subpackage  Shortcode
 * 
 * @Author:     Aleksandr Glovatskyy
 * @date        12.03.2016
 */

?>
<div class="ang-tabs-switcher-wrapp <?php echo $template; ?> <?php if($woo_active) {echo 'woocommerce ';} echo $extra_class; ?>">
    <?php if($content){?>
        <div class="ang-short-descr uk-margin"><div class=""><?php echo $content; ?></div></div>
    <?php } ?>
    <?php   $query_open = new WP_Query( $args ); 
            $slide_count=0;
            if ( $query_open->have_posts() ) { ?>
                <div class="ang-tabs-switcher">
                    <div class="uk-grid <?php if($gutter != '') {echo ' uk-grid-'.$gutter;} ?>" data-uk-grid-margin="">
                        <div class="uk-width-1-1 <?php if($tab_position == 'right' || $tab_position == 'left'){ echo $uk_grid_small_first.$uk_grid_medium_first.$uk_grid_large_first.$uk_grid_xlarge_first ;}; if($tab_position == 'right'){ echo $uk_push;} ?>">
                            <div class="ang-switcher-buttons <?php if($center_tab) echo 'uk-tab-center';?>">
                                <ul class="<?php echo $toggle_mode; if($tab_grid) echo ' uk-tab-grid'; if($tab_position != '') {echo ' uk-tab-'.$tab_position;} ?>" <?php echo $data_attr ;?>>
                                    <?php while( $query_open->have_posts()) : $query_open->the_post(); ?>

                                    <li class="<?php if($tab_grid == true){ echo 'uk-width-1-'.$limit;} ?>">
                                        <a href="">
                                            <time datetime="<?php the_date('Y-m-d'); ?>" class=""><?php echo (get_post_meta(get_the_ID(), 'timeline', true)) ? get_post_meta(get_the_ID(), 'timeline', true) : get_post_meta(get_the_ID(), '_timeline', true) ?></time>
                                            <?php the_title(); ?>
                                        </a>
                                    </li>
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="uk-width-1-1 <?php if($tab_position == 'right' || $tab_position == 'left'){ echo $uk_grid_small_second.$uk_grid_medium_second.$uk_grid_large_second.$uk_grid_xlarge_second ;} if($tab_position == 'right'){ echo $uk_pull;}?>">
                            <ul id="<?php echo $connect_id; ?>" class="ang-ajax-container uk-switcher uk-margin">
                            <?php while ( $query_open->have_posts() ) {
                                          $query_open->the_post();

                                          //require post template
                                          switch ($template) {
                                                case "timeline":
                                                case "ology":
                                                    print '<li class="item-'.$slide_count.'">';
                                                            require load_template_path("tabs-switcher-{$template}.php");
                                                    print '</li>';
                                                break;
                                                default:
                                                    print '<li class="item-'.$slide_count.'">';
                                                    print '<p>Template name does not exist.</p>';          
                                                    print '</li>';
                                                break;
                                            }

                                          $slide_count++;
                                    } ?>
                        <!--        end of posts loop-->
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
            }
        wp_reset_postdata(); ?>  
</div>
<?php          
                    