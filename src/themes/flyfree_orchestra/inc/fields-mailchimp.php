<?php
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page( array(
		'page_title' => __( 'Mailchimp', 'flyfree' ),
		'menu_title' => __( 'Mailchimp', 'flyfree' ),
		'menu_slug' => 'mailchimp',
		'icon_url' => 'dashicons-buddicons-pm',
		'position' => '30',
		'update_button' => __( 'Update Mailchimp Text', 'flyfree' ),
		'updated_message' => __( 'Mailchimp Text Updated', 'flyfree' ),
	));
}

if ( function_exists( 'acf_add_local_field_group' ) ) {
	acf_add_local_field_group( array( 
		'key' => 'mailchimp_key',
		'name' => 'mailchimp',
		'title' => __( 'Mailchimp', 'flyfree' ),
		'fields' => array(
			array(
				'key' => 'mailchimp_title_key',
				'name' => 'mailchimp_title',
				'label' => __( 'Title', 'flyfree' ),
				'type' => 'text'
            ),
            array(
				'key' => 'mailchimp_content_key',
				'name' => 'mailchimp_content',
				'label' => __( 'Content', 'flyfree' ),
				'type' => 'text'
			),
		),
		'location' => array(
			array(
				array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'mailchimp',
				),
			),
		),
	) );
}
