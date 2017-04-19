<?php

// Register scripts
function flatsome_countdown_shortcode_scripts() {
    wp_register_style( 'flatsome-countdown-style', get_template_directory_uri() . '/inc/shortcodes/ux_countdown/ux-countdown.css', 'flatsome-style');
    wp_register_script( 'flatsome-countdown-script', get_template_directory_uri() . '/inc/shortcodes/ux_countdown/countdown-script-min.js', 'flatsome-countdown-script');
    wp_register_script( 'flatsome-countdown-theme-js', get_template_directory_uri() . '/inc/shortcodes/ux_countdown/ux-countdown.js', 'flatsome-js', '3.2.6', true);
}
add_action( 'wp_enqueue_scripts', 'flatsome_countdown_shortcode_scripts' );

// Register Shortcode
function ux_countdown_shortcode( $atts ){
    extract( shortcode_atts( array(
      '_id' => 'timer-'.rand(),
      'before' => '',
      'after' => '',
      'year' => '2016',
      'month' => '12',
      'day' => '31',
      'color' => 'dark',
      'time' => '18:00',
      'style' => 'clock',
      'size' => '200',
      'size__md' => '',
      'size__sm' => '',
      't_hour' => 'hour',
      't_min' => 'min',
      't_day' => 'day',
      't_week' => 'week',
      't_sec' => 'sec',
      //
      't_plural' => 's',
      't_hour_p' => '',
      't_min_p' => '',
      't_day_p' => '',
      't_week_p' => '',
      't_sec_p' => '',

    ), $atts ) );

    wp_enqueue_style('flatsome-countdown-style');
    wp_enqueue_script('flatsome-countdown-script');
    wp_enqueue_script('flatsome-countdown-theme-js');

    $date = $year.'/'.$month.'/'.$day;

    // Fix Time
    if($time == '24:00') $time = '23:59:59';

    if($time) $date = $date.' '.$time;

    if($color == 'primary' && !isset($bg_color)){
      $color = false;
      $atts['bg_color'] = get_theme_mod('color_primary','#446084');
    }

    $args = array(
      'size' => array(
        'selector' => '',
        'unit' => '%',
        'property' => 'font-size',
      ),
      'bg_color' => array(
        'selector' => 'span',
        'property' => 'background-color',
      ),
    );
    // data-text-hour-p="'.$t_hour_p.'" data-text-day-p="'.$t_day_p.'" data-text-week-p="'.$t_week_p.'" data-text-min-p="'.$t_min_p.'" data-text-sec-p="'.$t_sec_p.'"
    // Texts
    $translations = 'data-text-plural="'.$t_plural.'" data-text-hour="'.$t_hour.'" data-text-day="'.$t_day.'" data-text-week="'.$t_week.'" data-text-min="'.$t_min.'" data-text-sec="'.$t_sec.'"';

    // Add plurals
    if(isset($t_hour_p) || isset($t_day_p)) {
      $translations = $translations.' '.'data-text-hour-p="'.$t_hour_p.'" data-text-day-p="'.$t_day_p.'" data-text-week-p="'.$t_week_p.'" data-text-min-p="'.$t_min_p.'" data-text-sec-p="'.$t_sec_p.'"';
    }

    if($style == 'clock'){
      return $before.'<div id="'.$_id.'" class="ux-timer '.$color.'" '.$translations.' data-countdown="'.$date.'"><span>&nbsp;<div class="loading-spin dark centered"></div><strong>&nbsp;</strong></span></div>'.ux_builder_element_style_tag($_id, $args, $atts).$after;
    } else{
      return $before.'<span id="'.$_id.'" class="ux-timer-text" '.$translations.' data-countdown="'.$date.'"></span>'.ux_builder_element_style_tag($_id, $args, $atts).''.$after;
    }
}
add_shortcode('ux_countdown', 'ux_countdown_shortcode');
