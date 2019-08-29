<?php
/**
 * Plugin Name: FlyFree Blocks
 * Plugin URI: https://edeesims.com
 * Description: A plugin that disables a bunch of core blocks and adds some cool new ones
 * Version: 0.0.1
 * Author: Eddy Sims
 * Author URI: https://edeesims.com
 * License: GPLv2
 * Text Domain: flyfree
 * 
 * @package FlyFreeBlocks
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

include( plugin_dir_path( __FILE__ ) . 'inc/block-whitelist.php' );
