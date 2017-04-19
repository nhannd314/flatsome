<?php

namespace UxBuilder\Ajax;

use UxBuilder\Post\PostArray;

class AjaxManager {

  protected $data;
  protected $do_shortcode;
  protected $posts;
  protected $post_saver;
  protected $wp_attachment;
  protected $terms;

  public function __construct() {
    $this->data = new Data();
    $this->do_shortcode = new DoShortcode();
    $this->posts = new Posts();
    $this->post_saver = new PostSaver();
    $this->wp_attachment = new WpAttachment();
    $this->terms = new Terms();

    add_action( 'wp_ajax_ux_builder_get_data', array( $this->data, 'get_data' ) );
    add_action( 'wp_ajax_ux_builder_search_posts', array( $this->posts, 'search_posts' ) );
    add_action( 'wp_ajax_ux_builder_get_posts', array( $this->posts, 'get_posts' ) );
    add_action( 'wp_ajax_ux_builder_save', array( $this->post_saver, 'save' ) );
    add_action( 'wp_ajax_ux_builder_get_attachment', array( $this->wp_attachment, 'get_attachment' ) );
    add_action( 'wp_ajax_ux_builder_search_terms', array( $this->terms, 'search_terms' ) );
    add_action( 'wp_ajax_ux_builder_get_terms', array( $this->terms, 'get_terms' ) );
    add_action( 'wp_ajax_ux_builder_to_array', array( $this, 'to_array' ) );

    if ( ! array_key_exists( 'ux_builder_action', $_POST ) ) return;

    add_action( 'template_redirect', array( $this->do_shortcode, 'do_shortcode' ), 0 );
  }

  public function to_array () {
    $id = $_POST['id'];
    $template = ux_builder_get_template( $id );
    $post_array = new PostArray( (object) array(
      'post_content' => $template['content']
    ) );

    return wp_send_json_success( array(
      'content' => $post_array->create_array()
    ) );
  }
}
