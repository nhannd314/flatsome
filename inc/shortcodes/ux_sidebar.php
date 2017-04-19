<?php


function flatsome_sidebar_shortcode( $atts ){

  extract( shortcode_atts( array(
    'id' => 'sidebar-main',
    'class' => '',
    'style' => ''
  ), $atts ) );

	if($style) $style = 'widgets-'.$style;

	ob_start();
	dynamic_sidebar($id);
	$sidebar = trim( ob_get_clean() );

	return '<ul class="sidebar-wrapper ul-reset '.$style.'">'.$sidebar.'</ul>';

}
add_shortcode('ux_sidebar', 'flatsome_sidebar_shortcode');
