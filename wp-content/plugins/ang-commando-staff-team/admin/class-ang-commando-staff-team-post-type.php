<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Custom post type class.
 * 
 * @link       http://torbara.com
 * @since      1.0.0
 *
 * @package    Ang_Commando_Staff_Team
 * @subpackage Ang_Commando_Staff_Team/admin
 * @author     Aleksandr Glovatskyy <aleksand1278@gmail.com>
 */
class Ang_Commando_Staff_Team_Post_Type {

    public $post_type_name;
    public $tax_name;
    public $tax_name_second;
    public $plugin_name;

    /**
     * public constructor function.
     *
     * @since   1.3.0
     */
    public function __construct($post_type_name, $tax_name, $tax_name_second, $plugin_name) {

//        $this->post_type_name = 'commando';
//        $this->tax_name = 'commando_cat';
//        $this->tax_name_second = 'department';

        $this->post_type_name       =    $post_type_name;
        $this->tax_name             =    $tax_name;
        $this->tax_name_second      =    $tax_name_second;
        $this->plugin_name          =    $plugin_name;
    }

    /**
     * Register custom post type
     *
     * @since     1.0.0
     */
    public function register_custom_post_type() {

        $archives = defined('ANG_COMMANDO_DISABLE_ARCHIVE') && ANG_COMMANDO_DISABLE_ARCHIVE ? false : true;
        $slug = defined('ANG_COMMANDO_SLUG') ? ANG_COMMANDO_SLUG : $this->post_type_name;
        $rewrite = defined('ANG_COMMANDO_DISABLE_REWRITE') && ANG_COMMANDO_DISABLE_REWRITE ? false : array('slug' => $slug, 'with_front' => false);

        $labels = array(
            'name'                      => _x('Team', 'Post Type General Name', 'ang-commando-staff-team'),
            'singular_name'             => _x('Team', 'Post Type Singular Name', 'ang-commando-staff-team'),
            'menu_name'                 => __('Team', 'ang-commando-staff-team'),
            'name_admin_bar'            => __('Team', 'ang-commando-staff-team'),
            'parent_item_colon'         => __('Parent Team:', 'ang-commando-staff-team'),
            'all_items'                 => __('All Team Members', 'ang-commando-staff-team'),
            'add_new_item'              => __('Add New Team Member', 'ang-commando-staff-team'),
            'add_new'                   => __('Add New', 'ang-commando-staff-team'),
            'new_item'                  => __('Team Member', 'ang-commando-staff-team'),
            'edit_item'                 => __('Edit Team Member', 'ang-commando-staff-team'),
            'update_item'               => __('Update Team Member', 'ang-commando-staff-team'),
            'view_item'                 => __('View Team Member', 'ang-commando-staff-team'),
            'search_items'              => __('Search Team Member', 'ang-commando-staff-team'),
            'not_found'                 => __('Team Member Not found', 'ang-commando-staff-team'),
            'not_found_in_trash'        => __('Team Member Not found in Trash', 'ang-commando-staff-team'),
            'items_list'                => __('Team list', 'ang-commando-staff-team'),
            'items_list_navigation'     => __('Team list navigation', 'ang-commando-staff-team'),
            'filter_items_list'         => __('Filter Team list', 'ang-commando-staff-team'),
        );
        $args = array(
            'label'                     => apply_filters('ang_'.$this->post_type_name.'_label', __('Team', 'ang-commando-staff-team')),
            'description'               => apply_filters('ang_'.$this->post_type_name.'_descr', __('Team members', 'ang-commando-staff-team')),
            'labels'                    => apply_filters('ang_'.$this->post_type_name.'_labels', $labels),
            'supports'                  => apply_filters('ang_'.$this->post_type_name.'_supports', array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments')),
            'hierarchical'              => false,
            'public'                    => true,
            'show_ui'                   => true,
            'show_in_menu'              => true,
            'rewrite'                   => $rewrite,
            'menu_position'             => 16,
            'menu_icon'                 => 'dashicons-universal-access',
            'show_in_admin_bar'         => true,
            'show_in_nav_menus'         => true,
            'can_export'                => true,
            'has_archive'               => $archives,
            'exclude_from_search'       => false,
            'publicly_queryable'        => true,
            'capability_type'           => apply_filters('ang_'.$this->post_type_name.'_capability_type', 'post'),
        );

        register_post_type($slug, apply_filters('register_ang_'.$this->post_type_name.'_arguments', $args));
        flush_rewrite_rules();
    }

    /**
     * Register category custom taxonomy
     *
     * @since     1.0.0
     */
    public function register_first_custom_taxonomy() {

        $labels = array(
            'name'                      => _x('Categories', 'Taxonomy General Name', 'ang-commando-staff-team'),
            'singular_name'             => _x('Category', 'Taxonomy Singular Name', 'ang-commando-staff-team'),
            'menu_name'                 => __('Categories', 'ang-commando-staff-team'),
            'all_items'                 => __('All Categories', 'ang-commando-staff-team'),
            'parent_item'               => __('Parent Category', 'ang-commando-staff-team'),
            'parent_item_colon'         => __('Parent Category:', 'ang-commando-staff-team'),
            'new_item_name'             => __('New Category Name', 'ang-commando-staff-team'),
            'add_new_item'              => __('Add New Category', 'ang-commando-staff-team'),
            'edit_item'                 => __('Edit Category', 'ang-commando-staff-team'),
            'update_item'               => __('Update Category', 'ang-commando-staff-team'),
            'view_item'                 => __('View Category', 'ang-commando-staff-team'),
            'separate_items_with_commas' => __('Separate Categories with commas', 'ang-commando-staff-team'),
            'add_or_remove_items'       => __('Add or remove Categories', 'ang-commando-staff-team'),
            'choose_from_most_used'     => __('Choose from the most used', 'ang-commando-staff-team'),
            'popular_items'             => __('Popular Categories', 'ang-commando-staff-team'),
            'search_items'              => __('Search Categories', 'ang-commando-staff-team'),
            'not_found'                 => __('Not Found', 'ang-commando-staff-team'),
            'items_list'                => __('Categories list', 'ang-commando-staff-team'),
            'items_list_navigation'     => __('Categories list navigation', 'ang-commando-staff-team'),
        );
        $args = array(
            'labels'                    => apply_filters('ang_'.$this->tax_name.'_labels', $labels),
            'hierarchical'              => true,
            'public'                    => true,
            'show_ui'                   => true,
            'show_admin_column'         => true,
            'show_in_nav_menus'         => true,
            'show_tagcloud'             => true,
        );

        register_taxonomy($this->tax_name, array($this->post_type_name), apply_filters('register_ang_'.$this->tax_name.'_arguments', $args));
    }

    /**
     * Register Department custom taxonomy
     *
     * @since     1.0.0
     */
    public function register_second_custom_taxonomy() {

        $labels = array(
            'name'                      => _x('Departments', 'Taxonomy General Name', 'ang-commando-staff-team'),
            'singular_name'             => _x('Department', 'Taxonomy Singular Name', 'ang-commando-staff-team'),
            'menu_name'                 => __('Departments', 'ang-commando-staff-team'),
            'all_items'                 => __('All Departments', 'ang-commando-staff-team'),
            'parent_item'               => __('Parent Department', 'ang-commando-staff-team'),
            'parent_item_colon'         => __('Parent Department:', 'ang-commando-staff-team'),
            'new_item_name'             => __('New Department Name', 'ang-commando-staff-team'),
            'add_new_item'              => __('Add New Department', 'ang-commando-staff-team'),
            'edit_item'                 => __('Edit Department', 'ang-commando-staff-team'),
            'update_item'               => __('Update Department', 'ang-commando-staff-team'),
            'view_item'                 => __('View Department', 'ang-commando-staff-team'),
            'separate_items_with_commas' => __('Separate Departments with commas', 'ang-commando-staff-team'),
            'add_or_remove_items'       => __('Add or remove Department', 'ang-commando-staff-team'),
            'choose_from_most_used'     => __('Choose from the most used', 'ang-commando-staff-team'),
            'popular_items'             => __('Popular Departments', 'ang-commando-staff-team'),
            'search_items'              => __('Search Departments', 'ang-commando-staff-team'),
            'not_found'                 => __('Not Found', 'ang-commando-staff-team'),
            'items_list'                => __('Departments list', 'ang-commando-staff-team'),
            'items_list_navigation'     => __('Departments list navigation', 'ang-commando-staff-team'),
        );
        $args = array(
            'labels'                    => apply_filters('ang_'.$this->tax_name_second.'_labels', $labels),
            'hierarchical'              => true,
            'public'                    => true,
            'show_ui'                   => true,
            'show_admin_column'         => true,
            'show_in_nav_menus'         => true,
            'show_tagcloud'             => true,
        );

        register_taxonomy($this->tax_name_second, array($this->post_type_name), apply_filters('register_ang_'.$this->tax_name_second.'_arguments', $args));
    }

    /**
     * Add admin custom column headings for image
     *
     * @param   array   $defaults
     * @since   1.0.0
     * @return  array   $defaults
     */
    public function register_custom_column_headings($defaults) {
        $new_columns = array(
            'image' => esc_html__('Image', 'ang-commando-staff-team'),
        );

        $last_items = array();

        if (count($defaults) > 2) {
            $last_items = array_slice($defaults, -1);
            array_pop($defaults);
        }

        $defaults = array_merge($defaults, $new_columns);
        $defaults = array_merge($defaults, $last_items);

        return $defaults;
    }

    /**
     * Register admin custom column for image.
     *
     * @access  public
     * @param   string $column_name
     * @since   1.0.0
     * @return  void
     */
    public function register_custom_column($column_name) {
        global $post;

        switch ($column_name) {

            case 'image':
                $value = $this->get_image($post->ID, array(85, 85));
                echo $value;
                break;
            default:
                break;
        }
    }

    /**
     * Get the featured image for the given  id.
     * @param  int 				$id  ID ( Post ID ).
     * @param  string/array/int $size Image dimension.
     * @since  1.0.0
     * @return string       	html image tag
     */
    public static function get_image($id, $size) {
        $response = '';

        if (has_post_thumbnail($id)) {

            // If not a string or an array, and not an integer, default to 150x9999.
            if (( is_int($size) || ( 0 < intval($size) ) ) && !is_array($size)) {
                $size = array(intval($size), intval($size));
            } elseif (!is_string($size) && !is_array($size)) {
                $size = array(50, 50);
            }
            $response = get_the_post_thumbnail(intval($id), $size, array('class' => 'avatar'));
        }

        return $response;
    }

    /**
     * Add meta box to collect post meta information
     *
     * @access public
     * @since  1.0.0
     * @return void
     */
    public function add_custom_meta_box() {
        add_meta_box($this->post_type_name, apply_filters('ang_'.$this->post_type_name.'_meta_box_title', esc_html__('Additional information', 'ang-commando-staff-team')), array($this, 'generate_meta_box'), $this->post_type_name, 'normal', 'high');
    }

    /**
     * Generate meta box markup on admin side
     *
     * @access public
     * @since  1.0.0
     * @return void
     */
    public function generate_meta_box() {
        global $post_id;
        $fields = get_post_custom($post_id);
        $field_data = $this->get_custom_fields_settings();

        $html = '';

        $html .= '<input type="hidden" name="ang_' . $this->post_type_name . '_nonce" id="ang_' . $this->post_type_name . '_nonce" value="' . wp_create_nonce(ANG_COMMANDO_BASE) . '" />';

        if (0 < count($field_data)) {
            $html .= '<table class="form-table">' . "\n";
            $html .= '<tbody>' . "\n";

            foreach ($field_data as $k => $v) {

                $data = $v['default'];
                if (isset($fields['_' . $k]) && isset($fields['_' . $k][0])) {
                    $data = $fields['_' . $k][0];
                }

                $html .= '<tr valign="top"><th scope="row"> <label for="' . esc_attr($k) . '">' . $v['name'] . '</label> </th><td>' . "\n";
                if ('textarea' == $v['type']) {
                    $html .= '<textarea name="' . esc_attr($k) . '" id="' . esc_attr($k) . '" class="' . $v['class'] . '" placeholder="' . $v['placeholder'] . '" rows="5" cols="37">' . esc_attr($data) . '</textarea>' . "\n";
                } elseif ('select' == $v['type']) {
                    $options = $v['options'];
                    $html .= '<select name="' . esc_attr($k) . '" id="' . esc_attr($k) . '" class="' . $v['class'] . '">';
                    foreach ($options as $val => $opt) {
                        $html .= '<option value="' . $val . '"' . selected($val, $data, false) . '>' . $opt . '</option>';
                    }

                    $html .= '</select>' . "\n";
                } else {
                    $html .= '<input name="' . esc_attr($k) . '" type="' . $v['type'] . '" id="' . esc_attr($k) . '" class="' . $v['class'] . '" placeholder="' . $v['placeholder'] . '" value="' . esc_attr($data) . '" />' . "\n";
                }
                $html .= '<span class="description"><i>' . $v['description'] . '</i></span>' . "\n";
                $html .= '</td><tr/>' . "\n";
            }

            $html .= '</tbody>' . "\n";
            $html .= '</table>' . "\n";
        }

        echo $html;
    }

    /**
     * Save custom meta box
     *
     * @access public
     * @since  1.0.0
     * @param int $post_id
     * @return int/void
     */
    public function save_custom_meta_box($post_id) {

        // Verify
        if (( get_post_type() != $this->post_type_name ) || !wp_verify_nonce($_POST['ang_' . $this->post_type_name . '_nonce'], ANG_COMMANDO_BASE)) {
            return $post_id;
        }

        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } else {
            if (!current_user_can('edit_post', $post_id)) {
                return $post_id;
            }
        }

        // Check, if autosave -> do noting with data of our form.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        } //ang


        $field_data = $this->get_custom_fields_settings();
        
        $field_keys = array_keys($field_data);

        foreach ($field_keys as $f) {

            ${$f} = strip_tags(trim($_POST[$f]));

            // Escape the URLs.
            if ('url' == $field_data[$f]['type']) {
                ${$f} = esc_url(${$f});
            }
            if ('text' == $field_data[$f]['type']) {
                ${$f} = htmlspecialchars(${$f}, ENT_COMPAT);
            }
            if ('textarea' == $field_data[$f]['type']) {
                ${$f} = htmlspecialchars(${$f}, ENT_COMPAT);
            }
            if ('hidden' == $field_data[$f]['type']) {
                ${$f} = htmlspecialchars(${$f}, ENT_COMPAT);
            }

            // update database
            if (get_post_meta($post_id, '_' . $f) == '') {
                // add
                add_post_meta($post_id, '_' . $f, ${$f}, true);
            } else if (${$f} != get_post_meta($post_id, '_' . $f, true)) {
                // update
                update_post_meta($post_id, '_' . $f, ${$f});
            } else if (${$f} == '') {
                // delete
                delete_post_meta($post_id, '_' . $f, get_post_meta($post_id, '_' . $f, true));
            }
        }
    }

    /**
     * Get the settings for custom fields.
     * @since  1.0.0
     * @return array
     */
    public function get_custom_fields_settings() {
        $fields = array();
        
        $fields['position'] = array(
            'name' => esc_html__('Position', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide a team member position(for example: "Professor of history").', 'ang-commando-staff-team'),
            'type' => 'text',
            'default' => '',
            'placeholder' => 'Position',
            'class' => 'regular-text',
            'section' => 'info'
        );
        $fields['slogan'] = array(
            'name' => esc_html__('Slogan', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide a team member slogan (for example: "Everything is fine:)").', 'ang-commando-staff-team'),
            'type' => 'text',
            'default' => '',
            'placeholder' => 'Slogan',
            'class' => 'regular-text',
            'section' => 'info'
        );
        $fields['status'] = array(
            'name' => esc_html__('Status  ', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide a team member Status (for example: "I am available").', 'ang-commando-staff-team'),
            'type' => 'text',
            'default' => '',
            'placeholder' => 'Status',
            'class' => 'regular-text',
            'section' => 'info'
        );
        $fields['country'] = array(
            'name' => esc_html__('Country', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide a team member Country (for example: "The USA").', 'ang-commando-staff-team'),
            'type' => 'text',
            'default' => '',
            'placeholder' => 'Country',
            'class' => 'regular-text',
            'section' => 'info'
        );
        $fields['subarb'] = array(
            'name' => esc_html__('Subarb', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide a team member Subarb.', 'ang-commando-staff-team'),
            'type' => 'text',
            'default' => '',
            'placeholder' => 'Subarb',
            'class' => 'regular-text',
            'section' => 'info'
        );
        $fields['city'] = array(
            'name' => esc_html__('City', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide a team member City.', 'ang-commando-staff-team'),
            'type' => 'text',
            'default' => '',
            'placeholder' => 'City',
            'class' => 'regular-text',
            'section' => 'info'
        );
        $fields['address'] = array(
            'name' => esc_html__('Address', 'ang-commando-staff-team'),
            'description' => esc_html__('Address.', 'ang-commando-staff-team'),
            'type' => 'text',
            'default' => '',
            'placeholder' => 'Address',
            'class' => 'regular-text',
            'section' => 'info'
        );
        $fields['phone'] = array(
            'name' => esc_html__('Phone', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide a Phone number(for example: "+380932950866").', 'ang-commando-staff-team'),
            'type' => 'tel',
            'default' => '',
            'placeholder' => 'Phone Number',
            'class' => 'regular-text',
            'section' => 'info'
        );
        $fields['phone2'] = array(
            'name' => esc_html__('Second Phone', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide a second phone number(for example: "+380932950866").', 'ang-commando-staff-team'),
            'type' => 'tel',
            'default' => '',
            'placeholder' => 'Phone Number',
            'class' => 'regular-text',
            'section' => 'info'
        );
        $fields['email'] = array(
            'name' => esc_html__('Email', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide an Email (for example: "alex@gmail.com").', 'ang-commando-staff-team'),
            'type' => 'email',
            'default' => '',
            'placeholder' => 'Email',
            'class' => 'regular-text',
            'section' => 'info'
        );
        $fields['website'] = array(
            'name' => esc_html__('Website', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide an personal website (for example: "http://www.ninja.com").', 'ang-commando-staff-team'),
            'type' => 'url',
            'default' => '',
            'placeholder' => 'URL',
            'class' => 'regular-text',
            'section' => 'info'
        );
        $fields['skype'] = array(
            'name' => esc_html__('Skype', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide an skype nickname (for example: "skype.member.ivan").', 'ang-commando-staff-team'),
            'type' => 'text',
            'default' => '',
            'placeholder' => 'Skype',
            'class' => 'regular-text',
            'section' => 'info'
        );
        $fields['contact_form'] = array(
            'name' => esc_html__('Contact', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide a contact form shortcode. (for example: "[contact_me]")', 'ang-commando-staff-team'),
            'type' => 'text',
            'default' => '',
            'placeholder' => 'Shortcode',
            'class' => 'regular-text',
            'section' => 'info'
        );
        $fields['start_time'] = array(
            'name' => esc_html__('Starts on', 'ang-commando-staff-team'),
            'description' => esc_html__('Start time.', 'ang-commando-staff-team'),
            'type' => 'text',
            'default' => '',
            'placeholder' => 'Start time',
            'class' => 'regular-text',
            'section' => 'info'
        );
        $fields['finished_projects'] = array(
            'name' => esc_html__('Finished Progects', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide a number of finished progects or happy clients.', 'ang-commando-staff-team'),
            'type' => 'text',
            'default' => '',
            'placeholder' => 'finished progects',
            'class' => 'regular-text',
            'section' => 'info'
        );
        $fields['open_progects'] = array(
            'name' => esc_html__('Open Progects', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide a number of open progects.', 'ang-commando-staff-team'),
            'type' => 'text',
            'default' => '',
            'placeholder' => 'Progects in work',
            'class' => 'regular-text',
            'section' => 'info'
        );
        $fields['extra'] = array(
            'name' => esc_html__('Extra field', 'ang-commando-staff-team'),
            'description' => esc_html__('Additional Information.', 'ang-commando-staff-team'),
            'type' => 'text',
            'default' => '',
            'placeholder' => 'Text',
            'class' => 'regular-text',
            'section' => 'info'
        );
        $fields['star_rating'] = array(
            'name' => esc_html__('Rating', 'ang-commando-staff-team'),
            'description' => esc_html__('Rate it with stars.', 'ang-commando-staff-team'),
            'type' => 'select',
            'default' => '',
            'placeholder' => '',
            'class' => 'star-select',
            'section' => 'info',
            'options' => array(
                '1' => esc_html__('1 Star', 'ang-commando-staff-team'),
                '2' => esc_html__('2 Stars', 'ang-commando-staff-team'),
                '3' => esc_html__('3 Stars', 'ang-commando-staff-team'),
                '4' => esc_html__('4 Stars', 'ang-commando-staff-team'),
                '5' => esc_html__('5 Stars', 'ang-commando-staff-team'),
            ),
        );
        $fields['facebook'] = array(
            'name' => esc_html__('Facebook', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide Facebook URL (for example: https://www.facebook.com/torbaracom/ ).', 'ang-commando-staff-team'),
            'type' => 'url',
            'default' => '',
            'placeholder' => 'Facebook URL',
            'class' => 'regular-text',
            'section' => 'social'
        );
        $fields['twitter'] = array(
            'name' => esc_html__('Twitter', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide Twitter URL (for example: https://twitter.com/torbaracom/ ).', 'ang-commando-staff-team'),
            'type' => 'url',
            'default' => '',
            'placeholder' => 'Twitter URL',
            'class' => 'regular-text',
            'section' => 'social'
        );
        $fields['youtube'] = array(
            'name' => esc_html__('Youtube', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide Youtube URL (for example: https://www.facebook.com/torbaracom/ ).', 'ang-commando-staff-team'),
            'type' => 'url',
            'default' => '',
            'placeholder' => 'Youtube URL',
            'class' => 'regular-text',
            'section' => 'social'
        );
        $fields['gplus'] = array(
            'name' => esc_html__('Google Plus', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide Google Plus URL (for example: https://www.facebook.com/torbaracom/ ).', 'ang-commando-staff-team'),
            'type' => 'url',
            'default' => '',
            'placeholder' => 'Google Plus URL',
            'class' => 'regular-text',
            'section' => 'social'
        );
        $fields['file_url'] = array(
            'name' => esc_html__('File URL', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide Download file URL (for example: "https://github.com/alex1278/ang-timeline/archive/master.zip").', 'ang-commando-staff-team'),
            'type' => 'url',
            'default' => '',
            'placeholder' => 'Download file URL (doc, xls, pdf ets.)',
            'class' => 'regular-text',
            'section' => 'info',
        );
        $fields['video_url'] = array(
            'name' => esc_html__('Video URL', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide Video URL (for example: "https://www.youtube.com/watch?t=1&v=YQYQclhnigQ").', 'ang-commando-staff-team'),
            'type' => 'url',
            'default' => '',
            'placeholder' => 'Url',
            'class' => 'regular-text',
            'section' => 'info'
        );
        
        $fields['case_commando'] = array(
            'name' => esc_html__('Case', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide a name for team member duties.', 'ang-commando-staff-team'),
            'type' => 'text',
            'default' => '',
            'placeholder' => 'Case name',
            'class' => 'regular-text',
            'section' => 'info'
        );
        $fields['case_descr'] = array(
            'name' => esc_html__('Description', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide a case description.', 'ang-commando-staff-team'),
            'type' => 'textarea',
            'default' => '',
            'placeholder' => 'Case descr',
            'class' => 'textarea-field',
            'section' => 'info'
        );
        $fields['skill_name1'] = array(
            'name' => esc_html__('Skill Name', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide a skill title for skill identification (for example: "Happy clients")', 'ang-commando-staff-team'),
            'type' => 'text',
            'default' => '',
            'placeholder' => 'Skill title 1',
            'class' => 'regular-text',
            'section' => 'skills'
        );
        $fields['skill_level1'] = array(
            'name' => esc_html__('Skill Level', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide a skill level (number or percent)', 'ang-commando-staff-team'),
            'type' => 'text',
            'default' => '',
            'placeholder' => 'Skill level 1',
            'class' => 'regular-text',
            'section' => 'skills'
        );
        $fields['skill_name2'] = array(
            'name' => esc_html__('Skill Name 2', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide a skill title 2 for skill identification (for example: "Happy clients")', 'ang-commando-staff-team'),
            'type' => 'text',
            'placeholder' => 'Skill title 2',
            'class' => 'regular-text',
            'default' => '',
            'section' => 'skills'
        );
        $fields['skill_level2'] = array(
            'name' => esc_html__('Skill Level 2', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide a skill level 2 (number or percent)', 'ang-commando-staff-team'),
            'type' => 'text',
            'placeholder' => 'Skill level 2',
            'class' => 'regular-text',
            'default' => '',
            'section' => 'skills'
        );
        $fields['skill_name3'] = array(
            'name' => esc_html__('Skill Name 3', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide a skill title 3 for skill identification (for example: "Happy clients")', 'ang-commando-staff-team'),
            'type' => 'text',
            'default' => '',
            'placeholder' => 'Skill title 3',
            'class' => 'regular-text',
            'section' => 'skills'
        );
        $fields['skill_level3'] = array(
            'name' => esc_html__('Skill Level 3', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide a skill level 3 (number or percent)', 'ang-commando-staff-team'),
            'type' => 'text',
            'default' => '',
            'placeholder' => 'Skill level 3',
            'class' => 'regular-text',
            'section' => 'skills'
        );
        $fields['skill_name4'] = array(
            'name' => esc_html__('Skill Name 4', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide a skill title 4 for skill identification (for example: "Happy clients")', 'ang-commando-staff-team'),
            'type' => 'text',
            'default' => '',
            'placeholder' => 'Skill title 4',
            'class' => 'regular-text',
            'section' => 'skills'
        );
        $fields['skill_level4'] = array(
            'name' => esc_html__('Skill Level 4', 'ang-commando-staff-team'),
            'description' => esc_html__('Provide a skill level 4 (number or percent)', 'ang-commando-staff-team'),
            'type' => 'text',
            'default' => '',
            'placeholder' => 'Skill level 4',
            'class' => 'regular-text',
            'section' => 'skills'
        );


        return $fields;
    }

    /**
     * Define path for cuctom post type single page.
     *
     * @access public
     * @since  1.0.0
     * @param string $template_path
     * @return void
     */
    public function include_template_single_cpt($template_path) {
        if (get_post_type() == $this->post_type_name) {
            if (is_single()) {
                // checks if the file exists in the theme first,
                // otherwise serve the file from the plugin
                if ($theme_file = locate_template(
                        array(
                            'single-' . $this->post_type_name . '.php',
                            $this->plugin_name.'/single-' . $this->post_type_name . '.php',
                            'layouts/single-' . $this->post_type_name . '.php',
                        )
                        )
                ) {
                    $template_path = $theme_file;
                } else {
                    $template_path = plugin_dir_path(dirname(__FILE__)) . 'public/templates/single-' . $this->post_type_name . '.php';
                }
            }
        }
        return $template_path;
    }
    
    /**
     * Define path for cuctom post type archive page.
     *
     * @access public
     * @since  1.0.0
     * @param string $template_path
     * @return void
     */
    public function include_template_archive_cpt($template_path) {
        if (get_post_type() == $this->post_type_name) {
            if (is_archive()) {
                // checks if the file exists in the theme first,
                // otherwise serve the file from the plugin
                if ($theme_file = locate_template(
                        array(
                            'archive-' . $this->post_type_name . '.php',
                            $this->plugin_name.'/archive-' . $this->post_type_name . '.php',
                            'layouts/archive-' . $this->post_type_name . '.php',
                        )
                        )
                ) {
                    $template_path = $theme_file;
                } else {
                    $template_path = plugin_dir_path(dirname(__FILE__)) . 'public/templates/archive-' . $this->post_type_name . '.php';
                }
            }
        }
        return $template_path;
    }

}
