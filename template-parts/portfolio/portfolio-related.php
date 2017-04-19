<?php
	// RELATED PORTFOLIO
  if(get_theme_mod('portfolio_related',1) == 0) return;

	$get_cat = get_the_terms( get_the_ID(), 'featured_item_category', '', ', ', '' );

	$category = '';
	if($get_cat) $category = current($get_cat)->ID;

    // Height
  $height = '';
  if(get_theme_mod('portfolio_height')) $height = get_theme_mod('portfolio_height');

  echo do_shortcode('<div class="portfolio-related">[ux_portfolio image_height="'.$height.'" class="portfolio-related" exclude="'.get_the_ID().'" cat="'.$category.'"]</div>');
?>
