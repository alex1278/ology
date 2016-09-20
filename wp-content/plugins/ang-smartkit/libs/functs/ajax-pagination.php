<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// ang
function ang_wp_ajax_pagination($query = array() ) {
        $template_ajax_ANG = 1;
	if(empty($query)) {
	
	?>
	<div class="epl-paginate-default-wrapper epl-clearfix">
		<div class="alignleft"><?php previous_posts_link( esc_html__( '&laquo; Previous Page', 'ang-plugins' ) ); ?></div>
		<div class="alignright"><?php next_posts_link( esc_html__( 'Next Page &raquo;', 'ang-plugins' ) ); ?></div>
	</div> <?php  } else {
		
        $query_open = $query['query']; 
        $max_page = $query_open->max_num_pages;
        
      
   if (  $max_page > 1 ) : ?>
    <div class="ang-ajax-pagination epl-clearfix uk-clearfix uk-text-center">
        <script>
            var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
            var true_posts = '<?php echo addcslashes (serialize($query_open->query_vars), "'"); ?>';
            var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
            var max_pages = '<?php echo $max_page; ?> ';
            var template = '<?php echo $template_ajax_ANG ;?>';
        </script>
        <div id="true_loadmore" class="uk-button"><?php esc_html_e( 'Load More', 'ang-plugins' ) ; ?> &nbsp;</div>
    </div>
        <?php endif; // load more button
        //wp_reset_postdata();
	  }
} 

// ang
function ang_wp_ajax_infinite_pagination($query = array() ) {
        $template_ajax_ANG = 1;
	if(empty($query)) {
	?>
	<div class="epl-paginate-default-wrapper epl-clearfix">
		<div class="alignleft"><?php previous_posts_link( esc_html__( '&laquo; Previous Page', 'ang-plugins' ) ); ?></div>
		<div class="alignright"><?php next_posts_link( esc_html__( 'Next Page &raquo;', 'ang-plugins' ) ); ?></div>
	</div> <?php  } else {
            
    $query_open = $query['query']; 
   
      //$max_page = $query_open->max_num_pages;
    
   if ( $query_open->max_num_pages  > 1 ) : ?>
    <div class="ang-ajax-pagination epl-clearfix uk-clearfix uk-text-center">
	<script id="true_loadmore">
	var ajaxurl_inf = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
        var true_posts_inf = '<?php echo addcslashes (serialize($query_open->query_vars), "'"); ?>';
	var current_page_inf = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
        var max_pages_inf = '<?php echo $query_open->max_num_pages; ?> ';
        var template_inf = <?php echo $template_ajax_ANG ;?>;
	</script>
        <div id="true_loadmore_inf" class="uk-button"><?php esc_html_e( 'Loading..', 'ang-plugins' )?> &nbsp;&nbsp;&nbsp;<i class="uk-icon-spinner uk-icon-spin uk-icon-small"></i></div>
    </div>
<?php endif;
        //wp_reset_postdata();
		
	  }
}

// ANG posts pagination
// ang
function ANG_ajax_pagination($template_ajax_ANG, $blog_animation='',  $wp_img_size='thumbnail', $overlay_cls='', $title='off', $lightbox='on', $link='on', $query = array()) {
    
        if(!$template_ajax_ANG) $template_ajax_ANG = '';
        $blog_animation = '';
        
	if(empty($query)) {
	
	?>
	<div class="epl-paginate-default-wrapper epl-clearfix">
		<div class="alignleft"><?php previous_posts_link( esc_html__( '&laquo; Previous Page', 'ang-plugins' ) ); ?></div>
		<div class="alignright"><?php next_posts_link( esc_html__( 'Next Page &raquo;', 'ang-plugins' ) ); ?></div>
	</div> <?php  } else {
		
        $query_open = $query['query']; 
        $max_page = $query_open->max_num_pages;
      
   if (  $max_page > 1 ) : ?>
    <div class="ang-ajax-pagination uk-clearfix uk-text-center uk-margin-large-top uk-margin-bottom">
        <script>
            var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
            var true_posts = '<?php echo addcslashes (serialize($query_open->query_vars), "'"); ?>';
            var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
            var max_pages = '<?php echo $max_page; ?>';
            var template = '<?php echo $template_ajax_ANG; ?>';
            var pAnimation = '<?php echo addcslashes($blog_animation, "'") ;?>';
            var pImgSize = '<?php echo $wp_img_size ;?>';
            var pOverlayCls = '<?php echo $overlay_cls ;?>';
            var pTitle = '<?php echo $title ;?>';
            var pLightbox = '<?php echo $lightbox ;?>';
            var pLink = '<?php echo $link ;?>';
            /*
             *  get warp style config
             */
            var warp_style = function getWarpStyle(){
                warp_obj = document.getElementsByTagName("html")[0].getAttribute("data-config");
                warp_rezult = JSON.parse(warp_obj);
                return warp_rezult.style;
            };
            //var warp_style = getWarpStyle();
        </script>
        <div class="true_loadmore_blog uk-button uk-width-1-1 uk-display-inline-block uk-margin-top"><?php esc_html_e( 'Load More', 'ang-plugins' ) ; ?> &nbsp;</div>
    </div>
        <?php endif; // load more button
        //wp_reset_postdata();
	  }
}

add_action('ANG_ajax_pagination','ANG_ajax_pagination', 10, 8);

//ANG portfolio pagination
// ang
function portfolio_gallery_freewall_ajax_pagination($template_ajax_ANG, $query = array()) { 
        
	if(empty($query)) {
	
	?>
	<div class="epl-paginate-default-wrapper epl-clearfix">
		<div class="alignleft"><?php previous_posts_link( esc_html__( '&laquo; Previous Page', 'ang-plugins' ) ); ?></div>
		<div class="alignright"><?php next_posts_link( esc_html__( 'Next Page &raquo;', 'ang-plugins' ) ); ?></div>
	</div> <?php  } else {
		
        $query_open = $query['query']; 
        $max_page = $query_open->max_num_pages;

   if (  $max_page > 1 ) : ?>
    <div class="ang-ajax-wreewall-pagination uk-clearfix uk-text-center uk-height-1-1 uk-vertical-align uk-position-relative">
        <script>
            var ajaxurl_freewall = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
            var true_posts_freewall = '<?php echo addcslashes (serialize($query_open->query_vars), "'"); ?>';
            var current_page_freewall = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
            var max_pages_freewall = '<?php echo $max_page; ?> ';
            var template_freewall = '<?php echo $template_ajax_ANG ;?>';
        </script>
        <div id="true_loadmore_freewall" class="uk-text-center uk-vertical-align-middle"><p><?php esc_html_e('Show more', 'ang-plugins'); ?><p><i class="upanddown" data-icon="&#xe07b;"></i></div>
    </div>
        <?php endif; // load more button
        //wp_reset_postdata();
	  }
}

add_action('portfolio_gallery_freewall_ajax_pagination','portfolio_gallery_freewall_ajax_pagination', 10, 2);

// ang

//ANG posts pagination
// ang
function renter_gallery_ajax_pagination($template_ajax_ANG, $wp_img_size, $overlay_cls, $title, $lightbox, $link, $query = array()) {
    
        if(!$template_ajax_ANG) $template_ajax_ANG = '';
        $blog_animation = '';
        
	if(empty($query)) {
	
	?>
	<div class="epl-paginate-default-wrapper epl-clearfix">
		<div class="alignleft"><?php previous_posts_link( esc_html__( '&laquo; Previous Page', 'ang-plugins' ) ); ?></div>
		<div class="alignright"><?php next_posts_link( esc_html__( 'Next Page &raquo;', 'ang-plugins' ) ); ?></div>
	</div> <?php  } else {
		
        $query_open = $query['query']; 
        $max_page = $query_open->max_num_pages;
      
   if (  $max_page > 1 ) : ?>
    <div class="ang-ajax-pagination uk-clearfix uk-text-center uk-margin-large-top uk-margin-bottom">
        <script>
            var ajaxurl_rent = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
            var true_posts_rent = '<?php echo addcslashes (serialize($query_open->query_vars), "'"); ?>';
            var current_page_rent = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
            var max_pages_rent = '<?php echo $max_page; ?>';
            var template_rent = '<?php echo $template_ajax_ANG; ?>';
            var pImgSize_rent = '<?php echo $wp_img_size ;?>';
            var pOverlayCls_rent = '<?php echo $overlay_cls ;?>';
            var pTitle_rent = '<?php echo $title ;?>';
            var pLightbox_rent = '<?php echo $lightbox ;?>';
            var pLink_rent = '<?php echo $link ;?>';
            
            //var warp_style = getWarpStyle();
        </script>
        <div class="true_loadmore_property uk-button uk-width-1-1 uk-margin-top"><?php esc_html_e( 'Load More', 'ang-plugins' ) ; ?> &nbsp;</div>
    </div>
        <?php endif; // load more button
        //wp_reset_postdata();
	  }
}

add_action('renter_gallery_ajax_pagination','renter_gallery_ajax_pagination', 10, 7);

//renter posts pagination
// ang
function renter_ajax_pagination($template_ajax_renter, $query = array()) {
	if(empty($query)) {
	
	?>
	<div class="epl-paginate-default-wrapper epl-clearfix">
		<div class="alignleft"><?php previous_posts_link( esc_html__( '&laquo; Previous Page', 'ang-plugins' ) ); ?></div>
		<div class="alignright"><?php next_posts_link( esc_html__( 'Next Page &raquo;', 'ang-plugins' ) ); ?></div>
	</div> <?php  } else {
		
        $query_open = $query['query']; 
        $max_page = $query_open->max_num_pages;
      
   if (  $max_page > 1 ) : ?>
    <div class="ang-ajax-pagination uk-clearfix uk-text-center uk-margin-large-top uk-margin-bottom">
        <script>
            var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
            var true_posts = '<?php echo addcslashes (serialize($query_open->query_vars), "'"); ?>';
            var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
            var max_pages = '<?php echo $max_page; ?>';
            var template = '<?php echo $template_ajax_renter; ?>';
        </script>
        <div id="true_loadmore" class="uk-button"><?php esc_html_e( 'Load More', 'ang-plugins' ) ; ?>&nbsp;</div>
    </div>
        <?php endif; // load more button
        //wp_reset_postdata();
	  }
}


function renter_ajax_infinite_pagination($template_ajax_renter, $query = array() ) { 
	if(empty($query)) {
	?>
	<div class="epl-paginate-default-wrapper epl-clearfix">
		<div class="alignleft"><?php previous_posts_link( esc_html__( '&laquo; Previous Page', 'ang-plugins' ) ); ?></div>
		<div class="alignright"><?php next_posts_link( esc_html__( 'Next Page &raquo;', 'ang-plugins' ) ); ?></div>
	</div> <?php  } else {
            
    $query_open = $query['query']; 
   
      //$max_page = $query_open->max_num_pages;
    
   if ( $query_open->max_num_pages  > 1 ) : ?>
    <div class="ang-ajax-pagination epl-clearfix uk-clearfix uk-text-center">
	<script id="true_loadmore">
            var ajaxurl_inf = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
            var true_posts_inf = '<?php echo addcslashes (serialize($query_open->query_vars), "'"); ?>';
            var current_page_inf = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
            var max_pages_inf = '<?php echo $query_open->max_num_pages; ?> ';
            var template_inf = '<?php echo $template_ajax_renter ;?>';
	</script>
        <div id="true_loadmore_inf" class="uk-button"><?php esc_html_e( 'Loading..', 'ang-plugins' ) ; ?> &nbsp;&nbsp;&nbsp;<i class="uk-icon-spinner uk-icon-spin uk-icon-small"></i></div>
    </div>
<?php endif;
        //wp_reset_postdata();
		

	  }
}

 