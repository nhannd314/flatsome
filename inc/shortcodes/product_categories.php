<?php

// [ux_product_categories]
function ux_product_categories($atts, $content = null, $tag) {
  $sliderrandomid = rand();
  extract( shortcode_atts( array (

      // Meta
      'number'     => null,
      '_id' => 'cats-'.rand(),
      'ids' => false, // Custom IDs
      'title' => '',
      'cat' => '',
      'orderby'    => 'menu_order',
      'order'      => 'ASC',
      'hide_empty' => 1,
      'parent'     => 'false',
      'offset' => '',
      'show_count' => 'true',

      // Layout
      'style' => 'badge',
      'columns' => '4',
      'columns__sm' => '',
      'columns__md' => '',
      'col_spacing' => 'small',
      'type' => 'slider', // slider, row, masonery, grid
      'width' => '',
      'grid' => '1',
      'grid_height' => '600px',
      'grid_height__md' => '500px',
      'grid_height__sm' => '400px',
      'slider_nav_style' => 'reveal',
      'slider_nav_color' => '',
      'slider_nav_position' => '',
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
      'text_align' => 'center',
      'text_size' => '',

      'image_size' => '',
      'image_mask' => '',
      'image_width' => '',
      'image_hover' => '',
      'image_hover_alt' => '',
      'image_radius' => '',
      'image_height' => '',
      'image_overlay' => '',

      // depricated
      'bg_overlay' => '#000',

      ), $atts ) );


      if($tag == 'ux_product_categories_grid'){
        $type = 'grid';
      }

    $hide_empty = ( $hide_empty == true || $hide_empty == 1 ) ? 1 : 0;

        // if Ids
    if ( isset( $atts[ 'ids' ] ) ) {
      $ids = explode( ',', $atts[ 'ids' ] );
      $ids = array_map( 'trim', $ids );
      $parent = '';
      $orderby = 'include';
    } else {
      $ids = array();
    }

    // get terms and workaround WP bug with parents/pad counts
      $args = array(
        'orderby'    => $orderby,
        'order'      => $order,
        'hide_empty' => $hide_empty,
        'include'    => $ids,
        'pad_counts' => true,
        'child_of'   => 0,
        'offset' => $offset,
    );

    $product_categories = get_terms( 'product_cat', $args );

    if ( !empty($parent) ) $product_categories = wp_list_filter( $product_categories, array( 'parent' => $parent ) );
    if ( !empty($number) ) $product_categories = array_slice( $product_categories, 0, $number );

    $classes_box = array('box','box-category','has-hover');
    $classes_image = array();
    $classes_text = array();

    // Create Grid
    if($type == 'grid'){
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
    if($style == 'overlay' && !$image_overlay) $image_overlay = true;

    // Set image styles
    if($image_hover)  $classes_image[] = 'image-'.$image_hover;
    if($image_hover_alt)  $classes_image[] = 'image-'.$image_hover_alt;
    if($image_height)  $classes_image[] = 'image-cover';

    // Text classes
    if($text_hover) $classes_text[] = 'show-on-hover hover-'.$text_hover;
    if($text_align) $classes_text[] = 'text-'.$text_align;
    if($text_size) $classes_text[] = 'is-'.$text_size;
    if($text_color == 'dark') $classes_text[] = 'dark';

    $css_args_img = array(
      array( 'attribute' => 'border-radius', 'value' => $image_radius, 'unit' => '%'),
      array( 'attribute' => 'width', 'value' => $image_width, 'unit' => '%' ),
    );

    $css_image_height = array(
      array( 'attribute' => 'padding-top', 'value' => $image_height),
    );

    $css_args = array(
          array( 'attribute' => 'background-color', 'value' => $text_bg ),
          array( 'attribute' => 'padding', 'value' => $text_padding ),
    );

    // Repeater options
    $repater['id'] = $_id;
    $repater['tag'] = $tag;
    $repater['type'] = $type;
    $repater['style'] = $style;
    $repater['format'] = $image_height;
    $repater['slider_style'] = $slider_nav_style;
    $repater['slider_nav_color'] = $slider_nav_color;
    $repater['slider_nav_position'] = $slider_nav_position;
    $repater['slider_bullets'] = $slider_bullets;
    $repater['auto_slide'] = $auto_slide;
    $repater['row_spacing'] = $col_spacing;
    $repater['row_width'] = $width;
    $repater['columns'] = $columns;
    $repater['columns__sm'] = $columns__sm;
    $repater['columns__md'] = $columns__md;
    $repater['depth'] = $depth;
    $repater['depth_hover'] = $depth_hover;

    ob_start();

    echo get_flatsome_repeater_start($repater);

    if ( $product_categories ) {
      foreach ( $product_categories as $category ) {

        $classes_col = array('product-category','col');

        $thumbnail_size   = apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' );

        if($image_size) $thumbnail_size = $image_size;

        if($type == 'grid'){
            if($grid_total > $current_grid) $current_grid++;
            $current = $current_grid-1;
            $classes_col[] = 'grid-col';
            if($grid[$current]['height']) $classes_col[] = 'grid-col-'.$grid[$current]['height'];
            if($grid[$current]['span']) $classes_col[] = 'large-'.$grid[$current]['span'];
            if($grid[$current]['md']) $classes_col[] = 'medium-'.$grid[$current]['md'];

            // Set image size
            if($grid[$current]['size'] == 'large') $thumbnail_size = 'large';
            if($grid[$current]['size'] == 'medium') $thumbnail_size = 'medium';
        }

        $thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );

        if ( $thumbnail_id ) {
          $image = wp_get_attachment_image_src( $thumbnail_id, $thumbnail_size);
          $image = $image[0];
        } else {
          $image = wc_placeholder_img_src();
        }

        ?>
        <div class="<?php echo implode(' ', $classes_col); ?>" <?php echo $animate;?>>
            <div class="col-inner">
              <?php do_action( 'woocommerce_before_subcategory', $category ); ?>
                <div class="<?php echo implode(' ', $classes_box); ?> ">
                <div class="box-image" <?php echo get_shortcode_inline_css($css_args_img); ?>>
                  <div class="<?php echo implode(' ', $classes_image); ?>" <?php echo get_shortcode_inline_css($css_image_height); ?>>
                  <?php echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" width="300" height="300" />'; ?>
                  <?php if($image_overlay){ ?><div class="overlay" style="background-color: <?php echo $image_overlay;?>"></div><?php } ?>
                  <?php if($style == 'shade'){ ?><div class="shade"></div><?php } ?>
                  </div>
                </div><!-- box-image -->
                <div class="box-text <?php echo implode(' ', $classes_text); ?>" <?php echo get_shortcode_inline_css($css_args); ?>>
                  <div class="box-text-inner">
                      <h5 class="uppercase header-title">
                              <?php echo $category->name; ?>
                      </h5>
                      <?php if($show_count) { ?>
                      <p class="is-xsmall uppercase count <?php if($style == 'overlay') echo 'show-on-hover hover-reveal reveal-small'; ?>">
                        <?php if ( $category->count > 0 ) echo apply_filters( 'woocommerce_subcategory_count_html', ' ' . $category->count . ' '.__('Products','woocommerce').'', $category); ?>
                      </p>
                      <?php } ?>
                      <?php
                        /**
                         * woocommerce_after_subcategory_title hook
                         */
                        do_action( 'woocommerce_after_subcategory_title', $category );
                      ?>

                  </div><!-- .box-text-inner -->
                </div><!-- .box-text -->
                </div><!-- .box -->
            <?php do_action( 'woocommerce_after_subcategory', $category ); ?>
            </div><!-- .col-inner -->
            </div><!-- .col -->
        <?php
      }
    }
    woocommerce_reset_loop();

    echo get_flatsome_repeater_end($repater);

    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

add_shortcode("ux_product_categories", "ux_product_categories");
add_shortcode("ux_product_categories_grid", "ux_product_categories");
