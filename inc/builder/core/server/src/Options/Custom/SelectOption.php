<?php

namespace UxBuilder\Options\Custom;

use UxBuilder\Options\Option;

class SelectOption extends Option {

  public function to_array() {
    $data = parent::to_array();
    $data['options'] = array();

    foreach ( $this->data['options'] as $value => $label ) {
      $data['options'][] = array(
        'value' => $value,
        'label' => $label,
      );
    }

    return $data;
  }
}
