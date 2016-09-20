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

<div class="ang-custom-search-page-wrapp">
    <?php if($content){?>
        <div class="uk-grid uk-grid-width-1-1"><div class="ang-short-descr uk-text-center uk-margin-bottom"><?php echo $content; ?></div></div>
    <?php } ?>
                <?php 
                        // perform the search
                        $query_open = new WP_Query( $args );
                        
                        if( ( $query_open->have_posts() ) ) : ?>
                
                            <header class="page-header">
                                <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'text_domain' ), $query ); ?></h1>
                            </header>
                            <?php /* The loop */ ?>
                                <ul style="list-style: none">
                            <?php  
                                while ( $query_open->have_posts() ): $query_open->the_post(); ?>
                                    <li style="display: block; margin-bottom: 50px">

                                        <div style="float: left; width: 110px;">
                                            <a href="<?php echo get_permalink(); ?>">
                                                    <?php echo get_the_post_thumbnail( $query_open->post->ID, array( 150, 150 ) ); ?>
                                            </a>
                                        </div>
                                        <div style="float:left; margin-left: 20px; width: 500px">
                                            <h2 style="margin-top: -10px; padding-top: 0px;">		
                                                <a href="<?php echo get_permalink(); ?>">	
                                                        <?php echo ANG_custom_search::apply_highlight( get_the_title() , $query ) ?>
                                                </a>
                                            </h2>
                                            <div><?php echo ANG_custom_search::apply_highlight(  get_the_content() , $query ) ?></div>
                                        </div>
                                        <div style="clear:both"></div>

                                    </li>
                                    
                            <?php endwhile; ?>
                                    
                                </ul>
                
                            <?php wp_reset_postdata(); ?>
                        <?php else : ?>
                                <h1 class="page-title"><?php printf( __( 'Sorry, no matches found for "' . $query .'"', 'text_domain' )  ); ?></h1>

                                <h4>Search Suggestions:</h4>
                                <ul>
                                    <li>Check your spelling</li>
                                    <li>Try more general words</li>
                                    <li>Try different words that mean the same thing</li>
                                </ul>

                        <?php  endif; // !(empty ( $posts ))
                ?>
                <?php 
                if($pagination === 'on'){
                            do_action('paginate_my_plugin',$query_open); // warp wp  pagination
                }elseif($pagination === 'ajax'){
                    print '<div class="uk-position-relative">';
                            do_action('ANG_ajax_pagination',  $template_ajax_ANG = $template, $blog_animation, array('query' => $query_open)); //ajax pagination
                    print '</div>';
                }elseif($pagination === 'both'){

                    print '<div class="uk-position-relative">';
                            do_action('ANG_ajax_pagination',  $template_ajax_ANG = $template, $blog_animation, array('query' => $query_open)); //ajax pagination
                    print '</div>';
                            do_action('paginate_my_plugin',$query_open); // warp wp  pagination
                }else{}
           ?>  
</div>

<?php          
                    