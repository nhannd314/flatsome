<?php $icon_style = flatsome_option('menu_icon_style'); ?>
<li class="nav-icon has-icon">
  <?php if($icon_style) { ?><div class="header-button"><?php } ?>
		<a href="#" data-open="#main-menu" data-pos="<?php echo flatsome_option('mobile_overlay');?>" data-bg="main-menu-overlay" data-color="<?php echo flatsome_option('mobile_overlay_color');?>" class="<?php echo get_flatsome_icon_class($icon_style, 'small'); ?>" aria-controls="main-menu" aria-expanded="false">
		
		  <?php echo get_flatsome_icon('icon-menu'); ?>

		  <?php if(flatsome_option('menu_icon_title')) echo '<span class="menu-title uppercase hide-for-small">'.__('Menu','flatsome').'</span>'; ?>
		</a>
	<?php if($icon_style) { ?> </div> <?php } ?>
</li>