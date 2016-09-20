<?php ?>        
<h4>Blog Shortcode:</h4>
    <p>Displays Custom post types and ordinary WordPress blog posts in various view types. Shortcode is flexible and full of settings. It is easy to change shortcode settings.</p>
    <pre><code>[ main_query_posts ]</code></pre>
<h4>Shortcode with parameters:</h4>
    <pre><code>[ main_query_posts post_type="post" limit="6" uk_grid_medium</code>="4" template</code>="fashion_blog" <code>gutter</code>="medium" <code>sortby</code>="<code>comment_count" sort_order</code>="ASC" <code>extra_class</code>="my-extra-class" <code>pagination</code>="off" <code>grid_parallax</code>="500" <code>]</code></pre>
<h4>You can also write text into shortcode:</h4>
    <pre><code>[ main_query_posts ]</code>Taxonomy from custom post type. Should be a name like...<code>[ /main_query_posts ]</code></pre>
<h4>Shortcode settings:</h4>
    <pre>
<code>
'post_type'             =&gt;   'post',   // Any post type like "portfolio", "event", "testimonial", "slideshow", "product" - WooCommerce ready. Default is "post".
'limit'                 =&gt;   '6',      // Number of maximum posts to show for first and every next load. Integer.
'uk_grid_small'         =&gt;   '1',      // Affects device widths of 480px and higher. Maximum columns max=6, min=1, default=2.
'uk_grid_medium'        =&gt;   '2',      // Affects device widths of 768px and higher. Maximum columns max=6, min=1, default=2.
'uk_grid_large'         =&gt;   '',       // Affects device widths of 960px and higher. Maximum columns max=6, min=1, default=2.
'uk_grid_xlarge'        =&gt;   '',       // Affects device widths of 1220px and higher. Maximum columns max=6, min=1, default=2.
'gutter'                =&gt;   '',       // Available params: collapse, small, medium, large.
'animation_cls'         =&gt;   '',       // Class to add when the element is in view. Available params: slide-top, slide-bottom, slide-left, slide-right, fade, shake, scale, scale-up, scale-down.
'animation_delay'       =&gt;   '0',      // Integer. Delay time in ms. (150, 300, 500, 800).
'animation_repeat'      =&gt;   'false',  // true or false.
'cat'                   =&gt;   '',       // Category id separated by comma.
'category_name'         =&gt;   '',       // Category. Should be a name like 'fashion' or string of terms separated by comma. For 'portfolio' CPT use 'portfolio-type', 'portfolio_category' taxonomies.
'taxonomy'              =&gt;   '',       // Any Taxonomy from custom post type. Should be a name like 'fashion', enter only one taxonomy name. ('people', 'emotions', 'animals'). For 'event' CPT - use 'event_cat' taxonomy, for 'product' CPT (WooCommerce) - use 'product_cat' taxonomy. 
'taxonomy_term'         =&gt;   '',       // Any Taxonomy terms from custom post type. Should be a name like 'fashion' or string of terms separated by comma. For 'event' CPT - use 'event_cat' taxonomy terms, for 'product' CPT (WooCommerce) - use 'product_cat' taxonomy terms.
'sortby'                =&gt;   'date',   // Options: title, date, author, rand, modified, comment_count. Default state is date.
'sort_order'            =&gt;   'DESC',   // ASC or DESC.
'pagination'            =&gt;   'ajax',   // "on", "ajax", "both" - will show ajax and ordinary pagination together, "off" to disable pagination.
'grid_parallax'         =&gt;   '',       // Set an integer without comma and quotes (150, 200, 300, etc.), disabled by default, default value is '150' if set not a number. Not supported with ajax pagination.
'template'              =&gt;   'post',   // 'post' is default template for photographer blog. (Blog tmpl: 'music_blog', 'fashion_blog', 'literary_blog', 'art_blog', 'night_blog', 'photo_blog';  Portfolio tmpl:'music', 'fashion', 'literary', 'art', 'night', 'event'). Also it can be used for WooCommerce products.
'extra_class'           =&gt;   '',       // Enter extra class for custom styling.
'exclude'               =&gt;   '',       // Id separated by comma.
'author'                =&gt;   ''        // Set an integer, author id='25'.
</code></pre>