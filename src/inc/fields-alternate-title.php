<?php
if ( function_exists( 'acf_add_local_field_group' ) ) {
    acf_add_local_field_group( array( 
      'key' => 'alternate_title_key',
      'name' => 'alternate_title',
      'title' => __( 'Alternate Title', 'flyfree' ),
      'position' => 'side',
      'fields' => array(
        array(
          'key' => 'alternate_page_sub_title_key',
          'name' => 'alternate_page_sub_title',
          'label' => __( 'Page Sub Title', 'flyfree' ),
          'type' => 'text'
        ),
        array(
          'key' => 'alternate_page_title_key',
          'name' => 'alternate_page_title',
          'label' => __( 'Alternate Page Title', 'flyfree' ),
          'type' => 'text'
        ),
      ),
      'location' => array(
        array(
          array(
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'page',
          ),
        ),
      ),
  ) );
}
