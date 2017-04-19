<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

global $post, $product;
$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
$thumbnail_post    = get_post( $post_thumbnail_id );
$image_title       = $thumbnail_post->post_content;
$placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
  'woocommerce-product-gallery',
  'woocommerce-product-gallery--' . $placeholder,
  'woocommerce-product-gallery--columns-' . absint( $columns ),
  'images',
) );

$slider_classes = array('product-gallery-slider','slider','slider-nav-small','mb-0');
$rtl = 'false';
if(is_rtl()) $rtl = 'true';

// Image Zoom
if(get_theme_mod('product_zoom', 0)){
  $slider_classes[] = 'has-image-zoom';
}

?>
<div class="row row-small">
<div class="col large-10">
<?php do_action('flatsome_before_product_images'); ?>

<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?> relative mb-half has-hover" data-columns="<?php echo esc_attr( $columns ); ?>">

  <?php do_action('flatsome_sale_flash'); ?>

  <div class="image-tools absolute top show-on-hover right z-3">
    <?php do_action('flatsome_product_image_tools_top'); ?>
  </div>

  <figure class="woocommerce-product-gallery__wrapper <?php echo implode(' ', $slider_classes); ?>"
        data-flickity-options='{
                "cellAlign": "center",
                "wrapAround": true,
                "autoPlay": false,
                "prevNextButtons":true,
                "adaptiveHeight": true,
                "imagesLoaded": true,
                "lazyLoad": 1,
                "dragThreshold" : 15,
                "pageDots": false,
                "rightToLeft": <?php echo $rtl; ?>
       }'>
    <?php
    $attributes = array(
      'title'             => $image_title,
      'data-large_image'        => $full_size_image[0],
      'data-large_image_width'  => $full_size_image[1],
      'data-large_image_height' => $full_size_image[2],
    );

    if ( has_post_thumbnail() ) {
      $html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="first slide woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
      $html .= get_the_post_thumbnail( $post->ID, 'shop_single', $attributes );
      $html .= '</a></div>';
    } else {
      $html  = '<div class="woocommerce-product-gallery__image--placeholder">';
      $html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
      $html .= '</div>';
    }

    echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );

    do_action( 'woocommerce_product_thumbnails' );
    ?>
  </figure>

  <div class="image-tools absolute bottom left z-3">
    <?php do_action('flatsome_product_image_tools_bottom'); ?>
  </div>
</div>
<?php do_action('flatsome_after_product_images'); ?>
</div>

<?php

  $attachment_ids = $product->get_gallery_image_ids();
  $thumb_count = count($attachment_ids)+1;

  $rtl = 'false';

  if(is_rtl()) $rtl = 'true';

  $thumb_cell_align = "left";

  if ( $attachment_ids ) {
    $loop     = 0;
    $gallery_class = array('product-thumbnails','thumbnails');

    if($thumb_count <= 5){
      $gallery_class[] = 'slider-no-arrows';
    }

    $gallery_class[] = 'slider row row-small row-slider slider-nav-small small-columns-4';

    ?>
    <div class="col large-2 large-col-first vertical-thumbnails pb-0">

    <div class="<?php echo implode(' ', $gallery_class); ?>"
      data-flickity-options='{
                "cellAlign": "left",
                "wrapAround": false,
                "autoPlay": false,
                "prevNextButtons": false,
                "asNavFor": ".product-gallery-slider",
                "percentPosition": true,
                "imagesLoaded": true,
                "pageDots": false,
                "rightToLeft": <?php echo $rtl; ?>,
                "contain":  true
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
    </div><!-- .col -->
<?php } ?>
</div>
