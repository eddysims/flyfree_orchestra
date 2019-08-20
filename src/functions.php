<?php
if ( ! function_exists( 'flyfree_setup' ) ) :
	function flyfree_setup() {
		load_theme_textdomain( 'flyfree', get_template_directory() . '/languages' );
		
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'align-wide' );
		
		register_nav_menus( array(
			'main-menu' => esc_html__( 'Main Menu', 'flyfree' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'flyfree' ),
		) );
	}
endif;
add_action( 'after_setup_theme', 'flyfree_setup' );


require_once 'inc/enqueue.php';
require_once 'inc/timber.php';