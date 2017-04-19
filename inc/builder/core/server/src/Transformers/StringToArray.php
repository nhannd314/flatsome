<?php

namespace UxBuilder\Transformers;

use UxBuilder\Collections\Elements;

class StringToArray extends Transformer {

  /**
   * @var Elements
   */
  protected $elements;

  public function __construct( Elements $elements ) {
    $this->elements = $elements;
  }

  /**
   * Transforms given string to an array of shortcode items.
   *
   * @param  string $string
   * @param  array  $container
   * @return array
   */
  public function transform( $string, array $container = null ) {
    $prepared = $this->insert_text_shortcodes( $string );
    $items = array();

    preg_match_all( $this->get_regex(), $prepared, $matches, PREG_SET_ORDER );

    foreach ( $matches as $i => $match ) {
      $shortcode = $this->elements->get( $match[2] );
      $tag = $shortcode['tag'];
      $shortcode_atts = shortcode_parse_atts( $match[3] ) ?: array();
      $options = apply_filters( 'ux_builder_preprocess_array_options', $shortcode_atts, $tag );
      $content = apply_filters( 'ux_builder_preprocess_array_content', $match[5], $tag, $options );

      $item = array(
        'tag' => $tag,
        'options' => $options,
      );

      if ( $shortcode['type'] == 'container' ) {
        if ( $shortcode['compile'] ) {
          $item['children'] = $this->transform( $content );
        } else {
          $item['content'] = ux_builder_trim( $content );
        }
      }

      array_push( $items, apply_filters( 'ux_builder_array_item', $item ) );
    }

    return $items;
  }

  /**
   * Wraps text that is not inside any shortcodes in a text shortcode.
   *
   * @param   string  $raw
   * @return  string
   */
  protected function insert_text_shortcodes( $raw ) {
    preg_match_all( $this->get_regex(), $raw, $matches, PREG_OFFSET_CAPTURE );

    $prepared = '';
    $min_offset = 0;

    // If there was no matches, the raw content contains only text or
    // unregistered shortcodes. Wrap it all in a text shortcode and return it.
    $raw_trimmed = ux_builder_trim( $raw );

    if( empty( $matches[0] ) && ! empty( $raw_trimmed ) ) {
      return $this->generate_text_shortcode( $raw );
    }

    foreach ( $matches[0] as $key => $match ) {
        $shortcode = $this->elements->get( $matches[2][$key][0] );
        $tag = $shortcode['tag'];
        $content = $match[0];
        $offset  = $match[1];
        $length  = strlen( $content );

        if( $this->elements->exists( $tag ) ) {
            if( $portion = trim( substr( $raw, $min_offset, $offset - $min_offset ) ) ) {
                $prepared .= $this->generate_text_shortcode( $portion );
            }
            $prepared .= $content;
            $min_offset = $offset + $length;
        }

        // Put the rest of the content into a text shortcode
        if( $match === end( $matches[0] ) && $min_offset < strlen( $raw ) ) {
            if( $portion = trim( substr( $raw, $min_offset ) ) ) {
                $prepared .= $this->generate_text_shortcode( $portion );
            }
        }
    }

    return $prepared;
  }

  /**
   * Wrap $content in a text shortcode.
   *
   * @param  string $content
   * @return string
   */
  private function generate_text_shortcode( $content ) {
    return '[text]' . wpautop( $content ) . '[/text]';
  }

  /**
   * Regex for extracting shortcodes from a string.
   *
   * @param  string $tag
   * @return string
   */
  private function get_regex() {
    return '/\[(\[?)(.*?)(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*(?:\[(?!\/\2\])[^\[]*)*)(\[\/\2\]))?)(\]?)/';
  }
}
