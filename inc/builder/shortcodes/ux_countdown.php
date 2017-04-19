<?php

// Add to builder
add_ux_builder_shortcode( 'ux_countdown', array(
    'name' => __( 'Countdown' ),
    'category' => __( 'Content' ),
    'thumbnail' =>  flatsome_ux_builder_thumbnail( 'countdown' ),
    'allow_in' => array('text_box'),
    'scripts' => array(
        'flatsome-countdown-script' => get_template_directory_uri() . '/inc/shortcodes/ux_countdown/countdown-script-min.js',
        'flatsome-countdown-theme-js' => get_template_directory_uri() . '/inc/shortcodes/ux_countdown/ux-countdown.js'
    ),
    'styles' => array(
        'flatsome-countdown-style' => get_template_directory_uri() . '/inc/shortcodes/ux_countdown/ux-countdown.css',
    ),
    'options' => array(
        'style' => array(
            "type" => "select",
            "heading" => __('Style'),
            "default" => 'clock',
            "options" => array(
              'clock' => 'Clock',
              'text' => 'Text',
            )
        ),
	   'size' => array(
            'type' => 'slider',
            'heading' => __('Size'),
            'responsive' => true,
            'default' => '300',
            'unit' => '%',
            'responsive' => true,
            'max' => '400',
            'min' => '0',
            'on_change' => array(
                'selector' => '.ux-timer, .ux-timer-text',
                'style' => 'font-size: {{ value }}%'
            ),
        ),
        'color' => array(
                'type' => 'radio-buttons',
                'heading' => __( 'Color' ),
                'default' => 'dark',
                'options' => array(
                    'dark' => array( 'title' => 'Light' ),
                    'light' => array( 'title' => 'Dark' ),
                ),
        ),
        'bg_color' => array(
          'type' => 'colorpicker',
          'heading' => __('Background'),
          'responsive' => true,
          'default' => '',
          'alpha' => true,
          'format' => 'rgb',
          'position' => 'bottom right',
          'helpers' => require( __DIR__ . '/helpers/colors.php' ),
        ),
        'year' => array(
            "type" => "textfield",
            "heading" => "Year",
            "default" => "2016"
        ),
        'month' => array(
            "type" => "textfield",
            "heading" => "Month",
            "default" => "12"
        ),
        'day' => array(
            "type" => "textfield",
            "heading" => "Day",
            "default" => "31"
        ),
        'time' => array(
            "type" => "textfield",
            "heading" => "Time",
            "default" => "18:00"
        ),
        'translations' => array(
            'type' => 'group',
            'heading' => 'Texts',
            'options' => array(
                't_week' => array( "type" => "textfield", "heading" => "Week", "default" => "week"),
                't_day' => array( "type" => "textfield", "heading" => "Day", "default" => "day"),
                't_hour' => array( "type" => "textfield", "heading" => "Hour", "default" => "hour"),
                't_min' => array( "type" => "textfield", "heading" => "Min", "default" => "min"),
                't_sec' => array( "type" => "textfield", "heading" => "Sec", "default" => "sec"),
            )
        ),
        'translations_p' => array(
            'type' => 'group',
            'heading' => 'Texts Plural',
            'options' => array(
                't_plural' => array( "type" => "textfield", "heading" => "Plural default", "default" => ""),
                't_week_p' => array( "type" => "textfield", "heading" => "Week Plural"),
                't_day_p' => array( "type" => "textfield", "heading" => "Day Plural"),
                't_hour_p' => array( "type" => "textfield", "heading" => "Hour Plural"),
                't_min_p' => array( "type" => "textfield", "heading" => "Min Plural"),
                't_sec_p' => array( "type" => "textfield", "heading" => "Sec Plural"),
            )
        )
     )
) );
