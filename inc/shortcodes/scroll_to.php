<?php
function flatsome_scroll_to($atts, $content = null) {

  extract(shortcode_atts(array(
    'bullet' => 'true',
    'title' => '',
    'link' => '',
  ), $atts));

  if(!$title && !$link) return false;
  
  // Convert title to link if link is not set.
  if(!$link) $link = flatsome_to_dashed($title);

  if (strpos($link, '#') == false) {
  	$link = '#'.$link;
  }

  return '<span class="scroll-to" data-label="Scroll to: '.$link.'" data-bullet="'.$bullet.'" data-link="'.$link.'" data-title="'.$title.'"><a name="'.str_replace('#', '', $link).'"></a></span>';
}

add_shortcode("scroll_to", "flatsome_scroll_to");
