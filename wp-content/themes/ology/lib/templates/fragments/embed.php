<?php
/**
 * Extends WordPress Embed.
 *
 * @package Fragments\Embed
 */

// Filter.
torbara_add_smart_action( 'embed_oembed_html', 'torbara_embed_oembed' );

/**
 * Add markup to embed.
 *
 * @since 1.0.0
 *
 * @param string $html The embed HTML.
 *
 * @return string The modified embed HTML.
 */
function torbara_embed_oembed( $html ) {

	$output = torbara_open_markup( 'torbara_embed_oembed', 'div', 'class=tm-oembed' );

		$output .= $html;

	$output .= torbara_close_markup( 'torbara_embed_oembed', 'div' );

	return $output;

}