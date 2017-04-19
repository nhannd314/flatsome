<?php

/*************
 * - Wishlist Options
 *************/

  Flatsome_Option::add_section( 'header_wishlist', array(
    'title'       => __( 'Wishlist', 'flatsome-admin' ),
    'panel'       => 'header',
    'priority' => 110,
  ) );

  Flatsome_Option::add_field( 'option', array(
    'type'        => 'select',
    'settings'     => 'wishlist_icon',
    'label'       => __( 'Wishlist Icon', 'flatsome-admin' ),
    'transport' => $transport,
    'section'     => 'header_wishlist',
    'default'     => 'heart',
    'choices'     => array(
          '' => "None",
          "heart" => "Heart (Default)",
          "heart-o" => "Heart Outline",
          "star" => "Star",
          "star-o" => "Star Outline",
          "menu" => "List",
          "pen-alt-fill" => "Pen",
    ),
  ));


  Flatsome_Option::add_field( 'option', array(
    'type'        => 'radio-image',
    'settings'     => 'wishlist_icon_style',
    'label'       => __( 'Wishlist Icon Style', 'flatsome-admin' ),
    'section'     => 'header_wishlist',
    'transport' => $transport,
    'default'     => '',
    'choices'     => array(
      '' => $image_url . 'icon-plain.svg',
      'outline' => $image_url . 'icon-outline.svg',
      'fill' => $image_url . 'icon-fill.svg',
      'fill-round' => $image_url . 'icon-fill-round.svg',
      'outline-round' => $image_url . 'icon-outline-round.svg',
    ),
  ));


  Flatsome_Option::add_field( 'option',  array(
    'type'        => 'checkbox',
    'settings'     => 'wishlist_title',
    'label'       => __( 'Show Wishlist Title', 'flatsome-admin' ),
    //'description' => __( 'This is the control description', 'flatsome-admin' ),
    //'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'flatsome-admin' ),
    'section'     => 'header_wishlist',
    'transport' => $transport,
    'default'     => 1,
  ));

  Flatsome_Option::add_field( 'option',  array(
    'type'        => 'text',
    'settings'     => 'header_wishlist_label',
    'label'       => __( 'Custom Title', 'flatsome-admin' ),
    'section'     => 'header_wishlist',
    'transport' => $transport,
    'default'     => '',
  ));


  function flatsome_refresh_wishlist_partials( WP_Customize_Manager $wp_customize ) {

    // Abort if selective refresh is not available.
    if ( ! isset( $wp_customize->selective_refresh ) ) {
        return;
    }

    $wp_customize->selective_refresh->add_partial( 'header-wishlist', array(
        'selector' => '.header-wishlist-icon',
        'container_inclusive' => true,
        'settings' => array('wishlist_title','wishlist_icon','wishlist_title','wishlist_icon_style','header_wishlist_label'),
        'render_callback' => function() {
             return get_template_part('template-parts/header/partials/element','wishlist');
        },
    ) );

  }
  add_action( 'customize_register', 'flatsome_refresh_wishlist_partials' );
