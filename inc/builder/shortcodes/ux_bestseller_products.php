<?php

add_ux_builder_shortcode( 'ux_bestseller_products', array(
    'name' => __( 'Bestseller products' ),
    'image' => '',
    'category' => __( 'Shop' ),

    'presets' => array(
        array(
            'name' => __( 'Normal' ),
            'content' => '[ux_bestseller_products products="8" columns="4" title="Check our bestsellers!"]'
        ),
    ),

    'options' => array(
        array(
            'type' => 'textfield',
            'class' => '',
            'full_width' => true,
            'heading' => 'Title',
            'param_name' => 'title',
            'default' => '',
            'value' => ''
        ),
        array(
            'type' => 'textfield',
            'class' => '',
            'heading' => 'Columns',
            'param_name' => 'columns',
            'default' => '',
            'value' => ''
        ),
        array(
            'type' => 'textfield',
            'class' => '',
            'heading' => 'Posts',
            'param_name' => 'products',
            'default' => '',
            'value' => ''
        ),
    ),
) );


add_ux_builder_shortcode( 'ux_featured_products', array(
    'name' => __( 'Featured Products' ),
    'image' => '',
    'category' => __( 'Shop' ),
    'ajax' => true,

    'presets' => array(
        array(
            'name' => __( 'Normal' ),
            'content' => '[ux_featured_products products="8" columns="4"]'
        ),
        array(
            'name' => __( '3 col' ),
            'content' => '[ux_featured_products products="8" columns="3"]'
        ),
    ),

    'options' => array(
        array(
            'type' => 'textfield',
            'class' => '',
            'full_width' => true,
            'heading' => 'Title',
            'param_name' => 'title',
            'default' => '',
            'value' => ''
        ),
        array(
            'type' => 'textfield',
            'class' => '',
            'heading' => 'Columns',
            'param_name' => 'columns',
            'default' => '',
            'value' => ''
        ),
        array(
            'type' => 'textfield',
            'class' => '',
            'heading' => 'Posts',
            'param_name' => 'products',
            'default' => '',
            'value' => ''
        ),
    ),
) );
