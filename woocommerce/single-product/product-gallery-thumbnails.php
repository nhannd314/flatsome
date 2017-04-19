<?php

global $post, $product, $woocommerce;

$attachment_ids = woocommerce_version_check('3.0.0') ? $product->get_gallery_image_ids() : $product->get_gallery_attachment_ids();
$thumb_count = count($attachment_ids)+1;

// Disable thumbnails if there is only one extra image.
if($thumb_count == 1) return;

$rtl = 'false';

if(is_rtl()) $rtl = 'true';

$thumb_cell_align = "left";

if ( $attachment_ids ) {
  $loop     = 0;
  $columns  = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );

  $gallery_class = array('product-thumbnails','thumbnails');

  if($thumb_count <= 5){
    $gallery_class[] = 'slider-no-arrows';
  }

  $gallery_class[] = 'slider row row-small row-slider slider-nav-small small-columns-4';
  ?>

  <div class="<?php echo implode(' ', $gallery_class); ?>"
    data-flickity-options='{
              "cellAlign": "<?php echo $thumb_cell_align;?>",
              "wrapAround": false,
              "autoPlay": false,
              "prevNextButtons":true,
              "asNavFor": ".product-gallery-slider",
              "percentPosition": true,
              "imagesLoaded": true,
              "pageDots": false,
              "rightToLeft": <?php echo $rtl; ?>,
              "contain": true
          }'
    ><?php


    if ( has_post_thumbnail() ) : ?>
      <div class="col is-nav-selected first"><a><?php echo get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) ) ?></a></div>
    <?php endif;

    foreach ( $attachment_ids as $attachment_id ) {

      $classes = array( '' );
      $image_title  = esc_attr( get_the_title( $attachment_id ) );
      $image_caption  = esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );
      $image_class = esc_attr( implode( ' ', $classes ) );

      $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $attr = array(
        'title' => $image_title,
        'alt' => $image_title
        ) );

      echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class="col"><a class="%s" title="%s" >%s</a></div>', $image_class, $image_caption, $image ), $attachment_id, $post->ID, $image_class );

      $loop++;
    }
  ?>
  </div><!-- .product-thumbnails -->
  <?php
} ?>
