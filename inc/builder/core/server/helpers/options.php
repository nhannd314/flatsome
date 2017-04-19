<?php

/**
 * Register an option type.
 *
 * @param  string $type
 * @param  array  $data
 */
function add_ux_builder_option_type( $type, $data = array() ) {
  UxBuilder\Options\Options::register( $type, $data );
}
