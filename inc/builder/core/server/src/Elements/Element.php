<?php

namespace UxBuilder\Elements;

class Element {

  public $tag;

  public function __construct( $tag, $data ) {
    foreach ( $data as $name => $value ) {
      $this->{$name} = $value;
    }
    $this->tag = $tag;
    $this->options = new ElementOptions( $data['options'] );
  }

  /**
   * Convert element to an array ready for builder data.
   *
   * @return array
   */
  public function to_array() {
    foreach ( $this->presets as $key => &$preset ) {
      $array = ux_builder( 'to-array' )->transform( $preset['content'] );

      ux_builder_content_array_walk( $array, function ( &$item ) {
        $shortcode = ux_builder_shortcodes()->get( $item['tag'] );
        $options = new ElementOptions( $shortcode['options'] );
        $item['options'] = $options->set_values( $item['options'] )->camelcase()->get_values();
      });

      $preset['content'] = array_shift( $array );
    }

    // Convert this instance to an array. We also converts
    // all key cases to camelcase, but excludes the options.
    $vars = get_object_vars( $this );
    unset( $vars['options'] );
    $array = ux_builder_to_camelcase( $vars );
    $array['options'] = $this->options->camelcase()->to_array();

    return $array;
  }
}
