<?php
/**
 * Deprecated utility functions.
 *
 * @package API\Utilities
 */


/**
 * Deprecated. Sanitize HTML attributes from array to string.
 *
 * This functions has been replaced with {@see torbara_esc_attributes()}.
 *
 * @since 1.0.0
 * @deprecated 1.3.1
 *
 * @param array $attributes The array key defines the attribute name and the array value define the
 *                          attribute value.
 *
 * @return string The sanitized attributes.
 */
function torbara_sanatize_attributes( $attributes ) {

	_deprecated_function( __FUNCTION__, '1.3.1', 'torbara_esc_attributes()' );

	return torbara_esc_attributes( $attributes );

}