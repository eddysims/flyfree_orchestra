<?php
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page( array(
		'page_title' => __( 'Flyfree Alert Bar', 'flyfree' ),
		'menu_title' => __( 'Alert Bar', 'flyfree' ),
		'menu_slug' => 'alert-bar',
		'icon_url' => 'dashicons-megaphone',
		'position' => '30',
		'update_button' => __( 'Save Alert Bar', 'flyfree' ),
		'updated_message' => __( 'Alert Bar Updated', 'flyfree' ),
	));
}

if ( function_exists( 'acf_add_local_field_group' ) ) {
	acf_add_local_field_group( array( 
		'key' => 'alert_bar_key',
		'name' => 'alert_bar',
		'title' => __( 'Alert Bar', 'flyfree' ),
		'fields' => array(
			array(
				'key' => 'alert_bar_key',
				'name' => 'alert_bar',
				'label' => __( 'Alert Bar Content', 'flyfree' ),
				'type' => 'text'
			),
		),
		'location' => array(
			array(
				array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'alert-bar',
				),
			),
		),
	) );
}
