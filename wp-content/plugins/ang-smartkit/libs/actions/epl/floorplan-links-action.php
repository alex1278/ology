<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/************************
 *  function that displays floor plans images
 ***********************/

function ang_floor_plan_from_link() {
        global $post;
	$floor_plan	= get_post_meta( get_the_ID() , 'property_floorplan' , true );
	$floor_plan_2	= get_post_meta( get_the_ID() , 'property_floorplan_2' , true );
        $floor_plan_3	= get_post_meta( get_the_ID() , 'property_floorplan_3' , true );
	$floor_plan_4	= get_post_meta( get_the_ID() , 'property_floorplan_4' , true );
	
	$links = array();
	if(!empty($floor_plan)) {
		$links[] = $floor_plan;
	}
	if(!empty($floor_plan_2)) {
		$links[] = $floor_plan_2;
	}
        if(!empty($floor_plan_3)) {
		$links[] = $floor_plan_3;
	}
        if(!empty($floor_plan_4)) {
		$links[] = $floor_plan_4;
	}

	if ( !empty($links) ) {
            ?>
        <div class="epl-tab-section ang-floor-plans ang-floorplan-link">
            <h3 class="uk-panel-title"><span>Floor Plans</span></h3>
                <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
            <?php
		foreach ( $links as $k=>$link ) {
                    if(!empty($link)) {
                            $number_string = '';
                            if($k > 0) {
                                    $number_string = ' '.$k + 1;
                            }
                            ?>
                            <div class="uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-4">    
                                <div class="uk-panel uk-text-center">
                                    <figure class="uk-overlay uk-overlay-hover">                                    
                                        <img class="uk-overlay-scale" src="<?php echo $link; ?>" alt="<?php do_action('epl_property_heading'); ?> floorplan <?php  echo $number_string; ?>">  
                                        <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-icon uk-flex uk-flex-center uk-flex-bottom uk-text-center uk-overlay-fade tm-gallery-overlay">
                                        </figcaption>

                                        <a class="uk-position-cover" 
                                           data-uk-lightbox="{group:'gallery-group-<?php echo $post->ID; ?>'}" 
                                           data-lightbox-type="image" 
                                           title="<?php do_action('epl_property_heading'); ?> Floorplan <?php echo $number_string; ?>" href="<?php echo $link; ?>"></a>
                                    </figure>
                                </div>
                            </div>
                            <?php
                                }
                            } ?>
                </div>
            </div>
            <?php
        }
}
add_action('ang_floor_plan_from_link', 'ang_floor_plan_from_link');
