<?php


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
