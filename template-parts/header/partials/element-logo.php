<!-- Header logo -->
<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
    <?php if(flatsome_option('site_logo')){
      $logo_height = get_theme_mod('header_height',90);
      $logo_width = get_theme_mod('logo_width', 200);
      $site_title = esc_attr( get_bloginfo( 'name', 'display' ) );
      if(get_theme_mod('site_logo_sticky')) echo '<img width="'.$logo_width.'" height="'.$logo_height.'" src="'.get_theme_mod('site_logo_sticky').'" class="header-logo-sticky" alt="'.$site_title.'"/>';
      echo '<img width="'.$logo_width.'" height="'.$logo_height.'" src="'.flatsome_option('site_logo').'" class="header_logo header-logo" alt="'.$site_title.'"/>';
      if(!get_theme_mod('site_logo_dark')) echo '<img  width="'.$logo_width.'" height="'.$logo_height.'" src="'.flatsome_option('site_logo').'" class="header-logo-dark" alt="'.$site_title.'"/>';
      if(get_theme_mod('site_logo_dark')) echo '<img  width="'.$logo_width.'" height="'.$logo_height.'" src="'.get_theme_mod('site_logo_dark').'" class="header-logo-dark" alt="'.$site_title.'"/>';
    } else {
    bloginfo( 'name' );
  	}
  ?>
</a>
<?php
if(get_theme_mod('site_logo_slogan')){
	echo '<p class="logo-tagline">'.get_bloginfo('description').'</p>';
}
?>
