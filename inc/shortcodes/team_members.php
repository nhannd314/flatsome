<?php

function flatsome_team_member($atts, $content = null){
  extract( shortcode_atts( array(
      '_id' => null,
      'img' => '',
      'link' => '',
      'name' => '',
      'title' => '',
      'icon_style' => 'outline',
      'twitter' => '',
      'facebook' => '',
      'pinterest' => '',
      'instagram' => '',
      'snapchat' => '',
      'youtube' => '',
      'email' => '',
      'linkedin' => '',
      'style' => '',
      'depth' => '',
      'depth_hover' => '',
      'link' => '',
      'target' => '',
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
      'image_radius' => '',
      'image_height' => '100%',
      'image_hover' => '',
      'image_hover_alt' => '',
      'image_overlay' => '',
  ), $atts ) );


    ob_start();

     // Set Classes
    $classes_box = array();
    $classes_text = array();
    $classes_image = array();
    $classes_image_inner = array();

    // Fix old
    if($style == 'text-overlay'){
      $image_hover = 'zoom';
    }

    $style = str_replace('text-', '', $style);

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
    if($style == 'overlay' && !$image_overlay) $image_overlay = 'rgba(0,0,0,.2)';

    if($image_hover)  $classes_image[] = 'image-'.$image_hover;
    if($image_hover_alt)  $classes_image[] = 'image-'.$image_hover_alt;

    if($image_height)  $classes_image_inner[] = 'image-cover';

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
        array( 'attribute' => 'width', 'value' => $image_width,'unit' => '%' ),
    );

    $css_image_inner = array(
        array( 'attribute' => 'border-radius', 'value' => $image_radius,'unit' => '%' ),
        array( 'attribute' => 'padding-top', 'value' => $image_height),
    );

    ?>
    <div class="box has-hover <?php echo implode(' ', $classes_box); ?>" <?php echo $animate; ?>>

         <?php if($link) echo $link_start; ?>
         <div class="box-image <?php echo implode(' ', $classes_image); ?>" <?php echo get_shortcode_inline_css($css_image); ?>>
           <div class="box-image-inner <?php echo implode(' ', $classes_image_inner); ?>" <?php echo get_shortcode_inline_css($css_image_inner); ?>>
              <?php echo flatsome_get_image($img, $image_size); ?>
              <?php if($image_overlay) { ?><div class="overlay" style="background-color:<?php echo $image_overlay; ?>"></div><?php } ?>
           </div>
          </div><!-- box-image -->
         <?php if($link) echo $link_end; ?>

          <div class="box-text <?php echo implode(' ', $classes_text); ?>" <?php echo get_shortcode_inline_css($css_args); ?>>
                <div class="box-text-inner">
                  <h4 class="uppercase">
                    <span class="person-name"><?php echo $name; ?></span><br/>
                    <span class="person-title is-small thin-font op-7">
                      <?php echo $title; ?>
                    </span>
                  </h4>
                 <?php echo do_shortcode('[follow style="'.$icon_style.'" facebook="'.$facebook.'" twitter="'.$twitter.'" snapchat="'.$snapchat.'" email="'.$email.'" pinterest="'.$pinterest.'" youtube="'.$youtube.'" instagram="'.$instagram.'" linkedin="'.$linkedin.'"]'); ?>
                 <?php if($style  !== 'overlay' && $style  !== 'shade') echo do_shortcode($content); ?>
                </div><!-- box-text-inner -->
          </div><!-- box-text -->
    </div><!-- .box  -->

    <?php if($style  == 'overlay' || $style  == 'shade') echo '<div class="team-member-content pt-half text-'.$text_align.'">'.$content.'</div>'; ?>

    <?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
};
add_shortcode('team_member','flatsome_team_member');
