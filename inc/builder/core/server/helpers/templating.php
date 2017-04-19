<?php

function ux_builder_template_path( $path ) {
  return ux_builder_path( "/server/templates/{$path}.php" );
}

function ux_builder_html_atts( $attributes ) {
  $output = '';

  foreach( $attributes as $key => $value ) {
      $output .= is_numeric( $key ) ? $value . ' ' : $key . '="' . $value . '" ';
  }

  return trim( $output, ' ' );
}

function ux_builder_render( $__template, $__variables = array() ) {
  extract( $__variables );
  unset( $__variables );

  include ux_builder_template_path( $__template );
}
