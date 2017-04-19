<?php

add_ux_builder_shortcode( 'team_member', array(
    'name' => __( 'Team Member' ),
    'category' => __( 'Content' ),
    'type' => 'container',
    'thumbnail' =>  flatsome_ux_builder_thumbnail( 'team_member' ),

    'presets' => array(
        array(
            'name' => __( 'Default' ),
            'content' => '[team_member name="Ola Nordmann" title="Customer Support" image_height="100%" image_width="80" image_radius="100"] Lorem ipsum.. [/team_member]'
        ),
    ),

    'options' => array_merge_recursive( array(
        'layout_options' => array(
            'type' => 'group',
            'heading' => __( 'Layout' ),
            'options' => array(
                'img' => array(
                    'type' => 'image',
                    'heading' => 'Image',
                    'group' => 'background',
                    'param_name' => 'img',
                ),
                'style' => array(
                    'type' => 'select',
                    'heading' => __( 'Style' ),
                    'default' => 'normal',
                    'options' => require( __DIR__ . '/values/box-layouts.php' )
                ),

                'name' => array( 'type' => 'textfield','heading' => 'Name', 'default' => '', 'on_change' => array( 'selector' => '.person-name', 'content' => '{{ value }}')),
                'title' => array( 'type' => 'textfield','heading' => 'Title', 'default' => '',  'on_change' => array( 'selector' => '.person-title', 'content' => '{{ value }}')),
                'link' => array( 'type' => 'textfield','heading' => 'Link', 'default' => ''),
                'depth' => array(
                    'type' => 'slider',
                    'heading' => __( 'Depth' ),
                    'default' => '0',
                    'max' => '5',
                    'min' => '0',
                ),
                'depth_hover' => array(
                    'type' => 'slider',
                    'heading' => __( 'Depth :Hover' ),
                    'default' => '0',
                    'max' => '5',
                    'min' => '0',
                ),
            ),
        ),
        'social_icons' => array(
            'type' => 'group',
            'heading' => __( 'Social Icons' ),
            'options' => array(
               'icon_style' => array(
                    'type' => 'radio-buttons',
                    'heading' => __( 'Style' ),
                    'default' => 'outline',
                    'options' => array(
                        'outline' => array( 'title' => 'Outline' ),
                        'fill' => array( 'title' => 'Fill' ),
                        'small' => array( 'title' => 'Small' ),
                    ),
                ),
                'facebook' => array( 'type' => 'textfield','heading' => 'Facebook', 'default' => ''),
                'twitter' => array( 'type' => 'textfield','heading' => 'Twitter', 'default' => ''),
                'youtube' => array( 'type' => 'textfield','heading' => 'Youtube', 'default' => ''),
                'email' => array( 'type' => 'textfield','heading' => 'Email', 'default' => ''),
                'pinterest' => array( 'type' => 'textfield','heading' => 'Pinterest', 'default' => ''),
                'linkedin' => array( 'type' => 'textfield','heading' => 'Linkedin', 'default' => ''),
                'snapchat' => array( 'type' => 'image', 'heading' => __( 'SnapChat' )),
            ),
        ),
        'link_group' => require( __DIR__ . '/commons/links.php' ),
    ),
    require( __DIR__ . '/commons/box-styles.php' ) ),
) );

// ux_builder_parse_args
