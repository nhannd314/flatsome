<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

$upsells = woocommerce_version_check('3.0.0') ?  $product->get_upsell_ids() :  $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) {
	return;
}

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => '999',
	'orderby'             => '',
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->get_id() ),
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

if ( $products->have_posts() ) : ?>

	<aside class="widget widget-upsell">
		<h3 class="widget-title shop-sidebar">
      <?php _e( 'You may also like&hellip;', 'woocommerce' ) ?>
      <div class="is-divider small"></div>
    </h3>

		<!-- Upsell List style -->
		<ul class="product_list_widget">
		<?php while ( $products->have_posts() ) : $products->the_post(); ?>
			<?php wc_get_template_part( 'content', 'product-small' ); ?>
			<?php endwhile; // end of the loop. ?>
		</ul><!-- row -->
	</aside>

<?php endif;

wp_reset_postdata();
