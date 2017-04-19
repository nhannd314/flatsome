<?php

function get_flatsome_icon($name, $size = null){
  if($size) $size = 'style="font-size:'.$size.';"';
  return '<i class="'.$name.'" '.$size.'></i>';
}

// Lazy load icons
if ( get_theme_mod('lazy_load_icons', 0) ) {
function flatsome_lazy_add_icons_css() {
  ?>
  <script id="lazy-load-icons">
    /* Lazy load icons css file */
    var fl_icons = document.createElement('link');
    fl_icons.rel = 'stylesheet';
    fl_icons.href = '<?php echo get_template_directory_uri(); ?>/assets/css/fl-icons.css';
    fl_icons.type = 'text/css';
    var fl_icons_insert = document.getElementsByTagName('link')[0];
    fl_icons_insert.parentNode.insertBefore(fl_icons, fl_icons_insert);
  </script>
  <?php }
  add_action('wp_footer','flatsome_lazy_add_icons_css',10);
}

// Normal loading
if ( ! get_theme_mod('lazy_load_icons', 0) ) {
  function flatsome_lazy_icons_css() {
    wp_enqueue_style( 'flatsome-icons', get_template_directory_uri() .'/assets/css/fl-icons.css', array(), '3.3', 'all' );
  }
  add_action( 'wp_enqueue_scripts', 'flatsome_lazy_icons_css' );
}
