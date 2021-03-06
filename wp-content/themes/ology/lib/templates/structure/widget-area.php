<?php
/**
 * Echo the widget area and widget loop structural markup. It also calls the widget area and widget loop
 * action hooks.
 *
 * @package Structure\Widget_Area
 */

// This includes everything added to wp hooks before the widgets.
echo ology_get_widget_area( 'before_widgets' );

	if ( ology_get_widget_area( 'ology_type' ) == 'grid' )
		echo ology_open_markup( 'ology_widget_area_grid' . ology_tt_widget_area_subfilters(), 'div', array( 'class' => 'uk-grid', 'data-uk-grid-margin' => '' ) );

	if ( ology_get_widget_area( 'ology_type' ) == 'offcanvas' ) {

		echo ology_open_markup( 'ology_widget_area_offcanvas_wrap' . ology_tt_widget_area_subfilters(), 'div', array(
			'id' => ology_get_widget_area( 'id' ), // Automatically escaped.
			'class' => 'uk-offcanvas'
		) );

			echo ology_open_markup( 'ology_widget_area_offcanvas_bar' . ology_tt_widget_area_subfilters(), 'div', array( 'class' => 'uk-offcanvas-bar' ) );

	}

		// Widgets.
		if ( ology_have_widgets() ) :

			/**
			 * Fires before widgets loop.
			 *
			 * This hook only fires if widgets exist.
			 *
			 * @since 1.0.0
			 */
			do_action( 'ology_before_widgets_loop' );

				while ( ology_have_widgets() ) : ology_setup_widget();

					if ( ology_get_widget_area( 'ology_type' ) == 'grid' )
						echo ology_open_markup( 'ology_widget_grid' . ology_tt_widget_subfilters(), 'div', ology_widget_shortcodes( 'class=uk-width-medium-1-{count}' ) );

						echo ology_open_markup( 'ology_widget_panel' . ology_tt_widget_subfilters(), 'div', ology_widget_shortcodes( 'class=tm-widget uk-panel widget_{type} {id}' ) );

							/**
							 * Fires in each widget panel structural HTML.
							 *
							 * @since 1.0.0
							 */
							do_action( 'ology_widget' );

						echo ology_close_markup( 'ology_widget_panel' . ology_tt_widget_subfilters(), 'div' );

					if ( ology_get_widget_area( 'ology_type' ) == 'grid' )
						echo ology_close_markup( 'ology_widget_grid' . ology_tt_widget_subfilters(), 'div' );

				endwhile;

			/**
			 * Fires after the widgets loop.
			 *
			 * This hook only fires if widgets exist.
			 *
			 * @since 1.0.0
			 */
			do_action( 'ology_after_widgets_loop' );

		else :

			/**
			 * Fires if no widgets exist.
			 *
			 * @since 1.0.0
			 */
			do_action( 'ology_no_widget' );

		endif;

	if ( ology_get_widget_area( 'ology_type' ) == 'offcanvas' ) {

			echo ology_close_markup( 'ology_widget_area_offcanvas_bar' . ology_tt_widget_area_subfilters(), 'div' );

		echo ology_close_markup( 'ology_widget_area_offcanvas_wrap' . ology_tt_widget_area_subfilters(), 'div' );

	}

	if ( ology_get_widget_area( 'ology_type' ) == 'grid' )
		echo ology_close_markup( 'ology_widget_area_grid' . ology_tt_widget_area_subfilters(), 'div' );

// This includes everything added to wp hooks after the widgets.
echo ology_get_widget_area( 'after_widgets' );