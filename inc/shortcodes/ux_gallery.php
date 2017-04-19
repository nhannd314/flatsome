<?php

function ux_gallery($atts) {
    extract(shortcode_atts(array(
      // meta
      '_id' => 'gallery-'.rand(),
      'ids' => '', // Gallery IDS
      'lightbox' => 'true',
      'thumbnails' => true,
      'orderby' => 'post__in',
      'order' => '',

      // Layout
      'style' => 'overlay',
      'columns' => '4',
      'col_spacing' => '',
      'type' => '', // slider, row, masonery, grid
      'width' => '',
      'grid' => '1',
      'grid_height' => '600px',
      'slider_nav_style' => 'reveal',
      'slider_bullets' => 'false',
      'slider_nav_position' => '',
      'slider_nav_color' => '',
      'slider_arrows' => 'true',
      'auto_slide' => 'false',
      'infinitive' => 'true',
      'depth' => '',
      'depth_hover' => '',

       // Box styles
      'animate' => '',
      'text_pos' => '',
      'text_padding' => '',
      'text_bg' => '',
      'text_color' => '',
      'text_hover' => '',
      'text_align' => 'left',
      'text_size' => '',
      'image_size' => 'medium',
      'image_mask' => '',
      'image_width' => '',
      'image_height' => '',
      'image_radius' => '',
      'image_hover' => '',
      'image_hover_alt' => '',
      'image_overlay' => '',

      ), $atts));

      ob_start();

      global $post;

      $classes_box = array('box','has-hover','gallery-box');
      $classes_image = array('box-image');
      $classes_text = array('box-text');

      // Create Grid
      if($type == 'grid'){
        if(!$text_pos) $text_pos = 'center';
        if(!$text_color) $text_color = 'dark';
        if($style !== 'shade') $style = 'overlay';
        $columns = null;
        $current_grid = 0;
        $grid = flatsome_get_grid($grid);
        $grid_total = count($grid);
        echo flatsome_get_grid_height($grid_height, $_id);
      }
      if($type == 'slider-full'){
        $columns = null;
      }

      // Add Animations
      if($animate) {$animate = 'data-animate="'.$animate.'"';}

      // Set box style
      if($style) $classes_box[] = 'box-'.$style;
      if($style == 'overlay') $classes_box[] = 'dark';
      if($style == 'shade') $classes_box[] = 'dark';
      if($style == 'badge') $classes_box[] = 'hover-dark';
      if($text_pos) $classes_box[] = 'box-text-'.$text_pos;
      if($style == 'overlay' && !$image_overlay) $image_overlay = 'rgba(0,0,0,.15)';

      // Set image styles
      if($image_hover)  $classes_image[] = 'image-'.$image_hover;
      if($image_hover_alt)  $classes_image[] = 'image-'.$image_hover_alt;
      if($depth) $classes_image[] = 'box-shadow-'.$depth;
      if($depth_hover) $classes_image[] = 'box-shadow-'.$depth_hover.'-hover';
      if($image_height) $classes_image[] = 'image-cover';

      // Text classes
      if($text_hover) $classes_text[] = 'show-on-hover hover-'.$text_hover;
      if($text_align) $classes_text[] = 'text-'.$text_align;
      if($text_size) $classes_text[] = 'is-'.$text_size;

      if($text_color == 'dark') $classes_text[] = 'dark';

      $css_args_img = array(
        array( 'attribute' => 'border-radius', 'value' => $image_radius, 'unit' => '%'),
        array( 'attribute' => 'width', 'value' => $image_width, 'unit' => '%' ),
      );

      $css_args = array(
            array( 'attribute' => 'background-color', 'value' => $text_bg ),
            array( 'attribute' => 'padding', 'value' => $text_padding ),
      );

      $css_image_height = array(
        array( 'attribute' => 'padding-top', 'value' => $image_height),
      );

      // Repeater options
      $repater['id'] = $_id;
      $repater['type'] = $type;
      $repater['style'] = $style;
      $repater['slider_style'] = $slider_nav_style;
      $repater['slider_style'] = $slider_nav_style;
      $repater['slider_nav_position'] = $slider_nav_position;
      $repater['slider_bullets'] = $slider_bullets;
      $repater['slider_nav_color'] = $slider_nav_color;
      $repater['auto_slide'] = $auto_slide;
      $repater['row_spacing'] = $col_spacing;
      $repater['row_width'] = $width;
      $repater['columns'] = $columns;

      // Get attachments
      $_attachments = get_posts( array( 'include' => $ids, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );

      $attachments = array();
      foreach ( $_attachments as $key => $val ) {
          $attachments[$val->ID] = $_attachments[$key];
      }

      if ( empty( $attachments ) ) {
        return '';
      }

      ob_start();

      echo get_flatsome_repeater_start($repater);

      foreach ( $attachments as $id => $attachment ) {

        $link_start = '';
        $link_end = '';

        $content = $attachment->post_content;
        $classes_col = array('gallery-col','col');


        // Add Video icon
        $has_video = false;

        if(isset($content) && strpos($content, 'watch?v=') !== false){
            $has_video = true;
            if(!$image_overlay) $image_overlay = 'rgba(0,0,0,.2)';
            $link_start = '<a href="'.$content.'" class="open-video" title="'.$attachment->post_excerpt.'">';
            $link_end = '</a>';

        } else if($lightbox) {
           $get_image = wp_get_attachment_image_src( $attachment->ID, 'large');
           $link_start = '<a class="image-lightbox lightbox-gallery" href="'.$get_image[0].'" title="'.$attachment->post_excerpt.'">';
           $link_end = '</a>';
        }

        if($type == 'grid'){
            if($grid_total > $current_grid) $current_grid++;
            $current = $current_grid-1;
            $classes_col[] = 'grid-col';
            if($grid[$current]['height']) $classes_col[] = 'grid-col-'.$grid[$current]['height'];
            if($grid[$current]['span']) $classes_col[] = 'large-'.$grid[$current]['span'];
            if($grid[$current]['md']) $classes_col[] = 'medium-'.$grid[$current]['md'];

            // Set image size
            if($grid[$current]['size'] == 'large') $image_size = 'large';
            if($grid[$current]['size'] == 'medium') $image_size = 'medium';
        }

        $image_output = wp_get_attachment_image( $id, $image_size, false, $atts );
      ?>
        <div class="<?php echo implode(' ', $classes_col); ?>" <?php echo $animate;?>>
          <div class="col-inner">
            <?php echo $link_start; ?>
            <div class="<?php echo implode(' ', $classes_box); ?>">
              <div class="<?php echo implode(' ', $classes_image); ?>" <?php echo get_shortcode_inline_css($css_image_height); ?>>
                <?php echo $image_output; ?>
                <?php if($image_overlay){ ?>
                  <div class="overlay fill"
                      style="background-color: <?php echo $image_overlay;?>">
                  </div>
                <?php } ?>
                <?php if($style == 'shade'){ ?>
                  <div class="shade"></div>
                <?php } ?>
                <?php if($has_video) { ?>
                    <div class="absolute no-click x50 y50 md-x50 md-y50 lg-x50 lg-y50 text-shadow-2">
                        <div class="overlay-icon">
                            <i class="icon-play"></i>
                        </div>
                    </div>
                <?php } ?>
              </div><!-- .image -->
              <div class="<?php echo implode(' ', $classes_text); ?>">
                 <p><?php echo $attachment->post_excerpt; ?></p>
              </div><!-- .text -->
            </div><!-- .box -->
            <?php echo $link_end; ?>
          </div><!-- .col-inner -->
         </div><!-- .col -->
         <?php
    } // Loop

    echo get_flatsome_repeater_end($repater);

    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

add_shortcode("ux_gallery", "ux_gallery");
