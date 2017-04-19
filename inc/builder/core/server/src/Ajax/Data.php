<?php

namespace UxBuilder\Ajax;

class Data {

  public function get_data() {
    return wp_send_json_success( array(
      'data' => true
    ) );
  }
}
