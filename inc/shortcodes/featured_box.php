<?php
// [featured_box]
function featured_box($atts, $content = null) {
  global $flatsome_opt;
  $sliderrandomid = rand();
  extract(shortcode_atts(array(
    'title' => '',
    'title_small' => '',
    'font_size' => '',
    'img'  => '',
    'inline_svg' => 'true',
    'img_width' => '60',
    'pos' => 'top',
    'link' => '',
    'tooltip' => '',
    'margin' => '',
    'icon_border' => '',
    'icon_color' => '',
  ), $atts));
  ob_start();

  $classes = array('featured-box');
  $classes_img = array('icon-box-img');

  $classes[] = 'icon-box-'.$pos;
  if($tooltip) $classes[] = 'tooltip';
  if($pos == 'center') $classes[] = 'text-center';
  if($pos == 'left' || $pos == 'top') $classes[] = 'text-left';
  if($pos == 'right') $classes[] = 'text-right';
  if($font_size) $classes[] = 'is-'.$font_size;
  if($img_width) $img_width = 'width: '.intval($img_width).'px';

  if($icon_border) $classes_img[] = 'has-icon-bg';

  $css_args_out = array(
    'margin' => array(
        'attribute' => 'margin',
        'unit' => 'px',
        'value' => $margin,
    ),
  );

  $css_args = array(
    'icon_border' => array(
        'attribute' => 'border-width',
        'unit' => 'px',
        'value' => $icon_border,
    ),
    'icon_color' => array(
      'attribute' => 'color',
      'value' => $icon_color,
    ),
  );

  $classes = implode(" ", $classes);
  $classes_img = implode(" ", $classes_img);
  ?>
  
  <?php if($link) { echo '<a class="plain" href="'.$link.'">'; } ?>
  <div class="icon-box <?php echo $classes; ?>" <?php if($tooltip) echo 'title="'.$tooltip.'"'?> <?php echo get_shortcode_inline_css($css_args_out);?>>

        <?php if($img) { ?>
        <div class="<?php echo $classes_img; ?>" style="<?php if($img_width) echo $img_width; ?>">
          <div class="icon">
            <div class="icon-inner" <?php echo get_shortcode_inline_css($css_args);?>>
              <?php echo flatsome_get_image($img, $size = 'medium', $alt = $title, $inline_svg) ;?>
             </div>
          </div>
        </div>
        <?php } ?>
        <div class="icon-box-text last-reset">

            <?php if($title){ ?><h5 class="uppercase"><?php echo $title; ?></h5><?php } ?>
            <?php if($title_small){ ?><h6><?php echo $title_small; ?></h6><?php } ?>

            <?php echo flatsome_contentfix($content); ?>
        </div>
  </div><!-- .icon-box -->
  <?php if($link) { echo '</a>'; } ?>

  <?php
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}


add_shortcode("featured_box", "featured_box");
