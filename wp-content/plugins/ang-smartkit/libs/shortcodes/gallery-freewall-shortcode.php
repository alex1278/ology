<?php
/**
 * SHORTCODE :: Portfolio Freewall gallery  with asinchronious pagination [portfolio_freewall]
 *
 * @package      ANG Themes
 * @subpackage  Shortcode/gallery
 * @copyright   Copyright (c) 2016, Aleksandr Glovatskyy
 * @author      Aleksandr Glovatskyy
 * @version     1.0.0
 * @date        22.02.2016
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * This shortcode allows you to specify portfolio post(s)
 * Portfolio Shortcode:
 * [ portfolio_freewall ]  
 * Portfolio Shortcode with parameters:
 * [ portfolio_freewall  limit="8" gutter="10" sortby="comment_count" sort_order="ASC" extra_class="my-extra-class" pagination="off" filter="off" template="freewall" wall_fit="height"]
 * 
 * Animation classes:
                .uk-animation-fade              The element fades in.
                .uk-animation-scale-up          The element scales up.
                .uk-animation-scale-down 	The element scales down.
                .uk-animation-slide-top 	The element slides in from the top.
                .uk-animation-slide-bottom 	The element slides in from the bottom.
                .uk-animation-slide-left 	The element slides in from the left.
                .uk-animation-slide-right 	The element slides in from the right.
                .uk-animation-shake             The element shakes.
                .uk-animation-scale             The element scales down without fading in.
 */
function ang_portfolio_freewall_gallery( $atts ) {
    
	$portfolio_type_terms = get_portfolio_type_terms();
	extract( shortcode_atts( array(
		'post_type' 			=>	'portfolio', // Any post type like "portfolio", "event", "testimonial", "slideshow". Defoult is "portfolio".
		//'status'			=>	array('current' , 'sold' , 'leased' ),
		//'commercial_listing_type'	=>	'',
		//'category_key'		=>	'',
		//'category_value'		=>	'',
		'limit'				=>	'10', // Number of maximum posts to show for first and every next load. Integer.
		'uk_grid_small'			=>	'', // Affects device widths of 480px and higher. Maximum columns max=6, min=1, default=2. Available only for "uikit" template.
                'uk_grid_medium'		=>	'2', // Affects device widths of 768px and higher. Maximum columns max=6, min=1, default=2. Available only for "uikit" template.
                'uk_grid_large'			=>	'4', // Affects device widths of 960px and higher. Maximum columns max=6, min=1, default=2. Available only for "uikit" template.
                'uk_grid_xlarge'		=>	'', // Affects device widths of 1220px and higher. Maximum columns max=6, min=1, default=2. Available only for "uikit" template.
                'uk_flex_gutter'                =>      'on', //"on" or "off" to disable. Available only for "uikit" template. Gutter value is 20px.
                
                'animation_cls'                 =>      '', // Class to add when the element is in view. Available only for "uikit" template. Available params: slide-top, slide-bottom, slide-left, slide-right, fade, shake, scale, scale-up, scale-down.
                'animation_delay'               =>      '0', // Integer. Delay time in ms. (150, 300, 500, 800). Available only for "uikit" template.
                'animation_repeat'              =>      'false', // true or false. Available only for "uikit" template.
                
                'wall_draggable'                =>      'true', // true or false to disable. Available only for "freewall" template. Boolean value. Draggable and sortable gallery items.
                'wall_animate'                  =>      'true', // true or false to disable. Available only for "freewall" template. Boolean value. Animation.
                'wall_delay'                    =>      '20', // enter integer from 0 to infinity, '0' - no delay. Available only for "freewall" template.  Affects to animation duration. Default value is 20px.
                'wall_gutter'                   =>      '20', // enter integer from 0 to infinity, '0' - no gutter. Available only for "freewall" template. Default value is 20px.
                'wall_cell_height'              =>      '170', // gallery image block height identifier (integer). Available only for "freewall" template.
                'wall_cell_width'               =>      '170', // gallery image block width identifier (integer). Available only for "freewall" template.
                'wall_fit'                      =>      'height', //height, width, zone. Available only for "freewall" template.
                'cat'                    	=>	'', // Category id separated by comma.
                'category_name'              	=>	'', // Category. Should be a name like 'fashion' or string of terms separated by comma. For 'portfolio' CPT use 'portfolio-type', 'portfolio_category' taxonomies.
                'taxonomy'              	=>	'', // Any Taxonomy from custom post type. Should be a name like 'fashion', enter only one taxonomy name. ('slideset', 'portfolio_type', 'portfolio_category', 'people', 'emotions', 'animals'). For 'event' CPT use 'event_cat' taxonomy.
                'taxonomy_term'              	=>	'', // Any Taxonomy terms from custom post type. Should be a name like 'fashion' or string of terms separated by comma. For 'event' CPT use 'event_cat' taxonomy terms.
                'taxonomy_2'              	=>	'', // Any Taxonomy from custom post type. Should be a name like 'fashion', enter only one taxonomy name. ('slideset', portfolio_type', 'portfolio_category', 'people', 'emotions', 'animals'). For 'event' CPT use 'event_cat' taxonomy.
                'taxonomy_term_2'              	=>	'', // Any Taxonomy terms from custom post type. Should be a name like 'fashion' or string of terms separated by comma. For 'event' CPT use 'event_cat' taxonomy terms.
                //'portfolio_type'		=>	$portfolio_type_terms, // Portfolio type term slug. Should be a name like 'animals' or string of terms separated by comma.
		//'portfolio_category'		=>	'', // Portfolio category term slug. Should be a name like 'fashion' or string of terms separated by comma. Defoult state shows all categories.
		
                'sortby'			=>	'date', // Options: title, date, rand, modified, comment_count. Default state is date.
		'sort_order'			=>	'DESC', // ASC or DESC.
                'pagination'                    =>      'off', // or "off" to disable. Available only for "freewall", and "uikit" template.
                'wp_img_size'                   =>      'full', // Any registered WP image sizes. Only "uikit" template. ('main-blog-loop', 'music-blog-loop', 'literary-blog-loop', 'fashion-blog-loop')
                'lightbox'                      =>      'on', //"on" or "off" to disable. Show button for fullscreen image view, on mouseover overlay. Available only for "uikit" template.
                'link'                          =>      'on', //"on" or "off" to disable. Show button link to current post, on mouseover overlay. Available only for "uikit" template.
                'title'                         =>      'off', //"on" or "off" to disable.  Show post title, on mouseover overlay. Available only for "uikit" template.
                'overlay_cls'                   =>      'art-style', //overlay classes. Available only for "uikit" template.
                'filter'                        =>      'on', // or "off" to disable. Available only for "freewall" and "uikit" template.
                'template'                      =>      'freewall', // "freewall", "uikit", "nested".
                
                'extra_class'                   =>      '', // enter extra class for custom styling.
                'exclude'                       =>      '', // id separated by comma.
                'author'                        =>      '' // set an integer, author id='25'.
	), $atts ) );
	
        ?>

        <script type="text/javascript">
            /* must define javaScript variables */
            var wallFit = '<?php echo $wall_fit; ?>';
            var wallGutter = <?php echo $wall_gutter; ?>;
            var wallDraggable = <?php echo $wall_draggable; ?>;
            var wallAnimate = <?php echo $wall_animate; ?>;
            var wallDelay = <?php echo $wall_delay; ?>;
            var wallCellH = <?php echo $wall_cell_height; ?>;
            var wallCellW = <?php echo $wall_cell_width; ?>;
        </script>
<?php
	if(empty($post_type)) {
		return;
	}
        
        ob_start();
        
        //start collecting args for WP_Query
	if( !is_array($post_type) ) {
		$post_type 			= array_map('trim',explode(',',$post_type) );
	}
        

        
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	$args = array(
		'post_type' 		=>	$post_type,
		'posts_per_page'	=>	$limit,
		'paged' 		=>	$paged,
                'ignore_sticky_posts'   =>      1,
	);
        
	// Category name for post type
	if(!empty($category_name) ) {
                $args['category_name'][] = $category_name;
	}
        
        // Category id for post type
	if(!empty($cat) ) {
                $args['cat'][] = $cat;
	}
        
        if(empty($taxonomy) && empty($taxonomy_term) && $post_type == 'portfolio'){
            $taxonomy = 'portfolio_type';
            $taxonomy_term = $portfolio_type_terms;
        }
        // get taxonomy terms list for CPT
        if(!empty($taxonomy) && empty($taxonomy_term)){
            // get all terms in the taxonomy
            $terms = get_terms( $taxonomy ); 
            // convert array of term objects to array of term IDs or slugs
            $term_slug = wp_list_pluck( $terms, 'slug' );
//            var_dump($terms);
//            var_dump($term_slug);
            $taxonomy_term = $term_slug;
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
        
        // get second taxonomy  and second taxonomy terms for CPT
	if(!empty($taxonomy_2) && !empty($taxonomy_term_2)  ) {
		if( !is_array( $taxonomy_term_2 ) ) {
			$taxonomy_term_2 = explode(",", $taxonomy_term_2);
			$taxonomy_term_2 = array_map('trim', $taxonomy_term_2);
			
			$args['tax_query'][] = array(
				'taxonomy' => $taxonomy_2,
				'field' => 'slug',
				'terms' => $taxonomy_term_2,
			);
		}
	}
        
        if(!empty($taxonomy) && !empty($portfolio_type) ) {
            $args['tax_query']['relation'] = 'AND';
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
	
	
//	if( isset( $_GET['sortby'] ) ) {
//		$orderby = sanitize_text_field( trim($_GET['sortby']) );
//		if($orderby == 'high') {
//			$args['orderby']	=	'meta_value_num';
//			$args['meta_key']	=	$meta_key_price;
//			$args['order']		=	'DESC';
//		} elseif($orderby == 'low') {
//			$args['orderby']	=	'meta_value_num';
//			$args['meta_key']	=	$meta_key_price;
//			$args['order']		=	'ASC';
//		} elseif($orderby == 'new') {
//			$args['orderby']	=	'post_date';
//			$args['order']		=	'DESC';
//		} elseif($orderby == 'old') {
//			$args['orderby']	=	'post_date';
//			$args['order']		=	'ASC';
//		}
//		
//	}
        
        //exclude posts from main query
	if(!empty($exclude)) {
                $args['post__not_in'] = array($exclude);			
	}
        
        //get author args
        if(!empty($author)) {
                $args['author'] = $author;			
	}
        
        // Apply uk-grid-width parameters and create grid classes
        
        $uk_grid_small = ($uk_grid_small > 0 && $uk_grid_small < 7) ? ' uk-grid-width-small-1-'.$uk_grid_small :'';
        $uk_grid_medium = ($uk_grid_medium > 0 && $uk_grid_medium < 7) ? ' uk-grid-width-medium-1-'.$uk_grid_medium :'';
        $uk_grid_large = ($uk_grid_large > 0 && $uk_grid_large < 7) ? ' uk-grid-width-large-1-'.$uk_grid_large :'';
        $uk_grid_xlarge = ($uk_grid_xlarge > 0 && $uk_grid_xlarge < 7) ? ' uk-grid-width-xlarge-1-'.$uk_grid_xlarge :'';
        
        // Define Gutter between uikit grid columns
        if($uk_flex_gutter === 'on'){
            $uk_flex_gutter = 'gutter: 20,';
        }elseif($uk_flex_gutter == 'off' || $uk_flex_gutter == 0){
            $uk_flex_gutter = '';
        }else{
            $uk_flex_gutter = "gutter: {$uk_flex_gutter},";
        }
        //get animation settings
        $blog_animation = "";
        if($animation_cls != '') {$blog_animation = 'data-uk-scrollspy="{cls:\'uk-animation-'.$animation_cls.'\', delay:'.$animation_delay.', repeat:'.$animation_repeat.'}"';}
        
        //require template
	if($post_type!= ''){
//                        var_dump(get_portfolio_type_terms());
//                        var_dump($portfolio_type);
            switch ($template) {
                case 'freewall':
                    require load_template_path("gallery-freewall-loop-template.php");
                break;
                case 'uikit':
                    require load_template_path("gallery-uikit-loop-template.php");
                break;
                case 'nested':
                    require load_template_path("gallery-nested-loop-template.php");
                break;
            }
        }
        return ob_get_clean();
}
add_shortcode( 'portfolio_freewall', 'ang_portfolio_freewall_gallery' );

//function show_esta_main_gallery(){
//           echo get_esta_main_gallery();
//       }
//add_action( 'show_esta_main_gallery' , 'show_esta_main_gallery' , 10 );


//return all portfolio-type terms

if(!function_exists('get_portfolio_type_terms')){
    function get_portfolio_type_terms(){
        if(post_type_exists('portfolio')){
        $args = array(
            'type'                     => 'portfolio',
            'child_of'                 => 0,
            'parent'                   => '',
            'orderby'                  => 'name',
            'order'                    => 'ASC',
            'hide_empty'               => 1,
            'hierarchical'             => 1,
            'exclude'                  => '',
            'include'                  => '',
            'number'                   => '',
            'taxonomy'                 => 'portfolio-type',
            'pad_counts'               => false 
        );

        $tax_portfolio_types = get_categories( $args );
            if( $tax_portfolio_types ){
                $active_tax_portfolio_types = array();
                foreach ($tax_portfolio_types as $tax_portfolio_t){
                    $active_tax_portfolio_types[]= $tax_portfolio_t->slug;
                }
            }else{
                $active_tax_portfolio_types = '';
            }
            return $active_tax_portfolio_types;
        }else{
            return '';
        }
    }
}