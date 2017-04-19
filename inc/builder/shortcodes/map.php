<?php

add_ux_builder_shortcode( 'map', array(
  'type' => 'container',
  'name' => __( 'Map' ),
  'category' => __( 'Content' ),
  'thumbnail' =>  flatsome_ux_builder_thumbnail( 'map' ),
  'template' => flatsome_ux_builder_template( 'map.html' ),
  'wrap' => false,
  'scripts' => array(
    'google-maps' => '//maps.google.com/maps/api/js?key='.flatsome_option('google_map_api'),
  ),

  'presets' => array(
    array(
      'name' => 'Default',
      'content' => '
        [map content_width="30" content_width__sm="100" content_width__md="40" position_x__sm="100" position_y__sm="100"]
          Enter street adress here. Or any other information you want.</p>
        [/map]',
    ),
  ),

  'options' => array(

    'height' => array(
      'type' => 'scrubfield',
      'heading' => 'Height',
      'default' => '500px',
      'responsive' => true
    ),

    'lat' => array(
      'type' => 'scrubfield',
      'heading' => 'Latitude',
      'default' => '40.79028',
      'step' => '0.00001',
      'unit' => '',
    ),

    'long' => array(
      'type' => 'scrubfield',
      'heading' => 'Longitude',
      'default' => '-73.95972',
      'step' => '0.00001',
      'unit' => '',
    ),

    'zoom' => array(
      'type' => 'slider',
      'heading' => __( 'Zoom' ),
      'default' => 17,
      'max' => 20,
      'min' => 1,
    ),

    'pan' => array(
      'type' => 'checkbox',
      'heading' => __( 'Pan' ),
      'default' => 'true',
    ),

    'content_group' => array(
      'type' => 'group',
      'heading' => __( 'Content' ),
      'options' => array(
           'content_enable' => array(
            'type' => 'checkbox',
            'heading' => __( 'Show Content' ),
            'default' => 'true',
          ),
          'content_bg' => array(
            'type' => 'colorpicker',
            'heading' => __('Background'),
            'format' => 'rgb',
            'default' => '#fff',
            'position' => 'bottom right',
          ),
          'content_width' => array(
            'type' => 'slider',
            'heading' => __( 'Width' ),
            'responsive' => true,
            'default' => 30,
            'min'  => 0,
            'max'  => 100,
            'step' => 1
          ),
          'position_x' => array(
            'type' => 'slider',
            'heading' => __( 'X Position' ),
            'responsive' => true,
            'default' => 95,
            'min'  => 0,
            'max'  => 100,
            'step' => 5
          ),
          'position_y' => array(
            'type' => 'slider',
            'heading' => __( 'Y Position' ),
            'responsive' => true,
            'default' => 95,
            'min'  => 0,
            'max'  => 100,
            'step' => 5
            ),
        ),
    ),

    'controls_group' => array(
      'type' => 'group',
      'heading' => __( 'Controls' ),
      'options' => array(
        'controls' => array(
          'type' => 'checkbox',
          'heading' => __( 'Show controls' ),
          'default' => false,
        ),
        'zoom_control' => array(
          'type' => 'checkbox',
          'heading' => __( 'Zoom' ),
          'default' => 'true',
          'conditions' => 'controls === "true"'
        ),
        'street_view_control' => array(
          'type' => 'checkbox',
          'heading' => __( 'Street view' ),
          'default' => 'true',
          'conditions' => 'controls === "true"'
        ),
        'map_type_control' => array(
          'type' => 'checkbox',
          'heading' => __( 'Map type' ),
          'default' => 'true',
          'conditions' => 'controls === "true"'
        ),
      ),
    ),

    'styles_group' => array(
      'type' => 'group',
      'heading' => 'Style',
      'options' => array(
        'color' => array(
          'type' => 'colorpicker',
          'heading' => 'Color',
          'default' => '#58728a',
          'format' => 'hex',
          'position' => 'bottom right',
        ),
        'saturation' => array(
          'type' => 'slider',
          'heading' => 'Saturation',
          'default' => -30,
          'max' => 100,
          'min' => -100,
        ),
      ),
    ),
  ),
) );
