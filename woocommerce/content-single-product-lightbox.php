<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;
$attachment_ids = $product->get_gallery_attachment_ids();

// run quick view hooks
do_action('wc_quick_view_before_single_product');

?>

<div class="product-quick-view-container">
<div class="row row-collapse mb-0" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

  <div class="product-gallery large-6 col">
    <div class="slider slider-show-nav product-gallery-slider main-images mb-0">
      <?php
        if ( has_post_thumbnail() ) {

          $image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
          $image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
          $image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
            'title' => $image_title
            ) );

          $attachment_count = count( $product->get_gallery_attachment_ids() );

          if ( $attachment_count > 0 ) {
            $gallery = '[product-gallery]';
          } else {
            $gallery = '';
          }

          echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="slide first">%s</div>', $image ), $post->ID );

          // additional
          $attachment_ids =  $product->get_gallery_attachment_ids();
          if ( $attachment_ids ) {
              $loop = 0;
              $columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

              foreach ( $attachment_ids as $attachment_id ) {
                  $image_title  = esc_attr( get_the_title( $attachment_id ) );
                  $image =  wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array('title' => $image_title,'alt' => $image_title) );
                  echo apply_filters( 'woocommerce_single_product_image_html',sprintf( '<div class="slide">%s</div>', $image ), $attachment_id);
              }
          }

        } else {

          echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );

        }
    ?>
  </div><!-- product gallery slider -->


  <?php
    do_action( 'woocommerce_before_single_product_lightbox_summary' );
  ?>
  </div>

  <div class="product-info summary large-6  col entry-summary" style="font-size:90%;">
    <div class="product-lightbox-inner" style="padding: 30px;">
    <a class="plain" href="<?php echo the_permalink();?>"><h1><?php the_title(); ?></h1></a>
    <div class="is-divider small"></div>

    <?php
      do_action( 'woocommerce_single_product_lightbox_summary' );
    ?>

    </div>
  </div><!-- .summary -->

</div><!-- #product-<?php the_ID(); ?> -->
</div><!-- product-container -->
</div>

<?php do_action('wc_quick_view_after_single_product'); ?>
