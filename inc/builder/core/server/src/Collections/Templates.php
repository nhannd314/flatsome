<?php

namespace UxBuilder\Collections;

class Templates extends Collection {

  public function set( $key, $value ) {
    $post_types = get_ux_builder_post_types();

    $this->items[$key] = wp_parse_args( $value, array(
      'post_types' => array_keys( $post_types ),
    ));
  }

  public function to_array() {
    $items = array();

    foreach ( $this->items as $id => $data ) {
      $items[$id] = $data;
      unset( $items[$id]['content'] );
    }

    return $items;
  }
}
