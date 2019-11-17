<?php
/**
 * This class helps create our dynamic gutenberg blocks. It will register 
 * the block, a default callback, enqueue styles and scripts, push and 
 * preload styles ect.
 * 
 * To pass validation your block must have:
 * - block name that is lower case and hyphenated.
 * - an attributes key set in options with at least one value
 * 
 * Optional options:
 * - 'render_callback' => @string - Used to pass in a custom render callback function.
 * - 'include_frontend_script' => @boolean - Used to tell whether to include 'block-name.frontend.bundle.js'
 * - 'include_frontend_styles' => @boolean - Used to tell whether to include 'block-name.bundle.css'
 * - 'remove_async' => @boolean - Remove the async attribute from the frontend javascript
 * - 'remove_defer' => @boolean - Remove the defer attribute from the frontend javascript
 * 
 * example usage: new flyfreeblock( 'block-name', array() )
 */
require_once plugin_dir_path( __DIR__ ) . '/inc/should-enqueue.php';
class FlyfreeBlock {
	function __construct( $block_name, $options = array() ) {
		$this->block_name = $block_name;
		$this->options = $options;
		$this->attributes = $this->options['attributes'];
		$this->validate_block( $this->block_name, $this->attributes );
		$this->render_callback = array( &$this, 'flyfreeblock_render_callback' );
		if ( $this->options['render_callback'] ) {
			$this->render_callback = &$this->options['render_callback'];
		}
		if ( ! isset( $this->options['include_frontend_styles'] ) ) {
			$this->options['include_frontend_styles'] = true;
		}

		$this->add_action( 'init', array( &$this, 'flyfreeblock_register_block' ) );

		if ( $this->options['include_frontend_styles'] ) {
			$this->add_action( 'wp_enqueue_scripts', array( &$this, 'flyfreeblock_register_styles' ) );
			$this->add_action( 'admin_enqueue_scripts', array( &$this, 'flyfreeblock_register_styles' ) );
			$this->add_filter( 'style_loader_tag', array( &$this, 'flyfreeblock_preload_styles' ), 10, 4 );
			$this->add_action( 'send_headers', array( &$this, 'flyfreeblock_push_styles' ), 10, 2 );
		}

		if ( $this->options['include_frontend_script'] ) {
			$this->add_action( 'wp_enqueue_scripts', array( &$this, 'flyfreeblock_register_scripts' ) );
			$this->add_filter( 'script_loader_tag', array( &$this, 'flyfreeblock_async_defer_scripts' ), 10, 3 );
		}
	}
	function add_action( $action, $function, $priority = 10, $args = 1 ) {
		add_action( $action, $function, $priority, $args );
	}
	function add_filter( $filter, $function, $priority = 10, $args = 1 ) {
		add_action( $filter, $function, $priority, $args );
	}
	/**
	 * Validate our block to make sure that we have a block name, and
	 * the block has some attributes set.
	 */
	function validate_block( $block, $attributes ) {
		if ( strlen( $block ) < 1 ) {
			throw new Exception( '<strong>Block name is to short. Your block name must be at least 1 character.</strong>' );
		}
		
		if ( ! preg_match( '/^[a-z0-9\-]+$/', $block ) ) {
			throw new Exception( '<strong>Block name must be lowercase and hyphenated.</strong>' );
		}
		if ( gettype( $attributes ) !== 'array' ) {
			throw new Exception( '<strong>Attributes must be supplied as an array.</strong>' );
		}
		if ( count( $attributes ) < 1 ) {
			throw new Exception( '<strong>No attributes were assigned, you must supply at least one attribute.</strong>' );
		}
	}
	/**
	 * Register our block via php. This allows us to have a
	 * render callback and use twig to render our front end.
	 */
	function flyfreeblock_register_block() {
		$block_name = $this->block_name;
		$render_callback = $this->render_callback;
		$attributes = $this->attributes;
		$editor_script = $block_name . '-editor-script';
		$editor_script_url = plugin_dir_url( __DIR__ ) . '/blocks/' . $block_name . '/' . $block_name . '.bundle.js';
		$editor_script_version = filemtime( plugin_dir_path( dirname(__FILE__) ) . 'blocks/' . $block_name . '/' . $block_name . '.bundle.js' );
		wp_register_script( $editor_script, $editor_script_url, FLYFREE_DEPENDENCIES, $editor_script_version, true );
		
		$register_block_type_options = array(
			'editor_script' => $block_name . '-editor-script',
			'render_callback' => $render_callback,
			'attributes' => $attributes,
		);
		register_block_type( 'flyfree/' . $block_name, $register_block_type_options );
	}
	/**
	 * Render callback for our block. Should only create a $context
	 * array, and return a Timber::compile
	 */
	function flyfreeblock_render_callback( $attributes, $content ) {
		$block_name = $this->block_name;
		$context = array(
			'attributes' => $attributes,
			'content' => $content,
		);
		return Timber::compile('@flyfreeblocks/blocks/' . $block_name . '/' . $block_name . '-render-callback.twig', $context );
	}
	/**
	 * Enqueue our styles for our block. Should only include the styles
	 * if the block is used on the page, or we are in the editor
	 */
	function flyfreeblock_register_styles() {
		$block_name = $this->block_name;
		if ( ! should_enqueue( 'flyfree/' . $block_name ) ) {
			return;
		}
		$block_styles = $block_name . '-styles';
		$block_styles_url = plugin_dir_url( __DIR__ ) . 'blocks/' . $block_name . '/' . $block_name . '.bundle.css';
		$block_styles_version = filemtime( plugin_dir_path( dirname(__FILE__) ) . 'blocks/' . $block_name . '/' . $block_name . '.bundle.css' );
		wp_enqueue_style( $block_styles, $block_styles_url, null, $block_styles_version );
	}
	/**
	 * Enqueue our scripts for our block. Will only be called if
	 * options['include_frontend_script'] is set.
	 */
	function flyfreeblock_register_scripts() {
		$block_name = $this->block_name;
		if ( ! should_enqueue( 'flyfree/' . $block_name ) ) {
			return;
		}
		$block_frontend_script = $block_name . '-frontend-script';
		$block_frontend_script_url = plugin_dir_url( __DIR__ ) . '/blocks/' . $block_name . '/' . $block_name . '.frontend.bundle.js';
		$block_frontend_script_version = filemtime( plugin_dir_path( dirname(__FILE__) ) . 'blocks/' . $block_name . '/' . $block_name . '.frontend.bundle.js' );
		wp_enqueue_script( $block_frontend_script, $block_frontend_script_url, null, $block_frontend_script_version, true );
	}
	/**
	 * Load our scripts async and defered to keep our page speed down.
	 */
	function flyfreeblock_async_defer_scripts( $html, $handle, $src ) {
		$block_name = $this->block_name;
		$settings = '';
		if ( ! $this->options['remove_async'] ) {
			$settings .= ' async';
		}
		if ( ! $this->options['remove_defer'] ) {
			$settings .= ' defer';
		}
		if ( $handle === $block_name . '-frontend-script' ) {
			return '<script src="' . $src . '" ' . $settings . ' id="' . $handle . '"></script>';
		}
		return $html;
	}
	/**
	 * Use http2 to push and preload our assets.
	 */
	function flyfreeblock_preload_styles( $html, $handle, $href, $media ) {
		$block_name = $this->block_name;
		if ( $handle === $block_name . '-styles' ) {
			echo '<link rel="preload" as="style" href="' . $href . '" />';
		}
		return $html;
	}
	function flyfreeblock_push_styles() {
		$block_name = $this->block_name;
		if ( ! has_block( 'jobber/' . $block_name ) ) {
			return;
		}
		$block_style_url = plugin_dir_url( __DIR__ ) . '/blocks/' . $block_name . '/' . $block_name . '.bundle.css';
		header( 'Link <' . $block_style_url . '>; rel=preload; as=style;' );
	}
}