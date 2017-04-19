<?php
/**
 * Show error messages
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

<div class="woocommerce-messages alert-color medium-text-center">
	<div class="message-wrapper">
		<ul class="woocommerce-error">
			<?php foreach ( $messages as $message ) : ?>
				<li><div class="message-container container"><span class="message-icon icon-close"></span> <?php echo wp_kses_post( $message ); ?></div></li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
