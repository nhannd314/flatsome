<?php

function flatsome_integration_url(){
  return get_template_directory() . '/inc/integrations';
}

function flatsome_integration_uri(){
  return get_template_directory_uri() . '/inc/integrations';
}

$integrations_url = get_template_directory() . '/inc/integrations';
$integrations_uri = get_template_directory_uri() . '/inc/integrations';

function flatsome_integrations_scripts() {
  global $integrations_uri;

  wp_deregister_style('nextend_fb_connect_stylesheet');
  wp_deregister_style('nextend_google_connect_stylesheet');

  // Ninja forms
  if(function_exists('Ninja_Forms') && !is_admin()){
    remove_action( 'ninja_forms_display_css', 'ninja_forms_display_css' );
    wp_enqueue_style( 'flatsome-ninjaforms',  $integrations_uri.'/ninjaforms/ninjaforms.css');
  }

}
add_action( 'wp_enqueue_scripts', 'flatsome_integrations_scripts' );

//  WPML Integration
if(function_exists('pll_get_post') || function_exists('icl_object_id')){
	  require $integrations_url.'/wpml/flatsome-wpml.php';
}

// Contactform7
if(class_exists('WPCF7')){
    require $integrations_url.'/contact-form-7/contact-form-7.php';
}

if(function_exists('ubermenu')){
    require $integrations_url.'/ubermenu/flatsome-ubermenu.php';
}

// WP Rocket
if(function_exists('get_rocket_option') && !is_admin()){
    require $integrations_url.'/wp-rocket/wp-rocket.php';
}

// WooCommerce Integrations
if ( is_woocommerce_activated() ) {

  function flatsome_woocommerce_integrations_scripts() {

      global $integrations_url, $integrations_uri;

      if ( is_extension_activated( 'woocommerce_booking' ) ) {
        wp_enqueue_style( 'flatsome-woocommerce-bookings-style', $integrations_uri.'/wc-bookings/bookings.css', 'flatsome-woocommerce-style' );
      } 

      // Extra Product Options
      if ( is_extension_activated( 'TM_Extra_Product_Options' ) ) {
        wp_enqueue_style( 'flatsome-woocommerce-extra-product-options', $integrations_uri.'/wc-extra-product-options/extra-product-options.css', 'flatsome-woocommerce-style' );
      }

      if ( is_extension_activated( 'Easy_booking' ) ) {
        wp_enqueue_style( 'flatsome-woocommerce-easy-booking', $integrations_uri.'/wc-easy-booking/wc-easy-bookings.css', 'flatsome-woocommerce-style' );
      }

      if ( is_extension_activated( 'Fancy_Product_Designer' ) ) {
        wp_enqueue_style( 'flatsome-fancy-product-designer',  $integrations_uri.'/wc-product-designer/product-designer.css', 'flatsome-woocommerce-style' );
      }

      if ( is_extension_activated( 'Woocommerce_Advanced_Product_Labels' ) ) {
        wp_enqueue_style( 'flatsome-woocommerce-advanced-labels',  $integrations_uri.'/wc-advanced-product-labels/advanced-product-labels.css', 'flatsome-woocommerce-style' );
      }
  }

  add_action( 'wp_enqueue_scripts', 'flatsome_woocommerce_integrations_scripts' );


  // Add Yith Wishlist integration
  if(class_exists( 'YITH_WCWL' )){
    require $integrations_url.'/wc-yith-wishlist/yith-wishlist.php';
  }

  /* WooCommerce Ajax Navigation */
  add_filter('_ajax_layered_nav_containers', 'ux_add_custom_container');
      function ux_add_custom_container($containers){
      $containers[] = '.woocommerce-pagination';
      $containers[] = '.woocommerce-result-count';
      return $containers;
  }

  /* Yith Ajax Navigation */
  add_filter('sod_ajax_layered_nav_product_container', 'aln_product_container');
      function aln_product_container($product_container){
      //Enter either the class or id of the container that holds your products
      return '.products';
  }

  // Infinitive scroll fix
    function flatsome_woocommerce_extenstions_after_setup(){
        if ( defined( 'YITH_INFS_VERSION' ) ) {
          $options = get_option('yit_infs_options');

          if(!empty($options) || $options['yith-infs-navselector'] == '.woocommerce-pagination'){
           return;
          }
          
          if(empty($options) ) $options = array();
          
          $new_options = array(
            'yith-infs-navselector' => '.woocommerce-pagination',
            'yith-infs-nextselector' => '.woocommerce-pagination li a.next',
            'yith-infs-itemselector' => '.products',
            'yith-infs-contentselector' => '#wrapper'
          );

          $options = array_merge($options,$new_options);

          update_option('yit_infs_options',$options);
        }
    }
    add_action('after_switch_theme', 'flatsome_woocommerce_extenstions_after_setup', 15);
} // WooCommerce integrations