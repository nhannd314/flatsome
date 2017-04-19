<?php 
	global $woocommerce;
	function flatsome_checkout_breadcrumb_class($endpoint){
		$classes = array();
		if($endpoint == 'cart' && is_cart() ||
			$endpoint == 'checkout' && is_checkout() && !is_wc_endpoint_url('order-received') ||
			$endpoint == 'order-received' && is_wc_endpoint_url('order-received')) {
			$classes[] = 'current';
		} else{
			$classes[] = 'hide-for-small';
		}
		return implode(' ', $classes);
	}
?>

<div class="checkout-page-title page-title">
	<div class="page-title-inner flex-row medium-flex-wrap container">
	  <div class="flex-col flex-grow medium-text-center">
  	 	 <nav class="breadcrumbs heading-font checkout-breadcrumbs text-center h2 strong">
    	   <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="<?php echo flatsome_checkout_breadcrumb_class('cart'); ?>"><?php _e('Shopping Cart', 'flatsome'); ?></a>
    	   <span class="divider hide-for-small"><?php echo get_flatsome_icon('icon-angle-right');?></span>
    	   <a href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" class="<?php echo flatsome_checkout_breadcrumb_class('checkout') ?>"><?php _e('Checkout details', 'flatsome'); ?></a>
    	   <span class="divider hide-for-small"><?php echo get_flatsome_icon('icon-angle-right');?></span>
    	   <a href="#" class="no-click <?php echo flatsome_checkout_breadcrumb_class('order-received'); ?>"><?php _e('Order Complete', 'flatsome'); ?></a>
		 </nav>
	  </div><!-- .flex-left -->
	</div><!-- flex-row -->
</div><!-- .page-title -->
