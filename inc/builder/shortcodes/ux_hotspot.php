<?php

$position_options = require( __DIR__ . '/commons/position.php' );
$position_options['options']['position_x']['on_change'] = array(
  'recompile' => false,
  'class' => 'x{{ value }} md-x{{ value }} lg-x{{ value }}'
);
$position_options['options']['position_y']['on_change'] = array(
  'recompile' => false,
  'class' => 'y{{ value }} md-y{{ value }} lg-y{{ value }}'
);

add_ux_builder_shortcode( 'ux_hotspot', array(
  'name' => 'Hotspot',
  'category' => __( 'Content' ),
  'require' => 'ux_banner',
  'thumbnail' =>  flatsome_ux_builder_thumbnail( 'ux_hotspot' ),
  //'template' => flatsome_ux_builder_template( 'ux_hotspot.html' ),
  'allow_in' => array('ux_banner'),
  'wrap' => false,
  'options' => array(
       'type' => array(
            'type' => 'radio-buttons',
            'heading' => 'Type',
            'default' => 'text',
            'options' => array(
                'text'   => array( 'title' => 'Text'),
                'product'  => array( 'title' => 'Product'),
            ),
        ),
        'prod_id' => array(
          'type' => 'select',
          'heading' => __('PRoduct'),
          'full-width' => true,
          'conditions' => 'type === "product"',
          'config' => array(
              'multiple' => false,
              'placeholder' => 'Select..',
              'postSelect' => array(
                  'post_type' => array( 'product')
              ),
          )
        ),

        'text' => array(
          'type' => 'textfield',
          'holder' => 'button',
          'heading' => __('Text'),
          'conditions' => 'type === "text"',
          'param_name' => 'text',
          'focus' => 'true',
          'default' => 'Enter any text...',
          'auto_focus' => true,
        ),
        'link' => array(
          'type' => 'textfield',
          'holder' => 'button',
          'heading' => __('Link'),
          'conditions' => 'type === "text"',
          'param_name' => 'text',
          'focus' => 'true',
          'default' => '',
          'auto_focus' => true,
       ),
       'icon' => array(
            'type' => 'radio-buttons',
            'heading' => __('Icon'),
            'default' => 'plus',
            'options' => array(
                'plus'  => array( 'title' => 'Plus'),
                'search'   => array( 'title' => 'Search'),
                'play'  => array( 'title' => 'Play'),
            ),
      ),
      'size' => array(
          'type' => 'radio-buttons',
          'heading' => __('Size'),
          'default' => 'medium',
          'options' => array(
              'xsmall'   => array( 'title' => 'XS'),
              'small'   => array( 'title' => 'S'),
              'medium'  => array( 'title' => 'M'),
              'large'  => array( 'title' => 'L'),
              'xlarge'  => array( 'title' => 'XL'),
          ),
      ),
      'bg_color' => array(
          'type' => 'colorpicker',
          'heading' => __('Bg Color'),
          'format' => 'rgb',
          'position' => 'bottom right',
          'helpers' => require( __DIR__ . '/helpers/colors.php' ),
      ),
      'animate' => array(
              'type' => 'select',
              'heading' => __('Animate'),
              'param_name' => 'animate',
              'default' => 'none',
              'options' => require( __DIR__ . '/values/animate.php' ),
      ),
      'depth' => array(
              'type' => 'slider',
              'heading' => __('Depth'),
              'default' => '0',
              'max' => '5',
              'min' => '0',
      ),
      'depth_hover' => array(
              'type' => 'slider',
              'heading' => __('Depth :hover'),
              'default' => '0',
              'max' => '5',
              'min' => '0',
      ),
      'position_options' => $position_options,
  )
) );
