<?php

/**
 * Modify CSS declarations before element styles are generated.
 *
 * @param   array  $declaration
 * @return  array
 */
add_filter( 'ux_builder_css_declaration', function ( $declaration ) {
  switch ( $declaration['property'] ) {
    case 'background-image':
      if ( is_numeric( $declaration['value'] ) ) {
        $value = wp_get_attachment_image_src( $declaration['value'], $declaration['size'] );
        if(isset($value[0])) $declaration['value'] = 'url(' . $value[0] . ')';
      } else {
        if(isset($declaration['value'])) $declaration['value'] = 'url(' . $declaration['value'] . ')';
      }
      break;

      case 'rotate':
         $declaration['property'] = 'transform';
         $declaration['value'] = 'rotate(' . $declaration['value'] . ')';
      break;
  }
  return $declaration;
} );
