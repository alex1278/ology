<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

    <article <?php post_class('uk-article'); ?> data-permalink="<?php the_permalink(); ?>">
        
        <!-- on loop start check the global post is empty so that template tags don't work before the_content(), it is good if some third-party plugins unset global variable post or change main WP_Query-->
        <?php if (get_the_category_list()) : ?>
            <div class="uk-article-meta uk-margin-bottom">
                <?php echo get_avatar(get_the_author_meta('user_email'), $size = '45', null, 'Ava', array('class'=>'uk-border-circle uk-margin-right ang-author-ava'));?>
                <p class="uk-display-inline-block"><?php esc_html_e('Author: ', 'ology'); ?> <span><?php the_author_posts_link(); ?></span></p>
                <p class="uk-float-right"><?php esc_html_e('Categories: ', 'ology'); ?> <?php the_category(',  '); ?> &ensp; <span>|</span> &ensp; <?php esc_html_e('Tags: ', 'ology'); ?> <?php the_tags('',',  ',''); ?></p>
                
            </div>
        <?php endif; ?>
        
        <?php if (has_post_thumbnail()) : ?>
            <div class="tm-tumb-wrap"><?php the_post_thumbnail('fullscreen-single', array('class' => 'tm-single-blog-thumb uk-margin-top uk-margin-large-bottom')); ?></div>
        <?php endif; ?>
            
       
        <!-- on loop start check the global post is empty so that template tags don't work before the_content(), it is good if some third-party plugins unset global variable post or change main WP_Query-->
        <?php if (the_date('Y-m-d','','', false)) : ?>
            <div class="ang-post-date uk-float-left">
                <time datetime="<?php the_date('Y-m-d'); ?>"><span class="ang-post-date-day uk-display-block"><?php the_time('j'); ?></span><span class="ang-post-date-month uk-display-block"> <?php the_time('M'); ?></span></time>
            </div>
            <div class="ang-post-title-right uk-margin-bottom">
                 <?php if ($this['config']->get('post_title', true)) : ?>
                    <h1><?php the_title(); ?></h1>
                <?php endif; ?>
                <div class="ang-single-article-content uk-margin-bottom ">
                   <?php the_content(''); ?>
                </div>
            </div>
        <?php else: ?>
            <?php the_content(''); ?>
        <?php endif; ?>
        
           <?php wp_link_pages(); ?>
            
        <?php edit_post_link(esc_html__('Edit this post.', 'ology'), '<p class="uk-clearfix"><i class="uk-icon-pencil"></i> ','</p>'); ?>

        <?php if (pings_open()) : ?>
        <p><a href="<?php trackback_url(); ?>"><?php esc_html_e('Trackback from your site.', 'ology'); ?></a></p>
        <?php endif; ?>

        <?php if(!$this['config']->get('author_box', true) && get_the_author_meta('description')) { ?>
        
        <div class="uk-panel ang-author-box uk-margin-large-top uk-clearfix">

            <div class="uk-text-center uk-align-medium-left uk-margin-bottom-remove">

                <?php 
                if (function_exists('get_wp_user_avatar')) {
                    echo get_wp_user_avatar(get_the_author_meta('user_email'), 'agent-size-box');
                }else{
                echo get_avatar(get_the_author_meta('user_email'), 150); 
                } ?>
            </div>
            <div class="uk-grid-small uk-flex uk-flex-wrap uk-flex-space-between"  data-uk-grid-margin>
                <h2 class="uk-h4 uk-margin-top-remove"><?php the_author_posts_link(); ?></h2>

                <div class="ang-author-social">
                    <?php $author_id       =  get_the_author_meta('ID'); ?>
                    <?php if ( get_the_author_meta('facebook', $author_id) != '' ) { ?>
                        <a class="uk-icon-small uk-icon-hover uk-icon-facebook" href="<?php echo get_the_author_meta('facebook', $author_id); ?>"></a>
                    <?php } ?>

                    <?php if ( get_the_author_meta('twitter', $author_id) != '' ) { ?>
                        <a class="uk-icon-small uk-icon-hover uk-icon-twitter" href="<?php echo get_the_author_meta('twitter', $author_id); ?>"></a>
                    <?php } ?>

                    <?php if ( get_the_author_meta('google', $author_id) != '' ) { ?>
                        <a class="uk-icon-small uk-icon-hover uk-icon-google-plus" href="<?php echo get_the_author_meta('google', $author_id); ?>"></a>
                    <?php } ?>

                    <?php if ( get_the_author_meta('linkedin', $author_id) != '' ) { ?>
                        <a class="uk-icon-small uk-icon-hover uk-icon-linkedin" href="<?php echo get_the_author_meta('linkedin', $author_id); ?>"></a>
                    <?php } ?>
                </div>
            </div>
            <div class="uk-margin-small"><?php echo wp_trim_words(get_the_author_meta('description', get_the_author_meta('ID')), 40, ' ... '); ?>
                <?php 
                echo '<a class="tm-link-bio-more " href="'.get_author_posts_url(get_the_author_meta('ID')).'"> Read more</a>';
                ?>
            </div>
        </div>
        <?php } ?>
        <?php
            $prev = get_previous_post();
            $next = get_next_post();
        ?>

        <?php if ($this['config']->get('post_nav', 0) && ($prev || $next)) : ?>
        <div class="ang-pagination-wrap uk-clearfix">
            <ul class="uk-pagination uk-margin-remove" data-uk-grid-margin>

                <?php if ($prev) : ?>
                <li class="uk-pagination-previous">
                    <a class="hvr-icon-back uk-text-left" href="<?php echo get_permalink($prev->ID) ?>" title="<?php echo esc_html__('Previous article', 'ology'); ?>">
                        <span class="ang-prev-wrapp uk-display-inline-block">
                        <?php echo '<span class = "ang-prev-label">'.esc_html__('Previous article', 'ology').'</span><br/>'; 
                              echo '<span class = "ang-prev-title">'.$prev->post_title.'</span>';?>
                        </span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if ($next) : ?>
                <li class="uk-pagination-next">
                    <a class="hvr-icon-forward uk-text-right" href="<?php echo get_permalink($next->ID) ?>" title="<?php echo esc_html__('Next article', 'ology'); ?>">
                        <span class="ang-next-wrapp uk-display-inline-block">
                        <?php echo '<span class = "ang-next-label">'.esc_html__('Next article', 'ology').'</span><br/>'; 
                              echo '<span class = "ang-next-title">'.$next->post_title.'</span>';?>
                        </span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
        <?php endif; ?>
        <?php comments_template(); ?>
    </article>

    <?php endwhile; ?>
 <?php endif; ?>
