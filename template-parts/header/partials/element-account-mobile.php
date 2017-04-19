<?php $icon_style = flatsome_option('account_icon_style'); ?>
<li class="account-item has-icon">
<?php if($icon_style && $icon_style !== 'image' && $icon_style !== 'plain') echo '<div class="header-button">'; ?>
	<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"
	class="account-link-mobile <?php echo get_flatsome_icon_class($icon_style, 'small');?>" title="<?php _e('My account', 'woocommerce'); ?>">
	  <?php echo get_flatsome_icon('icon-user'); ?>
	</a><!-- .account-link -->
<?php if($icon_style && $icon_style !== 'image' && $icon_style !== 'plain') echo '</div>'; ?>
</li>
