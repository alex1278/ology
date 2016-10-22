<?php
/**
 * Despite its name, this template echos between the opening HTML markup and the opening primary markup.
 *
 * This template must be called using get_header().
 *
 * @package Structure\Header
 */
$tt_h = "wp";

echo torbara_output( 'torbara_doctype', '<!DOCTYPE html>' );

echo torbara_open_markup( 'torbara_html', 'html', str_replace( ' ', '&', str_replace( '"', '', torbara_render_function( 'language_attributes' ) ) ) );

	echo torbara_open_markup( 'torbara_head', 'head' );

		/**
		 * Fires in the head.
		 *
		 * This hook fires in the head HTML section, not in wp _ header().
		 *
		 * @since 1.0.0
		 */
		do_action( 'torbara_head' );
                
                $tt_h .= "_head";
                
		$tt_h();

                echo torbara_close_markup( 'torbara_head', 'head' );

	echo torbara_open_markup( 'torbara_body', 'body', array(
		'class' => implode( ' ', get_body_class( 'uk-form no-js' ) ),
		'itemscope' => 'itemscope',
		'itemtype' => 'http://schema.org/WebPage'

	) );

		echo torbara_open_markup( 'torbara_site', 'div', array( 'class' => 'tm-site' ) );

			echo torbara_open_markup( 'torbara_main', 'main', array( 'class' => 'tm-main uk-block' ) );

				echo torbara_open_markup( 'torbara_fixed_wrap[_main]', 'div', 'class=uk-container uk-container-center' );

					echo torbara_open_markup( 'torbara_main_grid', 'div', array( 'class' => 'uk-grid', 'data-uk-grid-margin' => '' ) );

						echo torbara_open_markup( 'torbara_primary', 'div', array(
							'class' => 'tm-primary ' . torbara_get_layout_class( 'content' )
						) );