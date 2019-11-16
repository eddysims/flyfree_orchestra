<?php
/**
 * Checks if a block styles/scripts should be enqueued.
 *
 * @param string  $block_name - Block name to check.
 *
 * @return boolean
 */
require_once plugin_dir_path( __DIR__ ) . '/inc/check-reusable-blocks.php';

function should_enqueue( $block_name ) {
	$reusable_block = check_reusable_blocks( $block_name );
	$has_block = has_block( $block_name );
	$is_admin_editor = ( is_admin() && get_current_screen()->is_block_editor() );
	if ( $reusable_block || $has_block || $is_admin_editor ) {
		return true;
	}
	return false;
}