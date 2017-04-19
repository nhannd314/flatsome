<?php
// [ux_price_table]
function ux_price_table( $atts, $content = null ){
  extract( shortcode_atts( array(
    'title' => 'Title',
    'price' => '$99.99',
    'description' => '',
    'featured' => '',
    'radius' => '',
    'color' => '',
    'bg_color' => '',
    'depth' => '',
    'depth_hover' => '3',

    // Depricated
    'button_style' => '',
    'button_text' => '',
    'button_link' => '',
  ), $atts ) );
  ob_start();

  $classes = array('pricing-table','ux_price_table');
  $classes_wrapper = array('pricing-table-wrapper');

  $classes[] = 'text-center';

  if($color == 'dark') $classes_wrapper[] = 'dark';
  if($depth) $classes[] = 'box-shadow-'.$depth;
  if($depth_hover) $classes[] = 'box-shadow-'.$depth_hover.'-hover';
  if($featured) $classes[] = 'featured-table';

  $css_args = array(
      array( 'attribute' => 'border-radius', 'value' => $radius, 'unit' => 'px'),
      array( 'attribute' => 'background-color', 'value' => $bg_color ),
  );

?>
<div class="<?php echo implode(' ', $classes_wrapper); ?>">
  <div class="<?php echo implode(' ', $classes); ?>"<?php echo get_shortcode_inline_css($css_args); ?>>
    <div class="pricing-table-header">
      <div class="title uppercase strong"><?php echo $title;?></div>
      <div class="price is-xxlarge"><?php echo $price;?></div>
      <?php if(!empty($description)) { ?>
        <div class="description is-small">
          <?php echo $description;?>
        </div>
      <?php } ?>
    </div>
    <div class="pricing-table-items items">
      <?php echo flatsome_contentfix($content); ?>
    </div>
    <?php if($button_text) { ?>
    <div class="cta-button">
        <a class="button <?php echo $button_style;?>" href="<?php echo $button_link;?>">
        <?php echo $button_text;?></a>
    </div>
    <?php } ?>
  </div>
</div>

<?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode('ux_price_table', 'ux_price_table');

// Price bullet
function bullet_item( $atts, $content = null ){
  extract( shortcode_atts( array(
    'text' => 'Add any text here...',
    'tooltip' => '',
    'enabled' => ''
  ), $atts ) );
    $tooltip_html = '';
    $classes = array('bullet-item');
    if($enabled == 'false') $classes[] = 'is-disabled';
    if($tooltip) {
      $classes[] = 'tooltip';
      $classes[] = 'has-hover';
      $tooltip_html = '<span class="tag-label bullet-more-info circle">?</span>';
    }
    $content = '<div class="'.implode(' ',$classes).'" title="'.$tooltip.'"><span class="text">'.$text.'</span>'.$tooltip_html.'</div>';
    return $content;
}
add_shortcode('bullet_item', 'bullet_item');
