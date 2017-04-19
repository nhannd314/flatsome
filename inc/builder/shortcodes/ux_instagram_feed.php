<?php

$options = array(
'pages_options' => array(
    'type' => 'group',
    'heading' => __( 'Options' ),
    'options' => array(

    'username' => array( 'type' => 'textfield','heading' => 'Username', 'default' => 'wonderful_places'),
    //'link' => array( 'type' => 'textfield','heading' => 'Link title', 'default' => 'Follow us on instagram'),

    'photos' => array(
        'type' => 'slider',
        'heading' => 'Images',
        'default' => 10,
        'max' => 12,
        'min' => 3,
    ),

    'caption' => array(
          'type' => 'radio-buttons',
          'heading' => __('Captions'),
          'default' => 'true',
          'options' => array(
              0  => array( 'title' => 'Off'),
              'true'  => array( 'title' => 'On'),
          ),
    ),
    'image_hover' => array(
        'type' => 'select',
        'heading' => __( 'Hover' ),
        'default' => '',
        'options' => require( __DIR__ . '/values/image-hover.php' ),
        'on_change' => array(
            'selector' => '.instagram-image-container',
            'class' => 'image-{{ value }}'
        )
    ),
  ),
),
'layout_options' => require( __DIR__ . '/commons/repeater-options.php' ),
'layout_options_slider' => require( __DIR__ . '/commons/repeater-slider.php' ),
);

// Set defaults
$options['layout_options']['options']['col_spacing']['default'] = 'collapse';
$options['layout_options']['options']['type']['default'] = 'row';
$options['layout_options']['options']['type']['options'] = array(
    'slider' => 'Slider',
    'row' => 'Row'
);

add_ux_builder_shortcode( 'ux_instagram_feed', array(
  'name' => __( 'Instagram Feed' ),
  'category' => __( 'Content' ),
  'thumbnail' => flatsome_ux_builder_thumbnail( 'instagram_feed' ),
  'presets' => array(
    array(
      'name' => __( 'Default' ),
      'content' => '[ux_instagram_feed]',
      ),
    array(
      'name' => __( 'Simple Grid' ),
      'content' => '[ux_instagram_feed username="stylechild_no" col_spacing="small"]',
      ),
    array(
      'name' => __( 'Full Width Slider' ),
      'content' => '[ux_instagram_feed username="topshop" type="slider" slider_nav_color="light" width="full-width" columns="6"]',
      ),
    array(
      'name' => __( 'Simple Slider' ),
      'content' => '[ux_instagram_feed username="stylechild_no" type="slider" slider_nav_position="outside" col_spacing="small"]',
      ),
    array(
      'name' => __( 'Full Width B&W' ),
      'content' => '[ux_instagram_feed username="topshop" image_hover="color" type="slider" slider_nav_color="light" width="full-width" columns="6"]',
      ),
    ),
    'options' => $options
) );