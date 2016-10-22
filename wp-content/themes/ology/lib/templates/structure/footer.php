<?php
/**
 * Despite its name, this template echos between the closing primary markup and the closing HTML markup.
 *
 * This template must be called using get_footer().
 *
 * @package Structure\Footer
 */

						echo torbara_close_markup( 'torbara_primary', 'div' );

					echo torbara_close_markup( 'torbara_main_grid', 'div' );

				echo torbara_close_markup( 'torbara_fixed_wrap[_main]', 'div' );

			echo torbara_close_markup( 'torbara_main', 'main' );

		echo torbara_close_markup( 'torbara_site', 'div' );

		wp_footer();

	echo torbara_close_markup( 'torbara_body', 'body' );

echo torbara_close_markup( 'torbara_html', 'html' );