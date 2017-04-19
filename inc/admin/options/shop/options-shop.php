<?php

/*************
 * Shop Panel
 *************/

Flatsome_Option::add_panel( 'shop', array(
	'title'       => __( 'Shop', 'flatsome-admin' ),
	'description' => __( 'Change Theme Header Options here. Try use the "Presets" to quickly create the header you like', 'flatsome-admin' ),
) );

include_once(dirname( __FILE__ ).'/options-shop-category.php');
include_once(dirname( __FILE__ ).'/options-shop-product-page.php');
include_once(dirname( __FILE__ ).'/options-shop-product-box.php');
include_once(dirname( __FILE__ ).'/options-shop-my-account.php');
include_once(dirname( __FILE__ ).'/options-shop-cart-checkout.php');
include_once(dirname( __FILE__ ).'/options-shop-payments-icons.php');
//include_once(dirname( __FILE__ ).'/options-shop-catalog-mode.php');

function flatsome_refresh_shop_partials( WP_Customize_Manager $wp_customize ) {

  // Abort if selective refresh is not available.
  if ( ! isset( $wp_customize->selective_refresh ) ) {
      return;
  }

	$wp_customize->selective_refresh->add_partial( 'product-layout', array(
	    'selector' => '.product-container',
	    'settings' => array('product_layout'),
	    'fallback_refresh' => false,
	    'container_inclusive' => true,
	    'render_callback' => function() {
	        return wc_get_template_part( 'single-product/layouts/product', flatsome_option('product_layout'));
	    },
	) );

	$wp_customize->selective_refresh->add_partial( 'shop-header', array(
	    'selector' => '.woocommerce .category-page-title',
	    	    'fallback_refresh' => false,
	    'settings' => array('html_shop_page','category_title_style','category_show_title'),
	    'container_inclusive' => true,
	    'render_callback' => function() {
	        return flatsome_category_header();
	    },
	) );

	$wp_customize->selective_refresh->add_partial( 'shop-grid', array(
	    'selector' => '.category-page-row',
	    'fallback_refresh' => false,
	    'settings' => array('sale_bubble_text','category_grid_style','short_description_in_grid','cat_style','sale_bubble_percentage','add_to_cart_style','add_to_cart_icon','product_box_category','product_box_rating','product_hover','bubble_style','grid_style','category_sidebar','products_pr_page','category_row_count','category_row_count_mobile','category_row_count_tablet','category_shadow','category_shadow_hover','disable_quick_view'),
	    'container_inclusive' => true,
	    'render_callback' => function() {
	        return wc_get_template_part( 'layouts/category', flatsome_option('category_sidebar'));
	    },
	) );


	$wp_customize->selective_refresh->add_partial( 'account-header', array(
	    'selector' => '.my-account-header',
	    'fallback_refresh' => false,
	    'settings' => array('facebook_login_bg','facebook_login_text'),
	    'container_inclusive' => true,
	    'render_callback' => function() {
	        return wc_get_template('myaccount/header.php');
	    },
	) );

	$wp_customize->selective_refresh->add_partial( 'html_cart_footer', array(
	    'selector' => '.cart-footer-content',
	    'settings' => array('html_cart_footer'),
	    'container_inclusive' => true,
	    'render_callback' => function() {
	        return flatsome_html_cart_footer();
	    }
	) );

	$wp_customize->selective_refresh->add_partial( 'html_cart_sidebar', array(
	    'selector' => '.cart-sidebar-content',
	    'settings' => array('html_cart_sidebar'),
	    'container_inclusive' => true,
	    'render_callback' => function() {
	        return flatsome_html_cart_sidebar();
	     }
	) );

	$wp_customize->selective_refresh->add_partial( 'html_checkout_sidebar', array(
	    'selector' => '.html-checkout-sidebar',
	    'settings' => array('html_checkout_sidebar'),
	    'container_inclusive' => true,
	    'render_callback' => function() {
	        return flatsome_html_checkout_sidebar();
	     }
	) );

	$wp_customize->selective_refresh->add_partial( 'payment-icons', array(
	    'selector' => '.payment-icons',
	    'settings' => array('payment_icons', 'payment_icons_custom'),
	    'container_inclusive' => true,
	    'render_callback' => function() {
	        return do_shortcode('[ux_payment_icons]');
	    }
	) );
	/*
	$wp_customize->selective_refresh->add_partial( 'catalog_mode_product', array(
	    'selector' => '.catalog-product-text',
	    'settings' => array('catalog_mode_product'),
	    'container_inclusive' => true,
	    'render_callback' => function() {
	        return flatsome_catalog_mode_product();
	     }
	) );

	$wp_customize->selective_refresh->add_partial( 'catalog_mode_lightbox', array(
	    'selector' => '.off-canvas .catalog-product-text',
	    'settings' => array('catalog_mode_lightbox'),
	    'container_inclusive' => true,
	    'render_callback' => function() {
	        return flatsome_catalog_mode_lightbox();
	     }
	) );

	$wp_customize->selective_refresh->add_partial( 'catalog_mode_header', array(
		    'selector' => '.html.cart-replace',
		    'settings' => array('catalog_mode_header'),
		    'container_inclusive' => true,
		    'render_callback' => function() {
		        return get_template_part('template-parts/header/partials/element','cart-replace');
		     }
		) );
	 */
	$wp_customize->selective_refresh->add_partial( 'refresh_css_shop', array(
	    'selector' => 'head > style#custom-css',
	    'container_inclusive' => true,
	    'settings' => array('color_new_bubble','color_checkout','color_sale','color_review'),
	    'render_callback' => function() {
	        return flatsome_custom_css();
	    },
	) );
}
add_action( 'customize_register', 'flatsome_refresh_shop_partials' );
