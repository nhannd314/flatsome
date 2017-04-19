<div class="product-container">

	<div class="product-gallery product-gallery-wide">
	<?php
		/**
		 * woocommerce_before_single_product_summary hook
		 *
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>
	</div>

	<div class="row">
	<div class="col large-12">
		<div class="product-info">
			<div class="row">
				<div class="large-7 col">
					<div class="entry-summary <?php flatsome_product_summary_classes();?>">
						<?php
							 woocommerce_breadcrumb();
							 woocommerce_template_single_title();
							 woocommerce_template_single_rating();
							 woocommerce_template_single_excerpt();

							 if(get_theme_mod('product_info_share', 1)){
							 	woocommerce_template_single_sharing();
							 }
						?>
					</div>
				</div>
				<div class="large-5 col">
					<div class="is-well add-to-cart-wrapper">
						<?php

							if(!flatsome_option('catalog_mode')){
								woocommerce_template_single_price();
								woocommerce_template_single_add_to_cart();
							} else {
								if(flatsome_option('catalog_mode_prices')){
									woocommerce_template_single_price();
								}
								echo '<div class="catalog-product-text pb relative">';
							    echo do_shortcode(flatsome_option('catalog_mode_product'));
							    echo '</div>';
							}
							woocommerce_template_single_meta();
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="product-footer" style="margin-top: 30px;">
				<?php
					/**
					 * woocommerce_after_single_product_summary hook
					 *
					 * @hooked woocommerce_output_product_data_tabs - 10
					 * @hooked woocommerce_upsell_display - 15
					 * @hooked woocommerce_output_related_products - 20
					 */
					do_action( 'woocommerce_after_single_product_summary' );
				?>
		</div><!-- product-footer -->
	</div><!-- .large-12 -->
	</div><!-- .row -->
  
</div><!-- product-container -->
