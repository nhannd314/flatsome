<?php

namespace UxBuilder\Ajax;

class DoShortcode {

  public function do_shortcode() {
    $action = $_POST['ux_builder_action'];
    $shortcode = wp_parse_args( $_POST['ux_builder_shortcode'], array(
      'tag' => '', '$id' => '', 'options' => array()
    ) );

    // Workaround for using the global WooCommerce product object.
    // TODO: Find out why it is converted to a string.
    if ( function_exists( 'wc_get_product' ) &&
        array_key_exists( 'product', $GLOBALS ) &&
        ! is_object( $GLOBALS['product'] ) ) {
        $GLOBALS['product'] = wc_get_product( get_the_ID() );
    }

    // Get current shortcode data.
    $current_shortcode = ux_builder_shortcodes()->get( $shortcode['tag'] );

    // Set <content/> as shortcode content to allow nested
    // shortcodes if current shortcode is a container.
    if( $current_shortcode['type'] == 'container' ) {
        $shortcode['children'] = array( array(
            'tag' => 'text',
            'options' => array(),
            'content' => '<content/>',
        ) );
    }

    // Render and return the shortcode markup.
    echo do_shortcode( ux_builder( 'to-string' )->transform( array( $shortcode ) ) );

    die;
  }
}
