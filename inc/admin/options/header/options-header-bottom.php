<?php

/*************
 * Header Main
 *************/

Flatsome_Option::add_section( 'bottom_bar', array(
	'title'       => __( 'Header Bottom', 'flatsome-admin' ),
	'panel'       => 'header',
	//'description' => __( 'This is the section description', 'flatsome-admin' ),
) );


Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_header_bottom_layout',
    'label'       => __( '', 'flatsome-admin' ),
	'section'     => 'bottom_bar',
    'default'     => '<div class="options-title-divider">Layout</div>',
) );


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'slider',
	'settings'     => 'header_bottom_height',
	'label'       => __( 'Height', 'flatsome-admin' ),
	'section'     => 'bottom_bar',
	'default' => '',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1
	),
	'transport' => 'postMessage',
));


Flatsome_Option::add_field( 'option',  array(
    'type'        => 'color-alpha',
    'settings'     => 'nav_position_bg',
    'label'       => __( 'Background color', 'flatsome-admin' ),
    'section'     => 'bottom_bar',
	'default'     => "#f1f1f1",
	'transport' => 'postMessage',
));



Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_header_bottom_nav',
    'label'       => __( '', 'flatsome-admin' ),
	'section'     => 'bottom_bar',
    'default'     => '<div class="options-title-divider">Navigation</div>',
) );

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-image',
	'settings'     => 'nav_style_bottom',
	'label'       => __( 'Nav Style', 'flatsome-admin' ),
	'section'     => 'bottom_bar',
	'default'     => '',
	'transport' => $transport,
	'choices'     => $nav_styles_img
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'slider',
	'settings'     => 'nav_height_bottom',
	'label'       => __( 'Nav Height', 'flatsome-admin' ),
	'section'     => 'bottom_bar',
	'default' => 16,
	'choices'     => array(
		'min'  => 0,
		'max'  => 100,
		'step' => 1
	),
	'transport' => 'postMessage',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-buttonset',
	'settings'     => 'nav_size_bottom',
	'label'       => __( 'Nav Size', 'flatsome-admin' ),
	'section'     => 'bottom_bar',
	'transport' => $transport,
	'default'     => '',
	'choices'     => $nav_sizes
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-buttonset',
	'settings'     => 'nav_spacing_bottom',
	'label'       => __( 'Nav Spacing', 'flatsome-admin' ),
	'section'     => 'bottom_bar',
	'transport' => $transport,
	'default'     => '',
	'choices'     => $nav_sizes
));

Flatsome_Option::add_field( 'option',  array(
		'type'        => 'checkbox',
		'settings'     => 'nav_uppercase_bottom',
		'label'       => __( 'Uppercase', 'flatsome-admin' ),
		'section'     => 'bottom_bar',
	    'transport' => $transport,
		'default'     => 1,
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-image',
	'settings'     => 'nav_position_color',
	'label'       => __( 'Nav Base Color', 'flatsome-admin' ),
	'section'     => 'bottom_bar',
	'default'     => 'light',
	'transport' => 'postMessage',
	'choices'     => array(
		'dark' => $image_url . 'text-light.svg',
		'light' => $image_url . 'text-dark.svg'
	),
));

Flatsome_Option::add_field( 'option',  array(
    'type'        => 'color',
    'settings'     => 'type_nav_bottom_color',
    'label'       => __( 'Nav Color', 'flatsome-admin' ),
	'section'     => 'bottom_bar',
    'transport' => $transport
));

Flatsome_Option::add_field( 'option',  array(
    'type'        => 'color',
    'settings'     => 'type_nav_bottom_color_hover',
    'label'       => __( 'Nav Color:hover', 'flatsome-admin' ),
	'section'     => 'bottom_bar',
    'transport' => $transport
));


