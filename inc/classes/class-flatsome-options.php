<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/**
 * This is a wrapper class for Kirki.
 * If the Kirki plugin is installed, then all CSS & Google fonts
 * will be handled by the plugin.
 * In case the plugin is not installed, this acts as a fallback
 * ensuring that all CSS & fonts still work.
 * It does not handle the customizer options, simply the frontend CSS.
 */
class Flatsome_Option {

  /**
   * @static
   * @access protected
   * @var array
   */
  protected static $config = array();
  
  /**
   * @static
   * @access protected
   * @var array
   */
  protected static $fields = array();
  
  /**
   * The class constructor
   */
  public function __construct() {
    // If Kirki exists then there's no reason to procedd
    if ( class_exists( 'Kirki' ) ) {
      return;
    }
  }

  /**
   * Create a new panel
   *
   * @param   string      the ID for this panel
   * @param   array       the panel arguments
   */
  public static function add_panel( $id = '', $args = array() ) {
     

    if ( class_exists( 'Kirki' ) ) {
      Kirki::add_panel( $id, $args );
    }
    // If Kirki does not exist then there's no reason to add any panels.
  }

  /**
   * Create a new section
   *
   * @param   string      the ID for this section
   * @param   array       the section arguments
   */
  public static function add_section( $id, $args ) {

    if ( class_exists( 'Kirki' ) ) {
      Kirki::add_section( $id, $args );
    }
    // If Kirki does not exist then there's no reason to add any sections.
  }


  /**
   * Sets the configuration options.
   *
   * @param    string    $config_id    The configuration ID
   * @param    array     $args         The configuration arguments
   */
  public static function add_config( $config_id, $args = array() ) {
    if ( class_exists( 'Kirki' ) ) {
      Kirki::add_config( $config_id, $args );
      return;
    }
  }

  /**
   * Create a new field
   *
   * @param    string    $config_id    The configuration ID
   * @param    array     $args         The field's arguments
   */
  public static function add_field( $config_id, $args ) {
    /*if ( class_exists( 'Redux' ) && !is_customize_preview() ) {
    global $opt_name;

    $default = $args['default'];
    $options = null;

    if($args['type'] == 'color-alpha'){
      $args['type'] = 'color_rgba';
    }
    if($args['type'] == 'radio-image'){
      $args['type'] = 'image_select';
    }
    if($args['type'] == 'radio-buttonset'){
      $args['type'] = 'button_set';
    }
    if($args['type'] == 'code'){
      $args['type'] = 'ace_editor';
    }
    if($args['type'] == 'typography'){
      $args['type'] = 'media';
    }

    Redux::setField( $opt_name, array(
        'title'  =>  $args['title'],
        'section_id' => $args['section'],
        'id'       => $args['setting'],
        'type'     => $args['type'],
        'title'    => $args['label'],
        'desc'     => $args['description'],
        'default'  => $default,
        'options' => $args['choices'],
        'min' =>  $args['choices']['min'],
        'max' =>  $args['choices']['max'],
        'step' => $args['choices']['step'],
    ) );
    } */

    // if Kirki exists, use it.
    if ( class_exists( 'Kirki' ) ) {
      Kirki::add_field( $config_id, $args );
      return;
    }
  }
}
new Flatsome_Option();