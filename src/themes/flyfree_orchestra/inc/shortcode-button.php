<?php

if ( ! function_exists( 'shortcode_button' ) ) :
    function shortcode_button( $atts, $content = null ) {
        $att = shortcode_atts(
            array(
                'url' => '#',
                'target' => null,
            ), 
            $atts 
        );

        $button = '<a 
              href="' . $att['url']  . '"
              class="button"
              target="' . $att['target'] . '"
            >
              ' . $content . '
            </a>';

        return $button;
    }

    add_shortcode( 'button', 'shortcode_button' );
endif;