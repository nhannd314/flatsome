<?php

// [testimonial]
function flatsome_testimonial($atts, $content = null) {
  global $flatsome_opt;
  $sliderrandomid = rand();
  extract(shortcode_atts(array(
    'name' => '',
    'company' => '',
    'stars' => '5',
    'font_size' => '',
    'text_align' => '',
    'image'  => '',
    'image_width' => '80',
    'pos' => 'left',
    'link' => '',
  ), $atts));
  ob_start();

  $classes = array('testimonial-box');
  $classes_img = array('icon-box-img','testimonial-image','circle');
  
  $classes[] = 'icon-box-'.$pos;
  if($pos == 'center') $classes[] = 'text-center';
  if($pos == 'left' || $pos == 'top') $classes[] = 'text-left';
  if($pos == 'right') $classes[] = 'text-right';
  if($font_size) $classes[] = 'is-'.$font_size;
  if($image_width) $image_width = 'width: '.intval($image_width).'px';

	$star_row = '';
	if ($stars == '1'){$star_row = '<div class="star-rating"><span style="width:25%"><strong class="rating"></strong></span></div>';}
	else if ($stars == '2'){$star_row = '<div class="star-rating"><span style="width:35%"><strong class="rating"></strong></span></div>';}
	else if ($stars == '3'){$star_row = '<div class="star-rating"><span style="width:55%"><strong class="rating"></strong></span></div>';}
	else if ($stars == '4'){$star_row = '<div class="star-rating"><span style="width:75%"><strong class="rating"></strong></span></div>';}
	else if ($stars == '5'){$star_row = '<div class="star-rating"><span style="width:100%"><strong class="rating"></strong></span></div>';}

  $classes = implode(" ", $classes);
  $classes_img = implode(" ", $classes_img);
  ?>
  <div class="icon-box <?php echo $classes; ?>">
        <?php if($image) { ?>
        <div class="<?php echo $classes_img; ?>" style="<?php if($image_width) echo $image_width; ?>">
              <?php echo flatsome_get_image($image, $size = 'thumbnail', $alt = $name) ;?>
        </div>
        <?php } ?>
        <div class="icon-box-text p-last-0">
          <?php if($stars > 0) echo $star_row; ?>
  				<div class="testimonial-text line-height-small italic test_text first-reset last-reset is-italic">
            <?php echo $content; ?>
          </div>
          <div class="testimonial-meta pt-half">
             <strong class="testimonial-name test_name"><?php echo $name; ?></strong>
             <?php if($name && $company) echo '<span class="testimonial-name-divider"> / </span>'; ?>
             <span class="testimonial-company test_company"><?php echo $company; ?></span>
          </div>
        </div>
  </div><!-- .icon-box -->

  <?php
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}

add_shortcode("testimonial", "flatsome_testimonial");

