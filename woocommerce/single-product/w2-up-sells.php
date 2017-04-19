<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if(get_theme_mod('product_upsell','sidebar') == 'sidebar') {
  wc_get_template( 'woocommerce/single-product/w2-up-sells-sidebar.php' );
  return;
}

global $product, $woocommerce_loop;

if ( ! $upsells = $product->get_upsells() ) {
	return;
}

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


$type = flatsome_option('related_products');
if($type == 'grid') $type = 'row';

$repater['type'] = $type;
$repater['columns'] = flatsome_option('related_products_pr_row');
$repater['slider_style'] = 'reveal';
$repater['row_spacing'] = 'small';

if ( $products->have_posts() ) : ?>

	<div class="up-sells upsells upsells-wrapper product-section">

  		<h3 class="product-section-title product-section-title-upsell pt-half pb-half uppercase">
  			<?php _e( 'You may also like&hellip;', 'woocommerce' ) ?>
  		</h3>

			<?php echo get_flatsome_repeater_start($repater); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php echo get_flatsome_repeater_end($repater); ?>

	</div>

<?php endif;

wp_reset_postdata();
