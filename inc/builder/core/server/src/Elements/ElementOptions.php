<?php

namespace UxBuilder\Elements;

use UxBuilder\Options\Options;

class ElementOptions extends Options {

  public function set_values( $values ) {
    parent::set_values( $values );

    foreach ( $this->options as $name => $option ) {
      $current_name = $option->get_data( '$name' );
      $org_name = $option->get_data( '$org_name' );
      if ( $option->is( 'group' ) ) {
        $option->set_value( $values );
      } else {
        if ( $option->is_responsive() ) {
          if ( ! array_key_exists( $org_name, $values ) ) $values[$org_name] = $option->get_value();
          $option->set_data( 'responsive_values', ux_builder_get_responsive_values( $org_name, $values ) );
        }
      }
    }

    return $this;
  }

  public function get_values() {
    $values = parent::get_values();
    $values['$responsive'] = array();

    foreach ( $this->flatten()->get_options() as $option ) {
      $name = $option->get_name();
      if ( $option->is_responsive() ) {
        // TODO: Change this to responsive attributes.
        $parsed_value = ux_builder_parse_value( $option->get_value(), true );
        $values['$responsive'][$name] = $parsed_value;
        $values[$name] = $parsed_value['_default'];
        unset( $values['$responsive'][$name]['_default'] );
        //
        if ( $responsive_values = $option->get_data( 'responsive_values' ) ) {
          $values['$responsive'][$name] = $responsive_values;
        }
      }
    }

    // Make sure $responsive is a object when json_encoded.
    if ( empty( $values['$responsive'] ) ) {
      $values['$responsive'] = (object) array();
    }

    return $values;
  }
}
