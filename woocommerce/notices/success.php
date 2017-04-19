<?php
/**
 * Show messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! $messages ){
	return;
}
?>
<div class="woocommerce-messages medium-text-center">
	<div class="message-wrapper">
		<?php foreach ( $messages as $message ) : ?>
			<div class="woocommerce-message message-container container success-color">
				<?php echo get_flatsome_icon('icon-checkmark'); ?>
				<?php echo wp_kses_post( $message ); ?>
			</div>
		<?php endforeach; ?>
		<?php if(is_product() && get_theme_mod('cart_dropdown_show', 1)) { ?>
	 	   <span class="added-to-cart" data-timer=""></span>
		<?php } ?>
	</div>
</div>
