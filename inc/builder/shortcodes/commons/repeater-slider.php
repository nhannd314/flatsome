<?php
return array(
'type' => 'group',
'heading' => __( 'Slider' ),
'conditions' => 'type === "slider" || type === "slider-full"',
'options' => array(
'slider_nav_style' => array(
    'type' => 'select',
    'heading' => "Nav Style",
    'default' => 'reveal',
    'options' => require( __DIR__ . '/../values/slider-nav-styles.php' )
),
'slider_nav_color' => array(
    'type' => 'select',
    'heading' => "Nav Color",
    'default' => '',
    'options' => array(
        'light' => 'Light',
        '' => 'Dark',
    )
),
'slider_nav_position' => array(
    'type' => 'select',
    'heading' => "Nav Position",
    'default' => 'inside',
    'options' => array(
        'inside' => 'Inside',
        'outside' => 'Outside',
    )
),
'slider_bullets' => array(
    'type' => 'select',
    'heading' => "Bullets",
    'default' => '',
    'options' => array(
        '' => 'Disable',
        'true' => 'Enable',
    )
),
'auto_slide' => array(
    'type' => 'select',
    'heading' => 'Auto Slide',
    'default' => '',
    'options' => array(
        '' => 'Disabled',
        '2000' => '2 sec.',
        '3000' => '3 sec.',
        '4000' => '4 sec.',
        '5000' => '5 sec.',
        '6000' => '6 sec.',
        '7000' => '7 sec.',
    )
),
)
);
