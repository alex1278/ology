<?php
 /*
  * Template Name: Single commando
  */
get_header(); ?>
    <?php if (have_posts()) : ?>
        <?php while ( have_posts() ) : the_post();?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('uk-article'); ?> data-permalink="<?php the_permalink(); ?>">
                    <header class="entry-header">
                        <!-- Display featured image in right-aligned floating div -->
                        <div>
                            <?php the_post_thumbnail( 'full'); ?>
                        </div>
                        <!-- Display Title and Author Name -->
                        <h3><?php the_title(); ?></h3>
                        <!-- Display yellow stars based on rating -->
                        <strong><?php esc_html_e( 'Rating: ', 'ang-commando-staff-team' ); ?> </strong>
                        <?php
                            $nb_stars = intval( get_post_meta( get_the_ID(), '_star_rating', true ) );
                            print esc_html($nb_stars);
                        ?>

                    </header>
                    <!-- Display movie review contents -->
                    <div class="entry-content"><?php the_content(); ?></div>
                    
                    <?php
                        $prev = get_previous_post();
                        $next = get_next_post();
                        if ($prev || $next){
                    ?>

                    <div class="ang-pagination-wrap">
                        <ul class="uk-pagination uk-margin-remove " data-uk-grid-margin>

                            <?php if ($prev) : ?>
                            <li class="uk-pagination-previous alignleft">
                                <a class="hvr-icon-back uk-text-left" href="<?php echo get_permalink($prev->ID) ?>" title="<?php echo esc_html__('Previous article', 'ang-commando-staff-team'); ?>">
                                    <span class="ang-prev-wrapp uk-display-inline-block">
                                    <?php echo '<span class = "ang-prev-label">'.esc_html__('Previous article', 'ang-commando-staff-team').'</span><br/>'; 
                                          echo '<span class = "ang-prev-title">'.$prev->post_title.'</span>';?>
                                    </span>
                                </a>
                            </li>
                            <?php endif; ?>

                            <?php if ($next) : ?>
                            <li class="uk-pagination-next alignright">
                                <a class="hvr-icon-forward uk-text-right" href="<?php echo get_permalink($next->ID) ?>" title="<?php echo esc_html__('Next article', 'ang-commando-staff-team'); ?>">
                                    <span class="ang-next-wrapp uk-display-inline-block">
                                    <?php echo '<span class = "ang-next-label">'.esc_html__('Next article', 'ang-commando-staff-team').'</span><br/>'; 
                                          echo '<span class = "ang-next-title">'.$next->post_title.'</span>';?>
                                    </span>
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                        <?php } ?>
                    <?php comments_template(); ?>
                </article>
        <?php endwhile; ?>
    <?php endif; ?>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>

