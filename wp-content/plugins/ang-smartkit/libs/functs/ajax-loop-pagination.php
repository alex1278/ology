<?php

/************************
 ****************** Ajax load more for property ESTA theme
************************/
     
function true_load_posts(){
    $epl_posts = array('property','land', 'commercial', 'business', 'commercial_land' , 'location_profile','rental','rural');
    $sizes_arr = array('size11','size12','size13','size21','size22','size23','size31','size32','size33');
    $number = count($sizes_arr) - 1;
    $count=0;
    if(isset($_POST['warp_style'])){
        $tt_style = $_POST['warp_style'];
    }
        $template = $_POST['template'];
        $blog_animation = stripslashes($_POST['pAnimation']);
        $wp_img_size = $_POST['pImgSize'];
        $overlay_cls = $_POST['pOverlayCls'];
        $title = $_POST['pTitle'];
        $lightbox = $_POST['pLightbox'];
        $link = $_POST['pLink'];
        
        $args = unserialize(stripslashes($_POST['query']));
	$args['paged'] = $_POST['page'] + 1; // next page
	$args['post_status'] = 'publish';
        $args['suppress_filters'] = true;
        $args['ignore_sticky_posts'] = 1;
        
	$results = new WP_Query($args);
        global $woo_active;
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
                    if( $results->have_posts() ):	while($results->have_posts()): $results->the_post();
                            print '<div class="uk-animation-slide-top item-ajax-'.$count++.' uk-grid-margin">';
                                require load_template_path("query-posts-{$template}.php");
                            print '</div>';
                        endwhile;
                    endif;
                break;
                
                case "post":
                    if( $results->have_posts() ): while($results->have_posts()): $results->the_post();

                        if(file_exists(get_stylesheet_directory().'/layouts/_post.php')){
                            print '<div class="uk-animation-slide-top item-ajax-'.$count++.' uk-grid-margin">';
                                if($tt_style == "default"){
                                    require get_stylesheet_directory().'/layouts/_post.php';
                                }else{
                                    require get_stylesheet_directory()."/styles/{$tt_style}/layouts/_post.php";
                                }
                            print '</div>';
                        }
                        endwhile;
                    endif;
                break;
                    
                case "freewall":
                case "uikit":
                case "property":
                    if( $results->have_posts() ):	while($results->have_posts()): $results->the_post();
                        require load_template_path("gallery-{$template}-post-template.php");
                        endwhile;
                    endif;
                break;
                
                case "blog_acc":
                    if( $results->have_posts() ):	while($results->have_posts()): $results->the_post();
                        require load_template_path("accordion-posts-{$template}.php");
                        endwhile;
                    endif;
                break;
                
                case "timeline":
                    if( $results->have_posts() ):	while($results->have_posts()): $results->the_post();
                        require load_template_path("tabs-swithcer-{$template}.php");
                        endwhile;
                    endif;
                break;
                
                case 1:
                    if( $results->have_posts() ):	while($results->have_posts()): $results->the_post(); 

                        if(file_exists(get_stylesheet_directory().'/easypropertylistings/loop-listing-blog-default.php')){ 
                           require get_stylesheet_directory().'/easypropertylistings/loop-listing-blog-default.php';
                        }else {
                           require load_plugin_dir_path().'easypropertylistings/loop-listing-blog-default.php';
                        }
                        endwhile;
                    endif;
                break;
                
                case 2:
                    if( $results->have_posts() ):	while($results->have_posts()): $results->the_post();
                        require get_stylesheet_directory().'/layouts/_post.php';
                        endwhile;
                    endif;
                break;
                    
                default:
                    if( $results->have_posts() ):	while($results->have_posts()): $results->the_post();
                        require get_stylesheet_directory().'/layouts/_post.php';
                        endwhile;
                    endif;
                break;
            }
            wp_reset_postdata();
        
	die();
}
 
add_action('wp_ajax_loadmore', 'true_load_posts');
add_action('wp_ajax_nopriv_loadmore', 'true_load_posts');

add_action('wp_ajax_loadmore_inf', 'true_load_posts');
add_action('wp_ajax_nopriv_loadmore_inf', 'true_load_posts');


/************************
 ****************** Ajax load more for posts Renter theme
************************/
     

/*
 * esta post pagination hook
 */

function ang_renter_pagination ($template_ajax_renter, $query = array() ) {
	global $epl_settings;
	if( isset($epl_settings['use_fancy_navigation'] ) && $epl_settings['use_fancy_navigation'] == 1)
            {
            require get_stylesheet_directory().'/layouts/_pagination.php';
        }elseif( isset($epl_settings['use_fancy_navigation'] ) && $epl_settings['use_fancy_navigation'] == 0)
            {
            epl_wp_default_pagination($query, $template_ajax_renter);
        }elseif( isset($epl_settings['use_fancy_navigation'] ) && $epl_settings['use_fancy_navigation'] == 2)
            {
            renter_ajax_infinite_pagination($query, $template_ajax_renter);
        } else{
            renter_ajax_pagination($query, $template_ajax_renter);
        }
	        
} //ang
add_action('ang_renter_pagination','ang_renter_pagination', 10, 2);