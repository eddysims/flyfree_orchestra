<?php

new FlyfreeBlock( 'class-list', array(
    'render_callback' => 'class_list_custom_render_callback',
    'attributes' => array(
        'align' => array(
            'type' => 'string',
            'default' => 'full',
        ),
        'id' => array(
            'type' => 'string',
        ),
        'spacing' => array(
            'type' => 'string',
            'default' => 'large',
        ),
        'image' => array(
            'type' => 'string',
        ),
        'title' => array(
            'type' => 'string',
        ),
        'subtitle' => array(
            'type' => 'string',
        ),
    )
));

if ( function_exists( 'acf_add_options_page' ) ) :
    acf_add_options_page( array(
        'page_title' => 'Classes',
        'menu_title' => 'Classes',
        'icon_url' => 'dashicons-heart'
    ) );
endif;

if ( function_exists('acf_add_local_field_group') ) :
    acf_add_local_field_group( array(
        'key' => 'locations',
        'name' => 'locations',
        'title' => 'Locations',
        'fields' => array(
            array(
                'key' => 'location_key',
                'name' => 'location',
                'label' => 'Location',
                'type' => 'repeater',
                'button_label' => 'Add New Location',
                'layout' => 'row',
                'sub_fields' => array(
                    array( 
                        'key' => 'location_name_key',
                        'name' => 'location_name',
                        'label' => 'Name',
                        'type' => 'text',
                    ),
                    array( 
                        'key' => 'location_address_key',
                        'name' => 'location_address',
                        'label' => 'Address',
                        'type' => 'textarea',
                        'rows' => 4,
                        'new_lines' => 'br',
                    ),
                    array( 
                        'key' => 'location_classes_key',
                        'name' => 'location_classes',
                        'label' => 'Classes',
                        'type' => 'repeater',
                        'button_label' => 'Add New Location',
                        'layout' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'class_name_key',
                                'name' => 'class_name',
                                'label' => 'Name',
                                'type' => 'text',
                                'wrapper' => array(
                                    'width' => 60,
                                )
                            ),
                            array(
                                'key' => 'class_full_key',
                                'name' => 'class_full',
                                'label' => 'Is Full?',
                                'type' => 'true_false',
                                'ui' => 1,
                                'wrapper' => array(
                                    'width' => 20,
                                )
                            ),
                            array(
                                'key' => 'class_all_key',
                                'name' => 'class_all',
                                'label' => 'Is All?',
                                'type' => 'true_false',
                                'ui' => 1,
                                'wrapper' => array(
                                    'width' => 20,
                                )
                            ),
                            array(
                                'key' => 'class_url_key',
                                'name' => 'class_url',
                                'label' => 'Registration URL',
                                'type' => 'url',
                            ),
                        ),
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-classes',
                ),
            ),
        ),
    ) );
endif;

if ( ! function_exists('class_list_custom_render_callback') ) :
    function class_list_custom_render_callback( $attributes, $content ) {
		$context = array(
			'attributes' => $attributes,
			'content' => $content,
        );

        $classes = array();

        while ( have_rows('location', 'option') ) {
            the_row();
            $class_list = array();
    
            while ( have_rows('location_classes') ) {
                the_row();
                $class_list[] = array(
                    'name' => get_sub_field('class_name'),
                    'url' => get_sub_field('class_url'),
                    'is_full' => get_sub_field('class_full'),
                    'is_all' => get_sub_field('class_all'),
                );
            }
    
            $classes[] = array(
                'location_name' => get_sub_field('location_name'),
                'location_address' => get_sub_field('location_address'),
                'classes' => $class_list,
            );
        }

        $context['attributes']['classes'] = $classes;

		return Timber::compile('@flyfreeblocks/blocks/class-list/class-list-render-callback.twig', $context );
    }
endif;

/**
* Register a custom endpoint that will allow us to get
* the classes for the block.
*/
function class_list_register_api_route() {
	register_rest_route(
		'flyfree',
		'classes',
		array(
			'methods' => WP_REST_Server::READABLE,
            'callback' => 'classes_route_callback',
        ) 
    );
}

add_action( 'rest_api_init', 'class_list_register_api_route' );

function classes_route_callback( WP_REST_Request $request ) {
    $classes = array();

    while ( have_rows('location', 'option') ) {
        the_row();
        $class_list = array();

        while ( have_rows('location_classes') ) {
            the_row();
            $class_list[] = array(
                'name' => get_sub_field('class_name'),
                'url' => get_sub_field('class_url'),
                'is_full' => get_sub_field('class_full'),
                'is_all' => get_sub_field('class_all'),
            );
        }

        $classes[] = array(
            'location_name' => get_sub_field('location_name'),
            'location_address' => get_sub_field('location_address'),
            'classes' => $class_list,
        );
    }

	$data = array (
		'data' => array(
			'status' => 200,
		),
		'classes' => $classes,
	);

	$response = new WP_REST_Response($data, 200);
	return $response;
}
