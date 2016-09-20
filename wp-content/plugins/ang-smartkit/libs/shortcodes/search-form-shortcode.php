<?php
/*******************************************************************************
 *                          Not finished yet
 * *****************************************************************************/
 
/**
 * SHORTCODE :: Custom Search  Form [custom_search_form]
 *
 * @package     main query loop
 * @subpackage  Shortcode/main query/ ANG
 * @copyright   Copyright (c) 2016, Aleksandr Glovatskyy
 * @since       1.0.0
 * @version     1.0.0
 * @date        10.08.2016
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * This shortcode allows you to specify post(s)
 * Custom Search Shortcode:
 * [ custom_search_form ]  
 * Custom Search Shortcode with parameters:
 * [ custom_search_form post_type="post" limit="6" sortby="comment_count" sort_order="ASC" extra_class="my-extra-class" pagination="off" ]
 */

// Only load on front
if( is_admin() ) {
	return;
}

/* Displays Latest posts from selected category in tabs style */

class ANG_custom_search{
    
    public static function ang_wp_custom_search($atts, $content = null){
        extract(shortcode_atts(array(
                'post_type'                     =>	'any', // Any post type like "portfolio", "event", "testimonial", "slideshow", "product" - WooCommerce ready. Default is "post".
                'limit'				=>	'', // Number of maximum posts to show for first and every next load. Integer.
                'taxonomy'              	=>	'', // Any Taxonomy from custom post type. Should be a name like 'fashion', enter only one taxonomy name. ('people', 'emotions', 'animals'). For 'event' CPT use 'event_cat' taxonomy.
                'taxonomy_term'              	=>	'', // Any Taxonomy terms from custom post type. Should be a name like 'fashion' or string of terms separated by comma. For 'event' CPT use 'event_cat' taxonomy terms.
                'sortby'			=>	'date', // Options: title, date, author, rand, modified, comment_count. Default state is date.
                'sort_order'			=>	'DESC', // ASC or DESC.
                'pagination'                    =>      'off', // "on", "ajax", "both" - will show ajax and ordinary pagination together, "off" to disable pagination.
                'wp_img_size'                   =>      'thumbnail', // Any registered WP image sizes. Only "uikit" template. ('main-blog-loop', 'music-blog-loop', 'literary-blog-loop', 'fashion-blog-loop')
                'button'                        =>      false, // true , false
                
                'extra_class'                   =>      '', // Enter extra class for custom styling.
                'exclude'                       =>      '', // id separated by comma.
                'author'                        =>      '' // Set an integer, author id='25'.
	), $atts ) );
	
        ob_start();
        ?>
        <!-- begin search form -->
        <div class="ang-search-form-wrapp <?php echo $extra_class; ?>">
            <form role="search" action="<?php echo home_url( '/' ) ?>" method="get">
                <p class="ang-custom-search-input">
                    <label for="query"><?php esc_html_e( 'Search', 'text_domain' ); ?></label>
                    <span>
                        <input type="text" name="query" id="query" value="<?php if(!empty($_GET['query'])){echo esc_attr($_GET['query']);} ?>" />
                    </span>
                </p>
                <?php if ($button == true){ ?>
                <p class="ang-custom-search-submit">
                    <span>
                        <input type="submit" id="searchsubmit" value="<?php esc_html_e( 'Search', 'text_domain' ); ?>" />
                    </span>
                </p>
                <?php } ?>
            </form>
        </div>
        <!-- end search form --> 
        <?php
        if(!empty($_GET['query'])){
            $query = esc_attr($_GET['query']);
            
        }else {return;}
        
        //start collecting args for WP_Query
        if( !is_array($post_type) ) {
		$post_type 			= array_map('trim',explode(',',$post_type) );
	}
        
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        $args = array (
                'post_type'           => $post_type,
                'posts_per_page'      => ($limit !='') ? $limit : get_option('posts_per_page'),
                'paged'               => $paged,
                'ignore_sticky_posts' => 1,
                's' => $query,
                'sentence' => 1,
        );
        
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
        
        if(isset($query) && !empty($_GET['query'])){
            $query = esc_attr($_GET['query']);
            //require loop template
                require load_template_path("search-form-template.php");
        }
        
        return ob_get_clean();
    }
    // spesial functions for custom search shortcode
    
    // get search text
    public static function apply_highlight( $the_content , $the_query) {

            return preg_replace( '/' . $the_query . '/i' , '<span style="background-color: #00FF00">$0</span>' , $the_content );

    }

    // highlight search phrase
    public static function get_snippet( $the_content , $the_query ) {

            preg_match( '/' . $the_query . '/i' , $the_content , $matches, PREG_OFFSET_CAPTURE );
            $snippet = '<ul>';

            foreach ($matches as $match):

                    $cutoff = substr( $the_content, 0 , $match[1] );

                    $start = strripos( $cutoff, '<li>' );
                    $end = strpos( $the_content, '</li>' , $match[1] );

                    $snippet .= substr( $the_content, $start, ( $end - $start ) + 4 );

                    //$snippet .= $match[0] . ' - ' . $match[1];

            endforeach;

            $snippet .= '</ul>';

            return $snippet;
    }
    
}

//add_shortcode( 'custom_search_form', array( 'ANG_custom_search', 'ang_wp_custom_search' ) );
    //add_shortcode('custom_search_form', 'ang_wp_custom_search');