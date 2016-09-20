<?php


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*********************
     * easy property listing widget
     *********************/

     define('EPL_LOCATION_HIERARCHICAL', 'true');
     /*********************
      * end of easy property listing widget
     *********************/
     
/*
 *  Disable admin bar for registred users
 */
  //show_admin_bar(false);
  
     
/******************************************************************************
                             Add a custom user role
 ******************************************************************************/
function add_property_agent_role_on_plugin_activation() {

        add_role(
            'property_agent',
            __( 'Property Agent' ),
            array(
                'delete_others_pages' => false,
                'delete_others_posts' => false,
//                'delete_pages' => true,
                'delete_posts' => true,
//                'delete_private_pages'  => true,
                'delete_private_posts' => true,
//                'delete_published_pages' => true,
                'delete_published_posts'  => true,
                'edit_others_pages' => false,
                'edit_others_posts' => false,
//                'edit_pages' => true,
//                'edit_posts' => true,
//                'edit_private_pages' => true,
                'edit_private_posts' => true,
//                'edit_published_pages' => true,
                'edit_published_posts' => true,
                'manage_categories' => true,
                'manage_links' => false,
                'moderate_comments' => true,
                'publish_pages' => true,
                'publish_posts' => true,
                'read' => true,
                'read_private_pages' => true,
                'read_private_posts' => true,
                'unfiltered_html' => false, //not with Multisite. See Unfiltered MU & RemoveKses)
                'upload_files' => true,
                
                // property capabilities support
                'edit_property' => true,
                'read_property' => true,
                'delete_property' => true,
                'edit_properties' => true,
                //'edit_others_properties' => true,
                'publish_properties' => true,
                'read_private_properties' => true,
                'delete_properties' => true,
                'delete_private_properties' => true,
                'delete_published_properties' => true,
                //'delete_others_properties' => true,
                'edit_private_properties' => true,
                'edit_published_properties' => true,
                'edit_properties' => true,
                
                'level_0' => 1,
                'level_1' => 1,
                'level_2' => 1,
                'level_3' => 1,
                )
             );
        }
register_activation_hook( __FILE__, 'add_property_agent_role_on_plugin_activation' );

/******************************************************************************
                             Add a custom user capabilities
 ******************************************************************************/

function add_renter_caps() {
    // gets the administrator role
    $admins = get_role( 'administrator' );

    $admins->add_cap( 'edit_property');
    $admins->add_cap( 'read_property');
    $admins->add_cap( 'delete_property');
    $admins->add_cap( 'edit_properties');
    $admins->add_cap( 'edit_others_properties');
    $admins->add_cap( 'publish_properties');
    $admins->add_cap( 'read_private_properties');
    $admins->add_cap( 'delete_properties');
    $admins->add_cap( 'delete_private_properties');
    $admins->add_cap( 'delete_published_properties');
    $admins->add_cap( 'delete_others_properties');
    $admins->add_cap( 'edit_private_properties');
    $admins->add_cap( 'edit_published_properties');
    $admins->add_cap( 'edit_properties');
    
    // gets the property_agent role
//    $p_agents = get_role( 'property_agent' );
//
//    $p_agents->add_cap( 'edit_property');
//    $p_agents->add_cap( 'read_property');
//    $p_agents->add_cap( 'delete_property');
//    $p_agents->add_cap( 'edit_properties');
//    //$p_agents->add_cap( 'edit_others_properties');
//    $p_agents->add_cap( 'publish_properties');
//    $p_agents->add_cap( 'read_private_properties');
//    $p_agents->add_cap( 'delete_properties');
//    $p_agents->add_cap( 'delete_private_properties');
//    $p_agents->add_cap( 'delete_published_properties');
//    //$p_agents->add_cap( 'delete_others_properties');
//    $p_agents->add_cap( 'edit_private_properties');
//    $p_agents->add_cap( 'edit_published_properties');
//    $p_agents->add_cap( 'edit_properties');
//    
     // gets the editors role
     $editors = get_role( 'editor' );
     
     
    // gets the contributors role
    $contributors = get_role( 'contributor' );
    
    $contributors->add_cap( 'read_property');
    $contributors->add_cap( 'delete_properties');
    $contributors->add_cap( 'edit_properties');
}
add_action( 'admin_init', 'add_renter_caps');


     // get price sticker
 function ang_get_price_sticker_show() { //ang
    global $property;
    return $property->ang_get_price_stiker();
}

//get property heading
function ang_get_property_heading(){
	global $property;
	return $property->get_property_meta('property_heading');
}

/*
 * get property icons value
 */

// Collect property icons for 'Esta' theme
function ang_get_property_land_value(){
    global $property;
        $meta = get_post_custom();
            $property_land_area_unit = '';
                if(isset($meta['property_land_area_unit'])) {
                        if(isset($meta['property_land_area_unit'][0])) {
                                $property_land_area_unit = $meta['property_land_area_unit'][0];
                        }
                }
            $property_land_area = '';
                if(isset($meta['property_land_area'])) {
                        if(isset($meta['property_land_area'][0])) {
                                $property_land_area = $meta['property_land_area'][0];
                        }
                }
            if ( $property_land_area_unit == 'squareMeter' ) {
                $property_land_area_unit = 'm²';
            }elseif ( $property_land_area_unit == 'sqft' ) {
                $property_land_area_unit = 'sq.ft';
            }elseif ( $property_land_area_unit == 'hectare' ) {
                $property_land_area_unit = 'ha';
            }elseif ( $property_land_area_unit == 'acre' ) {
                $property_land_area_unit = 'acre';
            }elseif ( $property_land_area_unit == 'square' ) {
                $property_land_area_unit = 'sq.';
            }
            
            $post_type = $property->post_type;
            if ( 'commercial' == $post_type || 'commercial_land' == $post_type || 'land' == $post_type || 'business' == $post_type ) {
                if(intval($property_land_area) != 0 ) {
                    return '
                            <li class="ang-land-size">'.esc_html__('Land Area: ', 'renter').'<span class="ang-land-area"> ' . $property_land_area .'</span> <span class="ang-land-unit"> '.$property_land_area_unit.'</span></li>';
                }
            }
}   
    

function ang_get_property_building_area_value() {
    global $property;
        $meta = get_post_custom();
            $property_building_area_unit = '';
                if(isset($meta['property_building_area_unit'])) {
                        if(isset($meta['property_building_area_unit'][0])) {
                                $property_building_area_unit = $meta['property_building_area_unit'][0];
                        }
                }
            $property_building_area = '';
                if(isset($meta['property_building_area'])) {
                        if(isset($meta['property_building_area'][0])) {
                                $property_building_area = $meta['property_building_area'][0];
                        }
                }
                        
            if ( $property_building_area_unit == 'squareMeter' ) {
                    $property_building_area_unit = 'm²';
            }elseif ( $property_building_area_unit == 'sqft' ) {
                    $property_building_area_unit = 'sq.ft';
            }elseif ( $property_building_area_unit == 'hectare' ) {
                    $property_building_area_unit = 'ha';
            }elseif ( $property_building_area_unit == 'acre' ) {
                    $property_building_area_unit = 'acre';
            }elseif ( $property_building_area_unit == 'square' ) {
                    $property_building_area_unit = 'sq.';
            }
            if(intval($property_building_area) != 0 ) { 
                return '
                        <li class="ang-build-size">'.esc_html__('Area: ', 'renter').'<span class="ang-build-area"> '. $property_building_area .'</span> <span class="ang-build-unit"> '.$property_building_area_unit.'</span></li>';
            }
}

function ang_get_property_bed_icons() {
    global $property;
    $meta = get_post_custom();
        if(isset($meta['property_bedrooms'])) {
                if(isset($meta['property_bedrooms'][0])) {
                        $property_bedrooms = $meta['property_bedrooms'][0];
                }
        }
        if(isset($meta['property_bedrooms'])) {
                if(isset($meta['property_bedrooms'][0])) {
                        if(intval($property_bedrooms) != 0 ) { 
                                return '<li class="ang-beds-numb">'.esc_html__('Bedrooms: ', 'renter').$property->get_property_bed().'</li>';
                        }
                }
        }
	
}

function ang_get_property_bath_icons() {
	global $property;
    $meta = get_post_custom();
        if(isset($meta['property_bathrooms'])) {
                if(isset($meta['property_bathrooms'][0])) {
                        $property_bathrooms = $meta['property_bathrooms'][0];
                }
        }
        if(isset($meta['property_bathrooms'])) {
                if(isset($meta['property_bathrooms'][0])) {
                        if(intval($property_bathrooms) != 0 ) { 
                                return '<li class="ang-bath-numb">'.esc_html__('Bathrooms: ', 'renter').$property->get_property_bath().'</li>';
                        }
                }
        }
}

function ang_get_car_spaces() {
    global $property;
	if(intval($property->get_property_meta('property_com_car_spaces')) != 0 ) { 
                return '<li class="ang-carspaces-num">'.esc_html__('Car spaces: ', 'renter').'<span class="ang-carsp"> '.$property->get_property_meta('property_com_car_spaces').'</span></li>';
        }
}

function renter_ang_call_global_property(){
    global $property;
    return $property;
}
                
function ang_split_cut_type(){   
    list ($before_slash) = preg_split("/(?<=\w)\b\s*[!?.]*/", ang_get_property_category(), -1, PREG_SPLIT_NO_EMPTY);
    return $before_slash;
}
function ang_property_icons() {
    echo '<ul class="ang-property-icons">';
    echo ang_get_property_bed_icons();
    echo ang_get_property_bath_icons();
    echo ang_get_property_land_value();
    echo ang_get_property_building_area_value();
    echo ang_get_car_spaces();
    echo '<li class="ang-property-cut">'.esc_html__('Type: ', 'renter').'<span> '.ang_split_cut_type().'</span></li>';
    echo '</ul>';
}

add_action('epl_property_icons','ang_property_icons');



    
// Collect property icons for 'Renter' theme

function ang_get_property_land_value_notext(){
    global $property;
        $meta = get_post_custom();
            $property_land_area_unit = '';
                if(isset($meta['property_land_area_unit'])) {
                        if(isset($meta['property_land_area_unit'][0])) {
                                $property_land_area_unit = $meta['property_land_area_unit'][0];
                        }
                }
            $property_land_area = '';
                if(isset($meta['property_land_area'])) {
                        if(isset($meta['property_land_area'][0])) {
                                $property_land_area = $meta['property_land_area'][0];
                        }
                }
            if ( $property_land_area_unit == 'squareMeter' ) {
                $property_land_area_unit = 'm²';
            }elseif ( $property_land_area_unit == 'sqft' ) {
                $property_land_area_unit = 'sq.ft';
            }elseif ( $property_land_area_unit == 'hectare' ) {
                $property_land_area_unit = 'ha';
            }elseif ( $property_land_area_unit == 'acre' ) {
                $property_land_area_unit = 'acre';
            }elseif ( $property_land_area_unit == 'square' ) {
                $property_land_area_unit = 'sq.';
            }
            
            $post_type = $property->post_type;
            if ( 'commercial' == $post_type || 'commercial_land' == $post_type || 'land' == $post_type || 'business' == $post_type ) {
                if(intval($property_land_area) != 0 ) {
                    return '
                            <li class="ang-land-size"><span class="ang-land-area"> ' . $property_land_area .'</span> <span class="ang-land-unit"> '.$property_land_area_unit.'</span></li>';
                }
            }
}   
    
function ang_get_property_building_area_value_notext() {
    global $property;
        $meta = get_post_custom();
            $property_building_area_unit = '';
                if(isset($meta['property_building_area_unit'])) {
                        if(isset($meta['property_building_area_unit'][0])) {
                                $property_building_area_unit = $meta['property_building_area_unit'][0];
                        }
                }
            $property_building_area = '';
                if(isset($meta['property_building_area'])) {
                        if(isset($meta['property_building_area'][0])) {
                                $property_building_area = $meta['property_building_area'][0];
                        }
                }
                        
            if ( $property_building_area_unit == 'squareMeter' ) {
                    $property_building_area_unit = 'm²';
            }elseif ( $property_building_area_unit == 'sqft' ) {
                    $property_building_area_unit = 'sq.ft';
            }elseif ( $property_building_area_unit == 'hectare' ) {
                    $property_building_area_unit = 'ha';
            }elseif ( $property_building_area_unit == 'acre' ) {
                    $property_building_area_unit = 'acre';
            }elseif ( $property_building_area_unit == 'square' ) {
                    $property_building_area_unit = 'sq.';
            }
            if(intval($property_building_area) != 0 ) { 
                return '
                        <li class="ang-build-size"><span class="ang-build-area"> '. $property_building_area .'</span> <span class="ang-build-unit"> '.$property_building_area_unit.'</span></li>';
            }
}

function ang_get_property_bed_icons_notext() {
    global $property;
    $meta = get_post_custom();
        if(isset($meta['property_bedrooms'])) {
                if(isset($meta['property_bedrooms'][0])) {
                        $property_bedrooms = $meta['property_bedrooms'][0];
                }
        }
        if(isset($meta['property_bedrooms'])) {
                if(isset($meta['property_bedrooms'][0])) {
                        if(intval($property_bedrooms) != 0 ) { 
                                return '<li class="ang-beds-numb">'.$property->get_property_bed().'</li>';
                        }
                }
        }
	
}

function ang_get_property_bath_icons_notext() {
	global $property;
    $meta = get_post_custom();
        if(isset($meta['property_bathrooms'])) {
                if(isset($meta['property_bathrooms'][0])) {
                        $property_bathrooms = $meta['property_bathrooms'][0];
                }
        }
        if(isset($meta['property_bathrooms'])) {
                if(isset($meta['property_bathrooms'][0])) {
                        if(intval($property_bathrooms) != 0 ) { 
                                return '<li class="ang-bath-numb">'.$property->get_property_bath().'</li>';
                        }
                }
        }
}

function ang_get_car_spaces_notext() {
    global $property;
	if(intval($property->get_property_meta('property_com_car_spaces')) != 0 ) { 
                return '<li class="ang-carspaces-num"><span class="ang-carsp"> '.$property->get_property_meta('property_com_car_spaces').'</span></li>';
        }
}

function ang_property_icons_notext() {
    echo '<ul class="ang-property-icons ang-property-icons-notext">';
    echo ang_get_property_bed_icons_notext();
    echo ang_get_property_bath_icons_notext();
    echo ang_get_property_land_value_notext();
    echo ang_get_property_building_area_value_notext();
    echo ang_get_car_spaces_notext();
    echo '</ul>';
}

add_action('ang_property_icons_notext','ang_property_icons_notext');