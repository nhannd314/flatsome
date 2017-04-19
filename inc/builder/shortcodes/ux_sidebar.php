<?php

global $wp_registered_sidebars;

$sidebar_options = array();
foreach ($GLOBALS['wp_registered_sidebars'] as $sidebar){
    $sidebar_options[$sidebar['id']] = $sidebar['name'];
}

// TODO: Get sidebars
add_ux_builder_shortcode( 'ux_sidebar', array(
    'name' => __( 'Widget Area' ),
    'category' => __( 'Layout' ),
    'thumbnail' =>  flatsome_ux_builder_thumbnail( 'sidebar' ),
    'options' => array(
        'id' => array(
            'type' => 'select',
            'heading' => 'Select',
            'default' => 'sidebar-main',
            'options' => $sidebar_options,
            'description' => 'You can edit Widget Areas in WP-admin > Apperance > Widgets'
        ),
        'style' => array(
            'type' => 'select',
            'heading' => __( 'Widgets style' ),
            'default' => '',
            'options' => array(
                '' => 'Default',
                'framed' => 'Framed',
                'boxed' => 'Boxed'
            )
        ),
    ),
) );