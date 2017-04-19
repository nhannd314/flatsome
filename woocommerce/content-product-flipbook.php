<?php
/**
 * The template for displaying lookbook product style content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version     1.6.4
 */

global $product, $woocommerce_loop, $flatsome_opt;

/* PRODUCT QUICK VIEW HOOKS */
add_action( 'woocommerce_single_product_flipbook_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_flipbook_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_flipbook_summary', 'woocommerce_template_single_meta', 40 );

?>
  <div class="row row-collapse align-middle flip-slide" style="width:100%">
        <div class="large-6 col flip-page-one">
        <div class="featured-product col-inner">
          <a href="<?php the_permalink(); ?>">
                <div class="product-image relative">
                   <div class="front-image">
                    <?php echo get_the_post_thumbnail( $post->ID,  apply_filters( 'single_product_small_thumbnail_size', 'shop_single' )) ?>
                  </div>
                  <?php wc_get_template( 'loop/sale-flash.php' ); ?>
                </div><!-- end product-image -->
          </a>
        </div><!-- end product -->
        </div><!-- large-6 -->
       <div class="large-6 col flip-page-two">
        <div class="product-info col-inner inner-padding">
              <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
              <div class="is-divider medium"></div>
              <?php do_action( 'woocommerce_single_product_flipbook_summary' ); ?>
              <a href="<?php the_permalink(); ?>" class="button"><?php _e( 'Read More', 'woocommerce' ); ?></a>
         </div>
        </div><!-- large-6 -->
</div><!-- row -->
