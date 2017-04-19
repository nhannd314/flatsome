<?php if(is_woocommerce_activated()){ ?>
<?php global $woocommerce;
  
  // Get Cart replacement for catalog_mode
  if(get_theme_mod('catalog_mode')) { get_template_part('template-parts/header/partials/element','cart-replace'); return;}
  $cart_style = get_theme_mod('header_cart_style','dropdown');
  $custom_cart_content = get_theme_mod('html_cart_header');
  $icon_style = get_theme_mod('cart_icon_style');
  $icon = get_theme_mod('cart_icon','basket');
  $cart_title = get_theme_mod('header_cart_title', 1);
  $cart_total = get_theme_mod('header_cart_total', 1)
?>
<li class="cart-item has-icon
<?php if($cart_style == 'dropdown') { ?> has-dropdown<?php } ?>">
<?php if($icon_style && $icon_style !== 'plain') { ?><div class="header-button"><?php } ?>

<?php if($cart_style !== 'off-canvas') { ?>
<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('Cart', 'woocommerce'); ?>" class="header-cart-link <?php echo get_flatsome_icon_class($icon_style, 'small'); ?>">

<?php } else if($cart_style == 'off-canvas') { ?>

<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="header-cart-link off-canvas-toggle nav-top-link <?php echo get_flatsome_icon_class($icon_style, 'small'); ?>" data-open="#cart-popup" data-class="off-canvas-cart" title="<?php _e('Cart', 'woocommerce'); ?>" data-pos="right">

<?php } ?>
  
<?php  if($cart_total || $cart_title) { ?>
<span class="header-cart-title">
  <?php if($cart_title) { ?> <?php _e('Cart', 'woocommerce'); ?> <?php } ?>
  <?php /* divider */ if($cart_total && $cart_title) { ?>/<?php } ?>
  <?php if($cart_total) { ?>
    <span class="cart-price"><?php echo $woocommerce->cart->get_cart_subtotal(); ?></span>
  <?php } ?>
</span>
<?php } ?>

<?php
if(get_theme_mod('custom_cart_icon')) { ?>
  <span class="image-icon header-cart-icon" data-icon-label="<?php echo $woocommerce->cart->cart_contents_count; ?>">
    <img class="cart-img-icon" alt="<?php _e('Cart', 'woocommerce'); ?>" src="<?php echo do_shortcode(get_theme_mod('custom_cart_icon')); ?>"/> 
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

<?php if($cart_style == 'dropdown') { ?>
 <ul class="nav-dropdown <?php flatsome_dropdown_classes(); ?>">
    <li class="html widget_shopping_cart">
      <div class="widget_shopping_cart_content">
        <?php echo woocommerce_mini_cart(); ?>
      </div>
    </li>
    <?php if($custom_cart_content){
      echo '<li class="html">'.do_shortcode($custom_cart_content).'</li>';
      }
    ?>
 </ul><!-- .nav-dropdown -->
<?php }  ?>

<?php if($cart_style == 'off-canvas') { ?>

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
<?php } else {
  echo '<li><a class="element-error tooltip" title="WooCommerce needed">-</a></li>'; }
?>