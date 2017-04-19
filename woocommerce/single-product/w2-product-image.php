<?php

/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

// Get wide image
if(flatsome_option('product_layout') == 'gallery-wide'){
	wc_get_template_part( 'single-product/w2-product-image', 'wide' );
	return;
}

// Get vertical gallery styøe
if(flatsome_option('product_image_style') == 'vertical'){
	wc_get_template_part( 'single-product/w2-product-image', 'vertical' );
	return;
}

$slider_classes = array('slider','slider-nav-small','mb-half');

// Image Zoom
if(get_theme_mod('product_zoom', 0)){
  	$slider_classes[] = 'has-image-zoom';
}

$rtl = 'false';
if(is_rtl()) $rtl = 'true';

$image_size = 'shop_single';

?>

<?php do_action('flatsome_before_product_images'); ?>
<div class="product-images product-images-old images relative has-hover">

		<?php do_action('flatsome_sale_flash'); ?>

		<div class="image-tools absolute top show-on-hover right z-3">
			<?php do_action('flatsome_product_image_tools_top'); ?>
		</div>

		<div class="product-gallery-slider product-gallery-slider-old <?php echo implode(' ', $slider_classes); ?>"
				data-flickity-options='{
		            "cellAlign": "center",
		            "wrapAround": true,
		            "autoPlay": false,
		            "prevNextButtons":true,
		            "adaptiveHeight": true,
		            "percentPosition": true,
		            "imagesLoaded": true,
		            "lazyLoad": 1,
		            "dragThreshold" : 15,
		            "pageDots": false,
		            "rightToLeft": <?php echo $rtl; ?>
		        }'>

		<?php
			if ( has_post_thumbnail() ) {

				$image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );
				$image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;
				$image_link  	= wp_get_attachment_url( get_post_thumbnail_id() );
				$image       	= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', $image_size), array(
					'title'	=> $image_title,
					'alt'	=> $image_title
					) );

				$gallery = '[product-gallery]';

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="slide first"><a href="%s" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a></div>', $image_link, $image_caption, $image ), $post->ID );

				// Add additional images
				do_action('flatsome_single_product_images');

			} else {

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );

			}
		?>

		</div><!-- .product-gallery-slider -->


		<div class="image-tools absolute bottom left z-3">
			<?php do_action('flatsome_product_image_tools_bottom'); ?>
		</div>

</div><!-- .product-images -->
<?php do_action('flatsome_after_product_images'); ?>

<?php

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();
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
