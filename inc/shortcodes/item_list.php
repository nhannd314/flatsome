<?php

// [ux_item_list]
function ux_item_list($atts, $content=null, $code) {
  extract(shortcode_atts(array(
    'title' => ''
  ), $atts));
  return '<div class="item-list last-reset">'.flatsome_contentfix($content).'</div>';   
}
add_shortcode('ux_item_list', 'ux_item_list');

// [ux_menu_item]
function ux_item($atts, $content=null, $code) {
  extract(shortcode_atts(array(
    'title' => 'Menu Item',
  ), $atts));
  	ob_start();
  	?>
	
	<a href="#" class="item flex-row bb plain" style="min-height: 50px; padding: 5px;">
		<div class="flex-col mr-half circle" style="max-width: 50px">
			<img width="100" height="100" src="http://flatsome.dev/wp-content/uploads/2013/08/282004-0286_2-114x130.jpeg" data-src="http://flatsome.dev/wp-content/uploads/2013/08/282004-0286_2-114x130.jpeg" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image lazy-load-active" alt="282004-0286_2">
		</div>
		<div class="flex-grow flex-col">
			<p class="item-title uppercase strong mb-0">A menu title</p>
			<p class="item-title op-6">A menu title</p>
		</div>
		<div class="flex-col ml is-large strong">299$</div>
	</a>
  <?php
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}
add_shortcode('ux_item', 'ux_item');