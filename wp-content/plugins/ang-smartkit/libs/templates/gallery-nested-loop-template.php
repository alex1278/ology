<?php
/*
 * Template (Ajax page loader template)
 * Main gallery loop template: Gallery default
 * 
 * @package ANG Themes
 * @subpackage Theme
 * 
 * Author: Aleksandr Glovatskyy
 */

//$sizes_arr = array('size11','size12','size13','size21','size22','size23','size31','size32','size33','size42','size43','size24','size34','size44');
$sizes_arr = array('size11','size12','size13','size21','size22','size23','size31','size32','size33');
//$sizes_arr = array('size21','size12','size11');
//$sizes_arr = array('size11','size11','size11','size11','size11','size11','size11','size11','size11','size11','size11','size12','size12','size12','size12','size12','size12','size12','size21','size21','size21','size21','size21','size21','size21');
//shuffle($sizes_arr);
$number = count($sizes_arr) - 1;
?>
<div class="uk-grid">
        <div class="uk-width-1-1 ang-main-gal-wrap <?php echo $extra_class; ?>"> 
            <div id="ang-portfolio-nested-content" class="ang-main-gallery <?php echo $template; ?>" >
                    <?php $query_open = new WP_Query( $args ); 
                        $slide_count=0;
                        if ( $query_open->have_posts() ) { ?>
                            <div id="container" class="" >
                            <?php while ( $query_open->have_posts() ) {
                                        $query_open->the_post();
                                        $slide_count++;
                                        global $post;

                                // all posts loop
                                // get post thumbnail id
                                if ( has_post_thumbnail() ) {
                                    $thumb_id = get_post_thumbnail_id( $post->ID ); //add post thumbnail id;
                                    $img = wp_prepare_attachment_for_js ( $thumb_id ); // get image data array
                                    $tax_terms = get_the_terms($post->ID, 'portfolio-type'); //get taxonomy terms array
                                        $tax_terms_arr = array();
                                        foreach($tax_terms as $tax_term){
                                            $tax_terms_arr[] = $tax_term->slug; // get term slug
                                        }
                                        $tax_terms_str = implode(",", $tax_terms_arr); // create term string separated by comma
                                        $image_attributes = wp_get_attachment_image_src( $img["id"], $wp_img_size );
                                    ?>  
                                        <div class="box <?php echo $sizes_arr[mt_rand(0, $number)];?> <?php echo 'item-'.$slide_count; ?> ang-main-gallery-item" 
                                             style="background-image: url('<?php echo $image_attributes[0]; ?>') ">

                                            <figure class="uk-overlay uk-overlay-hover uk-width-1-1 uk-height-1-1">                                    

                                                <figcaption class="uk-overlay-panel uk-overlay-background uk-text-center uk-overlay-fade  <?php echo $overlay_cls; ?>">
                                                    <div class="uk-height-1-1 uk-flex uk-flex-center uk-flex-middle ang-gallery-item-overlay">
                                                        <?php if($title === 'on') { ?>
                                                            <h5 class="uk-margin-small-top uk-text-left"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
                                                        <?php } ?>
                                                        <?php if($lightbox === 'on') { ?>
                                                            <a data-uk-lightbox="{group:'<?php echo $template; ?>-portfolio-group'}" 
                                                               data-lightbox-type="image" 
                                                               title="<?php echo $img["title"]; ?>"
                                                               href="<?php echo $img["url"]; ?>">
                                                                <i class="uk-icon-arrows-alt uk-icon-medium"></i>
                                                            </a>
                                                        <?php } ?>
                                                        <?php if($link === 'on') { ?>
                                                            <a href="<?php the_permalink() ?>"><i class="uk-icon-eye"></i></a>
                                                        <?php } ?>
                                                        
                                                    </div>
                                                </figcaption>
                                            </figure>
                                        </div>
                          <?php }
                            }
                                // end of all posts loop
                            ?>
                            </div>
                <?php    } 
                wp_reset_postdata(); ?>
            </div>             
        </div>
    </div>
<?php          
                    