<?php

add_ux_builder_shortcode( 'button', array(
    'name' => __( 'Button' ),
    'category' => __( 'Content' ),
    'template' => flatsome_ux_builder_template( 'button.html' ),
    'thumbnail' =>  flatsome_ux_builder_thumbnail( 'button' ),
    'info' => '{{ text }}',
    'inline' => true,
    'wrap'   => false,
    'priority' => 1,

    'presets' => array(
        array(
            'name' => __( 'Simple' ),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'button-simple' ),
            'content' => '[button text="Click me!"]'
        ),
        array(
            'name' => __( 'Round' ),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'button-round' ),
            'content' => '[button text="Click me!" radius="10"]'
        ),
        array(
            'name' => __( 'Circle' ),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'button-circle' ),
            'content' => '[button text="Click me!" radius="99"]'
        ),
        array(
            'name' => __( 'Outline' ),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'button-outline' ),
            'content' => '[button text="Click me!" style="outline"]'
        ),
        array(
            'name' => __( 'Outline Round' ),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'button-outline-round' ),
            'content' => '[button text="Click me!" style="outline" radius="10"]'
        ),
        array(
            'name' => __( 'Outline Circle' ),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'button-outline-circle' ),
            'content' => '[button text="Click me!" style="outline" radius="99"]'
        ),
        array(
            'name' => __( 'Simple Link' ),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'button-link' ),
            'content' => '[button text="Click me!"  style="link"]'
        ),
        array(
            'name' => __( 'Underline' ),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'button-underline' ),
            'content' => '[button text="Click me!"  style="underline"]'
        ),
        array(
            'name' => __( 'CTA - Small' ),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'button-call-to-action' ),
            'content' => '[button text="Click me!" style="shade" depth="3" depth_hover="5" radius="5"]'
        ),
        array(
            'name' => __( 'CTA - Large' ),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'button-call-to-action-large' ),
            'content' => '[button text="Click me!" style="shade" size="larger" depth="4" depth_hover="5" radius="10"]'
        ),
    ),

    'options' => array(

        'text' => array(
            'type' => 'textfield',
            'holder' => 'button',
            'heading' => 'Text',
            'param_name' => 'text',
            'focus' => 'true',
            'value' => 'Button',
            'default' => '',
            'auto_focus' => true,
        ),

        'letter_case' => array(
            'type' => 'radio-buttons',
            'heading' => 'Letter Case',
            'default' => '',
            'options' => array(
                '' => array( 'title' => 'ABC'),
                'lowercase' => array( 'title' => 'Abc' ),
            ),
        ),

      'layout_options' => array(
        'type' => 'group',
        'heading' => 'Layout',
        'options' => array(
          'color' => array(
            'type' => 'select',
            'heading' => 'Color',
            'default' => 'primary',
            'options' => array(
                'primary' => 'Primary',
                'secondary' => 'Secondary',
                'alert' => 'Alert',
                'success' => 'Success',
                'white' => 'White',
            )
        ),
        'style' => array(
            'type' => 'select',
            'heading' => 'Style',
            'default' => '',
            'options' => array(
                '' => 'Default',
                'outline' => 'Outline',
                'link' => 'Simple',
                'underline' => 'Underline',
                'shade' => 'Shade',
                'bevel' => 'Bevel',
                'gloss' => 'Gloss',
            )
        ),
        'size' => array(
            'type' => 'select',
            'heading' => 'Size',
            'options' => require( __DIR__ . '/values/sizes.php' ),
        ),
        'animate' => array(
            'type' => 'select',
            'heading' => 'Animate',
            'default' => 'none',
            'options' => require( __DIR__ . '/values/animate.php' ),
        ),

        'radius' => array(
            'type' => 'slider',
            'class' => '',
            'heading' => 'Radius',
            'default' => '0',
            'max' => '99',
            'min' => '0',
        ),

        'depth' => array(
            'type' => 'slider',
            'class' => '',
            'heading' => 'Depth',
            'default' => '0',
            'max' => '5',
            'min' => '0',
        ),

        'depth_hover' => array(
            'type' => 'slider',
            'class' => '',
            'heading' => 'Depth :hover',
            'param_name' => 'depth_hover',
            'default' => '0',
            'max' => '5',
            'min' => '0',
        ),
        'expand' => array(
            'type' => 'checkbox',
            'heading' => 'Expand',
        ),
       ),
      ),
      'icon_options' => array(
            'type' => 'group',
            'heading' => 'Icon',
            'options' => array(
                'icon' => array(
                    'type' => 'select',
                    'heading' => 'Icon',
                    'options' => require( __DIR__ . '/values/icons.php' ),
                ),
                'icon_pos' => array(
                    'conditions' => 'icon',
                    'type' => 'select',
                    'heading' => 'Position',
                    'options' => array(
                        '' => 'Right',
                        'left' => 'Left',
                    )
                ),
                'icon_reveal' => array(
                    'conditions' => 'icon',
                    'type' => 'select',
                    'heading' => 'Visibility',
                    'options' => array(
                        '' => 'Always visible',
                        'true' => 'Visible on hover',
                    )
                ),
            ),
        ),
        'link_options' => require( __DIR__ . '/commons/links.php' )
    ),
) );
