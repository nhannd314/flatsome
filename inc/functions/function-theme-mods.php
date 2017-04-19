<?php

$_flatsome_theme_mod_site_url = site_url( '', 'http' );
$_flatsome_theme_mod_site_url_secure = site_url( '', 'https' );

function flatsome_theme_mod_fix ( $value ) {
  if ( ! is_string( $value ) ) return $value;
  global $_flatsome_theme_mod_site_url;
  global $_flatsome_theme_mod_site_url_secure;
  return str_replace(
    array( '[site_url]', '[site_url_secure]' ),
    array( $_flatsome_theme_mod_site_url, $_flatsome_theme_mod_site_url_secure ),
    $value
  );
}

add_filter( 'theme_mod_footer_1_bg_image', 'flatsome_theme_mod_fix' );
add_filter( 'theme_mod_footer_2_bg_image', 'flatsome_theme_mod_fix' );
add_filter( 'theme_mod_custom_cart_icon', 'flatsome_theme_mod_fix' );
add_filter( 'theme_mod_site_logo', 'flatsome_theme_mod_fix' );
add_filter( 'theme_mod_site_logo_dark', 'flatsome_theme_mod_fix' );
add_filter( 'theme_mod_header_bg_img', 'flatsome_theme_mod_fix' );
add_filter( 'theme_mod_header_newsletter_bg', 'flatsome_theme_mod_fix' );
add_filter( 'theme_mod_site_logo_sticky', 'flatsome_theme_mod_fix' );
add_filter( 'theme_mod_body_bg_image', 'flatsome_theme_mod_fix' );
add_filter( 'theme_mod_portfolio_archive_bg', 'flatsome_theme_mod_fix' );
add_filter( 'theme_mod_header_shop_bg_image', 'flatsome_theme_mod_fix' );
add_filter( 'theme_mod_facebook_login_bg', 'flatsome_theme_mod_fix' );
add_filter( 'theme_mod_payment_icons_custom', 'flatsome_theme_mod_fix' );
add_filter( 'theme_mod_follow_snapchat', 'flatsome_theme_mod_fix' );
