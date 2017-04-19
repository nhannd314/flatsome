<?php if(is_woocommerce_activated()){ ?>
<li class="account-item has-icon menu-item">
<?php if ( is_user_logged_in() ) { ?>

<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="account-link account-login" title="<?php _e('My account', 'woocommerce'); ?>">
  <?php if(flatsome_option('account_icon') == 'icon'){
    echo get_flatsome_icon('icon-user');
    } else if(flatsome_option('account_icon') == 'avatar'){
    echo '<i class="image-icon circle">'.get_avatar(get_current_user_id()).'</i>';
    }
  ?>
  <span class="header-account-title">
    <?php _e('My account', 'woocommerce'); ?>
  </span>
</a>

<?php } else { ?>
<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"
    class="nav-top-link nav-top-not-logged-in">
  <?php
    if(flatsome_option('account_icon') == 'icon' || flatsome_option('account_icon') == 'avatar'){ echo get_flatsome_icon('icon-user');
    }
  ?>
  <span class="header-account-title">
    <?php _e('Login', 'woocommerce'); ?>
  </span>
</a><!-- .account-login-link -->
<?php } ?>

<?php
// Show Dropdown for logged in users
if ( is_user_logged_in() ) { ?>
<ul class="children">
    <?php wc_get_template('myaccount/account-links.php'); ?>
</ul>
<?php } ?>
</li>
<?php } else {
  echo 'WooCommerce not Found';
}
?>
