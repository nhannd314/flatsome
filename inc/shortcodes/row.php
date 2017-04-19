<?php

// [row]
function ux_row($atts, $content = null) {
  extract( shortcode_atts( array(
    '_id' => 'row-'.rand(),
    'style' => '',
    'col_style' => '',
    'label' => '',
    'border_color' => '',
    'width' => '',
    'custom_width' => '',
    'class' => '',
    'v_align' => '',
    'h_align' => '',
    'depth' => '',
    'depth_hover' => '',
    // Paddings
    'padding' => '',
    'col_bg' => '',
  ), $atts ) );


  $classes[] = 'row';

  // Add Row style
  if($style) $classes[] = 'row-'.$style;

  // Add Row Width
  if($width == 'full-width') $classes[] = 'row-full-width';

  // Column Vertical Align
  if($v_align) $classes[] = 'align-'.$v_align;

  // Column Horizontal Align
  if($h_align) $classes[] = 'align-'.$h_align;

  // Column style
  if($col_style) $classes[] = 'row-'.$col_style;

  // Custom Class
  if($class) $classes[] = $class;

  // Depth
  if($depth) $classes[] = 'row-box-shadow-'.$depth;
  if($depth_hover) $classes[] = 'row-box-shadow-'.$depth_hover.'-hover';

  // Add Custom Widths
  if($width !== 'custom'){
    $custom_width = '';
  } else{
    $custom_width = 'style="max-width:'.$custom_width.'"';
  }

  $args = array(
     'padding' => array(
        'selector' => '> .col > .col-inner',
        'property' => 'padding',
      ),
     'col_bg' => array(
        'selector' => '> .col > .col-inner',
        'property' => 'background-color',
      ),
  );

  $classes =  implode(" ", $classes);

  return '<div class="'.$classes.'" '.$custom_width.' id="'.$_id.'">'.flatsome_contentfix($content).ux_builder_element_style_tag($_id, $args, $atts).'</div>';
}


// [col]
function ux_col($atts, $content = null) {
	extract( shortcode_atts( array(
    'span' => '12',
    'span__md' => isset( $atts['span'] ) ? $atts['span'] : '',
    'span__sm' => '',
    'small' => '12',
    'visibility' => '',
    'divider' => '',
    'animate' => '',
    'padding' => '',
    'margin' => '',
    'tooltip' => '',
    'max_width' => '',
    'hover' => '',
    'class' => '',
    'align' => '',
    'color' => '',
    'parallax' => '',
    'force_first' => '',
    'bg' => '',
    'bg_color' => '',
    'depth' => '',
    'depth_hover' => '',
    'text_depth' => ''
  ), $atts ) );

  // Hide if visibility is hidden
  if($visibility == 'disabled') return;

  $classes[] = 'col';
  $classes_inner[] = 'col-inner';
  $border_html = '';

  // Fix old cols
  if(strpos($span, '/')) $span = flatsome_fix_span($span);

  // add custom class
  if($class) $classes[] = $class;

  if($visibility) $classes[] = $visibility;


  if($span__md) $classes[] = 'medium-'.$span__md;
  if($span__sm) $classes[] = 'small-'.$span__sm;
  if($span) $classes[] = 'large-'.$span;

  // Force first position
  if($force_first) $classes[] = $force_first.'-col-first';

  // Add divider
  if($divider) $classes[] = 'col-divided';

  // Add Animation Class
  if($animate) { $animate = 'data-animate="'.$animate.'"'; }

  // Add Align Class
  if($align) $classes_inner[] = 'text-'.$align;

  // Add Hover Class
  if($hover) $classes[] = 'col-hover-'.$hover;

  // Add Depth Class
  if($depth) $classes_inner[] = 'box-shadow-'.$depth;
  if($depth_hover) $classes_inner[] = 'box-shadow-'.$depth_hover.'-hover';
  if($text_depth) $classes_inner[] = 'text-shadow-'.$text_depth;

  // Add Color class
  if($color == 'light') $classes_inner[] = 'dark';

  // Add Toolip Html
  $tooltip_class = '';
  if($tooltip) {
    $tooltip = 'title="'.$tooltip.'"';
    $classes[] = 'tip-top';
  }

  // Parallax
  if($parallax) $parallax = 'data-parallax-fade="true" data-parallax="'.$parallax.'"';

  // Inline CSS
  $css_args = array(
    'span' => array(
        'attribute' => 'max-width',
        'value' => $max_width,
      ),
    'bg_color' => array(
      'attribute' => 'background-color',
      'value' => $bg_color,
    ),
    'padding' => array(
      'attribute' => 'padding',
      'value' => $padding,
    ),
    'margin' => array(
      'attribute' => 'margin',
      'value' => $margin,
    )
  );

  $classes =  implode(" ", $classes);
  $classes_inner =  implode(" ", $classes_inner);

	$column = '<div class="'.$classes.'" '.$tooltip.' '.$animate.'><div class="'.$classes_inner.'" '.get_shortcode_inline_css($css_args).' '.$parallax.'>'.$border_html.''.$content.'</div></div>';

  return flatsome_contentfix($column);
}

add_shortcode('col', 'ux_col');
add_shortcode('col_inner', 'ux_col');
add_shortcode('col_inner_1', 'ux_col');
add_shortcode('col_inner_2', 'ux_col');
add_shortcode('row', 'ux_row');
add_shortcode('row_inner', 'ux_row');
add_shortcode('row_inner_1', 'ux_row');
add_shortcode('row_inner_2', 'ux_row');
add_shortcode('background', 'ux_section');
add_shortcode('section', 'ux_section');
