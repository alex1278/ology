<?php
/**
 * Options and Actions used by Beans Compiler.
 *
 * @ignore
 *
 * @package API\Compiler
 */
final class ology_tt_Compiler_Options {

	/**
	 * Constructor.
	 */
	public function __construct() {

		add_action( 'admin_init', array( $this, 'register' ) );
		add_action( 'admin_init', array( $this, 'flush' ) , -1 );
		add_action( 'admin_notices', array( $this, 'admin_notice' ) );
		add_action( 'ology_field_flush_cache', array( $this, 'option' ) );
		add_action( 'ology_field_descriptionology_tt_compile_all_styles_append_markup', array( $this, 'maybe_disable_style_notice' ) );
		add_action( 'ology_field_descriptionology_tt_compile_all_scripts_group_append_markup', array( $this, 'maybe_disable_scripts_notice' ) );

	}


	/**
	 * Register options.
	 */
	public function register() {

		$fields = array(
			array(
				'id' => 'ology_compiler_items',
				'type' => 'flush_cache',
				'description' => esc_html__( 'Clear CSS and Javascript cached files. New cached versions will be compiled on page load.', 'torbara' )
			)
		);

		// Add styles compiler option only if supported
		if ( ology_get_component_support( 'wp_styles_compiler' ) )
			$fields = array_merge( $fields, array(
				array(
					'id' => 'ology_compile_all_styles',
					'label' => false,
					'checkbox_label' => esc_html__( 'Compile all WordPress styles', 'torbara' ),
					'type' => 'checkbox',
					'default' => false,
					'description' => esc_html__( 'Compile and cache all the CSS files that have been enqueued to the WordPress head.', 'torbara' )
				)
			) );

		// Add scripts compiler option only if supported
		if ( ology_get_component_support( 'wp_scripts_compiler' ) )
			$fields = array_merge( $fields, array(
				array(
					'id' => 'ology_compile_all_scripts_group',
					'label' => esc_html__( 'Compile all WordPress scripts', 'torbara' ),
					'type' => 'group',
					'fields' => array(
						array(
							'id' => 'ology_compile_all_scripts',
							'type' => 'activation',
							'default' => false
						),
						array(
							'id' => 'ology_compile_all_scripts_mode',
							'type' => 'select',
							'default' => array( 'aggressive' ),
							'attributes' => array( 'style' => 'margin: -3px 0 0 -8px;' ),
							'options' => array(
								'aggressive' => esc_html__( 'Aggressive', 'torbara' ),
								'standard' => esc_html__( 'Standard', 'torbara' )
							)
						),
					),
					'description' => esc_html__( 'Compile and cache all the Javascript files that have been enqueued to the WordPress head.<!--more-->JavaSript is outputted in the footer if the level is set to <strong>Aggressive</strong> and might conflict with some third party plugins which are not following WordPress standards.', 'torbara' )
				)
			) );

		ology_register_options( $fields, 'ology_settings', 'compiler_options', array(
			'title' => esc_html__( 'Compiler options', 'torbara' ),
			'context' => 'normal'
		) );

	}


	/**
	 * Flush images for all folders set.
	 */
	public function flush() {

		if ( !ology_post( 'ology_flush_compiler_cache' ) )
			return;

		ology_remove_dir( ology_get_compiler_dir() );

	}


	/**
	 * Cache cleaner notice.
	 */
	public function admin_notice() {

		if ( !ology_post( 'ology_flush_compiler_cache' ) )
			return;

		echo '<div id="message" class="updated"><p>' . esc_html__( 'Cache flushed successfully!', 'torbara' ) . '</p></div>' . "\n";

	}


	/**
	 * Add button used to flush cache.
	 */
	public function option( $field ) {

		if ( $field['id'] !== 'ology_compiler_items' )
			return;

		echo '<input type="submit" name="ology_flush_compiler_cache" value="' . esc_html__( 'Flush assets cache', 'torbara' ) . '" class="button-secondary" />';

	}


	/**
	 * Maybe show disabled notice.
	 */
	public function maybe_disable_style_notice() {

		if ( get_option( 'ology_compile_all_styles' ) && ology_tt_is_compiler_dev_mode() )
			echo '<br /><span>' . esc_html__( 'Styles are not compiled in development mode.', 'torbara' ) . '</span>';

	}

	/**
	 * Maybe show disabled notice.
	 */
	public function maybe_disable_scripts_notice() {

		if ( get_option( 'ology_compile_all_scripts' ) && ology_tt_is_compiler_dev_mode() )
			echo '<br /><span>' . esc_html__( 'Scripts are not compiled in development mode.', 'torbara' ) . '</span>';

	}

}

new ology_tt_Compiler_Options();
