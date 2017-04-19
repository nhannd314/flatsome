<?php $icon_style = get_theme_mod('account_icon_style'); ?>
<?php if(is_woocommerce_activated()){ ?>
<li class="account-item has-icon
  <?php if(is_account_page()) echo ' active'; ?>
  <?php if ( is_user_logged_in() ) { ?> has-dropdown<?php } ?>"
>
<?php if($icon_style && $icon_style !== 'image' && $icon_style !== 'plain') echo '<div class="header-button">'; ?>

<?php if ( is_user_logged_in() ) { ?>
<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="account-link account-login
  <?php if($icon_style && $icon_style !== 'image') echo get_flatsome_icon_class($icon_style, 'small'); ?>"
  title="<?php _e('My account', 'woocommerce'); ?>">

  <?php if(get_theme_mod('header_account_title',1)) { ?>
  <span class="header-account-title">
    <?php _e('My account', 'woocommerce'); ?>
  </span>
  <?php } ?>

  <?php if($icon_style == 'image'){
    echo '<i class="image-icon circle">'.get_avatar(get_current_user_id()).'</i>';
   } else  if($icon_style){
    echo get_flatsome_icon('icon-user');
   } ?>

</a><!-- .account-link -->

<?php } else { ?>
<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"
    class="nav-top-link nav-top-not-logged-in <?php if($icon_style && $icon_style !== 'image') echo get_flatsome_icon_class($icon_style, 'small'); ?>"
    <?php if(get_theme_mod('account_login_style','lightbox') == 'lightbox') echo 'data-open="#login-form-popup"'; ?>
  >
  <?php if(get_theme_mod('header_account_title', 1)) { ?>
  <span>
    <?php _e('Login', 'woocommerce'); ?>
    <?php if(get_theme_mod('header_account_register')){
        echo ' / '.__('Register', 'woocommerce');
      } ?>
  </span>
  <?php } else {
        echo get_flatsome_icon('icon-user');
    } ?>

</a><!-- .account-login-link -->
<?php } ?>

<?php if($icon_style && $icon_style !== 'image' && $icon_style !== 'plain') echo '</div>'; ?>

<?php
// Show Dropdown for logged in users
if ( is_user_logged_in() ) { ?>
<ul class="nav-dropdown  <?php flatsome_dropdown_classes(); ?>">
    <?php wc_get_template('myaccount/account-links.php'); ?>
</ul>
<?php } ?>

</li>
<?php } else {
  echo '<li><a class="element-error tooltip" title="WooCommerce needed">-</a></li>'; }
?>
