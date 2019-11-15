<?php
function enqueue_jobber_scripts() {
	wp_deregister_style( 'wp-block-library' );
	wp_deregister_style( 'wp-components' );
	wp_deregister_style( 'wp-block-editor' );
	wp_deregister_style( 'wp-nux' );
	wp_deregister_style( 'wp-editor' );
	wp_deregister_script( 'wp-embed' );
	wp_deregister_script( 'jquery' );

	$css_modified_time = filemtime( get_template_directory() . '/assets/main.bundle.css' );
	$js_modified_time = filemtime( get_template_directory() . '/assets/main.bundle.js' );
	
	wp_enqueue_style( 'main-style', get_template_directory_uri() . '/assets/main.bundle.css', '', $css_modified_time );
	wp_enqueue_style( 'google-font', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap', '', '' );

	wp_enqueue_script( 'main-script', get_template_directory_uri() . '/assets/main.bundle.js', array(), $js_modified_time, true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_jobber_scripts' );

/**
 * Preload some of our css assets that will be used to style
 * the theme
 */
function preload_css_assets($html, $handle, $href, $media) {
	$preload = array(
		'main-style',
		'google-font',
	);
	if ( in_array( $handle, $preload ) ) {
		echo '<link rel="preload" as="style" href="' . $href . '" />';
	}
	return $html;
}
add_filter( 'style_loader_tag', 'preload_css_assets', 10, 4 );
