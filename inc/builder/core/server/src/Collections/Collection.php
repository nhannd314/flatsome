<?php

namespace UxBuilder\Collections;

class Collection {

  protected $items;

  public function __construct() {
    $this->items = array();
  }

  public function set( $key, $value ) {
    $this->items[$key] = $value;
  }

  public function get( $key ) {
    return $this->items[$key] ?: null;
  }

  public function all() {
    return $this->items;
  }

  public function remove( $key ) {
    unset( $this->items[$key] );
  }

  public function clear() {
    $this->items = array();
  }

  public function to_array() {
    return $this->all();
  }
}
