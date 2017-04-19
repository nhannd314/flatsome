<?php

add_ux_builder_shortcode( 'accordion-item', array(
    'type' => 'container',
    'name' => __( 'Accordion Panel' ),
    'template' => flatsome_ux_builder_template( 'accordion_item.html' ),
    'info' => '{{ title }}',
    'require' => array( 'accordion' ),
    'wrap' => false,
    'hidden' => true,
    'options' => array(
        'title' => array(
            'type' => 'textfield',
            'heading' => __( 'Title' ),
            'default' => __( 'Accordion Panel Title' ),
            'auto_focus' => true,
        ),
    ),
) );
