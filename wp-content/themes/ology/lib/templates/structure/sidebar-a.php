<?php
/**
 * Echo the primary sidebar structural markup. It also calls the primary sidebar action hooks.
 *
 * @package Structure\Primary_Sidebar
 */

echo torbara_open_markup( 'torbara_sidebar_primary', 'aside', array(
	'class' => 'tm-secondary ' . torbara_get_layout_class( 'sidebar-a' ), // Automatically escaped.
	'role' => 'complementary',
	'itemscope' => 'itemscope',
	'itemtype' => 'http://schema.org/WPSideBar'
) );

	/**
	 * Fires in the primary sidebar.
	 *
	 * @since 1.0.0
	 */
	do_action( 'torbara_sidebar_primary' );

echo torbara_close_markup( 'torbara_sidebar_primary', 'aside' );