<?php


function flatsome_maintenance_mode() {

  // Exit if not active
  if(!get_theme_mod('maintenance_mode', 0)) return;

  global $pagenow;

  nocache_headers();

  if ( $pagenow !== 'wp-login.php' && ! current_user_can( 'manage_options' ) && ! is_admin() ) {

    // Clear Cachify Cache
    if ( has_action('cachify_flush_cache') ) {
      do_action('cachify_flush_cache');
    }
    
    // Clear Super Cache
    if ( function_exists( 'wp_cache_clear_cache' ) ) {
      ob_end_clean();
      wp_cache_clear_cache();
    }
    
    // Clear W3 Total Cache
    if ( function_exists( 'w3tc_pgcache_flush' ) ) {
      ob_end_clean();
      w3tc_pgcache_flush();
    }
    
    header( $_SERVER["SERVER_PROTOCOL"] . ' 503 Service Temporarily Unavailable', true, 503 );
    header( 'Content-Type: text/html; charset=utf-8' );
    get_template_part('maintenance');
    die();
  }
}

add_action( 'wp_loaded', 'flatsome_maintenance_mode' );