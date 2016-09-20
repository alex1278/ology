<?php

/**
 * SHORTCODE :: Displays posts and categories with asinchronious pagination [tabs_switcher]
 *
 * @name        Switcher - Tabs
 * @package     main query loop
 * @subpackage  Shortcode/main query/ ANG
 * @copyright   Copyright (c) 2016, Aleksandr Glovatskyy
 * @since       1.0.0
 * @version     1.0.0
 * @date        12.03.2016
 * @link        http://getuikit.com/docs/switcher.html
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * This shortcode allows you to specify post(s)
 * Switcher - Tabs Shortcode:
 * [ tabs_switcher ]  
 * Switcher - Tabs Shortcode with parameters:
 * [ tabs_switcher post_type="post" limit="6" sortby="comment_count" sort_order="ASC" extra_class="my-extra-class" pagination="off"]
 * You can also write text into shortcode:
 * [ tabs_switcher ]  Taxonomy from custom post type. Should be a name like...  [ /tabs_switcher ]  
 * 
 * Sort_order:
           'None' => 'none',
           'Random' => 'rand',
           'Post ID' => 'ID',
           'Post Author' => 'author',
           'Post title' => 'title',
           'Post slug' => 'name',
           'Publication date' => 'date',
           'Modified date' => 'modified',
           'Post_type' => 'type',
           'Parent field' => 'parent',
           'Comments count' => 'comment_count',
           'Menu order' => 'menu_order',
 * Time_format:
            'YEAR' => 'Y',
            'Month dd, YEAR' => 'F j, Y',
            'dd.mm.YEAR' => 'm.j.y',
            'Month, YEAR' => 'F, Y',
            'dd Month, YEAR' => 'j F, Y',
            'Month, dd, YEAR hh:mm AM' => 'F, j, Y g:i A'
 * Tab_position:
 *          uk-tab-flip     =>      Add this class to align tabs right and in reversed order.
            uk-tab-bottom   =>      to place tabs at the bottom.
            uk-tab-left     =>      to align tabs vertically to the left or right side.
            uk-tab-right    =>      to align tabs vertically to the left or right side.
            uk-tab-grid     =>      Justify tabs. To arrange tabs in a grid that takes up full width of its parent element.
            uk-tab-center   =>      Add the class to a <div> element around the tabbed navigation to center tabs
 * Switcher animation:
            fade                =>	The element fades in.
            scale               => 	The items scale up.
            slide-top           => 	The items slide in from the top.
            slide-bottom        => 	The items slide in from the bottom.
            slide-left          => 	The items slide in from the left.
            slide-right         => 	The items slide in from the right.
            slide-horizontal    => 	The items slide horizontally, the direction depending on the adjacency of the item.
            slide-vertical      => 	The items slide vertically, the direction depending on the adjacency of the item.
*/

// Only load on front
if( is_admin() ) {
	return;
}

/* Displays Latest posts from selected category in tabs style */

    function ang_timeline_tabs_switcher($atts, $content = null){
        extract(shortcode_atts(array(
                'post_type'                     =>	'post', // Any post type like "timeline", "portfolio", "event", "testimonial", "slideshow", "product" - WooCommerce ready. Default is "post".
                'limit'				=>	'5', // Number of maximum posts to show for first and every next load. Integer.
                'cat'                    	=>	'', // Category id separated by comma.
                'category_name'              	=>	'', // Category. Should be a name like 'fashion' or string of terms separated by comma. For 'portfolio' CPT use 'portfolio-type', 'portfolio_category' taxonomies.
                'taxonomy'              	=>	'', // Any Taxonomy from custom post type. Should be a name like 'fashion', enter only one taxonomy name. ('people', 'emotions', 'animals'). For 'event' CPT use 'event_cat' taxonomy. For 'timeline' CPT use 'event' taxonomy.
                'taxonomy_term'              	=>	'', // Any Taxonomy terms from custom taxonomy. Should be a name like 'fashion' or string of terms separated by comma. For 'event' CPT use 'event_cat' taxonomy terms. For 'timeline' CPT use 'event' taxonomy terms.
                'sortby'			=>	'date', // Options: title, date, author, rand, modified, comment_count. Default state is date.
                'sort_order'			=>	'DESC', // ASC or DESC.
                'pagination'                    =>      'off',
                'wp_img_size'                   =>      array(350,350), // Any registered WP image sizes.  ( 'thumbnail', 'medium', 'medium-large', 'large', 'full', 'main-blog-loop', 'music-blog-loop', 'literary-blog-loop', 'fashion-blog-loop')
                'title'                         =>      'on', // "on" or "off" to disable.  Show post title, on mouseover overlay. Available only for "uikit" template.
                'link'                          =>      'on', // "on" or "off" to disable. Show button link to current post, on mouseover overlay. Available only for "uikit" template.
                'template'                      =>      'timeline', // 'post' is default template for photographer blog. (Blog tmpl: 'music_blog', 'fashion_blog', 'literary_blog', 'art_blog', 'night_blog', 'photo_blog';  Portfolio tmpl:'music', 'fashion', 'literary', 'art', 'night', 'event')
                
                'uk_grid_small' 		=>	'', // Affects device widths of 480px and higher. Maximum columns max=6, min=1, default=2.
                'uk_grid_medium'		=>	'3', // Affects device widths of 768px and higher. Maximum columns max=6, min=1, default=3.
                'uk_grid_large' 		=>	'', // Affects device widths of 960px and higher. Maximum columns max=6, min=1, default=4.
                'uk_grid_xlarge'		=>	'', // Affects device widths of 1220px and higher. Maximum columns max=6, min=1, default=4.
                'gutter'                        =>      '', // Available params: collapse, small, medium, large.
                
                'animation_cls'                 =>      '', // Class to add when the element is in view. Available params: slide-top, slide-bottom, slide-left, slide-right, fade, shake, scale, scale-up, scale-down, slide-horizontal, slide-vertical. You can also apply multiple animations by using the uk-animation-* classes from the UiKit Animation component. That way you can even create your own custom class to apply a different transition to the switcher.
                
                'connect_id'                    =>      'ang-tab-content', // Add the data-uk-switcher="{connect:'#ID'}" attribute to the element which contains the toggles, targetting the same id as is used on the element containing the content items.
                'switcher_mode'                 =>      'tab', // Set switcher style. (tab, switcher, nav, nav-side, subnav, subnav-pill)
                'tab_grid'                      =>      false, // To arrange tabs in a grid that takes up full width of its parent element.
                'center_tab'                    =>      false, // to center tabs. (when "switcher_mode" equals "tab")
                'tab_position'                  =>      '', // flip, bottom, left, right
                'timeline_meta'                 =>      'on', // "on" or "off" to disable. Hide the timeline meta field value.
                'post_date'                     =>      false, // Hide the date.
                'time_format'                   =>      'F j, Y', // Select date and time format.
                'ya_share'                      =>      false, // Yandex social share buttons. Requers Ya.Share plugin.
                'meta_data'                     =>      false, // Show post meta data(date, comments).
                'excerpt'                       =>      'on', // "on" or "off" to disable. Show post short description if it is or post content if option 'content_words' is higher than '0'.
                'content_words'                 =>      0,  // Show entered number of content words insted of excerpt. Overrides option 'excerpt'.
                'extra_class'                   =>      '', // Enter extra class for custom styling.
                'offset'                        =>      0, // Query posts offset.
                'exclude'                       =>      '', // id separated by comma.
                'author'                        =>      '', // Set an integer, author id='25'.
                
                // Options for Agents or any user
                'role'         => '', // Enter specific user role('property_agent', 'author', 'agent', 'editor', 'contributor', 'subscriber').
                'search'       => '',
                'orderby'      => 'login', // Onli for users ('name', 'login', 'nick').
                
        ), $atts ) );
	
        ob_start();
        
        if(empty($post_type) && empty($role)) {
		return;
	}
        
        //start collecting args for WP_Query
        if( !is_array($post_type) ) {
		$post_type 			= array_map('trim',explode(',',$post_type) );
	}
        
        // Get tab grid items limit{
        if($tab_grid == true){ $limit = ($limit > 6) ? 6 : ($limit < 1 ? 1 : $limit); }
        
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        $args = array (
                'post_type'           => $post_type,
                'posts_per_page'      => $limit,
                'paged'               => $paged,
                'ignore_sticky_posts' => 1,
                'offset'              => $offset,
        );
        
        // Category name for post type
	if(!empty($category_name) ) {
                $args['category_name'][] = $category_name;
	}
        
        // Category id for post type
	if(!empty($cat) ) {
                $args['cat'][] = $cat;
	}
        
        // get taxonomy terms list for CPT
        if(!empty($taxonomy) && empty($taxonomy_term)){
            // get all terms in the taxonomy
            $terms = get_terms( $taxonomy ); 
            // convert array of term objects to array of term IDs or slugs
            $term_slug = wp_list_pluck( $terms, 'slug' );
            $args['tax_query'][] = array(
				'taxonomy' => $taxonomy,
				'field' => 'slug',
				'terms' => $term_slug,
			);
        }
        
        // get taxonomy  and taxonomy terms for CPT
	if(!empty($taxonomy) && !empty($taxonomy_term)  ) {
		if( !is_array( $taxonomy_term ) ) {
			$taxonomy_term = explode(",", $taxonomy_term);
			$taxonomy_term = array_map('trim', $taxonomy_term);
			
			$args['tax_query'][] = array(
				'taxonomy' => $taxonomy,
				'field' => 'slug',
				'terms' => $taxonomy_term,
			);
		}
	}
        
        // query sorting parameters
        if( $sortby != '' ) {
	
		if($sortby == 'title'){
			$args['orderby']	=	'post_title';
			$args['order']		=	'DESC';
		} elseif($sortby == 'rand'){
			$args['orderby']	=	'rand';
			$args['order']		=	'DESC';
		} elseif($sortby == 'modified'){
			$args['orderby']	=	'modified';
			$args['order']		=	'DESC';
		} elseif($sortby == 'comment_count'){
			$args['orderby']	=	'comment_count';
			$args['order']		=	'DESC';
		} elseif($sortby == 'date'){
			$args['orderby']	=	'post_date';
			$args['order']		=	'DESC';

		} else{
                    $args['orderby']            =	$sortby;
                }
                
		$args['order']			=	$sort_order;
	}
        
        //exclude posts from main query
        if(!empty($exclude)) {
                $args['post__not_in'] = array($exclude);				
	}
        
        //get author args
        if(!empty($author)) {
                $args['author'] = $author;			
	}
        
        // Grt switcher mode
        switch ($switcher_mode){
                case 'tab':
                    $toggle_mode = 'uk-tab';
                    $switch_attr = 'data-uk-tab';
                break;
                case 'subnav':
                case 'switcher':
                case '':
                    $toggle_mode = 'uk-subnav';
                    $switch_attr = 'data-uk-switcher';
                break;
                case 'subnav-pill':
                    $toggle_mode = 'uk-subnav uk-subnav-pill';
                    $switch_attr = 'data-uk-switcher';
                break;
                case 'nav':
                    $toggle_mode = 'uk-nav';
                    $switch_attr = 'data-uk-switcher';
                break;
                case 'nav-side':
                    $toggle_mode = 'uk-nav uk-nav-side';
                    $switch_attr = 'data-uk-switcher';
                break;
                default:
                    $toggle_mode = '';
                    $switch_attr = 'data-uk-switcher';
                break;
        }
                
        // Create grid classes for vertical tabs
        $grid_unit = 1;
        $uk_grid_small_first = ($uk_grid_small > 0 && $uk_grid_small < 7) ? ' uk-width-small-'.$grid_unit.'-'.$uk_grid_small :'';
        $uk_grid_medium_first = ($uk_grid_medium > 0 && $uk_grid_medium < 7) ? ' uk-width-medium-'.$grid_unit.'-'.$uk_grid_medium :'';
        $uk_grid_large_first = ($uk_grid_large > 0 && $uk_grid_large < 7) ? ' uk-width-large-'.$grid_unit.'-'.$uk_grid_large :'';
        $uk_grid_xlarge_first = ($uk_grid_xlarge > 0 && $uk_grid_xlarge < 7) ? ' uk-width-xlarge-'.$grid_unit.'-'.$uk_grid_xlarge :'';
        
        // Create grid classes for vertical tabs content
        
        $uk_grid_small_second = ($uk_grid_small > 0 && $uk_grid_small < 7) ? ' uk-width-small-'.((($uk_grid_small - $grid_unit)<= 0) ? 1 : $uk_grid_small - $grid_unit).'-'.$uk_grid_small :'';
        $uk_grid_medium_second = ($uk_grid_medium > 0 && $uk_grid_medium < 7) ? ' uk-width-medium-'.((($uk_grid_medium - $grid_unit)<= 0) ? 1 : $uk_grid_medium - $grid_unit).'-'.$uk_grid_medium :'';
        $uk_grid_large_second = ($uk_grid_large > 0 && $uk_grid_large < 7) ? ' uk-width-large-'.((($uk_grid_large - $grid_unit)<= 0) ? 1 : $uk_grid_large - $grid_unit).'-'.$uk_grid_large :'';
        $uk_grid_xlarge_second = ($uk_grid_xlarge > 0 && $uk_grid_xlarge < 7) ? ' uk-width-xlarge-'.((($uk_grid_xlarge - $grid_unit)<= 0) ? 1 : $uk_grid_xlarge - $grid_unit).'-'.$uk_grid_xlarge :'';
        
        $uk_push = ' uk-push-'.((($uk_grid_medium - $grid_unit)<= 0) ? 1 : $uk_grid_medium - $grid_unit).'-'.$uk_grid_medium;
        $uk_pull = ' uk-pull-'.$grid_unit.'-'.$uk_grid_medium;
        
        // Get the connect ID
        if($connect_id !=''){ $connect_cont = "connect:'#".$connect_id."'";}
        
        //get animation settings
        if($animation_cls != '') {$animation_cls = "animation:'".$animation_cls."'";}
        
        //get switcher data attribute
        $data_attr = $switch_attr.'="{'.$connect_cont.' '.$animation_cls.'}"';
        
        //require loop template
        if($role!= ''){
            
            //Get users args
            $user_args = array(
                'blog_id'      => $GLOBALS['blog_id'],
                'role'         => $role,
                'meta_key'     => '',
                'meta_value'   => '',
                'meta_compare' => '',
                'meta_query'   => array(),
                'include'      => array(),
                'exclude'      => array(),
                'orderby'      => $orderby,
                'order'        => $sort_order,
                'offset'       => $offset,
                'search'       => $search,
                'number'       => $limit,
                'count_total'  => false,
                'fields'       => 'all',
                'who'          => '',
                'date_query'   => array() // look at WP_Date_Query
        );
            
            // Get users template
            require load_template_path("tabs-switcher-user-loop-template.php");
            
        }else{
            if($post_type!= ''){
                global $woo_active;
                // Get post loop template
                    require load_template_path("tabs-switcher-loop-template.php");
            }
        }
        return ob_get_clean();
    }
    add_shortcode('tabs_switcher', 'ang_timeline_tabs_switcher');

