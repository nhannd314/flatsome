<?php 
// [accordion]
function ux_accordion($atts, $content=null, $code) {
	extract(shortcode_atts(array(
		'auto_open' => '',
		'open' => '',
		'title' => ''
	), $atts));
	if($auto_open) $open = 1;
  if($title) $title = '<h3 class="accordion_title">'.$title.'</h3>';
  return $title.'<div class="accordion" rel="'.$open.'">'.flatsome_contentfix($content).'</div>';		
}
add_shortcode('accordion', 'ux_accordion');


// [accordion-item]
function ux_accordion_item($atts, $content=null, $code) {
    extract(shortcode_atts(array(
		'title' => 'Accordion Panel',
	), $atts));
	return '<div class="accordion-item"><a href="#" class="accordion-title plain"><button class="toggle"><i class="icon-angle-down"></i></button><span>' . $title . '</span></a><div class="accordion-inner">'.flatsome_contentfix($content).'</div></div>';
}
add_shortcode('accordion-item', 'ux_accordion_item');
