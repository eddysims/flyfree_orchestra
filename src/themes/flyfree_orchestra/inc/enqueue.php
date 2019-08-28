<?php
function enqueue_jobber_scripts() {
	$css_modified_time = filemtime( get_template_directory() . '/assets/main.bundle.css' );
	$js_modified_time = filemtime( get_template_directory() . '/assets/main.bundle.js' );
	
	wp_enqueue_style( 'main-style', get_template_directory_uri() . '/assets/main.bundle.css', '', $css_modified_time );
	wp_enqueue_script( 'main-script', get_template_directory_uri() . '/assets/main.bundle.js', array(), $js_modified_time, true );
	wp_deregister_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_jobber_scripts' );
