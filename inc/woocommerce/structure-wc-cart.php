<?php


// Move Cross sell product to under cart
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart_table', 'woocommerce_cross_sell_display' );

// Add Content after Cart
if(!function_exists('flatsome_html_cart_footer')) {
  function flatsome_html_cart_footer(){
  	$content = get_theme_mod('html_cart_footer');
      echo '<div class="cart-footer-content after-cart-content relative">'.do_shortcode($content).'</div>';
  }
  add_action( 'woocommerce_after_cart', 'flatsome_html_cart_footer', 99);
}


// Add Content in cart sidebar
if(!function_exists('flatsome_html_cart_sidebar')) {
  function flatsome_html_cart_sidebar(){
  	$content = get_theme_mod('html_cart_sidebar');
  	$icons = get_theme_mod('payment_icons_placement');

      echo '<div class="cart-sidebar-content relative">'.do_shortcode($content).'</div>';
      if(is_array($icons) && in_array('cart', $icons)) echo do_shortcode('[ux_payment_icons]');
  }
  add_action( 'flatsome_cart_sidebar', 'flatsome_html_cart_sidebar', 10);
}


// Continue Shopping button
if(!function_exists('flatsome_continue_shopping')) {
  function flatsome_continue_shopping(){
    echo wc_get_template_part('cart/continue-shopping');
  }
}
add_action('woocommerce_cart_actions', 'flatsome_continue_shopping', 10);
