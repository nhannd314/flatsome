<?php
// [ux_banner_grid]
function flatsome_banner_grid($atts, $content = null) {
    extract( shortcode_atts( array(
    '_id' => 'banner-grid-'.rand(),
    'width' => '',
    'height' => '600px',
    'height__sm' => '',
    'height__md' => '',
    'spacing' => 'small',
    'depth' => '',
    'depth_hover' => '',
    // Depricated
    'padding' => '',
    'grid' => '',
    ), $atts ) );

    $classes = array('row','row-grid');

    // Fix old
    if($padding == '0px'){
      $spacing = 'collapse';
    }
    if($padding == '15px'){
      $spacing = 'small';
    }

    if($spacing) $classes[] = 'row-'.$spacing;
    if($depth) $classes[] = 'row-box-shadow-'.$depth;
    if($depth_hover) $classes[] = 'row-box-shadow-'.$depth_hover.'-hover';
    if($width == 'full-width') $classes[] = 'row-full-width';

    // Run masonry script
    wp_enqueue_script( 'flatsome-masonry-js');
    ob_start();
  ?>
  <div class="banner-grid-wrapper">
  <div id="<?php echo $_id; ?>" class="banner-grid <?php echo implode(' ', $classes); ?>" data-packery-options="">
          <?php if(has_shortcode( $content, 'col_grid' ) || has_shortcode( $content, 'col' )) { ?>
            <?php echo flatsome_contentfix( $content ) ?>
          <?php } else {

              // Fix old content
              $pattern = get_shortcode_regex();
              $columns = 0;
              $current_grid = 0;
              $grid = flatsome_get_grid($grid);
              $grid_total = count($grid);
              echo flatsome_get_grid_height($height, $_id);

              if (preg_match_all( '/'. $pattern .'/s', $content, $matches )
                  && array_key_exists( 2, $matches )
                  && in_array( 'ux_banner', $matches[2] ) ){
                foreach ($matches[0] as $shortcode) {
                    if($grid_total > $current_grid) $current_grid++;
                    $current = $current_grid-1;
                    echo do_shortcode('[col_grid span="'.$grid[$current]['span'].'" span__md="'.$grid[$current]['md'].'" height="'.$grid[$current]['height'].'"]'.$shortcode.'[/col_grid]');
                }
              }
            }
          ?>
  </div><!-- .banner-grid .row .grid -->
  <?php echo flatsome_get_grid_height(array($height, $height__md, $height__sm), $_id); ?>
  </div><!-- .banner-grid-wrapper -->
  <?php
  // Get banner grid styles
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}
add_shortcode('ux_banner_grid', 'flatsome_banner_grid');


// [col_grid]
function ux_grid_col($atts, $content = null) {
  extract( shortcode_atts( array(
    'span' => '12',
    'span__md' => '',
    'span__sm' => '',
    'animate' => '',
    'height' => '',
    'class' => '',
    'depth' => '',
    'depth_hover' => '',
    ), $atts ) );

  $classes[] = 'col grid-col';
  $classes_inner[] = 'col-inner';

  if($class) $classes[] = $class;
  if($span__md) $classes[] = 'medium-'.$span__md;
  if($span__sm) $classes[] = 'small-'.$span__sm;
  if($span) $classes[] = 'large-'.$span;

  if(!$height) $classes[] = 'grid-col-1';
  if($height) $classes[] = 'grid-col-'.$height;

  // Add Animation Class
  if($animate) { $animate = 'data-animate="'.$animate.'"'; }

  // Add Depth Class
  if($depth) $classes_inner[] = 'box-shadow-'.$depth;
  if($depth_hover) $classes_inner[] = 'box-shadow-'.$depth.'-hover';

  $classes =  implode(" ", $classes);
  $classes_inner =  implode(" ", $classes_inner);

  $column = '<div class="'.$classes.'" '.$animate.'><div class="'.$classes_inner.'">'.$content.'</div></div>';

  return flatsome_contentfix($column);
}
add_shortcode('col_grid', 'ux_grid_col');
