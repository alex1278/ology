<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

    /**********************
     ************* Displays property floor plans
     *********************/
    
    function ang_show_floor_plans(){
         global $post;
            // Store All Meta
            $meta = get_post_custom($post->ID);
            if(isset($meta['ANG_plupload'])) {
                $g_img_ids = $meta['ANG_plupload']; //string with images IDs
                
                $p_gallary = array(); // Array with images data
                foreach ($g_img_ids as $g_img_id) {
                    $img_g_data = wp_prepare_attachment_for_js ( $g_img_id );
                        if ( $img_g_data == NULL ) { continue; } //If an ID picture is, and the image is not - skipping, we go to the next element of the array
                            $p_gallary[$img_g_data["title"]][] = $img_g_data;
                    }    
                ?>
             <?php
             if ( !empty($g_img_ids) ) {
            ?>
        <div class="epl-tab-section ang-floor-plans ang-p-plan">
            <h3 class="uk-panel-title"><span>Floor Plans</span></h3>
                <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <?php
                $k=0;
                    foreach ($p_gallary as $group) {
                     $k+=1;
                        foreach ($group as $img ) {
                        if(!empty($img)) { ?>
                            <div class="uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-4">    
                                <div class="uk-panel uk-text-center">
                                    <figure class="uk-overlay uk-overlay-hover"> 
                                    <?php $image_attributes = wp_get_attachment_image_src( $img["id"], 'epl-image-medium-crop' ); ?> 

                                        <img src="<?php echo $image_attributes[0] ?>"
                                             width="<?php echo $image_attributes[1] ?>"
                                             height="<?php echo $image_attributes[2] ?>"
                                             alt="<?php do_action('epl_property_heading'); ?> floorplan <?php  echo $k; ?>"
                                             title="<?php do_action('epl_property_heading'); ?>" />
                            
                                        <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-icon uk-flex uk-flex-center uk-flex-bottom uk-text-center uk-overlay-fade tm-gallery-overlay">
                                        </figcaption>

                                        <a class="uk-position-cover"
                                           data-uk-lightbox="{group:'p_floor-plan-<?php echo $post->ID; ?>'}" 
                                           data-lightbox-type="image" 
                                           title="<?php do_action('epl_property_heading'); ?> Floorplan <?php echo $k; ?>" href="<?php echo $img["url"]; ?>"></a>
                                    </figure>
                                </div>
                            </div>
                        <?php
                            }
                        }
                    } 
                    ?>
                </div>
            </div>
            <?php
                }   
            }
        }
add_action( 'ang_show_floor_plans' , 'ang_show_floor_plans' , 10 );


