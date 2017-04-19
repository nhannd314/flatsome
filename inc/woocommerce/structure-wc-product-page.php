<?php

function flatsome_product_summary_fix(){
  if(is_product()){
    if(!get_theme_mod('product_info_meta', 1)){
      remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);
    }
    if(!get_theme_mod('product_info_share', 1)){
      remove_action('woocommerce_single_product_summary','woocommerce_template_single_sharing',50);
    }
  }
}
add_action('wp_head','flatsome_product_summary_fix', 9999);

// Product summary classes
function flatsome_product_summary_classes(){
    $classes = array('product-summary');
    if(get_theme_mod('product_info_align')){
       $classes[] = 'text-'.flatsome_option('product_info_align');
    }
    if(get_theme_mod('product_info_form')){
      $classes[] = 'form-'.flatsome_option('product_info_form');
    }
    echo implode(' ', $classes);
}

function flatsome_product_upsell_sidebar(){
  // Product Upsell
    if(get_theme_mod('product_upsell','sidebar') == 'sidebar') {
        remove_action( 'woocommerce_after_single_product_summary' , 'woocommerce_upsell_display', 15);
        add_action('flatsome_before_product_sidebar','woocommerce_upsell_display', 2);
    }
    else if(get_theme_mod('product_upsell', 'sidebar') == 'disabled') {
        remove_action( 'woocommerce_after_single_product_summary' , 'woocommerce_upsell_display', 15);
    }
}
add_action('flatsome_before_product_sidebar','flatsome_product_upsell_sidebar', 1);

/* Add Share to product description */
if(!function_exists('flatsome_product_share')) {
  function flatsome_product_share() {
      echo do_shortcode('[share]');
  }
}
add_action( 'woocommerce_share', 'flatsome_product_share',  10 );


/* Remove Product Description Heading */
function flatsome_remove_product_description_heading($heading){
     return $heading = '';
}
add_filter('woocommerce_product_description_heading','flatsome_remove_product_description_heading');


/* Remove Additional Product Information Heading */
function flatsome_remove_product_information_heading($heading){
     return $heading = '';
}
add_filter('woocommerce_product_additional_information_heading','flatsome_remove_product_information_heading');


// Add Extra Product Images to Product Slider
if(!function_exists('flatsome_add_extra_product_images')) {
    function flatsome_add_extra_product_images(){
        global $post;

        $_pf = new WC_Product_Factory();

        $_product = $_pf->get_product(get_the_ID());

        $image_size = 'shop_single';

        if(flatsome_option('product_layout') == 'gallery-wide' && is_product()){
          $image_size = 'large';
        }

        $attachment_ids = woocommerce_version_check('3.0.0') ? $_product->get_gallery_image_ids() : $_product->get_gallery_attachment_ids();

        if ( $attachment_ids ) {
            $loop = 0;
            $columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

            foreach ( $attachment_ids as $attachment_id ) {

                $image_title  = esc_attr( get_the_title( $attachment_id ) );
                $image_caption  = get_post( $attachment_id )->post_excerpt;
                $image_link   = wp_get_attachment_url( $attachment_id );
                $image =  wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', $image_size ), array('title' => $image_title,'alt' => $image_title) );
                echo apply_filters( 'woocommerce_single_product_image_html',sprintf( '<div class="slide"><a href="%s" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto[product-gallery]">%s</a></div>', $image_link, $image_caption, $image ), $attachment_id);
            }
        }
    }
}

add_action('flatsome_single_product_images','flatsome_add_extra_product_images');


// Move Sale Flash to another hook
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash',10);
add_action('flatsome_sale_flash','woocommerce_show_product_sale_flash',10);


// Add Product Video Button
if(!function_exists('flatsome_product_video_button')){
function flatsome_product_video_button(){
  global $wc_cpdf;
       // Add Product Video
      if($wc_cpdf->get_value(get_the_ID(), '_product_video')){ ?>
      <a class="button is-outline circle icon button product-video-popup tip-top" href="<?php echo $wc_cpdf->get_value(get_the_ID(), '_product_video'); ?>" title="<?php echo __( 'Video', 'flatsome' ); ?>">
            <?php echo get_flatsome_icon('icon-play'); ?>
      </a>
      <style>
       <?php
          // Set product video height
          $height = '900px';
              $width = '900px';
              $iframe_scale = '100%';
              $custom_size = $wc_cpdf->get_value(get_the_ID(), '_product_video_size');
              if($custom_size){
                $split = explode("x", $custom_size);

                $height = $split[0];
                $width = $split[1];

          $iframe_scale = ($width/$height*100).'%';
              }
              echo '.has-product-video .mfp-iframe-holder .mfp-content{max-width: '.$width.';}';
              echo '.has-product-video .mfp-iframe-scaler{padding-top: '.$iframe_scale.'}';
         ?>
      </style>
      <?php }
  }
}
add_action('flatsome_product_image_tools_bottom','flatsome_product_video_button', 1);


// Product Image Lightbox
function flatsome_product_lightbox_button(){
   if(get_theme_mod('product_lightbox', 'default') !== 'disabled') { ?>
    <a href="#product-zoom" class="zoom-button button is-outline circle icon tooltip hide-for-small" title="<?php echo __( 'Zoom', 'flatsome' ); ?>">
      <?php echo get_flatsome_icon('icon-expand'); ?>
    </a>
 <?php }
}
add_action('flatsome_product_image_tools_bottom','flatsome_product_lightbox_button', 2);


// Add Product Body Classes
function flatsome_product_body_classes( $classes ) {

    // Add Frame Class for Posts
    if(is_product() && get_theme_mod('product_lightbox', 'default') == 'flatsome'){
       $classes[] = 'has-lightbox';
    }

    return $classes;
}
add_filter( 'body_class', 'flatsome_product_body_classes' );


function flatsome_product_video_tab(){
   global $wc_cpdf;
   echo apply_filters('the_content', $wc_cpdf->get_value(get_the_ID(), '_product_video'));
}

// Custom Product Tabs
function flatsome_custom_product_tabs( $tabs ) {
  global $wc_cpdf;

    // Product video Tab
  if($wc_cpdf->get_value(get_the_ID(), '_product_video_placement') == 'tab'){
      $tabs['ux_video_tab'] = array(
        'title'   => __('Video','flatsome'),
        'priority'  => 10,
        'callback'  => 'flatsome_product_video_tab'
      );
  }

  // Adds the new tab
  if($wc_cpdf->get_value(get_the_ID(), '_custom_tab_title')){
    $tabs['ux_custom_tab'] = array(
      'title'   =>  $wc_cpdf->get_value(get_the_ID(), '_custom_tab_title'),
      'priority'  => 40,
      'callback'  => 'flatsome_custom_tab_content'
    );
  }

  // Custom Global Section
  if(get_theme_mod('tab_title')){
      $tabs['ux_global_tab'] = array(
        'title'   => get_theme_mod('tab_title'),
        'priority'  => 50,
        'callback'  => 'flatsome_global_tab_content'
      );
  }
  return $tabs;
}

add_filter( 'woocommerce_product_tabs', 'flatsome_custom_product_tabs' );

function flatsome_custom_tab_content() {
  // The new tab content
  global $wc_cpdf;
  echo do_shortcode($wc_cpdf->get_value(get_the_ID(), '_custom_tab'));
}

function flatsome_global_tab_content() {
  // The new tab content
  echo do_shortcode(get_theme_mod('tab_content'));
}


function flatsome_product_tabs_classes(){
    $classes = array('nav','nav-uppercase');
    $tab_style = get_theme_mod('product_display','tabs');
    if($tab_style == 'tabs' || !$tab_style){
      $classes[] = 'nav-line';
    } else{
      $tab_style = str_replace("tabs_","",$tab_style);
      if($tab_style == 'vertical') $classes[] = 'nav-line';
      if($tab_style == 'normal') $classes[] = 'nav-tabs';
      $classes[] = 'nav-'.$tab_style;
    }

    $align = get_theme_mod('product_tabs_align','left');

    if($align){
        $classes[] = 'nav-'.$align;
    }

    echo implode(' ', $classes);
}


// Add Custom HTML Blocks
function flatsome_before_add_to_cart_html(){
    echo do_shortcode(get_theme_mod('html_before_add_to_cart'));
}
add_action( 'woocommerce_single_product_summary', 'flatsome_before_add_to_cart_html', 20);


// Add HTML after Add to Cart button
function flatsome_after_add_to_cart_html(){
    echo do_shortcode(get_theme_mod('html_after_add_to_cart'));
}
add_action( 'woocommerce_single_product_summary', 'flatsome_after_add_to_cart_html', 30);


// Add Custom HTML to top of product page
function flatsome_product_top_content(){
  global $wc_cpdf;
  if($wc_cpdf->get_value(get_the_ID(), '_top_content')){
    echo do_shortcode($wc_cpdf->get_value(get_the_ID(), '_top_content'));
  }
}

add_action('flatsome_before_product_page','flatsome_product_top_content', 10);


// Add Custom HTML to bottom of product page
function flatsome_product_bottom_content(){
  global $wc_cpdf;
  if($wc_cpdf->get_value(get_the_ID(), '_bottom_content')){
    echo do_shortcode($wc_cpdf->get_value(get_the_ID(), '_bottom_content'));
  }
}
add_action('flatsome_after_product_page','flatsome_product_bottom_content', 10);
