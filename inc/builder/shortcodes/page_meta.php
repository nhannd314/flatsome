<?php

add_ux_builder_shortcode( 'ux_the_title', array(
  'name' => __( 'Page Title' ),
  'category' => __( 'Meta' ),
  'options' => array(
  	 'video' => array(
        'type' => 'textfield',
        'heading' => 'Video',
      ),
  	)
) );

add_ux_builder_shortcode( 'ux_breadcrumbs', array(
  'name' => __( 'Breadcrumbs' ),
  'category' => __( 'Meta' ),
  'options' => array(
  	 'video' => array(
        'type' => 'textfield',
        'heading' => 'Video',
      ),
  	)
) );

add_ux_builder_shortcode( 'ux_subnav', array(
  'name' => __( 'Sub Navs' ),
  'category' => __( 'Meta' ),
  'options' => array( 
  	'video' => array(
        'type' => 'textfield',
        'heading' => 'Video',
      ),
 	)
) );


add_ux_builder_shortcode( 'ux_excerpt', array(
  'name' => __( 'Excerpt' ),
  'category' => __( 'Meta' ),
  'options' => array( 
    'video' => array(
        'type' => 'textfield',
        'heading' => 'Video',
      ),
  )
) );