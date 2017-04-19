<?php
	$icon_style = get_theme_mod('newsletter_icon_style','plain');
	$label = get_theme_mod('header_newsletter_label','Newsletter');
  $title = get_theme_mod('header_newsletter_title','Sign up for Newsletter');
  
  $newsletter_block = get_theme_mod('header_newsletter_block');
  if(!$newsletter_block){
      $sub_title = get_theme_mod('header_newsletter_sub_title','Signup for our newsletter to get notified about sales and new products. Add any text here or remove it.');
      $bg = do_shortcode(get_theme_mod('header_newsletter_bg', flatsome_dummy_image()));
      $height = get_theme_mod('header_newsletter_height','500px');
  }

?>
<li class="header-newsletter-item has-icon">

<?php if($icon_style && $icon_style !== 'plain') echo '<div class="header-button">'; ?>
<a href="#header-newsletter-signup" class="tooltip <?php if($icon_style) echo get_flatsome_icon_class($icon_style, 'small'); ?>" 
  title="<?php echo $title; ?>">
  
  <?php if($icon_style) { ?>
    <i class="icon-envelop"></i>
  <?php } ?>

  <?php if($label) { ?>
    <span class="header-newsletter-title hide-for-medium">
      <?php echo $label; ?>
    </span>
  <?php } ?>
</a><!-- .newsletter-link -->
<?php if($icon_style && $icon_style !== 'plain') echo '</div>'; ?>
<?php if(!$newsletter_block){ ?>
<?php $content = '<h3 class="uppercase">'.$title.'</h3><p class="lead">'.$sub_title.'</p>'.get_theme_mod('header_newsletter_shortcode','[contact-form-7 id="7042" title="Newsletter Vertical"]'); ?>
<?php echo do_shortcode('[lightbox width="700px" padding="0px" id="header-newsletter-signup"][ux_banner bg="'.$bg.'" border="2px 2px 2px 2px" border_color="rgba(255,255,255,.3)" border_style="dashed" border_margin="10px" bg_overlay="rgba(0,0,0,.4)" height="'.$height.'"][text_box animate="fadeInUp" position_x="10" text_align="left" width="50%" width__sm="60%"]'.$content.'[/text_box][/ux_banner][/lightbox]'); ?>
<?php } else { ?>
<?php echo do_shortcode('[lightbox width="700px" padding="0px" id="header-newsletter-signup"]'.do_shortcode('[block id="'.$newsletter_block.'"]').'[/lightbox]'); ?>
<?php } ?>
</li>