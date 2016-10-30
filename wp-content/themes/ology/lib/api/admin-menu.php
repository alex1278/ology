<?php
/**
 * Beans admin page.
 *
 * @ignore
 */
final class ology_tt_Admin {

	/**
	 * Constructor.
	 */
	public function __construct() {

		add_action( 'admin_menu', array( $this, 'admin_menu' ), 150 );
		add_action( 'admin_init', array( $this, 'register' ), 20 );

	}


	/**
	 * Add beans menu.
	 */
	public function admin_menu() {

		add_theme_page( esc_html__( 'Settings', 'torbara' ), esc_html__( 'Settings', 'torbara' ), 'manage_options', 'ology_settings', array( $this, 'display_screen' ) );

	}


	/**
	 * Beans options page content.
	 */
	public function display_screen() {

		echo '<div class="wrap">';

			echo '<h2>' . esc_html__( 'Beans Settings', 'torbara' ) . esc_html__( 'Version ', 'torbara' ) . ology_VERSION . '</h2>';

			echo ology_options( 'ology_settings' );

		echo '</div>';

	}


	/**
	 * Register options.
	 */
	public function register() {

		global $wp_meta_boxes;

		$fields = array(
			array(
				'id' => 'ology_dev_mode',
				'checkbox_label' => esc_html__( 'Enable development mode', 'torbara' ),
				'type' => 'checkbox',
				'description' => esc_html__( 'This option should be enabled while your website is in development.', 'torbara' )
			)
		);

		ology_register_options( $fields, 'ology_settings', 'mode_options', array(
			'title' => esc_html__( 'Mode options', 'torbara' ),
			'context' => ology_get( 'ology_settings', $wp_meta_boxes ) ? 'column' : 'normal' // Check for other beans boxes.
		) );

	}

}

new ology_tt_Admin();
