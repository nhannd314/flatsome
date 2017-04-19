<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Get sections instead of tabs if set
if(get_theme_mod('product_display') == 'sections'){
	wc_get_template_part( 'single-product/tabs/sections' );
	return;
}

// Get accordian instead of tabs if set
if(get_theme_mod('product_display') == 'accordian'){
	wc_get_template_part( 'single-product/tabs/accordian' );
	return;
}


/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );
$count_tabs = 0;
$count_panel = 0;

if ( ! empty( $tabs ) ) : ?>

	<div class="woocommerce-tabs tabbed-content">
		<ul class="product-tabs nav small-nav-collapse tabs <?php flatsome_product_tabs_classes() ?>">
			<?php 
				foreach ( $tabs as $key => $tab ) : ?>
				<li class="<?php echo esc_attr( $key ); ?>_tab  <?php if($count_tabs == 0) echo 'active';?>">
					<a href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
				</li>
			<?php $count_tabs++; endforeach; ?>
		</ul>
		<div class="tab-panels">
		<?php foreach ( $tabs as $key => $tab ) : ?>

			<div class="panel entry-content <?php if($count_panel == 0) echo 'active';?>" id="tab-<?php echo $key ?>">
				<?php call_user_func( $tab['callback'], $key, $tab ) ?>
			</div>

		<?php $count_panel++; endforeach; ?>
		</div><!-- .tab-panels -->
	</div><!-- .tabbed-content -->

<?php endif; ?>