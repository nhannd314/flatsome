<?php

/**
 * Get an array with parents for given post.
 *
 * @param  WP_Post $post
 * @return array
 */
function ux_builder_get_page_parents( $post = null ) {
  $defaults = array(
    'depth' => 0,
    'child_of' => 0,
    'selected' => 0,
    'echo' => 0,
    'name' => 'page_id',
    'id' => '',
    'class' => '',
    'show_option_none' => '',
    'show_option_no_change' => '',
    'option_none_value' => '',
    'value_field' => 'ID',
  );

  $args = apply_filters( 'page_attributes_dropdown_pages_args', array(
    'name' => 'parent_id',
    'show_option_none' => __( '(no parent)' ),
    'sort_column' => 'menu_order, post_title',
    'hierarchical' => 1,
    'echo' => 0,
  ), $post );

  if ( $post ) {
    $args['post_type'] = $post->post_type;
    $args['exclude_tree'] = $post->ID;
    $args['selected'] = $post->post_parent;
  }

  $posts = get_pages( wp_parse_args( $args, $defaults ) );
  $parents = array();

  // Add blank
  $parents[''] = __( 'None' );
  
  if ( $posts ) {
    foreach ( $posts as $key => &$post ) {
      $depth = ux_builder_get_page_depth( $post );
      $parents[$post->ID] = str_repeat( '— ', $depth ) . $post->post_title;
    }
  }

  return $parents;
}

/**
 * Get a list with page templates.
 *
 * @param  WP_Post $post
 * @return array
 */
function ux_builder_get_page_templates( $post ) {
  $page_templates = array();
  $page_templates['default'] = apply_filters( 'default_page_template_title',  __( 'Default Template' ), 'meta-box' );
  $page_templates += array_flip( get_page_templates( $post ) );
  asort( $page_templates );
  return $page_templates;
}

/**
 * Get page depth.
 *
 * @param  WP_Post $post
 * @return number
 */
function ux_builder_get_page_depth( $post ) {
  return $post->post_parent
    ? ux_builder_get_page_depth( get_post( $post->post_parent ) ) + 1
    : 0;
}
