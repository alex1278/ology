<?php
/*
 * Template (Ajax page loader template)
 * Main gallery post template: Gallery default
 * Date:        20.03.2015
 * Version:     1.0.0
 * @package ANG Themes
 * @subpackage Theme
 * 
 * Author: Aleksandr Glovatskyy
 */

global $post;
$do_not_duplicate[] = $post->ID;
//var_dump($do_not_duplicate);
// all posts loop
// get post thumbnail id
if ( has_post_thumbnail() ) {
    $thumb_id = get_post_thumbnail_id( $post->ID ); //add post thumbnail id;
    $img = wp_prepare_attachment_for_js ( $thumb_id ); // get image data array
//
//    $tax_terms = get_the_terms($post->ID, 'portfolio-type'); //get taxonomy terms array
//        $tax_terms_arr = array();
//        foreach($tax_terms as $tax_term){
//            $tax_terms_arr[] = $tax_term->slug; // get term slug
//        }
//        $tax_terms_str = implode(",", $tax_terms_arr); // create term string separated by comma
    //var_dump($img);
    //var_dump($post);
    //print_r($tax_terms);
    ?> 
    <div class="<?php echo "item-ajax-{$count} tmpl-{$template} {$post->post_type}-id-{$post->ID}"; ?> ang-main-gallery-item" data-uk-filter="<?php echo $post->post_type; ?>">
        <div>
            <?php $image_attributes = wp_get_attachment_image_src( $img["id"], $wp_img_size ); 
            $count++;
            ?>
            <figure class="uk-overlay uk-overlay-hover">
                <img src="<?php echo $image_attributes[0] ?>"
                     width="<?php echo $image_attributes[1] ?>"
                     height="<?php echo $image_attributes[2] ?>"
                     alt="<?php echo $img["alt"]; ?>"
                     title="<?php echo $img["title"];?>">

                <figcaption class="uk-overlay-panel uk-overlay-background uk-text-center uk-overlay-fade <?php echo $overlay_cls; ?>">
                    <div class="uk-height-1-1 uk-flex uk-flex-center uk-flex-middle ang-gallery-item-overlay">
                        <?php if($title === 'on') { ?>
                            <h5 class=" uk-text-left"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
                        <?php } ?>
                        <?php if($lightbox === 'on') { ?>
                                <a data-uk-lightbox="{group:'<?php echo $template; ?>-group'}" 
                                   data-lightbox-type="image" 
                                   title="<?php echo $img["title"]; ?>"
                                   href="<?php echo $img["url"]; ?>">
                                    <i class="uk-icon-search-plus"></i>
                                </a>
                        <?php } ?>
                        <?php if($link === 'on') { ?>
                            <a href="<?php the_permalink() ?>"><i class="uk-icon-eye"></i></a>
                        <?php } ?>

                    </div>
                </figcaption>
            </figure>
        </div>
    </div>
<?php }