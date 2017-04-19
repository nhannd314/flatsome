<?php

namespace UxBuilder\Post;

use UxBuilder\Transformers\StringToArray;
use UxBuilder\Elements\ElementOptions;

class PostArray {

  protected $post;
  protected $post_array;
  protected $used_ids;
  protected $preserved_ids;

  public function __construct( $post ) {
    $this->post = $post;
    $this->post_array = $this->create_array();
  }

  public function create_array() {
    $self = $this;
    $post_content = $this->post->post_content;
    $this->post_array = ux_builder( 'to-array' )->transform( "[_root]{$post_content}[/_root]" );

    ux_builder_content_array_walk( $this->post_array, function ( &$item ) use ( $self ) {
      $item['options'] = $self->get_options( $item['tag'], $item['options'] );
    });

    return array_shift( $this->post_array );
  }

  /**
   * Gets the generated post array.
   *
   * @return array
   */
  public function get_array() {
    return $this->post_array;
  }

  /**
   * Get options for an element.
   *
   * @param  string $tag
   * @param  array  $values
   * @return array
   */
  public function get_options( $tag, $values ) {
    $shortcode = ux_builder_shortcodes()->get( $tag );
    $options = new ElementOptions( $shortcode['options'] );
    return $options->set_values( $values )->camelcase()->get_values();
  }
}
