<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see       https://docs.woocommerce.com/document/template-structure/
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

// Fallback to old
if(!woocommerce_version_check('3.0.0')){
  return wc_get_template_part( 'single-product/related-old');
}

// Get Type
$type = get_theme_mod('related_products');
if($type == 'hidden') return;
if($type == 'grid') $type = 'row';

// Disable slider if less than selected products pr row.
if ( sizeof( $related_products ) < (flatsome_option('related_products_pr_row')+1) ) {
  $type = 'row';
}

$repater['type'] = $type;
$repater['columns'] = flatsome_option('related_products_pr_row');
$repater['slider_style'] = 'reveal';
$repater['row_spacing'] = 'small';


if ( $related_products ) : ?>

  <div class="related related-products-wrapper product-section">

    <h3 class="product-section-title product-section-title-related pt-half pb-half uppercase">
      <?php esc_html_e( 'Related products', 'woocommerce' ); ?>
    </h3>

      <?php echo get_flatsome_repeater_start($repater); ?>

      <?php foreach ( $related_products as $related_product ) : ?>

        <?php
          $post_object = get_post( $related_product->get_id() );

          setup_postdata( $GLOBALS['post'] =& $post_object );

          wc_get_template_part( 'content', 'product' ); ?>

      <?php endforeach; ?>

      <?php echo get_flatsome_repeater_end($repater); ?>

  </div>

<?php endif;

wp_reset_postdata();
