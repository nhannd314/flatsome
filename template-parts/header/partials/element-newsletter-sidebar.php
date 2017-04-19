<?php
	$label = get_theme_mod('header_newsletter_label','Newsletter');
	$title = get_theme_mod('header_newsletter_title','Sign up for Newsletter');
?>
<li class="header-newsletter-item has-icon">

  <a href="#header-newsletter-signup" class="tooltip" title="<?php echo $title; ?>">

    <i class="icon-envelop"></i>
    <span class="header-newsletter-title">
      <?php echo $label; ?>
    </span>
  </a><!-- .newsletter-link -->

</li>