<?php

/*************
 * - Account
 *************/

Flatsome_Option::add_section( 'header_account', array(
	'title'       => __( 'Account', 'flatsome-admin' ),
	'panel'       => 'header',
	//'description' => __( 'This is the section description', 'flatsome-admin' ),
) );


Flatsome_Option::add_field( 'option', array(
	'type'        => 'radio-image',
	'settings'     => 'account_icon_style',
	'label'       => __( 'Icon Style', 'flatsome-admin' ),
	'section'     => 'header_account',
	'transport' => $transport,
	'default'     => '',
	'choices'     => array(
		'' => $image_url . 'disabled.svg',
		'image' => $image_url . 'account-icon-image.svg',
		'plain' => $image_url . 'account-icon-plain.svg',
		'fill' => $image_url . 'account-icon-fill.svg',
		'fill-round' => $image_url . 'account-icon-fill-round.svg',
		'outline' => $image_url . 'account-icon-outline.svg',
		'outline-round' => $image_url . 'account-icon-outline-round.svg',
	),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'header_account_title',
	'label'       => __( 'Show label', 'flatsome-admin' ),
	'section'     => 'header_account',
	'transport' => $transport,
	'default'     => 1,
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'header_account_register',
	'label'       => __( 'Show "Register" label', 'flatsome-admin' ),
	'section'     => 'header_account',
	'transport' => $transport,
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'select',
	'settings'     => 'account_login_style',
	'label'       => __( 'Login Style', 'flatsome-admin' ),
	'section'     => 'header_account',
	'transport' => $transport,
	'default'     => 'lightbox',
	'choices'     => array(
		'link' => __( 'Link', 'flatsome-admin' ),
		'lightbox' => __( 'Lightbox', 'flatsome-admin' ),
	),
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'wc_account_links',
	'label'       => __( 'Enable default WooCommerce Account links in Dropdown and Account Sidebar. You can create a custom my account menu instead if you want.', 'flatsome-admin' ),
	'section'     => 'header_account',
	'default'     => 1,
));



function flatsome_refresh_header_account_partials( WP_Customize_Manager $wp_customize ) {

	if ( ! isset( $wp_customize->selective_refresh ) ) {
	      return;
	 }
	
	// Account
	$wp_customize->selective_refresh->add_partial( 'header-account', array(
	    'selector' => '.header-nav .account-item',
	    'container_inclusive' => true,
	    'settings' => array('header_account_register','account_login_style','account_icon_style','header_account_title'),
	    'render_callback' => function() {
	        return get_template_part('template-parts/header/partials/element','account');
	    },
	) );
}
add_action( 'customize_register', 'flatsome_refresh_header_account_partials' );