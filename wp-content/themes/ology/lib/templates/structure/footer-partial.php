<?php
/**
 * Since WordPress force us to use the footer.php name to close the document, we add a footer-partial.php template for the actual footer.
 *
 * @package Structure\Footer
 */

echo torbara_open_markup( 'torbara_footer', 'footer', array(
	'class' => 'tm-footer uk-block',
	'role' => 'contentinfo',
	'itemscope' => 'itemscope',
	'itemtype' => 'http://schema.org/WPFooter'
) );

	echo torbara_open_markup( 'torbara_fixed_wrap[_footer]', 'div', 'class=uk-container uk-container-center' );

		/**
		 * Fires in the footer.
		 *
		 * This hook fires in the footer HTML section, not in wp_footer().
		 *
		 * @since 1.0.0
		 */
		do_action( 'torbara_footer' );

	echo torbara_close_markup( 'torbara_fixed_wrap[_footer]', 'div' );

echo torbara_close_markup( 'torbara_footer', 'footer' );