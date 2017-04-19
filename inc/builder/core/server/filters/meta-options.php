<?php

add_filter( 'ux_builder_meta_options', function ( $options, $post ) {
  if ( $post->post_type == 'page' ) {
    $options['_wp_page_template'] = array(
      'type' => 'select',
      'heading' => __( 'Template' ),
      'options' => ux_builder_get_page_templates( $post ),
      'reload' => true,
    );
    $options['_footer'] = array(
      'type' => 'select',
      'heading' => __( 'Page Footer' ),
      'reload' => true,
      'default' => '',
      'options' => array(
        '' => __( 'Default' ),
        'simple' => __( 'Simple' ),
        'transparent' => __( 'Transparent' ),
        'custom' => __( 'Custom Footer' ),
        'disabled' => __( 'Hide' ),
      ),
    );
  }

  if ( get_theme_support( 'post-thumbnails' ) ) {
    $options['_thumbnail_id'] = array(
      'type' => 'image',
      'heading' => __( 'Featured Image' ),
      'reload' => true,
    );
  }

  return $options;
}, 10, 2 );
