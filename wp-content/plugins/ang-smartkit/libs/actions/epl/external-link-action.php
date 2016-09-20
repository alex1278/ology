<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Outputs any external links for virtual tours on the property templates
 *
 * When the hook epl_buttons_single_property is used and the property 
 * has external links they will be output on the template
 */
function ang_external_link() {
	$external_link		= get_post_meta( get_the_ID() , 'property_external_link' , true );
	$external_link_2	= get_post_meta( get_the_ID() , 'property_external_link_2' , true );
	$external_link_3	= get_post_meta( get_the_ID() , 'property_external_link_3' , true );
	
	$links = array();
	if(!empty($external_link)) {
		$links[] = $external_link;
	}
	if(!empty($external_link_2)) {
		$links[] = $external_link_2;
	}
	if(!empty($external_link_3)) {
		$links[] = $external_link_3;
	}
	
	if ( !empty($links) ) {
		foreach ( $links as $k=>$link ) {
			if(!empty($link)) {
				$number_string = '';
				if($k > 0) {
					$number_string = ' ' . $k + 1;
				}
				?><a href="<?php echo $link; ?>" class="uk-button 
                                   <?php if($k == 0){echo "uk-button-primary";}
                                        elseif($k == 1){echo  "uk-button-success";}
                                        elseif($k == 2){echo  "uk-button-danger";} ?> 
                                   epl-mini-web-link tm-external-link" onclick="window.open(this.href); return false;"><?php echo __('External link ', $domain = 'default') . $number_string; ?></a><?php
			}
		}
	}
}
add_action('ang_external_link', 'ang_external_link');


/**
 * Outputs any commercial or business mini web links
 *
 * When the hook epl_buttons_single_property is used and the commercial/business 
 * property as a mini web links they will be output on the template
 */
function ang_partners_link() {
	$mini_web	= get_post_meta( get_the_ID() , 'property_com_mini_web' , true );
	$mini_web_2	= get_post_meta( get_the_ID() , 'property_com_mini_web_2' , true );
	$mini_web_3	= get_post_meta( get_the_ID() , 'property_com_mini_web_3' , true );
                                
	$links = array();
	if(!empty($mini_web)) {
		$links[] = $mini_web;
	}
	if(!empty($mini_web_2)) {
		$links[] = $mini_web_2;
	}
	if(!empty($mini_web_3)) {
		$links[] = $mini_web_3;
	}
	
	if ( !empty($links) ) {
		foreach ( $links as $k=>$link ) {
			if(!empty($link)) {
				$number_string = '';
				if($k > 0) {
					$number_string = ' ' . $k + 1;
				}
				?><a href="<?php echo $link; ?>" class="uk-button 
                                    <?php if($k == 0){echo "uk-button-primary";}
                                        elseif($k == 1){echo  "uk-button-success";}
                                        elseif($k == 2){echo  "uk-button-danger";} ?> 
                                   epl-mini-web-link tm-partner-link" onclick="window.open(this.href); return false;"><?php echo __('Partners web ', $domain = 'default') . $number_string; ?></a><?php
			}
		}
	}
}
add_action('ang_partners_link', 'ang_partners_link');




