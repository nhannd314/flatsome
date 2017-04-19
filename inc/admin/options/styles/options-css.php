<?php 


Flatsome_Option::add_section( 'custom-css', array(
	'title'       => __( 'Custom CSS', 'flatsome-admin' ),
	'panel'       => 'style',
) );

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'code',
	'settings'     => 'html_custom_css',
	'label'       => __( 'Custom CSS', 'flatsome-admin' ),
	'section'     => 'custom-css',
	'transport'   => $transport,
	'default'     => '',
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => 250,
	),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'code',
	'settings'     => 'html_custom_css_tablet',
	'label'       => __( 'Custom Tablet CSS', 'flatsome-admin' ),
	'section'     => 'custom-css',
	'default'     => '',
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => 250,
	),
	'transport'   => $transport,
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'code',
	'settings'     => 'html_custom_css_mobile',
	'label'       => __( 'Custom Mobile CSS', 'flatsome-admin' ),
	'section'     => 'custom-css',
	'default'     => '',
	'choices'     => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => 250,
	),
	'transport'   => $transport,
));
