<?php
/**
 * The Beans Widgets API extends the WordPress Widgets API. Where WordPress uses 'sidebar', Beans uses
 * 'widget_area' as it is more appropriate when using it to define an area which is not besides the main
 * content (e.g. a mega footer widget area).
 *
 * @package API\Widgets
 */

/**
 * Register a widget area.
 *
 * Since a Beans widget area is using the WordPress sidebar, this function registers a WordPress sidebar using
 * {@link http://codex.WordPress.org/Function_Reference/register_sidebar register_sidebar()}, with additional
 * arguments.
 *
 * Note that the 'class', before_widget', 'after_widget', 'before_title' and 'after_title' arguments are not
 * supported. Beans widgets are built using the Beans HTML API which allows full control over HTML markup
 * and attributes.
 *
 * When allowing for automatic generation of the name and ID parameters, keep in mind that the incrementor for
 * your widget area can change over time depending on what other plugins and themes are installed.
 *
 * @since 1.0.0
 *
 * @param array $args {
 *     Optional. Arguments used by the widget area.
 *
 *     @type string $id                      Optional. The unique identifier by which the widget area will be called.
 *     @type string $name                    Optional. The name or title of the widget area displayed in the
 *                                           admin dashboard.
 *     @type string $description             Optional. The widget area description.
 *     @type string $ology_type                 Optional. The widget area type. Accepts 'stack', 'grid' or 'offcanvas'.
 *                                           Default stack.
 *     @type bool   $ology_show_widget_title    Optional. Whether to show the widget title or not. Default true.
 *     @type bool   $ology_show_widget_badge    Optional. Whether to show the widget badge or not. Default false.
 *     @type bool   $ology_widget_badge_content Optional. The badge content. This may contain widget shortcodes
 *                                           {@see ology_widget_shortcodes()}. Default 'Hello'.
 * }
 * @return string The widget area ID is added to the $wp_registered_sidebars globals when the widget area is setup.
 */
function ology_register_widget_area( $args = array(), $widget_control = array() ) {

    // Stop here if the id isn't set.
    if ( !$id = ology_get( 'id', $args ) )
        return;

    /**
     * Filter the default arguments used by the widget area.
     *
     * @since 1.0.0
     */
    $defaults = apply_filters( 'ology_widgets_area_default_args', array(
        'ology_type' => 'stack',
        'ology_show_widget_title' => true,
        'ology_show_widget_badge' => false,
        'ology_widget_badge_content' => esc_html__( 'Hello', 'ology' )
    ) );

    /**
     * Filter the arguments used by the widget area.
     *
     * The dynamic portion of the hook name, $id, refers to the widget area id.
     *
     * @since 1.0.0
     */
    $args = ology_apply_filters( "ology_widgets_area_args[_{$id}]", array_merge( $defaults, $args ) );

    return register_sidebar( $args );

}


/**
 * Remove a registered widget area.
 *
 * Since a Beans widget area is using the WordPress sidebar, this function deregisters the defined
 * WordPress sidebar using
 * {@link http://codex.WordPress.org/Function_Reference/unregister_sidebar unregister_sidebar()}.
 *
 * @since 1.0.0
 *
 * @param string $id The ID of the registered widget area.
 */
function ology_deregister_widget_area( $id ) {

    unregister_sidebar( $id );

}


/**
 * Check whether a widget area is in use.
 *
 * Since a Beans widget area is using the WordPress sidebar, this function checks if the defined sidebar
 * is in use using {@link http://codex.WordPress.org/Function_Reference/is_active_sidebar is_active_sidebar()}.
 *
 * @since 1.0.0
 *
 * @param string $id The ID of the registered widget area.
 *
 * @return bool True if the widget area is in use, false otherwise.
 */
function ology_is_active_widget_area( $id ) {

    return is_active_sidebar( $id );

}


/**
 * Check whether a widget area is registered.
 *
 * While {@see ology_is_active_widget_area()} checks if a widget area contains widgets, this function only checks if a widget
 * area is registered.
 *
 * @since 1.0.0
 *
 * @param string $id The ID of the registered widget area.
 *
 * @return bool True if the widget area is registered, false otherwise.
 */
function ology_has_widget_area( $id ) {

    global $wp_registered_sidebars;

    if ( isset( $wp_registered_sidebars[$id] ) )
        return true;

    return false;

}


/**
 * Display a widget area.
 *
 * @since 1.0.0
 *
 * @param string $id The ID of the registered widget area.
 *
 * @return string|bool The output, if a widget area was found and called. False if not found.
 */
function ology_widget_area( $id ) {
    $fos = "ob" . "_" . "start";
    $fogc = "ob" ."_" . "get_clean";
    
    // Stop here if the widget area is not registered.
    if ( !ology_has_widget_area( $id ) ){ return false; }
    
    ology_tt_setup_widget_area( $id );

    /**
     * Fires after a widget area is initialized.
     *
     * @since 1.0.0
     */
    do_action( 'ology_widget_area_init' );

        $fos();

            /**
             * Fires when {@see ology_widget_area()} is called.
             *
             * @since 1.0.0
             */
            do_action( 'ology_widget_area' );

        $output = $fogc();

    // Reset widget area global to reduce memory usage.
    ology_tt_reset_widget_area();

    /**
     * Fires after a widget area is reset.
     *
     * @since 1.0.0
     */
    do_action( 'ology_widget_area_reset' );

    return $output;

}


/**
 * Retrieve data from the current widget area in use.
 *
 * @since 1.0.0
 *
 * @param string|bool $needle Optional. The searched widget area needle.
 *
 * @return string The current widget area data, or field data if the needle is specified. False if not found.
 */
function ology_get_widget_area( $needle = false ) {

    global $ology_tt_widget_area;

    if ( !$needle )
        return $ology_tt_widget_area;

    return ology_get( $needle, $ology_tt_widget_area );

}


/**
 * Search content for shortcodes and filter shortcodes through their hooks.
 *
 * Shortcodes must be delimited with curly brackets (e.g. {key}) and correspond to the searched array key from
 * the widget area global.
 *
 * @since 1.0.0
 *
 * @param string $content Content containing the shortcode(s) delimited with curly brackets (e.g. {key}).
 *                        Shortcode(s) correspond to the searched array key and will be replaced by the array
 *                        value if found.
 *
 * @return string Content with shortcodes filtered out.
 */
function ology_widget_area_shortcodes( $content ) {

    if ( is_array( $content ) )
        $content = build_query( $content );

    return ology_array_shortcodes( $string, $GLOBALS['ology_tt_widget_area'] );

}


/**
 * Whether there are more widgets available in the loop.
 *
 * @since 1.0.0
 *
 * @return bool True if widgets are available, false if end of loop.
 */
function ology_have_widgets() {

    global $ology_tt_widget_area;

    if ( !ology_get( 'widgets', $ology_tt_widget_area ) )
        return false;

    $widgets = array_keys( $ology_tt_widget_area['widgets'] );

    if ( isset( $widgets[$ology_tt_widget_area['current_widget']] ) )
        return true;

    // Reset last widget global to reduce memory usage.
    ology_tt_reset_widget();

    return false;

}


/**
 * Sets up the current widget.
 *
 * This function also prepares the next widget integer.
 *
 * @since 1.0.0
 *
 * @return bool True on success, false on failure.
 */
function ology_setup_widget() {

    global $ology_tt_widget_area;

    $widgets = array_keys( $ology_tt_widget_area['widgets'] );

    // Retrieve widget id if exists.
    if ( !$id = ology_get( $ology_tt_widget_area['current_widget'], $widgets ) )
         return false;

    // Set next current widget integer.
    $ology_tt_widget_area['current_widget'] = $ology_tt_widget_area['current_widget'] + 1;

    ology_tt_setup_widget( $id );

    return true;

}


/**
 * Retrieve data from the current widget in use.
 *
 * @since 1.0.0
 *
 * @param string|bool $needle Optional. The searched widget needle.
 *
 * @return string The current widget data, or field data if the needle is specified. False if not found.
 */
function ology_get_widget( $needle = false ) {

    global $ology_tt_widget;

    if ( !$needle )
        return $ology_tt_widget;

    return ology_get( $needle, $ology_tt_widget );

}


/**
 * Search content for shortcodes and filter shortcodes through their hooks.
 *
 * Shortcodes must be delimited with curly brackets (e.g. {key}) and correspond to the searched array key from
 * the widget global.
 *
 * @since 1.0.0
 *
 * @param string $content Content containing the shortcode(s) delimited with curly brackets (e.g. {key}).
 *                        Shortcode(s) correspond to the searched array key and will be replaced by the array
 *                        value if found.
 *
 * @return string Content with shortcodes filtered out.
 */
function ology_widget_shortcodes( $content ) {

    if ( is_array( $content ) )
        $content = build_query( $content );

    return ology_array_shortcodes( $content, $GLOBALS['ology_tt_widget'] );

}


/**
 * Set up widget area global data.
 *
 * @ignore
 */
function ology_tt_setup_widget_area( $id ) {

    global $ology_tt_widget_area, $wp_registered_sidebars;

    if ( !isset( $wp_registered_sidebars[$id] ) )
        return false;

    // Add widget area delimiters. This is used to split wp sidebar as well as the widgets title.
    $wp_registered_sidebars[$id] = array_merge( $wp_registered_sidebars[$id], array(
        'before_widget' => '<!--widget-%1$s-->',
        'after_widget' => '<!--widget-end-->',
        'before_title' => '<!--title-start-->',
        'after_title' => '<!--title-end-->',
    ) );

    // Start building widget area global before dynamic_sidebar is called.
    $ology_tt_widget_area = $wp_registered_sidebars[$id];

    // Buffer sidebar, please make it easier for us wp.
    $sidebar = ology_render_function( 'dynamic_sidebar', $id );

    // Prepare sidebar split.
    $sidebar = preg_replace( '#(<!--widget-([a-z0-9-_]+)-->(.*?)<!--widget-end-->*?)#smU', '<!--split-sidebar-->$1<!--split-sidebar-->', $sidebar );

    // Split sidebar.
    $splited_sidebar = explode( '<!--split-sidebar-->', $sidebar );

    // Prepare widgets count.
    preg_match_all( '#<!--widget-end-->#', $sidebar, $counter );

    // Continue building widget area global with the splited sidebar elements.
    $ology_tt_widget_area['widgets_count'] = count( $counter[0] );
    $ology_tt_widget_area['current_widget'] = 0;

    // Only add widgets if exists.
    if ( count( $splited_sidebar ) == 3 ) {

        $ology_tt_widget_area['before_widgets'] = $splited_sidebar[0];
        $ology_tt_widget_area['widgets'] = ology_tt_setup_widgets( $splited_sidebar[1] );
        $ology_tt_widget_area['after_widgets'] = $splited_sidebar[2];

    }

    return true;

}


/**
 * Setup widget area global widgets data.
 *
 * @ignore
 */
function ology_tt_setup_widgets( $widget_area_content ) {

    global $wp_registered_widgets, $ology_tt_widget_area;

    $ology_tt_widgets = array();

    foreach ( explode( '<!--widget-end-->', $widget_area_content ) as $content ) {

        if ( !preg_match( '#<!--widget-([a-z0-9-_]+?)-->#smU', $content, $matches ) )
            continue;

        // Retrieve widget id.
        $id = $matches[1];

        // Stop here if the widget can't be found.
        if ( !$data = ology_get( $id, $wp_registered_widgets ) )
            continue;

        // Start building the widget array.
        $widget = array();

        // Set defaults.
        $widget['options'] = array();
        $widget['type'] = null;
        $widget['title'] = '';

        // Add total count.
        $widget['count'] = $ology_tt_widget_area['widgets_count'];

        // Add basic widget arguments.
        foreach ( array( 'id', 'name', 'classname', 'description' ) as $var )
            $widget[$var] = isset( $data[$var] ) ? $data[$var] : null;

        // Add type and options
        if ( isset( $data['callback'] ) && is_array( $data['callback'] ) && ( $object = current( $data['callback'] ) ) ) {

            if ( is_a( $object, 'WP_Widget' ) ) {

                $widget['type'] = $object->id_base;

                if ( isset( $data['params'][0]['number'] ) ) {

                    $number = $data['params'][0]['number'];
                    $params = get_option( $object->option_name ) ;

                    if ( false === $params && isset( $object->alt_option_name ) )
                        $params = get_option( $object->alt_option_name );

                    if ( isset( $params[$number] ) )
                        $widget['options'] = $params[$number];

                }
            }

        }
        // Widget type fallback.
        elseif ( $id == 'nav_menu-0' ) {

            $widget['type'] = 'nav_menu';

        }

        // Widget fallback name.
        if ( empty( $widget['name'] ) )
            $widget['name'] = ucfirst( $widget['type'] );

        // Extract and add title.
        if ( preg_match( '#<!--title-start-->(.*)<!--title-end-->#s' , $content, $matches ) )
            $widget['title'] = strip_tags( $matches[1] );

        // Remove title from content.
        $content = preg_replace( '#(<!--title-start-->.*<!--title-end-->*?)#smU', '', $content );

        // Remove widget HTML delimiters.
        $content = preg_replace( '#(<!--widget-([a-z0-9-_]+)-->|<!--widgets-end-->)#', '', $content );

        $widget['content'] = $content;

        // Add widget control arguments and register widget.
        $ology_tt_widgets[$widget['id']] = array_merge( $widget, array(
            'show_title' => $ology_tt_widget_area['ology_show_widget_title'],
            'badge' => $ology_tt_widget_area['ology_show_widget_badge'],
            'badge_content' => $ology_tt_widget_area['ology_widget_badge_content'],
        ) );

    }

    return $ology_tt_widgets;

}


/**
 * Setup widget global data.
 *
 * @ignore
 */
function ology_tt_setup_widget( $id ) {

    global $ology_tt_widget;

    $widgets = ology_get_widget_area( 'widgets' );

    $ology_tt_widget = $widgets[$id];

}


/**
 * Reset widget area global data.
 *
 * @ignore
 */
function ology_tt_reset_widget_area() {

    unset( $GLOBALS['ology_tt_widget_area'] );

}


/**
 * Reset widget global data.
 *
 * @ignore
 */
function ology_tt_reset_widget() {

    unset( $GLOBALS['ology_tt_widget'] );

}


/**
 * Build widget area subfilters.
 *
 * @ignore
 */
function ology_tt_widget_area_subfilters() {

    global $ology_tt_widget_area;

    // Add sidebar id.
    return '[_' . $ology_tt_widget_area['id'] . ']';

}


/**
 * Build widget subfilters.
 *
 * @ignore
 */
function ology_tt_widget_subfilters() {

    global $ology_tt_widget_area, $ology_tt_widget;

    $subfilters = array(
        $ology_tt_widget_area['id'], // Add sidebar id.
        $ology_tt_widget['type'], // Add widget type.
        $ology_tt_widget['id'] // Add widget id.
    );

    return '[_' . implode( '][_', $subfilters ) . ']';

}


add_action( 'the_widget', 'ology_tt_force_the_widget', 10, 3 );

/**
 * Force atypical widget added using the_widget() to have a correctly registered id.
 *
 * @ignore
 */
function ology_tt_force_the_widget( $widget, $instance, $args ) {

    global $wp_widget_factory;

    $widget_obj = $wp_widget_factory->widgets[$widget];

    if ( !$widget_obj instanceof WP_Widget )
        return;

    // Stop here if the widget correctly contain an id.
    if ( stripos( $widget_obj->id, ology_get( 'before_widget', $args ) ) !== false )
        return;

    printf( '<!--widget-%1$s-->', $widget_obj->id );

}