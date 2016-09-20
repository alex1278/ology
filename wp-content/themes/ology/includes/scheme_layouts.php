<?php
/*
* @encoding   UTF-8
* @author    Aleksandr Glovatskyy (aleksandr1278@gmail.com)
* @copyright  Copyright ( C ) 2015 torbar (http://torbara.com/). All rights reserved.
* @license  Copyrighted Commercial Software
* @support    support@torbara.com
*/

/*
 *  widgets scheme layouts
 */
function ology_widgets_scheme_layouts_info () { ?>
    <?php add_thickbox(); ?>
    <div class="updated">
        <p><?php echo wp_get_theme(); ?> <?php esc_html_e('Theme comes with a broad range of layout options', 'ology'); ?></p>
        <p><a href="#TB_inline?width=730&height=590&inlineId=tm-widgets-layout-scheme" title="<?php echo wp_get_theme(); ?> <?php esc_html_e('Widgets layout scheme', 'ology'); ?>" class="thickbox"><span class="dashicons dashicons-welcome-widgets-menus"></span> <?php esc_html_e('Show Widgets layout scheme', 'ology'); ?></a></p>
        <div id="tm-widgets-layout-scheme" style="display:none;">
            
            <h3><?php esc_html_e('Widget Layouts', 'ology'); ?></h3>
            <p><?php esc_html_e('The blue widget positions allow to choose a widget layout which defines the widget alignment and proportions: parallel, stacked, first doubled, last doubled and center doubled. You can easily add your own widget layouts.', 'ology'); ?></p>

            <h3><?php esc_html_e('Sidebar Layouts', 'ology'); ?></h3>
            <p><?php esc_html_e('The two available sidebars, highlighted in red, can be switched to the left or right side and their widths can easily be set in the theme administration.', 'ology'); ?></p>

            <h3><?php esc_html_e('Widget Style', 'ology'); ?></h3>
            <p><?php esc_html_e('For widgets in the blue and red positions you can choose different widget styles.', 'ology'); ?></p>
           <?php $theme_url = get_template_directory_uri();?>
            <img src="<?php echo $theme_url;?>/images/scheme_layouts.png"  alt="<?php echo wp_get_theme(); ?> <?php esc_html_e('Widgets layout scheme', 'ology'); ?>"/>
            <img src="<?php echo $theme_url;?>/images/sidebar_layouts.png"  alt="<?php echo wp_get_theme(); ?> <?php esc_html_e('Widgets layout scheme-2', 'ology'); ?>" />
            <img src="<?php echo $theme_url;?>/images/widget_layouts.png"  alt="<?php echo wp_get_theme(); ?> <?php esc_html_e('Widgets layout scheme-3', 'ology'); ?>" />
            
        </div>
    </div>
    <?php
}

if( !function_exists( "ology_widgets_scheme_layouts")){
    function ology_widgets_scheme_layouts (){
        global $pagenow;
        if ( $pagenow == 'widgets.php' ) { add_action('admin_notices', 'ology_widgets_scheme_layouts_info'); }
    }
}
ology_widgets_scheme_layouts();

