<?php

// Shortcode to display a single product
$repeater_columns = '4';
$repeater_type = 'slider';
$repeater_col_spacing = 'small';

$repeater_posts = 'products';
$repeater_post_type = 'product';
$repeater_post_cat = 'product_cat';

$options = array(
'style_options' => array(
    'type' => 'group',
    'heading' => __( 'Style' ),
    'options' => array(
         'style' => array(
            'type' => 'select',
            'heading' => __( 'Style' ),
            'default' => 'default',
            'options' => require( __DIR__ . '/values/box-layouts.php' )
        )
    ),
),
'layout_options' => require( __DIR__ . '/commons/repeater-options.php' ),
'layout_options_slider' => require( __DIR__ . '/commons/repeater-slider.php' ),
'post_options' => require( __DIR__ . '/commons/repeater-posts.php' ),
'filter_posts' => array(
    'type' => 'group',
    'heading' => __( 'Filter Posts' ),
    'conditions' => 'ids === ""',
    'options' => array(
         'orderby' => array(
            'type' => 'select',
            'heading' => __( 'Order By' ),
            'default' => 'normal',
            'options' => array(
                'normal' => 'Normal',
                'title' => 'Title',
                'sales' => 'Sales',
                'rand' => 'Random',
                'date' => 'Date'
            )
        ),
        'order' => array(
            'type' => 'select',
            'heading' => __( 'Order' ),
            'default' => 'desc',
            'options' => array(
                'asc' => 'ASC',
                'desc' => 'DESC',
            )
        ),
        'show' => array(
            'type' => 'select',
            'heading' => __( 'Show' ),
            'default' => '',
            'options' => array(
                '' => 'All',
                'featured' => 'Featured',
                'onsale' => 'On Sale',
            )
        )
    )
)
);

$box_styles = require( __DIR__ . '/commons/box-styles.php' );
$options = array_merge($options, $box_styles);

$options['image_options']['conditions'] = 'style !== "default"';
$options['text_options']['conditions'] = 'style !== "default"';
$options['layout_options']['options']['depth']['conditions'] = 'style !== "default"';
$options['layout_options']['options']['depth_hover']['conditions'] = 'style !== "default"';

$options['post_options']['options']['tags'] = array(
  'type' => 'select',
  'heading' => 'Tag',
  'conditions' => 'ids === ""',
  'default' => '',
  'config' => array(
      'placeholder' => 'Select...',
      'termSelect' => array(
          'post_type' => 'product',
          'taxonomies' => 'product_tag',
      ),
  )
);

add_ux_builder_shortcode( 'ux_products', array(
    'name' => 'Products',
    'category' => __( 'Shop' ),
    'priority' => 1,
    'thumbnail' =>  flatsome_ux_builder_thumbnail( 'products' ),
    'presets' => array(
            array(
                'name' => __( 'Default' ),
                'content' => '[ux_products]'
            ),
            array(
                'name' => __( 'On Sale' ),
                'content' => '[ux_products orderby="sales" show="onsale"]'
            ),
            array(
                'name' => __( 'Featured Products' ),
                'content' => '[ux_products show="featured"]'
            ),
             array(
                'name' => __( 'Best Selling' ),
                'content' => '[ux_products orderby="sales"]'
            ),
            array(
                'name' => __( 'Lookbook Style' ),
                'content' => '[ux_products style="shade" slider_nav_style="circle" col_spacing="normal" depth="1" depth_hover="5"  image_height="200%" image_size="medium" image_hover="overlay-add" image_hover_alt="zoom-long" text_size="large" text_hover="hover-slide"]'
            ),
            array(
                'name' => __( 'Lookbook Style 2' ),
                'content' => '[ux_products style="overlay" slider_nav_style="circle" width="full-width" col_spacing="collapse" columns="6"  orderby="rand" image_height="200%" image_size="medium" image_overlay="rgba(0, 0, 0, 0.58)" image_hover="overlay-add" image_hover_alt="zoom-long" text_pos="middle" text_size="large" text_hover="zoom-in"]'
            ),array(
                'name' => __( 'Lookbook Style 3' ),
                'content' => '[ux_products style="overlay" image_height="169%" image_size="medium" image_overlay="rgba(0, 0, 0, 0.67)" image_hover="color" image_hover_alt="overlay-remove-50" text_size="large"]'
            ), array(
                'name' => __( 'Masonery Style' ),
                'content' => '[ux_products style="normal" type="masonry" depth="1" depth_hover="5" text_align="left"]'
            ), array(
                'name' => __( 'Grid Style' ),
                'content' => '[ux_products style="shade" type="grid" grid_height="650px" products="4" orderby="sales" show="featured" image_overlay="rgba(0, 0, 0, 0.19)" image_hover="zoom" image_hover_alt="glow" text_align="left" text_size="large"]'
       ),
    ),
    'options' => $options
) );
