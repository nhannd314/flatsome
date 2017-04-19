<?php

// Shortcode to hotspot

add_ux_builder_shortcode( 'ux_hotspot', array(
    'name' => 'Badge',
    'category' => __( 'Elements' ),

   'presets' => array(
        array(
            'name' => __( 'Normal' ),
            'content' => '[ux_badge text_top="Enter text" text_main="Sale" text_bottom="text_bottom"]'
        ),
    ),

    'options' => array(

    )
) );