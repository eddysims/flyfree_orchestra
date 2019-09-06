<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function multi_block_cgb_block_assets() {
	wp_enqueue_style(
		'multi_block-cgb-style-css',
		plugin_dir_url( __FILE__ ) . 'assets/blocks.bundle.css',
		array( 'wp-editor' )
	);
} 
add_action( 'enqueue_block_assets', 'multi_block_cgb_block_assets' );


// echo plugin_dir_path( __FILE__ ) . 'blocks.bundle.js';die;
function multi_block_cgb_editor_assets() {
	// Scripts.
	wp_enqueue_script(
		'multi_block-cgb-block-js',
		plugin_dir_url( __FILE__ ) . 'assets/blocks.bundle.js',
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'blocks.bundle.js' )
	);
	// Styles.
	wp_enqueue_style(
		'multi_block-cgb-block-editor-css',
		plugin_dir_url( __FILE__ ) . 'assets/blocks.bundle.css', 
		array( 'wp-edit-blocks' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'blocks.bundle.css' )
	);
}

add_action( 'enqueue_block_editor_assets', 'multi_block_cgb_editor_assets' );
