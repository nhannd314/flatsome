<?php

namespace UxBuilder\Post;

use WP_Post;

class Post {

  /**
   * @var WP_Post
   */
  protected $post;

  public function __construct( WP_Post $post ) {
    $this->post = $post;
  }

  /**
   * Get the post object.
   *
   * @return WP_Post
   */
  public function post() {
    return $this->post;
  }

  /**
   * Get post permalink or edit url if post is not published.
   *
   * @return string
   */
  public function permalink() {
    return get_permalink( $this->post );
  }

  /**
   * Get edit post link.
   *
   * @return string
   */
  public function editlink() {
    return admin_url( 'post.php?post=' . $this->post->ID . '&action=edit'  );
  }

  /**
   * Get all meta data for this post.
   *
   * @return array
   */
  public function meta_data() {
    $meta_data_array = array();
    foreach ( get_post_meta( $this->post->ID ) as $key => $value ) {
      $meta_data_array[$key] = $value[0];
    }
    return $meta_data_array;
  }

  /**
   * Generates an array to be used in the builder data.
   *
   * @return array
   */
  public function to_array() {
    $post_array = new PostArray( $this->post );
    $post_options = new PostOptions( $this->post );

    return array(
      'id' => $this->post->ID,
      'type' => $this->post->post_type,
      'status' => $this->post->post_status,
      'content' => (object) $post_array->get_array(),
      'attributes' => (object) $post_options->get_attributes_array(),
      'meta' => (object) $post_options->get_meta_array(),
    );
  }
}
