<?php

/**
 * Transforms a string with shortcodes to an array.
 *
 * @param  string $string
 * @return array
 */
function ux_builder_to_array( $string ) {
  return ux_builder( 'to-array' )->transform( $string );
}

/**
 * Transforms an array of shortcodes into a string.
 *
 * @param  array  $array
 * @return string
 */
function ux_builder_to_string( $array ) {
  return ux_builder( 'to-string' )->transform( $array );
}

/**
 * Walk throug all elements in a transformed array.
 *
 * @param  array    $array
 * @param  callable $callback
 */
function ux_builder_content_array_walk( &$array, $callback ) {
  foreach ( $array as $key => &$item ) {
    call_user_func_array( $callback, array( &$item, $key ) );
    if ( array_key_exists( 'children', $item ) && is_array( $item['children'] ) ) {
      ux_builder_content_array_walk( $item['children'], $callback );
    }
    if ( array_key_exists( 'content', $item ) && is_array( $item['content'] ) ) {
      ux_builder_content_array_walk( $item['content'], $callback );
    }
  }
}
