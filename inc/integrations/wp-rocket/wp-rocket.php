<?php

function flatsome_wp_rocket_integration() {
  global $integrations_uri;

  if(get_rocket_option( 'lazyload' )){
  	 wp_enqueue_script( 'flatsome-wp-rocket',  $integrations_uri.'/wp-rocket/flatsome-wp-rocket.js', array('flatsome-js'), 3.0, true);
  }

}
add_action( 'wp_enqueue_scripts', 'flatsome_wp_rocket_integration' );

/**
 * JS files to be included in the footer during the minification process.
 */
function flatsome_wp_rocket_minify_js_in_footer( $scripts ) {
  $uri = get_template_directory_uri();
  if ( wp_script_is( 'flatsome-countdown-theme-js' ) ) {
    $scripts[] = $uri . '/inc/shortcodes/ux_countdown/ux-countdown.js';
  }
  if ( wp_script_is( 'flatsome-lazy' ) ) {
    $scripts[] = $uri . '/inc/extensions/flatsome-lazy-load/flatsome-lazy-load.js';
  }
  if ( wp_script_is( 'flatsome-wp-rocket' ) ) {
    $scripts[] = $uri . '/inc/integrations/wp-rocket/flatsome-wp-rocket.js';
  }
  if ( wp_script_is( 'flatsome-isotope-js' ) ) {
    $scripts[] = $uri . '/assets/libs/isotope.pkgd.min.js';
  }
  return $scripts;
}
add_filter( 'rocket_minify_js_in_footer', 'flatsome_wp_rocket_minify_js_in_footer' );
