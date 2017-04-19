<?php

add_ux_builder_shortcode( 'col', array(
    'type' => 'container',
    'name' => __( 'Column', 'ux-builder' ),
    'category' => __( 'Layout' ),
    'template' => flatsome_ux_builder_template( 'col.html' ),
    'tools' => 'shortcodes/col/col-tools.directive.html',
    'info' => '{{ span }}/12',
    'require' => array( 'row' ),
    'wrap'   => false,
    'inline' => true,
    'nested' => true,
    'resize' => array( 'right' ),

    'presets' => array(
        array(
            'name' => __( 'Default' ),
            'content' => '[col span="4" span__sm="12"][/col]',
        ),
    ),

    'options' => array(

        'span' => array(
            'type' => 'col-slider',
            'heading' => 'Width',
            'full_width' => true,
            'responsive' => true,
            'auto_focus' => true,
            'default' => 12,
            'max' => 12,
            'min' => 1,
        ),

        'visibility'  => require( __DIR__ . '/commons/visibility.php' ),

        'force_first' => array(
            'type' => 'select',
            'heading' => 'Force First Position',
            'default' => '',
            'options' => array(
                ''   => 'None',
                'medium' => 'On Tablets',
                'small'  => 'On Mobile'
            )
        ),

        'divider' => array(
            'type' => 'checkbox',
            'heading' => 'Divider',
        ),

        'padding' => array(
            'type' => 'margins',
            'heading' => 'Padding',
            'full_width' => true,
            'min' => 0,
            'max' => 200,
            'step' => 1,
        ),

        'margin' => array(
            'type' => 'margins',
            'heading' => 'Margin',
            'full_width' => true,
            'min' => -200,
            'max' => 200,
            'step' => 1,
        ),

        'align' => array(
            'type' => 'radio-buttons',
            'heading' => 'Text align',
            'default' => '',
            'options' => require( __DIR__ . '/values/align-radios.php' ),
        ),

        'bg_color' => array(
            'type' => 'colorpicker',
            'heading' => __('Bg Color'),
            'format' => 'rgb',
            'alpha' => true,
            'position' => 'bottom right',
            'helpers' => require( __DIR__ . '/helpers/colors.php' ),
        ),

        'color' => array(
            'type' => 'radio-buttons',
            'heading' => 'Color',
            'default' => '',
            'options' => array(
                'light'   => array( 'title' => 'Light'),
                ''  => array( 'title' => 'Dark'),
            ),
        ),

        'text_depth' => array(
              'type' => 'slider',
              'heading' => __('Text Shadow'),
              'default' => '0',
              'unit' => '+',
              'max' => '5',
              'min' => '0',
        ),

        'max_width' => array(
            'type' => 'scrubfield',
            'heading' => 'Max Width',
            'default' => '',
            'min' => '0'
        ),


        'animate' => array(
            'type' => 'select',
            'heading' => 'Animate',
            'default' => 'none',
            'options' => require( __DIR__ . '/values/animate.php' ),
        ),

        'hover' => array(
            'type' => 'select',
            'heading' => 'Hover effect',
            'options' => array(
                '' => 'None',
                'fade' => 'Fade In',
                'focus' => 'Focus',
                'blur' => 'Blur In',
            ),
        ),

        'tooltip' => array(
            'type' => 'textfield',
            'heading' => 'Tooltip',
        ),

        'class' => array(
            'type' => 'textfield',
            'heading' => 'Class',
            'default' => '',
        ),

        'parallax' => array(
            'type' => 'slider',
            'vertical' => true,
            'heading' => 'Parallax',
            'default' => 0,
            'max' => 10,
            'min' => -10,
        ),

        'depth' => array(
            'type' => 'slider',
            'vertical' => true,
            'heading' => 'Depth',
            'default' => 0,
            'max' => 5,
            'min' => 0,
        ),

        'depth_hover' => array(
            'type' => 'slider',
            'vertical' => true,
            'heading' => 'Hover Depth',
            'default' => 0,
            'max' => 5,
            'min' => 0,
        ),
    ),
) );
