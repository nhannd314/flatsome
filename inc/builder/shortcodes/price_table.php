<?php

add_ux_builder_shortcode( 'ux_price_table', array(
  'type' => 'container',
  'name' => __( 'Price Table' ),
  'category' => __( 'Content' ),
  'thumbnail' => flatsome_ux_builder_thumbnail( 'price_table' ),
  'allow' => array('text','bullet_item','button'),
  'wrap' => false,
  'presets' => array(
    array(
      'name' => __( 'Default' ),
      'content' => '[ux_price_table title="Title" price="price" featured="false"][bullet_item text="Title"][bullet_item text="Title"][bullet_item text="Title"][bullet_item text="Title"][/ux_price_table]',
      ),
    ),
    'options' => array(
      'title' => array( 'type' => 'textfield','heading' => 'Title', 'default' => 'Title', 'on_change' => array('selector' => '.title', 'content' => '{{value}}' )),
      'price' => array( 'type' => 'textfield','heading' => 'Price', 'default' => '$99.99','on_change' => array('selector' => '.price', 'content' => '{{value}}')),
      'description' => array( 'type' => 'textfield','heading' => 'Desc.', 'default' => 'Description','on_change' => array('selector' => '.description', 'content' => '{{value}}')),
  
      'featured' => array(
            'type' => 'radio-buttons',
            'heading' => __('Featured'),
            'default' => 'false',
            'options' => array(
                'false'  => array( 'title' => 'No'),
                'true'  => array( 'title' => 'Yes'),
            ),
            'on_change' => array(
              'recompile' => false,
              'selector' => '.pricing-table',
              'class' => array(
                'false'  => '',
                'true'  => 'featured-table',
              ),
            ),
      ),
      'color' => array(
            'type' => 'radio-buttons',
            'heading' => __('Text Color'),
            'default' => '',
            'options' => array(
                ''  => array( 'title' => 'Dark'),
                'dark'  => array( 'title' => 'Light'),
            ),
            'on_change' => array(
              'recompile' => false,
              'class' => '{{ value }}',
            ),
      ),
      'bg_color' => array(
        'type' => 'colorpicker',
        'heading' => __('Bg Color'),
        'format' => 'rgb',
        'position' => 'bottom right',
        'on_change' => array(
          'selector' => '.pricing-table',
          'style' => 'background-color: {{value}}',
        ),
      ),
      'radius' => array(
        'type' => 'slider',
        'heading' => __( 'Radius' ),
        'default' => '0',
        'unit' => 'px',
        'max' => '30',
        'min' => '0',
        'on_change' => array(
          'selector' => '.pricing-table',
          'style' => 'border-radius: {{value}}px',
        ),
      ),
     'depth' => array(
        'type' => 'slider',
        'heading' => __( 'Depth' ),
        'default' => '0',
        'max' => '5',
        'min' => '0',
        'on_change' => array(
          'recompile' => false,
          'selector' => '.pricing-table',
          'class' => 'box-shadow-{{ value }}'
        ),
      ),
      'depth_hover' => array(
          'type' => 'slider',
          'heading' => __( 'Depth Hover' ),
          'default' => '3',
          'max' => '5',
          'min' => '0',
          'on_change' => array(
            'recompile' => false,
            'selector' => '.pricing-table',
            'class' => 'box-shadow-{{ value }}-hover'
          ),
      ),
    )
) );

add_ux_builder_shortcode( 'bullet_item', array(
    'name' => __( 'Bullet Item' ),
    'info' => '{{ title }}',
    'require' => array( 'ux_price_table' ),
    'template' => '
      <div class="bullet-item"
        ng-class="{
          \'tooltip\': !!shortcode.options.tooltip,
          \'has-hover\': !!shortcode.options.tooltip,
          \'is-disabled\': shortcode.options.enabled !== \'true\'
        }"
        ng-attr-title="shortcode.options.tooltip">
        <span class="text" ng-bind-html="shortcode.options.text | html"></span>
        <span ng-if="shortcode.options.tooltip" class="tag-label bullet-more-info circle">?</span>
      </div>
    ',
    'wrap' => false,
    'hidden' => true,
    'options' => array(
      'text' => array(
        'type' => 'textfield',
        'heading' => 'Text',
        'default' => 'Add any text here',
      ),
      'tooltip' => array(
        'type' => 'textfield',
        'heading' => 'Tooltip',
        'default' => '',
      ),
      'enabled' => array(
          'type' => 'radio-buttons',
          'heading' => __('Enabled'),
          'default' => 'true',
          'options' => array(
              'true'  => array( 'title' => 'Yes'),
              'false'  => array( 'title' => 'No'),
          ),
        ),
    ),
) );
