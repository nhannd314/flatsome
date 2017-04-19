<?php

/*************
 * Layout Panel
 *************/

Flatsome_Option::add_section( 'layout', array(
	'title'       => __( 'Layout', 'flatsome-admin' ),
	//'description' => __( 'Change the Layout', 'flatsome-admin' ),
) );

Flatsome_Option::add_field( 'option', array(
	'type'        => 'radio-buttonset',
	'settings'     => 'body_layout',
	'label'       => __( 'Layout Mode', 'flatsome-admin' ),
	'description' => __( 'Select Full width, boxed or framed layout', 'flatsome-admin' ),
	'section'     => 'layout',
	'default'     => 'full-width',
	'transport' => 'postMessage',
	'choices'     => array(
		'full-width' => __( 'Full Width', 'flatsome-admin' ),
		'boxed' => __( 'Boxed', 'flatsome-admin' ),
		'framed' => __( 'Framed', 'flatsome-admin' ),
	),
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'box_shadow',
	'label'       => __( 'Add Drop Shadow to Content box', 'flatsome-admin' ),
	'section'     => 'layout',
	'transport' => 'postMessage',
	'default'     => 0,
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'site_width',
	'label'       => __( 'Site Content Width (px)', 'flatsome-admin' ),
  'description' => __( 'Set the default width of content containers. (Header, Rows etc.)', 'flatsome-admin' ),
	'section'     => 'layout',
	'transport' => 'postMessage',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'site_width_boxed',
	'label'       => __( 'Site Boxed/Framed Width (px)', 'flatsome-admin' ),
	'section'     => 'layout',
	'transport' => 'postMessage',
));

Flatsome_Option::add_field( 'option',  array(
    'type'        => 'color',
    'settings'     => 'body_bg',
    'label'       => __( 'Background Color', 'flatsome-admin' ),
    'section'     => 'layout',
	'default'     => "",
	'transport' => 'postMessage',
));


Flatsome_Option::add_field( 'option',  array(
    'type'        => 'image',
    'settings'     => 'body_bg_image',
    'label'       => __( 'Background Image', 'flatsome-admin' ),
    'section'     => 'layout',
	'default'     => "",
	'transport' => 'postMessage',
));


Flatsome_Option::add_field( 'option', array(
	'type'        => 'radio-buttonset',
	'settings'     => 'body_bg_type',
	'label'       => __( 'Background Repeat', 'flatsome-admin' ),
	'section'     => 'layout',
	'default'     => 'bg-full-size',
	'transport' => 'postMessage',
	'choices'     => array(
		'bg-full-size' => __( 'Full Size', 'flatsome-admin' ),
		'bg-tiled' => __( 'Tiled', 'flatsome-admin' ),
	),
));


Flatsome_Option::add_field( 'option', array(
	'type'        => 'radio-image',
	'settings'     => 'content_color',
	'label'       => __( 'Content Color', 'flatsome-admin' ),
	'description' => __( 'Light or Dark content text color', 'flatsome-admin' ),
	'section'     => 'layout',
	'default'     => 'light',
	'transport' => 'postMessage',
	'choices'     => array(
		'light' => $image_url . 'text-dark.svg',
		'dark' => $image_url . 'text-light.svg'
	),
));


Flatsome_Option::add_field( 'option',  array(
    'type'        => 'color',
    'settings'     => 'content_bg',
    'label'       => __( 'Content Background', 'flatsome-admin' ),
    'section'     => 'layout',
	'default'     => "",
	'transport' => 'postMessage',
));
