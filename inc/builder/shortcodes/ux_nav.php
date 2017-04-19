<?php

add_ux_builder_shortcode( 'ux_nav', array(
  'name' => __( 'Navigation','ux-builder'),
  'category' => __( 'Layout' ),
  'thumbnail' =>  flatsome_ux_builder_thumbnail( 'nav' ),
  'options' => array(
       'parent' => array(
            'type' => 'select',
            'heading' => 'Parent',
            'default' => '',
            'options' => ux_builder_get_page_parents(),
      ),
      'type' => array(
            'type' => 'select',
            'heading' => __( 'Direction','ux-builder' ),
            'default' => 'vertical',
            'options' => array(
                'horizontal' => 'Horizontal',
                'vertical' => 'Vertical',
            )
      ),
      'style' => array(
          'type' => 'select',
          'heading' => __( 'Style','ux-builder'),
          'default' => 'line',
          'options' => require( __DIR__ . '/values/nav-styles.php' ),
      ),
      'align' => array(
          'type' => 'radio-buttons',
          'heading' => 'Text align',
          'default' => 'left',
          'options' => require( __DIR__ . '/values/align-radios.php' ),
      ),
      'size' => array(
          'type' => 'radio-buttons',
          'heading' => __( 'Size' ,'ux-builder'),
          'default' => 'medium',
          'options' => require( __DIR__ . '/values/text-sizes.php' ),
      ),
)
) );