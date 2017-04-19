<?php 

Flatsome_Option::add_section( 'global-styles', array(
	'title'       => __( 'Global Styles', 'flatsome-admin' ),
	'panel'       => 'style',
) );


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'button_radius',
	'label'       => __( 'Default Button Radius', 'flatsome-admin' ),
	'section'     => 'global-styles',
	'transport'   => $transport,
	'default'     => '',
));