
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

	return $data;
}
add_filter( 'timber_context', 'add_to_context' );