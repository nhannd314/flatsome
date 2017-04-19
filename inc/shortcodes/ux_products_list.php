<?php

// Flatsome Products
function ux_products_list($atts, $content = null, $tag) {
  global $woocommerce;

  extract(shortcode_atts(array(
    'title' => '',
    'ids' => '',
    'products' => '8',
    'cat' => '',
    'excerpt' => 'visible',
    'offset' => '',
    'orderby' => '', // normal, sales, rand, date
    'order' => '',
    'tags' => '',
    'show' => '' //featured, onsale

  ), $atts));

  ob_start();

  echo '<ul class="product_list_widget">';
    if(empty($ids)){
      $products = ux_list_products($atts);
    } else {
      // Get custom ids
      $ids = explode( ',', $ids );
      $ids = array_map( 'trim', $ids );

      $args = array(
        'post__in' => $ids,
        'post_type' => 'product',
        'numberposts' => -1,
        'orderby' => 'post__in',
        'ignore_sticky_posts' => true,
      );

      $products = new WP_Query( $args );
     }

    if ( $products->have_posts() ) : ?>

        <?php while ( $products->have_posts() ) : $products->the_post(); ?>
          <?php echo wc_get_template_part( 'content', 'product-small' ); ?>
        <?php endwhile; // end of the loop. ?>

      <?php
    endif;
    wp_reset_query();

  echo '</ul>';
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}
add_shortcode("ux_products_list", "ux_products_list");
