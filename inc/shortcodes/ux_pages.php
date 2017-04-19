<?php

function ux_pages($atts) {
    extract(shortcode_atts(array(
      // meta
      '_id' => 'pages-'.rand(),
      'parent' => '',
      'ids' => false,
      'target' => '',

      // Layout
      'style' => '',
      'columns' => '4',
      'col_spacing' => '',
      'type' => 'row', // slider, row, masonery, grid
      'width' => '',
      'grid' => '1',
      'grid_height' => '600px',
      'grid_height__md' => '500px',
      'grid_height__sm' => '400px',
      'slider_nav_style' => 'reveal',
      'slider_nav_position' => '',
      'slider_nav_color' => '',
      'slider_bullets' => 'false',
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

      if ( !empty( $ids ) ) {
        $ids = explode( ',', $ids );
        $ids = array_map( 'trim', $ids );
        $childpages = get_pages( array( 'include' => $ids, 'sort_column' => 'menu_order' ) );
      } else if ( is_page() && $post->post_parent && !$parent ){
          $childpages = get_pages( array( 'child_of' => $post->post_parent, 'sort_column' => 'menu_order' ) );
      } else {
          $post_id = $post->ID;
          if($parent) {
            if(!is_numeric($parent)){
              $id = get_page_by_path( $parent );
              $parent = $id->ID;
            }
            $post_id = $parent;
          }
          $childpages = get_pages( array( 'child_of' => $post_id, 'sort_column' => 'menu_order' ) );
          if(!$childpages) echo '<p class="lead shortcode-error text-center">Sorry, no pages was found</p>';
      }

      $classes_box = array('page-box','box','has-hover');
      $classes_image = array('box-image');
      $classes_text = array('box-text');

      // Create Grid
      if($type == 'grid'){
        if(!$text_pos) $text_pos = 'center';
        if(!$text_color) $text_color = 'dark';
        if($style !== 'shade') $style = 'overlay';
        $columns = 0;
        $current_grid = 0;
        $grid = flatsome_get_grid($grid);
        $grid_total = count($grid);
        echo flatsome_get_grid_height($grid_height, $_id);
      }

      // Add Animations
      if($animate) {$animate = 'data-animate="'.$animate.'"';}

      // Set box style
      if($style) $classes_box[] = 'box-'.$style;
      if($style == 'overlay') $classes_box[] = 'dark';
      if($style == 'shade') $classes_box[] = 'dark';
      if($style == 'badge') $classes_box[] = 'hover-dark';
      if($text_pos) $classes_box[] = 'box-text-'.$text_pos;
      if($style == 'overlay' && !$image_overlay) $image_overlay = 'rgba(0,0,0,.3)';

      // Set image styles
      if($image_hover)  $classes_image[] = 'image-'.$image_hover;
      if($image_hover_alt)  $classes_image[] = 'image-'.$image_hover_alt;
      if($image_height) $classes_image[] = 'image-cover';

      // Text classes
      if($text_hover) $classes_text[] = 'show-on-hover hover-'.$text_hover;
      if($text_align) $classes_text[] = 'text-'.$text_align;
      if($text_size) $classes_text[] = 'is-'.$text_size;
      if($text_color == 'dark') $classes_text[] = 'dark';

      $css_col = array(
        array( 'attribute' => 'border-radius', 'value' => $image_radius, 'unit' => '%'),
      );

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
      $repater['slider_nav_color'] = $slider_nav_color;
      $repater['slider_nav_position'] = $slider_nav_position;
      $repater['slider_bullets'] = $slider_bullets;
      $repater['auto_slide'] = $auto_slide;
      $repater['row_spacing'] = $col_spacing;
      $repater['row_width'] = $width;
      $repater['columns'] = $columns;
      $repater['depth'] = $depth;
      $repater['depth_hover'] = $depth_hover;

      ob_start();

      echo get_flatsome_repeater_start($repater);

      foreach (  $childpages as $page ) {

        $classes_col = array('page-col','col');

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

      ?>
        <div class="<?php echo implode(' ', $classes_col); ?>" <?php echo $animate;?>>
          <div class="col-inner" <?php echo get_shortcode_inline_css($css_col); ?>>
          <a class="plain" href="<?php echo get_the_permalink($page->ID); ?>" title="<?php echo $page->post_title; ?>" target="<?php echo $target; ?>">
            <div class="<?php echo implode(' ', $classes_box); ?>">
                  <div class="box-image" <?php echo get_shortcode_inline_css($css_args_img); ?>>
                      <div class="<?php echo implode(' ', $classes_image); ?>" <?php echo get_shortcode_inline_css($css_image_height); ?>>
                      <?php $img_id = get_post_thumbnail_id($page->ID); echo wp_get_attachment_image($img_id, $image_size); ?>
                      </div><!-- image -->
                      <?php if($image_overlay){ ?><div class="overlay" style="background-color: <?php echo $image_overlay;?>"></div><?php } ?>
                      <?php if($style == 'shade'){ ?><div class="shade"></div><?php } ?>
                  </div><!-- box-image -->
                  <div class="<?php echo implode(' ', $classes_text); ?>" <?php echo get_shortcode_inline_css($css_args); ?>>
                        <div class="box-text-inner">
                            <p><?php echo $page->post_title; ?></p>
                        </div><!-- box-text-inner -->
                  </div><!-- box-text -->
              </div><!-- .image-box .box -->
            </a>
            </div><!-- .col-inner -->
          </div><!-- .col -->
         <?php
    } // Loop
    echo '</div>';

    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

add_shortcode("ux_pages", "ux_pages");
