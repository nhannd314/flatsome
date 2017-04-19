<?php

// Flatsome Products
function ux_product_flip($atts, $content = null, $tag) {
  global $woocommerce;
  $sliderrandomid = rand();
  extract(shortcode_atts(array(
    '_id' => 'product-flip-'.rand(),
    'title' => '',
    'ids' => '',
    'width' => '',

    'slider_nav_style' => 'normal',
    'slider_nav_position' => 'outside',
    'slider_bullets' => 'true',
    'slider_arrows' => 'true',
    'auto_slide' => 'false',
    'infinitive' => 'true',

    // posts
    'cat' => '',
    'excerpt' => 'visible',
    'offset' => '',
    'filter' => '',

    // Posts Woo
    'products' => '8',
    'orderby' => '', // normal, sales, rand, date
    'order' => '',
    'tags' => '',
    'show' => '', //featured, onsale

    'depth' => '2',
    'depth_hover' => '',


  ), $atts));

  $slide_classes = array('slide');
  $slider_classes = array('slide');

  if($depth) $slider_classes[] = 'box-shadow-'.$depth;

  ob_start();

  ?>
  <?php

    if(empty($ids)){

      // Get products
      $atts['products'] = $products;
      $atts['offset'] = $offset;
      $atts['cat'] = $cat;

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
          <div class="row"><div class="large-12 col">
          <div style="background-color:#FFF;" class="slider flipContainer slider-nav-circle <?php echo implode(' ', $slider_classes);?>"
            data-flickity-options='{
              "cellAlign": "center",
              "wrapAround": true,
              "percentPosition": true,
              "imagesLoaded": true,
              "pageDots": true,
              "contain": true
          }'>
          <?php while ( $products->have_posts() ) : $products->the_post(); ?>
              <div class="<?php echo implode(' ', $slide_classes);?>" style="background-color:#FFF;"><?php wc_get_template_part( 'content', 'product-flipbook' ); ?></div>
          <?php endwhile; // end of the loop. ?>
          </div>
          </div></div>
          <?php

  endif;
  wp_reset_query();

  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}
add_shortcode("ux_product_flip", "ux_product_flip");
