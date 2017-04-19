<?php if(is_woocommerce_activated()){ ?>
<?php global $woocommerce;
  
  // Get Cart replacement for catalog_mode
  if(flatsome_option('catalog_mode')) { get_template_part('template-parts/header/partials/element','cart-replace'); return;}
  $cart_style = flatsome_option('header_cart_style');
  $custom_cart_content = flatsome_option('html_cart_header');
  $icon_style = flatsome_option('cart_icon_style');
  $icon = flatsome_option('cart_icon');
?>
<li class="cart-item has-icon">

<?php if($icon_style && $icon_style !== 'plain') { ?><div class="header-button"><?php } ?>

<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="header-cart-link off-canvas-toggle nav-top-link <?php echo get_flatsome_icon_class($icon_style, 'small'); ?>" data-open="#cart-popup" data-class="off-canvas-cart" title="<?php _e('Cart', 'woocommerce'); ?>" data-pos="right">

<?php
if(flatsome_option('custom_cart_icon')) { ?>
  <span class="image-icon header-cart-icon" data-icon-label="<?php echo $woocommerce->cart->cart_contents_count; ?>">
    <img class="cart-img-icon" alt="<?php _e('Cart', 'woocommerce'); ?>" src="<?php echo do_shortcode(flatsome_option('custom_cart_icon')); ?>"/> 
  </span><!-- .cart-img-inner -->
<?php } 
else { ?>
  <?php if(!$icon_style) { ?>
  <span class="cart-icon image-icon">
    <strong><?php echo $woocommerce->cart->cart_contents_count; ?></strong>
  </span> 
  <?php } else { ?>
  <i class="icon-shopping-<?php echo $icon;?>"
    data-icon-label="<?php echo $woocommerce->cart->cart_contents_count; ?>">
  </i>
  <?php } ?>
<?php }  ?>
</a>
<?php if($icon_style && $icon_style !== 'plain') { ?></div><?php } ?>

<?php if($cart_style !== 'off-canvas') { ?>

  <!-- Cart Sidebar Popup -->
  <div id="cart-popup" class="mfp-hide widget_shopping_cart">
  <div class="cart-popup-inner inner-padding">
      <div class="cart-popup-title text-center">
          <h4 class="uppercase"><?php _e('Cart', 'woocommerce'); ?></h4>
          <div class="is-divider"></div>
      </div>
      <div class="widget_shopping_cart_content">
          <?php echo woocommerce_mini_cart(); ?>
      </div>
      <?php if($custom_cart_content) {
        echo '<div class="header-cart-content">'.do_shortcode($custom_cart_content).'</div>'; }
      ?>
       <?php do_action('flatsome_cart_sidebar'); ?>
  </div>
  </div>

<?php } ?>
</li>
<?php } ?>