<?php
/**
 * Echo footer fragments.
 *
 * @package Fragments\Footer
 */

ology_add_smart_action( 'ology_footer', 'ology_footer_content' );

/**
 * Echo the footer content.
 *
 * @since 1.0.0
 */
function ology_footer_content() {

	echo ology_open_markup( 'ology_footer_credit', 'div', array( 'class' => 'uk-clearfix uk-text-small uk-text-muted' ) );

		echo ology_open_markup( 'ology_footer_credit_left', 'span', array(
			'class' => 'uk-align-medium-left uk-margin-small-bottom'
		) );

			echo ology_output( 'ology_footer_credit_text', sprintf(
				__( '&#x000A9; %1$s - %2$s. All rights reserved.', 'ology' ),
				date( "Y" ),
				get_bloginfo( 'name' )
			) );

		echo ology_close_markup( 'ology_footer_credit_left', 'span' );

		$framework_link = ology_open_markup( 'ology_footer_credit_framework_link', 'a', array(
			'href' => 'http://torbara.com', // Automatically escaped.
		) );

			$framework_link .= ology_output( 'ology_footer_credit_framework_link_text', 'ology' );

		$framework_link .= ology_close_markup( 'ology_footer_credit_framework_link', 'a' );

		echo ology_open_markup( 'ology_footer_credit_right', 'span', array(
			'class' => 'uk-align-medium-right uk-margin-bottom-remove'
		) );

			echo ology_output( 'ology_footer_credit_right_text', sprintf(
				__( '%1$s theme for WordPress.', 'ology' ),
				$framework_link
			) );

		echo ology_close_markup( 'ology_footer_credit_right', 'span' );


	echo ology_close_markup( 'ology_footer_credit', 'div' );

}