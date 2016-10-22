<?php
/**
 * Echo the widget area and widget loop structural markup. It also calls the widget area and widget loop
 * action hooks.
 *
 * @package Structure\Widget_Area
 */

// This includes everything added to wp hooks before the widgets.
echo torbara_get_widget_area( 'before_widgets' );

	if ( torbara_get_widget_area( 'torbara_type' ) == 'grid' )
		echo torbara_open_markup( 'torbara_widget_area_grid' . torbara_tt_widget_area_subfilters(), 'div', array( 'class' => 'uk-grid', 'data-uk-grid-margin' => '' ) );

	if ( torbara_get_widget_area( 'torbara_type' ) == 'offcanvas' ) {

		echo torbara_open_markup( 'torbara_widget_area_offcanvas_wrap' . torbara_tt_widget_area_subfilters(), 'div', array(
			'id' => torbara_get_widget_area( 'id' ), // Automatically escaped.
			'class' => 'uk-offcanvas'
		) );

			echo torbara_open_markup( 'torbara_widget_area_offcanvas_bar' . torbara_tt_widget_area_subfilters(), 'div', array( 'class' => 'uk-offcanvas-bar' ) );

	}

		// Widgets.
		if ( torbara_have_widgets() ) :

			/**
			 * Fires before widgets loop.
			 *
			 * This hook only fires if widgets exist.
			 *
			 * @since 1.0.0
			 */
			do_action( 'torbara_before_widgets_loop' );

				while ( torbara_have_widgets() ) : torbara_setup_widget();

					if ( torbara_get_widget_area( 'torbara_type' ) == 'grid' )
						echo torbara_open_markup( 'torbara_widget_grid' . torbara_tt_widget_subfilters(), 'div', torbara_widget_shortcodes( 'class=uk-width-medium-1-{count}' ) );

						echo torbara_open_markup( 'torbara_widget_panel' . torbara_tt_widget_subfilters(), 'div', torbara_widget_shortcodes( 'class=tm-widget uk-panel widget_{type} {id}' ) );

							/**
							 * Fires in each widget panel structural HTML.
							 *
							 * @since 1.0.0
							 */
							do_action( 'torbara_widget' );

						echo torbara_close_markup( 'torbara_widget_panel' . torbara_tt_widget_subfilters(), 'div' );

					if ( torbara_get_widget_area( 'torbara_type' ) == 'grid' )
						echo torbara_close_markup( 'torbara_widget_grid' . torbara_tt_widget_subfilters(), 'div' );

				endwhile;

			/**
			 * Fires after the widgets loop.
			 *
			 * This hook only fires if widgets exist.
			 *
			 * @since 1.0.0
			 */
			do_action( 'torbara_after_widgets_loop' );

		else :

			/**
			 * Fires if no widgets exist.
			 *
			 * @since 1.0.0
			 */
			do_action( 'torbara_no_widget' );

		endif;

	if ( torbara_get_widget_area( 'torbara_type' ) == 'offcanvas' ) {

			echo torbara_close_markup( 'torbara_widget_area_offcanvas_bar' . torbara_tt_widget_area_subfilters(), 'div' );

		echo torbara_close_markup( 'torbara_widget_area_offcanvas_wrap' . torbara_tt_widget_area_subfilters(), 'div' );

	}

	if ( torbara_get_widget_area( 'torbara_type' ) == 'grid' )
		echo torbara_close_markup( 'torbara_widget_area_grid' . torbara_tt_widget_area_subfilters(), 'div' );

// This includes everything added to wp hooks after the widgets.
echo torbara_get_widget_area( 'after_widgets' );