<?php


add_ux_builder_shortcode( 'search', array(
  'name' => __( 'Search Box' ),
  'category' => __( 'Content' ),
  'thumbnail' => flatsome_ux_builder_thumbnail( 'search' ),
  'wrap' => false,
  'allow_in' => array('text_box'),
  'presets' => array(
    array(
      'name' => __( 'Default' ),
      'content' => '[search]',
      ),
    ),
    'options' => array(
      'style' => array(
          'type' => 'select',
          'heading' => __( 'Style' ),
          'options' => array(
              '' => 'Normal',
              'flat' => 'Flat',
          )
        ),

      'size' => array(
              'type' => 'radio-buttons',
              'heading' => __( 'Size' ),
              'default' => 'medium',
              'options' => require( __DIR__ . '/values/text-sizes.php' ),
              'on_change' => array(
                  'class' => 'is-{{ value }}'
              )
        ),
    )
) );