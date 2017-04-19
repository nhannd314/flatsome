<?php


// Add Exerpts to top
function flatsome_page_top_excerpt(){ 
  if( has_excerpt() ) { ?>
  <div class="page-header-excerpt">
    <?php the_excerpt(); ?>
  </div>
  <?php }
}
add_action('flatsome_before_page','flatsome_page_top_excerpt', 20);


// Add Pages Classes
function flatsome_page_header_options($classes){

    // Header classes for pages
    if(is_page()){
      
        global $page;

       $page_template =  get_post_meta( get_the_ID(), '_wp_page_template', true );

       // Get default page template
       if(flatsome_option('pages_template') !== 'blank' && $page_template == 'default' || empty($page_template)) {
          $page_template = flatsome_option('pages_template');
       }

       // Set header classes
       if(!empty($page_template)) {

          if(strpos($page_template, 'transparent') !== false) {
               $classes[] = 'transparent has-transparent';
          }

          if(strpos($page_template, 'header-on-scroll') !== false) {
               $classes[] = 'show-on-scroll';
          }
       }
    }
    return $classes;
}

add_filter('flatsome_header_class','flatsome_page_header_options', 10);


// Pages Breadcrumbs
function get_flatsome_breadcrumbs($classes = ''){
      // Yoast Breadcrumbs
      if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb('<nav class="breadcrumbs page-breadcrumbs">','</nav>');
      } 
      // WooCommerce breadcrumbs
      else if(function_exists('woocommerce_breadcrumb') ){ 
        woocommerce_breadcrumb();
      }
}


// Pages SubNav
function get_flatsome_subnav($style = '', $string = '', $parent = ''){
   if(is_page()){
     global $post;
     if ( is_page() && $post->post_parent )
        $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
      else
        $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
      if ( $childpages ) {

        // Add active class
        $childpages = str_replace("current_page_item","current_page_item active",$childpages);
        $string = '<ul class="nav '.$style.'">' . $childpages . '</ul>';
      }

     echo $string;
  }
}