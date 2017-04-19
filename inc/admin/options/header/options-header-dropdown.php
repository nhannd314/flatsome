<?php

/*************
 * Header Dropdown Style
 *************/

Flatsome_Option::add_section( 'header_dropdown', array(
	'title'       => __( 'Dropdown Style', 'flatsome-admin' ),
	'panel'       => 'header',
) );


Flatsome_Option::add_field( 'option',  array(
    'type'        => 'color-alpha',
    'settings'     => 'dropdown_bg',
    'transport' => 'postMessage',
    'label'       => __( 'Background color', 'flatsome-admin' ),
    'section'     => 'header_dropdown',
	'default'     => '',
));


Flatsome_Option::add_field( 'option',  array(
    'type'        => 'color-alpha',
    'settings'     => 'dropdown_border',
    'transport' => 'postMessage',
    'label'       => __( 'Border Color', 'flatsome-admin' ),
    'section'     => 'header_dropdown',
	'default'     => '',
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'dropdown_arrow',
	'label'       => __( 'Display dropdown arrow', 'flatsome-admin' ),
    'section'     => 'header_dropdown',
	'default'     => 1,
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'slider',
	'settings'     => 'dropdown_nav_size',
	'label'       => __( 'Dropdown Content Size (%)', 'flatsome-admin' ),
	'section'     => 'header_dropdown',
	'default'     => 100,
	'choices'     => array(
		'min'  => 50,
		'max'  => 200,
		'step' => 1
	),
	'transport' => 'postMessage',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-buttonset',
	'settings'     => 'dropdown_radius',
    'label'       => __( 'Dropdown radius', 'flatsome-admin' ),
    'section'     => 'header_dropdown',
    'transport' => 'postMessage',
	'default'     => '0',
	'choices'     => array(
		'0' => __( '0px', 'flatsome-admin' ),
		'3px' => __( '3px', 'flatsome-admin' ),
		'5px' => __( '5px', 'flatsome-admin' ),
		'10px' => __( '10px', 'flatsome-admin' ),
		'15px' => __( '15px', 'flatsome-admin' ),
	),
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-buttonset',
	'settings'     => 'dropdown_text',
    'label'       => __( 'Text Color', 'flatsome-admin' ),
    'section'     => 'header_dropdown',
    'transport' => 'postMessage',
	'default'     => 'light',
	'choices'     => array(
		'light' => __( 'Dark', 'flatsome-admin' ),
		'dark' => __( 'Light', 'flatsome-admin' ),
	),
));

Flatsome_Option::add_field( 'option', array(
	'type'        => 'radio-image',
	'settings'     => 'dropdown_style',
	'transport' => 'postMessage',
	'label'       => __( 'Link Style', 'flatsome-admin' ),
	'section'     => 'header_dropdown',
	'default'     => 'default',
	'choices'     => array(
		'simple' => $image_url . 'dropdown-style-1.svg',
		'default' => $image_url . 'dropdown-style-2.svg',
		'bold' => $image_url . 'dropdown-style-3.svg'
	),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-buttonset',
	'settings'     => 'dropdown_text_style',
	'transport' => 'postMessage',
    'label'       => __( 'Text Style', 'flatsome-admin' ),
    'section'     => 'header_dropdown',
	'default'     => 'simple',
	'choices'     => array(
		'simple' => __( 'Simple', 'flatsome-admin' ),
		'uppercase' => __( 'UPPERCASE', 'flatsome-admin' ),
	),
));
