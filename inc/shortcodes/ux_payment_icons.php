<?php

function ux_payment_icons($atts) {
    extract(shortcode_atts(array(
      'link' => '',
      'icons' => get_theme_mod('payment_icons',array('visa','paypal','stripe','mastercard','cashondelivery')),
      'custom' => get_theme_mod('payment_icons_custom'),
      ), $atts));

      // Get custom icons if set
      if(!empty($custom)){
         return do_shortcode('<div class="payment-icons inline-block">'.flatsome_get_image($custom).'</div>');
      } else if(empty($icons)){
         return false;
      }
    
      ob_start();

      if(!is_array($icons)) explode(',', $icons);
      echo '<div class="payment-icons inline-block">';
         foreach ($icons as $key => $value) {
            echo '<div class="payment-icon">';
            echo get_template_part('assets/img/payment-icons/icon',$value.'.svg');
            echo '</div>';
         }
      echo '</div>';

      $content = ob_get_contents();
      ob_end_clean();
      return $content;
}

add_shortcode("ux_payment_icons", "ux_payment_icons");