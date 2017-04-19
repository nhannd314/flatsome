<li>
  <div class="cart-checkout-button header-button">
    <a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="<?php if(is_checkout()){ ?>disabled<?php } ?> button cart-checkout secondary is-small circle" >
      <span class="hide-for-small"><?php _e('Checkout', 'woocommerce'); ?></span>
      <span class="show-for-small">+</span>
    </a>
  </div>
</li>