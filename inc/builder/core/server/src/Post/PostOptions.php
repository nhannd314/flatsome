<?php

namespace UxBuilder\Post;

use UxBuilder\Options\Options;

class PostOptions {

  protected  $attributes;
  protected  $meta;

  public function __construct( $post ) {
    $attribute_options = apply_filters( 'ux_builder_post_options', array(), $post );
    $meta_options = apply_filters( 'ux_builder_meta_options', array(), $post );
    $meta = get_post_meta( $post->ID, null, true );

    $this->attributes = new Options( $attribute_options );
    $this->meta = new Options( $meta_options );

    foreach ( $this->attributes->get_options() as $name => $option ) {
      $option->set_value( $post->{$name} );
    }

    foreach ( $this->meta->get_options() as $name => $option ) {
        if ( array_key_exists( $name, $meta ) ) {
          $option->set_value( maybe_unserialize( $meta[$name][0] ) );
        }
    }
  }

  public function get_attributes_array() {
    return array(
      'values' => $this->attributes->get_values(),
      'options' => $this->attributes->to_array(),
    );
  }

  public function get_meta_array() {
    return array(
      'values' => $this->meta->get_values(),
      'options' => $this->meta->to_array(),
    );
  }
}
