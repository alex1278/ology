<?php
/**
 * Handle the Beans Term Meta workflow.
 *
 * @ignore
 *
 * @package API\Term_meta
 */
final class _ology_Term_Meta {

	/**
	 * Fields section.
	 *
	 * @type string
	 */
	private $section;

	/**
	 * Constructor.
	 */
	public function __construct( $section ) {

		$this->section = $section;
		$this->do_once();

		add_action( ology_get( 'taxonomy' ). '_edit_form_fields', array( $this, 'fields' ) );

	}


	/**
	 * Trigger actions only once.
	 */
	private function do_once() {

		static $once = false;

		if ( !$once ) :

			add_action( ology_get( 'taxonomy' ). '_edit_form', array( $this, 'nonce' ) );
			add_action( 'edit_term', array( $this, 'save' ) );
			add_action( 'delete_term', array( $this, 'delete' ), 10, 3 );

			$once = true;

		endif;

	}


	/**
	 * Post meta nonce.
	 */
	public function nonce( $tag ) {

		echo '<input type="hidden" name="ology_term_meta_nonce" value="' . esc_attr( wp_create_nonce( 'ology_term_meta_nonce' ) ) . '" />';

	}


	/**
	 * Fields content.
	 */
	public function fields( $tag ) {

		ology_remove_action( 'ology_field_label' );
		ology_modify_action_hook( 'ology_field_description', 'ology_field_wrap_after_markup' );
		ology_modify_markup( 'ology_field_description', 'p' );
		ology_add_attribute( 'ology_field_description', 'class', 'description' );

		foreach ( ology_get_fields( 'term_meta', $this->section ) as $field ) {

			echo '<tr class="form-field">';
				echo '<th scope="row">';
					ology_field_label( $field );
				echo '</th>';
				echo '<td>';
					ology_field( $field );
				echo '</td>';
			echo '</tr>';

		}

	}


	/**
	 * Save Term Meta.
	 */
	public function save( $term_id ) {

		if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
			return $term_id;

		if ( !wp_verify_nonce( ology_post( 'ology_term_meta_nonce' ), 'ology_term_meta_nonce' ) )
			return $term_id;

		if ( !$fields = ology_post( 'ology_fields' ) )
			return $term_id;

		foreach ( $fields as $field => $value )
			update_option( "ology_term_{$term_id}_{$field}", stripslashes_deep( $value ) );

	}


	/**
	 * Delete Term Meta.
	 */
	public function delete( $term, $term_id, $taxonomy ) {

		global $wpdb;

		$wpdb->query( $wpdb->prepare(
			"DELETE FROM $wpdb->options WHERE option_name LIKE %s",
			"ology_term_{$term_id}_%"
		) );

	}

}