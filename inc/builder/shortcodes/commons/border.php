<?php
// Border Control
return array(
      'type' => 'group',
      'heading' => __( 'Border' ),
      'options' => array(
        'border' => array(
            'type' => 'margins',
            'heading' => 'Width',
            'full_width' => true,
            'min' => 0,
            'max' => 100,
            'step' => 1,
        ),
        'border_margin' => array(
            'type' => 'margins',
            'heading' => 'Margin',
            'conditions' => 'border',
            'full_width' => true,
            'min' => -100,
            'max' => 100,
            'step' => 1,
        ),
        'border_style' => array(
            'type' => 'radio-buttons',
            'heading' => 'Style',
            'full_width' => true,
            'conditions' => 'border',
            'default' => '',
            'options' => array(
                ''   => array( 'title' => 'Solid'),
                'dashed'  => array( 'title' => 'Dashed'),
                'dotted'  => array( 'title' => 'Dotted'),
            ),
        ),
        'border_radius' => array(
            'type' => 'slider',
            'heading' => 'Radius',
            'conditions' => 'border',
            'unit' => 'px',
            'min' => 0,
            'max' => 100,
            'step' => 1,
        ),
        'border_color' => array(
          'type' => 'colorpicker',
          'heading' => __('Color'),
          'conditions' => 'border',
          'responsive' => true,
          'alpha' => true,
          'format' => 'rgb',
          'position' => 'bottom right',
        ),
        'border_hover' => array(
            'type' => 'select',
            'heading' => __( 'Hover' ),
            'default' => '',
            'conditions' => 'border',
            'options' => require( __DIR__ . '/../values/text-hover.php' ),
        ),
),
);