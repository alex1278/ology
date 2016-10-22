<?php
/**
 * Echo footer fragments.
 *
 * @package Fragments\Footer
 */

torbara_add_smart_action( 'torbara_footer', 'torbara_footer_content' );

/**
 * Echo the footer content.
 *
 * @since 1.0.0
 */
function torbara_footer_content() {

	echo torbara_open_markup( 'torbara_footer_credit', 'div', array( 'class' => 'uk-clearfix uk-text-small uk-text-muted' ) );

		echo torbara_open_markup( 'torbara_footer_credit_left', 'span', array(
			'class' => 'uk-align-medium-left uk-margin-small-bottom'
		) );

			echo torbara_output( 'torbara_footer_credit_text', sprintf(
				esc_html__( '&#x000A9; %1$s - %2$s. All rights reserved.', 'torbara' ),
				date( "Y" ),
				get_bloginfo( 'name' )
			) );

		echo torbara_close_markup( 'torbara_footer_credit_left', 'span' );

		$framework_link = torbara_open_markup( 'torbara_footer_credit_framework_link', 'a', array(
			'href' => 'http://torbara.com', // Automatically escaped.
		) );

			$framework_link .= torbara_output( 'torbara_footer_credit_framework_link_text', 'torbara' );

		$framework_link .= torbara_close_markup( 'torbara_footer_credit_framework_link', 'a' );

		echo torbara_open_markup( 'torbara_footer_credit_right', 'span', array(
			'class' => 'uk-align-medium-right uk-margin-bottom-remove'
		) );

			echo torbara_output( 'torbara_footer_credit_right_text', sprintf(
				esc_html__( '%1$s theme for WordPress.', 'torbara' ),
				$framework_link
			) );

		echo torbara_close_markup( 'torbara_footer_credit_right', 'span' );


	echo torbara_close_markup( 'torbara_footer_credit', 'div' );

}