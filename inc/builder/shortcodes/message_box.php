<?php

add_ux_builder_shortcode( 'message_box', array(
    'name' => __( 'Message Box' ),
    'type' => 'container',
    'category' => __( 'Content' ),
    'thumbnail' =>  flatsome_ux_builder_thumbnail( 'message_box' ),
    'template' => flatsome_ux_builder_template( 'message_box.html' ),
     'presets' => array(
        array(
            'name' => __( 'Default' ),
            'content' => '[message_box] [row_inner v_align="middle" h_align="center"] [col_inner span="9" span__sm="12"] <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> [/col_inner] [col_inner span="2" span__sm="12" align="center"] [button text="Click me" color="white" style="outline" radius="99"] [/col_inner] [/row_inner] [/message_box]',
        ),
    ),
    'options' => array(
        'bg' => array(
          'type' => 'image',
          'heading' => __( 'BG Image' ),
          'thumb_size' => 'bg_size',
        ),
        'bg_color' => array(
          'type' => 'colorpicker',
          'heading' => __('Bg Color'),
          'alpha' => true,
          'format' => 'rgb',
          'position' => 'bottom right',
        ),
        'text_color' => array(
            'type' => 'radio-buttons',
            'heading' => __( 'Color' ),
            'default' => 'dark',
            'options' => array(
                'light' => array( 'title' => 'Dark' ),
                'dark' => array( 'title' => 'Light' ),
            ),
        ),
        'padding' => array(
          'type' => 'slider',
          'heading' => __('Padding'),
          'max' => 200,
          'min' => 0,
          'default' => 15
        ),
    ),
) );
