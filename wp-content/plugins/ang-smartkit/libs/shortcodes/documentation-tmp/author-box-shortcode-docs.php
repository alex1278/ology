<?php ?>

<h4>Author box Shortcode:</h4>
    <p>Displays author of current post, page, CPT. Ability to select specific author. Shortcode is flexible and full of settings.</p>
    <pre><code>[ author_box ]</code></pre>
<h4>Shortcode with parameters:</h4>
    <pre><code>[</code>author_box cat_limit='3' show_count='0' aut_ava='on' aut_name='on' aut_country='on' aut_social='twitter,google,facebook' <code>]</code></pre>
<h4>Shortcode settings:</h4>
    <pre>
<code>
'post_type'             =&gt;   'post',                     // Any post type like "portfolio", "event", "testimonial", "slideshow". Defoult is "post".
'cat_limit'             =&gt;   '',                         // Max number of categories to list.
'show_count'            =&gt;   '1',                        // Show category posts count.Intager '0' - disable or '1' - enable.
'aut_id'                =&gt;   '',                         // Set an integer, author id='25'.
'aut_ava'               =&gt;   'on',                       // "on" or "off" to disable author avatar.
'aut_name'              =&gt;   'on',                       // "on" or "off" to disable author name.
'aut_country'           =&gt;   '',                         // "on" or "off" to disable author country.
'aut_slogan'            =&gt;   'on',                       // "on" or "off" to disable author slogan.
'aut_posts'             =&gt;   '',                         // "on" or "off" to disable. Show author posts count.
'aut_descr'             =&gt;   '',                         // "on" or "off" to disable author description.
'aut_social'            =&gt;   'twitter,google,facebook',  // Should be a name like 'pinterest' or string of terms separated by comma. Fill the corresponding fields in author profile first.
'extra_class'           =&gt;   '',                         // Enter extra class for custom styling. Prepared CSS classes: 'art-author-box', 'fashion-author-box', 'night-author-box'.
</code></pre>
