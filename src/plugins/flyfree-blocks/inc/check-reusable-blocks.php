<?php
/**
 * Checks a passed block name against the reusable blocks in a post.
 *
 * @param string  $block_name - Block name to search for.
 *
 * @return boolean
 */
function check_reusable_blocks( $block_name ) {
	global $post;
	$blocks = parse_blocks( $post->post_content );
	foreach ( $blocks as $block ) {
		if ( $block['blockName'] == 'core/block' ) {
			$wp_block = get_post( $block['attrs']['ref'] );
			$wp_reusable_block = parse_blocks( $wp_block->post_content );
			if ( in_array( $block_name, array_column( $wp_reusable_block, 'blockName' ), true ) ) {
				return true;
			};
		}
	}
	return false;
}