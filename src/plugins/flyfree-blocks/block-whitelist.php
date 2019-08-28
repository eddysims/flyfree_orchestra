<?php
/**
 * A whitelist of blocks available. The goal is to get everything
 * in here and styled correctly.
 */
function flyfree_allowed_block_types( $allowed_blocks ) {
    return array(
        'core/paragraph',
        'core/heading'
    );
}

add_filter( 'allowed_block_types', 'flyfree_allowed_block_types' );