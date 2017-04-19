<?php

add_ux_builder_shortcode( 'tabgroup', array(
    'type' => 'container',
    'name' => __( 'Tabs' ),
    'image' => '',
    'category' => __( 'Content' ),
    'thumbnail' =>  flatsome_ux_builder_thumbnail( 'tabs' ),
    'template' => flatsome_ux_builder_template( 'tabgroup.html' ),
    'tools' => 'shortcodes/tabgroup/tabgroup.tools.html',
    'info' => '{{ title }}',
    'allow' => array( 'tab' ),

    'children' => array(
        'draggable' => false,
        'addable_spots' => array( 'center' ),
    ),

    'toolbar' => array(
        'show_children_selector' => true,
        'show_on_child_active' => true,
    ),

    'presets' => array(
        array(
            'name' => __( 'Default' ),
            'content' => '
                [tabgroup title="Tab Title"]
                    [tab title="Tab 1 Title"][/tab]
                    [tab title="Tab 2 Title"][/tab]
                    [tab title="Tab 3 Title"][/tab]
                [/tabgroup]
            '
        ),
    ),

    'options' => array(

        'title' => array(
            'type' => 'textfield',
            'heading' => __( 'Title' ),
            'default' => __( '' ),
        ),

        'style' => array(
            'type' => 'select',
            'heading' => __( 'Style' ),
            'default' => 'line',
            'options' => require( __DIR__ . '/values/nav-styles.php' ),
        ),

        'type' => array(
            'type' => 'select',
            'heading' => __( 'Type' ),
            'default' => 'horizontal',
            'options' => array(
                'horizontal' => 'Horizontal',
                'vertical' => 'Vertical',
            )
        ),

        'nav_style' => array(
          'type' => 'radio-buttons',
          'heading' => 'Nav Style',
          'default' => 'uppercase',
          'options' => require( __DIR__ . '/values/nav-types-radio.php' ),
        ),

        'nav_size' => array(
            'type' => 'radio-buttons',
            'heading' => __( 'Size' ),
            'default' => 'medium',
            'options' => require( __DIR__ . '/values/text-sizes.php' ),
        ),

        'align' => array(
            'type' => 'radio-buttons',
            'heading' => 'Tabs Align',
            'default' => 'left',
            'options' => require( __DIR__ . '/values/align-radios.php' ),
        )
    ),
) );
