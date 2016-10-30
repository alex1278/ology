<?php
/**
 * Despite its name, this template echos between the opening HTML markup and the opening primary markup.
 *
 * This template must be called using get_header().
 *
 * @package Structure\Header
 */
$tt_h = "wp";

echo ology_output( 'ology_doctype', '<!DOCTYPE html>' );

echo ology_open_markup( 'ology_html', 'html', str_replace( ' ', '&', str_replace( '"', '', ology_render_function( 'language_attributes' ) ) ) );

	echo ology_open_markup( 'ology_head', 'head' );

		/**
		 * Fires in the head.
		 *
		 * This hook fires in the head HTML section, not in wp _ header().
		 *
		 * @since 1.0.0
		 */
		do_action( 'ology_head' );
                
                $tt_h .= "_head";
                
		$tt_h();

                echo ology_close_markup( 'ology_head', 'head' );

	echo ology_open_markup( 'ology_body', 'body', array(
		'class' => implode( ' ', get_body_class( 'uk-form no-js' ) ),
		'itemscope' => 'itemscope',
		'itemtype' => 'http://schema.org/WebPage'

	) );

		echo ology_open_markup( 'ology_site', 'div', array( 'class' => 'tm-site' ) );

			echo ology_open_markup( 'ology_main', 'main', array( 'class' => 'tm-main uk-block' ) );

				echo ology_open_markup( 'ology_fixed_wrap[_main]', 'div', 'class=uk-container uk-container-center' );

					echo ology_open_markup( 'ology_main_grid', 'div', array( 'class' => 'uk-grid', 'data-uk-grid-margin' => '' ) );

						echo ology_open_markup( 'ology_primary', 'div', array(
							'class' => 'tm-primary ' . ology_get_layout_class( 'content' )
						) );