<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

    <article <?php post_class('uk-article'); ?>>

        <?php if ($this['config']->get('page_title', true)) : ?>
        <h1 class="uk-article-title"><?php the_title(); ?></h1>
        <?php endif; ?>

        <?php if (has_post_thumbnail()) : ?>
            <?php
            $width = get_option('thumbnail_size_w'); //get the width of the thumbnail setting
            $height = get_option('thumbnail_size_h'); //get the height of the thumbnail setting
            ?>
            <?php the_post_thumbnail(array($width, $height), array('class' => 'uk-align-left')); ?>
        <?php endif; ?>
        
        <?php the_content(''); ?>

        <?php edit_post_link(esc_html__('Edit this post.', 'ology'), '<p class="uk-clearfix"><i class="uk-icon-pencil"></i> ','</p>'); ?>

    </article>

    <?php endwhile; ?>
<?php endif; ?>

<?php comments_template(); ?>