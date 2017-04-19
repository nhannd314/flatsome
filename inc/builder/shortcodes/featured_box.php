<?php

add_ux_builder_shortcode( 'featured_box', array(
    'type' => 'container',
    'name' => __( 'Icon Box' ),
    'category' => __( 'Content' ),
    'thumbnail' =>  flatsome_ux_builder_thumbnail( 'icon_box' ),
    'wrap' => false,
    'presets' => array(
        array(
            'name' => __( 'Default' ),
            'content' => '[featured_box]<h3>Lorem ipsum dolor sit amet</h3><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat....</p>[/featured_box]'
        ),
    ),
    'options' => array(
      'img' => array(
        'type' => 'image',
        'heading' => 'Icon',
        'value' => '',
      ),
      'inline_svg' => array(
        'type' => 'checkbox',
        'heading' => 'Inline SVG',
        'default' => 'true'
      ),
      'img_width' => array(
        'type' => 'slider',
        'heading' => 'Icon Width',
        'unit' => 'px',
        'default' => 60,
        'max' => 600,
        'min' => 20,
        'on_change' => array(
          'selector' => '.icon-box-img',
          'style' => 'width: {{ value }}px'
        ),
      ),
      'pos' => array(
        'type' => 'select',
        'heading' => 'Icon Position',
        'default' => 'top',
        'options' => array(
          'top' => 'Top',
          'center' => 'Center',
          'left' => 'Left',
          'right' => 'Right',
        ),
        'on_change' => array(
          'class' => 'icon-box-{{ value }}',
        ),
      ),
      'title' => array(
        'type' => 'textfield',
        'heading' => 'Title',
        'value' => '',
        'on_change' => array(
          'selector' => '.icon-box-text h5',
          'content' => '{{ value }}',
        ),
      ),
      'title_small' => array(
        'type' => 'textfield',
        'heading' => 'Title Small',
        'value' => '',
        'on_change' => array(
          'selector' => '.icon-box-text h6',
          'content' => '{{ value }}',
        ),
      ),
      'tooltip' => array(
        'type' => 'textfield',
        'heading' => 'Tooltip',
        'value' => '',
      ),
      'link' => array(
        'type' => 'textfield',
        'heading' => 'Link',
        'value' => '',
      ),
      'font_size' => array(
        'type' => 'radio-buttons',
        'heading' => __( 'Text Size' ),
        'default' => 'medium',
        'options' => require( __DIR__ . '/values/text-sizes.php' ),
        'on_change' => array(
          'recompile' => false,
          'class' => 'is-{{ value }}',
        ),
      ),
      'icon_border' => array(
        'type' => 'slider',
        'heading' => 'Icon Border',
        'unit' => 'px',
        'default' => 0,
        'max' => 10,
        'min' => 0,
        'on_change' => array(
          'selector' => '.has-icon-bg .icon-inner',
          'style' => 'border-width: {{ value }}px',
        ),
      ),
      'icon_color' => array(
        'type' => 'colorpicker',
        'heading' => __( 'Icon Color' ),
        'description' => __( 'Only works for simple SVG icons' ),
        'format' => 'rgb',
        'position' => 'bottom right',
        'on_change' => array(
          'selector' => '.icon-inner',
          'style' => 'color: {{ value }}'
        ),
      ),
      'margin' => array(
        'type' => 'margins',
        'heading' => __( 'Margin' ),
        'value' => '',
        'default' => '',
        'min' => -100,
        'max' => 100,
        'step' => 1,
        'on_change' => array(
          'selector' => '.icon-box',
          'style' => 'margin: {{ value }}'
        ),
      ),
    )
) );
