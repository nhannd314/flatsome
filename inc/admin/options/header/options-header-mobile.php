<?php

/*************
 * Header Mobile
 *************/

Flatsome_Option::add_section( 'header_mobile', array(
	'title'       => __( 'Header Sidebar / Mobile', 'flatsome-admin' ),
	'panel'       => 'header',
	//'description' => __( 'This is the section description', 'flatsome-admin' ),
) );


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'slider',
	'settings'     => 'header_height_mobile',
	'label'       => __( 'Mobile Header Height', 'flatsome-admin' ),
	//'description' => __( 'This is the control description', 'flatsome-admin' ),
	//'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'flatsome-admin' ),
	'section'     => 'header_mobile',
	'default'     => '70',
	'choices'     => array(
		'min'  => 30,
		'max'  => 500,
		'step' => 1
	),
	'transport' => 'postMessage'
));

Flatsome_Option::add_field( 'option', array(
	'type'        => 'radio-image',
	'settings'     => 'logo_position_mobile',
	'label'       => __( 'Logo position', 'flatsome-admin' ),
	'section'     => 'header_mobile',
	'transport' => $transport,
	'default'     => 'center',
	'choices'     => array(
		'left' => $image_url . 'logo-left.svg',
		'center' => $image_url . 'logo-right.svg',
	),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-image',
	'settings'     => 'menu_icon_style',
	'label'       => __( 'Menu Icon Style', 'flatsome-admin' ),
	'section'     => 'header_mobile',
	'default'     => '',
	'transport' => $transport,
	'choices'     => array(
		'' => $image_url . 'nav-icon-plain.svg',
		'outline' => $image_url . 'nav-icon-outline.svg',
		'fill' => $image_url . 'nav-icon-fill.svg',
		'fill-round' => $image_url . 'nav-icon-fill-round.svg',
		'outline-round' => $image_url . 'nav-icon-outline-round.svg',
	),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'menu_icon_title',
	'label'       => __( 'Show menu title', 'flatsome-admin' ),
	'section'     => 'header_mobile',
	'transport' => $transport,
	'default'     => 0,
));

Flatsome_Option::add_field( 'option', array(
	'type'        => 'radio-image',
	'settings'     => 'mobile_overlay',
	'label'       => __( 'Mobile Overlay', 'flatsome-admin' ),
	'section'     => 'header_mobile',
	'transport'	  => $transport,
	'default'     => 'left',
	'choices'     => array(
		'left' => $image_url . 'overlay-left.svg',
		'right' => $image_url . 'overlay-right.svg',
		'center' => $image_url . 'overlay-center.svg'
	),
));

Flatsome_Option::add_field( 'option', array(
	'type'        => 'radio-image',
	'settings'     => 'mobile_overlay_color',
	'label'       => __( 'Overlay Color', 'flatsome-admin' ),
	'section'     => 'header_mobile',
	'transport'	  => $transport,
	'default'     => '',
	'choices'     => array(
		'' => $image_url . 'text-dark.svg',
		'dark' => $image_url . 'text-light.svg',
	),
));


Flatsome_Option::add_field( 'option',  array(
    'type'        => 'color-alpha',
    'settings'     => 'mobile_overlay_bg',
    'label'       => __( 'Background Color', 'flatsome-admin' ),
	'section'     => 'header_mobile',
	'default'     => '',
	'transport' => 'postMessage'
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'select',
	'settings'     => 'mobile_sidebar',
	'label'       => __( 'Elements', 'flatsome-admin' ),
	'section'     => 'header_mobile',
	'transport'	  => $transport,
	'multiple' => 10,
	'default'     => flatsome_header_mobile_sidebar(),
	'choices'     => $nav_elements
));