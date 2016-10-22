<?php
/**
 * @package API\Fields\Types
 */

torbara_add_smart_action( 'torbara_field_select', 'torbara_field_select' );

/**
 * Echo select field type.
 *
 * @since 1.0.0
 *
 * @param array $field {
 *      For best practices, pass the array of data obtained using {@see torbara_get_fields()}.
 *
 *      @type mixed  $value      The field value.
 *      @type string $name       The field name value.
 *      @type array  $attributes An array of attributes to add to the field. The array key defines the
 *            					 attribute name and the array value defines the attribute value. Default array.
 *      @type mixed  $default    The default value. Default false.
 *      @type array  $options    An array used to populate the select options. The array key defines option
 *            					 value and the array value defines the option label.
 * }
 */
function torbara_field_select( $field ) {

	if ( empty( $field['options'] ) )
		return;

	?>
	<select name="<?php echo esc_attr( $field['name'] ); ?>" <?php echo torbara_esc_attributes( $field['attributes'] );?>>
		<?php foreach ( $field['options'] as $value => $label ) : ?>
			<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $value, $field['value'] );?>><?php echo esc_html( $label ); ?></option>
		<?php endforeach; ?>
	</select>
	<?php

}