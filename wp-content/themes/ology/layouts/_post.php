<article id="item-<?php the_ID(); ?>" <?php post_class('uk-article'); ?> data-permalink="<?php the_permalink(); ?>">
    
    <!-- on loop start check the global post is empty so that template tags don't work before the_content(), it is good if some third-party plugins unset global variable post or change main WP_Query-->
    <?php if (get_the_category_list()) : ?>
        <div class="ang-post-date uk-float-left">
            <time datetime="<?php the_date('Y-m-d'); ?>"><span class="ang-post-date-day uk-display-block"><?php the_time('j'); ?></span><span class="ang-post-date-month uk-display-block"> <?php the_time('M'); ?></span></time>
        </div>
        <div class="ang-post-title-right uk-margin-bottom uk-clearfix">
            <h4 class="uk-margin-top-remove uk-article-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
            <p class="uk-article-meta">
            <?php
                printf(__('Categories: %s &ensp; <span>|</span> &ensp; Tags: %s', 'ology'), get_the_category_list(',  '), get_the_tag_list('',',  ','') );
            ?>
            </p>
        </div>
    <?php endif; ?>
     
    <?php if (has_post_thumbnail()) : ?>
        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('fullscreen-single', array('class' => 'ang-news-thumb uk-margin-bottom')); ?></a>
    <?php endif; ?>
        
    <?php the_content(''); ?>
        
    <?php if(get_post_type() != 'tribe_events') : ?>
        <div class="ang-arhive-links uk-clearfix">
            <?php
                printf(wp_kses(__('<span class="uk-float-left">%s</span>', 'ology'), 'post' ), '<a href="'.get_the_permalink().'" title="'.get_the_title().'">'.esc_html__('Read more ', 'ology').'</a>');
            ?>
        
            <?php if(comments_open() || get_comments_number()) : ?>
                <span class="uk-float-right"><?php comments_popup_link(esc_html__('No comments', 'ology'), esc_html__('1 comment', 'ology'), esc_html__('% comments', 'ology'), "", "");?></span>
            <?php endif; ?>
        </div>
   
        <hr>
     <?php endif; ?>
</article>