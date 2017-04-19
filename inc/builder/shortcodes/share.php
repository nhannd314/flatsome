<?php

add_ux_builder_shortcode( 'share', array(
    'name' => __( 'Share Icons' ),
    'category' => __( 'Content' ),
    'thumbnail' =>  flatsome_ux_builder_thumbnail( 'share' ),
    'options' => array(
        'title' => array(
            'type' => 'textfield',
            'heading' => 'Title',
            'default' => '',
        ),
        'style' => array(
            'type' => 'radio-buttons',
            'heading' => __( 'Style' ),
            'default' => '',
            'options' => array(
                'outline' => array( 'title' => 'Outline' ),
                'fill' => array( 'title' => 'Fill' ),
                'small' => array( 'title' => 'Small' ),
            ),
        ),
        'align' => array(
            'type' => 'radio-buttons',
            'heading' => __( 'Align' ),
            'default' => '',
            'options' => array(
                '' => array( 'title' => 'Inline' ),
                'left'   => array( 'title' => 'Left',   'icon' => 'dashicons-editor-alignleft'),
                'center' => array( 'title' => 'Center', 'icon' => 'dashicons-editor-aligncenter'),
                'right'  => array( 'title' => 'Right',  'icon' => 'dashicons-editor-alignright'),
            ),
        ),
        'scale' => array(
            'type' => 'slider',
            'heading' => 'Scale',
            'default' => '100',
            'unit' => '%',
            'max' => '300',
            'min' => '50',
        ),

    ),
) );