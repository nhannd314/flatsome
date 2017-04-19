<?php

function flatsome_get_google_fonts_link_lazy(){

    $type_nav = get_theme_mod('type_nav', array('font-family'=> 'Lato','variant' => '700'));
    $type_texts = get_theme_mod('type_texts', array('font-family'=> 'Lato','variant' => '400'));
    $type_headings = get_theme_mod('type_headings',array('font-family'=> 'Lato','variant' => '700'));
    $type_alt = get_theme_mod('type_alt', array('font-family'=> 'Dancing Script'));

    // Fix old
    if(!is_array($type_nav)) {
      $type_nav = array('font-family' => $type_nav, 'variant' => 'default');
    }
    if(!is_array($type_texts)) {
      $type_texts = array('font-family' => $type_texts, 'variant' => 'default');
    }
    if(!is_array($type_alt)) {
      $type_alt = array('font-family' => $type_alt, 'variant' => 'default');
    }
    if(!is_array($type_headings)) {
      $type_headings = array('font-family' => $type_headings, 'variant' => 'default');
    }

    $fonts = array($type_headings, $type_texts, $type_nav, $type_alt);

    // Insert fonts
    $igonore = array(
      'default',
      'arial',
      'verdana',
      'trebuchet',
      'georgia',
      'times',
      'tahoma',
      'helvetica'
    );
    $f = '';
    foreach ($fonts as $font) {
      if(!empty($font['font-family'])) $f .= '"'.str_replace(' ', '+', $font['font-family']);
      // Always include regular variant as a workaround for Kirki
      // not updating the variant when font has only one variant.
      if(!empty($font['variant'])) $f .= ':regular,'.$font['variant'];
      if(!empty($font['subsets'])) {
        $font['subsets'] = array_unique( $font['subsets'] );
        $f .= ':'.implode( ',', $font['subsets'] );
      }
      $f .= '",';
    }
    echo $f;
}

function flatsome_google_fonts_lazy(){
  if(flatsome_option('disable_fonts')) return;
  ?>
    <script type="text/javascript">
    WebFontConfig = {
      google: { families: [ <?php echo flatsome_get_google_fonts_link_lazy(); ?> ] }
    };
    (function() {
      var wf = document.createElement('script');
      wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
      wf.type = 'text/javascript';
      wf.async = 'true';
      var s = document.getElementsByTagName('script')[0];
      s.parentNode.insertBefore(wf, s);
    })(); </script>
  <?php
}

add_filter('wp_head','flatsome_google_fonts_lazy');
