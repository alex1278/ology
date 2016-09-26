<?php
/**
 * @package API\Fields
 */

ology_add_smart_action( 'ology_field_wrap_prepend_markup', 'ology_field_label' );

/**
 * Echo field label.
 *
 * @since 1.0.0
 *
 * @param array $field {
 *      Array of data.
 *
 *      @type string $label The field label. Default false.
 * }
 */
function ology_field_label( $field ) {

	if ( !$label = ology_get( 'label', $field ) )
		return;

	echo ology_open_markup( 'ology_field_label[_' . $field['id'] . ']', 'label' );

		echo esc_html($field['label']);

	echo ology_close_markup( 'ology_field_label[_' . $field['id'] . ']', 'label' );

}


ology_add_smart_action( 'ology_field_wrap_append_markup', 'ology_field_description' );

/**
 * Echo field description.
 *
 * @since 1.0.0
 *
 * @param array $field {
 *      Array of data.
 *
 *      @type string $description The field description. The description can be truncated using <!--more-->
 *            					  as a delimiter. Default false.
 * }
 */
function ology_field_description( $field ) {

	if ( !$description = ology_get( 'description', $field ) )
		return;

	echo ology_open_markup( 'ology_field_description[_' . $field['id'] . ']', 'div', array( 'class' => 'bs-field-description' ) );

		if ( preg_match( '#<!--more-->#', $description, $matches ) )
			list( $description, $extended ) = explode( $matches[0], $description, 2 );

		echo esc_html($description);

	echo ology_close_markup( 'ology_field_description[_' . $field['id'] . ']', 'div' );

}