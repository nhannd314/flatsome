<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>
<div class="product-page-accordian">
	<div class="accordion" rel="1">
		<?php foreach ( $tabs as $key => $tab ) : ?>
		<div class="accordion-item">
			<a class="accordion-title plain" href="javascript:void();">
				<button class="toggle"><i class="icon-angle-down"></i></button>
				<?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?>
			</a>
			<div class="accordion-inner">
					<?php call_user_func( $tab['callback'], $key, $tab ) ?>
			</div>
		</div><!-- accordion-item -->
		<?php endforeach; ?>
	</div>
</div>
<?php endif; ?>