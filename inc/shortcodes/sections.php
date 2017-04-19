<?php

function ux_section($atts, $content = null) {
  $atts = shortcode_atts( array(
    '_id' => 'section_'.rand(),
    'class' => '',
    'label' => '',
    'visibility' => '',
    'sticky' => '',

    // BG
    'bg' => '',
    'bg_size' => '',
    'bg_color' => '',
    'bg_overlay' => '',
    'bg_pos' => '',
    'parallax' => '',
    'effect' => '',

    // Video
    'video_mp4' => '',
    'video_ogg' => '',
    'video_webm' => '',
    'video_sound' => '',
    'video_loop' => '',
    'youtube' => '',
    'dark' => 'false',
    'mask' => '',
    'padding' =>'30px',
    'padding__sm' => '',
    'padding__md' => '',
    'height' => '',
    'height__sm' => '',
    'height__md' => '',
    'margin' => '',
    'loading' => '',
    'scroll_for_more' => '',
    // Border Control
    'border' => '',
    'border_hover' => '',
    'border_color' => '',
    'border_margin' => '',
    'border_radius' => '',
    'border_style' => '',
    ), $atts );

    extract( $atts );

    // Hide if visibility is hidden
    if($visibility == 'hidden') return;

    ob_start();

    $classes = array('section');

    $classes_bg = array('bg','section-bg','fill','bg-fill');

    // Fix old
    if(strpos($bg,'#') !== false){
      $atts['bg_color'] = $bg;
      $atts['bg'] = false;
    }

    // Add Custom Classes
    if($class) $classes[] = $class;

    // Add Dark text
    if($dark == 'true') $classes[] = 'dark';

    // If sticky section
    if($sticky) $classes[] = 'sticky-section';

    // Add Mask
    if($mask) $classes[] = 'has-mask mask-'.$mask;

    // Add visiblity class
    if($visibility) $classes[] = $visibility;

    // Add Parallax
    if($parallax) {
      $classes[] = 'has-parallax';
      $parallax = 'data-parallax-container=".section" data-parallax-background data-parallax="-'.$parallax.'"';
    }

    // Background effects
    if($effect) wp_enqueue_style( 'flatsome-effects');

    // Add Full Height Class
    if($height == '100vh') $classes[] = 'is-full-height';

    /* Lazy load */
    $classes_bg[] = get_theme_mod('lazy_load_backgrounds', 1) ? '' : 'bg-loaded';
    $classes_bg[] = $bg ? '' : 'bg-loaded';

    if($border_hover) $classes[] = 'has-hover';

    $classes =  implode(" ", $classes);
    $classes_bg =  implode(" ", $classes_bg);
  ?>
  <section class="<?php echo $classes;?>" id="<?php echo $_id; ?>">
      <div class="<?php echo $classes_bg;?>" <?php echo $parallax; ?>>

        <?php require( __DIR__ . '/commons/video.php' ) ;?>

        <?php if($bg_overlay) echo '<div class="section-bg-overlay absolute fill"></div>'; ?>

        <?php if($loading) echo '<div class="loading-spin centered"></div>'; ?>

        <?php if($scroll_for_more) echo '<button class="scroll-for-more z-5 icon absolute bottom h-center">'.get_flatsome_icon('icon-angle-down','42px').'</button>'; ?>

        <?php if($effect) echo '<div class="effect-'.$effect.' bg-effect fill no-click"></div>'; ?>

        <?php require( __DIR__ . '/commons/border.php' ) ;?>

      </div><!-- .section-bg -->

      <div class="section-content relative">
        <?php echo $content; ?>
      </div><!-- .section-content -->

      <?php
      // Get custom CSS
        $args = array(
         'padding' => array(
            'selector' => '',
            'property' => 'padding-top, padding-bottom',
          ),
          'margin' => array(
            'selector' => '',
            'property' => 'margin-bottom',
          ),
          'height' => array(
            'selector' => '',
            'property' => 'min-height',
          ),
          'bg_color' => array(
            'selector' => '',
            'property' => 'background-color',
          ),
          'bg_overlay' => array(
            'selector' => '.section-bg-overlay',
            'property' => 'background-color',
          ),
          'bg' => array(
            'selector' => '.section-bg.bg-loaded',
            'property' => 'background-image',
            'size' => $bg_size
          ),
          'bg_pos' => array(
            'selector' => '.section-bg',
            'property' => 'background-position',
          ),
        );
      echo ux_builder_element_style_tag($_id, $args, $atts);
  ?>
  </section>
  <?php
  $content = ob_get_contents();
  ob_end_clean();
  return do_shortcode($content);
}
