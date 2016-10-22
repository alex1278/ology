<?php
/**
 * Template Name: Offline page template
 * The template for displaying Maintance mode pages
 *
 * This is the template that displays Maintance mode pages.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 */


// add css
$this['asset']->addFile('css', 'css:theme.css');
?>

<!DOCTYPE HTML>
<html lang="<?php echo esc_attr($this['config']->get('language')); ?>" dir="<?php echo esc_attr($this['config']->get('direction')); ?>" class="uk-height-1-1 tm-error ak-offline">
<head>
    <?php remove_action( 'wp_head',  'loading_page_replace_the_header', 99 ); ?>
    <?php remove_action('wp_enqueue_scripts', 'loading_page_enqueue_scripts', 1); ?>
    <?php remove_action( 'init', 'loading_page_init' ); ?>
    <?php echo $this['template']->render('head', compact('error', 'title')); ?>
    <?php wp_head(); ?></head>
<?php
$id = $this['config']->get('maintenance_page', 0);
$post = get_post($id);
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
?>
<body class="tm-offline-page uk-height-1-1  uk-text-center" style =   "  background-image: url('<?php echo esc_url($image[0]); ?>')" >
    <div class="uk-height-1-1 ang-maintance-mode-wrapp">
        <div class="uk-height-1-1 uk-vertical-align">
            <div class="ang-maintance-mode uk-vertical-align-middle uk-container uk-container-center">

                <?php
                if($post){
                    $content = apply_filters('the_content', $post->post_content);
                    echo $content;
                }
                ?>
            </div>
        </div>
    </div>
    <?php wp_footer(); ?>
</body>

</html>