<?php 
// [message_box]
function flatsome_message_box($atts, $content = null) {
	extract(shortcode_atts(array(
        'bg'  => '',
        'bg_color' => '',
        'text_color'  => 'dark',
        'padding' => '15',
	), $atts));

  $classes = array('message-box','relative');

  if($bg) {
    $bg = flatsome_get_image_url($bg);
  }


  if($text_color == 'dark') $classes[] = 'dark';

  $css_args = array(
      array( 'attribute' => 'padding-top', 'value' => $padding, 'unit' => 'px'),
      array( 'attribute' => 'padding-bottom', 'value' => $padding, 'unit' => 'px'),
   );
   $css_bg = array();
   if($bg) {
        $css_bg = array(
            array( 'attribute' => 'background-image', 'value' => 'url('.$bg.')'),
        );
    }
   $css_bg_overlay = array(
      array( 'attribute' => 'background-color', 'value' => $bg_color ),
   );
	
	return '<div class="'.implode(' ', $classes).'" '.get_shortcode_inline_css($css_args).'><div class="message-box-bg-image bg-fill fill" '.get_shortcode_inline_css($css_bg).'></div><div class="message-box-bg-overlay bg-fill fill" '.get_shortcode_inline_css($css_bg_overlay).'></div><div class="container relative"><div class="inner last-reset">'.do_shortcode($content).'</div></div></div>';
}

add_shortcode("message_box", "flatsome_message_box");


