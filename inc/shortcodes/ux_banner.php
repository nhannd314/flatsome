<?php
// [ux_banner]
function flatsome_ux_banner( $atts, $content = null ){

  extract( shortcode_atts( array(
    '_id' => 'banner-'.rand(),
    'visibility' => '',

    'hover' => '',
    'hover_alt' => '',
    'alt' => '',
    'class' => '',
    'sticky' => '',
    'height' => '',
    'container_width' => '',
    'mob_height' => '', // Depricaited
    'tablet_height' => '', // Depricaited

    // Background
    'bg' => '',
    'parallax' => '',
    'parallax_style' => '',
    'slide_effect' => '',
    'bg_size' => 'large',
    'bg_color' => '',
    'bg_overlay' => '',
    'bg_pos' => '',
    'bg_pos_ie' => '',
    'effect' => '',

    // Video
    'video_mp4' => '',
    'video_ogg' => '',
    'video_webm' => '',
    'video_sound' => 'false',
    'video_loop' => 'loop',
    'youtube' => '',

    // Border Control
    'border' => '',
    'border_color' => '',
    'border_margin' => '',
    'border_radius' => '',
    'border_style' => '',
    'border_hover' => '',

    //Depriciated (This is added to Text Box shortcode)
    'animation' => 'fadeIn',
    'animate' => '',
    'loading' => '',
    'animated' => '',
    'animation_duration' => '',
    'text_width' => '60%',
    'text_align' => 'center',
    'text_color' => 'light',
    'text_pos' => 'center',
    'parallax_text' => '',
    'text_bg' => '',
    'padding' => '',

    // Link
    'target' => '',
    'link' => '',
  ), $atts ) );

   // Stop if visibility is hidden
   if($visibility == 'hidden') return;

   ob_start();

   $classes = array('has-hover');

   // Custom Class
   if($class) $classes[] = $class;

   if($animate) {$animation = $animate;}
   if($animated) {$animation = $animated;}

   /* Hover Class */
   if($hover) $classes[] = 'bg-'.$hover;
   if($hover_alt) $classes[] = 'bg-'.$hover_alt;

   /* Has video */
   if($video_mp4 || $video_webm || $video_ogg) { $classes[] = 'has-video'; }
   
   /* Sticky */
   if($sticky) $classes[] = 'sticky-section';

   /* Banner Effects */
   if($effect) wp_enqueue_style( 'flatsome-effects');

    /* Old bg fallback */
    $atts['bg_color'] = $bg_color;
    if(strpos($bg,'#') !== false){
      $atts['bg_color'] = $bg;
      $bg = false;
    }

    /* Mute if video_sound is 0 */
    if ( $video_sound == '0' ) $video_sound = 'false';

    if($bg_overlay && strpos($bg_overlay,'#') !== false){
      $atts['bg_overlay'] = flatsome_hex2rgba($bg_overlay,'0.15');
    }


   /* IE fallback */
   $atts['bg_pos_ie'] = $bg_pos;

   /* Full height banner */
   if(strpos($height, '100%') !== false) {
     $classes[] = 'is-full-height';
   }

   /* Slide Effects */
   if($slide_effect) $classes[] = 'has-slide-effect slide-'.$slide_effect;

   /* Visibility */
   if($visibility) $classes[] = $visibility;

   /* Links */
   $start_link = "";
   $end_link = "";

   if($target) $target = 'target="'.$target.'"';
   if($link) {$start_link = '<a href="'.$link.'" '.$target.' class="fill">'; $end_link = '</a>';};

   /* Parallax  */
   if($parallax){
      $classes[] = 'has-parallax';
      $parallax = 'data-parallax="-'.$parallax.'" data-parallax-container=".banner" data-parallax-background';
   }

   /* Lazy load */
   $lazy_load = get_theme_mod('lazy_load_backgrounds', 1) ? '' : 'bg-loaded';

   $classes = implode(" ", $classes);

  ?>

  <div class="banner <?php echo $classes; ?>" id="<?php echo $_id; ?>">
     <?php if($loading) echo '<div class="loading-spin dark centered"></div>'; ?>
     <div class="banner-inner fill">
        <div class="banner-bg fill" <?php echo $parallax; ?>>
            <div class="bg fill bg-fill <?php echo $lazy_load; ?>"></div>
            <?php require( __DIR__ . '/commons/video.php' ) ;?>
            <?php if($bg_overlay) echo '<div class="overlay"></div>' ?>
            <?php require( __DIR__ . '/commons/border.php' ) ;?>
            <?php if($effect) echo '<div class="effect-'.$effect.' bg-effect fill no-click"></div>'; ?>
        </div><!-- bg-layers -->
        <div class="banner-layers <?php if($container_width !== 'full-width') echo 'container'; ?>">
            <?php echo $start_link; ?><div class="fill banner-link"></div><?php echo $end_link; ?>
            <?php
            // Get Layers
            if (!get_theme_mod('flatsome_fallback', 1) || (has_shortcode( $content, 'text_box' ) || has_shortcode( $content, 'ux_hotspot' ) || has_shortcode( $content, 'ux_image' ))) {
              echo flatsome_contentfix($content);
            } else {
              $x = '50'; $y = '50';
              if($text_pos !== 'center'){
                $values = explode(' ', $text_pos);
                if($values[0] == 'left' || $values[1] == 'left'){$x = '10';}
                if($values[0] == 'right' || $values[1] == 'right'){$x = '90';}
                if($values[0] == 'far-left' || $values[1] == 'far-left'){$x = '0';}
                if($values[0] == 'far-right' || $values[1] == 'far-right'){$x = '100';}
                if($values[0] == 'top' || $values[1] == 'top'){$y = '10';}
                if($values[0] == 'bottom' || $values[1] == 'bottom'){$y = '90';}
              }
              if($text_bg && !$padding) $padding = '30px 30px 30px 30px';
              $depth = '';
              if($text_bg) $depth = '1';
              echo flatsome_contentfix('[text_box text_align="'.$text_align.'" parallax="'.$parallax_text.'" animate="'.$animation.'" depth="'.$depth.'" padding="'.$padding.'" bg="'.$text_bg.'" text_color="'.$text_color.'" width="'.intval($text_width).'" width__sm="60%" position_y="'.$y.'" position_x="'.$x.'"]'.$content.'[/text_box]');
            } ?>
        </div><!-- .banner-layers -->
      </div><!-- .banner-inner -->

      <?php
       // Add invisible image if height is not set.
      if(!$height) { ?>
        <div class="height-fix is-invisible"><?php if($bg) echo flatsome_get_image($bg, $bg_size, $alt, true); ?></div>
      <?php } ?>
      <?php
        // Get custom CSS
        $args = array(
          'height' => array(
            'selector' => '',
            'property' => 'padding-top',
          ),
          'bg' => array(
            'selector' => '.bg.bg-loaded',
            'property' => 'background-image',
            'size' => $bg_size
          ),
          'bg_overlay' => array(
            'selector' => '.overlay',
            'property' => 'background-color',
          ),
          'bg_color' => array(
            'selector' => '',
            'property' => 'background-color',
          ),
          'bg_pos' => array(
            'selector' => '.bg',
            'property' => 'background-position',
          ),
        );
        echo ux_builder_element_style_tag($_id, $args, $atts);
      ?>
  </div><!-- .banner -->

<?php
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}
add_shortcode('ux_banner', 'flatsome_ux_banner');
