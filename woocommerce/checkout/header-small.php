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

<nav class="breadcrumbs checkout-breadcrumbs text-left medium-text-center lowercase is-large">
   <i class="icon-lock op-5"></i>
   <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="<?php echo flatsome_checkout_breadcrumb_class('cart'); ?>"><?php _e('Shopping Cart', 'flatsome'); ?></a>
   <span class="divider hide-for-small"><?php echo get_flatsome_icon('icon-angle-right');?></span>
   <a href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" class="<?php echo flatsome_checkout_breadcrumb_class('checkout') ?>"><?php _e('Checkout details', 'flatsome'); ?></a>
   <span class="divider hide-for-small"><?php echo get_flatsome_icon('icon-angle-right');?></span>
   <a href="#" class="no-click <?php echo flatsome_checkout_breadcrumb_class('order-received'); ?>"><?php _e('Order Complete', 'flatsome'); ?></a>
</nav>
