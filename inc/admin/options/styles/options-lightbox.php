<?php 


Flatsome_Option::add_section( 'lightbox', array(
	'title'       => __( 'Image Lightbox', 'flatsome-admin' ),
	'panel'       => 'style',
) );

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'flatsome_lightbox',
	'label'       => __( 'Enable Flatsome Lightbox', 'flatsome-admin' ),
    'section'     => 'lightbox',
	'transport' => 'postMessage',
	'default'     => 1,
));

Flatsome_Option::add_field( 'option',  array(
    'type'        => 'color',
    'settings'     => 'flatsome_lightbox_bg',
    'label'       => __( 'Lightbox background color', 'flatsome-admin' ),
    'section'     => 'lightbox',
    'transport' => $transport,
    'default'    => '',
));