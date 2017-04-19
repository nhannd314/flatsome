<?php

function flatsome_text_box( $atts, $content = null ){

  $atts = shortcode_atts( array(
    'id' => 'text-box-'.rand(),
    'style' => '',
    'res_text' => 'true',
    'hover' => '',
    'position_x' => '50',
    'position_x__sm' => '',
    'position_x__md' => '',
    'position_y' => '50',
    'position_y__sm' => '',
    'position_y__md' => '',
    'text_color' => 'light',
    'bg' => '',
    'width' => '60',
    'width__sm' => '',
    'width__md' => '',
    'height' => '',
    'height__sm' => '',
    'height__md' => '',
    'scale' => '100',
    'scale__sm' => '',
    'scale__md' => '',
    'text_align' => 'center',
    'animate' => '',
    'parallax' => '',
    'padding' => '',
    'margin' => '',
    'radius' => '',
    'rotate' => '',
    'class' => '',
    'border_radius' => '',
    // Borders
    'border' => '',
    'border_color' => '',
    'border_style' => '',
    'border_pos' => '',
    // Depth
    'depth' => '',
    'depth_hover' => '',
    // Text depth
    'text_depth' => '',
    // Border
    'border' => '',
    'border_color' => '',
    'border_margin' => '',
    'border_radius' => '',
    'border_style' => '',
    'border_hover' => '',

  ), $atts );

  extract( $atts );
    ob_start();

    $classes[] = 'text-box banner-layer';
    $classes_text = array('text-inner');

    if($style) $classes[] = 'text-box-'.$style;
    if($class) $classes[] = $class;

    // Set positions
    $classes[] = flatsome_position_classes( 'x', $position_x, $position_x__sm, $position_x__md );
    $classes[] = flatsome_position_classes( 'y', $position_y, $position_y__sm, $position_y__md );

    $classes_inner = array();

    if($depth) $classes_inner[] = 'box-shadow-'.$depth;
    if($depth_hover) $classes_inner[] = 'box-shadow-'.$depth_hover.'-hover';
    if($text_color == 'light') {$classes_inner[] = 'dark';}
    if($text_depth) {$classes_inner[] = "text-shadow-".$text_depth;}

    if($text_align) {$classes_text[] = "text-".$text_align;}

    if($parallax) $parallax = 'data-parallax="'.$parallax.'" data-parallax-fade="true"';

    /* Responive text */
    if($res_text) $classes[] = 'res-text';

    $classes_text =  implode(" ", $classes_text);
    $classes_inner =  implode(" ", $classes_inner);
    $classes =  implode(" ", $classes);
 ?>
   <div id="<?php echo $id; ?>" class="<?php echo $classes; ?>">
       <?php if($hover) echo '<div class="hover-'.$hover.'">'; ?>
       <?php if($parallax) echo '<div '.$parallax.'>'; ?>
       <?php if($animate) echo '<div data-animate="'.$animate.'">'; ?>
           <div class="text <?php echo $classes_inner; ?>">
              <?php require( __DIR__ . '/commons/border.php' ) ;?>
              <div class="<?php echo $classes_text; ?>">
                  <?php echo flatsome_contentfix($content); ?>
              </div>
           </div><!-- text-box-inner -->
       <?php if($animate) echo '</div>'; ?>
       <?php if($parallax) echo '</div>'; ?>
       <?php if($hover) echo '</div>'; ?>
       <?php
          $args = array(
            'margin' => array(
              'selector' => '',
              'property' => 'margin',
            ),
            'bg' => array(
              'selector' => '.text',
              'property' => 'background-color',
            ),
            'padding' => array(
              'selector' => '.text-inner',
              'property' => 'padding',
            ),
            'radius' => array(
              'selector' => '.text',
              'property' => 'border-radius',
              'unit' => 'px',
            ),
            'width' => array(
              'selector' => '',
              'property' => 'width',
              'unit' => '%',
            ),
            'height' => array(
              'selector' => '',
              'property' => 'height',
              'unit' => '%',
            ),
            'scale' => array(
              'selector' => '.text',
              'property' => 'font-size',
              'unit' => '%',
            ),
            'rotate' => array(
              'selector' => '.text',
              'property' => 'rotate',
              'unit' => 'deg',
            ),

          );
          echo ux_builder_element_style_tag( $id, $args, $atts);
        ?>
    </div><!-- text-box -->
 <?php
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}
add_shortcode('text_box', 'flatsome_text_box');
