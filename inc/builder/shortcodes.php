<?php

$presets = __DIR__ . '/shortcodes/presets/';

require_once __DIR__ . '/shortcodes/accordion.php';
require_once __DIR__ . '/shortcodes/accordion_item.php';
require_once __DIR__ . '/shortcodes/block.php';
require_once __DIR__ . '/shortcodes/page_header.php';
require_once __DIR__ . '/shortcodes/gap.php';
require_once __DIR__ . '/shortcodes/blog_posts.php';
require_once __DIR__ . '/shortcodes/button.php';
require_once __DIR__ . '/shortcodes/col_grid.php';
require_once __DIR__ . '/shortcodes/col.php';
require_once __DIR__ . '/shortcodes/divider.php';
require_once __DIR__ . '/shortcodes/featured_box.php';
require_once __DIR__ . '/shortcodes/map.php';
require_once __DIR__ . '/shortcodes/row.php';
require_once __DIR__ . '/shortcodes/scroll_to.php';
require_once __DIR__ . '/shortcodes/section.php';
require_once __DIR__ . '/shortcodes/tab.php';
require_once __DIR__ . '/shortcodes/tabgroup.php';
require_once __DIR__ . '/shortcodes/text_box.php';
require_once __DIR__ . '/shortcodes/text.php';
require_once __DIR__ . '/shortcodes/title.php';
require_once __DIR__ . '/shortcodes/team_member.php';
require_once __DIR__ . '/shortcodes/ux_banner.php';
require_once __DIR__ . '/shortcodes/ux_banner_grid.php';
require_once __DIR__ . '/shortcodes/ux_image_box.php';
require_once __DIR__ . '/shortcodes/ux_image.php';
require_once __DIR__ . '/shortcodes/ux_pages.php';
require_once __DIR__ . '/shortcodes/ux_gallery.php';
require_once __DIR__ . '/shortcodes/ux_slider.php';
require_once __DIR__ . '/shortcodes/ux_logo.php';
require_once __DIR__ . '/shortcodes/ux_hotspot.php';
require_once __DIR__ . '/shortcodes/video_button.php';
require_once __DIR__ . '/shortcodes/message_box.php';
require_once __DIR__ . '/shortcodes/share.php';
require_once __DIR__ . '/shortcodes/follow.php';
require_once __DIR__ . '/shortcodes/testimonial.php';
require_once __DIR__ . '/shortcodes/ux_countdown.php';
require_once __DIR__ . '/shortcodes/ux_instagram_feed.php';
require_once __DIR__ . '/shortcodes/search.php';
require_once __DIR__ . '/shortcodes/price_table.php';
require_once __DIR__ . '/shortcodes/ux_video.php';
require_once __DIR__ . '/shortcodes/ux_sidebar.php';
require_once __DIR__ . '/shortcodes/ux_nav.php';

#require_once __DIR__ . '/shortcodes/page_meta.php';

if(get_theme_mod('fl_portfolio', 1)){
	require_once __DIR__ . '/shortcodes/ux_portfolio.php';
}

if ( class_exists( 'WPCF7' ) ) {
	require_once __DIR__ . '/shortcodes/contactform7.php';
}

// WooCommerce shortcodes
if ( class_exists( 'WooCommerce' ) ) {
  require_once __DIR__ . '/shortcodes/ux_product_flip.php';
  require_once __DIR__ . '/shortcodes/woocommerce_cart.php';
  require_once __DIR__ . '/shortcodes/woocommerce_checkout.php';
  require_once __DIR__ . '/shortcodes/woocommerce_shortcodes.php';
  require_once __DIR__ . '/shortcodes/ux_product_categories.php';
  require_once __DIR__ . '/shortcodes/ux_products.php';
  require_once __DIR__ . '/shortcodes/ux_products_list.php';
}
