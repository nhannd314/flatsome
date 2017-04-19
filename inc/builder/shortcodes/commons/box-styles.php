<?php

if(!$default_text_align) $default_text_align = 'left';

return array(

    //
    // Image options
    //
    'image_options' => array(
        'type' => 'group',
        'heading' => __( 'Image' ),
        'options' => array(

            'image_height' => array(
              'type' => 'scrubfield',
              'heading' => __('Height'),
              'conditions' => 'type !== "grid"',
              'default' => '',
              'placeholder' => __('Auto'),
              'min' => 0,
              'max' => 1000,
              'step' => 1,
              'helpers' => require( __DIR__ . '/../helpers/image-heights.php' ),
               'on_change' => array(
                    'selector' => '.box-image-inner',
                    'style' => 'padding-top: {{ value }}'
                )
            ),

            'image_width' => array(
                'type' => 'slider',
                'heading' => __( 'Width' ),
                'unit' => '%',
                'default' => 100,
                'max' => 100,
                'min' => 0,
                'on_change' => array(
                    'selector' => '.box-image',
                    'style' => 'width: {{ value }}%'
                )
            ),

            'image_radius' => array(
                'type' => 'slider',
                'heading' => __( 'Radius' ),
                'unit' => '%',
                'default' => 0,
                'max' => 100,
                'min' => 0,
                'on_change' => array(
                    'selector' => '.box-image-inner',
                    'style' => 'border-radius: {{ value }}%'
                )
            ),

            'image_size' => array(
                'type' => 'select',
                'heading' => __( 'Size' ),
                'default' => '',
                'options' => array(
                    '' => 'Default',
                    'large' => 'Large',
                    'medium' => 'Medium',
                    'thumbnail' => 'Thumbnail',
                    'original' => 'Original',
                )
            ),

            'image_overlay' => array(
                'type' => 'colorpicker',
                'heading' => __( 'Overlay' ),
                'default' => '',
                'alpha' => true,
                'format' => 'rgb',
                'position' => 'bottom right',
                'on_change' => array(
                    'selector' => '.overlay',
                    'style' => 'background-color: {{ value }}'
                )
            ),

            'image_hover' => array(
                'type' => 'select',
                'heading' => __( 'Hover' ),
                'default' => '',
                'options' => require( __DIR__ . '/../values/image-hover.php' ),
                'on_change' => array(
                    'selector' => '.image-cover',
                    'class' => 'image-{{ value }}'
                )
            ),
            'image_hover_alt' => array(
                'type' => 'select',
                'heading' => __( 'Hover Alt' ),
                'default' => '',
                'conditions' => 'image_hover',
                'options' => require( __DIR__ . '/../values/image-hover.php' ),
                'on_change' => array(
                    'selector' => '.image-cover',
                    'class' => 'image-{{ value }}'
                )
            ),
        ),
    ),

    //
    // Text options
    //

    'text_options' => array(
        'type' => 'group',
        'heading' => __( 'Text' ),
        'options' => array(

            'text_pos' => array(
                'type' => 'select',
                'heading' => __( 'Position' ),
                'conditions' => 'style === "vertical" || style === "shade" || style === "overlay"',
                'default' => 'bottom',
                'options' => require( __DIR__ . '/../values/align-v.php' ),

                'on_change' => array(
                    'selector' => '.box',
                    'class' => 'box-text-{{ value }}'
                )
            ),

            'text_align' => array(
                'type' => 'radio-buttons',
                'heading' => __( 'Align' ),
                'default' => $default_text_align,
                'options' => require( __DIR__ . '/../values/align-radios.php' ),
                'on_change' => array(
                    'selector' => '.box-text',
                    'class' => 'text-{{ value }}'
                )
            ),

            'text_size' => array(
                'type' => 'radio-buttons',
                'heading' => __( 'Size' ),
                'default' => 'medium',
                'options' => require( __DIR__ . '/../values/text-sizes.php' ),
                'on_change' => array(
                    'selector' => '.box-text',
                    'class' => 'is-{{ value }}'
                )
            ),

            'text_hover' => array(
                'type' => 'select',
                'heading' => __( 'Hover' ),
                'default' => '',
                'options' => require( __DIR__ . '/../values/text-hover.php' ),
            ),

            'text_bg' => array(
                'type' => 'colorpicker',
                'heading' => __( 'Bg Color' ),
                'default' => '',
                'alpha' => true,
                'format' => 'rgb',
                'position' => 'bottom right',
                'on_change' => array(
                    'selector' => '.box-text',
                    'style' => 'background-color:{{ value }}'
                )
            ),

            'text_color' => array(
                'type' => 'radio-buttons',
                'heading' => __( 'Color' ),
                'default' => 'light',
                'options' => array(
                    'light' => array( 'title' => 'Dark' ),
                    'dark' => array( 'title' => 'Light' ),
                ),
            ),
            'text_padding' => array(
              'type' => 'margins',
              'heading' => __( 'Padding' ),
              'value' => '',
              'full_width' => true,
              'min' => 0,
              'max' => 100,
              'step' => 1,

              'on_change' => array(
                    'selector' => '.box-text',
                    'style' => 'padding: {{ value }}'
                )
            ),
        ),
    ),
);
