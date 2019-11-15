<?php
if ( ! function_exists( 'flyfree_setup' ) ) :
	function flyfree_setup() {
		load_theme_textdomain( 'flyfree', get_template_directory() . '/languages' );
		
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'align-wide' );
		
		register_nav_menus( array(
			'main-menu' => esc_html__( 'Main Menu', 'flyfree' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'flyfree' ),
		) );
	}
endif;
add_action( 'after_setup_theme', 'flyfree_setup' );


require_once 'inc/enqueue.php';
require_once 'inc/timber.php';

require_once 'inc/fields-alternate-title.php';
require_once 'inc/fields-mailchimp.php';
require_once 'inc/alert-bar.php';




add_action( 'acf/init', 'block_3_column_content' );

function block_3_column_content() {
  acf_register_block( array(
    'name' => 'Three Column Content',
    'title' => __( 'Three Column Content', 'jobber-marketing-theme-2019' ),
    'render_callback' => 'block_3_column_content_render_callback',
    'category' => 'layout',
    'icon' => 'media-and-text',
    'post_types' => array('page'),
    'mode' => 'preview',
    'align'	=> 'full',
    'supports' => array(
      'align' => array('full'),
    )
  ) );
}

acf_add_local_field_group( array(
  'key' => 'block_3_column_content',
  'title' => 'Three Column Content',
  'fields' => array (
    array (
      'key' => 'block_3_column_content_background_color_key',
      'name' => 'block_3_column_content_background_color',
      'label' => 'Background Color',
      'type' => 'radio',
      'ui' => true,
      'choices' => array (
        null => 'None',
        'green' => 'Green',
        'grey' => 'Grey',
      ),
      'default_value' => 'green',
    ),
    array (
      'key' => 'block_3_column_content_title_key',
      'name' => 'block_3_column_content_title',
      'label' => 'Title',
      'type' => 'text',
    ),
    array (
      'key' => 'block_3_column_content_subtitle_key',
      'name' => 'block_3_column_content_subtitle',
      'label' => 'Subtitle',
      'type' => 'text',
    ),
    array (
      'key' => 'block_3_column_content_column_1_key',
      'name' => 'block_3_column_content_column_1',
      'label' => 'Column 1 Content',
      'type' => 'wysiwyg',
    ),
    array (
      'key' => 'block_3_column_content_column_2_key',
      'name' => 'block_3_column_content_column_2',
      'label' => 'Column 2 Content',
      'type' => 'wysiwyg',
    ),
    array (
      'key' => 'block_3_column_content_column_3_key',
      'name' => 'block_3_column_content_column_3',
      'label' => 'Column 3 Content',
      'type' => 'wysiwyg',
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'block',
        'operator' => '==',
        'value' => 'acf/three-column-content',
      ),
    ),
  ),
));

function block_3_column_content_render_callback( $block, $content = '', $is_preview = false ) {
  $context = Timber::get_context();
  $context['block'] = $block;
  $context['fields'] = get_fields();
  $context['is_preview'] = $is_preview;


  switch ( get_field( 'block_3_column_content_background_color' ) ) {
    case 'green':
      $context['background_color'] = 'u-backgroundGreen';
      break;
    case 'grey':
      $context['background_color'] = 'u-backgroundLightestGrey';
      break;
  }

  if ( get_field( 'block_3_column_content_background_color' ) ) {
    $context['spacing'] = 'padding-small';
  } else {
    $context['spacing'] = 'margin-top-medium';
  }

  return '<div>Hello World</div>';
}
