<?php
/**
 * Beans images options.
 *
 * @ignore
 *
 * @package API\Image
 */
final class ology_tt_Image_Options {

	/**
	 * Constructor.
	 */
	public function __construct() {

		// Load in priority 15 so that we can check if other beans metaboxes exists.
		add_action( 'admin_init', array( $this, 'register' ), 15 );
		add_action( 'admin_init', array( $this, 'flush' ) , -1 );
		add_action( 'admin_notices', array( $this, 'admin_notice' ) );
		add_action( 'ology_field_flush_edited_images', array( $this, 'option' ) );

	}


	/**
	 * Register options.
	 */
	public function register() {

		global $wp_meta_boxes;

		$fields = array(
			array(
				'id' => 'ology_edited_images_directories',
				'type' => 'flush_edited_images',
				'description' => esc_html__( 'Clear all edited images. New images will be created on page load.', 'ology' )
			)
		);

		ology_register_options( $fields, 'ology_settings', 'images_options', array(
			'title' => esc_html__( 'Images options', 'ology' ),
			'context' => ology_get( 'ology_settings', $wp_meta_boxes ) ? 'column' : 'normal' // Check of other beans boxes.
		) );

	}


	/**
	 * Flush images for all folders set.
	 */
	public function flush() {

		if ( !ology_post( 'ology_flush_edited_images' ) )
			return;

		ology_remove_dir( ology_get_images_dir() );

	}


	/**
	 * Image editor notice notice.
	 */
	public function admin_notice() {

		if ( !ology_post( 'ology_flush_edited_images' ) )
			return;

		echo '<div id="message" class="updated"><p>' . esc_html__( 'Images flushed successfully!', 'ology' ) . '</p></div>' . "\n";

	}


	/**
	 * Add button used to flush images.
	 */
	public function option( $field ) {

		if ( $field['id'] !== 'ology_edited_images_directories' )
			return;

		echo '<input type="submit" name="ology_flush_edited_images" value="' . esc_html__( 'Flush images', 'ology' ) . '" class="button-secondary" />';

	}

}

new ology_tt_Image_Options();
