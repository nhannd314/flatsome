<?php

/**
 * Register options for the post object.
 *
 * @param  array   $options
 * @param  WP_Post $post
 * @return array
 */
add_filter( 'ux_builder_post_options', function ( $options, $post ) {
  $options['post_title'] = array(
    'type' => 'textfield',
    'heading' => __( 'Title', 'ux_builder' ),
    'full_width' => true,
  );

  if ( is_post_type_hierarchical( $post->post_type ) ) {
    $options['post_parent'] = array(
      'type' => 'select',
      'heading' => __( 'Parent' ),
      'default' => $post->post_parent,
      'options' => ux_builder_get_page_parents( $post ),
    );
  }

  $options['post_excerpt'] = array(
    'type' => 'textarea',
    'heading' => __( 'Excerpt', 'ux_builder' ),
    'default' => $post->post_excerpt,
    'full_width' => true,
    'on_change' => array(
      'selector' => '.uxb-post-excerpt',
      'content' => '{{ value }}',
    ),
  );

  return $options;
}, 10, 2 );

/**
 * Set page_template on post if the _wp_page_template meta is set.
 * Because WordPress looks for page_template instead of the meta option,
 * but it get saves meta option named _wp_page_template.
 *
 * @param  array $post
 * @return array
 */
add_filter( 'ux_builder_save_post', function ( $post ) {
  if ( isset( $post['meta_input']['_wp_page_template'] ) ) {
    $post['page_template'] = $post['meta_input']['_wp_page_template'];
  }
  return $post;
} );
