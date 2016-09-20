(function() {
	tinymce.PluginManager.add('ang_mce_button', function( editor, url ) { // button id "ang_mce_button" must be the same everywhere
		editor.addButton( 'ang_mce_button', { // button id "ang_mce_button"
			icon: 'ang-mce-icon', //  css class for button icon
			type: 'menubutton',
                        text: 'ANG', // button name
			title: 'ANG shorts', // button hover tooltip
			menu: [ // first dropdown menu level starts
                                {
                                    text: 'Blogger', // menu title
                                    icon: 'pastetext', //  css class for button icon
                                    menu: [ // second dropdown menu level starts
                                            {
                                                text: 'Blog posts', // menu title
                                                icon: 'emoticons', //  css class for button icon
                                                onclick: function() {
                                                        editor.insertContent('[main_query_posts limit="6"  sortby="date" pagination="off"  template="post" uk_grid_small="1" uk_grid_medium="2" extra_class=""]');
                                                }
                                            },
                                            {
                                                text: 'Portfolio gallery', // menu title
                                                icon: 'emoticons', //  css class for button icon
                                                onclick: function() {
                                                        editor.insertContent('[portfolio_freewall post_type="portfolio" limit="10" template="freewall" pagination="on" sortby="date" filter="on" wp_img_size="full" lightbox="on" uk_grid_small="1" uk_grid_medium="2" uk_grid_large="4" uk_flex_gutter="20" wall_fit="width" wall_gutter="20" extra_class=""]');
                                                }
                                            },
                                            {
                                                text: 'author-box', // menu title
                                                icon: 'emoticons', //  css class for button icon
                                                onclick: function() {
                                                        editor.insertContent('[author_box cat_limit="3" show_count="1" aut_id="" aut_ava="on" aut_name="on" aut_country="on" aut_slogan="on" aut_posts="" aut_descr="" aut_social="twitter,google,facebook" extra_class="]');
                                                }
                                            },
                                    ]
				},
                                {
                                    text: 'Real Estate', // menu title
                                    icon: 'pastetext', //  css class for button icon
                                    menu: [ // second dropdown menu level starts
                                            {
                                                text: 'epl listing category', // menu title
                                                icon: 'emoticons', //  css class for button icon
                                                onclick: function() {
                                                        editor.insertContent('[renter_listing_category status="current" limit="6" view_position="" location="" pagination="off" extra_class="" img_size="80"]');
                                                }
                                            },
                                            {
                                                text: 'epl show agents', // menu title
                                                icon: 'emoticons', //  css class for button icon
                                                onclick: function() {
                                                        editor.insertContent('[authors_view role="property_agent" view_type="filter" orderby="display_name" order="ASC" number="" img_size="" ]');
                                                }
                                            },
                                            {
                                                text: 'Renter Property gallery', // menu title
                                                icon: 'emoticons', //  css class for button icon
                                                onclick: function() {
                                                        editor.insertContent('[property_gallery limit="10" status="current" sortby= "date" location="" sort_order="" pagination="ajax" filter="on" wp_img_size="full" uk_flex_gutter="off" uk_grid_medium="2" uk_grid_large="3" extra_class=""]');
                                                }
                                            },
                                            {
                                                text: 'Esta Property gallery', // menu title
                                                icon: 'emoticons', //  css class for button icon
                                                onclick: function() {
                                                        editor.insertContent('[gallery_listing_switcher limit="8" status="current" sortby= "rand" location="" sort_order="" extra_class=""]');
                                                }
                                            },
                                    ]
				},
                                {
                                    text: 'Bits and Pieces', // menu title
                                    icon: 'pastetext', //  css class for button icon
                                    menu: [ // second dropdown menu level starts
                                            { // second menu item which insert theme layout_positions demo
                                                text: 'Google map', // menu title
                                                icon: 'wp_help',
                                                onclick: function() {
                                                        editor.windowManager.open( {
                                                                title: 'Setup field',
                                                                body: [
                                                                        {
                                                                            type: 'textbox', // тип textbox = текстовое поле
                                                                            name: 'googleMapWidth', // ID, будет использоваться ниже
                                                                            label: 'Width (px, %, em):', // лейбл
                                                                            value: '100%' // значение по умолчанию
                                                                        },
                                                                        {
                                                                            type: 'textbox', // тип textbox = текстовое поле
                                                                            name: 'googleMapHeight', // ID, будет использоваться ниже
                                                                            label: 'Height (px, %, em):', // лейбл
                                                                            value: '480' // значение по умолчанию
                                                                        },
                                                                        {
                                                                            type: 'textbox', // тип textbox = текстовое поле
                                                                            name: 'googleMapSrc',
                                                                            label: 'Google map src:',
                                                                            value: 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6508.981606049425!2d25.13337428465577!3d35.34346410962018!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf7a32bd8f2ec7cc9!2sZakas!5e0!3m2!1sen!2s!4v1467466826485',
                                                                            multiline: true, // большое текстовое поле - textarea
                                                                            minWidth: 300, // минимальная ширина в пикселях
                                                                            minHeight: 140 // минимальная высота в пикселях
                                                                        },
                                                                        {
                                                                            type: 'textbox', // тип textbox = текстовое поле
                                                                            name: 'googleMapClass', // ID, будет использоваться ниже
                                                                            label: 'Extra css class:', // лейбл
                                                                            value: '' // значение по умолчанию
                                                                        },
                                                                        {
                                                                            type: 'listbox', // тип listbox = выпадающий список select
                                                                            name: 'googleMapScroll',
                                                                            label: 'Scroll zooming event:',
                                                                            'values': [ // значения выпадающего списка
                                                                                    {text: 'Disable', value: false}, // лейбл, значение
                                                                                    {text: 'Enable', value: true}
                                                                            ]
                                                                        }
                                                                ],
                                                                onsubmit: function( e ) { // это будет происходить после заполнения полей и нажатии кнопки отправки
                                                                        editor.insertContent( '[googlemap width="' + e.data.googleMapWidth + '" height="' + e.data.googleMapHeight + '" src="' + e.data.googleMapSrc + '" class="' + e.data.googleMapClass + '" scroll="' + e.data.googleMapScroll + '"]');
                                                                }
                                                        });
                                                }
                                            },
                                            { // second menu item which insert theme layout_positions demo
                                                text: 'Tabs content', // menu title
                                                icon: 'wp_help',
                                                onclick: function() {
                                                        editor.insertContent('[latest_post_tab number_of_posts="3" category_id=""]');
                                                }
                                            },
                                    ]
				},
                                {
					text: 'Form item', // menu title
                                        icon: 'pastetext', //  css class for button icon
					menu: [ // second dropdown menu level starts
						{
							text: 'Text field', // menu title
                                                        icon: 'emoticons', //  css class for button icon
							onclick: function() {
								editor.windowManager.open( {
									title: 'Setup field',
									body: [
										{
											type: 'textbox', // тип textbox = текстовое поле
											name: 'textboxName', // ID, будет использоваться ниже
											label: 'ID and name of text field', // лейбл
											value: 'comment' // значение по умолчанию
										},
										{
											type: 'textbox', // тип textbox = текстовое поле
											name: 'multilineName',
											label: 'Default value',
											value: 'Holla, dude!',
											multiline: true, // большое текстовое поле - textarea
											minWidth: 300, // минимальная ширина в пикселях
											minHeight: 100 // минимальная высота в пикселях
										},
										{
											type: 'listbox', // тип listbox = выпадающий список select
											name: 'listboxName',
											label: 'Field type',
											'values': [ // значения выпадающего списка
												{text: 'Required', value: '1'}, // лейбл, значение
												{text: 'Optional', value: '2'}
											]
										}
									],
									onsubmit: function( e ) { // это будет происходить после заполнения полей и нажатии кнопки отправки
										editor.insertContent( '[textarea id="' + e.data.textboxName + '" value="' + e.data.multilineName + '" required="' + e.data.listboxName + '"]');
									}
								});
							}
						},
						{ // второй элемент вложенного выпадающего списка, прост вставляет шорткод [button]
							text: 'Send Button', // menu title
                                                        icon: 'link', //  css class for button icon
							onclick: function() {
								editor.insertContent('[button]');
							}
						},
                                                
					]
				},
                                {
                                    text: 'Theme Features', // menu title
                                    icon: 'pastetext', //  css class for button icon
                                    menu: [ // second dropdown menu level starts
                                            { // second menu item which insert theme layout_positions demo
                                                text: 'Layout_positions', // menu title
                                                icon: 'wp_help',
                                                onclick: function() {
                                                        editor.insertContent('[layout_positions]');
                                                }
                                            },
                                            { // second menu item which insert theme layout_positions demo
                                                text: 'Hello, Ninja!', // menu title
                                                icon: 'wp_help',
                                                onclick: function() {
                                                        editor.insertContent('[ninja]');
                                                }
                                            },
                                    ]
				},
                                {
                                    text: 'Documentation', // menu title
                                    icon: 'pastetext', //  css class for button icon
                                    menu: [ // second dropdown menu level starts
                                            { // second menu item which insert theme layout_positions demo
                                                text: 'Query posts shortcode', // menu title
                                                icon: 'wp_help',
                                                onclick: function() {
                                                        editor.insertContent('[ang_query_post_shortcode]');
                                                }
                                            },
                                            { // second menu item which insert theme layout_positions demo
                                                text: 'Portfolio shortcode', // menu title
                                                icon: 'wp_help',
                                                onclick: function() {
                                                        editor.insertContent('[ang_portfolio_shortcode]');
                                                }
                                            },
                                            { // second menu item which insert theme layout_positions demo
                                                text: 'Google map shortcode', // menu title
                                                icon: 'wp_help',
                                                onclick: function() {
                                                        editor.insertContent('[ang_google_map_shortcode]');
                                                }
                                            },
                                            { // second menu item which insert theme layout_positions demo
                                                text: 'Author box shortcode', // menu title
                                                icon: 'wp_help',
                                                onclick: function() {
                                                        editor.insertContent('[ang_author_box_shortcode]');
                                                }
                                            },
                                            { // second menu item which insert theme layout_positions demo
                                                text: 'Post tabs shortcode', // menu title
                                                icon: 'wp_help',
                                                onclick: function() {
                                                        editor.insertContent('[ang_post_tabs_shortcode]');
                                                }
                                            },
                                    ]
				},
			]
		});
	});
})();

