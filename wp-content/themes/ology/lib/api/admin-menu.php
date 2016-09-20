<?php
/**
 * Beans admin page.
 *
 * @ignore
 */
final class _ology_Admin {

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

		add_theme_page( __( 'Settings', 'ology' ), __( 'Settings', 'ology' ), 'manage_options', 'ology_settings', array( $this, 'display_screen' ) );

	}


	/**
	 * Beans options page content.
	 */
	public function display_screen() {

		echo '<div class="wrap">';

			echo '<h2>' . __( 'Beans Settings', 'ology' ) . '<span style="float: right; font-size: 10px; color: #888;">' . __( 'Version ', 'ology' ) . ology_VERSION . '</span></h2>';

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
				'checkbox_label' => __( 'Enable development mode', 'ology' ),
				'type' => 'checkbox',
				'description' => __( 'This option should be enabled while your website is in development.', 'ology' )
			)
		);

		ology_register_options( $fields, 'ology_settings', 'mode_options', array(
			'title' => __( 'Mode options', 'ology' ),
			'context' => ology_get( 'ology_settings', $wp_meta_boxes ) ? 'column' : 'normal' // Check for other beans boxes.
		) );

	}

}

new _ology_Admin();
