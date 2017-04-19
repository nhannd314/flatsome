<?php

add_action( 'ux_builder_setup', function () {
  // Register default option types.
  add_ux_builder_option_type( 'checkbox' );
  add_ux_builder_option_type( 'col-slider', array(
   'defaults' => array(
     'min' => 1,
     'max' => 12,
   ),
  ) );
  add_ux_builder_option_type( 'colorpicker' );
  add_ux_builder_option_type( 'group', array(
   'class' => 'UxBuilder\Options\Custom\GroupOption',
   'defaults' => array(
     'full_width' => true,
     'options' => array()
   ),
  ) );
  add_ux_builder_option_type( 'gallery' );
  add_ux_builder_option_type( 'image', array(
    'class' => 'UxBuilder\Options\Custom\ImageOption',
    'defaults' => array(
      'thumb_size' => '',
      'bg_position' => '',
    ),
  ) );
  add_ux_builder_option_type( 'text-editor' );
  add_ux_builder_option_type( 'margins', array(
    'defaults' => array(
      'unit' => 'px',
      'simple' => false,
    ),
  ) );
  add_ux_builder_option_type( 'radio-buttons' );
  add_ux_builder_option_type( 'radio-images' );
  add_ux_builder_option_type( 'scrubfield', array(
    'defaults' => array(
      'unit' => 'px',
    ),
  )  );
  add_ux_builder_option_type( 'select', array(
   'class' => 'UxBuilder\Options\Custom\SelectOption',
   'defaults' => array(
     'options' => array()
   ),
  ) );
  add_ux_builder_option_type( 'slider' );
  add_ux_builder_option_type( 'textarea' );
  add_ux_builder_option_type( 'textfield' );
} );
