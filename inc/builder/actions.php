<?php

add_action( 'wp_ajax_flatsome_block_title', function () {
  global $wpdb;

  $block_id = $_GET['block_id'];
  $block_title = $wpdb->get_var( "SELECT post_title FROM $wpdb->posts WHERE post_type = 'blocks' AND id = '$block_id'");

  return wp_send_json_success( array(
    'block_title' => $block_title
  ) );
} );
