<?php

$GLOBALS['_ux_builder_post_types'] = array();

/**
 * @param string $type
 */
function add_ux_builder_post_type( $type ) {
  $GLOBALS['_ux_builder_post_types'][$type] = true;
}

/**
 * @param string $type
 */
function remove_ux_builder_post_type( $type ) {
  if ( isset( $GLOBALS['_ux_builder_post_types'][$type] ) ) {
    unset( $GLOBALS['_ux_builder_post_types'][$type] );
  }
}

/**
 *
 */
function get_ux_builder_post_types() {
  return $GLOBALS['_ux_builder_post_types'];
}
