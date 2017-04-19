<?php
function ux_image_box($atts, $content = null){
  extract( shortcode_atts( array(
  	  '_id' => null,
      'img' => '',
      'style' => '',
      'depth' => '',
      'depth_hover' => '',
      'link' => '',
      'target' => '_self',
      // Box styles
      'animate' => '',
      'text_pos' => 'bottom',
      'text_padding' => '',
      'text_bg' => '',
      'text_color' => '',
      'text_hover' => '',
      'text_align' => 'center',
      'text_size' => '',
      'image_size' => '',
      'image_width' => '',
      'image_height' => '',
      'image_hover' => '',
      'image_radius' => '',
      'image_hover_alt' => '',
      'image_overlay' => '',
  ), $atts ) );


    ob_start();

     // Set Classes
    $classes_box = array();
    $classes_text = array();
    $classes_image = array();

    // Set box style
    $classes_box[] = 'has-hover';
    if($depth) $classes_box[] = 'box-shadow-'.$depth;
    if($depth_hover) $classes_box[] = 'box-shadow-'.$depth_hover.'-hover';

    $link_start = '<a href="'.$link.'" target="'.$target.'">';
    $link_end = '</a>';

    if($style) $classes_box[] = 'box-'.$style;
    if($style == 'overlay') $classes_box[] = 'dark';
    if($style == 'shade') $classes_box[] = 'dark';
    if($style == 'badge') $classes_box[] = 'hover-dark';
    if($text_pos) $classes_box[] = 'box-text-'.$text_pos;
    if($style == 'overlay' && !$image_overlay) $image_overlay = true;

    if($image_hover)  $classes_image[] = 'image-'.$image_hover;
    if($image_hover_alt)  $classes_image[] = 'image-'.$image_hover_alt;
    if($image_height)  $classes_image[] = 'image-cover';

    // Text classes
    if($text_hover) $classes_text[] = 'show-on-hover hover-'.$text_hover;
    if($text_align) $classes_text[] = 'text-'.$text_align;
    if($text_size) $classes_text[] = 'is-'.$text_size;
    if($text_color == 'dark') $classes_text[] = 'dark';

    if($animate) {$animate = 'data-animate="'.$animate.'"';}

   $css_args = array(
      array( 'attribute' => 'background-color', 'value' => $text_bg ),
      array( 'attribute' => 'padding', 'value' => $text_padding ),
   );

    $css_image = array(
      array( 'attribute' => 'border-radius', 'value' => $image_radius, 'unit' => '%'),
      array( 'attribute' => 'width', 'value' => $image_width,'unit' => '%' ),
    );

    $css_image_height = array(
      array( 'attribute' => 'padding-top', 'value' => $image_height),
    );

    ?>
    <div class="box has-hover <?php echo implode(' ', $classes_box); ?>" <?php echo $animate; ?>>

         <?php if($link) echo $link_start; ?>
         <div class="box-image" <?php echo get_shortcode_inline_css($css_image); ?>>
             <div class="<?php echo implode(' ', $classes_image); ?>" <?php echo get_shortcode_inline_css($css_image_height); ?>>
                <?php echo flatsome_get_image($img, $image_size); ?>
                <?php if($image_overlay) { ?><div class="overlay" style="background-color:<?php echo $image_overlay; ?>"></div><?php } ?>
                <?php if($style == 'shade'){ ?><div class="shade"></div><?php } ?>
              </div>
          </div><!-- box-image -->
         <?php if($link) echo $link_end; ?>

          <div class="box-text <?php echo implode(' ', $classes_text); ?>" <?php echo get_shortcode_inline_css($css_args); ?>>
                <div class="box-text-inner">
                    <?php echo flatsome_contentfix($content); ?>
                </div><!-- box-text-inner -->
          </div><!-- box-text -->
    </div><!-- .box  -->
    <?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
};
add_shortcode('ux_image_box','ux_image_box');
