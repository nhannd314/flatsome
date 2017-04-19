<?php

// Shortcode to display a single product
$options = array(
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

add_ux_builder_shortcode( 'ux_products_list', array(
    'name' => 'Products List',
    'category' => __( 'Shop' ),
    'priority' => 2,
    'thumbnail' =>  flatsome_ux_builder_thumbnail( 'products-list' ),
    'presets' => array(
            array(
                'name' => __( 'Default' ),
                'content' => '[ux_products_list]'
            ),
            array(
                'name' => __( 'On Sale' ),
                'content' => '[ux_products_list orderby="sales" show="onsale"]'
            ),
            array(
                'name' => __( 'Featured Products' ),
                'content' => '[ux_products_list show="featured"]'
            ),
             array(
                'name' => __( 'Best Selling' ),
                'content' => '[ux_products_list orderby="sales"]'
      ),
    ),
    'options' => $options
) );
