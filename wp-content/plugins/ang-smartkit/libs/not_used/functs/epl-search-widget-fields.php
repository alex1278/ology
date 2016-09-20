<?php

	/**
	 * search widget form fields for search widget
	 * @since 2.2
	 */
	function my_custom_epl_search_widget_fields() {
		$fields =  array(
	
			array(
				'key'			=>	'title',
				'label'			=>	__('Title','epl'),
				'type'			=>	'text',
				'default'		=>	''
			),
			array(
				'key'			=>	'post_type',
				'label'			=>	__('Post Type','epl'),
				'default'		=>	array('property'),
				'type'			=>	'select',
				'multiple'		=>	true,
				'options'		=>	epl_get_active_post_types(),
			),
			array(
				'key'			=>	'style',
				'label'			=>	__('Style','epl'),
				'default'		=>	'default',
				'type'			=>	'select',
				'options'		=>	array(
					'default'	=>	__('Default' , 'epl'),
					'wide'		=>	__('Wide' , 'epl'),
					'slim'		=>	__('Slim' , 'epl'),
					'fixed'		=>	__('Fixed Width' , 'epl'),
				)
			),
			array(
				'key'			=>	'property_status',
				'label'			=>	__('Status','epl'),
				'default'		=>	'',
				'type'			=>	'select',
				'options'		=>	array(
					''		=>	__('Any' , 'epl'),
					'current'	=>	__('Current' , 'epl'),
					'sold'		=>	apply_filters( 'epl_sold_label_status_filter' , __('Sold', 'epl') ),
					'leased'	=>	apply_filters( 'epl_leased_label_status_filter' , __('Leased', 'epl') )
				),
			),
			array(
				'key'			=>	'search_id',
				'label'			=>	__('Property ID','epl'),
				'default'		=>	'off',
				'type'			=>	'checkbox',
			),
			array(
				'key'			=>	'search_location',
				'label'			=>	epl_tax_location_label(),
				'default'		=>	'on',
				'type'			=>	'checkbox',
			),
			array(
				'key'			=>	'search_city',
				'label'			=>	epl_labels('label_city'),
				'default'		=>	'off',
				'type'			=>	'checkbox',
			),
			array(
				'key'			=>	'search_state',
				'label'			=>	epl_labels('label_state'),
				'default'		=>	'off',
				'type'			=>	'checkbox',
			),
			array(
				'key'			=>	'search_postcode',
				'label'			=>	epl_labels('label_postcode'),
				'default'		=>	'off',
				'type'			=>	'checkbox',
			),
			array(
				'key'			=>	'search_country',
				'label'			=>	__('Country','epl'),
				'default'		=>	'off',
				'type'			=>	'checkbox',
			),
			array(
				'key'			=>	'search_house_category',
				'label'			=>	__('House Category','epl'),
				'default'		=>	'on',
				'type'			=>	'checkbox',
			),
			array(
				'key'			=>	'house_category_multiple',
				'label'			=>	__('House categories: Multi select','epl'),
				'default'		=>	'off',
				'type'			=>	'checkbox',
			),
			array(
				'key'			=>	'search_price',
				'label'			=>	__('Price','epl'),
				'default'		=>	'on',
				'type'			=>	'checkbox',
			),
			array(
				'key'			=>	'search_price_slider',
				'label'			=>	__('Price slider','epl'),
				'default'		=>	'off',
				'type'			=>	'checkbox',
			),
			array(
				'key'			=>	'search_bed',
				'label'			=>	__('Bed','epl'),
				'default'		=>	'on',
				'type'			=>	'checkbox',
			),
			array(
				'key'			=>	'search_bath',
				'label'			=>	__('Bath','epl'),
				'default'		=>	'on',
				'type'			=>	'checkbox',
			),
			array(
				'key'			=>	'search_rooms',
				'label'			=>	__('Rooms','epl'),
				'default'		=>	'off',
				'type'			=>	'checkbox',
			),
			array(
				'key'			=>	'search_car',
				'label'			=>	__('Car','epl'),
				'default'		=>	'off',
				'type'			=>	'checkbox',
			),
			array(
				'key'			=>	'search_land_area',
				'label'			=>	__('Land Area','epl'),
				'default'		=>	'off',
				'type'			=>	'checkbox',
			),
			array(
				'key'			=>	'search_building_area',
				'label'			=>	__('Building Area','epl'),
				'default'		=>	'off',
				'type'			=>	'checkbox',
			),
			array(
				'key'			=>	'search_other',
				'label'			=>	__('Other Search Options','epl'),
				'default'		=>	'on',
				'type'			=>	'checkbox',
			),
			array(
				'key'			=>	'submit_label',
				'label'			=>	__('Submit Label','epl'),
				'type'			=>	'text',
				'default'		=>	__('Search','epl')
			),
		);
		
		return $fields;
	}
add_filter( 'epl_search_widget_fields' , 'my_custom_epl_search_widget_fields' );

