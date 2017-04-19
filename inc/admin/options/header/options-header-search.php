<?php

/*************
 * Search
 *************/

Flatsome_Option::add_section( 'header_search', array(
	'title'       => __( 'Search', 'flatsome-admin' ),
	'panel'       => 'header',
	//'description' => __( 'This is the section description', 'flatsome-admin' ),
) );



Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-image',
	'settings'     => 'search_icon_style',
	'label'       => __( 'Search Icon Style', 'flatsome-admin' ),
	'section'     => 'header_search',
	'default'     => '',
	'transport' => $transport,
	'choices'     => array(
		'' => $image_url . 'search-icon-plain.svg',
		'outline' => $image_url . 'search-icon-outline.svg',
		'fill' => $image_url . 'search-icon-fill.svg',
		'fill-round' => $image_url . 'search-icon-fill-round.svg',
		'outline-round' => $image_url . 'search-icon-outline-round.svg',
	),
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-buttonset',
	'settings'     => 'header_search_style',
	'transport' => $transport,
	'label'       => __( 'Search Icon Type', 'flatsome-admin' ),
	//'description' => __( 'This is the control description', 'flatsome-admin' ),
	//'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'flatsome-admin' ),
	'section'     => 'header_search',
	'default'     => 'dropdown',
	'choices'     => array(
		'dropdown' => __( 'Dropdown', 'flatsome-admin' ),
		'lightbox' => __( 'Lightbox', 'flatsome-admin' ),
	),
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-buttonset',
	'settings'     => 'header_search_form_style',
	'label'       => __( 'Search Form Style', 'flatsome-admin' ),
	//'description' => __( 'This is the control description', 'flatsome-admin' ),
	//'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'flatsome-admin' ),
	'section'     => 'header_search',
	'default'     => '',
	'transport' => 'postMessage',
	'choices'     => array(
		'' => __( 'Normal', 'flatsome-admin' ),
		'flat' => __('Flat', 'flatsome-admin' ),
	),
));

Flatsome_Option::add_field( 'option',  array(
  'type'        => 'text',
  'settings'     => 'search_placeholder',
  'transport' => 'postMessage',
  'label'       => __( 'Placeholder text', 'flatsome-admin' ),
  'section'     => 'header_search',
  'placeholder' => 'Search...',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'transport' => $transport,
	'settings'     => 'header_search_categories',
	'label'       => __( 'Search Categories', 'flatsome-admin' ),
	'help'        => __( 'Search categories', 'flatsome-admin' ),
	'section'     => 'header_search',
	'default'     => 0,
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'slider',
	'settings'     => 'header_search_width',
	'label'       => __( 'Header Search form width', 'flatsome-admin' ),
	'section'     => 'header_search',
	'default'     => '60',
	'transport' => 'postMessage',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1
	)
));

function flatsome_refresh_header_search_partials( WP_Customize_Manager $wp_customize ) {

	if ( ! isset( $wp_customize->selective_refresh ) ) {
	      return;
	}

	$wp_customize->selective_refresh->add_partial( 'header_search', array(
	    'selector' => '.header-search',
	    'container_inclusive' => true,
	    'settings' => array('search_icon_style','header_search_style'),
	    'render_callback' => function() {
	        return get_template_part('template-parts/header/partials/element','search');
	    },
	) );

	$wp_customize->selective_refresh->add_partial( 'header_search_form', array(
	    'selector' => '.search-form',
	    'container_inclusive' => true,
	    'settings' => array('header_search_categories'),
	    'render_callback' => function() {
	        return get_template_part('template-parts/header/partials/element','search-form');
	    },
	) );
}
add_action( 'customize_register', 'flatsome_refresh_header_search_partials' );
