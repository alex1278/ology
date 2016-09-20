<?php
/**
 * Since WordPress force us to use the header.php name to open the document, we add a header-partial.php template for the actual header.
 *
 * @package Structure\Header
 */

echo ology_open_markup( 'ology_header', 'header', array(
	'class' => 'tm-header uk-block',
	'role' => 'banner',
	'itemscope' => 'itemscope',
	'itemtype' => 'http://schema.org/WPHeader'
) );

	echo ology_open_markup( 'ology_fixed_wrap[_header]', 'div', 'class=uk-container uk-container-center' );

		/**
		 * Fires in the header.
		 *
		 * @since 1.0.0
		 */
		do_action( 'ology_header' );

	echo ology_close_markup( 'ology_fixed_wrap[_header]', 'div' );

echo ology_close_markup( 'ology_header', 'header' );