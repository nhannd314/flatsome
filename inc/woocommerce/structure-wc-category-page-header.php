<?php

/* Remove default Hooks */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

/* Add Ordering to Flatsome tools */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

add_action( 'flatsome_category_title_alt', 'woocommerce_result_count', 20);
add_action( 'flatsome_category_title_alt', 'woocommerce_catalog_ordering', 30);



function flatsome_category_header(){
    global $wp_query;

    // Set Custom Shop Header
    if(flatsome_option('html_shop_page') && is_shop() && $wp_query->query_vars['paged'] < 1){
        echo do_shortcode('<div class="custom-page-title">'.flatsome_option('html_shop_page').'</div>');
        echo wc_get_template_part('layouts/headers/category-title');
    }
    // Set Category headers
    else if(is_product_category() || is_shop() || is_product_tag()){
        // Get Custom Header Content
        $cat_header_style = get_theme_mod('category_title_style');

        // Fix Transparent header
        if(get_theme_mod('category_header_transparent', 0) && !$cat_header_style){
          $cat_header_style = 'featured';
        }

        $queried_object = get_queried_object();
        if(!is_shop() && get_term_meta($queried_object->term_id, 'cat_meta')){
            $content = get_term_meta($queried_object->term_id, 'cat_meta');
            if(!empty($content[0]['cat_header'])){
                if(!$cat_header_style){
                    echo do_shortcode($content[0]['cat_header']);
                    echo wc_get_template_part('layouts/headers/category-title');
                } else{
                    echo wc_get_template_part('layouts/headers/category-title',$cat_header_style);
                    echo '<div class="custom-category-header">'.do_shortcode($content[0]['cat_header']).'</div>';
                }

            } else{
              // Get default header title
              return wc_get_template_part('layouts/headers/category-title',$cat_header_style);
            }
        } else {
            // Get default header title
            return wc_get_template_part('layouts/headers/category-title',$cat_header_style);
        }
    }
}

add_action('flatsome_after_header','flatsome_category_header');


// Add Transparent Header To Cateogry if Set
function flatsome_category_header_classes($classes){

    $transparent = flatsome_option('category_header_transparent');
    if($transparent && is_shop() || $transparent && is_product_category() || $transparent && is_product_tag()){
         $classes[] = 'transparent has-transparent nav-dark toggle-nav-dark';
    }

    return $classes;
}

add_filter('flatsome_header_class','flatsome_category_header_classes', 10);



// Add Category Filter button for Mobile and Off Canvas.
function flatsome_add_category_filter_button() {
  echo wc_get_template_part('loop/filter-button');
}
add_action('flatsome_category_title', 'flatsome_add_category_filter_button',20);

// Add Category Title if set
if(!function_exists('flatsome_category_title')) {
  function flatsome_category_title(){
      if(!flatsome_option('category_show_title')) return; ?>
       <h1 class="shop-page-title is-xlarge"><?php woocommerce_page_title(); ?></h1>
      <?php
  }
}
add_action('flatsome_category_title','flatsome_category_title',1);

// Add Breadcrumbs
function flatsome_shop_loop_tools_breadcrumbs(){
  echo wc_get_template_part('loop/breadcrumbs');
}
add_action('flatsome_category_title','flatsome_shop_loop_tools_breadcrumbs',10);
