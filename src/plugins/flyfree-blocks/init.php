<?php
/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * A list of dependecies before our blocks register
 */
if ( ! defined( 'FLYFREE_DEPENDENCIES' ) ) {
	define( 'FLYFREE_DEPENDENCIES', array(
		'wp-blocks',
		'wp-element',
		'wp-data',
		'wp-i18n',
		'wp-editor',
		'wp-components'
	) );
}

/** 
 *  Include required files
 */
require_once plugin_dir_path( __FILE__ ) . '/inc/flyfree-block.php';

/**
 * Register a new category for "Flyfree"
 */
function flyfree_blocks_block_category( $categories ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'flyfree',
				'title' => 'Flyfree',
			),
		)
	);
}
add_filter( 'block_categories', 'flyfree_blocks_block_category' );

/**
 * Enqueue our editor assets
 */
function flyfree_blocks_editor_assets() {
	wp_enqueue_style(
		'flyfree-blocks-editor-css',
		plugin_dir_url( __FILE__ ) . '/assets/flyfreeblocks.editor.bundle.css',
		array( 'wp-edit-blocks' ),
		filemtime( plugin_dir_path( __FILE__ ) . '/assets/flyfreeblocks.editor.bundle.css' )
	);

	wp_enqueue_style( 
		'google-font',
		'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,900&display=swap',
		'',
		''
	);
}
add_action( 'enqueue_block_editor_assets', 'flyfree_blocks_editor_assets', 99 );

/**
 * Adds the `flyfreeblocks` namespace to Timber
 */
function add_flyfreeblocks_namespace( $loader ) {
	$loader->addPath( plugin_dir_path( __FILE__ ), 'flyfreeblocks' );
	return $loader;
}
add_filter( 'timber/loader/loader', 'add_flyfreeblocks_namespace' );


/**
 * Require a list of dynamic blocks
 */
$blocks_to_register = array(
	'hero-image',
	'faqs',
);

foreach ( $blocks_to_register as $block ) {
	require_once plugin_dir_path( __FILE__ ) . 'blocks/' . $block . '/' . $block . '.php';
}