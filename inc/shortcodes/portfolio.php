<?php

// [featured_items_slider]
function flatsome_portfolio_shortcode($atts, $content = null, $tag) {

  extract(shortcode_atts(array(
        // meta
        'filter' => '',
        'filter_nav' => 'line-grow',
        'filter_align' => 'center',
        '_id' => 'portfolio-'.rand(),
        'link' => '',
        'class' => '',
        'orderby' => 'menu_order',
        'order' => '',
        'offset' => '',
        'exclude' => '',
        'number'  => '999',
        'ids' => '',
        'cat' => '',
        'lightbox' => '',

        // Layout
        'style' => '',
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
        'text_align' => 'center',
        'text_size' => '',
        'image_size' => 'medium',
        'image_mask' => '',
        'image_width' => '',
        'image_radius' => '',
        'image_height' => '100%',
        'image_hover' => '',
        'image_hover_alt' => '',
        'image_overlay' => '',

        // Depricated
        'height' => '',
), $atts));

  if($height && !$image_height) $image_height = $height;

  // Get Default Theme style
  if(!$style) $style = flatsome_option('portfolio_style');

  // Fix old
  if($tag == 'featured_items_slider') $type = 'slider';

  // Fix order
  if($orderby == 'menu_order') $order = 'asc';

  // Set Classes
  $classes_box = array('portfolio-box','box','has-hover');
  $classes_image = array();
  $classes_text = array('box-text');

  // Fix Grid type
  if($type == 'grid'){
    $columns = 0;
    $current_grid = 0;
    $grid = flatsome_get_grid($grid);
    $grid_total = count($grid);
    echo flatsome_get_grid_height($grid_height, $_id);
  }

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

  $css_col = array(
    array( 'attribute' => 'border-radius', 'value' => $image_radius, 'unit' => '%'),
  );

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


 if($animate) {$animate = 'data-animate="'.$animate.'"';}

 ob_start();

 echo '<div id="' . $_id . '" class="portfolio-element-wrapper has-filtering">';

 // Add fitler
 if($filter && $filter != 'disabled' && empty($cat) && $type !== 'grid' && $type !== 'slider' && $type !== 'full-slider'){
  // TODO: Get categories for filtering.
  wp_enqueue_script('flatsome-isotope-js');
  ?>
  <div class="container mb-half">
  <ul class="nav nav-<?php echo $filter;?> nav-<?php echo $filter_align ;?> nav-<?php echo $filter_nav;?> nav-uppercase filter-nav">
    <li class="active"><a href="#" data-filter="[data-id]"><?php echo __('All','flatsome'); ?></a></li>
    <?php
      $tax_terms = get_terms('featured_item_category');
      foreach ($tax_terms as $key => $value) {
         ?><li><a href="#" data-filter="[data-id*='<?php echo $value->name; ?>']"><?php echo $value->name; ?></a></li><?php
      }
    ?>
  </ul>
  </div>
  <?php
} else{
  $filter = false;
}

// Repeater options
$repeater['id'] = $_id;
$repeater['tag'] = $tag;
$repeater['type'] = $type;
$repeater['style'] = $style;
$repeater['slider_style'] = $slider_nav_style;
$repeater['slider_nav_color'] = $slider_nav_color;
$repeater['slider_nav_position'] = $slider_nav_position;
$repeater['slider_bullets'] = $slider_bullets;
$repeater['auto_slide'] = $auto_slide;
$repeater['row_spacing'] = $col_spacing;
$repeater['row_width'] = $width;
$repeater['columns'] = $columns;
$repeater['columns__sm'] = $columns__sm;
$repeater['columns__md'] = $columns__md;
$repeater['depth'] = $depth;
$repeater['depth_hover'] = $depth_hover;
$repeater['filter'] = $filter;

global $wp_query;

$args = array(
  'post_type' => 'featured_item',
);

// Exclude

// If custom Ids
if ( isset( $atts['ids'] ) ) {
  $ids = explode( ',', $atts['ids'] );
  $ids = array_map( 'trim', $ids );
  $args['post__in'] = $ids;
  $args['orderby'] = 'post__in';
} else {
  $args['offset'] = $offset;
  $args['order'] = $order;
  $args['orderby'] = $orderby;
  if($exclude) $args['post__not_in'] = explode( ',', $exclude );
  $args['posts_per_page'] = $number;
  if ( !empty( $atts['cat'] ) ) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'featured_item_category',
        'field' => 'id',
        'terms' => $cat,
      ),
    );
  }
}

$wp_query = new WP_Query( $args );


// Disable slider if less than selected products pr row.
if ( $wp_query->post_count < ($repeater['columns']+1) ) {
  if($repeater['type'] == 'slider') $repeater['type'] = 'row';
}


// Get repater structure
echo get_flatsome_repeater_start($repeater);

 ?>
  <?php

        if ( $wp_query->have_posts() ) :

        while ($wp_query->have_posts()) : $wp_query->the_post();
          $link = get_permalink(get_the_ID());

          $has_lightbox = '';
          if($lightbox == 'true'){
            $link = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
            $link = $link[0];
            $has_lightbox = 'lightbox-gallery';
          }

          $image = get_post_thumbnail_id();
          $classes_col = array('col');

          // Add Columns for Grid style
          if($type == 'grid'){
              if($grid_total > $current_grid) $current_grid++;
              $current = $current_grid-1;

              $classes_col[] = 'grid-col';
              if($grid[$current]['height']) $classes_col[] = 'grid-col-'.$grid[$current]['height'];

              if($grid[$current]['span']) $classes_col[] = 'large-'.$grid[$current]['span'];
              if($grid[$current]['md']) $classes_col[] = 'medium-'.$grid[$current]['md'];

              // Set image size
              if($grid[$current]['size']) $image_size = $grid[$current]['size'];
          }

          ?>
          <div class="<?php echo implode(' ', $classes_col); ?>" data-id="<?php  echo strip_tags( get_the_term_list( get_the_ID(), 'featured_item_category', "",", " ) );?>" <?php echo $animate; ?>>
          <div class="col-inner" <?php echo get_shortcode_inline_css($css_col); ?>>
          <a href="<?php echo $link; ?>" class="plain <?php echo $has_lightbox; ?>">
          <div class="<?php echo implode(' ', $classes_box); ?>">
            <div class="box-image">
                <div class="<?php echo implode(' ', $classes_image); ?>"<?php echo get_shortcode_inline_css($css_image_height); ?>>
                <?php echo wp_get_attachment_image($image, $image_size); ?>
                <?php if($image_overlay) { ?><div class="overlay" style="background-color:<?php echo $image_overlay; ?>"></div><?php } ?>
                <?php if($style == 'shade'){ ?><div class="shade"></div><?php } ?>
                </div>
            </div><!-- box-image -->
            <div class="<?php echo implode(' ', $classes_text); ?>">
                  <div class="box-text-inner">
                      <h6 class="uppercase portfolio-box-title"><?php the_title(); ?></h6>
                      <p class="uppercase portfolio-box-category is-xsmall op-6">
                        <span class="show-on-hover">
                         <?php  echo strip_tags( get_the_term_list( get_the_ID(), 'featured_item_category', "",", " ) );?>
                        </span>
                      </p>
                  </div><!-- box-text-inner -->
            </div><!-- box-text -->
           </div><!-- .box  -->
           </a>
           </div><!-- .col-inner -->
           </div><!-- .col -->
          <?php
          endwhile;
          endif;
          wp_reset_query();

  echo get_flatsome_repeater_end($repeater);
  echo '</div>';

  $args = array(
   'image_width' => array(
      'selector' => '.box-image',
      'property' => 'width',
      'unit' => '%',
    ),
   'text_padding' => array(
      'selector' => '.box-text',
      'property' => 'padding',
    ),
  );
  echo ux_builder_element_style_tag($_id, $args, $atts);

  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}
add_shortcode("featured_items_slider", "flatsome_portfolio_shortcode");
add_shortcode("featured_items_grid", "flatsome_portfolio_shortcode");
add_shortcode("ux_portfolio", "flatsome_portfolio_shortcode");
