<?php

namespace UxBuilder\Post;

use UxBuilder\Transformers\ArrayToString;
use UxBuilder\Elements\ElementOptions;

class PostString {

  protected $transformer;
  protected $post;

  public function __construct( $post ) {
    $this->transformer = new ArrayToString();
    $this->post = $post;
  }
}
