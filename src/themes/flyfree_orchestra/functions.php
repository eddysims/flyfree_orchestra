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

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );


require_once 'inc/enqueue.php';
require_once 'inc/timber.php';
require_once 'inc/shortcode-social.php';
require_once 'inc/shortcode-button.php';

// require_once 'inc/fields-alternate-title.php';
require_once 'inc/fields-mailchimp.php';
require_once 'inc/alert-bar.php';



