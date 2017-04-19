<?php // [ux_video]
function flatsome_video($atts) {

    extract( shortcode_atts( array(
        'url' => 'https://www.youtube.com/watch?v=AoPiLg8DZ3A',
        'height' => '56.25%',
        'depth' => '',
        'depth_hover' => ''
    ), $atts ) );


    $classes = array('video','video-fit','mb');

    $video = apply_filters('the_content', $url);

    if($depth) $classes[] = 'box-shadow-'.$depth;
    if($depth_hover) $classes[] = 'box-shadow-'.$depth_hover.'-hover';

    $classes = implode(' ', $classes);

    $height = array(
      array( 'attribute' => 'padding-top', 'value' => $height),
    );
    
    return '<div class="'.$classes.'" '.get_shortcode_inline_css($height).'>'.$video.'</div>';
}
add_shortcode("ux_video", "flatsome_video");