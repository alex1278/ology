<?php
/**
 * Extends WordPress Embed.
 *
 * @package Fragments\Embed
 */

// Filter.
ology_add_smart_action( 'embed_oembed_html', 'ology_embed_oembed' );

/**
 * Add markup to embed.
 *
 * @since 1.0.0
 *
 * @param string $html The embed HTML.
 *
 * @return string The modified embed HTML.
 */
function ology_embed_oembed( $html ) {

	$output = ology_open_markup( 'ology_embed_oembed', 'div', 'class=tm-oembed' );

		$output .= $html;

	$output .= ology_close_markup( 'ology_embed_oembed', 'div' );

	return $output;

}