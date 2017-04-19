<?php


add_ux_builder_shortcode( 'col_grid', array(
    'type' => 'container',
    'name' => __( 'Grid Item' ),
    'category' => __( 'Layout' ),
    'template' => flatsome_ux_builder_template( 'col_grid.html' ),
    'tools' => 'shortcodes/col/col-tools.directive.html',
    'info' => '{{ span }}/12',
    'require' => array( 'row' ),
    'allow' => array( 'ux_banner','ux_slider','ux_image'),
    'resize' => array( 'right', 'bottom' ),
    'scroll_to' => false,
    'wrap'   => false,
    'inline' => true,
    'nested' => true,

    'children' => array(
      'addable_spots' => array()
    ),

    'presets' => array(
        array(
            'name' => __( 'Default' ),
            'content' => '[col_grid span="6"][/col_grid]',
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

        'height' => array(
            'type' => 'radio-buttons',
            'heading' => 'Height',
            'full_width' => true,
            'default' => '1',
            'options' => array(
                '1' => array( 'title' => '1-1'),
                '1-2' => array( 'title' => '1-2'),
                '1-3' => array( 'title' => '1-3'),
                '2-3' => array( 'title' => '2-3'),
                '1-4' => array( 'title' => '1-4'),
                '3-4' => array( 'title' => '3-4'),
            ),
        ),

        'animate' => array(
            'type' => 'select',
            'heading' => 'Animate',
            'options' => require( __DIR__ . '/values/animate.php' ),
        ),

        'class' => array(
            'type' => 'textfield',
            'heading' => 'Class',
            'default' => '',
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
