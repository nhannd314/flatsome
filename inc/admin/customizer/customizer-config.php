<?php


if ( ! function_exists( 'flatsome_kirki_update_url' ) ) {
  function flatsome_kirki_update_url( $config ) {
      $config['url_path'] = get_template_directory_uri() . '/inc/admin/kirki/';
      return $config;
  }
}
add_filter( 'kirki/config', 'flatsome_kirki_update_url' );


/**
 * Configuration for the Kirki Customizer
 */

function flatsome_custom_sanitize($content){
  return $content;
}

Flatsome_Option::add_config( 'option', array(
    'option_type' => 'theme_mod',
    'capability'  => 'edit_theme_options',
    'disable_output' => true
) );


/**
 * Add Custom CSS to Customizer
 */

function flatsome_enqueue_customizer_stylesheet() {
    $theme = wp_get_theme( get_template() );
    $version = $theme['Version'];

    wp_enqueue_script( 'flatsome-customizer-admin-js', get_template_directory_uri() . '/assets/js/customizer-admin.js', NULL, $version, 'all' );
    wp_enqueue_style( 'flatsome-header-builder-css', get_template_directory_uri() . '/assets/css/admin/admin-header-builder.css', NULL, $version, 'all' );
    wp_enqueue_style( 'flatsome-customizer-admin', get_template_directory_uri() . '/assets/css/admin/admin-customizer.css', NULL, $version, 'all' );
}
add_action( 'customize_controls_print_styles', 'flatsome_enqueue_customizer_stylesheet' );

function flatsome_customizer_live_preview() {
    $theme = wp_get_theme( 'flatsome' );
    $version = $theme['Version'];

    wp_enqueue_style( 'flatsome-customizer-preview', get_template_directory_uri() . '/assets/css/admin/admin-frontend.css', NULL, $version, 'all' );

    wp_enqueue_script( 'flatsome-customizer-frontend-js', get_template_directory_uri() . '/assets/js/customizer-frontend.js', NULL, $version, 'all' );
}
add_action( 'customize_preview_init', 'flatsome_customizer_live_preview' );
