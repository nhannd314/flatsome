<?php
	// Custom Languages dropdown
	$current_lang = 'Languages';
	$flag = null;
	$languages = null;

	// Polylang
	if(function_exists('pll_the_languages')){
		$languages = pll_the_languages(array('raw' => 1));
		foreach ($languages as $lang) {
			if($lang['current_lang']){
				$flag = '<i class="image-icon"><img src="'.$lang['flag'].'"/></i>';
				$current_lang = $lang['name'];
			}
		}
	}
	// WPML
	else if(function_exists('icl_get_languages')){
		$languages = icl_get_languages();
		foreach ($languages as $lang) {
			if($lang['active']){
				$flag = '<i class="image-icon"><img src="'.$lang['country_flag_url'].'"/></i>';
				$current_lang = $lang['native_name'];
			}
		}
	}

?>
<li class="has-dropdown header-language-dropdown">
	<a href="#">
		<?php echo $current_lang; ?>
		<?php echo $flag; ?>
		<?php echo get_flatsome_icon('icon-angle-down'); ?>
	</a>
	<ul class="nav-dropdown <?php flatsome_dropdown_classes(); ?>">
		<?php

			// Poly Lang
			if($languages && function_exists('pll_the_languages')){
				foreach ($languages as $lang) {
				if($lang['current_lang']) $current = 'class="active"';
				echo '<li><a href="' . $lang['url'] . '" hreflang="' . $lang['slug'] . '"><i class="icon-image"><img src="'.$lang['flag'].'"/></i> ' . $lang['name'] .'</a></li>';
				}
			} else if($languages && function_exists('icl_get_languages')){
				foreach ($languages as $lang) {
				$current = '';
				echo '<li><a href="' . $lang['url'] . '" hreflang="' . $lang['language_code'] . '"><i class="icon-image"><img src="'.$lang['country_flag_url'].'"/></i> ' . $lang['native_name'] . '</a></li>';
				}
			}

		?>
		<?php if(!function_exists('pll_the_languages') && !function_exists('icl_get_languages')) echo '<li><a>You need Polylang or WPML plugin for this to work. You can remove it from Theme Options.</a></li>'; ?>
	</ul>
</li>
