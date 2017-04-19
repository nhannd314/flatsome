<?php

function ux_builder_trim( $string ) {
  return trim( preg_replace( '/\s\s+/', '', $string ) );
}

function ux_builder_to_camelcase( $string, array $no_strip = array() ) {
  if ( is_array( $string ) ) return ux_builder_to_camelcase_deep( $string );
  $string = preg_replace( '/[^a-z0-9$' . implode("", $no_strip) . ']+/i', ' ', $string );
  $string = trim( $string );
  $string = ucwords( $string );
  $string = str_replace( ' ', '', $string );
  $string = lcfirst( $string );
  return $string;
}

function ux_builder_to_camelcased_array( $array ) {
  $camelcased = array();
  foreach ( $array as $key => $value ) {
    $camelcased[ux_builder_to_camelcase( $key )] = $value;
  }
  return $camelcased;
}

function ux_builder_to_camelcase_deep( $array ) {
  $camelcased = array();
  foreach ( $array as $key => $value ) {
    if ( is_array( $value ) ) $value = ux_builder_to_camelcase_deep( $value );
    $camelcased[ux_builder_to_camelcase( $key )] = $value;
  }
  return $camelcased;
}

function ux_builder_to_pascalcase( $string, array $no_strip = array() ) {
  return ucfirst( ux_builder_to_camelcase( $string, $no_strip ) );
}

function ux_builder_to_slugcase( $string ) {
  $string = preg_replace( '/([a-z])([A-Z])/', "\\1_\\2", $string );
  $string = strtolower( $string );
  return $string;
}

function ux_builder_string_or_number( $value ) {
    return is_numeric( $value ) ? (int) $value : $value;
}
