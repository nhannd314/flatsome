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
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $woocommerce_loop;

// Fallback to WC.2x Versions.
if(!woocommerce_version_check('3.0.0') ) {
  wc_get_template( 'woocommerce/single-product/w2-up-sells.php' );
  return;
}

if ( $upsells ) : ?>
  <?php if(get_theme_mod('product_upsell','sidebar') !== 'sidebar') {

      $type = get_theme_mod('related_products','slider');

      if($type == 'grid') $type = 'row';

      $repater['type'] = $type;
      $repater['columns'] = get_theme_mod('related_products_pr_row','4');
      $repater['slider_style'] = 'reveal';
      $repater['row_spacing'] = 'small';

      if(count($upsells) < $repater['columns']){
        $repater['type'] = 'row';
      }
  ?>
	<div class="up-sells upsells upsells-wrapper product-section">

  		<h3 class="product-section-title product-section-title-upsell pt-half pb-half uppercase">
  			<?php _e( 'You may also like&hellip;', 'woocommerce' ) ?>
  		</h3>

			<?php echo get_flatsome_repeater_start($repater); ?>

      <?php foreach ( $upsells as $upsell ) : ?>

        <?php
          $post_object = get_post( $upsell->get_id() );

          setup_postdata( $GLOBALS['post'] =& $post_object );

          wc_get_template_part( 'content', 'product' ); ?>

      <?php endforeach; ?>

			<?php echo get_flatsome_repeater_end($repater); ?>

	</div>
  <?php } else { ?>

  <aside class="widget widget-upsell">

    <h3 class="widget-title shop-sidebar">
      <?php _e( 'You may also like&hellip;', 'woocommerce' ) ?>
      <div class="is-divider small"></div>
    </h3>

    <!-- Upsell List style -->
    <ul class="product_list_widget">
    <?php foreach ( $upsells as $upsell ) : ?>

      <?php
          $post_object = get_post( $upsell->get_id() );

          setup_postdata( $GLOBALS['post'] =& $post_object );

          wc_get_template_part( 'content', 'product-small' ); ?>

      <?php endforeach; ?>
    </ul><!-- row -->
  </aside>

  <?php } ?>

<?php endif;

wp_reset_postdata();
