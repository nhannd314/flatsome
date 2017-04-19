<?php

namespace UxBuilder\Options;

class Options {

  protected static $types;
  protected $options = array();

  public function __construct( $options, $group = null ) {
    foreach ( $options as $name => $data ) {
      if ( $group ) {
        // Inherit require option from group.
        if ( $group->get_data( 'require' ) ) {
          $data['require'] = $group->get_data( 'require' );
        }
        // Merge group conditions with option conditions.
        if ( $group->get_data( 'conditions' ) ) {
          $data['conditions'] = array_key_exists( 'conditions', $data )
            ? $data['conditions'] . ' && ' . $group->get_data( 'conditions' )
            : $group->get_data( 'conditions' );
        }
      }
      $this->options[$name] = $this->create( $name, $data );
    }
  }

  public function create( $name, $data ) {
    $option_data = self::$types[$data['type']];
    $option_class = $option_data['class'];
    $data = ux_builder_parse_args( $data, $option_data['defaults'] );

    return new $option_class( $name, $data, $this );
  }

  public function set_values( $values ) {
    foreach ( $this->options as $name => $option ) {
      $current_name = $option->get_data( '$name' );
      $org_name = $option->get_data( '$org_name' );
      if ( $option->is( 'group' ) ) {
        $option->set_value( $values );
      } else {
        if ( array_key_exists( $org_name, $values ) ) {
            $option->set_value( $values[$org_name] );
        } else if ( array_key_exists( $current_name, $values ) ) {
            $option->set_value( $values[$current_name] );
        } else {
            $option->set_value( null );
        }
      }
    }

    return $this;
  }

  public function get_values() {
    $values = array();

    foreach ( $this->options as $name => $option ) {
      $value = $option->get_value();
      if ( $option->is( 'group' ) ) {
        $values = array_merge( $values, $value );
      } else {
        $values[$option->get_data( '$name' )] = $value;
      }
    }

    return $values;
  }

  public function get_options() {
    return $this->options;
  }

  public function has_option( $find_name ) {
    foreach ( $this->flatten()->get_options() as $name => $option ) {
      if ( $name == $find_name ) return true;
    }

    return false;
  }

  public function get_option( $find_name ) {
    foreach ( $this->flatten()->get_options() as $name => $option ) {
      if ( $find_name == $option->get_name() ) return $option;
      else if ( $find_name == $option->get_org_name() ) return $option;
    }
  }

  public function flatten() {
    $options = array();

    foreach ( $this->options as $name => $option ) {
      if ( $option->is( 'group' ) ) {
        $group_options = $option->get_data('options')->flatten()->get_options();
        foreach ( $group_options as $name => $option ) {
          $options[$name] = $option->get_raw();
        }
      } else {
        $options[$name] = $option->get_raw();
      }
    }

    return new static( $options );
  }

  public function camelcase() {
    $options = array();

    foreach ( $this->options as $name => $option ) {
      $camelcased_name = ux_builder_to_camelcase( $name );
      $options[$camelcased_name]['$org_name'] = $name;
      if ( $option->is( 'group' ) ) {
        $data = $option->get_raw();
        $data['options'] = array();
        $group_options = $option->get_data('options')->camelcase()->get_options();
        foreach ( $group_options as $name => $option ) {
          $data['options'][$name] = $option->get_raw();
        }
        $options[$camelcased_name] += $data;
      } else {
        $options[$camelcased_name] += $option->get_raw();
      }
    }

    return new static( $options );
  }

  public function to_array() {
    $array = array();

    foreach ( $this->options as $name => $option ) {
      $array[] = $option->to_array();
    }

    return $array;
  }

  public static function register( $type, $data = array() ) {
    $data = ux_builder_parse_args( $data, array(
      'class' => 'UxBuilder\Options\Option',
      'defaults' => array(),
    ) );

    self::$types[$type] = apply_filters( 'ux_builder_option_type', $data, $type );
  }
}
