<?php

namespace UxBuilder\Transformers;

use UxBuilder\Options\Options;
use UxBuilder\Collections\Elements;

class ArrayToString extends Transformer {

  /**
   * @var array
   */
  protected $nested;

  /**
   * @var Elements
   */
  protected $elements;

  public function __construct( Elements $elements ) {
    $this->elements = $elements;
    $this->nested = array();
  }

  /**
   * Transforms the given array into a string.
   *
   * @param  array $array
   * @param  array $container
   * @return string
   */
  public function transform( $array, array $container = null ) {
    $string = '';

    foreach ( $array as $item ) {
      $shortcode = $this->elements->get( $item['tag'] );
      $nested = $this->increase_nested( $item['tag'] );
      $tag = $this->generate_tag( $item, $nested );
      $options = $this->options_to_string( $item, $shortcode );
      $content = $this->get_content( $item );

      $string .= str_replace(
        array( '{tag}', '{options}', '{content}' ),
        array( $tag, $options, $content, ),
        $shortcode['template_shortcode']
      );

      $this->decrease_nested( $item['tag'] );
    }

    return $string;
  }

  /**
   * Increase nested depth for a tag.
   *
   * @param  string $tag
   * @return number
   */
  protected function increase_nested( $tag ) {
    if ( array_key_exists( $tag, $this->nested ) ) $this->nested[$tag]++;
    else $this->nested[$tag] = 0;
    return $this->nested[$tag];
  }

  /**
   * Decrease nested depth for a tag.
   *
   * @param  string $tag
   */
  protected function decrease_nested( $tag ) {
    if ( array_key_exists( $tag, $this->nested ) ) $this->nested[$tag]--;
    else $this->nested[$tag] = 0;
  }

  /**
   * Generates a tag to prevent nested shortodes.
   *
   * @param  array  $item
   * @param  number $nested
   * @return string
   */
  protected function generate_tag( $item, $nested ) {
    if( $nested < 1 ) return $item['tag'];
    $number = '';
    for ( $i = 1; $i < $nested; $i++ ) {
        $number = "_{$i}";
    }
    return "{$item['tag']}_inner{$number}";
  }

  /**
   * Transforms content to an array if the «children» key is present.
   *
   * @param  arrat $item
   * @return *
   */
  protected function get_content( $item ) {
    if ( ! empty( $item['children'] ) ) {
      return $this->transform( $item['children'], $item );
    } else if ( ! empty( $item['content'] ) ) {
      return $item['content'];
    }
    return '';
  }

  /**
   * Convert array of options to a string of attributes.
   *
   * @param  array  $item
   * @param  array  $shortcode
   * @return string
   */
  protected function options_to_string( $item, $shortcode ) {
    $options = new Options( $shortcode['options'] );
    $shortcode_options = $options->flatten()->camelcase();
    $shortcode_options->set_values( $item['options'] );
    $default_breakpoint_index = get_default_ux_builder_breakpoint();
    $breakpoints = get_ux_builder_breakpoints();
    $breakpoint_keys = array_keys( $breakpoints );
    $breakpoint_names = array();

    foreach ( $breakpoints as $name => $data ) {
      $breakpoint_names[] = $name;
    }

    $string = '';

    // Insert _id attribute if item has an ID.
    if ( isset( $item['$id'] ) ) $string .= " _id=\"{$item['$id']}\"";

    foreach ( $shortcode_options->get_options() as $name => $option ) {
      if ( $name == '$responsive' ) continue;
      $value = $option->get_data( 'value' );
      $default_value = $option->get_data( 'default' );
      $save_when_default = $option->get_data( 'save_when_default' );
      $org_name = $option->get_data( '$org_name' );
      // Save param if not empty and not equals the default value.
      if ( strval( $value ) != '' && ( $value != $default_value || $save_when_default == true ) ) {
        $string .= ' ' . $org_name . '="' . $value . '"';
      }
      // Generate the responsive attributes.
      if ( isset( $item['options']['$responsive'][$name] ) ) {
        foreach ( $item['options']['$responsive'][$name] as $breakpoint_index => $breakpoint_value ) {
          $breakpoint_name = $breakpoint_names[$breakpoint_index];
          if ( $breakpoint_index != $default_breakpoint_index && strval( $breakpoint_value ) != '' ) {
            $string .= ' ' . $org_name . '__' . $breakpoint_name . '="' . $breakpoint_value . '"';
          }
        }
      }
    }

    return $string;
  }
}
