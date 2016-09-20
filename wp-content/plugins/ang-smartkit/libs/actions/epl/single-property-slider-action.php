<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*************************************
 ************************ Displays featured slideshow and post thumbail
 *************************************/


function show_p_slider(){
         global $post;
        // Store All Meta
        $meta = get_post_custom($post->ID);
        if(isset($meta['ANG_img-gallery'])) {
            $g_img_ids = array_diff($meta['ANG_img-gallery'], array('')); //array with images IDs
            if(!empty($g_img_ids)){
           
                //get post thumbnail id
                if ( has_post_thumbnail() ) {
                    $thumb_id = get_post_thumbnail_id( $post->ID );
                    $g_img_ids[] = $thumb_id; //add post thumbnail id;
                }
                
            $g_img_ids = array_unique($g_img_ids); // unique IDs array
            $p_gallary = array(); // Array with images data
                //$imgIDs_str = implode( ',', $meta['ANG_img-gallery'] );
                    //$imgIDs = explode(",", $imgIDs_str); // Images IDs
            foreach ($g_img_ids as $g_img_id) {
                $img_g_data = wp_prepare_attachment_for_js ( $g_img_id );
                    if ( $img_g_data == NULL ) { continue; } //If an ID picture is, and the image is not - skipping, we go to the next element of the array
                        $p_gallary[$img_g_data["title"]][] = $img_g_data;
                }    

            ?>
<!--            <div class="epl-stickers-wrapper uk-clearfix">
                <span class="uk-float-left"><?php //echo epl_get_price_sticker(); ?></span>
                <span class="uk-float-right"><?php //echo ang_get_price_sticker_show(); ?></span>
            </div>-->
            <div class="ang-p-gallery-slider">

                    <ul class="pgwSlideshow">
                        <?php foreach ($p_gallary as $group) {
                                foreach ($group as $img ) { ?>
                        <li>
                            <?php $image_attributes = wp_get_attachment_image_src( $img["id"], 'fullscreen-single' ); ?> 

                            <img src="<?php echo $image_attributes[0] ?>"
                                 width="<?php echo $image_attributes[1] ?>"
                                 height="<?php echo $image_attributes[2] ?>"
                                 alt="<?php echo $img["caption"];?>"
                                 title="<?php do_action('epl_property_heading'); ?>"
                                 data-description="<?php echo $img["description"];?>" />

                            <a class="uk-position-cover" 
                               data-uk-lightbox="group:'p_gallery-<?php echo $post->ID; ?>" 
                               data-lightbox-type="image" 
                               title="<?php do_action('epl_property_heading'); ?>  <?php echo $img["description"];?>"
                               href="<?php echo $img["url"]; ?>">
                            </a>
                        </li>
                            <?php } 
                            } 
                        ?>
                </ul>
            </div>
        <?php }
            if(empty($g_img_ids) && has_post_thumbnail()){ ?>
                
               <?php ang_property_featured_image();
            }
            remove_action( 'epl_property_featured_image' , 'ang_property_featured_image' , 10);
            remove_action( 'epl_single_featured_image' , 'ang_property_featured_image' , 10);
        }
    
    }
//add_action( 'ang_show_p_slider' , 'show_p_slider' , 10 );
    add_action( 'epl_property_featured_image' , 'show_p_slider' , 9 );
    add_action( 'epl_single_featured_image' , 'show_p_slider' , 9 );




