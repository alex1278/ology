<?php
/*
 * Template (Ajax page loader template)
 * Main gallery loop template: Gallery default
 * 
 * @package ANG Themes
 * @subpackage Theme
 * 
 * Author: Aleksandr Glovatskyy
 */

$sizes_arr = array('size11','size12','size13','size21','size22','size23','size31','size32','size33');
$number = count($sizes_arr) - 1;
?>

    <div class="uk-grid">
        <div class="uk-width-1-1 ang-main-gal-wrap <?php echo $extra_class; ?>">
           
            <div class="layout <?php if($wall_fit == 'height')echo 'uk-height-viewport ang-freewall-fit-height';?>  ">
                <?php if($taxonomy_term && $filter === 'on'){ ?>
                    <div class="ang-portfolio-gallery-filter-wrap uk-container uk-container-center">
                        <ul id="ang-portfolio-gallery-filter" class="uk-subnav uk-subnav-pill filter-items">
                            <li class="filter-label active">
                                <span class="" href="#"><?php esc_html_e("All", 'ang-plugins'); ?></span>
                            </li>
                            <?php
                                foreach ($taxonomy_term as $portfolio_t) { ?>
                                <li class="filter-label" data-filter=".<?php echo $portfolio_t; ?>">
                                    <span class="" href="#"><?php echo str_ireplace("_", " ", $portfolio_t); ?></span>
                                </li>
                             <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <div id="ang-portfolio-freewall-content" class="ang-main-gallery uk-width-1-1 <?php echo $template; ?> <?php if($wall_fit == 'zone')echo 'uk-height-viewport'; ?>">
                    <?php $query_open = new WP_Query( $args ); 
                        $count=0;
                        if ( $query_open->have_posts() ) { ?>
                            <div id="freewall" class="uk-width-1-1 uk-height-1-1 free-wall" >
                            <?php while ( $query_open->have_posts() ) {
                                        $query_open->the_post();
                                        $count++;
                                        require load_template_path("gallery-{$template}-post-template.php");
                                    } ?>
                <!--        end of all posts loop-->
                            <?php if($pagination === 'on'){
                                print '<div class="brick size11 add-more uk-position-relative">';
                                        do_action('portfolio_gallery_freewall_ajax_pagination',  $template_ajax_ANG = $template, array('query' => $query_open)); // ajax pagination
                                print '</div>';
                                } ?>
                            </div>
                    <?php   }
                    wp_reset_postdata(); ?>  
                </div>  
            </div> 
        </div>
    </div>
<?php          
                    