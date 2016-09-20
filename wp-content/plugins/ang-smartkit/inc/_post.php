
<article id="item-<?php the_ID(); ?>" <?php post_class('uk-article ang-cat-wrap'); ?> data-permalink="<?php the_permalink(); ?>">
    
    <div class="ang-entry-wrapp">
        
    <div class="timeline-icon-wrapp">
        <div class="timeline-icon"></div>
    </div> 
        
    <div class="ang-entry">

    
    <?php if (has_post_thumbnail()) : ?>
        <?php
        $width = get_option('thumbnail_size_w'); //get the width of the thumbnail setting
        $height = get_option('thumbnail_size_h'); //get the height of the thumbnail settin
        ?>
            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('renter-caregory', array('class' => 'tm-category-post-thumb')); ?></a>
        <?php else: ?>
            <a class="tm-category-post-thumb" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/no-image/imgo.jpg" alt="no-image" /></a>
        <?php endif; ?>
        <?php 
        $epl_posts = array('property','land', 'commercial', 'business', 'commercial_land' , 'location_profile','rental','rural');
        if (in_array(get_post_type(get_the_ID()), $epl_posts)) { ?>
            <h2 class="uk-article-title uk-margin-top-remove"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php echo get_post_meta( get_the_ID(), 'property_heading', true );?></a></h2>
        <?php }else{ ?>
            <h2 class="uk-article-title uk-margin-top-remove"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        <?php } ?>
        
        <p class="uk-article-meta">
            <?php
                $date = '<i class="uk-icon-calendar"></i><time datetime="'.get_the_date('j M Y').'">'.get_the_date('j M Y').'</time>';
                echo $date;        
                echo ' <span><a href="'.get_author_posts_url(get_the_author_meta('ID')).'" title="'.get_the_author().'"><i class="uk-icon-user"></i>'.get_the_author().'</a></span>';
                if(comments_open() || get_comments_number()) :
                    comments_popup_link(wp_kses(__('<i class="uk-icon-comments"></i> 0', 'renter'), 'post' ), wp_kses(__('<i class="uk-icon-comment"></i>1', 'renter'), 'post' ), wp_kses(__('<i class="uk-icon-comment"></i>%', 'renter'), 'post' ), "", "");
                endif;
            ?>
        </p>
        <div class="ang-blog-entry-content uk-clearfix">
            <p><?php the_excerpt(); ?></p>
        </div>
        <div class="ang-article-tag-wrapp uk-clearfix">
            <div class="uk-grid-small uk-flex uk-flex-wrap uk-flex-space-between"  data-uk-grid-margin>
                
            <div>
                <?php if (in_array(get_post_type(get_the_ID()), $epl_posts)) { ?>
                    <i class="uk-icon-map-marker"></i><?php the_title(); ?>
                <?php }else{ ?>
                    <?php if(get_the_tags()){ ?>
                    
                    <i class="uk-icon-tags"></i><?php the_tags('',', ',''); ?>
                    <?php } ?>
                <?php } ?>
            </div>
            <a class="hvr-read-more-forward" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php esc_html_e('Read more', 'renter'); ?></a>
           
            </div>
        </div>

        </div>
    </div>
</article>