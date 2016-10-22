<?php
/**
 * Echo widget fragments.
 *
 * @package Fragments\Widget
 */

torbara_add_smart_action( 'torbara_widget', 'torbara_widget_badge', 5 );

/**
 * Echo widget badge.
 *
 * @since 1.0.0
 */
function torbara_widget_badge() {

	if ( !torbara_get_widget( 'badge' ) )
		return;

	echo torbara_open_markup( 'torbara_widget_badge' . torbara_tt_widget_subfilters(), 'div', 'class=uk-panel-badge uk-badge' );

		echo torbara_widget_shortcodes( torbara_get_widget( 'badge_content' ) );

	echo torbara_close_markup( 'torbara_widget_badge' . torbara_tt_widget_subfilters(), 'div' );

}


torbara_add_smart_action( 'torbara_widget', 'torbara_widget_title' );

/**
 * Echo widget title.
 *
 * @since 1.0.0
 */
function torbara_widget_title() {

	if ( !( $title = torbara_get_widget( 'title' ) ) || !torbara_get_widget( 'show_title' ) )
		return;

	echo torbara_open_markup( 'torbara_widget_title' . torbara_tt_widget_subfilters(), 'h3', 'class=uk-panel-title' );

		echo torbara_output( 'torbara_widget_title_text', $title );

	echo torbara_close_markup( 'torbara_widget_title' . torbara_tt_widget_subfilters(), 'h3' );

}


torbara_add_smart_action( 'torbara_widget', 'torbara_widget_content', 15 );

/**
 * Echo widget content.
 *
 * @since 1.0.0
 */
function torbara_widget_content() {

	echo torbara_open_markup( 'torbara_widget_content' . torbara_tt_widget_subfilters(), 'div' );

		echo torbara_output( 'torbara_widget_content' . torbara_tt_widget_subfilters(), torbara_get_widget( 'content' ) );

	echo torbara_close_markup( 'torbara_widget_content' . torbara_tt_widget_subfilters(), 'div' );

}


torbara_add_smart_action( 'torbara_no_widget', 'torbara_no_widget' );

/**
 * Echo no widget content.
 *
 * @since 1.0.0
 */
function torbara_no_widget() {

	// Only apply this notice to sidebar-a and sidebar_secondary.
	if ( !in_array( torbara_get_widget_area( 'id' ), array( 'sidebar-a', 'sidebar_secondary' ) ) )
		return;

	echo torbara_open_markup( 'torbara_no_widget_notice', 'p', array( 'class' => 'uk-alert uk-alert-warning' ) );

		echo torbara_output( 'torbara_no_widget_notice_text', sprintf( esc_html__( '%s does not have any widget assigned!', 'torbara' ), torbara_get_widget_area( 'name' ) ) );

	echo torbara_close_markup( 'torbara_no_widget_notice', 'p' );

}


torbara_add_filter( 'torbara_widget_content_rss_output', 'torbara_widget_rss_content' );

/**
 * Modify RSS widget content.
 *
 * @since 1.0.0
 *
 * @return The RSS widget content.
 */
function torbara_widget_rss_content() {

	$options = torbara_get_widget( 'options' );

	return '<p><a class="uk-button" href="' . torbara_get( 'url', $options ) . '" target="_blank">' . esc_html__( 'Read feed', 'torbara' ) . '</a><p>';

}


torbara_add_filter( 'torbara_widget_content_attributes', 'torbara_modify_widget_content_attributes' );

/**
 * Modify core widgets content attributes, so they use the default UIKit styling.
 *
 * @since 1.0.0
 *
 * @param array $attributes The current widget attributes.
 *
 * @return array The modified widget attributes.
 */
function torbara_modify_widget_content_attributes( $attributes ) {

	$type = torbara_get_widget( 'type' );

	$target = array(
		'archives',
		'categories',
		'links',
		'meta',
		'pages',
		'recent-posts',
		'recent-comments'
	);

	$current_class = isset( $attributes['class'] ) ? $attributes['class'] . ' ' : '';

	if ( in_array( torbara_get_widget( 'type' ), $target ) )
		$attributes['class'] = $current_class . 'uk-list'; // Automatically escaped.

	if ( $type == 'calendar' )
		$attributes['class'] = $current_class . 'uk-table uk-table-condensed'; // Automatically escaped.

	return $attributes;

}


torbara_add_filter( 'torbara_widget_content_categories_output', 'torbara_modify_widget_count' );
torbara_add_filter( 'torbara_widget_content_archives_output', 'torbara_modify_widget_count' );

/**
 * Modify widget count.
 *
 * @since 1.0.0
 *
 * @param string $content The widget content.
 *
 * @return string The modified widget content.
 */
function torbara_modify_widget_count( $content ) {

	$count = torbara_output( 'torbara_widget_count', '$1' );

	if ( torbara_get( 'dropdown', torbara_get_widget( 'options' ) ) == true ) {

		$output = $count;

	} else {

		$output = torbara_open_markup( 'torbara_widget_count', 'span', 'class=tm-count' );

			$output .= $count;

		$output .= torbara_close_markup( 'torbara_widget_count', 'span' );

	}

	// Keep closing tag to avoid overwriting the inline JavaScript.
	return preg_replace( '#>((\s|&nbsp;)\((.*)\))#', '>' . $output, $content );

}


torbara_add_filter( 'torbara_widget_content_categories_output', 'torbara_remove_widget_dropdown_label' );
torbara_add_filter( 'torbara_widget_content_archives_output', 'torbara_remove_widget_dropdown_label' );

/**
 * Modify widget dropdown label.
 *
 * @since 1.0.0
 *
 * @param string $content The widget content.
 *
 * @return string The modified widget content.
 */
function torbara_remove_widget_dropdown_label( $content ) {

	return preg_replace( '#<label([^>]*)class="screen-reader-text"(.*?)>(.*?)</label>#', '', $content ) ;

}