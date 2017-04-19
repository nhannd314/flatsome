<?php

namespace UxBuilder\Options;

class OnChangeHandler {

  protected $selector;
  protected $recompile;
  protected $handler;
  protected $option;

  public function __construct( $data, $option ) {
    $this->selector = isset( $data['selector'] ) ? $data['selector'] : false;

    $this->recompile = array_key_exists( 'recompile', $data )
      ? $data['recompile']
      : true;

    $this->option = $option;

    if ( array_key_exists( 'class', $data ) ) {
      $this->handler = $this->setup_class( $data['class'] );
    }
    if ( array_key_exists( 'style', $data ) ) {
      $this->handler = $this->setup_style( $data['style'] );
    }
    if ( array_key_exists( 'content', $data ) ) {
      $this->handler = $this->setup_content( $data['content'] );
    }
  }

  /**
   * @return array
   */
  public function to_array() {
    return array(
      'selector' => $this->selector,
      'recompile' => $this->recompile,
      'handler' => $this->handler,
    );
  }

  /**
   * Set up class handler. Generates a regex that
   * will be used to replace previous classes.
   *
   * @param  string $data
   * @return array
   */
  protected function setup_class( $data ) {
    $class = array( 'type' => 'class', 'class' => $data );

    $match_reg = '/([\s\S]+)?(\{\{[\s\S]+\}\})([\s\S]+)?/';
    $replace_reg = '$1(\S)+$3'; // '$1(\{\{[\s\S]+\}\})$3';
    $class['regex'] = preg_replace( $match_reg, $replace_reg, $data );

    return $class;
  }

  /**
   * Set up style handler.
   *
   * @param  string $data
   * @return array
   */
  protected function setup_style( $data ) {
    $style = array( 'type' => 'style', 'rules' => array() );

    $rules = array_map( 'trim', explode( ';', $data ) );
    foreach ( $rules as $rule ) {
      if ( empty( $rule ) ) continue;
      $parts = array_map( 'trim', explode( ':', $rule ) );
      $style['rules'][] = array(
        'property' => $parts[0],
        'value' => $parts[1],
      );
    }

    return $style;
  }

  /**
   * Set up content handler.
   * @param  string $data
   * @return array
   */
  protected function setup_content( $data ) {
    return array( 'type' => 'content', 'value' => $data );
  }
}
