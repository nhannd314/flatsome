<?php
/*****
 * Contact
 *************/
Flatsome_Option::add_section( 'header_contact', array(
	'title'       =>  __( 'Contact', 'flatsome-admin' ),
	'panel'       => 'header',
) );

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-buttonset',
	'settings'     => 'contact_style',
	'label'       => __( 'Icon Style', 'flatsome-admin' ),
	'section'     => 'header_contact',
	'transport' => $transport,
	'default'     => 'left',
	'choices'     => array(
		'left' => __( 'Icons Left', 'flatsome-admin' ),
		'icons' => __( 'Icons Only', 'flatsome-admin' ),
	),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'contact_icon_size',
	'label'       => __( 'Icon Size', 'flatsome-admin' ),
	'section'     => 'header_contact',
	'transport' => $transport,
	'default'     => '16px',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'contact_phone',
	'label'       => __( 'Phone', 'flatsome-admin' ),
	'section'     => 'header_contact',
	'transport' => $transport,
	'default'     => '+47 900 99 000',
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'contact_email',
	'label'       => __( 'E-mail', 'flatsome-admin' ),
	'section'     => 'header_contact',
	'transport' => $transport,
	'default'     => 'youremail@gmail.com',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'contact_email_label',
	'label'       => __( 'E-mail label', 'flatsome-admin' ),
	'section'     => 'header_contact',
	'transport' => $transport,
	'default'     => '',
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'contact_location',
	'label'       => __( 'Location', 'flatsome-admin' ),
	'help'        => __( 'Type in the location of your place or shop. It will open in a new window on Google Maps', 'flatsome-admin' ),
	'section'     => 'header_contact',
	'transport' => $transport,
	'default'     => '',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'contact_location_label',
	'label'       => __( 'Location label', 'flatsome-admin' ),
	'section'     => 'header_contact',
	'transport' => $transport,
	'default'     => '',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'contact_hours',
	'label'       => __( 'Open Hours', 'flatsome-admin' ),
	'section'     => 'header_contact',
	'transport' => $transport,
	'default'     => '08:00 - 17:00',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textarea',
	'settings'     => 'contact_hours_details',
	'label'       => __( 'Open Hours - Details', 'flatsome-admin' ),
	'section'     => 'header_contact',
	'transport' => $transport,
	'default'     => '',
));

function flatsome_refresh_header_contact_partials( WP_Customize_Manager $wp_customize ) {

	if ( ! isset( $wp_customize->selective_refresh ) ) {
	      return;
	 }

	$wp_customize->selective_refresh->add_partial( 'header-contact', array(
	    'selector' => '.header-contact-wrapper',
	    'container_inclusive' => true,
	    'settings' => array('contact_location_label','contact_email_label','contact_icon_size','contact_style','contact_location','contact_phone','contact_email','contact_hours_details','contact_hours','contact_hours'),
	    'render_callback' => function() {
	         return get_template_part('template-parts/header/partials/element','contact');
	    },
	) );
	
}
add_action( 'customize_register', 'flatsome_refresh_header_contact_partials' );
