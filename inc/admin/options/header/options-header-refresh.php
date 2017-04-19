<?php

function flatsome_refresh_header_partials( WP_Customize_Manager $wp_customize ) {

  // Abort if selective refresh is not available.
  if ( ! isset( $wp_customize->selective_refresh ) ) {
      return;
  }

	$wp_customize->selective_refresh->add_partial( 'header_wrapper', array(
	    'selector' => '.header-wrapper',
	    'settings' => array('header_bg_transparent_shade','topbar_show'),
	    'render_callback' => function() {
	        return get_template_part('template-parts/header/header', 'wrapper');
	    },
	) );

	$wp_customize->selective_refresh->add_partial( 'header_top', array(
	    'selector' => '#top-bar',
	    'settings' => array('header_mobile_elements_top','topbar_elements_center', 'topbar_elements_right', 'topbar_elements_left','nav_style_top'),
	    'container_inclusive' => true,
	    'render_callback' => function() {
	        return get_template_part('template-parts/header/header','top');
	    },
	) );

	$wp_customize->selective_refresh->add_partial( 'header_bottom', array(
	    'selector' => '#wide-nav',
	    'settings' => array('nav_style_bottom','nav_spacing_bottom','nav_size_bottom','header_mobile_elements_bottom','header_elements_bottom_left', 'header_elements_bottom_center', 'header_elements_bottom_right'),
	    'container_inclusive' => true,
	    'render_callback' => function() {
	        return get_template_part('template-parts/header/header','bottom');
	    },
	) );

	$wp_customize->selective_refresh->add_partial( 'header_main', array(
	    'selector' => '#masthead',
	    'settings' => array('nav_style','nav_size','nav_spacing','header_divider'),
	    'container_inclusive' => true,
	    'render_callback' => function() {
	        return get_template_part('template-parts/header/header','main');
	    },
	) );


	$wp_customize->selective_refresh->add_partial( 'header_elements_right', array(
	    'selector' => '.header-nav-main.nav-right',
	    'settings' => array('header_elements_right'),
	    'render_callback' => function() {
	        return flatsome_header_elements('header_elements_right');
	    },
	) );

	$wp_customize->selective_refresh->add_partial( 'header_elements_left', array(
	    'selector' => '.header-nav-main.nav-left',
	    'settings' => array('header_elements_left'),
	    'render_callback' => function() {
	        return flatsome_header_elements('header_elements_left');
	    },
	) );
	


	$wp_customize->selective_refresh->add_partial( 'logo', array(
	    'selector' => '.logo',
	    'settings' => array('blogdescription','site_logo_sticky','blogname','site_logo','site_logo_dark','site_logo_slogan'),
	    'render_callback' => function() {
	        return get_template_part('template-parts/header/partials/element','logo');
	    },
	) );

	$wp_customize->selective_refresh->add_partial( 'mobile-icon', array(
	    'selector' => 'li.nav-icon',
	    'container_inclusive' => true,
	    'settings' => array('menu_icon_title','menu_icon_style','mobile_overlay','mobile_overlay_color'),
	    'render_callback' => function() {
	        return get_template_part('template-parts/header/partials/element','menu-icon');
	    },
	) );

	$wp_customize->selective_refresh->add_partial( 'mobile-sidebar', array(
	    'selector' => '.mobile-sidebar .nav',
	    'settings' => array('mobile_sidebar'),
	    'render_callback' => function() {
	        return flatsome_header_elements('mobile_sidebar','sidebar');
	    },
	) );


	// Mobile Elements
	$wp_customize->selective_refresh->add_partial( 'header_mobile_elements_left', array(
	    'selector' => '.header-main .mobile-nav.nav-left',
	    'settings' => array('header_mobile_elements_left'),
	    'render_callback' => function() {
	        return flatsome_header_elements('header_mobile_elements_left','mobile');
	    },
	) );

	// Mobile Right
	$wp_customize->selective_refresh->add_partial( 'header_mobile_elements_right', array(
	    'selector' => '.header-main .mobile-nav.nav-right',
	    'settings' => array('header_mobile_elements_right'),
	    'render_callback' => function() {
	        return flatsome_header_elements('header_mobile_elements_right','mobile');
	    },
	) );

	// Refresh custom styling / Colors etc.
	$wp_customize->selective_refresh->add_partial( 'refresh_css_header', array(
	    'selector' => 'head > style#custom-css',
	    'container_inclusive' => true,
	    'settings' => array('color_widget_links','color_widget_links_hover','button_radius','type_headings','color_texts','type_headings_color','header_shop_bg_image','header_shop_bg_color','header_shop_bg_image','header_shop_bg_featured','color_secondary','type_nav_bottom_color','type_nav_bottom_color_hover','type_nav_color_hover','type_nav_color','color_links','color_links_hover','header_top_height','header_bottom_height','header_height','header_height_transparent','color_primary','header_height_sticky','flatsome_lightbox_bg','header_icons_color','header_icons_color_hover'),
	    'render_callback' => function() {
	        return 	flatsome_custom_css();
	    },
	) );

}
add_action( 'customize_register', 'flatsome_refresh_header_partials' );