<?php
function change_epl_image_size() {
	$sizes = array(
		array(
			'id'			=>	'admin-list-thumb',
			'height'		=>	100,
			'width'			=>	100,
			'crop'			=>	true
		),
		array(
			'id'			=>	'epl-image-medium-crop',
			'height'		=>	400,
			'width'			=>	720,
			'crop'			=>	true
		)
	);
	return $sizes;
}
add_filter( 'epl_image_sizes' , 'change_epl_image_size' );
//remove_action( 'after_setup_theme', 'epl_image_sizes' );
//add_action( 'after_setup_theme', 'change_epl_image_size' );

