
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
 * Add to twig context
 */
function add_to_context( $data ) {
	$data['main_menu'] = new TimberMenu('main-menu');

	return $data;
}
add_filter( 'timber_context', 'add_to_context' );