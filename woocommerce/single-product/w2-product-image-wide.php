<?php

/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

$attachment_ids = $product->get_gallery_attachment_ids();

$slider_classes = array('product-gallery-slider-old','slider','slider-nav-circle','mb-half','slider-style-container','slider-nav-light',);

$rtl = 'false';
if(is_rtl()) $rtl = 'true';

$image_size = 'large';


?>

<?php do_action('flatsome_before_product_images'); ?>
<div class="product-images slider-wrapper images relative has-hover">

		<div class="absolute left right">
			<div class="container relative">
				<?php do_action('flatsome_sale_flash'); ?>
			</div>
		</div>

		<div class="product-gallery-slider slider-load-first no-overflow <?php echo implode(' ', $slider_classes); ?>"
					data-flickity-options='{
			            "cellAlign": "center",
			            "wrapAround": true,
			            "autoPlay": false,
			            "prevNextButtons":true,
			            "percentPosition": true,
			            "adaptiveHeight": true,
			            "imagesLoaded": true,
			            "dragThreshold" : 10,
			            "lazyLoad": 1,
			            "pageDots": true,
			            "rightToLeft": <?php echo $rtl; ?>
			        }'
			        style="background-color: #333;"
		>
		<?php
			if ( has_post_thumbnail() ) {

				$image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );
				$image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;
				$image_link  	= wp_get_attachment_url( get_post_thumbnail_id() );
				$image  = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', $image_size), array(
					'title'	=> $image_title,
					'alt'	=> $image_title
					) );

				$attachment_count = count( $product->get_gallery_attachment_ids() );

				if ( $attachment_count > 0 ) {
					$gallery = '[product-gallery]';
				} else {
					$gallery = '';
				}

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="slide first"><a href="%s" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a></div>', $image_link, $image_caption, $image ), $post->ID );

				// Add additional images
				do_action('flatsome_single_product_images');

			} else {

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );

			}
		?>

		</div><!-- .product-gallery-slider -->
		<div class="loading-spin centered dark"></div>


		<div class="absolute bottom left right">
			<div class="container relative image-tools">
				<div class="image-tools absolute bottom right z-3">
					<?php do_action('flatsome_product_image_tools_bottom'); ?>
					<?php do_action('flatsome_product_image_tools_top'); ?>
				</div>
			</div>
		</div>


</div><!-- .product-images -->
<?php do_action('flatsome_after_product_images'); ?>
