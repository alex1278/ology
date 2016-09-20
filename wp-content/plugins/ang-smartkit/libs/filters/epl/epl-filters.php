<?php

 // Plugin Name: Easy Property Listings - Custom Settings
 //Plugin URL: https://easypropertylistings.com.au/
 //Description: Adds filters to Easy Property Listings
  
 
 
 
// Modify Property & Rural Listing Type categories
function epl_fl_property_category($array) {
	$array = array(
		'House'  		=>	__('House', 'epl'),
		'Snow' 			=>	__('Snow', 'epl'), // Added Snow
		'Beach'			=>	__('Beach', 'epl'), // Added Beach
		'Unit'			=>	__('Unit', 'epl'),	
		'Townhouse'		=>	__('Townhouse', 'epl'),	
		'Villa'			=>	__('Villa', 'epl'),	
		'Apartment'		=>	__('Apartment', 'epl'),	
		'Flat'			=>	__('Flat', 'epl'),	
		'Studio'		=>	__('Studio', 'epl'),	
		//'Warehouse'		=>	__('Warehouse', 'epl'),	// Removed
		'DuplexSemi-detached'	=>	__('Duplex Semi-detached', 'epl'),
		'Alpine'		=>	__('Alpine', 'epl'),	
		'AcreageSemi-rural'	=>	__('Acreage Semi-rural', 'epl'),
		'Retirement'		=>	__('Retirement', 'epl'),	
		'BlockOfUnits'		=>	__('Block Of Units', 'epl'),	
		//'Terrace'		=>	__('Terrace', 'epl'),	// Removed
		'ServicedApartment'	=>	__('Serviced Apartment', 'epl'),
		'Other'			=>	__('Other', 'epl')
	);
	return $array;
}
// Un-comment to enable this filter by removing the //
//add_filter('epl_listing_meta_property_category', 'epl_fl_property_category');
 
 
// Modify Commercial Listing Type Category
function epl_modify_commercial_category($array) {
    $array = array(
        'Big-val'       =>   'Big',
        'Medium-val'    =>   'Medium',
        'Small-val'     =>   'Small'
    );
     
    return $array;
}
// Un-comment to enable this filter by removing the //
//add_filter('epl_listing_meta_commercial_category', 'epl_modify_commercial_category');
 
// Modify Rural Listing Type Category
function epl_modify_rural_category($array) {
    $array = array(
        'huge'      =>   'Huge',
        'farm'      =>   'Farm',
        'oranges'   =>   'Oranges'
    );
     
    return $array;
}
// Un-comment to enable this filter by removing the //
//add_filter('epl_listing_meta_rural_category', 'epl_modify_rural_category');
 
 
// Modify Land Listing Type Category
function epl_modify_land_category($array) {
    $array = array(
        'Commercial-val'    =>   'Commercial',
        'Residential-val'   =>   'Residential'
    );
     
    return $array;
}
// Un-comment to enable this filter by removing the //
// add_filter('epl_listing_meta_land_category', 'epl_modify_land_category');

/*
 * Land and Building size search options
 * These filters let you adjust the size selection for Land and Building search.
 */

function my_custom_listing_search_land_unit_label() {
	$imperial = array(
                'square'	=>	'Square',
                'squareMeter'	=>	'Sq.m.',
                'sqft'		=>	'Sq.ft.',
                'acre'		=>	'Acre',
                'hectare'	=>	'Hectare',
	);
	return $imperial;
}
add_filter( 'epl_listing_search_land_unit_label' , 'my_custom_listing_search_land_unit_label' );
add_filter( 'epl_listing_search_building_unit_label' , 'my_custom_listing_search_land_unit_label' );

/*
 * Number range Dropdown Filters
 */

// Parking select, car spaces 'epl_listing_search_parking_select'

function ang_renter_listing_search_parking_select_filter() {
        $ang_filter_array 	= array_combine(range(10,100,10),array_map('epl_number_suffix_callback',range(10,100,10)) );
	return $ang_filter_array;
}
add_filter( 'epl_listing_search_parking_select' , 'ang_renter_listing_search_parking_select_filter' );

// Rooms select  'epl_listing_search_room_select'

function ang_renter_listing_search_room_select_filter() {
        $ang_filter_array 	= array_combine(range(1,15,2),array_map('epl_number_suffix_callback',range(1,15,2)) );
	return $ang_filter_array;
}
add_filter( 'epl_listing_search_room_select' , 'ang_renter_listing_search_room_select_filter' );

// Bathtooms select  'epl_listing_search_bath_select'

function ang_renter_listing_search_bath_select_filter() {
        $ang_filter_array 	= array_combine(range(1,5),array_map('epl_number_suffix_callback',range(1,5)) );
	return $ang_filter_array;
}
add_filter( 'epl_listing_search_bath_select' , 'ang_renter_listing_search_bath_select_filter' );

// BedRooms min select  'epl_listing_search_bed_select_min'

function ang_renter_listing_search_bed_select_min_filter() {
        $ang_filter_array 	= array_combine(range(1,15,2),array_map('epl_number_suffix_callback',range(1,15,2)) );
	return $ang_filter_array;
}
add_filter( 'epl_listing_search_bed_select_min' , 'ang_renter_listing_search_bed_select_min_filter' );

// BedRooms max select  'epl_listing_search_bed_select_max'

function ang_renter_listing_search_bed_select_max_filter() {
        $ang_filter_array 	= array_combine(range(1,15,2),array_map('epl_number_suffix_callback',range(1,15,2)) );
	return $ang_filter_array;
}
add_filter( 'epl_listing_search_bed_select_max' , 'ang_renter_listing_search_bed_select_max_filter' );


/*
 * Price Range Filters
 */

// price sale filter range
function ang_renter_search_price_range_sale_filter() {
        $min = 100000;
        $max = 5000000;
        $step = 100000;
	$ang_price_array 	= array_combine(range($min,$max,$step),array_map('epl_currency_formatted_amount',range($min,$max,$step)) );
	return $ang_price_array; ?>
        <script type="text/javascript">
            var min = '<?php echo $min; ?>';
            var max = '<?php echo $max; ?>';
            var step = '<?php echo $step; ?>';
        </script>
<?php
}
add_filter( 'epl_listing_search_price_sale' , 'ang_renter_search_price_range_sale_filter' );

// price rental filter range
function ang_renter_search_price_range_rental_filter() {
        $min = 100;
        $max = 3000;
        $step = 100;
	$ang_price_array 	= array_combine(range($min,$max,$step),array_map('epl_currency_formatted_amount',range($min,$max,$step)) );
	return $ang_price_array; ?>
        <script type="text/javascript">
//            var min = '<?php echo $min; ?>';
//            var max = '<?php echo $max; ?>';
//            var step = '<?php echo $step; ?>';
        </script>
<?php
}
add_filter( 'epl_listing_search_price_rental' , 'ang_renter_search_price_range_rental_filter' );


/**
* Modify the Excerpt length on archive pages
*
* @since 1.0
*/
function ang_excerpt_length_renter( $length ) {
	global $post;
        global $epl_settings;
	if ($post->post_type == 'property')
		return epl_archive_custom_excerpt_length($length);
	else if ($post->post_type == 'rental')
		return epl_archive_custom_excerpt_length($length);
	else if ($post->post_type == 'commercial')
		return epl_archive_custom_excerpt_length($length);
	else if ($post->post_type == 'commercial_land')
		return epl_archive_custom_excerpt_length($length);
	else if ($post->post_type == 'business')
		return epl_archive_custom_excerpt_length($length);
	else if ($post->post_type == 'rural')
		return epl_archive_custom_excerpt_length($length);
	else if ($post->post_type == 'land')
		return epl_archive_custom_excerpt_length($length);
	else if ($post->post_type == 'suburb')
		return epl_archive_custom_excerpt_length($length);
	else
		return epl_archive_custom_excerpt_length($length);
}
add_filter('excerpt_length', 'ang_excerpt_length_renter' , 999);
   