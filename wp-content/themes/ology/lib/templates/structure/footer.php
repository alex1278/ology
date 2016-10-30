<?php
/**
 * Despite its name, this template echos between the closing primary markup and the closing HTML markup.
 *
 * This template must be called using get_footer().
 *
 * @package Structure\Footer
 */

						echo ology_close_markup( 'ology_primary', 'div' );

					echo ology_close_markup( 'ology_main_grid', 'div' );

				echo ology_close_markup( 'ology_fixed_wrap[_main]', 'div' );

			echo ology_close_markup( 'ology_main', 'main' );

		echo ology_close_markup( 'ology_site', 'div' );

		wp_footer();

	echo ology_close_markup( 'ology_body', 'body' );

echo ology_close_markup( 'ology_html', 'html' );