<?php

add_ux_builder_shortcode( 'video_button', array(
  'name' => __( 'Video Button' ),
  'category' => __( 'Content' ),
  'thumbnail' =>  flatsome_ux_builder_thumbnail( 'play' ),

  'options' => array(
      'video' => array(
        'type' => 'textfield',
        'heading' => 'Video',
        'description' => 'Enter a Youtube or Vimeo video here. Video will open in a lightbox. Example: https://www.youtube.com/watch?v=AoPiLg8DZ3A',
      ),
      'size' => array(
        'type' => 'slider',
        'heading' => __('Size'),
        'unit' => '%',
        'default' => '100',
        'max' => '500',
        'min' => '0',
        'on_change' => array(
            'style' => 'font-size: {{ value }}%'
        )
      ),
  )
) );
