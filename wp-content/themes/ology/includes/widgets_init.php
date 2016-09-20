<?php
/*
* @encoding   UTF-8
* @author    Aleksandr Glovatskyy (aleksandr1278@gmail.com)
* @copyright  Copyright ( C ) 2015 torbar (http://torbara.com/). All rights reserved.
* @license  Copyrighted Commercial Software
* @support    support@torbara.com
*/


/*
 *  Register sidebars
 */
add_action( 'widgets_init', 'ology_widgets_init' );
function ology_widgets_init() {
    $positions = array(
                "sidebar-a"             => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", 'ology'),
                "sidebar-b"             => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", 'ology'),
                "search"                => esc_html__("This is special sidebar for Search widget.", 'ology'),
                "extra-toolbar"         => esc_html__("This is special sidebar for extra site information.", 'ology'),
                "logo"                  => esc_html__("This is special sidebar for logo widget. In theme settings you can set up use it or not.", 'ology'),
                "logo-small"            => esc_html__("This is special sidebar for small logo widget. In theme settings you can set up use it or not.", 'ology'),
                "menu"                  => esc_html__("This is special sidebar for main menu. All widgets in this position will be dropdown.", 'ology'),
                "toolbar-l"             => esc_html__("Widgets in this sidebar don't have title. Use it for side information.", 'ology'),
                "toolbar-r"             => esc_html__("Widgets in this sidebar don't have title. Use it for side information.", 'ology'),
                'toolbar-dropdown'      => esc_html__('This is special sidebar for extra site information.', 'ology'),
                'toolbar-dropdown-extra'=> esc_html__('This is special sidebar for extra site information.', 'ology'),
                "headerbar"             => esc_html__("This is special sidebar for extra theme information or addition options. Widgets in this sidebar don't have title.", 'ology'),
                "social-sidebar"        => esc_html__("This is special sidebar to display social icons on single blog pages. Use it for social box.", 'ology'),
                "breadcrumbs"           => esc_html__("This is special sidebar for Breadcrumbs. Use it for display your site navigation.", 'ology'),
                "fullscreen"            => esc_html__("This is special sidebar for slide show. This sidebar have fullwidth layout.", 'ology'),
                "top-a"                 => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", 'ology'),
                "top-b"                 => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", 'ology'),
                "top-c"                 => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", 'ology'),
                "top-d"                 => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", 'ology'),
                "top-e"                 => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", 'ology'),
                "top-f"                 => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", 'ology'),
                "top-g"                 => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", 'ology'),
                "bottom-a"              => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", 'ology'),
                "bottom-b"              => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", 'ology'),
                "bottom-c"              => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", 'ology'),
                "bottom-d"              => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", 'ology'),
                "bottom-e"              => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", 'ology'),
                "bottom-f"              => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", 'ology'),
                "bottom-g"              => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", 'ology'),
                "bottom-fullscreen"     => esc_html__("This is special sidebar for slide show. This sidebar have fullwidth layout.", 'ology'),
                "main-top"              => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", 'ology'),
                "main-bottom"           => esc_html__("This is common sidebar. Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings.", 'ology'),
                "footer"                => esc_html__("Widgets in this position can be displayed in different styles with additional icons and badges. Detailed in theme settings. Use it for copyrights.", 'ology'),
                "offcanvas"             => esc_html__("This is special sidebar for mobile menu.", 'ology'),
                "debug"                 => esc_html__("This is special sidebar for debugging your widgets.", 'ology'),
                "notexist"              => esc_html__("This is special sidebar. Use it with widget-short codes.", 'ology')
    );

    foreach ($positions as $name => $desc) {
        register_sidebar(array(
            'name' => $name,
            'id' => $name,
            'description' => $desc,
            'before_widget' => '<!--widget-%1$s<%2$s>-->',
            'after_widget' => '<!--widget-end-->',
            'before_title' => '<!--title-start-->',
            'after_title' => '<!--title-end-->',
        ));
    }
}
