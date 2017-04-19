<?php

// Fallbacks
function flatsome_add_fallbacks () {

  $ie_css = get_template_directory_uri() .'/assets/css/ie-fallback.css';

  echo '<!--[if IE]>';
  echo '<link rel="stylesheet" type="text/css" href="'.$ie_css.'">';
  echo '<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>';
  echo "<script>var head = document.getElementsByTagName('head')[0],style = document.createElement('style');style.type = 'text/css';style.styleSheet.cssText = ':before,:after{content:none !important';head.appendChild(style);setTimeout(function(){head.removeChild(style);}, 0);</script>";
  // Flexbox polyfill
  echo '<script src="'.get_template_directory_uri() .'/assets/libs/ie-flexibility.js"></script>';
  echo '<![endif]-->';
}
add_action('wp_head', 'flatsome_add_fallbacks');
