<?php

namespace UxBuilder\Options;

class Option {

  protected static $id = 0;
  protected $name = '';
  protected $options = null;
  protected $data = array();
  protected $raw_data = array();

  public function __construct( $name, $data, $options ) {
    $this->name = $name;
    $this->options = $options;
    $this->raw_data = $data;
    $this->data = $this->process_data( wp_parse_args( $data, array(
      '$id' => 'option:' . self::$id++,
      '$name' => $name,
      '$org_name' => $name,
      'type' => '',
      'heading' => '',
      'description' => '',
      'default' => '',
      'value' => null,
      'require' => null,
      'conditions' => null,
      'on_change' => null,
      'auto_focus' => false,
      'save_when_default' => false,
    ) ) );
  }

  public function process_data( $data ) {
    return apply_filters( 'ux_builder_option', $data, $data['$org_name'] );
  }

  public function is( $type ) {
    return $this->data['type'] == $type;
  }

  public function get_name() {
    return $this->name;
  }

  public function get_org_name() {
    return $this->data['$org_name'];
  }

  public function get_raw() {
    return $this->raw_data;
  }

  public function set_data( $key, $value ) {
    $this->data[$key] = $value;
    $this->raw_data[$key] = $value;
  }

  public function get_data( $key = null ) {
    if ( $key ) {
      return array_key_exists( $key, $this->data ) ? $this->data[$key] : null;
    }
    return $this->data;
  }

  public function set_value( $value ) {
    $this->data['value'] = trim( $value );
    $this->raw_data['value'] = $value;
  }

  public function get_value() {
    return $this->data['value'] != ''
      ? $this->data['value']
      : $this->data['default'];
  }

  public function is_responsive() {
    return array_key_exists( 'responsive', $this->data ) && $this->data['responsive'];
  }

  public function to_array() {
    $data = array();

    foreach ( $this->data as $setting => $value ) {
      $name = ux_builder_to_camelcase( $setting );
      $data[$name] = $value;
    }

    if ( $data['onChange'] ) {
      $handler = new OnChangeHandler( $data['onChange'], $this );
      $data['onChange'] = $handler->to_array();
    }

    if ( $data['conditions'] ) {
      $data['conditions'] = $this->prefix_options_string( $data['conditions'], '$ctrl.model.%s' );
    }

    return $data;
  }

  /**
   * Prefix param names in given string.
   *
   * @param  string $value
   * @param  string $tpl
   * @return string
   */
  protected function prefix_options_string( $value, $tpl ) {
    $org_value = $value;
    $value = preg_replace_callback(
      "/(?!\B\'|\"[^\'|\"]*)([\w-]++(?<!\btrue|false|null|undefined))(?![^\'|\"]*\'|\"\B)/",
      function ( $matches ) use ( $tpl, $org_value ) {
        return sprintf( $tpl, ux_builder_to_camelcase( $matches[0] ) );
      },
      $value
    );
    $value = str_replace( '"', "'", $value );
    if ( substr( $value, 0, 1 ) == "'" ) $value = trim( $value, "'" );

    return $value;
  }
}
