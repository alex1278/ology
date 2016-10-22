<?php
/**
 * Since WordPress force us to use the header.php name to open the document, we add a header-partial.php template for the actual header.
 *
 * @package Structure\Header
 */

echo torbara_open_markup( 'torbara_header', 'header', array(
	'class' => 'tm-header uk-block',
	'role' => 'banner',
	'itemscope' => 'itemscope',
	'itemtype' => 'http://schema.org/WPHeader'
) );

	echo torbara_open_markup( 'torbara_fixed_wrap[_header]', 'div', 'class=uk-container uk-container-center' );

		/**
		 * Fires in the header.
		 *
		 * @since 1.0.0
		 */
		do_action( 'torbara_header' );

	echo torbara_close_markup( 'torbara_fixed_wrap[_header]', 'div' );

echo torbara_close_markup( 'torbara_header', 'header' );