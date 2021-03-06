<?php
/**
 * @package API\Fields\Types
 */

ology_add_smart_action( 'ology_field_select', 'ology_field_select' );

/**
 * Echo select field type.
 *
 * @since 1.0.0
 *
 * @param array $field {
 *      For best practices, pass the array of data obtained using {@see ology_get_fields()}.
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
function ology_field_select( $field ) {

	if ( empty( $field['options'] ) )
		return;

	?>
	<select name="<?php echo esc_attr( $field['name'] ); ?>" <?php echo ology_esc_attributes( $field['attributes'] );?>>
		<?php foreach ( $field['options'] as $value => $label ) : ?>
			<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $value, $field['value'] );?>><?php echo esc_html( $label ); ?></option>
		<?php endforeach; ?>
	</select>
	<?php

}