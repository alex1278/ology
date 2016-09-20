<?php

/******************************************************************************
        Register shortcode button  for tinyMCE
*******************************************************************************/
    
function ang_add_mce_button() {

        // check user capability, if only user can edit posts and pages
	if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
		return;
	}
        // check if tinyMCE id enabled in wp settings(if it is disabled, he does not need this button)
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'ang_add_tinymce_script' );
		add_filter( 'mce_buttons', 'ang_register_mce_button' );
	}
}
add_action('admin_head', 'ang_add_mce_button');
 
// include JavaScript-file for shortcode button
function ang_add_tinymce_script( $plugin_array ) {
	$plugin_array['ang_mce_button'] = ang_load_js_url() .'shortcode-editor-button.js'; // ang_mce_button - button id
	return $plugin_array;
}
 
// register  shortcode button
function ang_register_mce_button( $buttons ) {
	array_push( $buttons, 'ang_mce_button' ); // ang_mce_button - button id
	return $buttons;
}

function ang_css_mce_button() { ?>
    <style type="text/css">
            i.mce-i-ang-mce-icon {
                background: url(<?php echo ang_load_img_url() ;?>ang-logo.png);
                background-size: cover;
            }
    </style>
<?php  //wp_enqueue_style('ang-admin-styles-css', ang_load_css_url().'admin-tiny-mce-style.css');
}
add_action('admin_head', 'ang_css_mce_button');