<?php
/**
 * Echo the secondary sidebar structural markup. It also calls the secondary sidebar action hooks.
 *
 * @package Structure\Secondary_Sidebar
 */

echo torbara_open_markup( 'torbara_sidebar_secondary', 'aside', array(
	'class' => 'tm-tertiary ' . torbara_get_layout_class( 'sidebar_secondary' ), // Automatically escaped.
	'role' => 'complementary',
	'itemscope' => 'itemscope',
	'itemtype' => 'http://schema.org/WPSideBar'
) );

	/**
	 * Fires in the secondary sidebar.
	 *
	 * @since 1.0.0
	 */
	do_action( 'torbara_sidebar_secondary' );

echo torbara_close_markup( 'torbara_sidebar_secondary', 'aside' );