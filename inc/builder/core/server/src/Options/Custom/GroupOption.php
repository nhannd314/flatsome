<?php

namespace UxBuilder\Options\Custom;

use UxBuilder\Options\Option;

class GroupOption extends Option {

  public function __construct( $name, $data, $container ) {
    parent::__construct( $name, $data, $container );
    $container_class = get_class( $container );
    $this->data['options'] = new $container_class( $data['options'], $this );
  }

  public function set_value( $value ) {
    $this->data['options']->set_values( $value );
  }

  public function get_value() {
    return $this->data['options']->get_values();
  }

  public function to_array() {
    $data = parent::to_array();
    $data['options'] = $this->data['options']->to_array();

    unset( $data['value'] );
    unset( $data['default'] );
    unset( $data['responsive'] );

    return $data;
  }
}
