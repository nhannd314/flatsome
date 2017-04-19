<?php

/*************
 * LOGO
 *************/

function flatsome_logo_name_customizer( $wp_customize ) {
	global $transport;
  $wp_customize->get_setting('blogname')->transport=$transport;
  $wp_customize->get_setting('blogdescription')->transport=$transport;
}
add_action( 'customize_register', 'flatsome_logo_name_customizer' );

Flatsome_Option::add_section( 'title_tagline', array(
	'title'       => __( 'Logo & Site Identity', 'flatsome-admin' ),
	'panel'       => 'header',
	//'description' => __( 'This is the section description', 'flatsome-admin' ),
) );

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'site_logo_slogan',
	'label'       => __( 'Display below Logo', 'flatsome-admin' ),
	'section'     => 'title_tagline',
	'transport' => $transport,
	'default'     => 0,
));

Flatsome_Option::add_field( 'option', array(
	'type'        => 'radio-image',
	'settings'     => 'logo_position',
	'label'       => __( 'Logo position', 'flatsome-admin' ),
	'section'     => 'title_tagline',
	'transport' => 'postMessage',
	'default'     => 'left',
	'choices'     => array(
		'left' => $image_url . 'logo-left.svg',
		'center' => $image_url . 'logo-right.svg',
		//'vertical' => $image_url . 'logo-vertical.png'
	),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'image',
	'settings'     => 'site_logo',
	'label'       => __( 'Logo image', 'flatsome-admin' ),
	'section'     => 'title_tagline',
	'transport' => $transport,
	'default'     => get_template_directory_uri().'/assets/img/logo.png'
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'image',
	'settings'     => 'site_logo_dark',
	'label'       => __( 'Logo image - Light Version', 'flatsome-admin' ),
	'description' => __( 'Upload an alternative light logo that will be used on Dark and Transparent Header templates', 'flatsome-admin' ),
	'section'     => 'title_tagline',
	'transport' => $transport,
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'slider',
	'settings'     => 'logo_width',
	'label'       => __( 'Logo container width', 'flatsome-admin' ),
	//'description' => __( 'This is the control description', 'flatsome-admin' ),
	//'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'flatsome-admin' ),
	'section'     => 'title_tagline',
	'default'     => 200,
	'choices'     => array(
		'min'  => 30,
		'max'  => 700,
		'step' => 1
	),
	'transport' => 'postMessage',
));

Flatsome_Option::add_field( 'option',  array(
  'type'        => 'text',
  'settings'     => 'logo_max_width',
  'label'       => __( 'Logo max width (px)', 'flatsome-admin' ),
  'section'     => 'title_tagline',
  'description' => __( 'Set the logo max with in pixels. Leave it blank to make it auto fit inside logo container.', 'flatsome-admin' ),
  'transport' => 'postMessage',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'slider',
	'settings'     => 'logo_padding',
	'label'       => __( 'Logo Padding', 'flatsome-admin' ),
	'section'     => 'title_tagline',
	'default'     => 0,
	'choices'     => array(
		'min'  => 0,
		'max'  => 30,
		'step' => 1
	),
	'transport' => 'postMessage',
));
