
<?php
/**
 * Adds twig filters
 */
function add_to_twig( $twig ) {
	$twig->addExtension( new Twig_Extension_StringLoader() );

	$twig->addFilter( new Twig_SimpleFilter( 'prepend', function( $val, $prepend ) {
		if ( $val ) return $prepend . $val;
	} ) );

	$twig->addFilter( new Twig_SimpleFilter( 'append', function( $val, $append ) {
		if ( $val ) return $val . $append;
	} ) );

	return $twig;
}
add_filter( 'timber/twig', 'add_to_twig' );

/**
 * Register namespaces
 */
add_filter( 'timber/loader/loader', function( $loader ) {
	$loader->addPath( get_template_directory() . '/partials', 'partial' );
	$loader->addPath( get_template_directory() . '/assets/images', 'image' );
	return $loader;
} );

/**
 * Add to twig context
 */
function add_to_context( $data ) {
	$data['main_menu'] = new TimberMenu('main-menu');
	$data['footer_menu'] = new TimberMenu('footer-menu');
	
	if ( get_field( 'alert_bar', 'options' ) ) {
		$data['alert_bar'] = __( get_field( 'alert_bar', 'options' ), 'flyfree' );
	}

	if ( get_field( 'mailchimp_title', 'options' ) ) {
		$data['mailchimp_title'] = __( get_field( 'mailchimp_title', 'options' ), 'flyfree' );
	}

	if ( get_field( 'mailchimp_content', 'options' ) ) {
		$data['mailchimp_content'] = __( get_field( 'mailchimp_content', 'options' ), 'flyfree' );
	}

	return $data;
}
add_filter( 'timber_context', 'add_to_context' );
