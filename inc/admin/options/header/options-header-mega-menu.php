<?php

/*************
 * - Wishlist Options
 *************/

  Flatsome_Option::add_section( 'header_mega_menu', array(
    'title'       => __( 'Mega Menu', 'flatsome-admin' ),
    'panel'       => 'header',
    'priority' => 110,
  ) );

  function flatsome_refresh_mega_menu_partials( WP_Customize_Manager $wp_customize ) {

    // Abort if selective refresh is not available.
    if ( ! isset( $wp_customize->selective_refresh ) ) {
        return;
    }

    $wp_customize->selective_refresh->add_partial( 'header-mega-menu', array(
        'selector' => '.header-mega-menu',
        'container_inclusive' => true,
        'settings' => array(),
        'render_callback' => function() {
             return get_template_part('template-parts/header/partials/element','mega-menu');
        },
    ) );

  }
  add_action( 'customize_register', 'flatsome_refresh_mega_menu_partials' );
