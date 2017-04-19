<?php
/**
 * Flatsome Admin Engine Room.
 * This is where all Admin Functions run
 *
 * @package flatsome
 */



/**
 * Theme Panel
 */
require get_template_directory() . '/inc/admin/panel/panel.php';


// Add Advanced Options
if (!is_customize_preview()  && is_admin() ) {
  require get_template_directory() . '/inc/admin/envato_setup/envato_setup.php';
  require get_template_directory() . '/inc/admin/advanced/index.php';
}

// Add Admin Bar helper
if ( is_admin_bar_showing() ) {
  require get_template_directory() . '/inc/admin/admin-bar.php';
}

// Add Options
if(is_customize_preview()){

  // Include Kirki
  include_once( dirname( __FILE__ ) . '/kirki/kirki.php' );

  // Include Customizer Settings
  include_once(dirname( __FILE__ ).'/customizer/customizer-config.php');
  include_once(dirname( __FILE__ ).'/customizer/customizer-reset.php');

  // Include Header builder
  include_once(dirname( __FILE__ ).'/customizer/header-builder.php');

  // Include Options Helpers
  include_once(dirname( __FILE__ ).'/options/helpers/options-helpers.php');

  // Add Options
  include_once(dirname( __FILE__ ).'/options/global/options-general.php');
  include_once(dirname( __FILE__ ).'/options/layout/options-layout.php');
  include_once(dirname( __FILE__ ).'/options/header/options-header.php');
  include_once(dirname( __FILE__ ).'/options/footer/options-footer.php');
  include_once(dirname( __FILE__ ).'/options/social/options-social.php');
  include_once(dirname( __FILE__ ).'/options/pages/options-pages.php');
  include_once(dirname( __FILE__ ).'/options/styles/options-colors.php');
  include_once(dirname( __FILE__ ).'/options/styles/options-global.php');
  include_once(dirname( __FILE__ ).'/options/styles/options-type.php');


  include_once(dirname( __FILE__ ).'/options/styles/options-css.php');
  include_once(dirname( __FILE__ ).'/options/styles/options-lightbox.php');

  if(get_theme_mod('fl_portfolio', 1)){
      include_once(dirname( __FILE__ ).'/options/portfolio/options-portfolio.php');
  }

  include_once(dirname( __FILE__ ).'/options/blog/options-blog.php');

  // Depricated options
  include_once(dirname( __FILE__ ).'/options/options-depricated.php');

  if(is_woocommerce_activated() && ( is_customize_preview() || is_admin() )) {
    include_once(dirname( __FILE__ ).'/options/shop/options-shop.php');
  }
}

if(is_admin()) {
  include_once(dirname( __FILE__ ).'/options/pages/options-page-meta.php');
}
