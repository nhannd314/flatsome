<?php

namespace UxBuilder\Transformers;

abstract class Transformer {
  abstract function transform( $input, array $container = null );
}
