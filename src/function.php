<?php
if ( ! function_exists( 'jobber_marketing_theme_2019_setup' ) ) :
	function jobber_marketing_theme_2019_setup() {
		load_theme_textdomain( 'flyfree', get_template_directory() . '/languages' );
		
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'align-wide' );
		
		register_nav_menus( array(
			'main-menu' => esc_html__( 'Main Menu', 'flyfree' ),
		) );
	}
endif;
add_action( 'after_setup_theme', 'jobber_marketing_theme_2019_setup' );

require_once 'inc/enqueue.php';