<?php
 /*
  * Template Name: Archive commando
  */
get_header(); ?>
    <div class="uk-grid" data-uk-grid-match data-uk-grid-margin>
        <div class="uk-width-medium-1-1">
        <?php if (have_posts()) : ?>
            <?php while ( have_posts() ) : the_post();?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('uk-article ang-commando-archive'); ?> data-permalink="<?php the_permalink(); ?>">
                        <header class="entry-header uk-clearfix">
                            <p class="uk-article-meta">
                            <?php
                                $date = '<time datetime="'.get_the_date('Y-m-d').'">'.get_the_date('j M Y').'</time>';
                                echo $date;        
                                echo ' <span><a href="'.get_author_posts_url(get_the_author_meta('ID')).'" title="'.get_the_author().'"><i class="uk-icon-user"></i>'.get_the_author().'</a></span>';
                                if(comments_open() || get_comments_number()) :
                                    comments_popup_link(wp_kses(__('<i class="uk-icon-comments"></i> 0', 'ang-commando-staff-team'), 'post' ), wp_kses(__('<i class="uk-icon-comment"></i>1', 'ang-commando-staff-team'), 'post' ), wp_kses(__('<i class="uk-icon-comment"></i>%', 'ang-commando-staff-team'), 'post' ), "", "");
                                endif;
                            ?>
                            </p>
                            <!-- Display featured image in right-aligned floating div -->
                            <div class="alignright"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thumbnail', array('class' => 'tm-category-post-thumb')); ?></a>
                            </div>
                            
                            <!-- Display Title and Author Name -->
                            <h1><?php the_title(); ?></h1>
                        </header>
                        <!-- Display movie review contents -->
                        <div class="ang-blog-entry-content uk-clearfix">
                            <p><?php the_excerpt(); ?></p>
                        </div>
                        <div class="ang-article-tag-wrapp uk-clearfix">
                            <a class="hvr-read-more-forward" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php esc_html_e('Read more', 'ang-commando-staff-team'); ?></a>
                        </div>
                    </article>
            <?php endwhile; ?>
        <?php endif; ?>
        </div>
    </div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>

