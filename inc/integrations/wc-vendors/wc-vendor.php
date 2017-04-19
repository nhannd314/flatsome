<?php

// Add 
function flatsome_header_language($elements){
  $elements['wpml'] = __( 'Languages', 'flatsome-admin' );
  return $elements;
}
add_filter('flatsome_header_element', 'flatsome_header_language');

// Language Dropdown Elements
function flatsome_header_languages($value){

  // Polylang dropdown
  if($value == 'wpml' && function_exists('pll_the_languages')){
     $current_language = pll_current_language('name');     
     $languages = pll_the_languages(array('raw' => 1));

     echo '<li class="has-dropdown"><a>'.$current_language.get_flatsome_icon('icon-angle-down').'</a>';
     echo '<ul class="nav-dropdown">';
     foreach ($languages as $lang){
     	 $classes = implode(' ', $lang['classes']);
     	 $flag = '<img src="'.$lang['flag'].'" alt="'.$lang['name'].'"/>';

     	 if($lang['current_lang']){
     	 	$current_language = $lang['name'];
     	 }

     	 echo '<li class="'.$classes.'"><a href="'.$lang['url'].'">'.$flag.$lang['name'].'</a></li>';
     }
     echo '</ul></li>';

    // WPML Dropdown
   } else if($value == 'wpml' && function_exists('icl_get_languages')){

     $current_language = ICL_LANGUAGE_NAME;

     $languages = icl_get_languages();

     echo '<li class="has-dropdown"><a>'.$current_language.get_flatsome_icon('icon-angle-down').'</a>';
     echo '<ul class="nav-dropdown">';
     foreach ($languages as $lang){
     	 $flag = '<img src="'.$lang['country_flag_url'].'" alt="'.$lang['native_name'].'"/>';

     	 if($lang['active']){
     	 	$current_language = $lang['native_name'];
     	 }

     	 echo '<li><a href="'.$lang['url'].'">'.$flag.$lang['native_name'].'</a></li>';
     }
     echo '</ul></li>';
   }
}
add_action('flatsome_header_elements', 'flatsome_header_languages');


/* Copy polylang content to new languages */
if (function_exists('pll_get_post')){ // is Polylang activated?
  add_filter('default_content','ux_copy_post_translation', 100, 2);
  add_filter('default_title','ux_copy_post_translation', 100, 2);
  function ux_copy_post_translation($content, $post){
          $from_post = isset($_GET['from_post'])? (int)$_GET['from_post'] : false;
          if($content == ''){
                  $from_post = get_post($from_post);
                  if($from_post)
                  switch(current_filter()){
                          case 'default_content':
                                  $content = $from_post->post_content;
                                  break;
                          case 'default_title':
                                  $content = $from_post->post_title;
                                  break;
                          default:
                                  break;
                  }
          }
          return $content;
  }
}