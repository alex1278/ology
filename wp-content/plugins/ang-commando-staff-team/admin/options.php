<div id="wrapper">
<?php include_once 'setting.php';
extract(get_option('ang_commando_staff_team_options'));
?>

<div class="width70 left">
    <p><?php esc_html_e('To display the Team members, copy and paste this shortcode into the page or widget position where you want to show it.', 'ang-commando-staff-team');?>
        <input type="text" readonly="readonly" value="[co_commando]" style="width: 100px" onfocus="this.select()"/>
    </p>
    <form name="sc_our_commando_post_form" method="post" action="" enctype="multipart/form-data">
        <table class="widefat">
            <thead>
                <tr>
                    <th colspan="2"><b><?php esc_html_e('Team Shortcode Settings', 'ang-commando-staff-team'); ?></b></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php esc_html_e('Template', 'ang-commando-staff-team'); ?></td>
                    <td>
                        <select name="ang_commando_staff_team_options[template]" id="sc_our_commando_template">
                            <option><?php esc_html_e('Select Template', 'ang-commando-staff-team'); ?></option>
                            <option value="columns" <?php echo 'columns' == esc_attr($template) ? 'selected=selected' : ''; ?>><?php esc_html_e('Icons', 'ang-commando-staff-team'); ?></option>                            
                            <option disabled="disabled"><?php esc_html_e('Carousel ( pro version )', 'ang-commando-staff-team'); ?></option>
                        </select>
                    </td>
                </tr>

                <tr id="columns-row">
                    <td><?php esc_html_e('Grid Columns', 'ang-commando-staff-team'); ?></td>
                    <td>
                        <select name="ang_commando_staff_team_options[columns]">
                            <option value="2" <?php echo '2' == esc_attr($columns) ? 'selected=selected' : ''; ?>>2</option>
                            <option value="3" <?php echo '3' == esc_attr($columns) ? 'selected=selected' : ''; ?>>3</option>
                            <option value="4" <?php echo '4' == esc_attr($columns) ? 'selected=selected' : ''; ?>>4</option>
                        </select>
                    </td>
                </tr>                   
                  

                <tr id="font-size-row">
                    <td><?php esc_html_e('Title Font Size', 'ang-commando-staff-team'); ?></td>
                    <td>
                        <input type="number" name="ang_commando_staff_team_options[title_size]" value="<?php echo esc_attr($title_size); ?>" class="width25"/> px
                    </td>
                </tr>       
                <tr>
                    <td><?php esc_html_e('Main Color', 'ang-commando-staff-team'); ?></td>
                    <td>
                        <input class="wp_popup_color width25" type="text" value="<?php echo esc_attr($main_color); ?>" name="ang_commando_staff_team_options[main_color]"/>
                    </td>
                </tr>
                <tr>
                    <td><?php esc_html_e('Link Color', 'ang-commando-staff-team'); ?></td>
                    <td>
                        <input class="wp_popup_color width25" type="text" value="<?php echo esc_attr($accent_color); ?>" name="ang_commando_staff_team_options[accent_color]"/>
                    </td>
                </tr>
                
                <tr>
                    <td><?php esc_html_e('Background Color', 'ang-commando-staff-team'); ?></td>
                    <td>
                        <input class="wp_popup_color width25" type="text" value="<?php echo esc_attr($background_color); ?>" name="ang_commando_staff_team_options[background_color]"/>
                    </td>
                </tr>
                
                <tr>
                    <td><?php esc_html_e('Text Color', 'ang-commando-staff-team'); ?></td>
                    <td>
                        <input class="wp_popup_color width25" type="text" value="<?php echo esc_attr($text_color); ?>" name="ang_commando_staff_team_options[text_color]"/>
                    </td>
                </tr>
                
                <tr>
                    <td><?php esc_html_e('Link Text', 'ang-commando-staff-team'); ?></td>
                    <td>
                        <input type="text" name="ang_commando_staff_team_options[link_text]" value="<?php echo esc_attr($link_text); ?>" class="width25"/><br>
                        <em><?php esc_html_e('Leave empty to hide the link button'); ?></em>
                    </td>
                </tr>


                <tr id="height-row">
                    <td><?php esc_html_e('Word Count', 'ang-commando-staff-team'); ?></td>
                    <td>
                        <input type="number" name="ang_commando_staff_team_options[word_count]" value="<?php echo esc_attr($word_count); ?>" class="width25"/><br>
                    </td>
                </tr>   

                
                <tr>
                    <td><?php esc_html_e('Number of Team members to display', 'ang-commando-staff-team'); ?></td>
                    <td>
                        <input type="text" value="<?php echo esc_attr($member_count); ?>" name="ang_commando_staff_team_options[member_count]" placeholder="-1" class="width25"/><br>
                        <em><?php esc_html_e('Set to -1 to display all', 'ang-commando-staff-team'); ?></em>
                    </td>
                </tr>

            </tbody>
        </table>

        <table class="widefat">
            <thead>
                <tr>
                    <th colspan="2"><b><?php esc_html_e('Single page View Settings', 'ang-commando-staff-team'); ?></b></th>
                </tr>
            </thead>
                <tr>
                    <td><?php esc_html_e('Template', 'ang-commando-staff-team'); ?></td>
                    <td>
                        <select name="ang_commando_staff_team_options[single_template]">
                            <option><?php esc_html_e('Select Template', 'ang-commando-staff-team'); ?></option>
                            <option value="standard" <?php echo 'standard' == esc_attr( $single_template ) ? 'selected=selected' : ''; ?>><?php esc_html_e('Theme Default (single post)', 'ang-commando-staff-team'); ?></option>
                            <option disabled="disabled"><?php esc_html_e('Side Panel', 'ang-commando-staff-team'); ?></option>
                        </select>
                    </td>
                </tr>
                
                <tr id="">
                    <td><?php esc_html_e('Display Cases', 'ang-commando-staff-team'); ?></td>
                    <td>
                        <select name="ang_commando_staff_team_options[single_cases]">
                            <option value="yes" <?php echo 'yes' == esc_attr( $single_icons ) ? 'selected=selected' : ''; ?>><?php esc_html_e('Yes', 'ang-commando-staff-team'); ?></option>
                            <option value="no" <?php echo 'no' == esc_attr( $single_icons ) ? 'selected=selected' : ''; ?>><?php esc_html_e('No', 'ang-commando-staff-team'); ?></option>
                        </select>
                    </td>
                </tr>
                <tr id="">
                    <td><?php esc_html_e('Display Skills', 'ang-commando-staff-team'); ?></td>
                    <td>
                        <select name="ang_commando_staff_team_options[single_skills]">
                            <option value="yes" <?php echo 'yes' == esc_attr( $single_icons ) ? 'selected=selected' : ''; ?>><?php esc_html_e('Yes', 'ang-commando-staff-team'); ?></option>
                            <option value="no" <?php echo 'no' == esc_attr( $single_icons ) ? 'selected=selected' : ''; ?>><?php esc_html_e('No', 'ang-commando-staff-team'); ?></option>
                        </select>
                    </td>
                </tr>
                
                <tr id="">
                    <td><?php esc_html_e('Display Star Rating', 'ang-commando-staff-team'); ?></td>
                    <td>
                        <select name="ang_commando_staff_team_options[single_stars]">
                            <option value="yes" <?php echo 'yes' == esc_attr( $single_stars ) ? 'selected=selected' : ''; ?>><?php esc_html_e('Yes', 'ang-commando-staff-team'); ?></option>
                            <option value="no" <?php echo 'no' == esc_attr( $single_stars ) ? 'selected=selected' : ''; ?>><?php esc_html_e('No', 'ang-commando-staff-team'); ?></option>
                        </select>
                    </td>
                </tr>
                
                <tr id="">
                    <td><?php esc_html_e('Display Social Icons', 'ang-commando-staff-team'); ?></td>
                    <td>
                        <select name="ang_commando_staff_team_options[single_social]">
                            <option value="yes" <?php echo 'yes' == esc_attr( $single_social ) ? 'selected=selected' : ''; ?>><?php esc_html_e('Yes', 'ang-commando-staff-team'); ?></option>
                            <option value="no" <?php echo 'no' == esc_attr( $single_social ) ? 'selected=selected' : ''; ?>><?php esc_html_e('No', 'ang-commando-staff-team'); ?></option>
                        </select>
                    </td>
                </tr>
                
                <tr id="social_links_style_row">
                    <td><?php esc_html_e('Social Icons Style') ?></td>
                    <td>
                        <select name="ang_commando_staff_team_options[single_social_style]">
                            <option value="round" <?php echo 'round' == esc_attr( $single_social_style ) ? 'selected=selected' : ''; ?>><?php esc_html_e('Round', 'ang-commando-staff-team'); ?></option>
                            <option value="flat" <?php echo 'flat' == esc_attr( $single_social_style ) ? 'selected=selected' : ''; ?>><?php esc_html_e('Flat', 'ang-commando-staff-team'); ?></option>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td><?php esc_html_e('Image Style', 'ang-commando-staff-team'); ?></td>
                    <td>
                        <select name="ang_commando_staff_team_options[single_image_style]">
                            <option><?php esc_html_e('Select Style', 'ang-commando-staff-team'); ?></option>
                            <option value="aligncenter" <?php echo 'aligncenter' == esc_attr( $single_image_style ) ? 'selected=selected' : ''; ?>><?php esc_html_e('Center', 'ang-commando-staff-team'); ?></option>
                            <option value="alignleft" <?php echo 'alignleft' == esc_attr( $single_image_style ) ? 'selected=selected' : ''; ?>><?php esc_html_e('Left', 'ang-commando-staff-team'); ?></option>
                            <option value="alignright" <?php echo 'alignright' == esc_attr( $single_image_style ) ? 'selected=selected' : ''; ?>><?php esc_html_e('Right', 'ang-commando-staff-team'); ?></option>
                        </select>
                    </td>
                </tr>

            
        </table>
        
        <table class="widefat">
            <thead>
                <tr>
                    <th colspan="2"><b><?php esc_html_e('Admin Settings', 'ang-commando-staff-team'); ?></b></th>
                </tr>
            </thead>
            
                <!--the checkbox fields-->
                
                <tr>
                    <th colspan="2">
                        <ul>
                            <li><?php esc_html_e('Some scripts and styles are disabled by default to avoid double loading.', 'ang-commando-staff-team'); ?></li>
                            <li><?php esc_html_e('If your Theme was not based on Uikit front-end Framework tick following options to activate scripts ans styles.', 'ang-commando-staff-team'); ?></li>
                        </ul>
                    </th>
                </tr>
                
                <tr>
                    <th><b><?php esc_html_e('Uikit css', 'ang-commando-staff-team'); ?></b></th>
                    <td>
                        <input type='hidden' name='ang_commando_staff_team_options[uikit_css]' value='no'>
                        <label><input type='checkbox' name='ang_commando_staff_team_options[uikit_css]' <?php checked( $uikit_css, 'yes' ); ?> value='yes'> <?php esc_html_e( 'Activate base style', 'ang-commando-staff-team' ); ?></label>
                    </td>
                </tr>
                
                <tr>
                    <th><b><?php esc_html_e('Uikit js', 'ang-commando-staff-team'); ?></b></th>
                    <td>
                        <input type='hidden' name='ang_commando_staff_team_options[uikit_js]' value='no'>
                        <label><input type='checkbox' name='ang_commando_staff_team_options[uikit_js]' <?php checked( $uikit_js, 'yes' ); ?> value='yes'> <?php esc_html_e( 'Activate base script', 'ang-commando-staff-team' ); ?></label>
                </tr>
                
                <tr>
                    <th colspan="2">
                        <hr>
                    </th>
                </tr>
                
                <tr>
                    <th><b><?php esc_html_e('Uninstall', 'ang-commando-staff-team'); ?></b></th>
                    <td>
                        <input type='hidden' name='ang_commando_staff_team_options[delete_on_uninstall]' value='no'>
                        <label><input type='checkbox' name='ang_commando_staff_team_options[delete_on_uninstall]' <?php checked( $delete_on_uninstall, 'yes' ); ?> value='yes'> <?php esc_html_e( 'Delete posts and settings when uninstalling plugin.', 'ang-commando-staff-team' ); ?></label>
                    </td>
                </tr>
                
        </table>

        <input type="hidden" name="ang_commando_staff_team_options[redirect]" value=""/>
        <div style="text-align: right">
            <input type="submit" name="ang_commando_staff_team_save" value="Update" class="button button-primary" />
        </div>

    </form>

    <div class="clear"></div>
    <br>



</div>


</div>
