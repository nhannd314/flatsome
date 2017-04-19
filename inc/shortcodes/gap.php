<?php

// [gap]
function flatsome_gap_shortcode( $atts, $content = null ){
  extract( shortcode_atts( array(
    'height' => '30px',
  ), $atts ) );

	return '<div class="gap-element" style="display:block; height:auto; padding-top:'.$height.'" class="clearfix"></div>';

}
add_shortcode('gap', 'flatsome_gap_shortcode');