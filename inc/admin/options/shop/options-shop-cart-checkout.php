<?php

Flatsome_Option::add_section( 'cart-checkout', array(
	'title'       => __( 'Cart and Checkout', 'flatsome-admin' ),
	'panel' => 'shop'
) );


Flatsome_Option::add_field( 'option', array(
  'type'        => 'radio-buttonset',
  'settings'     => 'checkout_layout',
  'label'       => __( 'Cart / Checkout layout', 'flatsome-admin' ),
  'section'     => 'cart-checkout',
  'default'     => '',
  'choices'     => array(
    '' => __( 'Default', 'flatsome-admin' ),
    'simple' => __( 'Simple (New)', 'flatsome-admin' ),
    'focused' => __( 'Focused', 'flatsome-admin' ),
  ),
));

Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_cart',
    'label'       => __( '', 'flatsome-admin' ),
	'section'     => 'cart-checkout',
    'default'     => '<div class="options-title-divider">Cart</div>',
) );


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textarea',
	'settings'     => 'html_cart_sidebar',
	'transport' => $transport,
	'label'       => __( 'Cart Sidebar content', 'flatsome-admin' ),
	'help'        => __( 'Enter HTML that will show on bottom of cart sidebar' ),
	'section'     => 'cart-checkout',
	'default'     => '',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textarea',
	'settings'     => 'html_cart_footer',
	'transport' => $transport,
	'label'       => __( 'After Cart content', 'flatsome-admin' ),
	'help'        => __( 'Enter HTML or Shortcodes that will show after cart here.' ),
	'section'     => 'cart-checkout',
	'default'     => '',
));

Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_checkout',
    'label'       => __( '', 'flatsome-admin' ),
	'section'     => 'cart-checkout',
    'default'     => '<div class="options-title-divider">Checkout</div>',
) );


$is_facebook_login = in_array( 'nextend-facebook-connect/nextend-facebook-connect.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );

if($is_facebook_login){
	Flatsome_Option::add_field( 'option',  array(
		'type'        => 'checkbox',
		'settings'     => 'facebook_login_checkout',
		'label'       => __( 'Social Login Buttons', 'flatsome-admin' ),
		'section'     => 'cart-checkout',
		'default' => 0
	));
}

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textarea',
	'settings'     => 'html_checkout_sidebar',
	'transport' => $transport,
	'label'       => __( 'Checkout Sidebar content', 'flatsome-admin' ),
	'help'        => __( 'Enter HTML that will show on bottom of checkout sidebar' ),
	'section'     => 'cart-checkout',
	'default'     => '',
));
