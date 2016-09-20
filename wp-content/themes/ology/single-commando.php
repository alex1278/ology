<?php
 /*
  * Template Name: Single commando
  */
get_header();
    if (have_posts()) :
        while ( have_posts() ) : the_post(); 
    ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('uk-article'); ?> data-permalink="<?php the_permalink(); ?>">
                    
                    <!-- Display movie review contents -->
                    <div class="entry-content"><?php the_content(); ?></div>
                    <?php $team_meta = get_post_custom();
                            $skill_meta = array();
                            for($i = 1; $i<=4; $i++){
                                if(isset($team_meta['_skill_name'.$i]) && !empty($team_meta['_skill_name'.$i][0]) ){
                                    $skill_meta[get_post_meta( get_the_ID(), '_skill_name'.$i, true)] = get_post_meta( get_the_ID(), '_skill_level'.$i, true );
                                }
                            }
                            //skill piecharts
                            if(!empty($skill_meta)) {
                                    print '<div class="ang-easypiechart tm-padding-top-small tm-padding-bottom-large"><div class="uk-flex uk-flex-wrap uk-flex-space-between">';  
                                    foreach($skill_meta as $k=>$v){
                                        if( $v ) {
                                            print sprintf( '<div class="chart" data-percent="%1$s"><span class="percent"></span><div class="label">%2$s</div></div>', esc_html($v), esc_html($k) );
                                        }
                                    }
                                    print '</div></div>';
                            }
                    ?>
                    <?php comments_template(); ?>
                </article>
        <?php endwhile; ?>
    <?php endif; ?>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>

