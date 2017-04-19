<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );

// Add Custom Shop Content if set
if(is_shop() && flatsome_option('html_shop_page_content') && $wp_query->query_vars['paged'] < 1){
   	echo do_shortcode('<div class="shop-page-content">'.flatsome_option('html_shop_page_content').'</div>');
} else{
	wc_get_template_part( 'layouts/category', flatsome_option('category_sidebar'));
}

get_footer( 'shop' );

?>
