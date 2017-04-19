<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Repeater styles
$type = flatsome_option('related_products');
if($type == 'hidden') return;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

if(flatsome_option('max_related_products')) $posts_per_page = flatsome_option('max_related_products');

$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) === 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $posts_per_page,
	'post__in'             => $related,
	'post__not_in'         => array( $product->get_id() )
) );

$products = new WP_Query( $args );

if($type == 'grid') $type = 'row';

// Disable slider if less than selected products pr row.
if ( sizeof( $related ) < (flatsome_option('related_products_pr_row')+1) ) {
	$type = 'row';
}

$repater['type'] = $type;
$repater['columns'] = flatsome_option('related_products_pr_row');
$repater['slider_style'] = 'reveal';
$repater['row_spacing'] = 'small';

if ( $products->have_posts() ) : ?>

	<div class="related related-products-wrapper product-section">

		<h3 class="product-section-title product-section-title-related pt-half pb-half uppercase">
      <?php _e( 'Related Products', 'woocommerce' ); ?></h3>

			<?php echo get_flatsome_repeater_start($repater); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

			<?php wc_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

			<?php echo get_flatsome_repeater_end($repater); ?>


	</div><!-- .related-products-wrapper -->

<?php endif;

wp_reset_postdata();
