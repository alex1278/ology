<?php
/**
 * Change default epl settings for admin. 
 */
function ang_renter_display_options_filter($fields) {
    global $epl_settings;
	$opts_epl_gallery_n = array();
	for($i=1; $i<=10; $i++) {
		$opts_epl_gallery_n[$i] = $i;
	}

	$opts_epl_property_card_excerpt_length = array();
	for($i=10; $i<=55; $i++) {
		$opts_epl_property_card_excerpt_length[$i] = $i;
	}

	$opts_epl_features = array();
	for($i=1; $i<=5; $i++) {
		$opts_epl_features[$i] = $i;
	}

	$opts_pages = array( '' => __('Select Page', 'epl') );
	$pages = get_pages();
	
	if(!empty($pages)) {
		foreach($pages as $page) {
			$opts_pages[$page->ID] = $page->post_title;
		}
	}

	$epl_currency_positions = array(
			'before'	=> __('Before - $10', 'epl'), 
			'after'		=> __('After - 10$', 'epl')
			);
	$epl_currency_types = epl_get_currencies();
	$epl_post_types = epl_get_post_types();

	$fields = array(
		array(
			'label'		=>	__('Listing Types and Location Taxonomy' , 'epl'),
			'class'		=>	'core',
			'id'		=>	'general',
			'help'		=>	__('Select the listing types you want to enable and press Save Changes. Refresh the page to see your new activated listing types.' , 'epl') . '<hr/>',
			'fields'	=>	array(
				array(
					'name'		=>	'activate_post_types',
					'label'		=>	__('Listing Types to Enable', 'epl'),
					'type'		=>	'checkbox',
					'opts'		=>	$epl_post_types,
					'help'		=>	__('Note: If they are not visible on the front end visit Dashboard > Settings > Permalinks and press Save Changes.' , 'epl')
				),
				
				array(
					'name'		=>	'label_location',
					'label'		=>	__('Location Taxonomy', 'epl'),
					'type'		=>	'text',
					'help'		=>	__('After changing this setting visit Dashboard > Settings > Permalinks to save the settings.', 'epl'),
					'default'	=>	__('Location' , 'epl')
				)
			)
		),
		
		array(
			'label'		=>	__('Address', 'epl'),
			'class'		=>	'core',
			'id'		=>	'address',
			'fields'	=>	array(

				array(
					'name'		=>	'label_suburb',
					'label'		=>	__('Suburb/Town/City Label', 'epl'),
					'type'		=>	'text',
					'default'	=>	__('Suburb', 'epl')
				),
				
				array(
					'name'		=>	'epl_enable_city_field',
					'label'		=>	__('Additional Address Field', 'epl'),
					'type'		=>	'radio',
					'opts'		=>	array(
						'yes'	=>	__('Enable', 'epl'),
						'no'	=>	__('Disable', 'epl'),
					),
					'default'	=>	'no',
					'help'		=>	__('Use when you need an additional Municipality/Town/City/Region.' , 'epl')
				),
				
				array(
					'name'		=>	'label_city',
					'label'		=>	__('Additional Address Field Label', 'epl'),
					'type'		=>	'text',
					'default'	=>	__('City', 'epl')
				),
				
				array(
					'name'		=>	'label_state',
					'label'		=>	__('State/Province/Region Label', 'epl'),
					'type'		=>	'text',
					'default'	=>	__('State', 'epl')
				),

				array(
					'name'		=>	'label_postcode',
					'label'		=>	__('Postcode/ZIP Label', 'epl'),
					'type'		=>	'text',
					'default'	=>	__('Postcode', 'epl')
				),
				
				array(
					'name'		=>	'epl_enable_country_field',
					'label'		=>	__('Display Country', 'epl'),
					'type'		=>	'radio',
					'opts'		=>	array(
						'yes'	=>	__('Enable', 'epl'),
						'no'	=>	__('Disable', 'epl'),
					),
					'default'	=>	'no',
					'help'		=>	__('Display country with listing address.' , 'epl')
				)
			)
		),
		
		array(
			'label'		=>	__('Labels', 'epl'),
			'class'		=>	'core',
			'id'		=>	'labels',
			'fields'	=>	array(
			
				array(
					'name'		=>	'sticker_new_range',
					'label'		=>	__('Keep Listings flagged "New" for', 'epl'),
					'type'		=>	'number',
					'default'	=>	'7',
					'help'		=>	__('Listings will have a "NEW" Sticker for the defined number of days.', 'epl')
				),
				
				array(
					'name'		=>	'label_new',
					'label'		=>	__('New/Just Listed Label', 'epl'),
					'type'		=>	'text',
					'default'	=>	__('New' , 'epl' )
				),

				array(
					'name'		=>	'label_home_open',
					'label'		=>	__('Home Open Label', 'epl'),
					'type'		=>	'text',
					'default'	=>	__('Home Open', 'epl')
				),
	
				array(
					'name'		=>	'label_poa',
					'label'		=>	__('No Price Label', 'epl'),
					'type'		=>	'text',
					'default'	=>	__('POA', 'epl')
				),
				
				array(
					'name'		=>	'label_under_offer',
					'label'		=>	__('Under Offer Label', 'epl'),
					'type'		=>	'text',
					'default'	=>	__('Under Offer', 'epl')
				),

				array(
					'name'		=>	'label_sold',
					'label'		=>	__('Sold Label', 'epl'),
					'type'		=>	'text',
					'default'	=>	__('Sold', 'epl')
				),
				
				array(
					'name'		=>	'label_leased',
					'label'		=>	__('Leased Label', 'epl'),
					'type'		=>	'text',
					'default'	=>	__('Leased', 'epl')
				),
				
				array(
					'name'		=>	'display_bond',
					'label'		=>	__('Rental Bond/Deposit Display', 'epl'),
					'type'		=>	'radio',
					'opts'		=>	array(
							1	=>	__('Enable', 'epl'),
							0	=>	__('Disable', 'epl')
					),
					'help'		=>	__('Display the Bond/Deposit on rental listings.', 'epl')
				),
				
				array(
					'name'		=>	'label_bond',
					'label'		=>	__('Rental Bond/Deposit Label', 'epl'),
					'type'		=>	'text',
					'default'	=>	__('Bond', 'epl')
				),
			)
		),

		array(
			'label'		=>	__('Listing Single View', 'epl'),
			'class'		=>	'core',
			'id'		=>	'general',
			'help'		=>	__('Configure the default options when viewing a single listing.', 'epl'),
			'fields'	=>	array(
				array(
					'name'		=>	'display_single_gallery',
					'label'		=>	__('Automatically display image gallery?', 'epl'),
					'type'		=>	'radio',
					'opts'		=>	array(
						1	=>	__('Enable', 'epl'),
						0	=>	__('Disable', 'epl')
					),
					'default'	=>	0,
					'help'		=>	__('Images uploaded and attached to a listing will automatically display on the single listing page.', 'epl')
				),

				array(
					'name'		=>	'display_gallery_n',
					'label'		=>	__('Gallery columns?', 'epl'),
					'type'		=>	'select',
					'opts'		=>	$opts_epl_gallery_n,
					'default'	=>	4
				),

				array(
					'name'		=>	'display_feature_columns',
					'label'		=>	__('Feature list columns?', 'epl'),
					'type'		=>	'select',
					'opts'		=>	$opts_epl_features,
					'default'	=>	2
				)
			)
		),
		
		array(
			'label'		=>	__('Listing Archive View', 'epl'),
			'class'		=>	'core',
			'id'		=>	'general',
			'help'		=>	__('Configure the default options for when viewing the archive listing pages.', 'epl'),
			'fields'	=>	array(
				array(
					'name'		=>	'display_excerpt_length',
					'label'		=>	__('Excerpt words', 'epl'),
					'type'		=>	'select',
					'opts'		=>	$opts_epl_property_card_excerpt_length,
					'default'	=>	10,
					'help'		=>	__('This is ignored when using manual excerpts.', 'epl')
				),
				array(
					'name'		=>	'display_archive_view_type',
					'label'		=>	__('Listing view type', 'epl'),
					'type'		=>	'radio',
					'opts'		=>	array(
						'list'	=>	__('List', 'epl'),
						'grid'	=>	__('Grid', 'epl')
					),
					'default'	=>	'list'
				),
				
				array(
					'name'		=>	'use_fancy_navigation',
					'label'		=>	__('Fancy pagination', 'epl'),
					'type'		=>	'select',
					'opts'		=>	array(
						0		=>	__('No, use WordPress default pagination', 'epl'),
						1		=>	__('Yes, use fancy navigation', 'epl'),
                                                2		=>	__('Use Ajax Infinite post loader', 'epl'), //ang
                                                3		=>	__('Use Ajax post loader', 'epl') //ang
					),
					'default'	=>	0
				)
			)
		),
		
		array(
			'label'		=>	__('Search Widget: Tab Labels', 'epl'),
			'class'		=>	'core',
			'id'		=>	'labels',
			'help'		=>	__('Customise the tab labels of the EPL - Search Widget.', 'epl'),
			'fields'	=>	array(

				array(
					'name'		=>	'widget_label_property',
					'label'		=>	__('Property', 'epl'),
					'type'		=>	'text',
					'default'	=>	__('Property', 'epl')
				),
				array(
					'name'		=>	'widget_label_land',
					'label'		=>	__('Land', 'epl'),
					'type'		=>	'text',
					'default'	=>	__('Land', 'epl')
				),
				array(
					'name'		=>	'widget_label_rental',
					'label'		=>	__('Rental', 'epl'),
					'type'		=>	'text',
					'default'	=>	__('Rental', 'epl')
				),
				array(
					'name'		=>	'widget_label_rural',
					'label'		=>	__('Rural', 'epl'),
					'type'		=>	'text',
					'default'	=>	__('Rural', 'epl')
				),
				array(
					'name'		=>	'widget_label_commercial',
					'label'		=>	__('Commercial', 'epl'),
					'type'		=>	'text',
					'default'	=>	__('Commercial', 'epl')
				),
				array(
					'name'		=>	'widget_label_commercial_land',
					'label'		=>	__('Commercial Land', 'epl'),
					'type'		=>	'text',
					'default'	=>	__('Commercial Land', 'epl')
				),
				array(
					'name'		=>	'widget_label_business',
					'label'		=>	__('Business', 'epl'),
					'type'		=>	'text',
					'default'	=>	__('Business', 'epl')
				)
			)
		),

		array(
			'label'		=>	__('Dashboard Listing Columns' , 'epl'),
			'class'		=>	'core',
			'id'		=>	'admin_general',
			'fields'	=>	array(
			
				array(
					'name'		=>	'epl_max_graph_sales_price',
					'label'		=>	__('Graph Max', 'epl'),
					'type'		=>	'number',
					'default'	=>	'2000000',
					'help'		=>	__('Used for bar chart display on listings for sale.' , 'epl')
				),
				
				array(
					'name'		=>	'epl_max_graph_rent_price',
					'label'		=>	__('Graph Rental Max', 'epl'),
					'type'		=>	'number',
					'default'	=>	'2000',
					'help'		=>	__('Rental range.' , 'epl')
				),
				
				array(
					'name'		=>	'epl_admin_thumb_size',
					'label'		=>	__('Image size', 'epl'),
					'type'		=>	'radio',
					'opts'		=>	array(
						'admin-list-thumb'	=>	__('100 X 100', 'epl'),
						'epl-image-medium-crop'	=>	__('300 X 200', 'epl'),
					),
					'default'	=>	'admin-list-thumb',
					'help'		=>	__('Size of the image shown in listing columns in admin area' , 'epl')
				),
				
				array(
					'name'		=>	'admin_unique_id',
					'label'		=>	__('Unique Listing ID column', 'epl'),
					'type'		=>	'radio',
					'opts'		=>	array(
						1	=>	__('Enable', 'epl'),
						0	=>	__('Disable', 'epl')
					),
					'default'	=>	0
				),

				array(
					'name'		=>	'debug',
					'label'		=>	__('Geocode Lat/Long results column', 'epl'),
					'type'		=>	'radio',
					'opts'		=>	array(
						1	=>	__('Enable', 'epl'),
						0	=>	__('Disable', 'epl')
					),
					'default'	=>	0
				),
			),
		),
		
		array(
			'label'		=>	__('Theme Setup' , 'epl'),
			'class'		=>	'core',
			'id'		=>	'theme_setup',
			'help'		=>	__('The following settings will use your theme templates to generate your listing pages. If your listings appear too wide or your sidebar is in the wrong place enable theme compatibility. When this is enabled you can use the included shortcodes like [listing post_type="property" tools_top="on"] to display your listings with sorting and grid options.', 'epl') . '<hr/>',
			'fields'	=>	array(
				
				array(
					'name'		=>	'epl_feeling_lucky',
					'label'		=>	__('Theme Compatibility', 'epl'),
					'type'		=>	'radio',
					'opts'		=>	array(
						'on'	=>	__('Enable', 'epl'),
						'off'	=>	__('Disable', 'epl')
					),
					'default'	=>	'off',
					'help'		=>	__('When using iThemes, Genesis frameworks or your listings look good, leave this disabled.' , 'epl')
				)
			)
		),

		array(
			'label'		=>	__('Theme Setup: Featured Images' , 'epl'),
			'class'		=>	'core',
			'id'		=>	'theme_setup_featured_images',
			'help'		=>	__('Some WordPress themes automatically display featured images on posts and pages which may cause you to see double on your listings. Use the following settings to adjust the featured image behaviour.', 'epl') . '<hr/>',
			'fields'	=>	array(

				array(
					'name'		=>	'help_lucky_theme_featured_image',
					'type'		=>	'help',
					'content'	=>	__('Theme Featured Image Settings' , 'epl')
				),
				
				array(
					'name'		=>	'epl_lucky_disable_theme_single_thumb',
					'label'		=>	__('Single Listing', 'epl'),
					'type'		=>	'checkbox_single',
					'opts'		=>	array(
						'on'	=>	__('Disable', 'epl'),
					),
					'default'	=>	'off'
				),
				
				array(
					'name'		=>	'epl_lucky_disable_archive_thumb',
					'label'		=>	__('Archive Listing', 'epl'),
					'type'		=>	'checkbox_single',
					'opts'		=>	array(
						'on'	=>	__('Disable', 'epl'),
					),
					'default'	=>	'off'
				),
				
				array(
					'name'		=>	'help_lucky_epl_featured_image',
					'type'		=>	'help',
					'content'	=>	'<hr/>' . __('Easy Property Listings Featured Image Settings' , 'epl')
				),
				
				array(
					'name'		=>	'epl_lucky_disable_single_thumb',
					'label'		=>	__('Single Listing', 'epl'),
					'type'		=>	'checkbox_single',
					'opts'		=>	array(
						'on'	=>	__('Disable', 'epl'),
					),
					'default'	=>	'off'
				),
				
				array(
					'name'		=>	'epl_lucky_disable_epl_archive_thumb',
					'label'		=>	__('Archive Listing', 'epl'),
					'type'		=>	'checkbox_single',
					'opts'		=>	array(
						'on'	=>	__('Disable', 'epl'),
					),
					'default'	=>	'off'
				)
			)
		),
		
				
		array(
			'label'		=>	__('Currency' , 'epl'),
			'class'		=>	'core',
			'id'		=>	'currency',
			'fields'	=>	array(
				array(
					'name'	=>	'currency',
					'label'	=>	__('Currency Type', 'epl'),
					'type'	=>	'select',
					'opts'	=>	$epl_currency_types
				),

				array(
					'name'	=>	'currency_position',
					'label'	=>	__('Symbol Position', 'epl'),
					'type'	=>	'select',
					'opts'	=>	$epl_currency_positions
				),

				array(
					'name'	=>	'currency_thousands_separator',
					'label'	=>	__('Thousands Separator', 'epl'),
					'type'	=>	'text'
				),

				array(
					'name'	=>	'currency_decimal_separator',
					'label'	=>	__('Decimal Separator', 'epl'),
					'type'	=>	'text'
				)
			)
		),
		
		array(
			'label'		=>	__('Advanced Settings' , 'epl'),
			'class'		=>	'core',
			'id'		=>	'advanced',
			'fields'	=>	array(
				array(
					'name'		=>	'epl_use_core_css',
					'label'		=>	__('Disable Styles', 'epl'),
					'type'		=>	'checkbox_single',
					'opts'		=>	array(
						'on'	=>	__('Yes', 'epl'),
					),
					'default'	=>	'off',
					'help'		=>	__('Check this to disable all elements.' , 'epl')
				),
				
				array(
					'name'		=>	'uninstall_on_delete',
					'label'		=>	__('Remove Data on Uninstall?', 'epl'),
					'type'		=>	'radio',
					'opts'		=>	array(
						1	=>	__('Enable', 'epl'),
						0	=>	__('Disable', 'epl')
					),
					'help'		=>	__('Check this box if you would like EPL to completely remove all of its data when the plugin is deleted.', 'epl'),
					'default'	=>	0
				)
			)
		)
	);
	return $fields;
}
// Un-comment to enable this filter by removing the //

add_filter('epl_display_options_filter', 'ang_renter_display_options_filter');

 

