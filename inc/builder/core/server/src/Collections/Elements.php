<?php

namespace UxBuilder\Collections;

class Elements extends Collection {

  /**
  * Register a shortcode.
  *
  * @param  string  $tag
  * @param  array   $data
  */
  public function set( $tag, $data ) {
    if ( $this->exists( $tag ) ) return;

    $data = wp_parse_args( $data, array(
      'type' => 'normal',
      'tag' => $tag,
      'name' => $tag,
      'class' => 'UxBuilder\Elements\Element',
      'category' => __( 'Content' ),
      'message'  => __( 'Add elements', 'ux_builder' ),
      'info'     => '',
      'image'    => false,
      'inline'   => false,
      'nested'   => false,
      'hidden'   => false,
      'depth'    => 0,
      'draggable' => true,
      'external' => false,
      'wrap'     => true,
      'overlay'  => false,
      'styles'   => array(),
      'scripts'  => array(),
      'presets'  => array(),
      'options'  => array(),
      'directives' => array(),
      'buttons'  => array(),
      'compile'  => true,
      'toolbar'  => false,
      'resize' => false,
      'move' => false,
      'children' => array(),
      'scroll_to' => true,
      'add_buttons' => false,
      'addable_spots' => false,
      'tools_controller' => ux_builder_to_pascalcase( "${tag}ToolsController" ),
      'shortcode_controller' => ux_builder_to_pascalcase( "${tag}ShortcodeController" ),
      'template' => null,
      'template_url' => null,
      'template_backend' =>  isset( $data['type'] ) ? 'shortcodes/_container_backend.html' : 'shortcodes/_normal_backend.html',
      'template_shortcode' => isset( $data['type'] ) ? "[{tag}{options}]\n\n{content}\n[/{tag}]\n" : "[{tag}{options}]\n\n",
      'selected_tools' => '',
      'allow' => array(),
      'allow_in' => array(),
      'require' => array(),
      'priority' => 10,
    ) );

    $data = apply_filters( "ux_builder_shortcode_data", $data, $tag );
    $data = apply_filters( "ux_builder_shortcode_data_{$tag}", $data );

    if ( $data['nested'] ) {
      $this->add_nested_tag_names( $tag );
    }

    if ( ! $data['addable_spots'] ) {
      $data['addable_spots'] = $this->setup_addable_spots( $data );
    }

    if ( empty( $data['presets'] ) ) {
      array_push( $data['presets'], array(
        'name' => __( 'Default', 'ux_builder' ),
        'content' => $data['type'] == 'normal' ? "[{$tag}]" : "[{$tag}][/{$tag}]",
      ));
    }

    // Indicate if template should be loaded from server.
    if ( empty( $data['template'] ) && empty( $data['template_url'] ) ) {
      $data['template'] = false;
    }

    $this->items[$tag] = $data;
  }

  /**
  * Get a shortcode instance by tag.
  *
  * @param   string  $tag
  * @return  mixed
  */
  public function get( $tag = null ) {
    $tag = $this->extract_tag_name( $tag );
    if ( $tag && isset( $this->items[$tag] ) ) {
      return $this->items[$tag];
    } else if ( $tag && ! isset( $this->items[$tag] ) ) {
      return false;
    }

    return $this->all();
  }

  /**
  * Check if a shortcode is registered by tag.
  *
  * @param   string  $shortcode
  * @return  bool
  */
  public function exists( $tag ) {
    return array_key_exists( $tag, $this->items );
  }

  /**
   * Setup the available addable spots..
   *
   * @param  array $data
   * @return array
   */
  protected function setup_addable_spots( $data ) {
    $spots = array();

    // Add left and right points if this is an inline element.
    // Otherwise add top and bottom as available spots.
    if ( $data['inline'] ) array_push( $spots, 'left', 'right' );
    else array_push( $spots, 'top', 'bottom' );

    // Add center spot if this is a container element.
    if ( $data['type'] == 'container' ) array_push( $spots, 'center' );

    return $spots;
  }

  /**
   * Extract tag name from nested tag names.
   *
   * @param  string $string
   * @return string
   */
  protected function extract_tag_name( $string ) {
    $tag = explode( '_inner', $string );
    $tag = $tag[0];
    return $this->exists( $tag ) ? $tag : $string;
  }

  /**
   * Add nested tag names for elements that allows nesting. WordPress does not
   * support nested tags, so we have to suffix the tag names with _inner,
   * _inner_1, _inner_2 etc. We supports 10 nested levels.
   *
   * @param string $tag
   */
  protected function add_nested_tag_names( $tag ) {
      global $shortcode_tags;

      if( ! array_key_exists( $tag, $shortcode_tags ) ) return;

      $shortcode_tags["{$tag}_inner"] = $shortcode_tags[$tag];

      for ( $i = 1; $i <= 8; $i++) {
          $shortcode_tags["{$tag}_inner_{$i}"] = $shortcode_tags[$tag];
      }
  }

  /**
  * Get all shortcode data in an array keyed by tag.
  *
  * @return  array
  */
  public function to_array() {
    $array = array();

    foreach ( $this->items as $tag => $data ) {
      // Set element as allowed on the elements
      // that are listed in the «allow_in» option.
      foreach ( $data['allow_in'] as $allow_in ) {
        array_push( $this->items[$allow_in]['allow'], $tag );
      }
    }

    foreach ( $this->items as $tag => $data ) {
      $instance = new $data['class']( $data['tag'], $data );
      $array[$tag] = $instance->to_array();
    }

    return $array;
  }
}
