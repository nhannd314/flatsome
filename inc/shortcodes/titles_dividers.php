<?php
// [title]
function title_shortcode( $atts, $content = null ){
  extract( shortcode_atts( array(
    '_id' => 'title-'.rand(),
    'text' => '',
    'sub_text' => '',
    'style' => 'normal',
    'size' => '100',
    'link' => '',
    'link_text' => '',
    'target' => '',
    'margin_top' => '',
    'margin_bottom' => '',
    'letter_case' => '',
    'color' => '',
    'width' => '',
    'icon' => '',
    'tag'
  ), $atts ) );

  if(!$text && !$link_text) return;

  $link_output = '';
  if($link) $link_output = '<a href="'.$link.'" target="'.$target.'">'.$link_text.get_flatsome_icon('icon-angle-right').'</a>';

  $small_text = '';
  if($sub_text) $small_text = '<small class="sub-title">'.$atts['sub_text'].'</small>';

  if($icon) $icon = get_flatsome_icon($icon);

  // fix old
  if($style == 'bold_center') $style = 'bold-center';

  $css_args = array(
   array( 'attribute' => 'margin-top', 'value' => $margin_top),
   array( 'attribute' => 'margin-bottom', 'value' => $margin_bottom),
  );

  if($width) {
    $css_args[] = array( 'attribute' => 'max-width', 'value' => $width);
  }

  $css_args_title = array();

  if($size !== '100'){
    $css_args_title[] = array( 'attribute' => 'font-size', 'value' => $size, 'unit' => '%');
  }
  if($color){
    $css_args_title[] = array( 'attribute' => 'color', 'value' => $color);
  }

  return '<div class="container section-title-container" '.get_shortcode_inline_css($css_args).'><h3 class="section-title section-title-'.$style.'"><b></b><span class="section-title-main" '.get_shortcode_inline_css($css_args_title).'>'.$icon.$atts['text'].$small_text.'</span><b></b>'.$link_output.'</h3></div><!-- .section-title -->';

}
add_shortcode('title', 'title_shortcode');


// [divider]
function divider_shortcode( $atts, $content = null ){
  extract( shortcode_atts( array(
    'width' => '',
    'height' => '',
    'margin' => '',
    'align' => '',
    'color' => '',
  ), $atts ) );

$align_end ='';
$align_start = '';


// Fallback
if($width == 'full') $width = '100%';

$css_args = array(
  array( 'attribute' => 'margin-top', 'value' => $margin),
  array( 'attribute' => 'margin-bottom', 'value' => $margin),
  array( 'attribute' => 'max-width', 'value' => $width ),
  array( 'attribute' => 'height', 'value' => $height ),
  array( 'attribute' => 'background-color', 'value' => $color ),
);

if($align === 'center'){
  $align_start ='<div class="text-center">';
  $align_end = '</div>';
}
if($align === 'right'){
  $align_start ='<div class="text-right">';
  $align_end = '</div>';
}
return $align_start.'<div class="is-divider divider clearfix" '.get_shortcode_inline_css($css_args).'></div>'.$align_end.'<!-- .divider -->';

}
add_shortcode('divider', 'divider_shortcode');
