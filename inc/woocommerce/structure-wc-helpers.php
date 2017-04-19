<?php
// Get Product Lists
function ux_list_products($args) {
              global $post, $woocommerce, $product;

              if(isset($args)){
                  $options = $args;

                  $number = 8;
                  if(isset($options['products'])) $number = $options['products'];

                  $show = ''; //featured, onsale
                  if(isset($options['show'])) $show = $options['show'];

                  $orderby = 'date';
                  $order = 'desc';

                  if(isset($options['orderby'])) $orderby = $options['orderby'];
                  if(isset($options['order'])) $order = $options['order'];

                  if($orderby == 'menu_order'){
                    $order = 'asc';
                  }

                  // Get Category
                  $cat = '';
                  if(isset($options['cat'])){
                    if(is_numeric($options['cat']) && get_term($options['cat'])){
                      $cat = get_term($options['cat'])->slug;
                    } else{
                      $cat = $options['cat'];
                    }
                  }

                  $tags = '';
                  if(isset($options['tags'])) {
                    if(is_numeric($options['tags'])){
                     $options['tags'] = get_term($options['tags'])->slug;
                    }
                    $tags = $options['tags'];
                  }

                  $offset = '';
                  if(isset($options['offset'])) $offset = $options['offset'];

              }  else{
                  return false;
              }

              $query_args = array(
                'posts_per_page' => $number,
                'post_status'    => 'publish',
                'post_type'      => 'product',
                'no_found_rows'  => 1,
                'ignore_sticky_posts'   => 1,
                'order'          => $order,
                'product_tag' => $tags,
                'offset' => $offset,
                'meta_query'  => WC()->query->get_meta_query(),
                'tax_query'   => WC()->query->get_tax_query(),
              );

              switch ( $show ) {
                case 'featured' :

                  if(woocommerce_version_check('3.0.0')) {
                  $query_args['tax_query'][] = array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'featured',
                    'operator' => 'IN',
                  ); } else {
                    $query_args['meta_query'][] = array(
                      'key'   => '_featured',
                      'value' => 'yes'
                    );
                  }
                  break;
                case 'onsale' :
                  $query_args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
                break;
              }

              switch ( $orderby ) {
                case 'menu_order' :
                  $query_args['orderby'] = 'menu_order';
                   break;
                case 'title' :
                  $query_args['orderby'] = 'name';
                   break;
                case 'date' :
                  $query_args['orderby'] = 'date';
                   break;
                case 'price' :
                  $query_args['meta_key'] = '_price';
                  $query_args['orderby']  = 'meta_value_num';
                  break;
                case 'rand' :
                  $query_args['orderby']  = 'rand';
                  break;
                case 'sales' :
                  $query_args['meta_key'] = 'total_sales';
                  $query_args['orderby']  = 'meta_value_num';
                  break;
                default :
                  $query_args['orderby']  = 'date';
              }

              if(!empty($cat)) {
                $query_args = ux_maybe_add_category_args( $query_args, $cat, 'IN' );
              }
              
              $results = new WP_Query( $query_args );

              return $results;
} // List products


function ux_maybe_add_category_args( $args, $category, $operator ) {
    if ( ! empty( $category ) ) {
      if ( empty( $args['tax_query'] ) ) {
        $args['tax_query'] = array();
      }
      $args['tax_query'][] = array(
        array(
          'taxonomy' => 'product_cat',
          'terms'    => array_map( 'sanitize_title', explode( ',', $category ) ),
          'field'    => 'slug',
          'operator' => $operator,
        ),
      );
    }
    return $args;
}

/* Set Default WooCommerce Image sizes */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ){
  function flatsome_woocommerce_image_dimensions() {
      $catalog = array(
      'width'   => '247', // px
      'height'  => '300', // px
      'crop'    => 1    // true
    );

    $single = array(
      'width'   => '510', // px
      'height'  => '600', // px
      'crop'    => 1    // true
    );

    $thumbnail = array(
      'width'   => '114', // px
      'height'  => '130', // px
      'crop'    => 1    // false
    );


  // Catalog Image sizes
    update_option( 'shop_catalog_image_size', $catalog );     // Product category thumbs
    update_option( 'shop_single_image_size', $single );     // Single product image
    update_option( 'shop_thumbnail_image_size', $thumbnail );   // Image gallery thumbs
  }
  add_action( 'init', 'flatsome_woocommerce_image_dimensions', 1 );
}
