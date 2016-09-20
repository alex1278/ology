<?php
/**
 * @package API\Fields\Types
 */

ology_add_smart_action( 'ology_field_textarea', 'ology_field_textarea' );

/**
 * Echo textarea field type.
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
 * }
 */
function ology_field_textarea( $field ) {

	?>
	<textarea name="<?php echo esc_attr( $field['name'] ); ?>" <?php echo ology_esc_attributes( $field['attributes'] ); ?>><?php echo esc_textarea( $field['value'] ); ?></textarea>
	<?php

}