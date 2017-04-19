<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( !empty($breadcrumb) ) {

	do_action('flatsome_before_breadcrumb');

	echo $wrap_before;

	foreach ( $breadcrumb as $key => $crumb ) {

		echo $before;

		if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
			echo '<a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>';
		} else if(!is_product() && !flatsome_option('wc_category_page_title')) {
			echo esc_html( $crumb[0] );
		}

		echo $after;

		// Single product or Active title
		if(is_product() || flatsome_option('wc_category_page_title')){
				$key = $key+1;
				if ( sizeof( $breadcrumb ) > $key+1) {
					echo ' <span class="divider">'.$delimiter.'</span> ';
				}
		} else{
			
		// Category pages
		if ( sizeof( $breadcrumb ) !== $key + 1 ) {
				echo ' <span class="divider">'.$delimiter.'</span> ';
			}
		}

	}

	echo $wrap_after;

	do_action('flatsome_after_breadcrumb');

}