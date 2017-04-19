<?php

/**
 * Get all registered elements.
 *
 * @return array
 */
function ux_builder_shortcodes() {
  return ux_builder( 'elements' );
}

/**
 * Register a shortcode element.
 *
 * @param string $type The shortcode tag name
 * @param array  $options
 */
function add_ux_builder_shortcode( $type, $options ) {
  ux_builder( 'elements' )->set( $type, $options );
}

/**
 * Removes an element.
 *
 * @param  string $type
 */
function ux_builder_remove_element( $type ) {
  ux_builder( 'elements' )->remove( $type );
}

function remove_ux_builder_shortcode( $type ) {
  ux_builder_remove_element( $type );
}

/**
 * Modify registered element.
 *
 * @param  string $type
 * @param  array  $options
 */
function ux_builder_edit_element( $type, $options ) {
  ux_builder( 'elements' )->modify( $type, $options );
}

/**
 * Get element options from meta data.
 *
 * @param  string $id
 * @return array
 */
function ux_builder_element_data( $id ) {
  if ( empty( $id ) ) return array();
  list( $post_id, $element_id ) = explode( '-', $id );
  $meta = get_post_meta( $post_id, '_ux_builder_data', true );
  return ! empty( $meta['shortcodes'][$id]['options'] ) ? $meta['shortcodes'][$id]['options'] : array();
}

/**
 * Get template markup for an element.
 *
 * @param  string $path
 * @return string
 */
function ux_builder_element_template( $path ) {
  ob_start();
  include ux_builder_path( "/app/shortcodes/{$path}" );
  return ob_get_clean();
}
