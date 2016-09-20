<?php ?>

<h4>Google map Shortcode:</h4>
    <p>Shows google maps with markers. It is easy to change map dimentions.</p>
    <p> - Open Google map in your Internet browser.</br>
        - Set marker.<br>
        - Click "share" button.<br>
        - Move to "Embed map" tab.<br>
        - Copy map link.<br>
        - You just need link which starts with "http://".<br>
        Thats all.</p>
    <pre><code>[ googlemap ]</code></pre>
<h4>Shortcode with parameters:</h4>
    <pre><code>[ googlemap width="600" height="300" src="http://maps.google.com/maps?q=Heraklion,+Greece&amp;hl=en&amp;ll=35.327451,25.140495&amp;spn=0.233326,0.445976&amp; sll=37.0625,-95.677068&amp;sspn=57.161276,114.169922&amp; oq=Heraklion&amp;hnear=Heraklion,+Greece&amp;t=h&amp;z=12" ]</code></pre>
<h4>Shortcode settings:</h4>
    <pre>
<code>
"width"         =&gt;   '640',  // All available measurement units (px, %, em)<br>
"height"        =&gt;   '480',  // All available measurement units (px, %, em)<br>
"src"           =&gt;   '',     // Map link from Google service.<br>
"class"         =&gt;   ''      // Extra class.
</code></pre>

