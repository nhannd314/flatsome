<?php
/**
 * Flatsome Engine Room.
 * This is where all Theme Functions runs.
 *
 * @package flatsome
 */


// Add Flatsome Option Class
require get_template_directory() . '/inc/classes/class-flatsome-options.php';

/**
 * Setup.
 * Enqueue styles, register widget regions, etc.
 */
require get_template_directory() . '/inc/functions/function-global.php';
require get_template_directory() . '/inc/functions/function-upgrade.php';
require get_template_directory() . '/inc/functions/function-defaults.php';
require get_template_directory() . '/inc/functions/function-setup.php';
require get_template_directory() . '/inc/functions/function-theme-mods.php';
require get_template_directory() . '/inc/functions/function-plugins.php';
require get_template_directory() . '/inc/functions/function-custom-css.php';
require get_template_directory() . '/inc/functions/function-maintenance.php';
require get_template_directory() . '/inc/functions/function-fallbacks.php';

if(get_theme_mod('lazy_load_google_fonts',1)){
  require get_template_directory() . '/inc/functions/function-fonts.php';
} else{
  require get_template_directory() . '/inc/functions/function-fonts-old.php';
}


if(is_admin_bar_showing() && current_user_can('manage_options')){
  require get_template_directory() . '/inc/functions/function-update.php';
}

// Get Presets for Theme Options and Demos
require get_template_directory() . '/inc/functions/function-presets.php';

/**
 * Helper functions
 */
require get_template_directory() . '/inc/helpers/helpers-frontend.php';
require get_template_directory() . '/inc/helpers/helpers-shortcode.php';
require get_template_directory() . '/inc/helpers/helpers-grid.php';
require get_template_directory() . '/inc/helpers/helpers-icons.php';

/**
 * Structure.
 * Template functions used throughout the theme.
 */
if(!is_admin()){
  require get_template_directory() . '/inc/structure/structure-footer.php';
  require get_template_directory() . '/inc/structure/structure-header.php';
  require get_template_directory() . '/inc/structure/structure-pages.php';
  require get_template_directory() . '/inc/structure/structure-posts.php';
  require get_template_directory() . '/inc/structure/structure-sidebars.php';

  if(is_portfolio_activated()){
      require get_template_directory() . '/inc/structure/structure-portfolio.php';
  }
}

if(is_admin()){
  require get_template_directory() . '/inc/structure/structure-admin.php';
}

/**
 * Flatsome Shortcodes.
 */

require get_template_directory() . '/inc/shortcodes/row.php';
require get_template_directory() . '/inc/shortcodes/text_box.php';
require get_template_directory() . '/inc/shortcodes/sections.php';
require get_template_directory() . '/inc/shortcodes/ux_slider.php';
require get_template_directory() . '/inc/shortcodes/ux_banner.php';
require get_template_directory() . '/inc/shortcodes/ux_banner_grid.php';
require get_template_directory() . '/inc/shortcodes/accordion.php';
require get_template_directory() . '/inc/shortcodes/tabs.php';
require get_template_directory() . '/inc/shortcodes/gap.php';
require get_template_directory() . '/inc/shortcodes/featured_box.php';
require get_template_directory() . '/inc/shortcodes/ux_sidebar.php';
require get_template_directory() . '/inc/shortcodes/buttons.php';
require get_template_directory() . '/inc/shortcodes/share_follow.php';
require get_template_directory() . '/inc/shortcodes/elements.php';
require get_template_directory() . '/inc/shortcodes/titles_dividers.php';
require get_template_directory() . '/inc/shortcodes/lightbox.php';
require get_template_directory() . '/inc/shortcodes/blog_posts.php';
require get_template_directory() . '/inc/shortcodes/google_maps.php';
require get_template_directory() . '/inc/shortcodes/testimonials.php';
require get_template_directory() . '/inc/shortcodes/team_members.php';
require get_template_directory() . '/inc/shortcodes/messages.php';
require get_template_directory() . '/inc/shortcodes/search.php';
require get_template_directory() . '/inc/shortcodes/ux_logo.php';
require get_template_directory() . '/inc/shortcodes/ux_image.php';
require get_template_directory() . '/inc/shortcodes/ux_image_box.php';
require get_template_directory() . '/inc/shortcodes/price_table.php';
require get_template_directory() . '/inc/shortcodes/scroll_to.php';
require get_template_directory() . '/inc/shortcodes/ux_pages.php';
require get_template_directory() . '/inc/shortcodes/ux_gallery.php';
require get_template_directory() . '/inc/shortcodes/ux_hotspot.php';
require get_template_directory() . '/inc/shortcodes/item_list.php';
require get_template_directory() . '/inc/shortcodes/page_header.php';
require get_template_directory() . '/inc/shortcodes/ux_instagram_feed.php';
require get_template_directory() . '/inc/shortcodes/ux_countdown/ux-countdown.php';
require get_template_directory() . '/inc/shortcodes/ux_video.php';
require get_template_directory() . '/inc/shortcodes/ux_nav.php';
require get_template_directory() . '/inc/shortcodes/ux_payment_icons.php';

if(is_portfolio_activated()){
  require get_template_directory() . '/inc/shortcodes/portfolio.php';
}

if (is_woocommerce_activated()) {
  require get_template_directory() . '/inc/shortcodes/ux_products.php';
  require get_template_directory() . '/inc/shortcodes/ux_products_list.php';
  require get_template_directory() . '/inc/shortcodes/product_flip.php';
  require get_template_directory() . '/inc/shortcodes/product_categories.php';
}



/**
 * Load WooCommerce Custom Fields
 */
if (is_woocommerce_activated()) {
  require get_template_directory() . '/inc/classes/class-wc-product-data-fields.php';
  require get_template_directory() . '/inc/woocommerce/structure-wc-product-page-fields.php';
}

/**
 * Load WooCommerce functions
 */
if ( is_woocommerce_activated() ) {
  require get_template_directory() . '/inc/woocommerce/structure-wc-global.php';
  require get_template_directory() . '/inc/woocommerce/structure-wc-category-page.php';
  require get_template_directory() . '/inc/woocommerce/structure-wc-category-page-header.php';
  require get_template_directory() . '/inc/woocommerce/structure-wc-product-box.php';
  require get_template_directory() . '/inc/woocommerce/structure-wc-helpers.php';
  require get_template_directory() . '/inc/woocommerce/structure-wc-checkout.php';
  require get_template_directory() . '/inc/woocommerce/structure-wc-cart.php';
  require get_template_directory() . '/inc/woocommerce/structure-wc-product-page.php';
  require get_template_directory() . '/inc/woocommerce/structure-wc-product-page-header.php';
  if(get_theme_mod('catalog_mode')) require get_template_directory() . '/inc/woocommerce/structure-wc-catalog-mode.php';

  // Add structured data fallback for older WooCommerce versions.
  if(!class_exists('WC_Structured_Data') && flatsome_is_request('frontend')) {
    require get_template_directory() . '/inc/classes/class-woocommerce-structured-data.php';
  }
}


/**
 * Flatsome Theme Widgets
 */
require get_template_directory() . '/inc/widgets/widget-recent-posts.php';
require get_template_directory() . '/inc/widgets/widget-blocks.php';
if (is_woocommerce_activated() ) { require get_template_directory() . '/inc/widgets/widget-upsell.php'; }


/**
 * Custom Theme Post Types
 */
require get_template_directory() . '/inc/post-types/post-type-ux-blocks.php';

if(is_portfolio_activated()){
  require get_template_directory() . '/inc/post-types/post-type-ux-portfolio.php';
}


/**
 * Theme Integrations
 */

require get_template_directory() . '/inc/integrations/integrations.php';

/**
 * Theme Extenstions
 */
require get_template_directory() . '/inc/extensions/extensions.php';

/**
 * Theme Admin
 */
if(current_user_can( 'manage_options')){
  require get_template_directory() . '/inc/admin/admin-init.php';
}

/**
 * UX Builder
 */
require get_template_directory() . '/inc/builder/builder.php';
