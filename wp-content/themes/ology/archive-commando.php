<?php
 /*
  * Template Name: Archive commando
  */
get_header(); ?>
    <div class="uk-grid" data-uk-grid-match data-uk-grid-margin>
        <div class="uk-width-medium-1-1">
        <?php if (have_posts()) : ?>
            <?php while ( have_posts() ) : the_post();?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('uk-article uk-padding-top-remove ang-commando-archive'); ?> data-permalink="<?php the_permalink(); ?>">
                        
                        <div class="uk-grid uk-grid-collapse uk-grid-width-medium-1-2" data-uk-grid-match>
                            <div>
                                <div class="ang-member-info uk-overflow-hidden uk-block uk-block-large">
                                    <!--team member header-->

                                        <header class="ang-member-header uk-clearfix">
                                            <img src="wp-content/themes/ology/images/svg/uniform.svg" alt="teacher2" width="50" height="50" />
                                            <div>
                                                <h4 class="uk-panel-title uk-margin-top-remove uk-margin-bottom-remove">
                                                    <?php $team_meta = get_post_meta(get_the_ID()); ?>
                                                        <span><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></span>
                                                </h4>
                                                <p class="uk-margin-remove">
                                                   <?php print esc_html($team_meta['_position'][0]);?>
                                                </p>
                                            </div>
                                        </header>

                                    <!--team member short description-->
                                    <?php
                                        $exp = get_the_excerpt();
                                        print "<div class='ang-member-excerpt'><p>". do_shortcode($exp). "</p></div>";
                                    ?>

                                    <!--team member skills-->
                                    <?php $team_meta = get_post_custom();
                //                            ang_debug($team_meta);
                                            $skill_meta = array();
                                            for($i = 1; $i<=3; $i++){
                                                if(isset($team_meta['_skill_name'.$i]) && !empty($team_meta['_skill_name'.$i][0]) ){
                                                    $skill_meta[get_post_meta( get_the_ID(), '_skill_name'.$i, true)] = get_post_meta( get_the_ID(), '_skill_level'.$i, true );
                                                }
                                            }
                                            //skill piecharts
                                            if(!empty($skill_meta)) {
                                                    print '<div class="ang-member-progress-group">';  
                                                        foreach($skill_meta as $k=>$v){
                                                            if( $v ) {
                                                                print sprintf( '<div class="ang-member-progress">
                                                                                    <p class="uk-margin-remove uk-clearfix" data-team-progress="%2$s"><span class="uk-float-left">%1$s</span><span class="ang-team-progress-val uk-float-right"></span></p>
                                                                                    <div class="uk-progress uk-progress-mini uk-progress-primary uk-active">
                                                                                        <div class="uk-progress-bar"></div>
                                                                                    </div>
                                                                                </div>', esc_html($k), esc_html($v)
                                                                            );
                                                            }
                                                        }
                                                    print '</div>';
                                            }
                                    ?>
                                </div>
                            </div>

                            <?php if (has_post_thumbnail()) :
                                $thumb_id = get_post_thumbnail_id( get_the_ID() ); //add post thumbnail id;
                                $img = wp_prepare_attachment_for_js ( $thumb_id ); // get image data array
                                $image_attributes = wp_get_attachment_image_src( $img["id"], 'full' ); ?>
                                <div class="ang-post-image-cover" style="background: url(<?php echo esc_url ($image_attributes[0]); ?>) no-repeat center / cover">
                                    <img src="<?php echo $image_attributes[0] ?>"
                                         width="<?php echo $image_attributes[1] ?>"
                                         height="<?php echo $image_attributes[2] ?>"
                                         alt="<?php echo $img["alt"]; ?>"
                                         title="<?php echo $img["title"];?>"
                                         class="uk-visible-small">
                                </div>
                            <?php endif; ?>
                        </div>
                        
                    </article>
            <?php endwhile; ?>
        <?php endif; ?>
        </div>
    </div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>

