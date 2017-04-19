<?php 
Flatsome_Option::add_section( 'catalog-mode', array(
	'title'       => __( 'Catalog Mode', 'flatsome-admin' ),
	'panel' => 'shop',
	'description' => __( 'Enable Catalog Mode', 'flatsome-admin' ),
) );

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'catalog_mode',
	'label'       => __( 'Enable Catalogue Mode.', 'flatsome-admin' ),
	'section'     => 'catalog-mode',
	'default'     => 0,
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'catalog_mode_prices',
	'label'       => __( 'Disable Prices', 'flatsome-admin' ),
	'description' => 'Select to disable prices on category pages and product page.',
	'section'     => 'catalog-mode',
	'default'     => 0,
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textarea',
	'settings'     => 'catalog_mode_header',
	'transport' => $transport,
	'label'       => __( 'Header Cart replacement', 'flatsome-admin' ),
	'help'        => __( "Enter content you want to display instad of Account / Cart. Shortcodes are allowed.", 'flatsome-admin'),
	'section'     => 'catalog-mode',
	'default'     => '',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textarea',
	'settings'     => 'catalog_mode_product',
	'transport' => $transport,
	'label'       => __( 'Product page Add to cart replacement.', 'flatsome-admin' ),
	'help'        => __( 'Enter contact information or enquery form shortcode here.', 'flatsome-admin'),
	'section'     => 'catalog-mode',
	'default'     => 'Add any HTML or Shortcode here...',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textarea',
	'settings'     => 'catalog_mode_lightbox',
	'transport' => $transport,
	'label'       => __( 'Add to cart replacement - Product Quick View', 'flatsome-admin' ),
	'help'        => __( 'Enter text that will show in product quick view', 'flatsome-admin'),
	'section'     => 'catalog-mode',
	'default'     => '',
));