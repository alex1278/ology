<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

    /**********************
     ************* Displays property gallery
     *********************/
    
    function ang_property_gallery(){
         global $post;
            // Store All Meta
            $meta = get_post_custom($post->ID);
            if(isset($meta['ANG_img-gallery'])) {
                if($meta['ANG_img-gallery'][0] != ''){
                $g_img_ids = $meta['ANG_img-gallery']; //string with images IDs
                $p_gallary = array(); // Array with images data
                    //$imgIDs_str = implode( ',', $meta['ANG_img-gallery'] );
                        //$imgIDs = explode(",", $imgIDs_str); // Images IDs
                foreach ($g_img_ids as $g_img_id) {
                    $img_g_data = wp_prepare_attachment_for_js ( $g_img_id );
                        if ( $img_g_data == NULL ) { continue; } //If an ID picture is, and the image is not - skipping, we go to the next element of the array
                            $p_gallary[$img_g_data["title"]][] = $img_g_data;
                    }
                ?>
    <div class="epl-tab-section ang-floor-plans">
        <h3 class="uk-panel-title"><span>Gallery</span></h3>
        <div class="ang-p-gallery">
            <div class="uk-grid-width-small-1-2 uk-grid-width-medium-1-4" data-uk-grid="{gutter: 20, controls: '#tm-gallery-filter', animation: 'uk-animation-fade, uk-animation-slide-left'}">
                <?php foreach ($p_gallary as $group) {
                        foreach ($group as $img ) { ?>
                            <div data-uk-filter="<?php echo str_replace(" ","-",$img["title"]); ?>">
                                <div class="uk-panel uk-text-center">
                                    <figure class="uk-overlay uk-overlay-hover"> 
                                        <?php $image_attributes = wp_get_attachment_image_src( $img["id"], 'epl-image-medium-crop' ); ?> 

                                        <img src="<?php echo $image_attributes[0] ?>"
                                             width="<?php echo $image_attributes[1] ?>"
                                             height="<?php echo $image_attributes[2] ?>"
                                             alt="<?php echo $img["alt"]; ?>"
                                             title="<?php echo $img["title"]; ?>" />
                           
                                        <div class="uk-position-cover uk-flex uk-flex-center uk-flex-bottom uk-text-center">
                                            <div class="tm-my-overlay uk-width-1-1">
                                                 <h6><?php echo $img["description"]; ?></h6>
                                            </div>
                                        </div>
                                        <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-icon uk-flex uk-flex-center uk-flex-bottom uk-text-center uk-overlay-fade tm-gallery-overlay">
                                            <h6><?php echo $img["description"];?></h6>
                                        </figcaption>

                                        <a class="uk-position-cover" 
                                           data-uk-lightbox="{group:'p_gallery-<?php echo $post->ID; ?>'}" 
                                           data-lightbox-type="image" 
                                           title="<?php echo $img["title"]; ?>" href="<?php echo $img["url"]; ?>"></a>
                                    </figure>
                                </div>
                            </div>
                        <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
        <?php  }
            }
        }
add_action( 'ang_property_gallery' , 'ang_property_gallery' , 10 );


