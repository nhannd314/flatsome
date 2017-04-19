<?php

namespace UxBuilder\Options\Custom;

use UxBuilder\Options\Option;

class ImageOption extends Option {

  public function process_data( $data ) {
    $data['thumb_size_org'] = $data['thumb_size'];
    $data['thumb_size'] = ux_builder_to_camelcase( $data['thumb_size'] );
    $data['bg_position'] = ux_builder_to_camelcase( $data['bg_position'] );

    return parent::process_data( $data );
  }

  public function get_value() {
    $value = parent::get_value();
    // if ( is_numeric( $value ) ) {
    //   $size = $this->get_image_size();
    //   $attachment = wp_get_attachment_image_src( $value, $size );
    //   $value = $attachment[0];
    // }
    return $value;
  }

  public function set_value( $value ) {
    // if ( ! empty( $value ) ) {
    //   $value = $this->get_image_id( $value ) ?: $value;
    // }
    parent::set_value( $value );
  }

  protected function get_image_size() {
    $image_size = null;
    if ( ! empty( $this->data['thumb_size_org'] ) ) {
      $thumb_size_org = $this->data['thumb_size_org'];
      $image_size = $this->options->get_option( $thumb_size_org )->get_value();
    }
    return $image_size;
  }

  protected function get_image_id( $image_url ) {
    global $wpdb;
    $url = parse_url( $image_url );
    $prepare = $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid LIKE '%s';", '%' . $url['path'] );
    $attachment = $wpdb->get_col( $prepare );
    return ! empty( $attachment ) ? $attachment[0] : null;
  }
}
