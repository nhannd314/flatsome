<?php 
// PAGE META OPTIONS
include('meta/meta_box_framework.php');

function flatsome_custom_meta_boxes() {
    $meta_box = array(
        'id'         => 'flatsome_page_options2', // Meta box ID
        'title'      => 'Page Layout', // Meta box title
        'pages'      => array('page'), // Post types this meta box should be shown on
        'context'    => 'normal', // Meta box context
        'priority'   => 'high', // Meta box priority
        'fields' => array(
            array(
                'id' => '_footer',
                'name' => 'Page Footer',
                //'desc' => 'This is a description.',
                'type' => 'select',
                'std' => 'normal',
                'choices' => array(
                    'normal' => 'Normal',
                    'simple' => 'Simple',
                    'custom' => 'Custom',
                    'transparent' => 'Transparent',
                    'disabled' => 'Hide',
                )
            ),        
        )
    );
    dev7_add_meta_box( $meta_box );
}
add_action( 'dev7_meta_boxes', 'flatsome_custom_meta_boxes' );