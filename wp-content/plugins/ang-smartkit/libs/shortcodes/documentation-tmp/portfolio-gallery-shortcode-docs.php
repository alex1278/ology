<?php ?>
<h4>Portfolio Shortcode:</h4>
    <p>Displays Custom post type "Portfolio" in various view types. Shortcode is flexible and full of settings. Content Filtering and templates are also available. It is easy to change shortcode settings.</p>
    <pre><code>[ portfolio_freewall ]</code></pre>
<h4>Shortcode with parameters:</h4>
    <pre><code>[ portfolio_freewall  limit="8"</code> <code>gutter</code>="10" <code>sortby</code>="<code>comment_count" sort_order</code>="ASC" <code>extra_class</code>="my-extra-class" <code>pagination</code>="off" filter="off" <code>template</code>="freewall" wall_fit="height"<code>]</code></pre>
<h4>Shortcode settings:</h4>
    <pre>
<code>
'post_type'                 =&gt;   'portfolio', // Any post type like "portfolio", "event", "testimonial", "slideshow". Defoult is "portfolio".
'limit'                     =&gt;   '10',        // Number of maximum posts to show for first and every next load. Integer.
'portfolio_type'            =&gt;   ''           // Portfolio type term slug. Should be a name like 'animals' or string of terms separated by comma.
'portfolio_category'        =&gt;   '',          // Portfolio category term slug. Should be a name like 'fashion' or string of terms separated by comma. Defoult state shows all categories.
'sortby'                    =&gt;   'date',      // Options: title, date, rand, modified, comment_count. Default state is date.
'sort_order'                =&gt;   'DESC',      // ASC or DESC.
'template'                  =&gt;   'freewall',  // "freewall", "uikit", "nested".
'pagination'                =&gt;   'on',        // or "off" to disable. Available only for "freewall", and "uikit" template.
'filter'                    =&gt;   'on',        // or "off" to disable. Available only for "freewall" and "uikit" template.
'wp_img_size'               =&gt;   'full',      // Any registered WP image sizes. Only "uikit" template.
'lightbox'                  =&gt;   'on',        // "on" or "off" to disable. Show button for fullscreen image view, on mouseover overlay.
'link'                      =&gt;   'on',        // "on" or "off" to disable. Show button link to current post, on mouseover overlay.
'title'                     =&gt;   'off',       // "on" or "off" to disable.Show post title, on mouseover overlay.
'overlay_cls'               =&gt;   '',          // overlay classes.
'uk_grid_small'             =&gt;   '1',         // Affects device widths of 480px and higher. Maximum columns max=6, min=1, default=2. Available only for "uikit" template.
'uk_grid_medium'            =&gt;   '2',         // Affects device widths of 768px and higher. Maximum columns max=6, min=1, default=2. Available only for "uikit" template.
'uk_grid_large'             =&gt;   '4',         // Affects device widths of 960px and higher. Maximum columns max=6, min=1, default=2. Available only for "uikit" template.
'uk_grid_xlarge'            =&gt;   '4',         // Affects device widths of 1220px and higher. Maximum columns max=6, min=1, default=2. Available only for "uikit" template.
'uk_flex_gutter'            =&gt;   'on',        // "on" or "off" to disable. Available only for "uikit" template.
'wall_draggable'            =&gt;   'true',      // true or false to disable. Available only for "freewall" template. Boolean value. Draggable and sortable gallery items.
'wall_animate'              =&gt;   'true',      // true or false to disable. Available only for "freewall" template. Boolean value. Animation.
'wall_gutter'               =&gt;   '20',        // enter integer from 0 to infinity, '0' - no gutter. Available only for "freewall" template. Default value is 20px.
'wall_delay'                =&gt;   '20',        // enter integer from 0 to infinity, '0' - no delay. Available only for "freewall" template.Affects to animation duration. Default value is 20px.
'wall_fit'                  =&gt;   'height',    // height, width, zone. Available only for "freewall" template.
'extra_class'               =&gt;   '',          // enter extra class for custom styling.
'animation_cls'             =&gt;   '',          // Class to add when the element is in view. Available only for "uikit" template. Available params: slide-top, slide-bottom, slide-left, slide-right, fade, shake, scale, scale-up, scale-down.
'animation_delay'           =&gt;   '0',         // Integer. Delay time in ms. (150, 300, 500, 800). Available only for "uikit" template.
'animation_repeat'          =&gt;   'false',     // true or false. Available only for "uikit" template.
'exclude'                   =&gt;   '',          // id separated by comma.
'author'                    =&gt;   ''           // set an integer, author id='25'.
</code></pre>