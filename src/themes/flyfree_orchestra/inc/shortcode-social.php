<?php

if ( ! function_exists( 'shortcode_social' ) ) :
    function shortcode_social( $attrs ) {
        $context= Timber::get_context();
        $context['social_media'] = array();
        while ( have_rows('social_media', 'option') ) {
            the_row();
            $context['social_media'][] = array(
                'url' => get_sub_field('social_media_url'),
                'platform' => get_sub_field('social_media_platform')
            );
        }

        return Timber::compile( '@partial/social-media.twig', $context );
    }

    add_shortcode('social_media', 'shortcode_social');
endif;

if ( function_exists( 'acf_add_options_page' ) ) :
    acf_add_options_page( array(
        'page_title' => 'Social Media',
        'menu_title' => 'Social Media',
        'icon_url' => 'dashicons-instagram',
        'position' => '30',
    ) );
endif;

if ( function_exists('acf_add_local_field_group') ) :
    acf_add_local_field_group( array(
        'key' => 'social_media',
        'name' => 'social_media',
        'title' => 'Social Medias',
        'fields' => array(
            array(
                'key' => 'social_media_key',
                'name' => 'social_media',
                'label' => 'Social Media',
                'type' => 'repeater',
                'button_label' => 'Add New Platform',
                'sub_fields' => array(
                    array( 
                        'key' => 'social_media_platform_key',
                        'name' => 'social_media_platform',
                        'label' => 'Platform',
                        'type' => 'select',
                        'required' => 1,
                        'ui' => 1,
                        'choices' => array(
                            'facebook' => 'Facebook',
                            'twitter' => 'Twitter',
                            'youtube' => 'Youtube',
                            'instagram' => 'Instagram',
                            'linkedin' => 'LinkedIn',
                            'tiktok' => 'TikTok',
                        )
                    ),
                    array (
                        'key' => 'social_media_url_key',
                        'name' => 'social_media_url',
                        'label' => 'URL',
                        'type' => 'url',
                        'required' => 1,
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-social-media',
                ),
            ),
        ),
    ) );
endif;
