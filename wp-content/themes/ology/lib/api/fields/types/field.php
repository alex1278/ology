<?php
/**
 * @package API\Fields
 */

torbara_add_smart_action( 'torbara_field_wrap_prepend_markup', 'torbara_field_label' );

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
function torbara_field_label( $field ) {

	if ( !$label = torbara_get( 'label', $field ) )
		return;

	echo torbara_open_markup( 'torbara_field_label[_' . $field['id'] . ']', 'label' );

		echo esc_html($field['label']);

	echo torbara_close_markup( 'torbara_field_label[_' . $field['id'] . ']', 'label' );

}


torbara_add_smart_action( 'torbara_field_wrap_append_markup', 'torbara_field_description' );

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
function torbara_field_description( $field ) {

	if ( !$description = torbara_get( 'description', $field ) )
		return;

	echo torbara_open_markup( 'torbara_field_description[_' . $field['id'] . ']', 'div', array( 'class' => 'bs-field-description' ) );

		if ( preg_match( '#<!--more-->#', $description, $matches ) )
			list( $description, $extended ) = explode( $matches[0], $description, 2 );

		echo esc_html($description);

	echo torbara_close_markup( 'torbara_field_description[_' . $field['id'] . ']', 'div' );

}