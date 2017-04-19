<?php

$extensions_url = get_template_directory() . '/inc/extensions';
$extensions_uri = get_template_directory_uri() . '/inc/extensions';

// Shortcode Inserter
if(is_admin()){ require $extensions_url.'/flatsome-shortcode-insert/tinymce.php'; }

// Lazy load
if((!is_admin() && !is_customize_preview() ) && get_theme_mod('lazy_load_images')){ require $extensions_url.'/flatsome-lazy-load/flatsome-lazy-load.php'; }

if(get_theme_mod('live_search', 1)){
  require $extensions_url.'/flatsome-live-search/flatsome-live-search.php';
}

if(is_woocommerce_activated()){
	if(!get_theme_mod('disable_quick_view', 0)){
		require $extensions_url.'/flatsome-wc-quick-view/flatsome-quick-view.php';
	}
}
