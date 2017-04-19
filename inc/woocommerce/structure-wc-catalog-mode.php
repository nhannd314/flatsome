<?php


function flatsome_body_classes_catalog_mode( $classes ) {
    // Catalog mode
    if(get_theme_mod('catalog_mode')) $classes[] = 'catalog-mode';
    if(get_theme_mod('catalog_mode_prices')) $classes[] = 'no-prices';

    return $classes;
}
add_filter( 'body_class', 'flatsome_body_classes_catalog_mode' );

function flatsome_catalog_mode_product(){
    if(flatsome_option('catalog_mode_product')){
        echo '<div class="catalog-product-text pb relative">';
        echo do_shortcode(flatsome_option('catalog_mode_product'));
        echo '</div>';
    }
    echo '<style>.woocommerce-variation-availability{display:none!important}</style>';
}
add_action('woocommerce_single_product_summary', 'flatsome_catalog_mode_product',30);

function flatsome_catalog_mode_lightbox(){
    if(flatsome_option('catalog_mode_lightbox')) {
        echo '<div class="catalog-product-text pb relative">';
        echo do_shortcode(flatsome_option('catalog_mode_lightbox'));
        echo '</div>';
    }
    echo '<style>.woocommerce-variation-availability{display:none!important}</style>';
}
add_action( 'woocommerce_single_product_lightbox_summary', 'flatsome_catalog_mode_lightbox', 30 );


/* Disable purchasing of products */
add_filter('woocommerce_is_purchasable', 'flatsome_woocommerce_is_purchasable', 10, 2);
function flatsome_woocommerce_is_purchasable($is_purchasable, $product) {
        return false;
}

/* Remove variations add to cart */
remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20);

/* Remove add to cart quick button */
remove_action( 'flatsome_product_box_actions', 'flatsome_product_box_actions_add_to_cart', 1 );

/* Remove prices from loop */
if(flatsome_option('catalog_mode_prices')) remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

/* Renove prices from product page */
if(flatsome_option('catalog_mode_prices')) remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

/* Remove prices from lightbox */
if(flatsome_option('catalog_mode_prices')) remove_action( 'woocommerce_single_product_lightbox_summary', 'woocommerce_template_single_price', 10 );
