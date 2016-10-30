<?php
/**
 * Echo the secondary sidebar structural markup. It also calls the secondary sidebar action hooks.
 *
 * @package Structure\Secondary_Sidebar
 */

echo ology_open_markup( 'ology_sidebar_secondary', 'aside', array(
	'class' => 'tm-tertiary ' . ology_get_layout_class( 'sidebar_secondary' ), // Automatically escaped.
	'role' => 'complementary',
	'itemscope' => 'itemscope',
	'itemtype' => 'http://schema.org/WPSideBar'
) );

	/**
	 * Fires in the secondary sidebar.
	 *
	 * @since 1.0.0
	 */
	do_action( 'ology_sidebar_secondary' );

echo ology_close_markup( 'ology_sidebar_secondary', 'aside' );