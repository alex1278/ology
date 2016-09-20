<?php
/*
 * Template (Ajax page loader template)
 * Main gallery loop template: Gallery default
 * Date:        20.03.2015
 * Version:     1.0.0
 * @package ANG Themes
 * @subpackage Theme
 * 
 * Author: Aleksandr Glovatskyy
 */

?>
<div class="uk-grid">
        <div class="uk-width-1-1 ang-main-gal-wrap uk-nbfc <?php echo $extra_class; ?>">  
            <?php if($post_type && $filter === 'on'){ ?>
                <div class="ang-portfolio-gallery-filter-wrap">
                    <ul id="ang-property-gallery-filter" class="uk-subnav uk-subnav-pill">
                        <li class="uk-active" data-uk-filter="">
                            <a class="uk-button uk-button-primary" href="#"><?php esc_html_e("All", 'ang-plugins'); ?></a>
                        </li>
                        <?php
                        foreach ($post_type as $p_type) { ?>
                        <li class="" data-uk-filter="<?php echo $p_type; ?>" >
                            <a class="uk-button uk-button-primary" href="#"><?php echo str_ireplace("_", " ", $p_type); ?></a>
                        </li>
                     <?php  }
                        ?>
                         
                    </ul>
                </div>

            <?php } ?>
            <div id="ang-portfolio-gallery-content" class="ang-main-gallery" >
                    
                <?php $query_open = new WP_Query( $args ); 
                      $count=0;
                    if ( $query_open->have_posts() ) {  ?>
                        <div class="ang-ajax-container uk-grid-width-1-1 <?php echo $uk_grid_small.$uk_grid_medium.$uk_grid_large.$uk_grid_xlarge ;?>" data-uk-grid="{<?php print $uk_flex_gutter; ?> controls: '#ang-property-gallery-filter', animation: 'uk-animation-fade'}">
                        <?php while ( $query_open->have_posts() ) {
                                $query_open->the_post();
                                
                                require load_template_path("gallery-{$template}-post-template.php");
                        }
                        ?>
                        </div>
                <!--                            end of posts loop-->
                <?php
                        if($pagination === 'on'){
                                    do_action('paginate_my_plugin', $query_open); // warp wp  pagination
                        }elseif($pagination === 'ajax'){
                            print '<div class="uk-position-relative">';
                                    do_action('renter_gallery_ajax_pagination',  $template_ajax_ANG = $template, $wp_img_size, $overlay_cls, $title, $lightbox, $link, array('query' => $query_open)); //ajax pagination
                            print '</div>';
                        }elseif($pagination === 'both'){
                            print '<div class="uk-position-relative">';
                                    do_action('renter_gallery_ajax_pagination',  $template_ajax_ANG = $template, $wp_img_size, $overlay_cls, $title, $lightbox, $link, array('query' => $query_open)); //ajax pagination
                            print '</div>';
                                    do_action('paginate_my_plugin', $query_open); // warp wp  pagination
                        }else{}
                    
                    /**/
                    } 
                    wp_reset_postdata(); ?>
            </div>             
        </div>
    </div>
<?php          
                    