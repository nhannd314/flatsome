<?php

namespace UxBuilder\Ajax;

use UxBuilder\Options\Options;
use UxBuilder\Transformers\ArrayToString;

class PostSaver {

  public function save() {
    define( 'UX_BUILDER_SAVING', true );
    $data = json_decode( stripslashes( $_POST['data'] ), true );
    $can_edit = current_user_can( 'edit_post', $data['id'] );
    $can_publish = current_user_can( 'publish_post', $data['id'] );
    $can_save = apply_filters( 'ux_builder_can_save', '__return_true', $data );

    // Return an error if nonce is invalid.
    check_ajax_referer( 'ux-builder-' . $data['id'], 'security' );

    // Stop here if user is not allowed to edit post.
    if ( ! $can_edit or ! $can_save ) {
      return wp_send_json_error();
    }

    $post_content = '';

    if( array_key_exists( 'children', $data['content'] ) ) {
      $post_content = ux_builder( 'to-string' )->transform( $data['content']['children'] );
    }

    // Publish post if user has permission to do it.
    if ( $can_publish && $data['status'] == 'publish' ) {
      $post_status = $data['status'];
      $save_button = __( 'Update', 'wordpress' );
    } else {
      $post_status = $data['status'];
      $save_button = $post_status == 'pending'
        ? __( 'Submit for Review', 'wordpress' )
        : __( 'Publish', 'wordpress' );
    }

    $post = apply_filters( 'ux_builder_save_post', array_merge( $data['attributes'], array(
      'ID' => $data['id'],
      'meta_input' => $data['meta'],
      'post_content' => trim( $post_content ),
      'post_status' => $post_status,
    ) ) );

    if ( wp_update_post( $post ) ) {
      return wp_send_json_success( compact( 'post', 'save_button' ) );
    }

    return wp_send_json_error();
  }
}
