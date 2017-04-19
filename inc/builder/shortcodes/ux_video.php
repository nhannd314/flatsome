<?php

add_ux_builder_shortcode( 'ux_video', array(
    'name' => __( 'Video','ux-builder'),
    'category' => __( 'Content' ),
//    'toolbar_thumbnail' => 'id',
    'thumbnail' =>  flatsome_ux_builder_thumbnail( 'ux_video' ),
    'allow_in' => array('text_box'),
    'wrap' => true,
    'overlay' => true,
    'options' => array(

        'url' => array(
            'type' => 'textfield',
            'full_width' => true,
            'default' => 'https://www.youtube.com/watch?v=AoPiLg8DZ3A',
            'heading' => 'Video url',
            'description' => 'Enter a Youtube or Vimeo video here. Example: https://www.youtube.com/watch?v=AoPiLg8DZ3A',
        ),

        'height' => array(
              'type' => 'scrubfield',
              'heading' => __('Height'),
              'default' => '56.25%',
              'placeholder' => __('Auto'),
              'min' => 0,
              'max' => 1000,
              'step' => 1,
              'helpers' => require( __DIR__ . '/helpers/image-heights.php' ),
               'on_change' => array(
                    'selector' => '.video',
                    'style' => 'padding-top: {{ value }}'
                )
        ),


        'depth' => array(
            'type' => 'slider',
            'heading' => 'Depth',
            'default' => '0',
            'max' => '5',
            'min' => '0',
            'on_change' => array(
                'selector' => '.video',
                'class' => 'box-shadow-{{ value }}'
            )
        ),

        'depth_hover' => array(
            'type' => 'slider',
            'heading' => 'Depth :Hover',
            'default' => '0',
            'max' => '5',
            'min' => '0',
            'on_change' => array(
                'selector' => '.video',
                'class' => 'box-shadow-{{ value }}-hover'
            )
        ),
    ),
) );
