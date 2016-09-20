<?php
/*
 * Author Meta 
 * This prepares the meta data for the author profile and author box
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

$name 			= get_the_author_meta( 'display_name' , $author_id);
$mobile 		= get_the_author_meta( 'mobile' , $author_id);
$mobile2 		= get_the_author_meta( 'mobile2' , $author_id);
$mobile3 		= get_the_author_meta( 'mobile3' , $author_id);
$website 		= get_the_author_meta( 'url' , $author_id);
$facebook 		= get_the_author_meta( 'facebook' , $author_id);
$linkedin 		= get_the_author_meta( 'linkedin' , $author_id);
$google 		= get_the_author_meta( 'google' , $author_id);
$twitter 		= get_the_author_meta( 'twitter' , $author_id);
$email 			= get_the_author_meta( 'email' , $author_id);
$skype 			= get_the_author_meta( 'skype' , $author_id);
$slogan 		= get_the_author_meta( 'slogan' , $author_id);
$position 		= get_the_author_meta( 'position' , $author_id);
$video 			= get_the_author_meta( 'video' , $author_id);
$e_video 		= wp_oembed_get($video);
$contact_form           = get_the_author_meta( 'contact-form' , $author_id);

// Prepare Social Icons // Need to convert to for each loop

// Email
if ( $email != '' ) {
	$i_email = '<a class="author-icon email-icon-24" href="mailto:' . $email . '" title="'.esc_html__('Contact', 'renter').' '.$name.' '.esc_html__('by Email', 'renter').'">'.esc_html__('Email', 'renter').'</a>';
}

// Twitter
if ( $twitter != '' ) {
	$i_twitter = '<a class="author-icon twitter-icon-24" href="http://twitter.com/' . $twitter . '" title="'.esc_html__('Follow', 'renter').' '.$name.' '.esc_html__('on Twitter', 'renter').'">'.esc_html__('Twitter', 'renter').'</a>';
}

// Google
if ( $google != '' ) {
	$i_google = '<a class="author-icon google-icon-24" href="https://plus.google.com/' . $google . '" title="'.esc_html__('Follow', 'renter').' '.$name.' '.esc_html__('on Google', 'renter').'">'.esc_html__('Google', 'renter').'</a>';
}

// Facebook
if ( $facebook != '' ) {
	$i_facebook = '<a class="author-icon facebook-icon-24" href="http://facebook.com/' . $facebook . '" title="'.esc_html__('Follow', 'renter').' '.$name.' '.esc_html__('on Facebook', 'renter').'">'.esc_html__('Facebook', 'renter').'</a>';
}

// Linked In
if ( $linkedin != '' ) {
	$i_linkedin = '<a class="author-icon linkedin-icon-24" href="http://au.linkedin.com/in/' . $linkedin . '" title="'.esc_html__('Follow', 'renter').' '.$name.' '.esc_html__('on Linkedin', 'renter').'">'.esc_html__('Linkedin', 'renter').'</a>';
}

// Skype
if ( $skype != '' ) {
	$i_skype = '<a class="author-icon skype-icon-24" href="http://skype.com/' . $skype . '" title="'.esc_html__('Follow', 'renter').' '.$name.' '.esc_html__('on Skype', 'renter').'">'.esc_html__('Skype', 'renter').'</a>';
}
