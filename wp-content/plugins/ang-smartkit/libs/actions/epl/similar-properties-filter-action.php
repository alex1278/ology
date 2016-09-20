<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;



/************************
 ****************** Action for Similar properties on single page
 ***********************/
function ang_similar_properties_filter(){
//Global
            global $post;
            // Store All Meta
            $meta = get_post_custom($post->ID);
            $p_type = $post->post_type;
            $p_status = get_post_meta($post->ID, 'property_status', true);
            $p_country = get_post_meta($post->ID, 'property_address_country', true);
            $term_list = wp_get_post_terms($post->ID, 'location', array("fields" => "names"));
            $p_exclud = $post->ID;
            ?>
            
            <?php
            $com_type = get_post_meta($post->ID, 'property_com_listing_type', true);
            $com_type == 'lease' ? $com_type = 'lease, both' : $com_type;
            $com_type == 'sale' ? $com_type = 'sale, both' : $com_type;
            $com_type == 'both' ? $com_type = '' : $com_type;
            ?>
            
            
        <div class="epl-tab-section ang-similar-box uk-clearfix">
            <?php
        $similar_prop = do_shortcode('[renter_listing_category limit="6" post_type="'.$p_type.'" status="'.$p_status.'" commercial_listing_type="'.$com_type.'" location="'.$term_list[0].'" exclude="'.$p_exclud.'" tools_top="on" pagination="off" ]');
        if($similar_prop != '<h3>'.esc_html__('Nothing found, please check back later.', 'epl').'</h3>' && $similar_prop !=''){
            echo '<h3 class="uk-panel-title"><span>'.esc_html__("Similar properties", "renter").'</span></h3>';
            echo $similar_prop;
        }else{
           $similar_prop_2 = do_shortcode('[renter_listing_category limit="6" post_type="'.$p_type.'" status="'.$p_status.'" location="'.$term_list[0].'" exclude="'.$p_exclud.'" tools_top="on" pagination="off" ]');
            if($similar_prop_2 != '<h3>'.esc_html__('Nothing found, please check back later.', 'epl').'</h3>' && $similar_prop !=''){
                echo '<h3 class="uk-panel-title"><span>'.esc_html__("Similar properties by loction", "renter").'</span></h3>';
                echo $similar_prop_2;

                }else{
                   $similar_prop_3 = do_shortcode('[renter_listing_category limit="6" post_type="'.$p_type.'" category_key="property_address_country" category_value="'.$p_country.'" status="'.$p_status.'" exclude="'.$p_exclud.'" tools_top="on" pagination="off" ]');
                    if($similar_prop_3 != '<h3>'.esc_html__('Nothing found, please check back later.', 'epl').'</h3>' && $similar_prop !=''){
                        echo '<h3 class="uk-panel-title"><span>'.esc_html__("Similar properties by country", "renter").'</span></h3>';
                        echo $similar_prop_3; 
                        } else{
                            $similar_prop_4 = do_shortcode('[renter_listing_category limit="6" post_type="'.$p_type.'" status="'.$p_status.'" exclude="'.$p_exclud.'" tools_top="on" pagination="off" ]');
                            if($similar_prop_4 != '<h3>'.esc_html__('Nothing found, please check back later.', 'epl').'</h3>' && $similar_prop !=''){
                                echo '<h3 class="uk-panel-title"><span>'.esc_html__("Similar properties by property type", "renter").'</span></h3>';
                                echo $similar_prop_4; 
                                } else{
                                    $similar_prop_5 = do_shortcode('[renter_listing_category limit="6" post_type="'.$p_type.'" exclude="'.$p_exclud.'" tools_top="on" pagination="off" ]');
                                    if($similar_prop_5 != '<h3>'.esc_html__('Nothing found, please check back later.', 'epl').'</h3>' && $similar_prop !=''){
                                        echo '<h3 class="uk-panel-title"><span>'.esc_html__("Similar properties no status", "renter").'</span></h3>';
                                        echo $similar_prop_5; 
                                        } else{
                                            $similar_prop_6 = do_shortcode('[renter_listing_category limit="6" category_key="property_featured" category_value="yes" status="current" pagination="off" exclude="'.$p_exclud.'" tools_top="on" ]');
                                            if($similar_prop_6 != '<h3>'.esc_html__('Nothing found, please check back later.', 'epl').'</h3>' && $similar_prop !=''){
                                                echo '<h3 class="uk-panel-title"><span>'.esc_html__("Featured properties", "renter").'</span></h3>';
                                                echo $similar_prop_6; 
                                                } 
                                        }
                                }
                        }
                }
        } ?>
        </div>
<?php
}
add_action('ang_similar_properties_filter', 'ang_similar_properties_filter');


