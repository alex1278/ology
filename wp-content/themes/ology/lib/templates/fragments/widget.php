<?php
/**
 * Echo widget fragments.
 *
 * @package Fragments\Widget
 */

ology_add_smart_action( 'ology_widget', 'ology_widget_badge', 5 );

/**
 * Echo widget badge.
 *
 * @since 1.0.0
 */
function ology_widget_badge() {

	if ( !ology_get_widget( 'badge' ) )
		return;

	echo ology_open_markup( 'ology_widget_badge' . ology_tt_widget_subfilters(), 'div', 'class=uk-panel-badge uk-badge' );

		echo ology_widget_shortcodes( ology_get_widget( 'badge_content' ) );

	echo ology_close_markup( 'ology_widget_badge' . ology_tt_widget_subfilters(), 'div' );

}


ology_add_smart_action( 'ology_widget', 'ology_widget_title' );

/**
 * Echo widget title.
 *
 * @since 1.0.0
 */
function ology_widget_title() {

	if ( !( $title = ology_get_widget( 'title' ) ) || !ology_get_widget( 'show_title' ) )
		return;

	echo ology_open_markup( 'ology_widget_title' . ology_tt_widget_subfilters(), 'h3', 'class=uk-panel-title' );

		echo ology_output( 'ology_widget_title_text', $title );

	echo ology_close_markup( 'ology_widget_title' . ology_tt_widget_subfilters(), 'h3' );

}


ology_add_smart_action( 'ology_widget', 'ology_widget_content', 15 );

/**
 * Echo widget content.
 *
 * @since 1.0.0
 */
function ology_widget_content() {

	echo ology_open_markup( 'ology_widget_content' . ology_tt_widget_subfilters(), 'div' );

		echo ology_output( 'ology_widget_content' . ology_tt_widget_subfilters(), ology_get_widget( 'content' ) );

	echo ology_close_markup( 'ology_widget_content' . ology_tt_widget_subfilters(), 'div' );

}


ology_add_smart_action( 'ology_no_widget', 'ology_no_widget' );

/**
 * Echo no widget content.
 *
 * @since 1.0.0
 */
function ology_no_widget() {

	// Only apply this notice to sidebar-a and sidebar_secondary.
	if ( !in_array( ology_get_widget_area( 'id' ), array( 'sidebar-a', 'sidebar_secondary' ) ) )
		return;

	echo ology_open_markup( 'ology_no_widget_notice', 'p', array( 'class' => 'uk-alert uk-alert-warning' ) );

		echo ology_output( 'ology_no_widget_notice_text', sprintf( esc_html__( '%s does not have any widget assigned!', 'ology' ), ology_get_widget_area( 'name' ) ) );

	echo ology_close_markup( 'ology_no_widget_notice', 'p' );

}


ology_add_filter( 'ology_widget_content_rss_output', 'ology_widget_rss_content' );

/**
 * Modify RSS widget content.
 *
 * @since 1.0.0
 *
 * @return The RSS widget content.
 */
function ology_widget_rss_content() {

	$options = ology_get_widget( 'options' );

	return '<p><a class="uk-button" href="' . ology_get( 'url', $options ) . '" target="_blank">' . esc_html__( 'Read feed', 'ology' ) . '</a><p>';

}


ology_add_filter( 'ology_widget_content_attributes', 'ology_modify_widget_content_attributes' );

/**
 * Modify core widgets content attributes, so they use the default UIKit styling.
 *
 * @since 1.0.0
 *
 * @param array $attributes The current widget attributes.
 *
 * @return array The modified widget attributes.
 */
function ology_modify_widget_content_attributes( $attributes ) {

	$type = ology_get_widget( 'type' );

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

	if ( in_array( ology_get_widget( 'type' ), $target ) )
		$attributes['class'] = $current_class . 'uk-list'; // Automatically escaped.

	if ( $type == 'calendar' )
		$attributes['class'] = $current_class . 'uk-table uk-table-condensed'; // Automatically escaped.

	return $attributes;

}


ology_add_filter( 'ology_widget_content_categories_output', 'ology_modify_widget_count' );
ology_add_filter( 'ology_widget_content_archives_output', 'ology_modify_widget_count' );

/**
 * Modify widget count.
 *
 * @since 1.0.0
 *
 * @param string $content The widget content.
 *
 * @return string The modified widget content.
 */
function ology_modify_widget_count( $content ) {

	$count = ology_output( 'ology_widget_count', '$1' );

	if ( ology_get( 'dropdown', ology_get_widget( 'options' ) ) == true ) {

		$output = $count;

	} else {

		$output = ology_open_markup( 'ology_widget_count', 'span', 'class=tm-count' );

			$output .= $count;

		$output .= ology_close_markup( 'ology_widget_count', 'span' );

	}

	// Keep closing tag to avoid overwriting the inline JavaScript.
	return preg_replace( '#>((\s|&nbsp;)\((.*)\))#', '>' . $output, $content );

}


ology_add_filter( 'ology_widget_content_categories_output', 'ology_remove_widget_dropdown_label' );
ology_add_filter( 'ology_widget_content_archives_output', 'ology_remove_widget_dropdown_label' );

/**
 * Modify widget dropdown label.
 *
 * @since 1.0.0
 *
 * @param string $content The widget content.
 *
 * @return string The modified widget content.
 */
function ology_remove_widget_dropdown_label( $content ) {

	return preg_replace( '#<label([^>]*)class="screen-reader-text"(.*?)>(.*?)</label>#', '', $content ) ;

}