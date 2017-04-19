<?php
// [trans]
//
if ( !function_exists( 'ux_wpml_shortcode' ) ){
  function ux_wpml_shortcode(){
    add_shortcode( 'uxtrans', 'uxtext_if_lang_sc');
    add_shortcode( 'uxlang', 'uxtext_if_lang_sc');
  }
  add_action( 'init', 'ux_wpml_shortcode' );
  function uxtext_if_lang_sc( $attr, $content = null ){
    if ( !defined( 'ICL_LANGUAGE_CODE' ) ){
      return '';
    }
    extract(shortcode_atts(array('lang' => '', 'code' => '', 'language' => '',  ), $attr));
    $lang = ( $code ) ? $code : $lang;
    $lang = ( $language ) ? $language : $lang;
    $lang = ( $lang ) ? $lang : ICL_LANGUAGE_CODE;
    return uxtext_if_lang( $lang, $content );
  }
}

if ( !function_exists( 'uxtext_if_lang' ) ){
  function uxtext_if_lang( $lang, $content ){
    if ( !defined( 'ICL_LANGUAGE_CODE' ) ){
      return '';
    }
    if ( $lang === null ){
      return '';
    }
    if ( ICL_LANGUAGE_CODE === $lang ){
      return do_shortcode( $content );
    } else {
      return '';
    }
  }
}
