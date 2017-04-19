<?php

/**
 * Render styles for an element.
 *
 * @param  string $id
 * @param  array  $rules
 * @return string
 */
function ux_builder_element_style_tag( $id, $rules, $atts ) {
  $breakpoints = get_ux_builder_breakpoints();

  // Just return here if no attributes are set.
  if ( empty( $atts ) ) return '';

  // Prepare breakpoints.
  $styles = array_reduce( $breakpoints, function ( $styles, $breakpoint ) {
    $breakpoint['rules'] = array();
    array_push( $styles, $breakpoint );
    return $styles;
  }, array() );

  foreach ( $rules as $param_name => $rule ) {
    if ( ! array_key_exists( $param_name, $atts ) ) continue;

    // Collect all responsive values for this option.
    $values = ux_builder_get_responsive_values( $param_name, $atts );

    // Move responsive values to lowest possible breakpoint.
    $breakpoint_values = ux_builder_process_breakpoint_values( $values );

    foreach ( $breakpoint_values as $breakpoint => $value ) {
      if ( strval( $value ) == '' ) continue;

      $unit = array_key_exists( 'unit', $rule ) ? $rule['unit'] : '';
      $selectors = array_map( 'trim', explode( ',', isset( $rule['selector'] ) ? $rule['selector'] : '' ) );
      $properties = array_map( 'trim', explode( ',', isset( $rule['property'] ) ? $rule['property'] : '' ) );
      $size = isset( $rule['size'] ) ? $rule['size'] : '';

      foreach ( $selectors as $selector ) {
        $selector_str = trim( "#{$id} {$selector}" );
        foreach ( $properties as $property ) {
          if ( empty( $property ) ) continue;
          if ( isset( $rule['unit'] ) ) $value = floatval( $value ) . $unit;
          $declaration = array( 'property' => $property, 'value' => $value, 'size' => $size);
          $declaration = apply_filters( 'ux_builder_css_declaration', $declaration );
          if (!empty($declaration['value'])) {
            $declaration_str = trim( "{$declaration['property']}: {$declaration['value']};" );
          }
          $styles[$breakpoint]['rules'][$selector_str][] = $declaration_str;
        }
      }
    }
  }

  // Generates the style tag.
  $output = "";
  if(!empty($styles)) $output .= "\n<style scope=\"scope\">\n\n";
  foreach ( $styles as $index => $media ) {
    if ( count( $media['rules'] ) ) {
      if ( $index > 0 ) $output .= "\n\n@media (min-width:{$styles[$index - 1]['width']}px) {\n\n";
      foreach ( $media['rules'] as $selector => $declarations ) {
        $indent = str_repeat( ' ',  $index > 0 ? 2 : 0 );
        $output .= $indent . $selector . " {\n{$indent}  " . implode( "\n{$indent}  " , $declarations ) . "\n{$indent}}\n";
      }
      if ( $index > 0 ) $output .= "\n}\n";
    }
  }
  if(!empty($styles)) $output .= "</style>\n";

  return $output;
}
