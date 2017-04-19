<?php

// Fix options for next Flatsome version.

function flatsome_is_upgrading(){
  // Check if old depricated (not available in v3) option exist.
  $is_old = get_theme_mod('nav_position');
  if(!empty($is_old)) return true;
}

function flatsome_fix_old_content(){

   // Upgrade to flatsome 3.0
   if(get_theme_mod('flatsome_version') < 3){

      $options = get_theme_mods();
      
      // Check if old content is installed
      if(flatsome_is_upgrading()){
        set_theme_mod('flatsome_fallback', 1);
        update_option('envato_setup_complete', time());
      } else {
        set_theme_mod('flatsome_fallback', 0); 
      }

     if(!isset($options['topbar_elements_left'])) set_theme_mod('topbar_elements_left', flatsome_topbar_elements_left());
     if(!isset($options['topbar_elements_right'])) set_theme_mod('topbar_elements_right', flatsome_topbar_elements_right());
     if(!isset($options['header_elements_left'])) set_theme_mod('header_elements_left', flatsome_header_elements_left());
     if(!isset($options['header_elements_right'])) set_theme_mod('header_elements_right', flatsome_header_elements_right());

     if(!isset($options['header_elements_bottom_left'])) set_theme_mod('header_elements_bottom_left', flatsome_header_elements_bottom_left());
     if(!isset($options['header_elements_bottom_center'])) set_theme_mod('header_elements_bottom_center', flatsome_header_elements_bottom_center());
     if(!isset($options['header_elements_bottom_right'])) set_theme_mod('header_elements_bottom_right', flatsome_header_elements_bottom_right());

     if(!isset($options['header_mobile_elements_left'])) set_theme_mod('header_mobile_elements_left', flatsome_header_mobile_elements_left());
     if(!isset($options['header_mobile_elements_right'])) set_theme_mod('header_mobile_elements_right', flatsome_header_mobile_elements_right());
     if(!isset($options['header_mobile_elements_top'])) set_theme_mod('header_mobile_elements_top', flatsome_header_mobile_elements_top());

     if(!isset($options['mobile_sidebar'])) set_theme_mod('mobile_sidebar', flatsome_header_mobile_sidebar());
     if(!isset($options['product_layout'])) set_theme_mod('product_layout', flatsome_product_layout());
     if(!flatsome_is_upgrading()) set_theme_mod('payment_icons_placement', 'footer');

     // Set follow icons
     if(!isset($options['follow_twitter'])) set_theme_mod('follow_twitter','http://url');
     if(!isset($options['follow_facebook'])) set_theme_mod('follow_facebook','http://url');
     if(!isset($options['follow_instagram'])) set_theme_mod('follow_instagram','http://url');
     if(!isset($options['follow_email'])) set_theme_mod('follow_email','your@email');

     set_theme_mod('flatsome_version', 3);
   }
}
add_action( 'after_setup_theme', 'flatsome_fix_old_content');

$old_nav = get_theme_mod('nav_position');
$old_nav_topbar = get_theme_mod('topbar_show');
$old_search = get_theme_mod('search_pos');

function flatsome_topbar_elements_left(){
  global $old_nav, $old_nav_topbar;
  if($old_nav && !$old_nav_topbar) return array();
  
  $options[] = 'html';

  return $options;
}

function flatsome_topbar_elements_right(){
  global $old_nav, $old_nav_topbar;
  if($old_nav && !$old_nav_topbar) return array();

  $options = array('nav-top');

  if(get_theme_mod('myaccount_dropdown') == 'top_bar'){
      $options[] = 'account';
  }
  if(get_theme_mod('show_cart') == 'top_bar'){
      $options[] = 'cart';
  }

  if(!$old_nav) $options[] = 'newsletter';

  if(!$old_nav) $options[] = 'social';

  if($old_nav) $options[] = 'html-2';

  return $options;
}



// Header Main Left
function flatsome_header_elements_left(){
  global $old_nav, $old_search;
  $options = array();

  if($old_nav){
    if($old_nav == 'bottom' || $old_nav == 'bottom_center'){
      if($old_search == 'left') $options[] = 'search-form';
    }
    if($old_nav == 'top' && $old_search == 'left') $options[] = 'search';
    if($old_nav == 'top') $options[] = 'nav';
    if($old_nav == 'top' && $old_search == 'right') $options[] = 'search';
    if($old_nav == 'bottom_center' || $old_nav == 'bottom') $options[] = 'html-4';
  } else {
    $options[] = 'search';
    $options[] = 'nav';
  }

  return $options;
}

// Header Main Right
function flatsome_header_elements_right(){
  global $old_nav, $old_search;
  $cart = get_theme_mod('show_cart');
  $account = get_theme_mod('myaccount_dropdown');
  $options = array();

  if($old_nav){

      if($old_nav == 'top_right' && $old_search == 'left') $options[] = 'search';
      if($old_nav == 'top_right') $options[] = 'nav';
      if($old_nav == 'top_right' && $old_search == 'right') $options[] = 'search';

      $options[] = 'html-3';

      if(!empty($account) || $account == 1){
        $options[] = 'account';
      }
      if($cart == 1 && $account == 1){
        $options[] ='divider';
      }
      if(!empty($cart) || $cart == 1){
        $options[] = 'cart';
      }

  } else{
     $options = array('account','divider','cart');
  }

  return $options;
}

// Header Bottom Left
function flatsome_header_elements_bottom_left(){
  global $old_nav, $old_search;
  $options = array();
  if($old_nav && $old_nav == 'bottom') $options[] = 'nav';
  if($old_nav && ($old_search == 'right' && $old_nav == 'bottom')) $options[] = 'search';
  return $options;
}

// Header Bottom Center
function flatsome_header_elements_bottom_center(){
  global $old_nav, $old_search;
  $options = array();
  if($old_nav) {
      if($old_nav == 'bottom_center') $options[] = 'search';
      if($old_nav == 'bottom_center') $options[] = 'nav';
      if($old_nav == 'bottom_center' && $old_search == 'right') $options[] = 'search';
  }
  return $options;
}

// Header Bottom Right
function flatsome_header_elements_bottom_right(){
  global $old_nav, $old_search;
  $options = array();
  
  if($old_nav == 'bottom') {
    $options[] = 'html-5';
  }

  return $options;
}


// Mobile Left
function flatsome_header_mobile_elements_left(){
   $options = array('menu-icon');
   return $options;
}

// Mobile Sidebar
function flatsome_header_mobile_sidebar(){
  global $old_nav, $old_nav_topbar;
  $options = array('search-form','nav',);
  $account = get_theme_mod('myaccount_dropdown');

  if($old_nav_topbar){
    $options[]= 'divider';
    $options[]= 'nav-top';
  }

  if(!$old_nav || $account == 1){
    $options[] = 'account';
  }
  
  if(!$old_nav) $options[] = 'newsletter';
  if(!$old_nav) $options[] = 'social';
  
  $options[] = 'html-2';
  $options[] = 'html-3';

  return $options;
}

// Mobile right
function flatsome_header_mobile_elements_right(){
  global $old_nav, $old_search;
   $options = array();
   
   if($old_nav){
      if(get_theme_mod('show_cart') == 1) $options[] = 'cart';
   } else{
     $options[] = 'cart';
   }
   
   return $options;
}

// Mobile Top
function flatsome_header_mobile_elements_top(){
   global $old_nav, $is_topbar;
   if($old_nav && !$is_topbar) return array();

   $options = array('html');

   return $options;
}
// Fix old product sidebar layout
function flatsome_product_layout(){
  $old_sidebar = get_theme_mod('product_sidebar');
  if(isset($old_sidebar)){
    if($old_sidebar === 'no_sidebar'){
      return 'right-sidebar-small';
    } else if($old_sidebar === 'full_width'){
      return 'no-sidebar';
    } else if($old_sidebar === 'left_sidebar'){
      return 'left-sidebar-full';
    } else if($old_sidebar === 'right_sidebar'){
      return 'right-sidebar';
    } else if($old_sidebar === 'right_sidebar_fullheight'){
      return 'right-sidebar-full';
    }
  } else {
    return 'right-sidebar-small';
  }
}