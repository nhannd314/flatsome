<?php $icon_style = get_theme_mod('search_icon_style'); ?>
<?php if(get_theme_mod('header_search_style') !== 'lightbox') { ?>
<li class="header-search header-search-dropdown has-icon has-dropdown menu-item-has-children">
	<?php if($icon_style) { ?><div class="header-button"><?php } ?>
	<a href="#" class="<?php echo get_flatsome_icon_class(flatsome_option('search_icon_style'), 'small'); ?>"><?php echo get_flatsome_icon('icon-search'); ?></a>
	<?php if($icon_style) { ?></div><?php } ?>
	<ul class="nav-dropdown <?php flatsome_dropdown_classes(); ?>">
	 	<?php get_template_part('template-parts/header/partials/element-search-form'); ?>
	</ul><!-- .nav-dropdown -->
</li>
<?php } else if(get_theme_mod('header_search_style') == 'lightbox') { ?>
<li class="header-search header-search-lightbox has-icon">
	<?php if($icon_style) { ?><div class="header-button"><?php } ?>
		<a href="#search-lightbox" data-open="#search-lightbox" data-focus="input.search-field"
		class="<?php echo get_flatsome_icon_class(get_theme_mod('search_icon_style'), 'small'); ?>">
		<?php echo get_flatsome_icon('icon-search', '16px'); ?></a>
		<?php if($icon_style) { ?></div>
	<?php } ?>
	
	<div id="search-lightbox" class="mfp-hide dark text-center">
		<?php echo do_shortcode('[search size="large" style="'.get_theme_mod('header_search_form_style').'"]'); ?>
	</div>
</li>
<?php } ?>