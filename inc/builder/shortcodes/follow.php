<?php

add_ux_builder_shortcode( 'follow', array(
    'name' => __( 'Follow Icons' ),
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
            'default' => 'outline',
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
        'facebook' => array( 'type' => 'textfield','heading' => 'Facebook', 'default' => ''),
        'instagram' => array( 'type' => 'textfield','heading' => 'Instagram', 'default' => ''),
        'snapchat' => array( 'type' => 'image', 'heading' => __( 'SnapChat' )),
        'twitter' => array( 'type' => 'textfield','heading' => 'Twitter', 'default' => ''),
        'linkedin' => array( 'type' => 'textfield','heading' => 'Linkedin', 'default' => ''),
        'email' => array( 'type' => 'textfield','heading' => 'Email', 'default' => ''),
        'pinterest' => array( 'type' => 'textfield','heading' => 'Pinterest', 'default' => ''),
        'googleplus' => array( 'type' => 'textfield','heading' => 'Google Plus', 'default' => ''),
        'rss' => array( 'type' => 'textfield','heading' => 'RSS', 'default' => ''),
        'youtube' => array( 'type' => 'textfield','heading' => 'Youtube', 'default' => ''),
        'flickr' => array( 'type' => 'textfield','heading' => 'Flickr', 'default' => ''),
        'vkontakte' => array( 'type' => 'textfield','heading' => 'VKontakte', 'default' => ''),
        'px500' => array( 'type' => 'textfield','heading' => '500px', 'default' => ''),
    ),
) );