<?php

function flatsome_ux_builder_template( $path ) {
  ob_start();
  include get_template_directory() . '/inc/builder/shortcodes/templates/' . $path;
  return ob_get_clean();
}

function flatsome_ux_builder_thumbnail( $name ) {
  return get_template_directory_uri() . '/inc/builder/shortcodes/thumbnails/' . $name . '.svg';
}

function flatsome_ux_builder_template_thumb( $name ) {
  return get_template_directory_uri() . '/inc/builder/templates/thumbs/' . $name . '.jpg';
}
