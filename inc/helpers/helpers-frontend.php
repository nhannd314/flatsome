<?php

/**
 * Load a template.
 *
 * @param  string $name
 * @param  array  $vars
 * @return string
 */
function flatsome_template( $name, array $vars = array() ) {
  $located_template = locate_template( 'template-parts/' . $name . '.php' );
  if ( $located_template != '' ) {
    extract( $vars );
    ob_start();
    include $located_template;
    return ob_get_clean();
  }
  return '';
}

/**
 * Converts an array into html attributes.
 *
 * @param  array  $atts
 * @return string
 */
function flatsome_html_atts( array $atts ) {
  $string = '';
  foreach ( $atts as $key => $value ) {
    if ( is_array( $value ) ) $value = implode( ' ', $value );
    $string .= "${key}=\"${value}\" ";
  }
  return $string;
}

/**
 * Get Flatsome Icon classes
  */
function get_flatsome_icon_class($style, $size = null){

    $classes = array();
    if($style == 'small'){ $classes[] = 'icon plain';}
    if($style == 'outline'){ $classes[] = 'icon button circle is-outline';}
    if($style == 'outline-round'){ $classes[] = 'icon button round is-outline';}
    if($style == 'fill'){ $classes[] = 'icon primary button circle';}
    if($style == 'fill-round'){ $classes[] = 'icon primary button round';}
    if($size){ $classes[] = 'is-'.$size;}

    return implode(' ', $classes);
}

/**
 * Minify CSS
  */
function flatsome_minify_css($css){
  //$css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
  $css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css);
  return $css;
}
