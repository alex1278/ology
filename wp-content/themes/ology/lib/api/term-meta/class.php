<?php
/**
 * Handle the Beans Term Meta workflow.
 *
 * @ignore
 *
 * @package API\Term_meta
 */
final class torbara_tt_Term_Meta {

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

		add_action( torbara_get( 'taxonomy' ). '_edit_form_fields', array( $this, 'fields' ) );

	}


	/**
	 * Trigger actions only once.
	 */
	private function do_once() {

		static $once = false;

		if ( !$once ) :

			add_action( torbara_get( 'taxonomy' ). '_edit_form', array( $this, 'nonce' ) );
			add_action( 'edit_term', array( $this, 'save' ) );
			add_action( 'delete_term', array( $this, 'delete' ), 10, 3 );

			$once = true;

		endif;

	}


	/**
	 * Post meta nonce.
	 */
	public function nonce( $tag ) {

		echo '<input type="hidden" name="torbara_term_meta_nonce" value="' . esc_attr( wp_create_nonce( 'torbara_term_meta_nonce' ) ) . '" />';

	}


	/**
	 * Fields content.
	 */
	public function fields( $tag ) {

		torbara_remove_action( 'torbara_field_label' );
		torbara_modify_action_hook( 'torbara_field_description', 'torbara_field_wrap_after_markup' );
		torbara_modify_markup( 'torbara_field_description', 'p' );
		torbara_add_attribute( 'torbara_field_description', 'class', 'description' );

		foreach ( torbara_get_fields( 'term_meta', $this->section ) as $field ) {

			echo '<tr class="form-field">';
				echo '<th scope="row">';
					torbara_field_label( $field );
				echo '</th>';
				echo '<td>';
					torbara_field( $field );
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

		if ( !wp_verify_nonce( torbara_post( 'torbara_term_meta_nonce' ), 'torbara_term_meta_nonce' ) )
			return $term_id;

		if ( !$fields = torbara_post( 'torbara_fields' ) )
			return $term_id;

		foreach ( $fields as $field => $value )
			update_option( "torbara_term_{$term_id}_{$field}", stripslashes_deep( $value ) );

	}


	/**
	 * Delete Term Meta.
	 */
	public function delete( $term, $term_id, $taxonomy ) {

		global $wpdb;

		$wpdb->query( $wpdb->prepare(
			"DELETE FROM $wpdb->options WHERE option_name LIKE %s",
			"torbara_term_{$term_id}_%"
		) );

	}

}