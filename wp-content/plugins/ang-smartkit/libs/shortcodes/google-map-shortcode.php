<?php
/**
 * SHORTCODE :: Displays google map with location [googlemap]
 *
 * @package     google maps
 * @subpackage  Shortcode/main query/ iBloga
 * @copyright   Copyright (c) 2016, Aleksandr Glovatskyy
 * @since       1.0.0
 * @version     1.0.0
 * @date        17.03.2016
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * This shortcode allows you to show google map in post
 * Google map Shortcode:
 * [googlemap]
 * Google map with parameters:
 * [googlemap width="600" height="300" src="http://maps.google.com/maps?q=Heraklion,+Greece&hl=en&ll=35.327451,25.140495&spn=0.233326,0.445976& sll=37.0625,-95.677068&sspn=57.161276,114.169922& oq=Heraklion&hnear=Heraklion,+Greece&t=h&z=12"]
 */

// Only load on front
if( is_admin() ) {
	return;
}

function googlemap_function($atts, $content = null) {
   extract(shortcode_atts(array(
      'width'       => '100%',      //  All available measurement units (px, %, em)
      'height'      => '480',       //  All available measurement units (px, %, em)
      'src'         => '',          //  Map link from Google service.
      'class'       => '',          //  extra class.
      //'scroll'      => false,      // "true" - enable scroll zooming effect or "false" - disable scroll zooming effect.
   ), $atts));
   ?>
<script>
    jQuery(function($) {
        // Disable scroll zooming and bind back the click event
        var onMapMouseleaveHandler = function (event) {
          var that = $(this);

          that.on('click', onMapClickHandler);
          that.off('mouseleave', onMapMouseleaveHandler);
          that.find('iframe').css("pointer-events", "none");
        }

        var onMapClickHandler = function (event) {
          var that = $(this);

          // Disable the click handler until the user leaves the map area
          that.off('click', onMapClickHandler);

          // Enable scrolling zoom
          that.find('iframe').css("pointer-events", "auto");

          // Handle the mouse leave event
          that.on('mouseleave', onMapMouseleaveHandler);
        }

        // Enable map zooming with mouse scroll when the user clicks the map
        $('.ang-g-map').on('click', onMapClickHandler);
        
    });
</script>
<?php
   return "<div class='ang-g-map'><iframe style = 'pointer-events:none' width='{$width}' height='{$height}' src='{$src}&output=embed allowfullscreen' ></iframe></div>";
}
add_shortcode("googlemap", "googlemap_function");