<?php
/**
 * Beans admin page.
 *
 * @ignore
 */
final class torbara_tt_Admin {

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

		add_theme_page( esc_html__( 'Settings', 'torbara' ), esc_html__( 'Settings', 'torbara' ), 'manage_options', 'torbara_settings', array( $this, 'display_screen' ) );

	}


	/**
	 * Beans options page content.
	 */
	public function display_screen() {

		echo '<div class="wrap">';

			echo '<h2>' . esc_html__( 'Beans Settings', 'torbara' ) . esc_html__( 'Version ', 'torbara' ) . torbara_VERSION . '</h2>';

			echo torbara_options( 'torbara_settings' );

		echo '</div>';

	}


	/**
	 * Register options.
	 */
	public function register() {

		global $wp_meta_boxes;

		$fields = array(
			array(
				'id' => 'torbara_dev_mode',
				'checkbox_label' => esc_html__( 'Enable development mode', 'torbara' ),
				'type' => 'checkbox',
				'description' => esc_html__( 'This option should be enabled while your website is in development.', 'torbara' )
			)
		);

		torbara_register_options( $fields, 'torbara_settings', 'mode_options', array(
			'title' => esc_html__( 'Mode options', 'torbara' ),
			'context' => torbara_get( 'torbara_settings', $wp_meta_boxes ) ? 'column' : 'normal' // Check for other beans boxes.
		) );

	}

}

new torbara_tt_Admin();
