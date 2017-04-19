<?php
$is_facebook_login = in_array( 'nextend-facebook-connect/nextend-facebook-connect.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
$is_google_login = in_array( 'nextend-google-connect/nextend-google-connect.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );

$login_text = flatsome_option('facebook_login_text');
$login_bg = flatsome_option('facebook_login_bg');
$login_bg = $login_bg ? 'style="background-image:url('.do_shortcode($login_bg).')"' : '';
?>

<div class="my-account-header page-title normal-title
	<?php if($login_bg) echo 'dark featured-title'; ?>">

	<?php if($login_bg) { ?>
	<div class="page-title-bg fill bg-fill" <?php echo $login_bg; ?>>
		<div class="page-title-bg-overlay fill"></div>
	</div>
	<?php } ?>

	<div class="page-title-inner flex-row  container">
	  <div class="flex-col flex-grow <?php if(get_theme_mod('logo_position') == 'center') { echo 'text-center'; } else {echo 'medium-text-center'; } ?>">
	  		<?php if(is_user_logged_in()){?>
  				<h1 class="uppercase mb-0"><?php the_title(); ?></h1>
			<?php } // Loggeed In
			else { ?>

			<div class="text-center social-login">
			<?php if(!$is_facebook_login && !$is_google_login) echo '<h1 class="uppercase mb-0">'.get_the_title().'</h1>'; ?>

			<?php if( $is_facebook_login && get_option('woocommerce_enable_myaccount_registration')=='yes' && !is_user_logged_in())  { ?>
			<a href="<?php echo wp_login_url(); ?>?loginFacebook=1&redirect=<?php echo the_permalink(); ?>"
			class="button social-button large facebook circle"
			onclick="window.location = '<?php echo wp_login_url(); ?>?loginFacebook=1&redirect='+window.location.href; return false;"><i class="icon-facebook"></i>
			<span><?php _e('Login with <strong>Facebook</strong>','flatsome'); ?></span></a>
		 	<?php } ?>

		 	<?php if($is_google_login && get_option('woocommerce_enable_myaccount_registration')=='yes' && !is_user_logged_in())  { ?>

			<a class="button social-button large google-plus circle"
				href="<?php echo wp_login_url(); ?>?loginGoogle=1&redirect=<?php echo the_permalink(); ?>"
				onclick="window.location = '<?php echo wp_login_url(); ?>?loginGoogle=1&redirect='+window.location.href; return false;">
			<i class="icon-google-plus"></i>
			<span><?php _e('Login with <strong>Google</strong>','flatsome'); ?></span></a>
		 	<?php } ?>

		 	<?php if($login_text) { ?><p><?php echo do_shortcode($login_text); ?></p><?php } ?>
		 	</div>

		 	<?php }?>
	  </div><!-- .flex-left -->
	</div><!-- flex-row -->
</div><!-- .page-title -->
