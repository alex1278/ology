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
<div class="ang-query-posts-wrapp <?php if($woo_active) echo 'woocommerce'; echo $extra_class; ?>">
        <?php if($content){?>
            <div class="uk-grid uk-grid-width-1-1"><div class="ang-short-descr uk-text-center uk-margin-bottom"><?php echo $content; ?></div></div>
        <?php } ?>
        <?php   $query_open = new WP_Query( $args ); 
                $slide_count=0;
                if ( $query_open->have_posts() ) { ?>
                    <div class="ang-ajax-container uk-grid <?php if($gutter != '') {echo 'uk-grid-'.$gutter;} ?> uk-grid-width-1-1 <?php echo $uk_grid_small.$uk_grid_medium.$uk_grid_large.$uk_grid_xlarge ;?>" <?php if($grid_parallax !='') {echo 'data-uk-grid-parallax="{translate:'.$grid_parallax.'}"';} ?> data-uk-grid-margin data-uk-grid-match="{target:'article'}">
                    <?php while ( $query_open->have_posts() ) {
                                  $query_open->the_post();
                                  
                                  //require post template
                                  switch ($template) {
                
                                        case "art_blog":
                                        case "literary_blog":
                                        case "fashion_blog":
                                        case "night_blog":
                                        case "music_blog":
                                        case "photo_blog":
                                        case "art":
                                        case "literary":
                                        case "fashion":
                                        case "night":
                                        case "music":
                                        case "event":
                                        case "classes":
                                            print '<div class="item-'.$slide_count.'" '.$blog_animation.'>';
                                                    require load_template_path("query-posts-{$template}.php");
                                            print '</div>';
                                            break;

                                        case "post":
                                            print '<div class="item-'.$slide_count.'" '.$blog_animation.'>';
                                                    require get_stylesheet_directory()."/layouts/_post.php";
                                            print '</div>';
                                            break;

                                        default:
                                            print '<div class="item-'.$slide_count.'" '.$blog_animation.'>';
                                                    require get_stylesheet_directory().'/layouts/_post.php';
                                            print '</div>';
                                            break;
                                    }
                                    
                                  $slide_count++;
                            } ?>
                <!--        end of posts loop-->
                    </div>
                    <?php 
                    if($pagination === 'on'){
                                do_action('paginate_my_plugin',$query_open); // warp wp  pagination
                    }elseif($pagination === 'ajax'){
                        print '<div class="uk-position-relative">';
                                do_action('ANG_ajax_pagination',  $template_ajax_ANG = $template, $blog_animation, $wp_img_size, $overlay_cls, $title, $lightbox, $link, array('query' => $query_open)); //ajax pagination
                        print '</div>';
                    }elseif($pagination === 'both'){
                                
                        print '<div class="uk-position-relative">';
                                do_action('ANG_ajax_pagination',  $template_ajax_ANG = $template, $blog_animation, array('query' => $query_open)); //ajax pagination
                        print '</div>';
                                do_action('paginate_my_plugin',$query_open); // warp wp  pagination
                    }else{}
                }
            wp_reset_postdata(); ?>  
    </div>
<?php          
                    