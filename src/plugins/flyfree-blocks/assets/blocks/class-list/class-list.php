<?php
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page( array(
		'page_title' => __( 'Classes', 'flyfree' ),
		'menu_title' => __( 'Classes', 'flyfree' ),
		'menu_slug' => 'classes',
		'icon_url' => 'dashicons-welcome-learn-more',
		'position' => '30',
		'update_button' => __( 'Save Classes', 'flyfree' ),
		'updated_message' => __( 'Classes Updated', 'flyfree' ),
	));
}

if ( function_exists( 'acf_add_local_field_group' ) ) {
	acf_add_local_field_group( array( 
		'key' => 'class_list_key',
		'name' => 'class_list',
		'title' => __( 'Class List', 'flyfree' ),
		'fields' => array(
			array(
				'key' => 'locations_key',
				'name' => 'locations',
				'label' => __( 'Flyfree Locations', 'flyfree' ),
				'type' => 'repeater',
				'button_label' => 'Add Location',
				'layout' => 'row',
				'sub_fields' => array(
					array(
						'key' => 'location_name_key',
						'name' => 'location_name',
						'label' => __( 'Location Name', 'flyfree' ), 
						'prepend' => __( 'Flyfree Movement', 'flyfree' ),
						'type' => 'text',
					),
					array(
						'key' => 'location_address_key',
						'name' => 'location_address',
						'label' => __( 'Address', 'flyfree' ), 
						'prepend' => __( 'Address', 'flyfree' ),
						'type' => 'textarea',
						'rows' => 5,
					),
					array(
						'key' => 'classes_key',
						'name' => 'classes',
						'label' => __( 'Classes', 'flyfree' ),
						'type' => 'repeater',
						'layout' => 'block',
						'button_label' => 'Add Class Type',
						'sub_fields' => array(
							array(
								'key' => 'class_type_key',
								'name' => 'class_type',
								'label' => __( 'Class Type', 'flyfree' ), 
								'type' => 'text',
							),
							array(
								'key' => 'class_url_key',
								'name' => 'class_url',
								'label' => __( 'Class URL', 'flyfree' ), 
								'type' => 'url',
							),
							array(
								'key' => 'class_is_full_key',
								'name' => 'class_is_full',
								'label' => __( 'Class Is Full?', 'flyfree' ), 
								'type' => 'true_false',
								'ui' => true,
								'wrapper' => [
									'width' => 50,
								],
							),
							array(
								'key' => 'class_is_view_all_key',
								'name' => 'class_is_view_all',
								'label' => __( 'View All?', 'flyfree' ), 
								'type' => 'true_false',
								'ui' => true,
								'wrapper' => [
									'width' => 50,
								],
							),
						)
					)
				),
			),
		),
		'location' => array(
			array(
				array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'classes',
				),
			),
		),
	) );
}
