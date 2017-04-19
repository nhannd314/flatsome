<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
global $woocommerce_loop;
$cols = empty($woocommerce_loop['columns']) ? null : $woocommerce_loop['columns'];
?>
<div class="products <?php echo flatsome_product_row_classes($cols); ?>">