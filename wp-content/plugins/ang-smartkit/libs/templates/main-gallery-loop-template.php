<?php
/*
 * Template (Ajax page loader template)
 * Main gallery loop template: Gallery default
 * 
 * @package Esta
 * @subpackage Theme
 * 
 * Author: Aleksandr Glovatskyy
 */
                 // Store All Meta
                $meta = get_post_custom($post->ID);
                if(isset($meta['ANG_img-gallery'])) {
                    $g_img_ids = array_diff($meta['ANG_img-gallery'], array('')); //array with images IDs
                }else{
                    $g_img_ids = array();
                }
                        //get post thumbnail id
                        if ( has_post_thumbnail() ) {
                            $thumb_id = get_post_thumbnail_id( $post->ID );
                            $g_img_ids[] = $thumb_id; //add post thumbnail id;
                        }
                if(!empty($g_img_ids)){
                    $g_img_ids = array_unique($g_img_ids); // unique IDs array
                    $p_gallary = array(); // Array with images data

                    foreach ($g_img_ids as $g_img_id) {

                        $img_g_data = wp_prepare_attachment_for_js ( $g_img_id );
                            if ( $img_g_data == NULL ) { continue; } //If an ID picture is, and the image is not - skipping, we go to the next element of the array
                                $p_gallary[$img_g_data["title"]][] = $img_g_data;
                        }
                    ?> 
                
                    <div class="ang-main-gallery-item <?php echo 'post-num-'.$slide_count; ?>">
                        
                        <div class="uk-slidenav-position " data-uk-slider="{animation: 'scroll'}">
                            <div class="uk-slider-container">
                            <ul class="uk-slider uk-grid-width-1-1">
                                <?php foreach ($p_gallary as $group) {
                                  
                                        foreach ($group as $img ) { ?>
                                <li class=""> 
                                    <?php $image_attributes = wp_get_attachment_image_src( $img["id"], 'gallery-slider' );
                                        // returned array
                                        ?> 
                                   <figure class="uk-overlay uk-overlay-hover">                                    
                                    <img src="<?php echo $image_attributes[0] ?>"
                                         width="<?php echo $image_attributes[1] ?>"
                                         height="<?php echo $image_attributes[2] ?>"
                                         alt="<?php echo $img["alt"]; ?>" 
                                         title="<?php echo $img["title"];?>">
                                         
                                    <figcaption class="uk-overlay-panel uk-overlay-background uk-text-center uk-overlay-fade">
                                        <div class="ang-gallery-item-overlay uk-height-1-1 uk-flex uk-flex-center uk-flex-middle">
                                            <a data-uk-lightbox="{group:'esta_gallery-<?php echo $post->ID; ?>'}" 
                                               data-lightbox-type="image" 
                                               title="<?php echo $img["title"]; ?>"
                                               href="<?php echo $img["url"]; ?>">
                                                <i class="uk-icon-search-plus"></i>
                                            </a>
                                            <a href="<?php the_permalink() ?>"><i class="uk-icon-eye"></i></a>
                                        </div>
                                    </figcaption>
                                </figure>
                                </li>
                                    
                              <?php } 
                                }
                            ?>
                            </ul>
                             </div>
                            <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slider-item="previous"></a>
                            <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slider-item="next"></a>
                        
                        </div>
                        <a class="ang-prop-link" href="<?php the_permalink() ?>">
                            <div class="ang-gal-info uk-text-center">
                                <h5 class="uk-margin-remove"><?php do_action('epl_property_heading'); ?></h5>
                                <p class="uk-margin-remove"> Type: 
                                    <?php do_action('epl_property_commercial_category'); ?>
                                </p>
                                
                                <p class="uk-margin-remove ang-gallery-item-location"><i class="uk-icon-map-marker"></i>
                                    <?php do_action('ang_property_address'); ?>
                                </p>
                            </div>
                        </a>
                    </div>

                      <?php }
                    