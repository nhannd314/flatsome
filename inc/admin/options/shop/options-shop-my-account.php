<?php

global $wc;

Flatsome_Option::add_section( 'fl-my-account', array(
	'title'       => __( 'My Account', 'flatsome-admin' ),
	'panel' => 'shop'
) );

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'image',
	'settings'     => 'facebook_login_bg',
	'label'       => __( 'Title background', 'flatsome-admin' ),
	'section'     => 'fl-my-account',
	'transport' => $transport,
	'default'     => ''
));



Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'facebook_login_text',
	'transport' => $transport,
	'label'       => __( 'Login Text', 'flatsome-admin' ),
	'description' => __( '', 'flatsome-admin' ),
	'section'     => 'fl-my-account',
	'sanitize_callback' => 'flatsome_custom_sanitize',
));