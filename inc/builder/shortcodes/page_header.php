<?php

add_ux_builder_shortcode( 'page_header', array(
  'name' => __( 'Page Header' ),
  'category' => __( 'Layout' ),
  'wrap' => false,
  'thumbnail' =>  flatsome_ux_builder_thumbnail( 'page_title' ),
  'allow' => array(),
  'presets' => array(),
  'options' => array(
  	 'layout_options' => array(
      'type' => 'group',
      'heading' => __( 'Layout' ),
      'options' => array(
      	'height' => array(
          'type' => 'scrubfield',
          'responsive' => true,
          'heading' => __('Height'),
          'default' => '',
          'placeholder' => __('Default'),
          'min' => 0,
          'step' => 1,
           'on_change' => array(
              'recompile' => false,
              'selector' => '.page-title-inner',
              'style' => 'min-height: {{ value }}'
          )
        ),

        'margin' => array(
          'type' => 'scrubfield',
          'responsive' => true,
          'heading' => __('Margin'),
          'min' => 0,
          'step' => 1,
           'on_change' => array(
            'recompile' => false,
            'style' => 'margin-bottom: {{ value }}'
          )
        ),

        'style' => array(
            'type' => 'select',
            'heading' => 'Content Style',
            'full_width' => true,
            'default' => 'featured',
            'options' => array(
            	'featured' => 'Featured',
            	'normal' => 'Flat',
                'simple' => 'Simple',
                'divided' => 'Divided',
            )
        ),

        'type' => array(
            'type' => 'select',
            'heading' => 'Content Type',
            'full_width' => true,
            'default' => 'breadcrumbs',
            'options' => array(
            	'breadcrumbs' => 'Breadcrumbs',
                'subnav' => 'Sub Navigation',
                'onpage' => 'Scroll To Navigation',
                'share' => 'Share Icons'
            )
        ),

        'text_color' => array(
          'type' => 'radio-buttons',
          'heading' => __('Text color'),
          'default' => 'light',
          'options' => array(
            'light'  => array( 'title' => 'Light'),
            'dark'  => array( 'title' => 'Dark'),
          ),
        ),

        'align' => array(
            'type' => 'radio-buttons',
            'heading' => 'Align',
            'full_width' => true,
            'default' => 'left',
            'options' => array(
            	'left' => array( 'title' => 'Left'),
              'center' => array( 'title' => 'Center'),
              'right' => array( 'title' => 'Right'),
            ),
        ),

        'v_align' => array(
            'type' => 'radio-buttons',
            'heading' => 'Vertical Align',
            'full_width' => true,
            'default' => 'center',
            'options' => array(
                'top' => array( 'title' => 'Top'),
                'center' => array( 'title' => 'Middle'),
                'bottom' => array( 'title' => 'Bottom'),
            )
        ),

        'depth' => array(
            'type' => 'slider',
            'vertical' => true,
            'heading' => 'Depth',
            'default' => 0,
            'max' => 5,
            'min' => 0,
        ),

        'parallax_text' => array(
            'type' => 'slider',
            'heading' => 'Content Parallax',
            'unit' => '+',
            'default' => 0,
            'max' => 10,
            'min' => 0,
        ),
      )
    ),
  	'title_options' => array(
  	   'type' => 'group',
       'heading' => __( 'Title' ),
       'options' => array(

          'show_title' => array(
            'type' => 'checkbox',
            'heading' => 'Show Title',
            'default' => 'true'
          ),

       	 'title' => array(
            'conditions' => 'show_title',
            'type' => 'textfield',
            'heading' => 'Title',
            'placeholder' => __( 'Page title' ),
            'default' => '',
       	 ),

       	 'title_size' => array(
            'conditions' => 'show_title',
            'type' => 'select',
            'heading' => 'Size',
            'options' => require( __DIR__ . '/values/sizes.php' ),
         ),

       	 'title_case' => array(
            'conditions' => 'show_title',
  	        'type' => 'radio-buttons',
  	        'heading' => 'Letter Case',
  	        'default' => 'normal',
  	        'options' => array(
              'normal' => array( 'title' => 'Abc' ),
	            'uppercase' => array( 'title' => 'ABC'),
  	        ),
        ),

       	 'sub_title' => array(
            'conditions' => 'show_title',
            'type' => 'textfield',
            'heading' => 'Sub Title',
            'default' => '',
       	 ),
       ),
  	),
  	'nav_options' => array(
      'type' => 'group',
      'heading' => __( 'Navigation style' ),
      'options' => array(
      	'nav_style' => array(
            'type' => 'select',
            'heading' => 'Style',
            'default' => 'line',
            'options' => require( __DIR__ . '/values/nav-styles.php' ),
         ),
      	'nav_size' => array(
            'type' => 'select',
            'heading' => 'Size',
            'options' => require( __DIR__ . '/values/sizes.php' ),
         ),
      	 'nav_case' => array(
	        'type' => 'radio-buttons',
	        'heading' => 'Letter Case',
	        'default' => 'uppercase',
	        'options' => array(
	            'uppercase' => array( 'title' => 'ABC'),
	            'lowercase' => array( 'title' => 'Abc' ),
	        ),
        ),
       )
    ),
  	'background_options' => array(
      'type' => 'group',
      'heading' => __( 'Background' ),
      'options' => array(
        'bg' => array(
          'type' => 'image',
          'heading' => __( 'Image' ),
          'thumb_size' => 'bg_size',
          'bg_position' => 'bg_pos',
        ),
        'bg_size'=> array(
          'type' => 'select',
          'heading' => 'Size',
          'default' => 'large',
          'options' => array(
            'orginal' => 'Orginal',
            'large' => 'Large',
            'medium' => 'Medium',
            'thumbnail' => 'Thumbnail',
          )
        ),
        'bg_color' => array(
          'type' => 'colorpicker',
          'heading' => __('Color'),
          'format' => 'rgb',
          'position' => 'bottom right',
          'helpers' => require( __DIR__ . '/helpers/colors.php' ),
        ),
        'bg_overlay' => array(
          'type' => 'colorpicker',
          'heading' => __('Overlay'),
          'responsive' => true,
          'alpha' => true,
          'format' => 'rgb',
          'position' => 'bottom right',
          'helpers' => require( __DIR__ . '/helpers/colors-overlay.php' ),
        ),
        'bg_pos' => array(
          'type' => 'textfield',
          'heading' => __('Position'),
           'on_change' => array(
	            'selector' => '.title-bg',
	            'style' => 'background-position: {{ value }}'
          )
        ),
        'parallax' => array(
            'type' => 'slider',
            'heading' => 'Parallax',
            'unit' => '+',
            'default' => 0,
            'max' => 10,
            'min' => 0,
        ),
    ), // end bgs

  ),
 ),
) );
